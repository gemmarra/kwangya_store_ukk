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
    <link rel="stylesheet" href="<?= base_url('assets/css/cashier.css'); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
         body {
            background-image: url(<?= base_url('assets/img/wallpaper/bg11.jpg');?>);
            background-size: cover;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            max-height: 100vh;
            overflow: hidden;
        }
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
    <title>KWANGYA STORE</title>
  </head>
  <body>
    <div class="cashier">
      <!-- Product -->
        <div class="product">
          <div class="product-header">
          <a href="/dashboard" class="text-light btn-back"><i class="bi bi-box-arrow-left"></i></a>          
          <div class="search">
                <form action="/selling/search" method="post">
                    <input type="text" name="search" id="" placeholder="Search ID here..." autocomplete="off">
                </form>
            </div>
          </div>
          <?php if(isset($ProductList)) : ?>
            <div class="product-list">
    <?php 
    if(isset($ProductList)) :
        // $colors = ["#CDDBDB","#E3CBEB","#BEDBE7","#FAC0D8","#C0E8DD","#E4D7DE","#F1C6CF","#C9C9ED"];
        // $currentColorIndex = 0; 
        foreach($ProductList as $row) :
    ?>
    <div class="product-item" 
     data-category="<?= $row->category_name ?>" 
     data-name="<?= $row->product_name ?>" 
     data-price="<?= $row->selling_price ?>" 
     data-productid="<?= $row->product_id ?>" 
     data-quantity="1">
        <div class="id" style="display:none;"><?= $row->product_id ?></div>
        <div class="name" style="font-weight:700;"><?= $row->product_name ?></div>
        <div class="amount" style="font-size:1.2rem;">
            <i class="bi bi-dash-circle decrement"></i>
            <span class="quantity" style="margin:0 5px;">1</span>
            <i class="bi bi-plus-circle increment"></i>
        </div>
        <div class="price"><?= number_format($row->selling_price, 2, ',', '.') ?></div>
        <button class="btn btn-add">Add</button>
    </div>
    <?php 
       // $currentColorIndex = ($currentColorIndex + 1) % count($colors);
    endforeach;
    endif;
    ?>
</div>
<?php endif; ?>
        <!-- <div class="product-category">
        <ul class="nav nav-underline">
        <li class="nav-item">
            <a class="nav-link text-light active" aria-current="page" data-category="all" href="#">ALL CATEGORY</a>
        </li>
        <?php if(isset($CategoryList)) :
        foreach($CategoryList as $row) :?>
        <li class="nav-item">
            <a class="nav-link text-light category-link" data-category="<?= $row->category_name ?>" href="#"><?= strtoupper($row->category_name) ?></a>
        </li>
        <?php endforeach;
        endif ?>
    </ul>
</div> -->
        </div>
        <!-- Counter -->
        <div class="counter">
            <div class="order">
                <div class="order-header fw-bold">
                    <p>Factur #<span id="numberCode" class="factur"></span></p>
                </div>
                <div class="order-list" id="cart-items">
                    <table>
                        <tbody>
                        <?php
                            if(isset($sellingdetails)&& !empty($sellingdetails)) :
                            $no = null;
                            foreach($sellingdetails as $row) : 
                            ?>
                            <td><?=$row['product_name'];?></td>
                            <td><?=$row['quantity'];?></td>
                            <td><?=number_format($row['price'], 2, ',', '.');?></td>
                            <?php
                            endforeach;    
                            endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="number text-light">
                <p>Total</p>
                <p class="total">pp</p>
            </div>
            <div class="button-pay">
                <a id="mybtnmodalPay" class="btn">Pay</a>
            </div>
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
        <form action="/selling/payment" method="post">
            <label for="grandtotal">Total</label>
            <input type="text" class="money" oninput="calculate()" required name="grand_total" data-mask="000.000.000.000.000" focus>
            <br><br>
            <label for="payedmoney">Payed</label>
            <input type="text" class="money" oninput="calculate()" required name="payed_money" data-mask="000.000.000.000.000">
            <br><br>
            <label for="changemoney">Change Money</label>
            <input type="text" class="money" readonly name="change_money" data-mask="000.000.000.000.000">
            <br><br>
            <button id="paymentButton" class="payment" onclick="calculate()" type="submit">Process Payment</button>
        </form>
        <p>Hello World</p>
    </div>
    <div class="modal-footer">
    <!-- <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
        </form> -->
    </div>
    </div>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?=base_url('assets/js/jquery_mask/dist/jquery.mask.js');?>"></script>
<script>
    $(document).ready(function(){
        $('.money').mask('000.000.000.000.000', {reverse: true});
    })
</script>

<script src="<?=base_url('assets/js/pay.js');?>"></script>

<script>
        function calculate() {
            var grandtotal = parseFloat(document.getElementById('grandtotal').value);
            var payedmoney = parseFloat(document.getElementById('payedmoney').value);
            var changemoney = payedmoney - grandtotal;
            document.getElementById('changemoney').value = isNaN(changemoney) ? '' : changemoney;
            
            var paymentButton = document.getElementById('paymentButton');
            if (payedmoney < grandtotal) {
                paymentButton.disabled = true;
            } else {
                paymentButton.disabled = false;
            }
        }
</script>

<!-- Live Updates -->
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

<!-- Color Pattern -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize total
        let total = 0;

        // Get all product cards
        const productItems = document.querySelectorAll('.product-item');

        // Add click event listener to each product card
        productItems.forEach(product => {
            product.addEventListener('click', function() {
                // Extract data from the clicked product card
                const name = this.getAttribute('data-name');
                const price = parseFloat(this.getAttribute('data-price')); // Convert price to float
                const quantity = 1; // Default quantity

                // Check if a row with the same product already exists in the table
                const existingRow = document.querySelector(`#cart-table tbody tr[data-name="${name}"]`);
                if (existingRow) {
                    // If row exists, update the quantity
                    const existingQuantity = parseInt(existingRow.querySelector('.quantity').innerText);
                    existingRow.querySelector('.quantity').innerText = existingQuantity + 1;

                    // Update total price for existing row
                    const totalPrice = (existingQuantity + 1) * price;
                    existingRow.querySelector('.total-price').innerText = formatCurrency(totalPrice);
                } else {
                    // If row does not exist, create a new row
                    const newRow = document.createElement('tr');
                    newRow.setAttribute('data-name', name);
                    newRow.innerHTML = `
                        <td>${name}</td>
                        <td class="quantity">${quantity}</td>
                        <td class="total-price">${formatCurrency(price)}</td>
                        <td><button class="btn-delete">Delete</button></td>
                    `;

                    // Append the new row to the table body
                    document.querySelector('#cart-table tbody').appendChild(newRow);
                }

                // Update total
                total += price;
                document.querySelector('.total').innerText = formatCurrency(total);
            });
        });

        // Add click event listener to decrement buttons
        document.querySelector('#cart-table tbody').addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-decrement')) {
                // Decrement the quantity
                const row = event.target.closest('tr');
                const quantityElement = row.querySelector('.quantity');
                let quantity = parseInt(quantityElement.innerText);
                
                if (quantity > 1) {
                    quantity--;
                    quantityElement.innerText = quantity;

                    // Update total price
                    const price = parseFloat(row.querySelector('td:nth-child(2)').innerText.replace(/\./g, '').replace(',', '.'));
                    const totalPrice = quantity * price;
                    row.querySelector('.total-price').innerText = formatCurrency(totalPrice);

                    // Update total
                    total -= price;
                    document.querySelector('.total').innerText = formatCurrency(total);
                } else {
                    row.remove(); // Remove the row if quantity is 1
                }
            }
        });

        // Add click event listener to delete buttons
        document.querySelector('#cart-table tbody').addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-delete')) {
                // Delete the row when delete button is clicked
                const row = event.target.closest('tr');
                const price = parseFloat(row.querySelector('td:nth-child(2)').innerText.replace(/\./g, '').replace(',', '.'));
                
                // Update total
                total -= price;
                document.querySelector('.total').innerText = formatCurrency(total);
                
                row.remove();
            }
        });
    });

    // Function to format currency
    function formatCurrency(amount) {
        return amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    }
</script> -->

<script src="<?=base_url('assets/js/card_color.js');?>"></script>
<!-- <script src="<?=base_url('assets/js/decre_incre.js');?>"></script> -->

<!-- Add Selling Details -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <script>
    $(document).ready(function() {
    // Increment quantity
    $('.increment').on('click', function() {
    // Add to cart
    $('.payment').on('click', function() {
        var grand_total = $('#grandtotal').text();
        var payed_money = $('#payedmoney').text();
        var change_money = $('#changemoney').text();
        
        $.ajax({
            url: '/selling/save', // Replace with your actual controller endpoint
            method: 'POST',
            data: {
                grand_total: grand_total,
                payed_money: payed_money,
                change_money: change_money
            },
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });
});
</script> -->

<script>
    $(document).ready(function() {
    // Increment quantity
    $('.increment').on('click', function() {
        var quantityElement = $(this).siblings('.quantity');
        var currentQuantity = parseInt(quantityElement.text());
        quantityElement.text(currentQuantity + 1);
    });

    // Decrement quantity
    $('.decrement').on('click', function() {
        var quantityElement = $(this).siblings('.quantity');
        var currentQuantity = parseInt(quantityElement.text());
        if (currentQuantity > 1) {
            quantityElement.text(currentQuantity - 1);
        }
    });

    // Add to cart
    $('.btn-add').on('click', function() {
        var productItem = $(this).closest('.product-item');
        var category = productItem.data('category');
        var name = productItem.data('name');
        var quantity = parseInt(productItem.find('.quantity').text()); // Get updated quantity
        var price = productItem.data('price');
        var productId = productItem.data('productid');
        var factur = $('#numberCode').text();
        var grand_total = $('#grandtotal').text();
        var payed_money = $('#payedmoney').text();
        var change_money = $('#changemoney').text();
        
        $.ajax({
            url: '/selling/save', // Replace with your actual controller endpoint
            method: 'POST',
            data: {
                category: category,
                name: name,
                quantity: quantity,
                price: price,
                product_id: productId,
                factur: factur,
                grand_total: grand_total,
                payed_money: payed_money,
                change_money: change_money
            },
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });
});
</script>

<script>
    $(document).ready(function() {

    // Add to cart
    $('.btn-add').on('click', function() {
        var factur = $('#numberCode').text();

        var url = '/sellingdetails/select/' + encodeURIComponent(factur); // Encode factur for URL
        
        $.ajax({
            url: url, // Replace with your actual controller endpoint
            method: 'POST',
            data: {
                factur: factur
            },
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });
});
</script>

<!-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-product').click(function(e) {
            e.preventDefault();
            let productId = $(this).data('id');
            $.ajax({
                url: '<?= base_url('add_to_cart') ?>',
                type: 'post',
                data: {product_id: productId},
                success: function(response) {
                    $('#cart-items').append(response);
                }
            });
        });
    });
</script>

<script>
// JavaScript to ensure minimum value is 1
document.addEventListener('DOMContentLoaded', function() {
  var inputquantity = document.querySelector('.input-quantity');
  
  inputquantity.addEventListener('changemoney', function() {
    if (this.value < 1) {
      this.value = 1;
    }
  });
});
</script> -->

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

  </body>
</html>
