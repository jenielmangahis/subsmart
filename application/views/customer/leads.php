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
                                    <h3 class="page-title">Leads Manager</h3>

                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                                            <!-- <a href="<?php echo url('inquiries/add') ?>" class="btn btn-primary" aria-expanded="false">
									<i class="mdi mdi-settings mr-2"></i> New inquiry
								</a>    -->
                                            <a class="btn btn-primary btn-md"
                                               href="<?php echo url('customer/add_lead') ?>"><span
                                                    class="fa fa-plus"></span> New Lead</a>
                                            <?php //endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <p>
                                        Listing all leads.
                                    </p>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('inquiries') ?>"
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
                                                   href="<?php echo base_url('inquiry') ?>"><span
                                                        class="fa fa-times"></span></a>
                                            <?php } ?>
                                        </div>
                                    </form>
                                    <span class="margin-left-sec">Sort:</span> &nbsp;
                                    <div class="dropdown dropdown-inline"><a class="btn btn-default dropdown-toggle"
                                                                             data-toggle="dropdown"
                                                                             aria-expanded="false"
                                                                             href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=created_at-asc') : base_url('inquiries?order=created_at-asc') ?>">
                                            Date: Newest First
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu  btn-block" role="menu">
                                            <li class="active" role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=created_at-asc') : base_url('inquiries?order=created_at-asc') ?>">
                                                    Date: Newest First</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=created_at-desc') : base_url('inquiries?order=created_at-desc') ?>">Date:
                                                    Old to
                                                    First</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=last-created_at-asc') : base_url('inquiries?order=last-created_at-asc') ?>">Last
                                                    Date:
                                                    Newest First</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=last-created_at-desc') : base_url('inquiries?order=last-created_at-desc') ?>">Last
                                                    Date:
                                                    Old First</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=email-asc') : base_url('inquiries?order=email-asc') ?>">Email:
                                                    A to
                                                    Z</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('inquiries?type=' . $type . '&order=email-desc') : base_url('inquiries?order=email-desc') ?>">Email:
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
                                <li <?php echo ((empty($tab_index)) || $tab_index === 1) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('inquiries') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">New
                                        (<?php echo get_inquiries_count() ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('inquiries/tab/2') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Contacted
                                        (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('inquiries/tab/3') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Follow Up
                                        (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('inquiries/tab/4') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Assigned
                                        (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('inquiries/tab/5') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Converted
                                        (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab_index)) && $tab_index === 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('inquiries/tab/6') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Closed
                                        (<?php echo (!empty($statusCount[1])) ? $statusCount[1] : 0 ?>)</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                                <?php if (!empty($inquiries)) { ?>
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

                                        <?php foreach ($inquiries as $inquiry) { ?>
                                            <tr>
                                                <td>
                                                    <div class="table-name">
                                                        <div class="checkbox checkbox-sm">
                                                            <input type="checkbox"
                                                                   name="id[<?php echo $inquiry->id ?>]"
                                                                   value="<?php echo $inquiry->id ?>"
                                                                   class="select-one"
                                                                   id="inquiry_id_<?php echo $inquiry->id ?>">
                                                            <label for="inquiry_id_<?php echo $inquiry->id ?>"> <a
                                                                    class="a-default"
                                                                    href="<?php echo base_url('inquiry/genview/' . $inquiry->id) ?>"><?php echo $inquiry->contact_name ?></a></label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="table-nowrap">
                                                        <?php echo $inquiry->contact_email ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                        <?php if (is_serialized($inquiry->phone)) { ?>
                                                            <?php echo unserialize($inquiry->phone)['number'] ?>
                                                            (<?php echo unserialize($inquiry->phone)['type'] ?>)
                                                        <?php } else { ?>
                                                            <?php echo $inquiry->phone; ?>
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
                                                                                       href="<?php echo base_url('inquiry/view/' . $inquiry->id) ?>"><span
                                                                        class="fa fa-user icon"></span> View</a>
                                                            </li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('inquiry/edit/' . $inquiry->id) ?>"><span
                                                                        class="fa fa-pencil-square-o icon"></span>
                                                                    Edit</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-inactive-modal="open"
                                                                                       data-inquiry-id="400604"
                                                                                       data-inquiry-info="Agnes Knox, "
                                                                                       href="#"><span
                                                                        class="fa fa-user-times icon"></span> Mark
                                                                    as inactive</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-delete-modal="open"
                                                                                       data-inquiry-id="<?php echo $inquiry->id ?>"
                                                                                       onclick="return confirm('Do you really want to delete this item ?')"
                                                                                       data-inquiry-info="Agnes Knox, "
                                                                                       href="<?php echo base_url('inquiry/delete/' . $inquiry->id) ?>"><span
                                                                        class="fa fa-trash-o icon"></span> Delete
                                                                    inquiry</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>

                                    </table>
                                <?php } else { ?>
                                    <div class="page-empty-container" style="text-align:center;">
                                        <h5 class="page-empty-header">You do not have any leads</h5>
                                        <p class="text-ter margin-bottom">Manage your leads.</p>
                                        <a class="btn btn-primary"
                                           href="<?php echo base_url('customer/add_lead') ?>"><span
                                                class="fa fa-plus fa-margin-right"></span> Add New Lead</a>
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