<!DOCTYPE html>
<html lang="en">
<?php
$this->page_data['date']=$inv->date_issued;
                $this->page_data['no']=$inv->invoice_number;
                $this->page_data['duedate']=$inv->due_date;
                $this->page_data['balance']=$balance;
                $this->page_data['invoice_amount']=$receivable_payment;
                $this->page_data['last_delivered']="";
                $this->page_data['email']=$inv->customer_email;
                $this->page_data['atatchement']="";
                $this->page_data['status']=$status;
                // var_dump($customer_info);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice nSmartrac</title>
    <link
        href="<?=base_url()?>assets/dashboard/css/bootstrap.min.css"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet"
        href="<?=base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="<?=base_url("assets/css/accounting/accounting_includes/public_view_shared_invoice_link.css")?>">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-border-red,.w3-hover-border-red:hover{border-color: #00a300!important;}
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="row">
            <div class="col-md-6">
                <div class="logo"><img
                        src="<?=base_url("assets/dashboard/images/logo.png")?>"
                        alt=""></div>
            </div>
            <div class="col-md-6">
                <div class="right-menu">
                    <a
                        href="<?=base_url("login")?>">
                        <div class="sign-in-btn pull-right">
                            Sign in
                        </div>
                    </a>
                    <div class="avatar pull-right">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="widget main">
                    <div class="body">
                        <?php echo $status;
                         if($status == 'Paid'){ ?>
                        <h1><?=$customer_info->business_name?>
                        </h1>
                        <h3 class="status <?=$status?>"><?=$status?>
                        </h3>
                        <div class="amount-due-label">BALANCE DUE</div>
                        <h3>$<?=number_format($balance, 2, '.', ',')?>
                        </h3>
                        <p>We sent you and your merchant a confirmation email</p>
                        <?php }else{ ?>
                            
                            <div style="text-align:left;">
                                <small class="help help-sm"><b>PAYMENT AMOUNT</b></small><br>
                                <input type="text" value="<?=number_format($invoice_amount, 2, '.', ',')?>" class="" style="outline: 0;border-width: 0 0 2px;border-color: gray;font-size: 1.4rem;width:100%;">
                                <br><br>
                            </div>

                            <div class="w3-row">
                                <a href="javascript:void(0)" onclick="openCity(event, 'Debit');">
                                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Debit card</div>
                                </a>
                                <a href="javascript:void(0)" onclick="openCity(event, 'Transfer');">
                                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Bank transfer</div>
                                </a>
                                <a href="javascript:void(0)" onclick="openCity(event, 'Credit');">
                                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Credit card</div>
                                </a>
                            </div>

                            <div id="Debit" class="w3-container city" style="display:block;text-align:left;">
                                <br>
                                <small class="help help-sm"><b>Name on card</b></small>
                                <input type="text" class="form-control" placeholder="First name Last name">
                                <br>
                                <small class="help help-sm"><b>Card number</b></small>
                                <input type="text" class="form-control" placeholder="1234 5678 9000 0000">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <small class="help help-sm"><b>Exp date</b></small>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-4">
                                        <small class="help help-sm"><b>CVV code</b></small>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                    <div class="col-md-4">
                                        <small class="help help-sm"><b>ZIP code</b></small>
                                        <input type="text" class="form-control" placeholder="12345">
                                    </div>
                                </div>
                                <br>
                                    <p style="font-size:11px;">Save a payment method for faster future payments. <a href="#">Sign in</a> <a href="#">or create account</a>. </p>
                                <br>
                                <center><button class="btn btn-success" style="width:100%">Pay <?=number_format($invoice_amount, 2, '.', ',')?></button>
                                <br><br>
                                <span style="font-size:11px;">By selecting <b>Pay</b>, I accept the <a class="termsOfServiceFooter" href="/payor-terms-of-service" target="_blank">Terms of Service</a> and have read and acknowledge the <a href="https://security.intuit.com/index.php/privacy" target="_blank">Privacy Statement</a>. I also allow Intuit to charge $1,199.85 to my card on September 21, 2021.</span></center>
                            </div>

                            <div id="Transfer" class="w3-container city" style="text-align:left;display:none">
                                <br>
                                <small class="help help-sm"><b>Name on card</b></small>
                                    <select name="accountType" class="form-control">
                                        <option value="PERSONAL_CHECKING" class="jsx-3044598077">Personal checking</option>
                                        <option value="PERSONAL_SAVINGS" class="jsx-3044598077">Personal savings</option>
                                        <option value="BUSINESS_CHECKING" class="jsx-3044598077">Business checking</option>
                                        <option value="BUSINESS_SAVINGS" class="jsx-3044598077">Business savings</option>
                                    </select>
                                <br>
                                <small class="help help-sm"><b>Routing number</b></small>
                                <input type="text" class="form-control" placeholder="Routing number">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="help help-sm"><b>Account number</b></small>
                                        <input type="text" class="form-control" placeholder=" Account number">
                                    </div>
                                    <div class="col-md-6">
                                        <small class="help help-sm"><b>Confirm account number</b></small>
                                        <input type="text" class="form-control" placeholder="Confirm account number">
                                    </div>
                                </div>
                                <br>
                                <small class="help help-sm"><b>Account holder's name</b></small>
                                <input type="text" class="form-control">
                                <br>
                                    <p style="font-size:11px;">Save a payment method for faster future payments. <a href="#">Sign in</a> <a href="#">or create account</a>. </p>
                                <br>
                                <center><button class="btn btn-success" style="width:100%">Pay <?=number_format($invoice_amount, 2, '.', ',')?></button>
                                <br><br>
                                <span style="font-size:11px;">By selecting <b>Pay</b>, I accept the <a class="termsOfServiceFooter" href="/payor-terms-of-service" target="_blank">Terms of Service</a> and have read and acknowledge the <a href="https://security.intuit.com/index.php/privacy" target="_blank">Privacy Statement</a>. I also allow Intuit to charge $1,199.85 to my card on September 21, 2021.</span></center>
                            </div>

                            <div id="Credit" class="w3-container city" style="text-align:left;display:none">
                                <br>
                                <small class="help help-sm"><b>Name on card</b></small>
                                <input type="text" class="form-control" placeholder="First name Last name">
                                <br>
                                <small class="help help-sm"><b>Card number</b></small>
                                <input type="text" class="form-control" placeholder="1234 5678 9000 0000">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <small class="help help-sm"><b>Exp date</b></small>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-4">
                                        <small class="help help-sm"><b>CVV code</b></small>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                    <div class="col-md-4">
                                        <small class="help help-sm"><b>ZIP code</b></small>
                                        <input type="text" class="form-control" placeholder="12345">
                                    </div>
                                </div>
                                <br>
                                    <p style="font-size:11px;">Save a payment method for faster future payments. <a href="#">Sign in</a> <a href="#">or create account</a>. </p>
                                <br>
                                <center><button class="btn btn-success" style="width:100%">Pay <?=number_format($invoice_amount, 2, '.', ',')?></button>
                                <br><br>
                                <span style="font-size:11px;">By selecting <b>Pay</b>, I accept the <a class="termsOfServiceFooter" href="/payor-terms-of-service" target="_blank">Terms of Service</a> and have read and acknowledge the <a href="https://security.intuit.com/index.php/privacy" target="_blank">Privacy Statement</a>. I also allow Intuit to charge $1,199.85 to my card on September 21, 2021.</span></center>
                            </div>

                        <?php } ?>
                    </div>
                    <div class="footer">
                        <div class="copyright"> © 2021 nSmarTrac. All rights reserved. <a href="">Privacy</a> | <a
                                href="">Terms of service</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="widget">
                    <div class="body">
                        <div class="logo">
                            <?php
                            $filePath=base_url()."uploads/users/business_profile/".$customer_info->business_id."/".$customer_info->business_image;
                            if (@getimagesize($filePath)) {
                                echo '<img src="'.$filePath.'">';
                            }
                            ?>
                        </div>
                        <div class="company-name info"><?=$customer_info->business_name?>
                        </div>
                        <div class="row info">
                            <div class="col-md-6">Invoice</div>
                            <div class="col-md-6 text-right value"><?=$no?>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-md-6">Due date</div>
                            <div class="col-md-6 text-right value"><?=date("F d, Y", strtotime($duedate))?>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-md-6">Invoice amount</div>
                            <div class="col-md-6 text-right value">$<?=number_format($invoice_amount, 2, '.', ',')?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="btns">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-default view-invoice-btn" type="button"
                                        data-file="<?=base_url("assets/pdf/".$pdf_file)?>">View
                                        Invoice</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <button type="button" class="non-styled download-btn"
                                            data-inv="<?=$no?>"
                                            data-file="<?=base_url("assets/pdf/".$pdf_file)?>"><i
                                                class="fa fa-download" aria-hidden="true"></i></button>
                                        <button type="button" class="non-styled print-btn"
                                            data-file="<?=base_url("assets/pdf/".$pdf_file)?>"><i
                                                class="fa fa-print" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget">
                    <div class="body marchant-details">
                        <div class="label bold">Merchant details</div>
                        <div class="label">Email: <a href=""><?=$customer_info->business_email?></a>
                        </div>
                        <hr>
                        <center><i class="fa fa-angle-down see-more-btn" aria-hidden="true"></i></center>
                        <div class="marchant-info-hiden">
                            <div class="contacts">
                                <div class="group">
                                    <div class="icon"><i class="fa fa-address-book-o" aria-hidden="true"></i></div>
                                    <div class="info">
                                        <div class="label"><a href=""><?=$customer_info->business_phone?></a>
                                        </div>
                                        <div class="label"><a href=""><?=$customer_info->website?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="info">
                                        <div class="label"><a href=""><?=$customer_info->bus_street?>
                                                <?=$customer_info->bus_city?>,
                                                <?=$customer_info->bus_state?>
                                                <?=$customer_info->bus_postal_code?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="pdf-viewer-modal">
        <div class="container">
            <div class="close-btn">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <div class="the-body">
                <iframe id="pdf-iframe"
                    src="<?=base_url("assets/pdf/".$pdf_file)?>"
                    frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <script
        src="<?=base_url("/assets/dashboard/js/jquery.min.js")?>">
    </script>
    <script
        src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js">
    </script>
    <script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js">
    </script>
    <script
        src="<?=base_url("assets/js/accounting/sales/customer_includes/public_view_shared_invoice_link.js")?>">
    </script>
</body>

</html>