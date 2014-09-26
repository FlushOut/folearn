<?php
require_once("../config.php");

$userAdd = false;
$userUpd = false;
$userDel = false;
$userPro = false;

$newUser = new user();
if ($_POST['action'] == 'Save') {
    if (isset($_POST['hdIdAct'])) {
        if ($_POST['hdIdAct'] == ""){
            $newUser->save($company->id, $_POST['txtName'], $_POST['email'], $_POST['phone'], $_POST['txtPassword']);
            $userAdd = true;
        }else{
            $newUser->open($_POST['hdIdAct']);
            $newUser->save($company->id, $_POST['txtName'], $_POST['email'], $_POST['phone'], $_POST['txtPassword']);
            $userUpd = true;
        }
    }
}
if ($_POST['action'] == 'SaveProfiles') {
    if (isset($_POST['hdIdUP'])) {
        $newUser->saveProfiles($_POST['hdIdUP'],$_POST['prof']);
        $userPro = true;
    }

}

if ($_POST['action'] == 'Delete') {
    if (isset($_POST['hdIdDE'])) {
        $newUser->open($_POST['hdIdDE']);
        $newUser->del();
        $userDel = true;
    }

}

$list_users = $newUser->list_users($company->id);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>User | FOLearn</title>
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
if($userAdd){
    echo '<style type="text/css">
        div[name=userAdded] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=userAdded] {
            display: none !important;
        }
        </style>';
}

if($userUpd){
    echo '<style type="text/css">
        div[name=userUpdated] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=userUpdated] {
            display: none !important;
        }
        </style>';
}

if($userDel){
    echo '<style type="text/css">
        div[name=userDeleted] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=userDeleted] {
            display: none !important;
        }
        </style>';
}

if($userPro){
    echo '<style type="text/css">
        div[name=userProfile] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=userProfile] {
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
                                <li><a href="#"><i class="icofont-home"></i> Users</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div name="userAdded" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your user was created
                            </div>
                            <div name="userUpdated" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your user was updated
                            </div>
                            <div name="userDeleted" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your user was deleted
                            </div>
                            <div name="userProfile" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> The profile of your user was updated
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Users&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#myModal" role="button" class="btn" data-toggle="modal" id="aAdd">Add</a>
                                                    <!-- Modal Save/Edit-->
                                                    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Information</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" id="form-validate-new-user" action="" method="post" />
                                                                    <table>
                                                                        <tr>
                                                                            <td>Name</td>
                                                                            <td>
                                                                                <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                                                <input type="text" class="grd-white" id="txtName" name="txtName" />
                                                                            </td>    
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td>
                                                                                <input type="text" class="grd-white" name="email" id="email" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Phone</td>
                                                                            <td>
                                                                                <input type="text" class="grd-white" name="phone" id="phone" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Password</td>
                                                                            <td>
                                                                                <input type="password" id="txtPassword" name="txtPassword" class="grd-white" name="password" id="password" />
                                                                            </td>    
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                            <button class="btn btn-primary" id="btnSave" name="action" value="Save">Save</button></td>
                                                                        </tr>
                                                                    </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Profile-->
                                                    <div id="myModalProfiles" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Select Profiles</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                                <input name="hdIdUP" id="hdIdUP" type="hidden"/>
                                                                <div class="control-group">
                                                                    <div class="controls">
                                                                    </div>
                                                                </div>
                                                                <p align="center">
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                <button class="btn btn-primary" id="btnSaveProfiles" name="action" value="SaveProfiles">Save</button>
                                                                </p>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Delete-->
                                                    <div id="myModalDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left: -120px;margin-top: 100px;width: 260px;">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Delete User</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                                <input name="hdIdDE" id="hdIdDE" type="hidden"/>
                                                                <div class="control-group">
                                                                    <label class="control-label">Are you sure?</label>
                                                                </div>
                                                                <p align="center">
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                <button class="btn btn-primary" id="btnDelete" name="action" value="Delete">Delete</button>
                                                                </p>
                                                            </form>
                                                        </div>
                                                    </div>

                                        </div>
                                        <div class="box-body">
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">Id</th>
                                                        <th class="head1">Name</th>
                                                        <th class="head0">Email</th>
                                                        <th class="head1">Phone</th>
                                                        <th class="head0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_users as $item) { ?>
                                                        <tr src="user">
                                                            <td><?php echo $item->id; ?><input name="hdId" type="hidden" value="<?php echo $item->id; ?>"/></td>
                                                            <td><?php echo $item->name; ?><input name="hdName" type="hidden" value="<?php echo $item->name; ?>"/></td>
                                                            <td><?php echo $item->email; ?>
                                                                <input name="hdEmail" type="hidden" value="<?php echo $item->email; ?>"/>
                                                            </td>
                                                            <td><?php echo $item->phone; ?>
                                                                <input name="hdPhone" type="hidden" value="<?php echo $item->phone; ?>"/>
                                                            </td>
                                                            <td>
                                                                <a href="#myModal" role="button" class="btn btn-link" data-toggle="modal" id="aEdit">Edit</a>
                                                                <a href="#myModalDelete" role="button" class="btn btn-link" data-toggle="modal" id="aDelete">Delete</a>
                                                                <a href="#myModalProfiles" role="button" class="btn btn-link" data-toggle="modal" id="aProfiles">Profiles</a>
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
                    $("div[name=userAdded]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=userUpdated]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=userDeleted]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=userProfile]").fadeTo(200, 0).slideUp(200, function(){
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
                    $('#txtName').focus();
                });
                $("#txtName").focusout(function(){
                  $('#email').focusout();
                });
               
                //Edit Profile users
                $('a#aProfiles').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getProfiles";

                        $("#hdIdUP").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                $(".controls").html(resp);
                            });
                    });
                    return true;
                });

                //delete Profile users
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
                    var name;
                    var emailAnt;
                    var phone;

                    $('#form-validate-new-user').removeData('validator');

                    jQuery(this).parents('tr').map(function () {
                        id = jQuery('input[name="hdId"]', this).val();
                        name = jQuery('input[name="hdName"]', this).val();
                        emailAnt = jQuery('input[name="hdEmail"]', this).val();
                        phone = jQuery('input[name="hdPhone"]', this).val();
                    });   

                    $("#hdIdAct").val(id);
                    $("#txtName").val(name);                       
                    $("#email").val(emailAnt);
                    $("#phone").val(phone);
                    $("#btnSave").text('Update');

                    $("#form-validate-new-user").validate({
                        rules: {
                            txtName: {
                                required:false
                            },    
                            email: {
                                required:false,
                                email:true,
                                remote: {
                                    url:'/ajax/validateemailup.php',
                                    data: {
                                        emailnew: function(){
                                            return $("#email").val();
                                        },
                                        emailold: emailAnt
                                    }    
                                }
                            },
                            txtPassword: {
                                required:false,
                                minlength:6
                            },
                            phone: {
                                required:false,
                                number:true
                            }
                        },
                        messages: {
                            email: {
                                email: 'Please enter valid email address',
                                remote: 'this new email is already in use'
                            },
                            txtPassword: {
                                minlength: 'Please enter at least 6 characters'
                            },
                            phone: {
                                number: 'May contain digits only'
                            }
                        }
                    });

                    var validator = $( "#form-validate-new-user" ).validate();
                    validator.resetForm();
                });

                // validate form
                $("a#aAdd").bind('click', function () {
                    $("#hdIdAct").val('');
                    $("#txtName").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#txtPassword").val('');
                    $("#btnSave").text('Save');

                    $('#form-validate-new-user').removeData('validator');

                    $("#form-validate-new-user").validate({
                        rules: {
                            txtName: {
                                required:true
                            },
                            email: {
                                required:true,
                                email:true,
                                remote:'/ajax/validateemail.php'
                            },
                            txtPassword: {
                                required:true,
                                minlength:6
                            },
                            phone: {
                                required:true,
                                number:true
                            }
                        },
                        messages: {
                            txtName: {
                                required:'Please enter field name'
                            },
                            email: {
                                required: 'Please enter field email',
                                email: 'Please enter valid email address',
                                remote: 'This email is already in use'
                            },
                            txtPassword: {
                                required: 'Please enter field password',
                                minlength: 'Please enter at least 6 characters'
                            },
                            phone: {
                                required: 'Please enter field phone',
                                number: 'Please enter valid phone'
                            }
                        }
                    });

                    var validator = $( "#form-validate-new-user" ).validate();
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
