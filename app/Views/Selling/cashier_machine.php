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
            background-image: url(<?= base_url('assets/img/wallpaper/bg7.jpg');?>);
            background-size: cover;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            max-height: 100vh;
            overflow: hidden;
        }
        .search form input{
            outline: none;
            border: 1px solid rgba(255, 255, 255, 0.180);
            background-color:rgba(0, 0, 0, 0.2);
            padding: 7px;
            color:white;
            font-size: 1rem;
            border-radius: 7px
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
          <?php if(isset($ProductList)) :
          foreach($ProductList as $row) :?>
          <div class="product-item">
            <form action="/selling/cashier_machine" method="post">
              <input type="text" class="category" name="category" id="" value="<?= strtoupper($row->category_name) ?>" readonly>
              <div class="name"><input type="text" name="name" id="" readonly value="<?= $row->product_name ?>"></div>
              <input type="text" class="price" name="price" id="" readonly value="<?= $row->selling_price ?>">
              <div class="amount">
              <input type="number" name="quantity" id="" min="1" class="input-number">
              <!-- <i class="bi bi-dash-circle" onclick="decrement()" ></i>
              <span id="number">1</span>
              <i class="bi bi-plus-circle" onclick="increment()"></i> -->
              </div>
            <button type="submit" class="btn btn-add">Add</button>
            </form>
          </div>
          <?php
          endforeach;
          endif?>
          </div>
          <?php else: ?>
    <p>No product found!</p>
<?php endif; ?>
          <div class="product-category">
            <ul class="nav nav-underline">
              <li class="nav-item">
                <a class="nav-link text-light active" aria-current="page" href="/selling/cashier_machine">ALL CATEGORY</a>
              </li>
              <?php if(isset($CategoryList)) :
              foreach($CategoryList as $row) :?>
              <li class="nav-item">
                <a class="nav-link text-light" href="#"><?= strtoupper($row->category_name) ?></a>
              </li>
              <?php
              endforeach;
              endif?>
            </ul>
          </div>
        </div>
        <!-- Counter -->
        <div class="counter">
            <div class="order">
                <div class="order-header fw-bold">
                    <p>Factur <span>#20240215001</span></p>
                </div>
                <div class="order-list" id="cart-items">
                    <form action="" method="post">
                    <?php if(isset($neededdata['data'])): ?>
    <!-- Display data -->
    <div class="order-item">
        <div class="name text-center"><?= $neededdata['data']['name']; ?></div>
        <div class="amount"><?= $neededdata['data']['quantity']; ?></div>
        <div class="sub-total" id="result"><span>Rp </span><?= $neededdata['grand_total']; ?></div>
    </div>
<?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="number text-light">
                <p>Total</p>
                <p>Rp 350.000</p>
            </div>
            <div class="button-pay">
                <a href="" class="">Pay</a>
            </div>
        </div>
    </div>

<script>
let number = 1; // Initial number

function increment() {
  number++;
  document.getElementById('number').innerText = number;
}

function decrement() {
  if (number > 1) {
    number--;
    document.getElementById('number').innerText = number;
  }
}
</script>

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
  var inputNumber = document.querySelector('.input-number');
  
  inputNumber.addEventListener('change', function() {
    if (this.value < 1) {
      this.value = 1;
    }
  });
});
</script>
  </body>
</html>
