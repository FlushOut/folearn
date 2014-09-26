<?php
require_once("../config.php");

$scheAdd = false;
$scheUpd = false;
$scheDel = false;

$newSche = new schedule();
if ($_POST['action'] == 'Save') {
    if (isset($_POST['hdIdAct'])) {
        if ($_POST['hdIdAct'] == ""){
            $newSche->save($_POST['hdIdUser'], $_POST['hdDate'], $_POST['scheDet']);
            $scheAdd = true;
        }else{
            $newSche->open($_POST['hdIdAct']);
            $newSche->save($_POST['hdIdUser'], $_POST['hdDate'], $_POST['scheDet']);
            $scheUpd = true;
        }
    }
}

if ($_POST['action'] == 'Delete') {
    if (isset($_POST['hdIdAct'])) {
        $newSche->open($_POST['hdIdAct']);
        $newSche->del();
        $scheDel = true;
    }

}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Schedule | FOLearn</title>
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
        <link href="../css/fullcalendar.css" rel="stylesheet" />
        
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
if($scheAdd){
    echo '<style type="text/css">
        div[name=scheAdded] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=scheAdded] {
            display: none !important;
        }
        </style>';
}

if($scheUpd){
    echo '<style type="text/css">
        div[name=scheUpdated] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=scheUpdated] {
            display: none !important;
        }
        </style>';
}

if($scheDel){
    echo '<style type="text/css">
        div[name=scheDeleted] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=scheDeleted] {
            display: none !important;
        }
        </style>';
}
?>
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
                                <li><a href="#"><i class="icofont-home"></i> Schedules</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <div name="scheAdded" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your schedule was created
                            </div>
                            <div name="scheUpdated" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your schedule was updated
                            </div>
                            <div name="scheDeleted" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your schedule was deleted
                            </div>
                            <!-- calendar -->
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <span>Schedule</span>
                                        </div>
                                        <!-- Modal Schedule Details-->
                                        <div id="myModalScheduleDetails" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="myModalLabel">Select Hours</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                    <input name="hdIdUser" id="hdIdUser" type="hidden"/>
                                                    <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                    <input name="hdDate" id="hdDate" type="hidden"/>
                                                    <div class="control-group">
                                                        <div class="controls" style="margin-left: 100px !important;">
                                                        </div>
                                                    </div>
                                                    <p align="center">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button class="btn btn-primary" id="btnSave" name="action" value="Save">Save</button>
                                                    <button class="btn btn-danger" id="btnDelete" name="action" value="Delete">Delete</button>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Modal Error-->
                                        <div id="myModalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="myModalLabel">Incorrect Date</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                    <input name="hdIdDE" id="hdIdDE" type="hidden"/>
                                                    <div class="control-group">
                                                        <label class="control-label" style="width:100% !important;text-align:center !important;">Selected Date is less than the Current Date</label>
                                                    </div>
                                                    <p align="center">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/calendar-->
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

        <script src="../js/calendar/fullcalendar.js"></script>

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

                window.setTimeout(function() {
                    $("div[name=scheAdded]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=scheUpdated]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=scheDeleted]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 2000);

                jQuery("label.checkbox").each(function () {
                if (jQuery("input", this).attr("checked") == 'checked') jQuery(this).addClass("checked");
                });


                $('[data-form=uniform]').uniform();
                // calendar
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth()+1;
                var y = date.getFullYear();
        
                $('div.external-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            
                }).css({
                    'cursor' : 'move'
                });
                
                var idUser = <?php echo $_SESSION['loginsession'] ?>;
                var calendar = $('#calendar').fullCalendar({
                    viewDisplay: function(view) {
                        var viewDate = $.fullCalendar.formatDate(view.start,'yyyy-MM-dd');
                        var viewMonth = viewDate.split('-')[1];
                        var id = idUser;
                        var action = "getSchedulesByIdMonth";
                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, dt: viewMonth, action: action }
                        }).done(function (resp) {
                            var data = jQuery.parseJSON(resp);
                            if(data.schedule.length > 0){
                                $('#calendar').fullCalendar( 'removeEvents');
                                for (var i = 0;i < data.schedule.length; i += 1) {
                                    addEvent(data.schedule[i].id, data.schedule[i].date, data.schedule[i].hours);
                                }
                            }    
                        });
                    },
                    header: {
                        left: 'title',
                        center: '',
                        right: 'prev,next today,month,agendaWeek'
                    },
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {
                        var check = $.fullCalendar.formatDate(start,'yyyy-MM-dd');
                        var today = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');
                        $("#hdDate").val(check);
                        $("#hdIdUser").val(idUser);

                        var id = idUser;
                        var action = "getScheduleDetails";
                        $("#hdIdAct").val('');
                        $("#btnDelete").hide();
                        $("#btnSave").hide();
                        $(".controls").html("Loanding...");

                        $('#myModalScheduleDetails').modal('show');

                        jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {id: id, dt: check, action: action }
                            }).done(function (resp) {
                                var data = jQuery.parseJSON(resp);
                                    $(".controls").html(data.html);
                                    if(check < today) {
                                        $(".controls :input").attr('disabled', true);
                                    }else{
                                        if(data.id > 0){
                                            $("#hdIdAct").val(data.id);
                                            $("#btnSave").text('Update');
                                            $("#btnSave").show();
                                            $("#btnDelete").show();
                                        }else{
                                            $("#btnSave").text('Save');
                                            $("#btnSave").show();
                                        }    
                                    }
                                    
                                });
                        calendar.fullCalendar('unselect');
                    },
                    editable: false
                });

                function addEvent(id, dt, hours) {
                    var d = dt.split('-')[2];
                    var m = dt.split('-')[1]-1;
                    var y = dt.split('-')[0];
                    for (var i = 0;i < hours.length; i += 1) {
                        var newEvent = new Object();
                        newEvent.id = id;
                        newEvent.title = "Available";
                        newEvent.start = new Date(y, m, d, hours[i].split('-')[0].split(':')[0]);
                        newEvent.end = new Date(y, m, d, hours[i].split('-')[1].split(':')[0]);
                        newEvent.allDay = false;    
                        $('#calendar').fullCalendar( 'renderEvent', newEvent, 'stick');
                    }
                }
            });
      
        </script>
    </body>
</html>
