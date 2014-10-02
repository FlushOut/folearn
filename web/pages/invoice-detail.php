<?php
require_once("../config.php");


if (!$_GET['id']) die();
$pay = new payment();
$pay->open($_GET['id']);

$country = new country();
$country->open($company->fk_country);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Invoice #<?php echo $pay->sequence; ?> | FOLearn</title>
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
        <link href="../css/elusive-webfont.css" rel="stylesheet" />

        <link href="../css/datepicker.css" rel="stylesheet" />
        <link href="../css/select2.css" rel="stylesheet" />
        <link href="../css/bootstrap-wysihtml5.css" rel="stylesheet" />
        
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
                            <!--breadcrumb-nav-->
                            <ul class="breadcrumb-nav pull-right">
                                <li class="divider"></li>
                                <li class="btn-group">
                                    <a class="btn btn-small btn-link" target="_blank" href="invoice-print.php?id=<?php echo $pay->id; ?>" title="print invoice">
                                        <i class="icofont-print"></i>Print Invoice
                                    </a>
                                </li>
                            </ul><!--/breadcrumb-nav-->
                            
                            <!--breadcrumb-->
                            <ul class="breadcrumb">
                                <li><a href="#"><i class="icofont-home"></i> Invoice</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">Invoice</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- invoice -->
                            <div id="invoice-container" class="invoice-container">
                                <div class="page-header">
                                    <h3>Invoice #<?php echo $pay->sequence; ?></h3>
                                </div>
                                <div class="row-fluid">
                                    <div class="span4">
                                        <p class="muted">From</p>
                                        <p>FlushOut Solutions</p>
                                        <p>contact@flushoutsolutions.com</p>
                                    </div>
                                    <div class="span4">
                                        <p class="muted">To</p> 
                                        <p><?php echo $company->name; ?></p>
                                        <p><?php echo $user->name; ?></p>
                                    </div>
                                    <div class="span4">
                                        <p>Invoice No. <?php echo $pay->sequence; ?></p>
                                        <p>Billing Period. <?php echo date('F jS Y', strtotime($pay->date_start)); ?> - <?php echo date('F jS Y', strtotime($pay->date_end)); ?></p>
                                        <p>Payment Date. <?php echo date('F jS Y', strtotime($pay->date_end)); ?></p>
                                    </div>
                                </div>
                                <div class="invoice-table">
                                    <table class="table table-bordered invoice responsive">
                                        <thead>
                                            <tr>
                                                <th>ITEM DESCRIPTIONS</th>
                                                <th>QTY</th>
                                                <th colspan="2">TOTAL VALUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Lessons</td>
                                                <td class="right"><?php echo $pay->lessons; ?></td>
                                                <td colspan="2" class="right">(<?php echo $country->currency;?>) <?php echo number_format($pay->invoice,2,",","."); ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Invoice Totals</th>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Lessons Value</td>
                                                <td class="right">(<?php echo $country->currency;?>) <?php echo number_format($pay->invoice,2,",","."); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Total to Pay (5%)</td>
                                                <td class="right">(<?php echo $country->currency;?>) <?php echo number_format($pay->invoice*0.05,2,",","."); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--/invoice-->
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

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

        <script src="../js/datepicker/bootstrap-datepicker.js"></script>
        <script src="../js/select2/select2.js"></script>
        <script src="../js/wysihtml5/wysihtml5-0.3.0.js"></script>
        <script src="../js/wysihtml5/bootstrap-wysihtml5.js"></script>

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
                
                // uniform
                $('[data-form=uniform]').uniform();
            });
      
        </script>
    </body>
</html>