<!DOCTYPE html>
<html lang="en">
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
                <div class="logo"><img src="<?=base_url("assets/dashboard/images/logo.png")?>" alt=""></div>
            </div>
            <div class="col-md-6">
                <div class="right-menu">
                    <div class="sign-in-btn pull-right">
                        Sign in 
                    </div>
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
                        <h1>ADI</h1>
                        <h3 class="paid">Paid</h3>
                        <div class="amount-due-label">BALANCE DUE</div>
                        <h3>$0.00</h3>
                        <p>We sent you and your merchant a confirmation email</p>
                    </div>
                    <div class="footer">
                        <div class="copyright"> © 2021 Intuit Inc. All rights reserved. <a href="">Privacy</a> | <a href="">Terms of service</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="widget">
                    <div class="body">
                        <div class="logo"><img src="<?=base_url("assets/dashboard/images/logo.png")?>"></div>
                        <div class="company-name info">nSmart</div>
                        <div class="row info">
                            <div class="col-md-6">Invoice</div>
                            <div class="col-md-6 text-right value">1010</div>
                        </div>
                        <div class="row info">
                            <div class="col-md-6">Due date</div>
                            <div class="col-md-6 text-right value">March 3, 2021</div>
                        </div>
                        <div class="row info">
                            <div class="col-md-6">Invoice amount</div>
                            <div class="col-md-6 text-right value">$1.00</div>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="btns">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-default view-invoice-btn" type="button">View Invoice</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <button type="button" class="non-styled download-btn"><i class="fa fa-download" aria-hidden="true"></i></button>
                                        <button type="button" class="non-styled download-btn"><i class="fa fa-print" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget">
                    <div class="body">
                        <div class="label bold">Merchant details</div>
                        <div class="label">Email: <a href="">sales@adialarms.com</a></div>
                        <hr>
                        <center><i class="fa fa-angle-up" aria-hidden="true"></i></center>
                        <div class="marchant-info-hiden">
                            <div class="contacts">
                                <div class="group">
                                    <div class="icon"><i class="fa fa-address-book-o" aria-hidden="true"></i></div>
                                    <div class="info">
                                        <div class="label"><a href="">(850) 619-5914</a></div>
                                        <div class="label"><a href="">nsmartrac.com</a></div>
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="info">
                                        <div class="label"><a href="">6055 BORN CT, PENSACOLA, FL 32504</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
</body>
</html>