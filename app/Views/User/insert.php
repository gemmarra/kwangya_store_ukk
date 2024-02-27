<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to add new user</h5>
<form action="/user/save" method="post" enctype="multipart/form-data">
    <form-1>   
        <div class="input-group">
            <label for="email">Email</label>
            <div>
                <input type="text" name="email" required autocomplete="off">
                <span>
                <?php 
                    if(isset($validation)){
                        if ($validation->hasError("email")) {
                            ?>
                            <p class="error-form"><?php echo $validation->getError("email"); ?></p>
                            <?php
                        }
                    }
                ?>
            </span>
            </div>
        </div>
        <div class="input-group">
            <label for="name">Name</label>
            <div>
                <input type="text" name="name" required autocomplete="off">
            </div>
        </div>
        <div class="input-group">
                <label for="role">Role</label>
                <div>
                    <select name="role" id="">
                    <option value=""></option>
                    <option value="cashier">Cashier</option>
                    <option value="administrator">Administrator</option>
                    <option value="inventory_manager">Inventory Manager</option>
                    </select>
                </div>
            </div>
        </form-1>
        <form-2>
            <div class="input-group">
                <label for="password">Password</label>
                <div>
                <input type="password" name="password" required autocomplete="off">
                <span>
                <?php 
                    if(isset($validation)){
                        if ($validation->hasError("password")) {
                            ?>
                            <p class="error-form"><?php echo $validation->getError("password"); ?></p>
                            <?php
                        }
                    }
                ?>
            </span>
            </div>
        </div>
        <div class="input-group">
            <label for="confirmPassword">Confirm Password</label>
            <div>
                <input type="password" name="confirmPassword" required autocomplete="off">
                <span>
                    <?php 
                    if(isset($validation)){
                        if ($validation->hasError("confirmPassword")) {
                            ?>
                            <p class="error-form"><?php echo $validation->getError("confirmPassword"); ?></p>
                            <?php
                        }
                    }
                    ?>
            </span>
        </div>
    </div>
    <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button> <br/>
    </form-2>
</form>

<?=$this->endSection();?>