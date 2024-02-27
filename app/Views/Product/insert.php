<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to add new product</h5>
<form action="/product/save" method="post" enctype="multipart/form-data">
    <form-1>   
        <div class="input-group">
            <label for="product_id">Product ID</label>
            <div>
                <input type="text" name="product_id" required autocomplete="off">
                <span>
                    <?php 
                        if(isset($validation)){
                            if ($validation->hasError("product_id")) {
                                ?>
                                <p class="error-form"><?php echo $validation->getError("product_id"); ?></p>
                                <?php
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="input-group">
            <label for="product_name">Product Name</label>
            <div>
                <input type="text" name="product_name" required autocomplete="off">
                <span>
                    <?php 
                        if(isset($validation)){
                            if ($validation->hasError("product_name")) {
                                ?>
                                <p class="error-form"><?php echo $validation->getError("product_name"); ?></p>
                                <?php
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="input-group">
            <label for="category">Category</label>
            <div>
                <select name="category" id="" required>
                <option value=""></option>
                    <?php
                        foreach($CategoryList as $row){
                        echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';  
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-side">
        <div class="input-group">
            <label for="stock">Stock</label>
            <div>
                <input type="text" name="stock" required autocomplete="off">
                <span>
                    <?php 
                        if(isset($validation)){
                            if ($validation->hasError("stock")) {
                                ?>
                                <p class="error-form"><?php echo $validation->getError("stock"); ?></p>
                                <?php
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="input-group">
            <label for="denomination">Denomination</label>
            <div>
            <select name="denomination" id="" required>
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
    </form-1> 
    <form-2>
        <div class="input-group">
            <label for="selling_price">Selling Price</label>
            <div>
                <input type="text" name="selling_price" required autocomplete="off" class="money" data-mask="000.000.000.000.000">
                <span>
                    <?php 
                        if(isset($validation)){
                            if ($validation->hasError("selling_price")) {
                                ?>
                                <p class="error-form"><?php echo $validation->getError("selling_price"); ?></p>
                                <?php
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="input-group">
            <label for="purchase_price">Purchase Price</label>
            <div>
                <input type="text" name="purchase_price" required autocomplete="off" class="money" data-mask="000.000.000.000.000">
                <span>
                    <?php 
                        if(isset($validation)){
                            if ($validation->hasError("purchase_price")) {
                                ?>
                                <p class="error-form"><?php echo $validation->getError("purchase_price"); ?></p>
                                <?php
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
    </form-2>
</form>

<?=$this->endSection();?>