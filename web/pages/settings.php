<?php
require_once("../config.php");
verify_access($list_modules);

$settUpd = false;

$company->open($company->id);

if ($_POST['action'] == 'SaveCompany') {
     if (isset($_POST['txtCompanyName'])){
        $company->save($_POST['txtCompanyName'], $_FILES["txtCompanyLogo"]["tmp_name"],$_FILES["txtCompanyLogo"]["type"]);
        $company->open($company->id);
        $settUpd = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Settings | FOLearn</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet" type="text/css" />

        <!-- styles -->
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn.css" rel="stylesheet" />
        <link href="../css/stilearn-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn-helper.css" rel="stylesheet" />
        <link href="../css/stilearn-icon.css" rel="stylesheet" />
        <link href="../css/font-awesome.css" rel="stylesheet" />
        <link href="../css/animate.css" rel="stylesheet" />
        <link href="../css/uniform.default.css" rel="stylesheet" />
        
        <link href="../css/jquery.pnotify.default.css" rel="stylesheet" />
        <link href="../css/DT_bootstrap.css" rel="stylesheet" />
        <link href="../css/responsive-tables.css" rel="stylesheet" />
        
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script> <!-- this for sliders-->     
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<?php
if($settUpd){
    echo '<style type="text/css">
        div[name=settUpdated] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=settUpdated] {
            display: none !important;
        }
        </style>';
}

?>
    <body>
        <!-- start header -->
        <?php include("../includes/_header.php"); ?>
        <!-- end header -->


        <!-- section content -->
        <section class="section">
            <div class="row-fluid">

                <!-- start left_menu -->
                <?php include("../includes/_left_menu.php"); ?>
                <!-- end left_menu -->
                
                <!-- span content -->
                <div class="span11">
                    <!-- content -->
                    <div class="content">
                        <!-- start left_menu -->
                        <?php include("../includes/_header_users.php"); ?>
                        <!-- end left_menu -->
                        
                        <!-- content-breadcrumb -->
                        <div class="content-breadcrumb">
                            <!--breadcrumb-->
                            <ul class="breadcrumb">
                                <li><a href="#"><i class="icofont-home"></i> Settings</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        <!-- content-body -->
                        <div class="content-body">
                        	<div name="settUpdated" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your settings was updated
                            </div>
                            <!-- form -->
                            <div class="row-fluid">
                                <div class="span12">
                                    
                                    <!-- =========================================
                                                        ELEMENT
                                    =========================================== -->
                                    <!--element-->
                                    <div id="element" class="row-fluid">
                                        <!--span-->
                                        <div class="span12">
                                            <!--box-->
                                            <div class="box corner-all">
                                                <!--box header-->
                                                <div class="box-header grd-white color-silver-dark corner-top">
                                                    <div class="header-control">
                                                        <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                        <a data-box="close">&times;</a>
                                                    </div>
                                                    <span>Settings</span>
                                                </div><!--/box header-->
                                                <!--box body-->
                                                <div class="box-body">
                                                    <!--element-->
                                                    <form class="form-horizontal" id="form-validate-company" action="" method="post"/>
                                                        <div class="control-group">
                                                            <label class="control-label" for="txtCompanyName">Company Name</label>
                                                            <div class="controls">
                                                                <input  type="text" id="txtCompanyName" name="txtCompanyName" data-validate="{required: true, messages:{required:'Please enter field required'}}" class="grd-white" value="<?php echo $company->name ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group" style="display:none;">
                                                            <label class="control-label" for="txtCompanyLogo">Company Logo</label>
                                                            <div class="controls">
                                                                <input type="file" id="txtCompanyLogo" name="txtCompanyLogo" class="smallinput" accept="image/*" value=""/>
                                                                <span style="color:#999;" class="helper-font-small">Logo of company</span>
                                                                <span class="field">
                                    								<?php echo '<p><img src="data:'.$company->logo_type.';base64,' . base64_encode( $company->logo ) . '" width="150px" height="60px" /></p>'; ?>
                                								</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions">
                                                            <button type="submit" class="btn btn-primary" id="btnSaveCompany" name="action" value="SaveCompany">Save</button>
                                                        </div>
                                                    </form>
                                                    <!--/element-->
                                                </div><!--/box body-->
                                            </div><!--/box-->
                                        </div><!--/span--> 
                                    </div><!--/element-->
                                </div> <!--/span12-->
                            </div> <!--/row-fluid-->
                        </div><!--/content-body -->
                    </div><!-- /content -->
                </div><!-- /span content -->
                
                <!-- start right_menu -->
                <?php include("../includes/_right_menu.php"); ?>
                <!-- end right_menu -->

            </div>
        </section>

        <!-- start left_menu -->
        <?php include("../includes/_footer.php"); ?>
        <!-- end left_menu -->


        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>

        <script src="../js/pnotify/jquery.pnotify.js"></script>
        <script src="../js/pnotify/jquery.pnotify.demo.js"></script>

        <script src="../js/validate/jquery.validate.js"></script>
        <script src="../js/validate/jquery.metadata.js"></script>
        
        <script src="../js/datatables/jquery.dataTables.min.js"></script>
        <script src="../js/datatables/extras/ZeroClipboard.js"></script>
        <script src="../js/datatables/extras/TableTools.min.js"></script>
        <script src="../js/datatables/DT_bootstrap.js"></script>
        <script src="../js/responsive-tables/responsive-tables.js"></script>
        
        <!-- required stilearn template js, for full feature-->
        <script src="../js/holder.js"></script>
        <script src="../js/stilearn-base.js"></script>     
        <script type="text/javascript">
            $(document).ready(function() {
                // try your js
                window.setTimeout(function() {
                    $("div[name=settUpdated]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 2000);
            });
      
        </script>
    </body>
</html>
