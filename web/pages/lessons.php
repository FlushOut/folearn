<?php
require_once("../config.php");
verify_access($list_modules);

$lessApr = false;
$lessRej = false;

$lesson = new lesson();
$list_pend_lessons = $lesson->list_pend_lessons($user->id);

if ($_POST['action'] == 'Eval') {
    if (isset($_POST['hdIdAR'])) {
        $lesson->change_status($_POST['hdIdAR'],$_POST['hdEval'],$_POST['obs']);
        if($_POST['hdEval'] == '2'){
            $lessApr = true;
        }else if($_POST['hdEval'] == '3'){
            $lessRej = true;
        }
    $list_pend_lessons = $lesson->list_pend_lessons($user->id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Lessons | FOLearn</title>
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
if($lessApr){
    echo '<style type="text/css">
        div[name=lessApproved] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=lessApproved] {
            display: none !important;
        }
        </style>';
}

if($lessRej){
    echo '<style type="text/css">
        div[name=lessRejected] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=lessRejected] {
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
                                <li><a href="#"><i class="icofont-home"></i> Lessons</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div name="lessApproved" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> The lesson was Approved
                            </div>
                            <div name="lessRejected" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> The lesson was Rejected
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Pending Lessons&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <!-- Modal Hours-->
                                            <div id="myModalHours" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 200px;margin-left: -90px;margin-top: 100px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3 id="myModalLabel">Hours</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="control-group">
                                                        <div class="controls">Loanding...</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                </div>
                                            </div>
                                            <!-- Modal Client Data-->
                                            <div id="myModalClient" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left: -120px;margin-top: 100px;width: 350px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3 id="myModalLabel">Client Data</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="control-group">
                                                        <div class="controls" id="dvClient">Loanding...</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                </div>
                                            </div>
                                            <!-- Modal Question-->
                                            <div id="myModalQuestion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left: -120px;margin-top: 100px;width: 280px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3 id="myModalLabel">Lessons</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                        <div class="control-group">
                                                            <input name="hdIdAR" id="hdIdAR" type="hidden"/>
                                                            <input name="hdEval" id="hdEval" type="hidden"/>
                                                            <label class="control-label" id="lblQuestion"></label>
                                                            <textarea id="obs" name="obs" class="form-control" rows="3" placeholder="Enter the reason ..."></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button class="btn" id="btnAR" form="form-validate" name="action" value="Eval"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">#</th>
                                                        <th class="head1">Date</th>
                                                        <th class="head0">Client</th>
                                                        <th class="head1">Discipline</th>
                                                        <th class="head0">Hours</th>
                                                        <th class="head1">Price for Hour</th>
                                                        <th class="head1">Total Value</th>
                                                        <th class="head0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_pend_lessons as $item) { ?>
                                                        <tr src="lesson">
                                                            <td><?php echo $item->id; ?><input name="hdId" type="hidden" value="<?php echo $item->id; ?>"/><input name="hdIdMob" type="hidden" value="<?php echo $item->fk_mobile; ?>"/><input name="hdIdCli" type="hidden" value="<?php echo $item->fk_client; ?>"/></td>
                                                            <td><?php echo $item->date; ?></td>
                                                            <td><a href="#myModalClient" role="button" class="btn btn-link" data-toggle="modal" id="aClient"><?php echo $item->client; ?></a></td>
                                                            <td><?php echo $item->discipline; ?></td>
                                                            <td><a href="#myModalHours" role="button" class="btn btn-link" data-toggle="modal" id="aHours"><?php echo $item->hours; ?></a></td>
                                                            <td>(<?php echo $item->currency; ?>) <?php echo $item->price_hour_user; ?></td>
                                                            <td>(<?php echo $item->currency; ?>) <?php echo $item->value_total_user; ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                <a href="#myModalQuestion" role="button" class="btn btn-small btn-primary" data-toggle="modal" id="aAppr">Approve</a>
                                                                <a href="#myModalQuestion" role="button" class="btn btn-small btn-danger" data-toggle="modal" id="aReje">Reject</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /box-body -->
                                    </div><!-- /box -->
                                </div><!-- /span -->
                            </div><!--/datatables-->
                            <!--/tables-->
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
                    $("div[name=lessApproved]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=lessRejected]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 2000);
                
                // uniform
                $('[data-form=uniform]').uniform();

                // Approve lesson
                $("a#aAppr").bind('click', function () {
                    var id;
                    jQuery(this).parents('tr').map(function () {
                        id = jQuery('input[name="hdId"]', this).val();
                    });

                    $("#lblQuestion").show();
                    $("#lblQuestion").empty();
                    $("#lblQuestion").append("Are you sure?");
                    $("#obs").val('');
                    $("#obs").hide();
                    $("#hdIdAR").val(id);
                    $("#hdEval").val('2');
                    $("#btnAR").removeClass().addClass("btn btn-primary");
                    $("#btnAR").text('Approve');
                });

                // Reject lesson
                $("a#aReje").bind('click', function () {
                    var id;
                    jQuery(this).parents('tr').map(function () {
                        id = jQuery('input[name="hdId"]', this).val();
                    });

                    $("#lblQuestion").hide();
                    $("#obs").val('');
                    $("#obs").show();
                    $("#hdIdAR").val(id);
                    $("#hdEval").val('3');
                    $("#btnAR").removeClass().addClass("btn btn-danger");
                    $("#btnAR").text('Reject');
                });

                //Edit Profile users
                $('a#aHours').bind('click',function(){
                    $(".controls").html('Loanding...');
                    jQuery(this).parents('tr').map(function () {
                        var idCli = jQuery('input[name="hdIdCli"]', this).val();
                        var idMob = jQuery('input[name="hdIdMob"]', this).val();
                        var action = "getLessonDetails";

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: idCli, idMob:idMob , action: action }
                        }).done(function (resp) {
                                $(".controls").html(resp);
                            });
                    });
                    return true;
                }); 

                //Client Data
                $('a#aClient').bind('click',function(){
                    $("#dvClient").html('Loanding...');
                    jQuery(this).parents('div').map(function () {
                        var idCli = jQuery('input[name="hdIdCli"]', this).val();
                        var action = "getClientData";

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: idCli, action: action }
                        }).done(function (resp) {
                                $("#dvClient").html(resp);
                            });
                    });
                    return true;
                });

                // datatables
                $('#datatables').dataTable( {
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                            "sLengthMenu": "_MENU_ records per page"
                    }
                });
                
                // datatables table tools
                $('#datatablestools').dataTable({
                    "sDom": "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "oTableTools": {
                        "aButtons": [
                            "copy",
                            "print",
                            {
                                "sExtends":    "collection",
                                "sButtonText": 'Save <span class="caret" />',
                                "aButtons":    [ 
                                    "xls", 
                                    "csv",
                                    {
                                        "sExtends": "pdf",
                                        "sPdfOrientation": "landscape",
                                        "sPdfMessage": "Your custom message would go here."
                                    }
                                ]
                            }
                        ],
                        "sSwfPath": "../js/datatables/swf/copy_csv_xls_pdf.swf"
                    }
                });
            });
      
        </script>
    </body>
</html>
