<?php
session_start();
include '../lib/Database.php';
$db = new Database();
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <title> Admin</title>
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
                <h1><span><strong>WellCome </strong></span>bdbet65.com</h1>
            </div>
            <div class="login-box">
                <form class="login-form" action="loginForm.php" method="post">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Admin Login</h3>
                    <div class="form-group">
                        <label class="control-label">USERNAME</label>
                        <input class="form-control" name="username" type="text"  placeholder="User Id" autofocus required="1">
                    </div>
                    <div class="form-group">
                        <label class="control-label">PASSWORD</label>
                        <input class="form-control" name="password" type="password" placeholder="Password" required="1" autofocus>
                    </div>
                    <div class="form-group">
                        <div class="utility">
                            <div class="animated-checkbox">
                                <label>
                                    <input type="checkbox" name="remember"><span class="label-text">Stay Signed in</span>
                                </label>
                            </div>
                            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
                        </div>
                    </div>
                    <div class="form-group btn-container">
                        <button name="login" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
                    </div>
                </form>
                <?php
                if (isset($_SESSION['message'])) {
                    ?>
                    <div id="errorSignIn" class="alert alert-danger errorSignIn" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>  <strong>  Opps !!</strong> <?php  echo $_SESSION['message'];?>!!
                    </div>
                    <?php
                   
                }
                unset($_SESSION['message']);
                ?>
                <form class="forget-form" action="index.html">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
                    <div class="form-group">
                        <label class="control-label">EMAIL</label>
                        <input class="form-control" type="text" placeholder="Email">
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
                    </div>
                    <div class="form-group mt-3">
                        <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
                    </div>
                </form>
            </div>
        </section>
    </body>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
</html>
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function () {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>