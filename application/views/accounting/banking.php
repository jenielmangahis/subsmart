<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/banking'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="margin-left: 50px;padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="link_bank")?:'-active';?>" style="text-decoration: none">Banking</a>
                        <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                        <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 0 70px 10px;">
                        <ul class="nav nav-tabs banking-tab-container">
                            <li class="banking-sub-active"><a data-toggle="tab" href="#forReview" class="banking-sub-tab">For Review</a></li>
                            <li><a data-toggle="tab" href="#reviewed" class="banking-sub-tab">Reviewed</a></li>
                            <li><a data-toggle="tab" href="#excluded" class="banking-sub-tab">Excluded</a></li>
                        </ul>
                        <div class="tab-content" style="padding-top: 20px">
                            <div id="forReview" class="tab-pane fade in active">
                                <table id="banking_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Payee</th>
                                        <th>Category or Match</th>
                                        <th>Spent</th>
                                        <th>Received</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>06/29/2020</td>
                                        <td>CHECK #2701 2701</td>
                                        <td>Mike Bell Jr</td>
                                        <td></td>
                                        <td>$320</td>
                                        <td></td>
                                        <td><a href="">View</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="reviewed" class="tab-pane fade">
                                <h3>Menu 1</h3>
                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div id="excluded" class="tab-pane fade">
                                <h3>Menu 2</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function() {
        $('#banking_table').DataTable();
    } );
    $('.banking-sub-tab').click(function(){
        $(this).parent().addClass('banking-sub-active').siblings().removeClass('banking-sub-active')
    });

    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });

</script>
