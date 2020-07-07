<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/api_connectors'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Google Contacts</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
								
							</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
						<div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('users_add')): ?>
                                    <!-- <a href="<?php //echo url('users/add') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Employee
                                    </a> -->
                                <?php //endif ?>
                            </div>
                        </div>
						
                    </div>
					<div class="col-sm-8">
						<p class="margin-bottom">
						Export your <span class="weight-medium">Markate Customers</span> to <span class="weight-medium">Google Contacts</span> so you can identify the customers on your phone Caller ID or on sending emails from Gmail.
					</p>
					<p class="margin-bottom">
						<span class="weight-medium">Important Notice</span><br>
						- in order to add new contacts we'll need write permission to your Google Contacts<br>
						- please stay assured that Markate will only add contacts and it will not read and delete any existent contacts<br>
					</p>
					<hr>
					<div class="weight-medium text-lg margin-bottom-sec">Connect to Google Contacts</div>
					<a href="#"><img src="/assets/img/api-tools/btn_google_signin_dark_normal_web.png"></a>
					</div>
					<div class="col-sm-4 text-right">
						<!--<img src="/assets/img/api-tools/thumb_google_contacts.png" alt="google contacts">-->
					</div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

