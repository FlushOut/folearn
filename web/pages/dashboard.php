<?php
require_once("../config.php");
verify_access($list_modules);

$emailSent = false;
$dash = new dashboard();

$list_top_users = $dash->getTopUsersByCompany($company->id);
$list_bad_users = $dash->getBadUsersByCompany($company->id);

if ($_POST['action'] == 'Submit') {
    $dash->sendEmail($user->name,$user->email, $_POST['reseiver'], $_POST['subject'], $_POST['message']);
    $emailSent = true;
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
                                        <a href="/pages/schedule-reports.php" class="a-btn grd-white" rel="tooltip" title="Schedules">
                                            <span></span>
                                            <span><i class="icofont-table color-silver-dark"></i></span>
                                            <span class="color-silver-dark"><i class="icofont-table color-green"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/pages/lesson-reports.php" class="a-btn grd-white" rel="tooltip" title="Lessons">
                                            <span></span>
                                            <span><i class="icofont-edit color-silver-dark"></i></span>
                                            <span class="color-silver-dark"><i class="icofont-edit color-teal"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/pages/invoice.php" class="a-btn grd-white" rel="tooltip" title="Invoice">
                                            <span></span>
                                            <span><i class="icofont-barcode color-silver-dark"></i></span>
                                            <span class="color-silver-dark"><i class="icofont-barcode color-orange"></i></span>
                                        </a>
                                    </li>
                                    <li class="clearfix"></li>
                                </ul>
                            </div><!-- /shortcut button -->
                            <div class="divider-content"><span></span></div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOut">&times;</a>
                                            </div>
                                            <span>Account Stat</span>
                                        </div>
                                        <div class="box-body">
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="dashboard-stat">
                                                        <div id="lessons-stat" class="chart" style="height: 120px;"></div>
                                                        <div class="stat-label grd-teal color-white">Lessons</div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="dashboard-stat">
                                                        <div id="invoices-stat" class="chart" style="height: 120px;"></div>
                                                        <div class="stat-label grd-orange color-white">Invoices</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                               <div class="span6">
                                    <div class="box-tab corner-all">
                                        <div class="box-header corner-top">
                                            <!--tab action-->
                                            <div class="header-control pull-right">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOutDownLeft">&times;</a>
                                            </div>
                                            <ul class="nav nav-pills">
                                                <!--tab menus-->
                                                <li class="active"><a data-toggle="tab" href="#top-teachers">Top 5 Best Teachers</a></li>
                                                <li><a data-toggle="tab" href="#bad-teachers">Top 5 Bad Teachers</a></li>
                                            </ul>
                                        </div>
                                        <div class="box-body">
                                            <!-- widgets-tab-body -->
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="top-teachers">
                                                    <?php 
                                                    $count = 0;
                                                    if(empty($list_top_users)){ ?>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4 class="media-heading" style="margin-top: 30px;margin-left: 15px;">Teachers have not been evaluated with this rating...</h4>
                                                            </div>
                                                        </div>
                                                    <?php 
                                                    }else{ 
                                                        foreach ($list_top_users as $item) { 
                                                            $count++;
                                                            ?>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="#" class="a-btn grd-white" rel="tooltip">
                                                                <span></span>
                                                                <span><i class="icofont-star-empty color-silver-dark"></i></span>
                                                                <span class="color-blue">
                                                                    <i class="color-blue">
                                                                        <b><?php echo $count; ?></b>
                                                                    </i>
                                                                </span>
                                                            </a>
                                                            <h4 class="media-heading" style="margin-top: 30px;"><?php echo $item['user'] ?></h4>
                                                            <b>Average rating:&nbsp;</b>
                                                            <?php 
                                                            $avrg = number_format($item['average'],1,",",".");
                                                            if($avrg >= 1 && $avrg <=1.4){
                                                                echo 'Very Good';
                                                            }else if($avrg >= 1.5 && $avrg <=2.4){
                                                                echo 'Good';
                                                            }else if($avrg >= 2.5 && $avrg <=3.4){
                                                                echo 'Regular';
                                                            }else if($avrg >= 3.5 && $avrg <=4.4){
                                                                echo 'Bad';
                                                            }else if($avrg >= 4.5){
                                                                echo 'Very Bad';
                                                            }
                                                            ?>
                                                            <br>
                                                            <b>Lessons:&nbsp;</b><?php echo $item['quantity'] ?>
                                                        </div>
                                                    </div>
                                                    <?php } 
                                                    }?>
                                                </div>
                                                <div class="tab-pane fade" id="bad-teachers">
                                                    <?php 
                                                    $count = 0;
                                                    if(empty($list_bad_users)){ ?>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h4 class="media-heading" style="margin-top: 30px;margin-left: 15px;">Teachers have not been evaluated with this rating...</h4>
                                                            </div>
                                                        </div>
                                                    <?php 
                                                    }else{ 
                                                    foreach ($list_bad_users as $item) { 
                                                        $count++;
                                                        ?>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="#" class="a-btn grd-white" rel="tooltip">
                                                                <span></span>
                                                                <span><i class="icofont-thumbs-down color-silver-dark"></i></span>
                                                                <span class="color-silver-dark">
                                                                    <i class="color-silver-dark">
                                                                        <b><?php echo $count; ?></b>
                                                                    </i>
                                                                </span>
                                                            </a>
                                                            <h4 class="media-heading" style="margin-top: 30px;"><?php echo $item['user'] ?></h4>
                                                            <b>Average rating:&nbsp;</b>
                                                            <?php 
                                                            $avrg = number_format($item['average'],1,",",".");
                                                            if($avrg >= 1 && $avrg <=1.4){
                                                                echo 'Very Good';
                                                            }else if($avrg >= 1.5 && $avrg <=2.4){
                                                                echo 'Good';
                                                            }else if($avrg >= 2.5 && $avrg <=3.4){
                                                                echo 'Regular';
                                                            }else if($avrg >= 3.5 && $avrg <=4.4){
                                                                echo 'Bad';
                                                            }else if($avrg >= 4.5){
                                                                echo 'Very Bad';
                                                            }
                                                            ?>
                                                            <br>
                                                            <b>Lessons:&nbsp;</b><?php echo $item['quantity'] ?>
                                                        </div>
                                                    </div>
                                                    <?php } 
                                                    }?>
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
                
                // wysihtml5
                $('[data-form=wysihtml5]').wysihtml5()
                toolbar = $('[data-form=wysihtml5]').prev();
                btn = toolbar.find('.btn');
                
                $.each(btn, function(k, v){
                    $(v).addClass('btn-mini')
                });
                
                var action = "getDashboardAccountStat";

                jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {action: action }
                    }).done(function (resp) {
                        var data = jQuery.parseJSON(resp);
                        drawAccountStat1(data);
                    });
                
                function drawAccountStat1(data){
                    
                    var meses = ["","jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
                    var cantMonthView = 7;
                    var d1 = new Array(), d2 = new Array();
                    
                    if(data.length < cantMonthView){
                        var cantReg = data.length;
                        var firstMonth = data[0]["dateMonth"];
                        for (var i = cantMonthView-cantReg; i >= 0; i--) {
                            if((firstMonth-1) == 0) firstMonth = 13; firstMonth--;
                        }
                        for (var i = cantMonthView-cantReg; i >= 0; i--) {
                            d1.push([ meses[firstMonth], 0 ]);
                            d2.push([ meses[firstMonth], 0 ]);
                            if((firstMonth+1) == 13) firstMonth = 0;
                            firstMonth++;
                        }
                    }
                    
                    for (var i = data.length-1; i >= 0 ; i--) {
                        d1.push([ meses[data[i]["dateMonth"]], data[i]["lessons"] ]);
                        d2.push([ meses[data[i]["dateMonth"]], data[i]["invoice"] ]);
                    }

                    // system stat flot
                    //d1 = [ ['jan', 231], ['feb', 243], ['mar', 323], ['apr', 352], ['maj', 354], ['jun', 467], ['jul', 429] ];
                    //d2 = [ ['jan', 87], ['feb', 67], ['mar', 96], ['apr', 105], ['maj', 98], ['jun', 53], ['jul', 87] ];
                    //d3 = [ ['jan', 34], ['feb', 27], ['mar', 46], ['apr', 65], ['maj', 47], ['jun', 79], ['jul', 95] ];
                    
                    var less = $("#lessons-stat"),
                    inv = $("#invoices-stat"),
                    
                    data_lessons = [{
                            data: d1,
                            color: '#00a0b1'
                        }],
                    data_invoices = [{
                            data: d2,
                            color: '#dc572e'
                        }],
                    
                    options_lines = {
                        series: {
                            lines: {
                                show: true,
                                fill: true
                            },
                            points: {
                                show: true
                            },
                            hoverable: true
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#CDCDCD',
                            hoverable: true
                        },
                        legend: {
                            show: false
                        },
                        xaxis: {
                            mode: "categories",
                            tickLength: 0
                        },
                        yaxis: {
                            autoscaleMargin: 2
                        }
            
                    };
                    // render stat flot
                    $.plot(less, data_lessons, options_lines);
                    $.plot(inv, data_invoices, options_lines);
                }

                // tootips chart
                function showTooltip(x, y, contents) {
                    $('<div id="tooltip" class="bg-black corner-all color-white">' + contents + '</div>').css( {
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 5,
                        border: '0px',
                        padding: '2px 10px 2px 10px',
                        opacity: 0.9,
                        'font-size' : '11px'
                    }).appendTo("body").fadeIn(200);
                }

                var previousPoint = null;
                $('#lessons-stat, #invoices-stat').bind("plothover", function (event, pos, item) {
                    
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);
                            label = item.series.xaxis.ticks[item.datapoint[0]].label;
                            
                            showTooltip(item.pageX, item.pageY,
                            label + " = " + y);
                        }
                    }
                    else {
                        $("#tooltip").remove();
                        previousPoint = null;            
                    }
                    
                });
                // end tootips chart
            });
      
        </script>
    </body>
</html>
