<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <h2 class="page-title">Jobs</h2>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('invoice') ?>"
                                          method="get">
                                        <div class="form-group" style="margin:0 !important;">
                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                   class="form-control form-control-md"
                                                   name="search"
                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                   type="text"
                                                   placeholder="Search...">
                                            <button class="btn btn-primary btn-md" style="margin-right:10px;" type="submit"><span
                                                        class="fa fa-search"></span> Search</button>
                                        </div>
                                    </form>
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md" href="<?php echo url('job/new_job') ?>">
                                            <span class="fa fa-plus"></span> New</a>
                                        </div>
                                    </div>
                                    <div class="float-right d-md-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">   
                                <?php if (!empty($jobs)) { ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center"><strong>Job Number</strong></th>
                                            <th scope="col" class="text-center"><strong>Date</strong></th>
                                            <th scope="col" class="text-center"><strong>Job & Customer</strong></th>
                                            <th scope="col" class="text-center"><strong>Status</strong></th>
                                            <th scope="col" class="text-center"><strong>Amount</strong></th>
                                            <th scope="col" class="text-center"><strong>Manage</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach($jobs as $job) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo $job->job_number; ?></td>
                                            <td class="text-center"><?php echo date_format(date_create($job->created_date),"Y/m/d"); ?></td>
                                            <td class="text-center"><?php echo $job->job_name; ?> - <?php echo getLoggedFullName($job->created_by); ?></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>  
                                <?php } else { ?>
                                    <div class="page-empty-container">
                                        <h5 class="page-empty-header">There are no Jobs</h5>
                                        <p class="text-ter margin-bottom">Manage your job.</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({

        columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        }],
        select: {
            'style': 'multi'
        },
        order: [[1, 'asc']],
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

</script>