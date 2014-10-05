<?php
require_once("../config.php");
verify_access($list_modules);

$discAdd = false;
$discUpd = false;
$discDel = false;

$newDisc = new discount();
$country = new country();

if ($_POST['action'] == 'Save') {
    if (isset($_POST['hdIdAct'])) {
        if ($_POST['hdIdAct'] == ""){
            $newDisc->save($company->id, $_POST['code'], $_POST['percent'], $_POST['condition_start'], $_POST['condition_end']);
            $discAdd = true;
        }else{
            $newDisc->open($_POST['hdIdAct']);
            $newDisc->save($company->id, $_POST['code'], $_POST['percent'], $_POST['condition_start'], $_POST['condition_end']);
            $discUpd = true;
        }
    }
}

if ($_POST['action'] == 'Delete') {
    if (isset($_POST['hdIdDE'])) {
        $newDisc->open($_POST['hdIdDE']);
        $newDisc->del();
        $discDel = true;
    }
}

$list_discounts = $newDisc->list_discounts($company->id);
$country->open($company->fk_country);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Discount | FOLearn</title>
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
                                <li><a href="#"><i class="icofont-home"></i> Discounts</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div name="discAdded" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your discount was created
                            </div>
                            <div name="discUpdated" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your discount was updated
                            </div>
                            <div name="discDeleted" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your discount was deleted
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Discounts&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#myModal" role="button" class="btn" data-toggle="modal" id="aAdd">Add</a>
                                            <!-- Modal Save/Edit-->
                                            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 id="modal-recoverLabel">Information</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="form-validate-new-discount" action="" method="post" />
                                                        <div class="control-group">
                                                            <label class="control-label" for="code">Code</label>
                                                            <div class="controls">
                                                                <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                                <input type="text" class="grd-white" id="code" name="code" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="percent">Percent</label>
                                                            <div class="controls">
                                                                <p>
                                                                    <input  type="text" id="percent" name="percent" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" />
                                                                    <span for="percent" class="helper-font-small">Max 100% </span>
                                                                </p>
                                                                <div style="width:300px !important;" id="slider-percent" class="slider-blue"></div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="condition_start">Range Condition</label>
                                                            <div class="controls">
                                                                <p>
                                                                    <input  type="text" id="condition_start" name="condition_start" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" /> - 
                                                                    <input  type="text" id="condition_end" name="condition_end" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" />
                                                                    <span for="condition_start" class="helper-font-small">(<?php echo $country->currency; ?>)</span>
                                                                </p>
                                                                <div style="width:300px !important;" id="slider-range" class="slider-blue"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button class="btn btn-primary" form="form-validate-new-discount" id="btnSave" name="action" value="Save">Save</button>
                                                </div>
                                            </div><!-- /Modal Save/Edit-->
                                            <!-- Modal Delete-->
                                            <div id="myModalDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left: -120px;margin-top: 100px;width: 280px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 id="modal-recoverLabel">Delete Discount</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                        <div class="control-group">
                                                            <input name="hdIdDE" id="hdIdDE" type="hidden"/>
                                                            <label class="control-label">Are you sure?</label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button class="btn btn-primary" form="form-validate" id="btnDelete" name="action" value="Delete">Delete</button>
                                                </div>
                                            </div><!-- Modal Delete-->
                                        </div>
                                        <div class="box-body">
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">#</th>
                                                        <th class="head1">Code</th>
                                                        <th class="head0">Percent</th>
                                                        <th class="head1">Condition Start (<?php echo $country->currency; ?>)</th>
                                                        <th class="head0">Condition End (<?php echo $country->currency; ?>)</th>
                                                        <th class="head1">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_discounts as $item) { ?>
                                                        <tr src="discount">
                                                            <td><?php echo $item->id; ?><input name="hdId" type="hidden" value="<?php echo $item->id; ?>"/></td>
                                                            <td><?php echo $item->code; ?><input name="hdCode" type="hidden" value="<?php echo $item->code; ?>"/></td>
                                                            <td><?php echo $item->percent * 100; ?>%
                                                                <input name="hdPercent" type="hidden" value="<?php echo $item->percent * 100; ?>"/>
                                                            </td>
                                                            <td><?php echo $item->condition_start; ?>
                                                                <input name="hdCondStart" type="hidden" value="<?php echo $item->condition_start; ?>"/>
                                                            </td>
                                                            <td><?php echo $item->condition_end; ?>
                                                                <input name="hdCondEnd" type="hidden" value="<?php echo $item->condition_end; ?>"/>
                                                            </td>
                                                            <td>
                                                                <a href="#myModal" role="button" class="btn btn-link" data-toggle="modal" id="aEdit">Edit</a>
                                                                <a href="#myModalDelete" role="button" class="btn btn-link" data-toggle="modal" id="aDelete">Delete</a>
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
                $.validator.addMethod('lessThanEqual', function(value, element, param) {
                    return this.optional(element) || parseInt(value) <= parseInt($(param).val());
                }, "The value {0} must be less than {1}");
                $.validator.addMethod('greaterThanEqual', function(value, element, param) {
                    return this.optional(element) || parseInt(value) >= parseInt($(param).val());
                }, "The value {0} must be less than {1}");

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

                /*
                jQuery(".sidebar-right-content *").prop('disabled',true); 
                jQuery(".sidebar-right-content").css({ opacity: 0.5 });
                */   

                jQuery("label.checkbox").each(function () {
                if (jQuery("input", this).attr("checked") == 'checked') jQuery(this).addClass("checked");
                });

                $('#myModal').on('shown', function () {
                    $('#code').focus();
                });
                $("#percent").focusout(function(){
                    $("#slider-percent").slider("option", "value", $("#percent").val()); 
                    $("#slider-percent").slider("value", $("#slider-percent").slider("value")); 
                });
                $("#condition_start").focusout(function(){
                    $("#slider-range").slider("option", "values",[$("#condition_start").val(),$("#condition_end").val()]); 
                    $("#slider-range").slider("values", $("#slider-range").slider("values")); 
                });
                $("#condition_end").focusout(function(){
                    $("#slider-range").slider("option", "values",[$("#condition_start").val(),$("#condition_end").val()]); 
                    $("#slider-range").slider("values", $("#slider-range").slider("values")); 
                });

                //delete discount
                $('a#aDelete').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        $("#hdIdDE").val(id);
                    });
                    return true;
                });

                //update individual row
                $('a#aEdit').bind('click',function(){
                    var id;
                    var code;
                    var percent;
                    var condition_start;
                    var condition_end;

                    $('#form-validate-new-discount').removeData('validator');

                    jQuery(this).parents('tr').map(function () {
                        id = jQuery('input[name="hdId"]', this).val();
                        code = jQuery('input[name="hdCode"]', this).val();
                        percent = jQuery('input[name="hdPercent"]', this).val();
                        condition_start = jQuery('input[name="hdCondStart"]', this).val();
                        condition_end = jQuery('input[name="hdCondEnd"]', this).val();
                    });   

                    $("#hdIdAct").val(id);
                    $("#code").val(code);                       
                    $("#btnSave").text('Update');

                    //Sliders
                    //Percent
                    $("#slider-percent").slider({
                        range: "min",
                        min: 1,
                        max: 100,
                        value: percent,
                        slide: function( event, ui ) {
                            $("#percent").val( ui.value );
                        }
                    });
                    $("#percent").val( $("#slider-percent").slider("value"));

                    //Range
                    $("#slider-range").slider({
                        range: true,
                        min: 1,
                        max: 1000,
                        values: [condition_start, condition_end],
                        slide: function( event, ui ) {
                            $("#condition_start").val(ui.values[0]);
                            $("#condition_end").val(ui.values[1]);
                        }
                    });
                    $("#condition_start").val($("#slider-range").slider("values",0));
                    $("#condition_end").val($("#slider-range").slider("values",1));

                    $("#form-validate-new-discount").validate({
                        rules: {
                            code: {
                                required:false
                            },    
                            percent: {
                                required:false,
                                number:true,
                                min:1,
                                max:100
                            },
                            condition_start: {
                                required:false,
                                number:true,
                                min:1,
                                max:1000,
                                lessThanEqual: "#condition_end"
                            },
                            condition_end: {
                                required:false,
                                number:true,
                                min:1,
                                max:1000,
                                greaterThanEqual: "#condition_start"
                            }
                        },
                        messages: {
                            percent: {
                                number: 'May contain digits only',
                                min: 'Please enter a value greater than or equal to 1',
                                max: 'Please enter a value less than or equal to 100'
                            },
                            condition_start: {
                                number: 'May contain digits only',
                                min: 'Please enter a value greater than or equal to 1',
                                max: 'Please enter a value less than or equal to 1000',
                                lessThanEqual: 'Please enter a value less than or equal to the condition end'
                            },
                            condition_end: {
                                number: 'May contain digits only',
                                min: 'Please enter a value greater than or equal to 1',
                                max: 'Please enter a value less than or equal to 100',
                                greaterThanEqual: 'Please enter a value greater than or equal to the condition start'
                            }
                        }
                    });

                    var validator = $( "#form-validate-new-discount" ).validate();
                    validator.resetForm();
                });

                // validate form
                $("a#aAdd").bind('click', function () {
                    $("#hdIdAct").val('');
                    $("#code").val('');
                    $("#slider-percent").slider({
                        range: "min",
                        min: 1,
                        max: 100,
                        value: 1,
                        slide: function( event, ui ) {
                            $("#percent").val( ui.value );
                        }
                    });
                    $("#percent").val( $("#slider-percent").slider("value"));

                    $("#slider-range").slider({
                        range: true,
                        min: 1,
                        max: 1000,
                        values: [1,1],
                        slide: function( event, ui ) {
                            $("#condition_start").val(ui.values[0]);
                            $("#condition_end").val(ui.values[1]);
                        }
                    });
                    $("#condition_start").val($("#slider-range").slider("values",0));
                    $("#condition_end").val($("#slider-range").slider("values",1));

                    $("#btnSave").text('Save');

                    $('#form-validate-new-discount').removeData('validator');

                    $("#form-validate-new-discount").validate({
                        rules: {
                            code: {
                                required:true
                            },    
                            percent: {
                                required:true,
                                number:true,
                                min:1,
                                max:100
                            },
                            condition_start: {
                                required:true,
                                number:true,
                                min:1,
                                max:1000,
                                lessThanEqual: "#condition_end"
                            },
                            condition_end: {
                                required:true,
                                number:true,
                                min:1,
                                max:1000,
                                greaterThanEqual: "#condition_start"
                            }
                        },
                        messages: {
                            percent: {
                                required: 'Please enter field percent',
                                number: 'May contain digits only',
                                min: 'Please enter a value greater than or equal to 1',
                                max: 'Please enter a value less than or equal to 100'
                            },
                            condition_start: {
                                required: 'Please enter field condition start',
                                number: 'May contain digits only',
                                min: 'Please enter a value greater than or equal to 1',
                                max: 'Please enter a value less than or equal to 1000',
                                lessThanEqual: 'Please enter a value less than or equal to the condition end'
                            },
                            condition_end: {
                                required: 'Please enter field condition end',
                                number: 'May contain digits only',
                                min: 'Please enter a value greater than or equal to 1',
                                max: 'Please enter a value less than or equal to 100',
                                greaterThanEqual: 'Please enter a value greater than or equal to the condition start'
                            }
                        }
                    });

                    var validator = $( "#form-validate-new-discount" ).validate();
                    validator.resetForm();
                });
     
                $('#form-validate').validate();
                
                // uniform
                $('[data-form=uniform]').uniform();
                
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
