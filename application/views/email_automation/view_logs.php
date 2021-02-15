<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <div wrapper__section>
        <div class="card"> 
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                      <h3 class="page-title mt-0">Log for Email Automation</h3>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="<?php echo url('email_automation') ?>">Return to Email Automation</a>
                        </div>
                    </div>
                </div>
                <p style="margin-top: 20px;font-size: 17px;">Listing for <b><?= $emailAutomation->name; ?></b></p>
                <div class="tabs" style="margin-top: 20px;">
                    <ul class="clearfix work__order" id="myTab" role="tablist">
                        <li class="active">
                            <a class="nav-link active" href="<?php echo base_url('workorder') ?>" aria-controls="tab1" aria-selected="true">Sent(0)</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo base_url('workorder') ?>" aria-controls="tab1" aria-selected="true">Pending(0)</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo base_url('workorder') ?>" aria-controls="tab1" aria-selected="true">Cancelled(0)</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                        <table class="table table-hover table-to-list">
                            <thead>
                            <tr>
                                <th>Notify Date</th>
                                <th>Send on</th>
                                <th>For</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
</div>