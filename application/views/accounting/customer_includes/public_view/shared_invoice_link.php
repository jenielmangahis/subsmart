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
        href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet"
        href="<?php echo $url->assets ?>plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="<?=base_url("assets/css/accounting/accounting_includes/public_view_shared_invoice_link.css")?>">
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
                        <h1><?=$customer_info->business_name?>
                        </h1>
                        <h3 class="status <?=$status?>"><?=$status?>
                        </h3>
                        <div class="amount-due-label">BALANCE DUE</div>
                        <h3>$<?=number_format($balance, 2, '.', ',')?>
                        </h3>
                        <p>We sent you and your merchant a confirmation email</p>
                    </div>
                    <div class="footer">
                        <div class="copyright"> © 2021 Intuit Inc. All rights reserved. <a href="">Privacy</a> | <a
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
                                    <button class="btn btn-default view-invoice-btn" type="button" data-file="<?=base_url("assets/pdf/".$pdf_file)?>">View Invoice</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <button type="button" class="non-styled download-btn" data-inv="<?=$no?>" data-file="<?=base_url("assets/pdf/".$pdf_file)?>"><i class="fa fa-download"
                                                aria-hidden="true"></i></button>
                                        <button type="button" class="non-styled print-btn" data-file="<?=base_url("assets/pdf/".$pdf_file)?>"><i class="fa fa-print"
                                                aria-hidden="true"></i></button>
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
    <div id="pdf-viewer-modal" >
        <div class="container">
            <div class="close-btn">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <div class="the-body">
                <iframe id="pdf-iframe" src="<?=base_url("assets/pdf/".$pdf_file)?>" frameborder="0"></iframe>
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