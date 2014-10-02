<?php
require_once("../config.php");

$emailSent = false;
$lessApr = false;
$lessRej = false;

$dash = new dashboard();
$lesson = new lesson();
$list_last_pend_lessons = $lesson->list_last_pend_lessons($user->id);

if ($_POST['action'] == 'Submit') {
    $dash->sendEmail($user->name,$user->email, $_POST['reseiver'], $_POST['subject'], $_POST['message']);
    $emailSent = true;
} else if ($_POST['action'] == 'Eval') {
    if (isset($_POST['hdIdAR'])) {
        $lesson->change_status($_POST['hdIdAR'],$_POST['hdEval']);
        if($_POST['hdEval'] == '2'){
            $lessApr = true;
        }else if($_POST['hdEval'] == '3'){
            $lessRej = true;
        }
    $list_last_pend_lessons = $lesson->list_last_pend_lessons($user->id);
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

        <link href="../css/select2.css" rel="stylesheet" />
        <link href="../css/fullcalendar.css" rel="stylesheet" />
        <link href="../css/bootstrap-wysihtml5.css" rel="stylesheet" />
        
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
    if($emailSent){
    echo '<style type="text/css">
        div[name=emailSent] {
            display: block !important;
        }
        </style>';
    }else{
        echo '<style type="text/css">
            div[name=emailSent] {
                display: none !important;
            }
            </style>';
    }
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
                                <li><a href="#"><i class="icofont-home"></i> Dashboard</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- shortcut button -->
                            <div class="shortcut-group">
                                <ul class="a-btn-group">
                                    <li>
                                        <a href="/pages/schedules.php" class="a-btn grd-white" rel="tooltip" title="Schedules">
                                            <span></span>
                                            <span><i class="icofont-table color-silver-dark"></i></span>
                                            <span class="color-silver-dark"><i class="icofont-table color-green"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/pages/lessons.php" class="a-btn grd-white" rel="tooltip" title="Lessons">
                                            <span></span>
                                            <span><i class="icofont-edit color-silver-dark"></i></span>
                                            <span class="color-silver-dark"><i class="icofont-edit color-teal"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/pages/disciplines.php" class="a-btn grd-white" rel="tooltip" title="Disciplines">
                                            <span></span>
                                            <span><i class="icofont-book color-silver-dark"></i></span>
                                            <span class="color-silver-dark"><i class="icofont-book color-orange"></i></span>
                                        </a>
                                    </li>
                                    <li class="clearfix"></li>
                                </ul>
                            </div><!-- /shortcut button -->
                            
                            <div class="divider-content"><span></span></div>
                            <div class="row-fluid">
                               <div class="span6">
                                    <div name="lessApproved" class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Done!</strong> The lesson was Approved
                                    </div>
                                    <div name="lessRejected" class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Done!</strong> The lesson was Rejected
                                    </div>
                                    <!-- Modal Hours-->
                                    <div id="myModalHoursLL" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 150px;margin-left: -90px;margin-top: 100px;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel">Hours</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="control-group">
                                                <div class="controls" id="dvHoursLL">Loanding...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Question-->
                                    <div id="myModalQuestion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left: -120px;margin-top: 100px;width: 260px;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel">Lessons</h3>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                <input name="hdIdAR" id="hdIdAR" type="hidden"/>
                                                <input name="hdEval" id="hdEval" type="hidden"/>
                                                <div class="control-group">
                                                    <label class="control-label">Are you sure?</label>
                                                </div>
                                                <p align="center">
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                <button class="btn" id="btnAR" name="action" value="Eval"></button>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="box-tab corner-all">
                                        <div class="box-header corner-top">
                                            <!--tab action-->
                                            <div class="header-control pull-right">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOutDownLeft">&times;</a>
                                            </div>
                                            <ul class="nav nav-pills">
                                                <!--tab menus-->
                                                <li class="active"><a data-toggle="tab" href="#last-pending-lessons">Last Pending Lessons</a></li>
                                            </ul>
                                        </div>
                                        <div class="box-body">
                                            <!-- widgets-tab-body -->
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="last-pending-lessons">
                                                    <?php 
                                                     if(empty($list_last_pend_lessons)){ ?>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4 class="media-heading" style="margin-top: 30px;margin-left: 15px;">You have not pending lessons...</h4>
                                                            </div>
                                                        </div>
                                                    <?php 
                                                    }else{ 
                                                    foreach ($list_last_pend_lessons as $item) { ?>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h4 class="media-heading">Lesson of <?php echo $item->discipline; ?>&nbsp;&nbsp;<small class="helper-font-small">by <?php echo $item->client; ?> on <?php echo $item->date; ?> for <?php echo $item->hours; ?> hours</small></h4>
                                                            <p>Gross value: (<?php echo $item->currency; ?>) <?php echo $item->value_wo_discount; ?>, Discount value: (<?php echo $item->currency; ?>) <?php echo $item->value_discount; ?>, Total value: (<?php echo $item->currency; ?>) <?php echo $item->value_total; ?></p>
                                                            <div class="btn-group pull-right">
                                                                <input name="hdId" type="hidden" value="<?php echo $item->id; ?>"/>
                                                                <input name="hdIdMob" type="hidden" value="<?php echo $item->fk_mobile; ?>"/>
                                                                <input name="hdIdCli" type="hidden" value="<?php echo $item->fk_client; ?>"/>
                                                                <a href="#myModalHoursLL" class="btn btn-mini" data-toggle="modal" id="aHoursLL">Hours</a>
                                                                <a href="#myModalQuestion" class="btn btn-mini btn-primary" data-toggle="modal" id="aAppr">Approve</a>
                                                                <a href="#myModalQuestion" class="btn btn-mini btn-danger" data-toggle="modal" id="aReje">Reject</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } 
                                                    }?>
                                                    <a href="/pages/lessons.php" class="btn btn-small btn-link pull-right">View all &rarr;</a>
                                                </div>
                                            </div><!--/widgets-tab-body-->
                                        </div><!--/box-body-->
                                    </div><!--/box-tab-->
                                </div> 
                               <div class="span6">
                                    <div name="emailSent" class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Done!</strong> Your message was sent
                                    </div>
                                    <div class="box corner-all">
                                        <div class="box-header corner-top grd-white">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOutDownRight">&times;</a>
                                            </div>
                                            <span><i class="icofont-envelope"></i> Quick Mail</span>
                                        </div>
                                        <div class="box-body">
                                            <form action="" method="post"/>
                                                <div class="control-group">
                                                    <label class="control-label">To</label>
                                                    <div class="controls">
                                                        <input type="hidden" class="input-block-level" name="reseiver" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Subject</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-block-level grd-white" name="subject" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Message</label>
                                                    <div class="controls">
                                                        <textarea name="message" data-form="wysihtml5" rows="6" class="span11"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <input type="reset" class="btn" value="Reset" />
                                                    <input type="submit" class="btn btn-primary" name="action" value="Submit" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--schedule-->
                            <div class="box corner-all">
                                <div class="box-header grd-white color-silver-dark corner-top">
                                    <div class="header-control">
                                        <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                    </div>
                                    <span>Lessons this month</span>
                                </div>
                                <div class="box-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <!--schedule-->
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
        <script src="../js/peity/jquery.peity.js"></script>

        <script src="../js/select2/select2.js"></script>
        <script src="../js/knob/jquery.knob.js"></script>
        <script src="../js/flot/jquery.flot.js"></script>
        <script src="../js/flot/jquery.flot.pie.js"></script>
        <script src="../js/flot/jquery.flot.resize.js"></script>
        <script src="../js/flot/jquery.flot.categories.js"></script>

        <script src="../js/wysihtml5/wysihtml5-0.3.0.js"></script>
        <script src="../js/wysihtml5/bootstrap-wysihtml5.js"></script>

        <script src="../js/validate/jquery.validate.js"></script>
        <script src="../js/validate/jquery.metadata.js"></script>

        <script src="../js/flot/jquery.flot.demo.js"></script>

        <script src="../js/calendar/fullcalendar.js"></script> <!-- this plugin required jquery ui-->
        
        <!-- required stilearn template js, for full feature-->
        <script src="../js/holder.js"></script>
        <script src="../js/stilearn-base.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // try your js

                window.setTimeout(function() {
                    $("div[name=emailSent]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=lessApproved]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=lessRejected]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 2000);
                
                // normalize event tab-stat, we hack something here couse the flot re-draw event is any some bugs for this case
                $('#tab-stat > a[data-toggle="tab"]').on('shown', function(){
                    if(sessionStorage.mode == 4){ // this hack only for mode side-only
                        $('body,html').animate({
                            scrollTop: 0
                        }, 'slow');
                    }
                });
                
                // Input tags with select2
                $('input[name=reseiver]').select2({
                    tags:[]
                });
                
                // uniform
                $('[data-form=uniform]').uniform();

                // Approve lesson
                $("a#aAppr").bind('click', function () {
                    var id;
                    jQuery(this).parents('div').map(function () {
                        id = jQuery('input[name="hdId"]', this).val();
                    });

                    $("#hdIdAR").val(id);
                    $("#hdEval").val('2');
                    $("#btnAR").removeClass().addClass("btn btn-primary");
                    $("#btnAR").text('Approve');
                });

                // Reject lesson
                $("a#aReje").bind('click', function () {
                    var id;
                    jQuery(this).parents('div').map(function () {
                        id = jQuery('input[name="hdId"]', this).val();
                    });

                    $("#hdIdAR").val(id);
                    $("#hdEval").val('3');
                    $("#btnAR").removeClass().addClass("btn btn-danger");
                    $("#btnAR").text('Reject');
                });

                //Hours Last Lessons
                $('a#aHoursLL').bind('click',function(){
                    $("#dvHoursLL").html('Loanding...');
                    jQuery(this).parents('div').map(function () {
                        var idCli = jQuery('input[name="hdIdCli"]', this).val();
                        var idMob = jQuery('input[name="hdIdMob"]', this).val();
                        var action = "getLessonDetails";

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: idCli, idMob:idMob , action: action }
                        }).done(function (resp) {
                                $("#dvHoursLL").html(resp);
                            });
                    });
                    return true;
                });

                // wysihtml5
                $('[data-form=wysihtml5]').wysihtml5()
                toolbar = $('[data-form=wysihtml5]').prev();
                btn = toolbar.find('.btn');

                $.each(btn, function(k, v){
                    $(v).addClass('btn-mini')
                });

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
                        console.log('viewMonth' + viewMonth);
                        var id = idUser;
                        var action = "getApprLessByIdMonth";
                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, dt: viewMonth, action: action }
                        }).done(function (resp) {
                            var data = jQuery.parseJSON(resp);
                            console.log('entro lesson length ' + data.lesson.length);
                            if(data.lesson.length > 0){
                                $('#calendar').fullCalendar( 'removeEvents');
                                for (var i = 0;i < data.lesson.length; i += 1) {
                                    console.log('data '+ data.lesson[i].id+data.lesson[i].date+data.lesson[i].discipline+data.lesson[i].client);
                                    addEvent(data.lesson[i].id, data.lesson[i].date, data.lesson[i].discipline, data.lesson[i].client);
                                }
                            }    
                        });
                    },
                    header: {
                        left: 'title',
                        center: '',
                        right: 'prev,next today,month'
                    },
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    selectable: false,
                    editable: false
                });

                function addEvent(id, dt, discipline, client) {
                    var d = dt.split('/')[0];
                    var m = dt.split('/')[1]-1;
                    var y = dt.split('/')[2];
                    var newEvent = new Object();
                    newEvent.id = id;
                    newEvent.title = discipline +' - '+ client;
                    newEvent.start = new Date(y, m, d);
                    newEvent.end = new Date(y, m, d);
                    newEvent.allDay = true;    
                    $('#calendar').fullCalendar( 'renderEvent', newEvent, 'stick');
                }
            });
      
        </script>
    </body>
</html>
