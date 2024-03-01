<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/favicon/apple-touch-icon.png');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon/favicon-32x32.png');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('/favicon-16x16.png');?>">
    <link rel="manifest" href="<?=base_url('assets/img/favicon/site.webmanifest');?>">
    <link rel="mask-icon" href="<?=base_url('assets/img/favicon/safari-pinned-tab.svg');?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="<?= base_url('DataTables/datatables.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>KWANGYA STORE</title>
    <style>        
        body {
            background-image: url(<?= base_url('assets/img/wallpaper/bg11.jpg');?>);
            background-size: cover;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            max-height: 100vh;
            overflow-y: auto;
        }

        .fixed-link {
        position: fixed;
        bottom: 0;
        right: 0;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 5px 0 0 0;
        z-index: 9999; /* Ensures the link stays on top of other content */
        }

        .search form input {
            outline: none;
            border: none;
            background-color:rgba(0, 0, 0, 0.2);
            padding: 7px;
            color:white;
            font-size: 1rem;
            border-radius: 7px
        }

        .user-name {
            display: flex;
            align-items: center;
        }

        .user-name .search {
            margin-right: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header id="header">
            <div class="logo"><h3><i class="bi bi-stack"></i> KWANGYA STORE</h3></div>
            <div class="user-name">
            <?php                
                // if(isset($search)) :
                // echo $search;
                // endif;
            ?>    
            <h3>Hello, <?=session()->get('name')?>!</h3></div>
        </header>
        <main>
            <nav>
                <?php if(session()->get('role') == "administrator") : ?>
                    <a href="/dashboard"><i class="bi bi-grid-fill"></i> Dashboard</a>
                    <a href="/selling/cashier_machine"><i class="bi bi-calculator-fill"></i> Cashier Machine</a>
                    <a href="/product/select"><i class="bi bi-box-seam-fill"></i> Product</a>
                    <a href="/selling/select"><i class="bi bi-currency-exchange"></i> Selling</a>
                    <a href="/purchase/select"><i class="bi bi-cart-fill"></i> Purchase</a>
                    <a href="/user/select"><i class="bi bi-people-fill"></i> User</a>
                    <a href="/report"><i class="bi bi-folder-fill"></i> Report</a>
                    <a href="/logout"><i class="bi bi-door-open-fill"></i> Logout</a>
                <?php elseif(session()->get('role') == "cashier"): ?>
                    <a href="/dashboard"><i class="bi bi-grid-fill"></i> Dashboard</a>
                    <a href="/selling/cashier_machine"><i class="bi bi-calculator-fill"></i> Cashier Machine</a>
                    <a href="/selling/select"><i class="bi bi-currency-exchange"></i> Selling</a>
                    <a href="/logout"><i class="bi bi-door-open-fill"></i> Logout</a>
                <?php elseif(session()->get('role') == "inventory_manager"): ?>
                    <a href="/dashboard"><i class="bi bi-grid-fill"></i> Dashboard</a>
                    <a href="/product/select"><i class="bi bi-box-seam-fill"></i> Product</a>
                    <a href="/purchase/select"><i class="bi bi-cart-fill"></i> Purchase</a>
                    <a href="/report"><i class="bi bi-folder-fill"></i> Report</a>
                    <a href="/logout"><i class="bi bi-door-open-fill"></i> Logout</a>
                <?php endif; ?>
            </nav>
            <div class="content">
                <sub-nav>
                <?php                
                if(isset($subnav)) :
                echo $subnav;
                endif;
                ?>
                </sub-nav>
                <main-content><?= $this->renderSection('content') ?></main-content>
            </div>
        </main>
    </div>

    <!-- Category -->
        <!-- The Modal -->
    <div id="myModalAddCategory" class="modal">

    <!-- Modal content -->

    <div class="modal-content">
    <div class="modal-header">
        <span class="close-addC">&times;</span>
        <h2>Add Category</h2>
    </div>
    <div class="modal-body">
        <form action="/category/save" method="post">
        <div class="input-group">
            <label for="category_name">Category Name</label>
            <div>
                <input type="text" name="category_name" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
        </form>
    </div>
    </div>

    </div>

    <!-- Denomination -->
    <div id="myModalAddDenomination" class="modal">

    <!-- Modal content -->

    <div class="modal-content">
    <div class="modal-header">
        <span class="close-addD">&times;</span>
        <h2>Add Denomination</h2>
    </div>
    <div class="modal-body">
        <form action="/denomination/save" method="post">
        <div class="input-group">
            <label for="denomination_name">Denomination Name</label>
            <div>
                <input type="text" name="denomination_name" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
        </form>
    </div>
    </div>

    </div>

    <script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
            document.getElementById("header").classList.add("scrolled");
        } else {
            document.getElementById("header").classList.remove("scrolled");
        }
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script>
        $('#myTable').DataTable();
    </script>
    <script>
    document.getElementById('file-upload').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
    });
    </script>
    <script src="<?=base_url('assets/js/modal_category.js');?>"></script>
    <script src="<?=base_url('assets/js/modal_denomination.js');?>"></script>
    <script src="<?=base_url('assets/js/modal_details.js');?>"></script>
    <script src="<?=base_url('assets/js/dropdown.js');?>"></script>
    <script src="<?=base_url('assets/js/confirm_password.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery_mask/src/jquery.mask.js');?>"></script>
    <script src="<?=base_url('DataTables/datatables.min.js');?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?=base_url('assets/js/jquery_mask/dist/jquery.mask.js');?>"></script>
    <script>
        $(document).ready(function(){
            $('.money').mask('000.000.000.000.000', {reverse: true});
        })
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
    function toggleMonthSelect() {
        var yearMonth = document.getElementById("range-year-month");
        var monthGroup = document.getElementById("month-group");
        
        if (yearMonth.value === "monthly") {
            monthGroup.style.display = "block";
        } else {
            monthGroup.style.display = "none";
        }
    }
</script>
<script>
    $($document).ready(function(){
        $("#myTable").DataTable()
    });
</script>

</body>
</html>