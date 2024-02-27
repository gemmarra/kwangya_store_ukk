<?=$this->extend('layout');?>
<?=$this->section('content');?>


<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Modify this form below to edit old category</h5>
<form action="/category/update/<?=$detailcategory[0]['category_id'];?>" method="post">
        <div class="input-group">
            <label for="category_name">Category Name</label>
            <div>
                <input type="text" name="category_name" autocomplete="off" value="<?=$detailcategory[0]['category_name'];?>">
            </div>
            <br>
    <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
 </form>

<?=$this->endSection();?>