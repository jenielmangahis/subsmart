<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/invoice'); ?>
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
                                    <h3 class="page-title">Recurring Invoices</h3>

                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('invoice/recurring/add') ?>"><span
                                                            class="fa fa-plus"></span> Add Recurring Invoice</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <p>
                                        Listing all recurring invoices.
                                    </p>
                                </div>
                            </div>
                        </div>                        
                        <div class="tabs">
                            <ul class="clearfix work__order" id="myTab" role="tablist">
                                <li <?php echo ((empty($tab)) || $tab == 1) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('invoice/recurring') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">All
                                        (<?php echo get_recurring_count(1) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab2"
                                       href="<?php echo base_url('invoice/recurring/2') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Active
                                        (<?php echo get_recurring_count(2) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 3) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab3"
                                       href="<?php echo base_url('invoice/recurring/3') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Stopped
                                        (<?php echo get_recurring_count(3) ?>)</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                                            
                                <?php if (!empty($invoices)) { ?>
                                    <table class="table table-hover table-to-list" data-id="work_orders">
                                        <thead>
                                        <tr>
                                            <th>Start On</th>
                                            <th>End Date</th>
                                            <th>Job & Customer</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php foreach ($invoices as $invoice) { ?>
                                            <tr>
                                                <td>
                                                    <div class="table-nowrap">
                                                      <label for=""><?php echo get_format_date($invoice->start_on) ?></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                       <label for=""><?php echo strtoupper($invoice->end_date) ?></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                        <p class="mb-0"> <label for=""><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></label></p>
                                                        <label for="customer_id_<?php echo $invoice->customer_id ?>"> <a href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>"><?php echo $invoice->job_name ?></a></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                        <label><?php echo $invoice->status ?></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                       <label for="">$<?php echo number_format(unserialize($invoice->invoice_totals)['grand_total'], 2, '.', ','); ?> </label>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-btn open">
                                                        <button class="btn btn-default dropdown-toggle" type="button"
                                                                id="dropdown-edit" data-toggle="dropdown"
                                                                aria-expanded="true">
                                                            <span class="btn-label">Manage</span><span
                                                                    class="caret-holder"><span
                                                                        class="caret"></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('invoice/view/' . $invoice->id) ?>"><span
                                                                            class="fa fa-user icon"></span> View</a>
                                                            </li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('invoice/edit/' . $invoice->id) ?>"><span
                                                                            class="fa fa-pencil-square-o icon"></span>
                                                                    Edit</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-inactive-modal="open"
                                                                                       data-invoice-id="400604"
                                                                                       data-invoice-info="Agnes Knox, "
                                                                                       href="#"><span
                                                                            class="fa fa-user-times icon"></span> Mark
                                                                    as inactive</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-delete-modal="open"
                                                                                       data-invoice-id="<?php echo $invoice->id ?>"
                                                                                       onclick="return confirm('Do you really want to delete this item ?')"
                                                                                       data-invoice-info="Agnes Knox, "
                                                                                       href="<?php echo base_url('invoice/delete/' . $invoice->id) ?>"><span
                                                                            class="fa fa-trash-o icon"></span> Delete
                                                                    invoice</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>

                                    </table>
                                <?php } else { ?>
                                    <div class="page-empty-container">
                                        <p class="text-ter margin-bottom">No Records</p>
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