<?php 
$ve = true;
require_once("../config.php");

$error = false;

if (isset($_GET['user'])) {
    $u = $_GET['user'];
}
if (isset($_GET['code'])) {
    $c = $_GET['code'];
}

if (isset($_POST['password'])) {
    $user = new user();
    if($u){
        $uvc = $user->resetPassword($u, $c, ($_POST['password']));
        if ($uvc) {
            $_SESSION['emailsession'] = $uvc->email;
            $_SESSION['loginsession'] = $uvc->id;
            redirect("/pages/menu.php");
        } else {
                $error = true;
        }
    } else {
        $error = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8" />
        <title>Reset Password | FOLearn</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet prefetch" type="text/css" />
        
        <!-- styles -->
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn.css" rel="stylesheet" />
        <link href="../css/stilearn-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn-helper.css" rel="stylesheet" />
        <link href="../css/stilearn-icon.css" rel="stylesheet" />
        <link href="../css/font-awesome.css" rel="stylesheet" />
        <link href="../css/animate.css" rel="stylesheet" />
        <link href="../css/pricing-table.css" rel="stylesheet" />
        <link href="../css/uniform.default.css" rel="stylesheet" />
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <?php
    if($error){
        echo '<style type="text/css">
            div[name=errorResetPass] {
                display: block !important;
            }
            </style>';
    }else{
        echo '<style type="text/css">
            div[name=errorResetPass] {
                display: none !important;
            }
            </style>';
    }
    ?>
    <body>
        <!-- section header -->
        <header class="header" data-spy="affix" data-offset-top="0">
            <!--nav bar helper-->
            <div class="navbar-helper">
                <div class="row-fluid">
                    <!--panel site-name-->
                    <div class="span2">
                        <div class="panel-sitename">
                            <h2><a href="index.html"><span class="color-teal">fo</span>Learn</a></h2>
                        </div>
                    </div>
                    <!--/panel name-->
                </div>
            </div><!--/nav bar helper-->
        </header>
        
        <!-- section content -->
        <section class="section">
            <div class="container">
                <div class="signin-form row-fluid">
                    <!--Reset Pass-->
                    <div class="span4 offset4">
                        <div class="box corner-all">
                            <div class="box-header grd-teal color-white corner-top">
                                <span>Reset your password:</span>
                            </div>
                            <div class="box-body bg-white">
                                <form id="reset-password" method="post">
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" class="input-block-level" data-validate="{required: true, minlength: 6, messages:{required:'Please enter field password', minlength:'Please enter at least 6 characters'}}" name="password" id="password" autocomplete="off" />
                                            <p class="help-block muted helper-font-small">The longer the better. Include numbers for protein.</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password Again</label>
                                        <div class="controls">
                                            <input type="password" class="input-block-level" data-validate="{required: true, equalTo: '#password', messages:{required:'Please enter field confirm password', equalTo: 'confirmation password does not match the password'}}" name="password_again" id="password_again" autocomplete="off" />
                                            <p class="help-block muted helper-font-small">Enter your password again.</p>
                                        </div>
                                    </div>
                                    <div name="errorResetPass" class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Error!</strong> The user did not request password change
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-block btn-large btn-primary" value="Reset" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--/Reset Pass-->
                </div><!-- /row -->
            </div><!-- /container -->

        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/pricing-table/prefixfree.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>
        
        <script src="../js/validate/jquery.metadata.js"></script>
        <script src="../js/validate/jquery.validate.js"></script>

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var tz = jstz.determine(); // Determines the time zone of the browser client
            var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.

            document.cookie="timezone="+timezone;

             // try your js
                
                // uniform
                $('[data-form=uniform]').uniform();
                
                // validate
                $('#reset-password').validate();
          });
        </script>
    </body>
</html>
