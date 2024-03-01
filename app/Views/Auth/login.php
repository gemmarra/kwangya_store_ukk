<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/favicon/apple-touch-icon.png');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon/favicon-32x32.png');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('/favicon-16x16.png');?>">
    <link rel="manifest" href="<?=base_url('assets/img/favicon/site.webmanifest');?>">
    <link rel="mask-icon" href="<?=base_url('assets/img/favicon/safari-pinned-tab.svg');?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="<?= base_url('assets/css/auth.css');?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<title>KWANGYA STORE</title>
</head>
<body>
    <div class="greeting">
        <h1>Hey there! Let's dive into <br>sales management.</h1>
        <p>Experience the ease of seamless transactions, <br>boosting your 
            efficiency and confidence in daily tasks.</p>
    </div>
    <main>
        <div class="card">
            <h2>Sign in</h2>
            <?php if(session()->getFlashdata('failmessage')): ?>
                <div><?= session()->getFlashdata('failmessage') ?></div>
            <?php endif; ?>
            <form action="<?=base_url('/login');?>" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <div>
                        <input type="email" name="email" required autocomplete="off">
                    </div>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <div>
                        <input type="password" name="password" required autocomplete="off">
                    </div>
                </div>
                <button type="submit">Sign in</button>
            </form>
        </div>
    </main>
</body>
</html>