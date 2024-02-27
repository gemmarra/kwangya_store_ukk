<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to edit user's password</h5>
<form action="/user/update_password/<?=$detailuser[0]['email'];?>" method="post" enctype="multipart/form-data">
<form-1>
            <div class="input-group">
                <div>
                <input type="password" name="old_password_1" required autocomplete="off" hidden value="<?=$detailuser[0]['password'];?>">
                <span>
            </span>
            </div>
        </div>
        <div class="input-group">
            <label for="confirmPassword">Old Password</label>
            <div>
                <input type="password" name="old_password_2" required autocomplete="off" placeholder="Type the old password here">
                <span>
                    <?php 
                    if(isset($validation)){
                        if ($validation->hasError("old_password_2")) {
                            ?>
                            <p class="error-form"><?php echo $validation->getError("old_password_2"); ?></p>
                            <?php
                        }
                    }
                    ?>
            </span>
        </div>
    </div>
        <div class="input-group">
            <label for="confirmPassword">New Password</label>
            <div>
                <input type="password" name="new_password" required autocomplete="off">
                <span>
                    <?php 
                    if(isset($validation)){
                        if ($validation->hasError("new_password")) {
                            ?>
                            <p class="error-form"><?php echo $validation->getError("new_password"); ?></p>
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
                <input type="password" name="confirmPassword" required autocomplete="off" placeholder="Repeat Password">
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
    <button type="submit" class="btn"><i class="bi bi-floppy"></i> Save</button> <br/><br>
    </form-1>
</form>

<?=$this->endSection();?>