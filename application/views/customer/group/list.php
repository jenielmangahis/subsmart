<style>
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 30px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid" style="padding-top: 10px;">
            <div class="card card_holder">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">Customer Groups</h3>
                            </div>

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Listing all customer groups.</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="<?php echo url('customer/group_add') ?>" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Add Group
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning col-md-12 mt-4" role="alert">
                            <span style="color:black;">
                                A customer group is a way of aggregating customers that are similar in some way.  For example, you may
                                use them to distinguish between retail and wholesale customers or between company employees and external customers etc. ...
                                For example, a customer may have registered through the application as a wholesale customer.
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">

                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($customerGroups)) { ?>
                                    <?php foreach ($customerGroups as $customerGroup): ?>
                                        <tr>
                                            <td>
                                                <?php echo $customerGroup->title ?>
                                            </td>
                                            <td><?= $customerGroup->description; ?></td>
                                            <td><?= $customerGroup->date_added; ?></td>
                                            <td>
                                                <?php //if (hasPermissions('plan_edit')): ?>
                                                    <a href="<?php echo url('customer/group/edit/' . $customerGroup->id) ?>"
                                                       class="btn btn-sm btn-default" title="Edit item"
                                                       data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php //endif ?>
                                                <?php //if (hasPermissions('plan_delete')): ?>
                                                    <a href="<?php echo url('customer/group/delete/' . $customerGroup->id) ?>"
                                                       class="btn btn-sm btn-default remove-data-item"
                                                       title="Delete item" data-toggle="tooltip"><i
                                                                class="fa fa-trash"></i></a>
                                                <?php //endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable()

</script>
