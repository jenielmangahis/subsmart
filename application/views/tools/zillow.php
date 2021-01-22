<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    
    <?php $this->load->view('includes/sidebars/api_connectors', $sidebar)?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Zillow API</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">

                            </li>
                        </ol>
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

<script>
    $('.qb-customers').DataTable({
        'searching' : false,
        "lengthChange": false
    });
</script>


