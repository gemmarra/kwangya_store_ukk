<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to add new purchase</h5>
<form action="/purchase/save" method="post" enctype="multipart/form-data">
    <form-1>   
        <div class="input-group">
            <label for="datetime">Date & Time</label>
            <div>
                <input type="datetime-local" name="datetime" id="" required>
            </div>
        </div>
        <div class="input-group">
            <label for="expenditure_total">Expenditure Total</label>
            <div>
                <input type="text" name="expenditure_total" autocomplete="off" required class="money" data-mask="000.000.000.000.000">
                <span>
                    <?php 
                        if(isset($validation)){
                            if ($validation->hasError("expenditure_total")) {
                                ?>
                                <p class="error-form"><?php echo $validation->getError("expenditure_total"); ?></p>
                                <?php
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="input-group">
            <label for="">Receipt</label> <br><br>
            <label for="file-upload" class="custom-file-upload">
                <i class="bi bi-image"></i> Choose File
            </label> <br>
            <span id="file-name"></span>
            <span>
                <?php 
                    if(isset($validation)){
                        if ($validation->hasError("receipt_image")) {
                            ?>
                            <p class="error-form"><?php echo $validation->getError("receipt_image"); ?></p>
                            <?php
                        }
                    }
                ?>
            </span>
            <input id="file-upload" type="file" name="receipt_image"><br><br>
            <div class="save">
                <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
            </div>
        </div>
    </form-1>
</form>

<?=$this->endSection();?>