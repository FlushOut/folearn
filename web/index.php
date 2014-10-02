<?php require_once("autoload2.php"); ?>
<?php require_once("config.php"); ?>
<?php

if (isset($_SESSION['loginsession'])) redirect("/pages/menu.php");

$country = new country();
$list_countries = $country->list_countries();

$errorUserPass = false;
$errorInternal = false;
$errorPayment = false;

if (isset($_POST['login_username'])) {
    if (count($_POST['login_username']) > 0) {
        $user = new user();
        $returnLogin = $user->login($_POST['login_username'], $_POST['login_password']);
        if ($returnLogin) {
            $company = new company();
            $company->open($returnLogin->fk_company);
            if($company->status_payment == 0) {
                $errorPayment = true;                
            } else {
                $status_conf = $returnLogin->status_conf;
                $id = $returnLogin->id;
                if ($status_conf == 1) {
                    $_SESSION['emailsession'] = $_POST['login_username'];
                    $_SESSION['loginsession'] = $id;
                    redirect("/pages/menu.php");    
                }else{
                    redirect("/pages/verifyemail.php?user=".$id);    
                }
            }
        } else {
            $errorUserPass = true;
        }
    }
}

if (isset($_POST['name'])) {
    if (count($_POST['name']) > 0) {
        $company = new company();
        $idCompany = $company->create($_POST['company'], $_POST['country']);
        if ($idCompany) {
            $user = new user();
            $idUser = $user->createAdmin($idCompany,$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password']);
            if($idUser){
                $response = $user->sendCode($idUser, $_POST['email']);
                if($response > 0){
                    redirect("/pages/verifyemail.php?user=".$idUser);        
                }else{
                    $errorInternal = true;        
                }
            }else{
                $errorInternal = true;    
            }        
        }else{
            $errorInternal = true;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Logn In | FOLearn</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet prefetch" type="text/css" />
        
        <!-- styles -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="css/stilearn.css" rel="stylesheet" />
        <link href="css/stilearn-responsive.css" rel="stylesheet" />
        <link href="css/stilearn-helper.css" rel="stylesheet" />
        <link href="css/stilearn-icon.css" rel="stylesheet" />
        <link href="css/font-awesome.css" rel="stylesheet" />
        <link href="css/animate.css" rel="stylesheet" />
        <link href="css/pricing-table.css" rel="stylesheet" />
        <link href="css/uniform.default.css" rel="stylesheet" />
        
        <link href="css/select2.css" rel="stylesheet" />
        <link href="css/bootstrap-wysihtml5.css" rel="stylesheet" />

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <?php
    if($errorUserPass){
    echo '<style type="text/css">
        div[name=errorUserPass] {
            display: block !important;
        }
        </style>';
    }else{
        echo '<style type="text/css">
            div[name=errorUserPass] {
                display: none !important;
            }
            </style>';
    }

    if($errorPayment){
        echo '<style type="text/css">
            div[name=errorPayment] {
                display: block !important;
            }
            </style>';
    }else{
        echo '<style type="text/css">
            div[name=errorPayment] {
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
                            <h2><a href="#"><span class="color-teal">fo</span>Learn</a></h2>
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
                    <!--Sign In-->
                    <div class="span5 offset1">
                        <div class="box corner-all">
                            <div class="box-header grd-teal color-white corner-top">
                                <span>Sign in:</span>
                            </div>
                            <div class="box-body bg-white">
                                <form id="sign-in" method="post" />
                                    <div class="control-group">
                                        <label class="control-label">Email</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, email:true, messages:{required:'Please enter field email',email:'Please enter valid email address'}}" name="login_username" id="login_username" autocomplete="on" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field password'}}" name="login_password" id="login_password" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" data-form="uniform" name="remember_me" id="remember_me_yes" value="yes" /> Remember me
                                        </label>
                                        <p class="recover-account">Not have an account yet? <a href="#modal-pricing" class="link" data-toggle="modal">See our plan!</a></p>
                                    </div>
                                    <div name="errorUserPass" class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Error!</strong> Incorrect email or password 
                                    </div>
                                    <div name="errorPayment" class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Error!</strong> Your company is disabled due payment
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-block btn-large btn-primary" value="Sign into account" />
                                        <p class="recover-account">Recover your <a href="#modal-recover" class="link" data-toggle="modal">password</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--/Sign In-->
                    <!--Sign Up-->
                    <div class="span5">
                        <div class="box corner-all">
                            <div class="box-header grd-green color-white corner-top">
                                <span>Create a free account for a month!</span>
                            </div>
                            <div class="box-body bg-white">
                                <form id="sign-up" method="post" />
                                    <div class="control-group">
                                        <label class="control-label" for="inputSelect">Country</label>
                                        <div class="controls">
                                            <select id="country" name="country" data-form="select2" style="width:200px" data-placeholder="Select your country">
                                             <?php   foreach($list_countries as $item){ ?>
                                                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>            
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Name</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field name'}}" name="name" id="name" autocomplete="off" />
                                            <p class="help-block muted helper-font-small">May contain letters, digits, dashes and underscores, and should be between 2 and 20 characters long.</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Email</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, email:true, remote:'/ajax/validateemail.php', messages:{required:'Please enter field email', email:'Please enter valid email address', remote:'This email is already in use'}}" name="email" id="email" autocomplete="off" />
                                            <p class="help-block muted helper-font-small"><strong>Type carefully.</strong> You will be sent a confirmation email.</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Phone</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, number:true, messages:{required:'Please enter field phone', number:'Please enter valid phone number'}}" name="phone" id="phone" autocomplete="off" />
                                            <p class="help-block muted helper-font-small">Contain digits only.</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Company</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field company'}}" name="company" id="company" autocomplete="off" />
                                            <p class="help-block muted helper-font-small">May contain letters, digits, dashes and underscores, and should be between 2 and 20 characters long.</p>
                                        </div>
                                    </div>
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
                                    <div class="control-group">
                                        <p class="term-of-use">Before registering please read the following <a href="#">terms of use</a> and <a href="#">privacy policy</a>.</p>
                                    </div>
                                    <div class="control-group">
                                        <label class="checkbox">
                                            <input type="checkbox" data-form="uniform" name="subscribe" id="subscribe_yes" value="yes" checked="" /> Sign me up for the newsletter
                                        </label>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-block btn-large btn-success" value="Create account" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--/Sign Up-->
                </div><!-- /row -->
            </div><!-- /container -->
            
            <!-- modal recover -->
            <div id="modal-recover" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-recoverLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="modal-recoverLabel">Reset password <small>Email Address</small></h3>
                </div>
                <div class="modal-body">
                    <form id="form-recover" method="post" />
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" data-validate="{required: true, email:true, messages:{required:'Please enter field email', email:'Please enter a valid email address'}}" name="recover" />
                                <p class="help-block helper-font-small">Enter your email address and we will send you a link to reset your password.</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <input type="submit" form="form-recover" class="btn btn-primary" value="Send reset link" />
                </div>
            </div><!-- /modal recover-->
            <!-- modal pricing -->
            <div id="modal-pricing" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-recoverLabel" aria-hidden="true" style="height:380px !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="modal-recoverLabel">It's too easy!</h3>
                </div>
                <div class="modal-body" style="height:350px !important;max-height:350px;">
                    <form id="form-recover" method="post" />
                        <ul class="thumbnails pricing-table color-white" style="margin-top: 5px;">
                            <li class="span4 grd-teal" style="width: 100%;margin: 0 auto;">
                                <h3>Only One</h3>
                                <div class="price-body bg-white color-teal">
                                    <div class="price">
                                        <span class="price-figure">5%</span>
                                        <span class="price-term">of Lesson value</span>
                                    </div>
                                </div>
                                <div class="footer grd-teal">
                                    <a href="#" class="btn btn-block btn-info" data-dismiss="modal" aria-hidden="true">Get Started</a>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div><!-- /modal recover-->
        </section>

        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/pricing-table/prefixfree.js"></script>
        <script src="js/uniform/jquery.uniform.js"></script>
        <script src="js/select2/select2.js"></script>
        
        <script src="js/validate/jquery.metadata.js"></script>
        <script src="js/validate/jquery.validate.js"></script>

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var tz = jstz.determine(); // Determines the time zone of the browser client
            var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.

            document.cookie="timezone="+timezone;

             // try your js
                
                // uniform
                $('[data-form=uniform]').uniform();

                 // select2
                $('[data-form=select2]').select2();

                
                // validate
                $('#sign-in').validate();
                $('#sign-up').validate();
                $('#form-recover').validate();
          });
        </script>
    </body>
</html>
