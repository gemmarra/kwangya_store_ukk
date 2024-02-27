<?=$this->extend('layout');?>
<?=$this->section('content');?>


<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Modify this form below to edit old denomination</h5>
<form action="/denomination/update/<?=$detaildenomination[0]['denomination_id'];?>" method="post">
        <div class="input-group">
            <label for="denomination_name">Denomination Name</label>
            <div>
                <input type="text" name="denomination_name" autocomplete="off" value="<?=$detaildenomination[0]['denomination_name'];?>">
            </div>
            <br>
    <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
 </form>

<?=$this->endSection();?>