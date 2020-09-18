<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/affiliate'); ?>
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
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Affiliate Partners</h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <!-- <a href="<?php echo url('affiliate/add') ?>" class="btn btn-primary" aria-expanded="false">
									<i class="mdi mdi-settings mr-2"></i> New inquiry
								</a>    -->
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('affiliate/add') ?>"><span
                                                            class="fa fa-plus"></span> Add New Affiliate</a>
                                            <?php //endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Affiliate Name: </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Email: </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-right-sm justify-content-end">
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-default btn-md margin-left-sec" href="" target="_blank"><span
                                                    class="fa fa-download"></span> &nbsp; Import CSV</a>
                                            <a class="btn btn-default btn-md margin-left-sec" href="" target="_blank"><span
                                                    class="fa fa-download"></span> &nbsp; Export CSV</a>
                                            <a class="btn btn-default btn-md margin-left-sec" href="" target="_blank"><span
                                                    class="fa fa-download"></span> &nbsp; Print</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-4">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Company: </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-4">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Status: </label>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option value="all">All</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-3 mt-4 justify-content-end">
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-4 mb-4" role="alert">
                            <span style="color:black;">Affiliates partners are other professionals who refer new leads/clients to you. They are often Mortgage Brokers, Realtors, Auto Dealers, whose business depends upon having clients with good credit. Visit Affiliate Payments to set commission options and record payments for your affiliates. To see an overview of revenue from affiliates on your Afiliate Stats Dashboard. </span>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                    <table class="table table-hover table-to-list" id="affiliateListTbl" data-id="work_orders">
                                        <thead>
                                        <tr class="text-center">
                                            <th>Affiliate Name</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Client Referred</th>
                                            <th>Phone</th>
                                            <th>Added</th>
                                            <th>Status</th>
                                            <th>Send Login</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                            <?php foreach($affiliates as $affiliate) : ?>
                                            <tr class="text-center">
                                                <td><?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?></td>
                                                <td><?php echo $affiliate->company; ?></td>
                                                <td><?php echo $affiliate->email; ?></td>
                                                <td><?php echo '0' ?></td>
                                                <td><?php echo $affiliate->phone; ?></td>
                                                <td><?php echo $affiliate->date_created; ?></td>
                                                <td><?php echo $affiliate->status; ?></td>
                                                <td><span class="fa fa-envelope"></td>
                                                <td>
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"  data-id="<?php echo $affiliate->id; ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('affiliate/delete?id='.$affiliate->id); ?>" class="deleteAffiliateCurrentForm"><span class="fa fa-trash-o icon"></span> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <tbody>
                                        </tbody>

                                    </table>
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

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

</script>
