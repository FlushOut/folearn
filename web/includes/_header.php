<?php

$company->open($company->id);

if ($_POST['action'] == 'SaveCompany') {
     if (isset($_POST['txtCompanyName'])){
        $company->save($_POST['txtCompanyName'], $_FILES["txtCompanyLogo"]["tmp_name"],$_FILES["txtCompanyLogo"]["type"]);
        $company->open($company->id);
    }
}

?>

<script type="text/javascript">
    function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>
<header class="header" data-spy="affix" data-offset-top="0">
            <!--nav bar helper-->
            <div class="navbar-helper">
                <div class="row-fluid">
                    <!--panel site-name-->
                    <div class="span2">
                        <div class="panel-sitename">
                            <h2><a href="<?php echo $url; ?>"><span class="color-teal">fo</span>Learn</a></h2>
                        </div>
                    </div>
                    <!--/panel name-->

                    <div class="span6">
                    </div>
                    <div class="span4">
                        <!--panel button ext-->
                        <div class="panel-ext">
                            <div class="btn-group">
                                <a class="btn btn-inverse btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo $user->name ?>
                                </a>
                            </div>
                            <div class="btn-group user-group">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <img class="corner-all" align="middle" src="../img/user-thumb.jpg" title="<?php echo $user->name ?>" alt="<?php echo $user->name ?>" /> <!--this for display on PC device-->
                                    <button class="btn btn-small btn-inverse"><?php echo $user->name ?></button> <!--this for display on tablet and phone device-->
                                </a>
                                <ul class="dropdown-menu dropdown-user" role="menu" aria-labelledby="dLabel">
                                    <li>
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img class="../img-circle" src="../img/user.jpg" title="profile" alt="profile" />
                                            </a>
                                            <div class="media-body description">
                                                <p><strong><?php echo $user->name ?></strong></p>
                                                <p class="muted"><?php echo $company->name ?></p>
                                                <p class="muted"><?php echo $user->email ?></p>
                                                <?php
                                                if($isAdmin){
                                                ?>                                                    
                                                    <p><a role="button" class="btn btn-link" style="padding-left:0;" data-toggle="modal" href="#myModalConfiguration">Setting</a></p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-footer">
                                        <div>
                                            <a class="btn btn-small pull-right" href="/pages/logout.php">Logout</a>
                                            <a class="btn btn-small" style="visibility:hidden;" href="#"></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!--panel button ext-->
                    </div>
                </div>
            </div><!--/nav bar helper-->
        </header>

        <!-- Modal-->
        <div id="myModalConfiguration" style="height: 200px; width: 350px; margin-left:-180px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Company</h3>
            </div>
            <div style="position: relative;overflow-y: auto;padding: 15px;max-height:490px;" class="content-modal">
                <form class="form-horizontal" style="height:470px;" id="form-validate-company" action="" method="post" />
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>
                                <input  type="text" id="txtCompanyName" name="txtCompanyName" data-validate="{required: true, messages:{required:'Please enter field required'}}" class="grd-white" value="<?php echo $company->name ?>" />
                            </td>    
                        </tr>
                        <tr style="display:none;">
                            <td>Logo</td>
                            <td>
                                <p>
                                <input type="file" id="txtCompanyLogo" name="txtCompanyLogo" class="smallinput" accept="image/*" value=""/>
                                </p>
                                <p>
                                    <span style="color:#999;" class="helper-font-small">Logo of company</span>
                                </p>
                                <span class="field">
                                    <?php echo '<p><img src="data:'.$company->logo_type.';base64,' . base64_encode( $company->logo ) . '" width="150px" height="60px" /></p>'; ?>
                                </span>
                            </td>    
                        </tr>
                        <tr>
                            <td></td>
                            <td><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button class="btn btn-primary" id="btnSaveCompany" name="action" value="SaveCompany">Save</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                //$('#form-validate-company').validate();
            })
        </script>