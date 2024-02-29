<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="cards">
    <div class="card">
        <h2>Today's Income</h2>
        <h3><?=$today_income?></h3>
    </div>
    <div class="card">
        <h2>Today's Selling</h2>
        <h3><?=$today_selling?></h3>
    </div>
    <div class="card">
        <h2>Zero Stock</h2>
        <h3><?=$zero_stock_products?></h3>
    </div>
</div>

<?=$this->endSection();?>