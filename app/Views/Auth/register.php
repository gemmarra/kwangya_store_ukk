<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/faviocn/apple-touch-icon.png');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon/favicon-32x32.png');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/img/favicon/favicon-16x16.png');?>">
	<!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap/bootstrap-5.3.2/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.css'); ?>">
    <title>Diagon Crossing</title>
</head>
<body>
<div class="register-page">
<div class="form-container">
    <h1 class="logo">Diagon Crossing</h1>
	<p class="title"><?=lang('Auth.register')?></p>
    <p class="text-danger"><?= view('Myth\Auth\Views\_message_block') ?></p>
	<form action="<?= url_to('register') ?>" method="post" class="form">
        <?= csrf_field() ?>
        <div class="input-group">
            <label for="email"><?=lang('Auth.email')?></label>
            <input type="email" name="email" class="<?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                placeholder="johndoe@email.com" value="<?= old('email') ?>" autocomplete="off">
        </div>
        <div class="input-group">
            <label for="username"><?=lang('Auth.username')?></label>
            <input type="text" class="<?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>" autocomplete="off">
        </div>
        <div class="input-group">
        <label for="password"><?=lang('Auth.password')?></label>
        <input type="password" name="password" autocomplete="off" class="<?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
		</div> 
        <div class="input-group">
        <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
       <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
        </div>
        <br/>
		<button type="submit" class="sign"><?=lang('Auth.register')?></button>
	</form>
	<p class="signup">Already have an account?
		<a rel="noopener noreferrer" href="<?= url_to('login') ?>" class="text-light"><?=lang('Auth.signIn')?></a>
	</p>
</div>
</div>   
</body>
</html>