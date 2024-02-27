<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="form-wrapper">
    <h3 class="text-light">Add Product</h3> <br>
    <p class="text-danger"><?= $validation->listErrors(); ?></p>
    <form action="/category/save" method="post" enctype="multipart/form-data">
        <div class="form-1">
        <div class="input-group input-flex">
            <label for="product_id" class="form-label">Product ID</label>
            <div>
                <input type="text" autocomplete="off" placeholder="" name="product_id">
            </div>
            <p class="text-danger"><?= $validation->getError('product_id'); ?></p>
        </div>
        <div class="input-group input-flex">
            <label for="product_id" class="form-label">Name</label>
            <div>
                <input type="text" autocomplete="off" placeholder="" name="product_name">
            </div>
        </div>
        <div class="form-side">
        <div class="input-group input-flex">
            <label for="product_id" class="form-label">Stock</label>
            <div>
                <input type="text" autocomplete="off" placeholder="" name="stock">
            </div>
        </div>
        <div class="input-group input-flex">
            <label for="product_id" class="form-label">Denomination</label>
            <div>
                <select name="denomination" id="" class="form-select">
                    <option value=""></option>
                    <?php
                        foreach($DenominationList as $row){
                        echo '<option value="'.$row['denomination_id'].'">'.$row['denomination_name'].'</option>';  
                        }
                    ?>
                </select>
            </div>
        </div>
        </div>
        </div>
    </form>
</div>

<?=$this->endSection();?>