<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/style.css'); ?>">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert success"><?php echo session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        <form method="POST" action="<?php echo base_url('process-register'); ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>

</html>