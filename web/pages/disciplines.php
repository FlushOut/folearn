<?php
require_once("../config.php");

$discAdd = false;
$discUpd = false;
$discDel = false;

$country = new country();
$country->open($company->fk_country);

$newUser = new user();

if ($_POST['action'] == 'Save') {
    if (isset($_POST['hdId'])) {
        $newUser->saveDiscplines($_POST['hdId'],$_POST['discPrice']);
        $discUpd = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Dashboard | FOLearn</title>
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
if($discAdd){
    echo '<style type="text/css">
        div[name=discAdded] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=discAdded] {
            display: none !important;
        }
        </style>';
}

if($discUpd){
    echo '<style type="text/css">
        div[name=discUpdated] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=discUpdated] {
            display: none !important;
        }
        </style>';
}

if($discDel){
    echo '<style type="text/css">
        div[name=discDeleted] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=discDeleted] {
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
                                <li><a href="#"><i class="icofont-home"></i> Disciplines</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        <!-- Modal Price-->
                        <div id="myModalPrice" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 320px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Price for Hour</h3>
                            </div>
                            <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td>Price (<? echo $country->currency ?>) </td>
                                            <td>
                                                <input name="hdPrice" id="hdPrice" type="hidden"/>
                                                <input type="text" class="grd-white input-medium" onKeyPress="return soloNumeros(event)" id="price" name="price" />
                                            </td>    
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><button class="btn" id="btnClose">Close</button>
                                            <button class="btn btn-primary" id="btnSave">Save</button></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <!-- content-body -->
                        <div class="content-body">
                            <form class="form-horizontal" action="" method="post" />
                                <div class="row-fluid" style="display: inline-flex;">
                                    <input name="hdId" type="hidden" value="<?php echo $user->id; ?>"/>
                                    <div class="span9">
                                        <!--box tab-->
                                        <div class="box-tab corner-all">
                                            <legend>Select the disciplines that you teach:</legend>
                                            <div class="tabbable tabs-left" id="dvDiscplines">
                                                <h4 style="text-align:center">Loanding...</h4>
                                            </div>
                                        </div><!--/box tab-->
                                    </div><!--/span-->
                                    <div class="span2">
                                        <p><button name="action" value="Save" class="btn btn-large btn-primary">Save</button></p>
                                    </div><!--/span-->
                                </div><!--/row-fluid-->
                            </form>
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

                var currency = '<? echo $country->currency; ?>';
                window.setTimeout(function() {
                    $("div[name=discAdded]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=discUpdated]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=discDeleted]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 2000);

                var lbl = null;
                var ipt = null;
                var blnSave = false;
                $("input:checkbox[name='discPrice[]']").live("change", function () {
                    blnSave = false;
                    lbl = $(this).parent("label");
                    ipt = $(this);
                    if ($(this).is(':checked')) {
                        $('#price').val('');
                        $('#myModalPrice').modal('show');
                    } else {
                        var discTxt = null;
                        var discVal = null;
                        discTxt = lbl.text().split(' - ')[0];
                        discVal = ipt.val().split(' - ')[0];
                        ipt.val(discVal);
                        lbl.html(discTxt);
                        lbl.append(ipt);
                    }
                });

                $('#btnSave').bind('click',function(){
                    blnSave = true;
                    if($('#price').val().trim().length > 0){
                        var discTxt = null;
                        var discVal = null;
                        discTxt = lbl.text()+' -  ('+currency+') '+$('#price').val();
                        discVal = ipt.val()+' - '+$('#price').val();
                        ipt.val(discVal);
                        lbl.html(discTxt);
                        lbl.append(ipt);
                    }else{
                        ipt.attr('checked', false);
                    }
                    $('#myModalPrice').modal('hide');
                });

                $('#btnClose').bind('click',function() {
                    blnSave = false;
                    $('#price').val('');
                    ipt.attr('checked', false);
                    $('#myModalPrice').modal('hide');
                });
                $('#myModalPrice').on('hide',function() {
                    if($('#price').val().trim().length <= 0 || blnSave == false)
                        ipt.attr('checked', false);
                }).on('hidden', function() {
                    if($('#price').val().trim().length <= 0 || blnSave == false)
                        ipt.attr('checked', false);
                });

                // uniform
                $('[data-form=uniform]').uniform();

                var idUser = <?php echo $_SESSION['loginsession'] ?>;
                var action = "getDisciplinesUser";
                jQuery.ajax({
                    url: "/ajax/actions.php",
                    type: "POST",
                    data: {id: idUser, action: action }
                }).done(function (resp) {
                        $("#dvDiscplines").html(resp);
                    });
                
            });
      
        </script>
    </body>
</html>
