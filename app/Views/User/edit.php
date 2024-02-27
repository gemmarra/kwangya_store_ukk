<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to add new user</h5>
<form action="/user/update/<?=$detailuser[0]['email'];?>" method="post" enctype="multipart/form-data">
    <form-1>   
        <div class="input-group">
            <label for="email">Email</label>
            <div>
                <input type="text" name="email" autocomplete="off" value="<?=$detailuser[0]['email'];?>">
            </div>
        </div>
        <div class="input-group">
            <label for="name">Name</label>
            <div>
                <input type="text" name="name" autocomplete="off" value="<?=$detailuser[0]['name'];?>">
            </div>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <div>
                <input type="password" name="password" autocomplete="off" value="<?=$detailuser[0]['password'];?>">
            </div>
        </div>
        <div class="input-group">
                <label for="role">Role</label>
                <div>
                <select name="role" id="">
    <option value=""></option>
    <option value="cashier" <?php echo ($detailuser[0]['role'] == "cashier") ? "selected" : ""; ?>>Cashier</option>
    <option value="administrator" <?php echo ($detailuser[0]['role'] == "administrator") ? "selected" : ""; ?>>Administrator</option>
    <option value="inventory_manager" <?php echo ($detailuser[0]['role'] == "inventory_manager") ? "selected" : ""; ?>>Inventory Manager</option>
</select>

                </div>
            </div>
            <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button>
    </form-1>
</form>

<?=$this->endSection();?>