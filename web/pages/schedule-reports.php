<?php
require_once("../config.php");

$list_users = $user->list_users($company->id);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Schedule Reports | FOLearn</title>
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
        
        <link href="../css/datepicker.css" rel="stylesheet" />
        <link href="../css/select2.css" rel="stylesheet" />

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
    <style type="text/css">
        #column1-wrap {
            float: left;
            width: 100%;
        }
        #column1 {
            margin-right: 200px;
        }
        #column2 {
            float: left;
            width: 200px;
            margin-left: -200px;
        }
        #clear {
            clear: both;
        }
    </style>
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
                                <li><a href="index.html"><i class="icofont-home"></i> Schedule Reports</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div name="noInfo" class="alert" style="display:none">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Info!</strong> You no have information
                            </div>
                            <!-- Modal Schedule Details-->
                            <div id="myModalScheduleDetails" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel">Hours</h3>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="form-validate" action="" method="post" />
                                        <input name="hdIdUser" id="hdIdUser" type="hidden"/>
                                        <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                        <input name="hdDate" id="hdDate" type="hidden"/>
                                        <div class="control-group">
                                            <div id="dvHours" class="controls" style="margin-left: 100px !important;">
                                            </div>
                                        </div>
                                        <p align="center">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Schedule Reports</span>
                                        </div>
                                        <div class="box-body">
                                            <div class="control-group">
                                                <div class="controls form-inline" style="text-align:center;">
                                                    <label class="control-label" for="ismUsers">Users</label>
                                                    &nbsp;
                                                    <select id="ismUsers" data-form="select2" style="width:200px" data-placeholder="Select users..." multiple="">
                                                        <?php foreach ($list_users as $item) { ?>
                                                        <option value="<?php echo $item->id; ?>"/><?php echo $item->name; ?>
                                                        <?php }?>
                                                    </select>
                                                    &nbsp;
                                                    <button type="button" class="btn" id="btnClearUsers" name="btnClearUsers">Clear</button>
                                                    &nbsp;
                                                    From &nbsp;
                                                    <div id="dvFrom" name ="dvFrom" class="input-append date" data-form="datepicker" data-date-format="dd-mm-yyyy" style="width:150px">
                                                        <input id="inFrom" name ="inFrom" class="grd-white" data-form="datepicker" size="16" type="text" style="width:100px"/>
                                                        <span class="add-on"><i class="icon-th"></i></span>
                                                    </div>
                                                    To &nbsp;
                                                    <div id="dvTo" name="dvTo" class="input-append date" data-form="datepicker" data-date-format="dd-mm-yyyy" style="width:150px">
                                                        <input id="inTo" name="inTo" class="grd-white" data-form="datepicker" size="16" type="text" style="width:100px"/>
                                                        <span class="add-on"><i class="icon-th"></i></span>
                                                    </div>
                                                    &nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary" id="bntShow">Show</button>
                                                </div>
                                            </div>
                                            <div class="divider-content"><span></span></div>
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">User</th>
                                                        <th class="head1">Date</th>
                                                        <th class="head0">Month</th>
                                                        <th class="head1">Day</th>
                                                        <th class="head0">Hours</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <tr src="schedule-report">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
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

        <script src="../js/datepicker/bootstrap-datepicker.js"></script>
        <script src="../js/select2/select2.js"></script>
        
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

                $('#form-validate').validate();
                
                // uniform
                $('[data-form=uniform]').uniform();

                // select2
                $('[data-form=select2]').select2();

                jQuery("label.checkbox").each(function () {
                if (jQuery("input", this).attr("checked") == 'checked') jQuery(this).addClass("checked");
                });

                // datepicker
                $('[data-form=datepicker]').datepicker({format:'dd-mm-yyyy'});

                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth()+1;
                var day = d.getDate();
                var startDate = ((''+day).length<2 ? '0' : '') + day +'-'+ 
                                ((''+month).length<2 ? '0' : '') + month +'-'+  
                                year; 

                $('#dvFrom').data({date: startDate}).datepicker('update').children("input").val(startDate);
                $('#dvTo').data({date: startDate}).datepicker('update').children("input").val(startDate);

                $("#bntShow").click(function(){
                    var idUsers = $("#ismUsers").val();
                    var dtStart = $("#dvFrom").find("input").val();
                    var dtEnd = $("#dvTo").find("input").val();
                    var action = "getSchedulesByUserDate";

                    jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {idUsers:idUsers, dtStart: dtStart, dtEnd: dtEnd, action: action}
                    }).done(function (resp) {
                        var data = jQuery.parseJSON(resp);
                        $("#datatables").html(data.html);
                        loadControls();
                        if(data.count <= 0){
                            $("[name=noInfo]").css("display","block");
                            window.setTimeout(function() {
                                $("div[name=noInfo]").fadeTo(200, 0).slideUp(200, function(){
                                    $("[name=noInfo]").css("display","none");
                                    $("[name=noInfo]").css("opacity","1");
                                });
                            }, 2000);
                        }
                    });
                });
                
                $("#btnClearUsers").click(function () {
                    $("#datatables").val('').trigger("change");
                });

                function loadControls(){
                    //Lesson Details
                    $('a#aHours').bind('click',function(){
                        $("#dvHours").html('Loanding...');
                        jQuery(this).parents('tr').map(function () {
                            var id = jQuery('input[name="hdId"]', this).val();
                            var dtwoformat = jQuery('input[name="hdDate"]', this).val();
                            var d = dtwoformat.substr(0,2);
                            var m =  dtwoformat.substr(3,2);
                            var y = dtwoformat.substr(6,4);

                            var dt = y+'-'+m+'-'+d;
                            var action = "getScheduleDetails";

                            console.log('id' + id);
                            console.log('dt' + dt);
                            jQuery.ajax({
                                url: "/ajax/actions.php",
                                type: "POST",
                                data: {id: id, dt: dt, action: action }
                            }).done(function (resp) {
                                    var data = jQuery.parseJSON(resp);
                                    $("#dvHours").html(data.html);
                                    $("#dvHours :input").attr('disabled', true);
                                });
                        });
                        return true;
                    });
                    // datatables
                    $('#datatables').dataTable( {
                        "bDestroy": true,
                        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                        "sPaginationType": "bootstrap",
                        "oLanguage": {
                                "sLengthMenu": "_MENU_ records per page"
                        }
                    });
                    
                    // datatables table tools
                    $('#datatablestools').dataTable({
                        "bDestroy": true,
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
                }

            });
      
        </script>
    </body>
</html>
s