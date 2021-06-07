<style>
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
      padding-left: 15px !important;
      padding-top: 10px !important;
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
    .float-right.d-md-block {
      position: relative;
      bottom: 5px;
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
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 62px !important;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
    <?php include viewPath('includes/notifications'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card card_holder">
                <div class="page-title-box" style="padding:14px 0 0 0;">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">User View</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('users') ?>" class="btn btn-primary" style="position: relative;bottom: 2px;">Back to users list</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-0 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">View user data</span>
                  </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        
                        <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" style="padding: 7px;">Overview</a></li>
                            <li><a href="#tab_2" data-toggle="tab" style="padding: 7px;">Activity</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-sm-2" style="padding-left: 50px;">
                                        <br>
                                        <img src="<?php echo userProfile($User->id) ?>" width="150" class="img-circle"
                                             alt="">
                                        <br>
                                    </div>
                                    <div class="col-sm-10" style="padding-left: 50px;">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                            <tr>
                                                <td width="160"><strong>Name</strong>:</td>
                                                <td><?php echo $User->name ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong>:</td>
                                                <td><?php echo $User->email ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone</strong>:</td>
                                                <td><?php echo $User->phone ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Last Login</strong>:</td>
                                                <td><?php echo ($User->last_login != '0000-00-00 00:00:00') ? date(setting('datetime_format'), strtotime($User->last_login)) : 'No Record' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>username</strong>:</td>
                                                <td><?php echo $User->username ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Role</strong>:</td>
                                                <td><?php echo $User->role->title ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <table id="dataTable1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>IP Address</th>
                                        <th>Message</th>
                                        <th>Date Time</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($User->activity as $row): ?>
                                        <tr>
                                            <td width="60"><?php echo $row->id ?></td>
                                            <td><?php echo !empty($row->ip_address) ? '<a href="' . url('activity_logs/index?ip=' . urlencode($row->ip_address)) . '">' . $row->ip_address . '</a>' : 'N.A' ?></td>
                                            <td>
                                                <a href="<?php echo url('activity_logs/view/' . $row->id) ?>"><?php echo $row->title ?></a>
                                            </td>
                                            <td><?php echo date('d M, Y', strtotime($row->created_at)) ?></td>
                                            <!-- <td>
                                                <a href="<?php echo url('activity_logs/view/' . $row->id) ?>"
                                                   class="btn btn-sm btn-default" title="View Activity"
                                                   data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                            </td> -->
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->

                    </div>
                    <!-- /.box -->
                </section>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable()

</script>
