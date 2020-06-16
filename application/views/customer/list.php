<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
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
                                    <h3 class="page-title">My Customers</h3>

                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">

                                            <?php if (isset($customers) && count($customers) > 0) { ?>
                                                <a class="btn btn-primary btn-md" href="<?php echo base_url('customer/print') ?>">
                                                    <span class="fa fa-print "></span> Print
                                                </a>
                                            <?php } ?>
                                            <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <!-- <a href="<?php echo url('customer/add') ?>" class="btn btn-primary" aria-expanded="false">
									<i class="mdi mdi-settings mr-2"></i> New Customer
								</a>    -->
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('customer/add') ?>"><span
                                                            class="fa fa-plus"></span> New Customer</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <p>
                                        Listing all customers.
                                    </p>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('customer') ?>"
                                          method="get">
                                        <div class="form-group" style="margin:0 !important;">
                                            <span>Search:</span> &nbsp;
                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                   class="form-control form-control-md"
                                                   name="search"
                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                   type="text"
                                                   placeholder="Search...">
                                            <button class="btn btn-default btn-md" type="submit"><span
                                                        class="fa fa-search"></span></button>
                                            <?php if (!empty($search)) { ?>
                                                <a class="btn btn-default btn-md ml-2"
                                                   href="<?php echo base_url('customer') ?>"><span
                                                            class="fa fa-times"></span></a>
                                            <?php } ?>
                                        </div>
                                    </form>

                                    <span class="margin-left-sec">Filter by:</span> &nbsp;
                                    <div class="dropdown dropdown-inline margin-right-sec"><a
                                                class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="true" href="<?php echo base_url('customer') ?>">Type
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu  btn-block" role="menu">
                                            <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                                                      href="<?php echo base_url('customer') ?>">Type</a>
                                            </li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo base_url('customer?type=residential') ?>">Residential</a>
                                            </li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo base_url('customer?type=commercial') ?>">Commercial</a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                   href="<?php echo base_url('customer?type=advance') ?>">Advance</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown dropdown-inline"><a class="btn btn-default dropdown-toggle"
                                                                             data-toggle="dropdown" aria-expanded="true"
                                                                             href="#">Group <span class="caret"></span></a>
                                        <ul class="dropdown-menu  btn-block" role="menu">
                                            <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                                                      href="">Group</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="">Panel</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="margin-left-sec">Sort:</span> &nbsp;
                                    <div class="dropdown dropdown-inline"><a class="btn btn-default dropdown-toggle"
                                                                             data-toggle="dropdown"
                                                                             aria-expanded="false"
                                                                             href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=name-asc') : base_url('customer?order=name-asc') ?>">
                                            Name: A to Z
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu  btn-block" role="menu">
                                            <li class="active" role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=name-asc') : base_url('?order=name-asc') ?>">
                                                    Name: A to Z</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=name-desc') : base_url('customer?order=name-desc') ?>">Name:
                                                    Z to
                                                    A</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=last-name-asc') : base_url('customer?order=last-name-asc') ?>">Last
                                                    Name:
                                                    A to Z</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=last-name-desc') : base_url('customer?order=last-name-desc') ?>">Last
                                                    Name:
                                                    Z to A</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=email-asc') : base_url('customer?order=email-asc') ?>">Email:
                                                    A to
                                                    Z</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('customer?type=' . $type . '&order=email-desc') : base_url('customer?order=email-asc') ?>">Email:
                                                    Z to
                                                    A</a></li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-default btn-md margin-left-sec" href="" target="_blank"><span
                                                class="fa fa-download"></span> &nbsp; Export</a>
                                </div>
                            </div>
                        </div>


                        <div class="tabs">
                            <ul class="clearfix work__order" id="myTab" role="tablist">
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 1) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('customer') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Active
                                        (<?php echo get_customer_count() ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('customer/tab/2') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Inactive
                                        (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                                <?php if (!empty($customers)) { ?>
                                    <table class="table table-hover table-to-list" data-id="work_orders">
                                        <thead>
                                        <tr>
                                            <th>
                                                <div class="table-name">
                                                    <div class="checkbox checkbox-sm select-all-checkbox">
                                                        <input type="checkbox" name="id_selector" value="0"
                                                               id="select-all"
                                                               class="select-all">
                                                        <label for="select-all">Name</label>
                                                    </div>

                                                </div>
                                            </th>

                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($customers as $customer) { ?>
                                            <tr>
                                                <td>
                                                    <div class="table-name">
                                                        <div class="checkbox checkbox-sm">
                                                            <input type="checkbox"
                                                                   name="id[<?php echo $customer->id ?>]"
                                                                   value="<?php echo $customer->id ?>"
                                                                   class="select-one"
                                                                   id="customer_id_<?php echo $customer->id ?>">
                                                            <label for="customer_id_<?php echo $customer->id ?>"> <a
                                                                        class="a-default"
                                                                        href="<?php echo base_url('customer/genview/' . $customer->id) ?>"><?php echo $customer->contact_name ?></a></label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="table-nowrap">
                                                        <?php echo $customer->contact_email ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                        <?php if (is_serialized($customer->phone)) { ?>
                                                            <?php echo unserialize($customer->phone)['number'] ?>
                                                            (<?php echo unserialize($customer->phone)['type'] ?>)
                                                        <?php } else { ?>
                                                            <?php echo $customer->phone; ?>
                                                        <?php } ?>
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
                                                                                       href="<?php echo base_url('customer/view/' . $customer->id) ?>"><span
                                                                            class="fa fa-user icon"></span> View</a>
                                                            </li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('customer/edit/' . $customer->id) ?>"><span
                                                                            class="fa fa-pencil-square-o icon"></span>
                                                                    Edit</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('customer/tickets/add?customer_id=' . $customer->id) ?>"><span
                                                                            class="fa fa-pencil-square-o icon"></span>
                                                                    Create Service Ticket</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('workcalender/?customer_id=' . $customer->id . '&action=open_event_modal') ?>"><span
                                                                            class="fa fa-calendar icon"></span> Schedule
                                                                    Appointment</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('invoice') ?>"><span
                                                                            class="fa fa-money icon"></span> Create
                                                                    Invoice</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('estimate/add?customer_id=' . $customer->id) ?>"><span
                                                                            class="fa fa-file-text-o icon"></span>
                                                                    Create Estimate</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-inactive-modal="open"
                                                                                       data-customer-id="400604"
                                                                                       data-customer-info="Agnes Knox, "
                                                                                       href="#"><span
                                                                            class="fa fa-user-times icon"></span> Mark
                                                                    as inactive</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-delete-modal="open"
                                                                                       data-customer-id="<?php echo $customer->id ?>"
                                                                                       onclick="return confirm('Do you really want to delete this item ?')"
                                                                                       data-customer-info="Agnes Knox, "
                                                                                       href="<?php echo base_url('customer/delete/' . $customer->id) ?>"><span
                                                                            class="fa fa-trash-o icon"></span> Delete
                                                                    customer</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>

                                    </table>
                                <?php } else { ?>
                                    <p class="text-center">No customers found.</p>
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