<?php 
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We ddevelop creative software, eye catching software. We also train to become a creative thinker">
    <meta name="author" content="OPTIMUM LINKUP COMPUTERS">
    <link rel="icon" sizes="16x16" href="<?php echo base_url(); ?>uploads/logo.png">
    <title>Acharya English Medium School | <?php echo get_phrase('login');?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/style.css?v=2" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/colors/megna.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <br><br><br>
            <div class="white-box">
                <h4 class="box-title m-b-20" align="center">
                    <img src="<?php echo base_url(); ?>uploads/logo.png" width="35%" height="35%" /></h4>
                <h5 align="center"><a href="">ACHARYA ENGLISH MEDIUM SCHOOL &amp; JR.COLLEGE, BARAMATI</a></h5>

                <br><br>

                <?php if (isset($login_lock_remaining) && $login_lock_remaining > 0): ?>
                <div class="alert alert-danger text-center" role="alert" style="font-size:13px;">
                    <strong>Too many failed attempts.</strong><br>
                    Login disabled for <span id="lock_timer"><?php echo (int)$login_lock_remaining; ?></span> seconds.
                </div>
                <?php endif; ?>

                <form method="post" role="form" id="loginform" class="form-horizontal form-material" action="<?php echo base_url();?>login/validate_login">

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" name="email" required="" placeholder="Email" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password" style="width:100%">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember Me </label>

                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot Password?</a>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">

                            <button class="btn btn-success btn-rounded btn-sm btn-block text-uppercase" type="submit" style="width:100%; color:white">
Log In</button>
                            <div align="center"><img id="install_progress" src="<?php echo base_url(); ?>assets/images/preloader.gif" style="margin-left: 20px; display: none" /></div>

                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br>
                </form>
                <form method="post" role="form" id="recoverform" class="form-horizontal form-material" action="<?php echo base_url(); ?>login/reset_password">
                    <input type="email" name="email" class="form-control" placeholder="Email" style="width:100%" required>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-6">
                            <a href="<?php echo base_url(); ?>"><button class="btn btn-success btn-rounded btn-sm text-uppercase" type="button" style="color:white"><i class="fa fa-mail-reply-all"></i>&nbsp;Back To Login</button></a>
                            <button class="btn btn-success btn-rounded btn-sm  text-uppercase" type="submit" style="color:white"><i class="fa fa-key"></i>&nbsp;Reset Password</button>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                </form>
            </div>
        </div>

    </section>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>


    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>optimum/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/js/jquery.toast.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/security.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        var lockRemaining = <?php echo isset($login_lock_remaining) ? (int)$login_lock_remaining : 0; ?>;
        if (lockRemaining > 0) {
            $('#loginform input, #loginform button, #loginform a').prop('disabled', true);
            var lockTimer = setInterval(function () {
                lockRemaining--;
                if ($('#lock_timer').length) $('#lock_timer').text(lockRemaining);
                if (lockRemaining <= 0) {
                    clearInterval(lockTimer);
                    window.location.reload();
                }
            }, 1000);
        }
    });
    </script>

    <?php if (($this->session->flashdata('error_message')) != ""): ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $.toast({
            text: '<?php echo $this->session->flashdata('error_message'); ?>',
            position: 'top-right',
            loaderBg: '#f56954',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        })
    });
    </script>
    <?php endif; ?>

</body>

</html>
