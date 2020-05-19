<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
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
                                    <h3 class="page-title">Services</h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('services/add') ?>"><span
                                                            class="fa fa-plus"></span> New Service</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-md-6">
                                    <p>
                                        Listing all your services
                                    </p>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('services') ?>"
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
                                                   href="<?php echo base_url('services') ?>"><span
                                                            class="fa fa-times"></span></a>
                                            <?php } ?>
                                        </div>
                                    </form>

                                    <a class="btn btn-default btn-md margin-left-sec"
                                       href="<?php echo base_url('services/export?data_type=csv') ?>"
                                       target="_blank"><span class="fa fa-download"></span> &nbsp; Export</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                                <?php if (!empty($services)) { ?>
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
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($services as $service) { ?>
                                            <tr>
                                                <td>
                                                    <div class="table-name">
                                                        <div class="checkbox checkbox-sm">
                                                            <input type="checkbox"
                                                                   name="id[<?php echo $service->id ?>]"
                                                                   value="<?php echo $service->id ?>"
                                                                   class="select-one"
                                                                   id="customer_id_<?php echo $service->id ?>">
                                                            <label for="customer_id_<?php echo $service->id ?>"> <a
                                                                        class="a-default"
                                                                        href="<?php echo base_url('services/view/' . $service->id) ?>">
                                                                    <?php echo $service->title ?></a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-btn open">
                                                        <button class="btn btn-default dropdown-toggle"
                                                                type="button"
                                                                id="dropdown-edit" data-toggle="dropdown"
                                                                aria-expanded="true">
                                                            <span class="btn-label">Manage</span><span
                                                                    class="caret-holder"><span
                                                                        class="caret"></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                            aria-labelledby="dropdown-edit">

                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       href="<?php echo base_url('services/edit/' . $service->id) ?>"><span
                                                                            class="fa fa-pencil-square-o icon"></span>
                                                                    Edit</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                       data-delete-modal="open"
                                                                                       data-customer-id="<?php echo $service->id ?>"
                                                                                       onclick="return confirm('Do you really want to delete this item ?')"
                                                                                       data-customer-info="Agnes Knox, "
                                                                                       href="<?php echo base_url('services/delete/' . $service->id) ?>"><span
                                                                            class="fa fa-trash-o icon"></span>
                                                                    Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>

                                    </table>
                                <?php } else { ?>
                                    <p class="text-center">No service found.</p>
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
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable()

</script>