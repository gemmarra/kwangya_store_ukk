<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to add new purchase</h5>
<form action="/purchase/update/<?=$detailpurchase[0]['purchase_id'];?>" method="post" enctype="multipart/form-data">
    <form-1>   
        <div class="input-group">
            <div>
                <input type="purchase_id" name="purchase_id" id="" value="<?=$detailpurchase[0]['purchase_id'];?>" hidden>
            </div>
        </div>
        <div class="input-group">
            <label for="datetime">Date & Time</label>
            <div>
                <input type="datetime-local" name="datetime" id="" value="<?=$detailpurchase[0]['datetime'];?>">
            </div>
        </div>
        <div class="input-group">
            <label for="expenditure_total">Expenditure Total</label>
            <div>
                <input type="text" name="expenditure_total" autocomplete="off" value="<?=$detailpurchase[0]['expenditure_total'];?>">
            </div>
        </div>
        <div class="input-group">
            <label for="">Receipt</label> <br><br>
            <label for="file-upload" class="custom-file-upload">
                <i class="bi bi-image"></i> Choose File
            </label> <br>
            <span id="file-name"></span>
            <input id="file-upload" type="file" name="receipt_image" value="<?=$detailpurchase[0]['receipt_image'];?>"><br><br>
            <div class="save">
                <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
            </div>
        </div>
    </form-1>
</form>

<?=$this->endSection();?>