<?php
require_once("../config.php");

$list_users = $user->list_users($company->id);

$lessstatus = new point();
$list_less_statuses = $lessstatus->list_less_statuses();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Route | FOMonitor</title>
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
        
        <link href="../css/DT_bootstrap.css" rel="stylesheet" />
        <link href="../css/responsive-tables.css" rel="stylesheet" />
        
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script> <!-- this for sliders-->        
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

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
                                <li><a href="index.html"><i class="icofont-home"></i> Route</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">Route</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div name="noInfoRoutes" class="alert" style="display:none">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Info!</strong> You no have routes for this date range
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Route</span>
                                            
                                        </div>
                                        <div class="box-body">
                                           <div class="control-group">
                                                <div class="controls form-inline" style="text-align:center;">
                                                    <label class="control-label" for="isCategories">Categories</label>
                                                    &nbsp;
                                                    <select id="isCategories" data-form="select2" style="width:200px;" data-placeholder="Select category...">
                                                        <option value="-1"/>Select category...
                                                        <?php foreach ($list_categories as $item) { ?>
                                                        <option value="<?php echo $item->id; ?>"/><?php echo $item->description; ?>
                                                        <?php }?>
                                                    </select>
                                                    &nbsp;&nbsp;
                                                    <label class="checkbox inline" id="lblAllPoints" name="lblAllPoints">
                                                        <input type="checkbox" data-form="uniform" name="chkAllPoints" id="chkAllPoints" value="option2" /> All Points
                                                    </label>
                                                    &nbsp;
                                                    <select id="ismPoints" data-form="select2" style="width:200px" data-placeholder="Select points..." multiple="">
                                                        <?php foreach ($list_points as $item) { ?>
                                                        <option value="<?php echo $item->id; ?>"/><?php echo $item->name; ?>
                                                        <?php }?>
                                                    </select>
                                                    &nbsp;
                                                    <button type="button" id="btnClearPoints" name="btnClearPoints" class="btn">Clear</button>
                                                    &nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary" id="btnShow">Show</button>
                                                </div>
                                            </div>
                                            <div class="divider-content" id="dvDivConUsers" style="display:none;"><span></span></div>
                                            <div class="control-group">
                                                <div class="controls form-inline" id="dvFilterUsers" style="text-align:center;display:none;">
                                                    <label class="checkbox inline" id="lblAllUsers" name="lblAllUsers">
                                                        <input type="checkbox" data-form="uniform" name="chkAllUsers" id="chkAllUsers" value="option1"/> All Users
                                                    </label>
                                                    &nbsp;
                                                    <input type="hidden" id="ismUsers" style="width:200px"/>
                                                    &nbsp;
                                                    <button type="button" class="btn" id="btnClearUsers" name="btnClearUsers">Clear</button>
                                                    &nbsp;
                                                    From
                                                    &nbsp;
                                                    <div id="dvFrom" name ="dvFrom" class="input-append date" data-form="datepicker" data-date-format="dd-mm-yyyy" style="width:150px">
                                                        <input id="inFrom" name ="inFrom" class="grd-white" data-form="datepicker" size="16" type="text" style="width:100px"/>
                                                        <span class="add-on"><i class="icon-th"></i></span>
                                                    </div>
                                                    To
                                                    &nbsp;
                                                    <div id="dvTo" name="dvTo" class="input-append date" data-form="datepicker" data-date-format="dd-mm-yyyy" style="width:150px">
                                                        <input id="inTo" name="inTo" class="grd-white" data-form="datepicker" size="16" type="text" style="width:100px"/>
                                                        <span class="add-on"><i class="icon-th"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider-content"><span></span></div>
                                            <div class="mapa" id="mapa" style="height:450px; width: 100%;"></div>
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
            <div id="legend"></div>
        </section>

        <!-- start left_menu -->
        <?php include("../includes/_footer.php"); ?>
        <!-- end left_menu -->


        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

        <script src="../js/datepicker/bootstrap-datepicker.js"></script>
        <script src="../js/select2/select2.js"></script>

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
        <style>
            #legend {
                font-family: Arial, sans-serif;
                background: #fff;
                padding: 10px;
                margin: 10px;
                border: 1px solid #000;
            }
            #legend img {
                vertical-align: middle;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                var markersPoint = [];
                var infowindow = null;
                var iconBase = '../img/';
                var icons = {
                  points: {
                    name: 'Points',
                    icon: iconBase + 'point.png'
                  },
                  startroute: {
                    name: 'Start Route',
                    icon: iconBase + 'start-route.png'
                  },
                  finishroute: {
                    name: 'Finish Route',
                    icon: iconBase + 'finish-route.png'
                  }
                };
                var legend = document.getElementById('legend');
                for (var key in icons) {
                    var type = icons[key];
                    var name = type.name;
                    var icon = type.icon;
                    var div = document.createElement('div');
                    div.innerHTML = '<img src="' + icon + '"> ' + name;
                    legend.appendChild(div);
                }
                
                /**/
                var my = {directionsSVC:new google.maps.DirectionsService(),
                        maps:{},
                        routes:{}};
                var iniMarker;
                var endMarker;
                /**/

                // Validar si estoy viendo la ruta por mobile enviado desde Map
                var idMobile = getUrlParameters('user','',true);
                var dtMobile = getUrlParameters('date','',true);
                if(idMobile && dtMobile) {
                    var id = idMobile;
                    var dt = dtMobile;
                    var action = "getRouteByIdDt";
                    jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {id: id, dt: dt, action: action }
                    }).done(function (resp) {
                        var data = jQuery.parseJSON(resp);
                        initialize();
                        $("#isCategories").select2("val", data.mobile.fk_category);
                        $("#ismUsers").val('').trigger("change");
                        $("#ismUsers").select2({
                            data:{ results: data.mobiles, text: 'name' },
                            multiple: true,
                            formatSelection: format,
                            placeholder: "Select users...",
                            formatResult: format,
                            initSelection : function (element, callback) {
                                callback(data.mobile);
                            }
                        }).select2('val', data.mobile.id);

                        $('#dvFrom').data({date: dtMobile}).datepicker('update').children("input").val(dtMobile);
                        $('#dvTo').data({date: dtMobile}).datepicker('update').children("input").val(dtMobile);

                        if(data.route.length > 0){
                            for (var i = 0;i < data.route.length; i += 1) {
                                addRoutes(data.route[i]);
                            }
                        }
                        infowindow = new google.maps.InfoWindow({
                            content: 'loading...',
                        });
                        $( "#dvDivConUsers" ).show();
                        $( "#dvFilterUsers" ).show();
                    });
                }

                // try your js

                $('#form-validate').validate();
                
                // uniform
                $('[data-form=uniform]').uniform();

                // select2
                $('[data-form=select2]').select2();

                // datepicker
                $('[data-form=datepicker]').datepicker({format:'dd-mm-yyyy'});
                
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

                //Get users by categories
                var data;
                function format(item) { return item.name; }
                $('#isCategories').on('change', function(){
                    var id = $(this).val();
                    var action = "getUsersByCategory";
                    jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {id: id, action: action }
                    }).done(function (resp) {
                        data = jQuery.parseJSON(resp);
                        $("#chkAllUsers").removeAttr( "checked" );
                        $("#chkAllUsers").removeClass( "checked" );
                        $("#chkAllUsers").parent().removeAttr( "checked" );
                        $("#chkAllUsers").parent().removeClass( "checked" );
                        $("#ismUsers").val('').trigger("change");
                        $("#ismUsers").select2({
                            data:{ results: data, text: 'name' },
                            multiple: true,
                            formatSelection: format,
                            placeholder: "Select users...",
                            formatResult: format,
                            initSelection : function (element, callback) {
                                callback(data);
                            }
                        });    
                        $( "#dvDivConUsers" ).show();
                        $( "#dvFilterUsers" ).show();
                    });

                });
                $("#chkAllUsers").click(function () {
                    if (jQuery(this).attr("checked") == 'checked') {
                        $("#ismUsers").val('data').trigger("change");
                    } else {
                        $("#ismUsers").val('').trigger("change");
                    }
                });

                $("#btnClearUsers").click(function () {
                    $("#ismUsers").val('').trigger("change");
                    if (jQuery("#chkAllUsers").attr("checked") == 'checked'){
                        $("#chkAllUsers").removeAttr( "checked" );
                        $("#chkAllUsers").removeClass( "checked" );
                        $("#chkAllUsers").parent().removeAttr( "checked" );
                        $("#chkAllUsers").parent().removeClass( "checked" );
                    }
                });

                $("#chkAllPoints").click(function(){
                    if($("#chkAllPoints").is(':checked') ){
                        $("#ismPoints > option").prop("selected","selected");
                        $("#ismPoints").trigger("change");
                    }else{
                        $("#ismPoints > option").removeAttr("selected");
                        $("#ismPoints").trigger("change");
                    }
                });

                $("#btnClearPoints").click(function () {
                    $("#ismPoints").val('').trigger("change");
                    if (jQuery("#chkAllPoints").attr("checked") == 'checked'){
                        $("#chkAllPoints").removeAttr( "checked" );
                        $("#chkAllPoints").removeClass( "checked" );
                        $("#chkAllPoints").parent().removeAttr( "checked" );
                        $("#chkAllPoints").parent().removeClass( "checked" );
                    }
                });

                $("#btnShow").click(function(){
                    var idUsers = $("#ismUsers").val();
                    var idPoints = $("#ismPoints").val();
                    var dtStart = $("#dvFrom").find("input").val();
                    var dtEnd = $("#dvTo").find("input").val();
                    var action = "showRoutesPointsInMap";

                    jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {idUsers: idUsers, idPoints: idPoints, dtStart: dtStart, dtEnd: dtEnd, action: action}
                    }).done(function (resp) {
                        var data = jQuery.parseJSON(resp);
                        initialize();
                        if(data.points.length > 0){
                            for (var i = 0;i < data.points.length; i += 1) {
                                addMarkerPoints(data.points[i]);
                            }
                        }
                        if(data.routes.length > 0){
                            for (var i = 0;i < data.routes.length; i += 1) {
                                addRoutes(data.routes[i]); 
                            }
                        }else{
                            $("[name=noInfoRoutes]").css("display","block");
                            window.setTimeout(function() {
                                $("div[name=noInfoRoutes]").fadeTo(200, 0).slideUp(200, function(){
                                    $("[name=noInfoRoutes]").css("display","none");
                                    $("[name=noInfoRoutes]").css("opacity","1");
                                });
                            }, 2000);
                        }
                        infowindow = new google.maps.InfoWindow({
                            content: 'loading...',
                        });
                    });
                });

                function addMarkerPoints(data){
                    var image = {
                        url: '../img/point.png'
                    };
                    var latlng = new google.maps.LatLng(data.latitude,data.longitude);  
                    var contentString = 
                        '<div style="line-height:1.35;overflow:hidden !important;white-space:nowrap;" id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<h3 id="firstHeading" class="firstHeading">'+ data.name +'</h3>'+
                            '<div id="bodyContent">'+
                                '<p><b>Street : </b>'+data.addr_street+'</p>'+
                                '<p><b>Number : </b>'+data.addr_number+'</p>'+
                                '<p><b>District : </b>'+data.addr_district+'</p>'+
                                '<p><b>City : </b>'+data.addr_city+'</p>'+
                                '<p><b>State : </b>'+data.addr_state+'</p>'+
                                '<p><b>Postal Code : </b>'+data.addr_postalcode+'</p>'+
                            '</div>'+
                        '</div>';
                    var marker = new google.maps.Marker({
                    position: latlng,
                    map: my.maps.map1,
                    icon: image,
                    html: contentString,
                    animation: google.maps.Animation.DROP
                    });
                    google.maps.event.addListener(marker, "click", function () {
                        infowindow.setContent(this.html);
                        infowindow.open(my.maps.map1, this);
                    });

                    var rad = parseFloat(data.radius);
                    if (rad!="" && rad != NaN)
                    {
                        var circle = new google.maps.Circle({
                            center: latlng,
                            radius: 1*rad,
                            strokeColor: "#0000FF",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: "#0000FF",
                            fillOpacity: 0.4
                        });     

                        circle.setMap(my.maps.map1);
                    }

                    markersPoint.push(marker);
                }

                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth()+1;
                var day = d.getDate();
                var startDate = ((''+day).length<2 ? '0' : '') + day +'-'+ 
                                ((''+month).length<2 ? '0' : '') + month +'-'+  
                                year; 

                $('#dvFrom').data({date: startDate}).datepicker('update').children("input").val(startDate);
                $('#dvTo').data({date: startDate}).datepicker('update').children("input").val(startDate);

                /**/

                function initialize() {
                    var myOptions = {
                        zoom: 6,
                        center: new google.maps.LatLng(-23.565262,-46.683653),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                      };
                    my.maps.map1 = new google.maps.Map(document.getElementById('mapa'),myOptions);
                    my.maps.map1.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
                }

                function addRoutes(data) {
                    var arrPoints = [];
                    var routeColor = makeColor();
                    for (var i = 0; i < data.points.length; i++) {
                        arrPoints.push([parseFloat(data.points[i].substr(0, data.points[i].indexOf(','))),
                            parseFloat(data.points[i].split(",").pop())])
                    }
                    doRoute(data.name,data.date,arrPoints,routeColor);
                }

                function doRoute(name,date,points,routeColor) {
                    iniMarker = new google.maps.LatLng(points[0][0],points[0][1]);            
                    endMarker = new google.maps.LatLng(points[points.length-1][0],points[points.length-1][1]); 
                    var i = 0;
                    while (points.length > 0){
                      var routePoints = [];
                      for ( j = 0; j < 10; j++) {
                        if (points[0]) {
                          if ( j == 9) {
                            routePoints.push([points[0][0],points[0][1]]);
                          } else {
                            routePoints.push([points[0][0],points[0][1]]);
                            points.splice(0,1);
                          }
                        }
                      }
                      my.routes[i] = new Route(routePoints).drawRoute(my.maps.map1, routeColor);
                      i++;  
                    }
                    setIconMarkers(name, date);
                }

                function Route(points) {
                    this.origin       = null;
                    this.destination  = null;
                    this.waypoints    = [];
                    if(points && points.length>1)
                    {
                      this.setPoints(points);
                    }
                    return this; 
                };

                Route.prototype.drawRoute = function(map, routeColor) {
                    var _this=this;
                    my.directionsSVC.route(
                      {'origin': this.origin,
                       'destination': this.destination,
                       'waypoints': this.waypoints,
                       'travelMode': google.maps.DirectionsTravelMode.WALKING
                      },
                      function(res,sts) 
                      {
                          if(sts==google.maps.DirectionsStatus.OK){
                          if(!_this.directionsRenderer)
                          {
                            _this.directionsRenderer 
                             = new google.maps.DirectionsRenderer({ 'draggable':false, 'suppressMarkers': true, 'polylineOptions': { 'strokeColor' : routeColor, 'strokeOpacity': 0.5,
                        'strokeWeight': 5 } } ); 
                                          }
                            _this.directionsRenderer.setMap(map);
                            _this.directionsRenderer.setDirections(res);
                            google.maps.event.addListener(_this.directionsRenderer,
                                                          'directions_changed',
                                                          function()
                                                          {
                                                            _this.setPoints();
                                                          }
                                                          );
                                      }   
                      });
                    return _this;
                };

                Route.prototype.setGMap = function(map) {
                    this.directionsRenderer.setMap(map);
                };

                Route.prototype.setPoints = function(points) {
                    this.origin = null;
                    this.destination = null;
                    this.waypoints = [];

                    if(points)
                    {
                      for(var p=0;p<points.length;++p)
                      {
                        this.waypoints.push({location:new google.maps.LatLng(points[p][0],
                                                                             points[p][1]),
                                             stopover:false});
                      }
                      this.origin=this.waypoints.shift().location;
                      this.destination=this.waypoints.pop().location;
                    }
                    else
                    {
                      var route=this.directionsRenderer.getDirections().routes[0];
                      
                      for(var l=0;l<route.legs.length;++l)
                      {
                        if(!this.origin)this.origin=route.legs[l].start_location;
                        this.destination = route.legs[l].end_location;
                        
                        for(var w=0;w<route.legs[l].via_waypoints.length;++w)
                        {
                          this.waypoints.push({location:route.legs[l].via_waypoints[w],
                                               stopover:false});
                        }
                      }
                      //the route has been modified by the user when you're here
                      //you may call now this.getPoints() and work with the result
                    }

                    return this;
                };

                Route.prototype.getPoints = function() {
                  var points=[[this.origin.lat(),this.origin.lng()]];
                  
                  for(var w=0;w<this.waypoints.length;++w)
                  {
                    points.push([this.waypoints[w].location.lat(),
                                 this.waypoints[w].location.lng()]);
                  }
                  
                  points.push([this.destination.lat(),
                               this.destination.lng()]);
                  return points;
                };

                function makeMarker( position, icon, title, name, date ) {
                    var marker = new google.maps.Marker({
                    position: position,
                    map: my.maps.map1,
                    icon: icon,
                    title: title,
                    draggable: false
                    });

                    var contentString = 
                      '<div style="line-height:1.35;overflow:hidden !important;white-space:nowrap;" id="content">'+
                          '<div id="siteNotice">'+
                          '</div>'+
                          '<h3 id="firstHeading" class="firstHeading">'+ name +'</h3>'+
                          '<div id="bodyContent">'+
                              '<p><b>Date : </b>'+ date +'&nbsp;&nbsp;</p>'+
                          '</div>'+
                      '</div>';
                    marker.info = new google.maps.InfoWindow({
                                    content: contentString
                                    });
                                    google.maps.event.addListener(marker, "click", function () {
                                        marker.info.open(my.maps.map1, marker);
                                    });  
                }

                function setIconMarkers(name,date) {
                    var icons = {
                    start: new google.maps.MarkerImage(
                     '../img/start-route.png',
                     new google.maps.Size( 44, 32 ),
                     new google.maps.Point( 0, 0 ),
                     new google.maps.Point( 22, 32 )
                    ),
                    end: new google.maps.MarkerImage(
                     '../img/finish-route.png',
                     new google.maps.Size( 44, 32 ),
                     new google.maps.Point( 0, 0 ),
                     new google.maps.Point( 22, 32 )
                    )
                    };
                    makeMarker( iniMarker, icons.start, 'Start Route', name, date );
                    makeMarker( endMarker, icons.end, 'End Route', name, date );
                }

                google.maps.event.addDomListener(window, 'load', initialize);

                /**/

                function makeColor(){
                    var hexVal = "0123456789ABCDEF".split("");
                    return '#' + hexVal.sort(function(){
                        return (Math.round(Math.random())-0.5);
                    }).slice(0,6).join('');
                }

                function getUrlParameters(parameter, staticURL, decode){
                    if(window.location.search){
                        var currLocation = (staticURL.length)? staticURL : window.location.search;
                        var parArr = currLocation.split("?")[1].split("&");
                        var returnBool = true;
                       
                        for(var i = 0; i < parArr.length; i++){
                            parr = parArr[i].split("=");
                            if(parr[0] == parameter){
                                return (decode) ? decodeURIComponent(parr[1]) : parr[1];
                                returnBool = true;
                            }else{
                                returnBool = false;            
                            }
                        }
                       
                        if(!returnBool) return false;
                    }
                }
            });
        </script>
    </body>
</html>
