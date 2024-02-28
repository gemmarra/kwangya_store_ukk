<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/favicon/apple-touch-icon.png');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon/favicon-32x32.png');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('/favicon-16x16.png');?>">
    <link rel="manifest" href="<?=base_url('assets/img/favicon/site.webmanifest');?>">
    <link rel="mask-icon" href="<?=base_url('assets/img/favicon/safari-pinned-tab.svg');?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS -->
    <link rel="stylesheet" href="<?=base_url('select2/css/select2.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cashier2.css'); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>KWANGYA STORE</title>
  </head>
<body class="mybody">
    <div class="cashier">
    <div class="content1">
    <header>
    <h1><a href="/dashboard"  style="cursor:pointer;text-decoration:none;"><</a></h1>
    <h1><?php
    date_default_timezone_set('Asia/Jakarta');
    $datetime = date('Y-m-d H:i:s');
    echo $datetime;
    ?></h1>
    <h1>Factur: <span><?=$factur?><span></h1>
    </header>
    <form action="/selling/save" method="post" id="sellingForm">
        <div class="input-group">
            <select class="js-example-basic-single" name="product_id" >
            <?php if(isset($ProductList)) :
                        foreach ($ProductList as $row) : ?>  
                        <option value="<?=$row->product_id;?>"><?=$row->product_name;?> | <?=$row->stock;?></option>
                        <?php 
                        endforeach;
                    endif;?>
            </select>
        </div>
        <div class="input-group">
            <input type="text" name="quantity" placeholder="Quantity" class="money" data-mask="000"/>
        </div>
        <input type="hidden" name="factur" id="facturInput">
        <button type="submit" onclick="submitForm()" class="button"><i class="bi bi-cart-fill"></i> Add</button>
    </form>
    <table>
        <!-- <thead>
            <th>No.</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price Total</th>
        </thead> -->
        <tbody>
        <?php
            if(isset($sellingdetails)&& !empty($sellingdetails)) :
            $no = null;
            foreach($sellingdetails as $row) :
            $no++;
            ?>
            <tr>
            <td><?=$no?></td>
            <td><?=$row['product_name'];?></td>
            <td><?=$row['quantity'];?></td>
            <td><?=number_format($row['price_total'], 2, ',', '.');?></td>
            </tr>
            <?php
            endforeach;    
            endif;
        ?>
        </tbody>
    </table>
    <br>
</div>
<div class="content2">
    <div class="total"><h1><?=number_format($grand_total, 0, ',', '.');?></h1></div>
    <div class="moneydetails">
        <button href="/selling/paymentview" id="mybtnmodalPay" class="button"><i class="bi bi-wallet2"></i> Pay</button>
    </div>
    </div>

    <!-- Modal Pay -->
    <div id="mymodalPay" class="modal">

    <!-- Modal content -->

    <div class="modal-content">
    <div class="modal-header">
        <span class="myclosemodalPay">&times;</span>
        <h2>Pay</h2>
    </div>
    <div class="modal-body">
        <form action="/selling/insert_total" method="post">
            <label for="grandtotal">Total</label>
            <input type="text" class="money" id="grandtotal" oninput="calculate()" required name="grand_total" data-mask="000.000.000.000.000" disabled value="<?=number_format($grand_total, 0, ',', '.');?>">
            <br><br>
            <label for="payedmoney">Payed</label>
            <input type="text" class="money" id="payedmoney" oninput="calculate()" required name="payed_money" data-mask="000.000.000.000.000" autofocus>
            <br><br>
            <label for="changemoney">Change</label>
            <input type="text" class="money" id="changemoney" readonly name="change_money" data-mask="000.000.000.000.000">
            <br><br>
    </div>
    <div class="modal-footer">
    <button id="paymentButton" class="button" onclick="calculate()" type="submit">Process Payment</button>
        </form>
    </div>
    </div>

    </div>
    <div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?=base_url('assets/js/jquery_mask/dist/jquery.mask.js');?>"></script>
<script>
        $(document).ready(function() {
            // Function to fetch updates
            function fetchUpdates() {
                $.ajax({
                    url: '/selling/cashier_machine',
                    method: 'GET',
                    success: function(data) {
                        $('#liveUpdates').html(data); // Update the content of liveUpdates div
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching updates:', error);
                    }
                });
            }

            // Fetch updates every 5 seconds
            setInterval(fetchUpdates, 1000); // Adjust the interval as needed
        });
</script>
<script>
    $(document).ready(function(){
        $('.money').mask('000.000.000.000.000', {reverse: true});
    })
</script>
<script>
    function calculate() {
        // Remove dots from input values and convert to float
        var grandtotal = parseFloat(document.getElementById('grandtotal').value.replace(/\./g, '').replace(/,/g, '.'));
        var payedmoney = parseFloat(document.getElementById('payedmoney').value.replace(/\./g, '').replace(/,/g, '.'));

        // Calculate change
        var changemoney = payedmoney - grandtotal;
        
        // Format change with dots as thousands separators
        var formattedChange = new Intl.NumberFormat().format(changemoney);

        // Update change input field
        document.getElementById('changemoney').value = isNaN(changemoney) ? '' : formattedChange;
        
        // Enable/disable payment button based on payedmoney and grandtotal
        var paymentButton = document.getElementById('paymentButton');
        paymentButton.disabled = (payedmoney < grandtotal);
    }
</script>


<script src="<?=base_url('assets/js/pay.js');?>"></script>
<script src="<?=base_url('select2/js/i18n/select2.full.min.js');?>"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-single').select2();
});
</script>
<script>
    function generateCode() {
      let today = new Date();
      let year = today.getFullYear();
      let month = String(today.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are zero-indexed
      let day = String(today.getDate()).padStart(2, '0');
      
      let currentDateCode = `${year}${month}${day}`;

      // Retrieve the last generated date from storage (local storage, database, etc.)
      let lastGeneratedDate = localStorage.getItem('lastGeneratedDate');
      
      let code;
      
      if (lastGeneratedDate === currentDateCode) {
        // Retrieve the last generated number code and increment it
        let lastGeneratedNumber = parseInt(localStorage.getItem('lastGeneratedNumber'), 10) || 0;
        let newNumber = String(lastGeneratedNumber + 1).padStart(3, '0');
        
        code = `${currentDateCode}${newNumber}`;
      } else {
        // If date changemoneyd, start the number from 001
        code = `${currentDateCode}001`;
      }
      
      // Save the current date and number to storage
      localStorage.setItem('lastGeneratedDate', currentDateCode);
      localStorage.setItem('lastGeneratedNumber', parseInt(code.slice(-3), 10));

      return code;
    }

    // Call the generateCode function and update the content of the span element with the generated code
    document.getElementById('numberCode').innerText = generateCode();
</script>
<script>
    $(document).ready(function() {
        $('form').submit(function() {
            $('.money').each(function() {
                var unmaskedValue = $(this).cleanVal(); // Get the unmasked value for each input
                $(this).val(unmaskedValue); // Set the unmasked value to the input field
            });
        });
    });
    </script>
<script>
    function submitForm() {
        // Get the value of the span element
        var facturValue = document.getElementById('numberCode').innerText;

        // Set the value of the hidden input field with the value of the span
        document.getElementById('facturInput').value = facturValue;

        // Submit the form
        document.getElementById('sellingForm').submit();
    }
</script>
</body>
</html>