<?php
$payment = new payment();
$payment->byCompany($company->id);
//setlocale(LC_MONETARY, 'en_US');
//$totalPrice = money_format('%i', (($payment->u_mobile * $priceUserMobile) + ($payment->u_web * $priceUserWeb)));
$invoice = number_format($payment->invoice,2,",",".");

?>

<!-- content-header -->
                        <div class="content-header">
                            <?php if($isAdmin){ ?>
                            <ul class="content-header-action pull-right">
                                <li>
                                    <a href="/pages/lesson-reports.php">
                                        <div class="badge-circle grd-teal color-white"><i class="icofont-book"></i></div>
                                        <div class="action-text color-teal"><?php echo $payment->lessons; ?> <span class="helper-font-small color-silver-dark">Lessons</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="/pages/invoice-detail.php?id=<?php echo $payment->id; ?>">
                                        <div class="badge-circle grd-orange color-white"></i>$</div>
                                        <div class="action-text color-orange"><?php echo $invoice; ?> <span class="helper-font-small color-silver-dark">Invoice</span></div>
                                    </a>
                                </li>
                            </ul>
                            <?php } ?>
                            <h2><i class="icofont-bookmark"></i> Learn</h2>
                        </div><!-- /content-header -->
                        