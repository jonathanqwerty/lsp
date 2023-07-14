<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/auth/login.css'); ?>">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="tools">
                <div class="circle">
                    <span class="red box"></span>
                </div>
                <div class="circle">
                    <span class="yellow box"></span>
                </div>
                <div class="circle">
                    <span class="green box"></span>
                </div>
            </div>
            <div class="card__content">
                <h2>Login</h2>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert error"><?php echo session()->getFlashdata('error'); ?></div>
                <?php endif; ?>
                <form method="POST" action="<?php echo base_url('process-login'); ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <span>
                            <input type="text" name="username" id="username" required>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <span>
                            <input type="password" name="password" id="password" required>
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit">Login</button>
                    </div>
                </form>
                <div class="signup">
                    Don't have an account? <a href="<?php echo base_url('register'); ?>">Sign up</a>
                </div>
            </div>
        </div>


    </div>

</body>

</html>