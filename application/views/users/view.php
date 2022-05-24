<style>
  .page-title,
  .box-title {
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

  #modalEditEmployee .modal-body {
    padding: 20px !important;
    max-height: 550px;
    overflow-y: auto;
  }

  #modalEditEmployee .section-title {
    font-size: 20px;
    font-weight: bold;
    color: grey;
  }

  #modalEditEmployee label {
    font-weight: bold;
  }

  .section-title {
    background-color: #32243d;
    color: #ffffff !important;
    padding: 10px;
    margin-bottom: 27px;
  }

  .view-password {
    position: absolute;
    bottom: 2px;
    right: 15px;
    width: 24px;
    height: 24px;
    cursor: pointer;
  }
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                  <?php ////if (hasPermissions('add_plan')): 
                  ?>
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

            <div class="main-body">
              <div class="row gutters-sm">
                <div class="col-md-3 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo userProfile($User->id) ?>" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4><?= $User->FName . ' ' . $User->LName; ?></h4>
                          <p class="text-secondary mb-1"><?php echo getUserType($User->user_type); ?></p>
                          <br />
                          <a class="btn btn-outline-primary btn-primary" href="javascript:void(0)" data-name="<?php echo $User->FName . ' ' . $User->LName; ?>" data-id="<?php echo $User->id ?>" id="changePassword" style="width: 100%; margin-bottom: 10px;">Change Password</a>
                          <a class="btn btn-outline-primary btn-primary" id="editEmployee" data-id="<?= $User->id; ?>" href="javascript:void(0);" style="width: 100%;">Edit Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-2">
                          <h6 class="mb-0" style="margin:0px;">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $User->FName . ' ' . $User->LName; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-2">
                          <h6 class="mb-0" style="margin:0px;">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $User->email; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-2">
                          <h6 class="mb-0" style="margin:0px;">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $User->phone ? $User->phone : '---'; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-2">
                          <h6 class="mb-0" style="margin:0px;">Mobile</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $User->mobile ? $User->mobile : '---'; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-2">
                          <h6 class="mb-0" style="margin:0px;">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $User->address . ' ' . $User->state . ' ' . $User->postal_code; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row gutters-sm">
              <div class="col-md-12">
                <h3 style="background-color:#32243d;padding: 9px;color:#ffffff;font-size: 18px;">Activity Log</h3>
                <table id="dt-activity-logs" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>IP Address</th>
                      <th>Message</th>
                      <th>Date Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($User->activity as $row) : ?>
                      <tr>
                        <td><?php echo !empty($row->ip_address) ? '<a href="' . url('activity_logs/index?ip=' . urlencode($row->ip_address)) . '">' . $row->ip_address . '</a>' : 'N.A' ?></td>
                        <td>
                          <a href="<?php echo url('activity_logs/view/' . $row->id) ?>"><?php echo $row->title ?></a>
                        </td>
                        <td><?php echo date('d M, Y H:i A', strtotime($row->created_at)) ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      </div>
      <!-- /.box -->
      </section>
      <!-- end row -->

      <div class="modal fade" id="modalEditEmployee">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Employee</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="editEmployeeForm">
              <div class="modal-body modal-edit-employee"></div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="closeEditEmployeeModal">Cancel</button>
                <button type="button" class="btn btn-success" id="updateEmployee">Save</button>
              </div>
            </form>

          </div>
        </div>
      </div>


      <!--Change Password modal-->
      <div class="modal fade" id="modalChangePassword">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-lock"></i> Change Password</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="changePasswordForm">
              <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Employee Name</label>
                    <input type="text" id="changePasswordEmployeeName" class="form-control" readonly="" disabled="">
                  </div>
                </div>
                <br />
                <hr />
                <div class="row">
                  <div class="col-md-6">
                    <label for="">New Password</label>
                    <input type="password" name="new_password" id="newPassword" required="" class="form-control">
                    <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                    <span class="old-password-error"></span>
                  </div>
                  <div class="col-md-6">
                    <label for="">Retype Password</label>
                    <input type="password" name="re_password" id="rePassword" required="" class="form-control">
                    <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                  </div>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="updatePassword">Save & exit</button>
              </div>
            </form>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
  $(function() {
    var table = $('#dt-activity-logs').DataTable({
      "searching": false,
      "pageLength": 10,
      "autoWidth": false,
      "order": [],
      "aoColumnDefs": [{
          "sWidth": "10%",
          "aTargets": [0]
        },
        {
          "sWidth": "80%",
          "aTargets": [1]
        },
        {
          "sWidth": "10%",
          "aTargets": [2]
        },
      ]
    });

    $(document).on('click', '#editEmployee', function() {
      var user_id = $(this).attr('data-id');
      $(".modal-edit-employee").html('<span class="spinner-border spinner-border-sm m-0"></span>  Loading');
      $('#modalEditEmployee').modal({
        backdrop: 'static',
        keyboard: false
      });
      $.ajax({
        url: base_url + "users/ajax_edit_employee",
        type: "POST",
        dataType: "html",
        data: {
          user_id: user_id
        },
        success: function(data) {
          $(".modal-edit-employee").html(data);
        }
      });
    });

    $(document).on('click', '#changePassword', function() {
      var user_id = $(this).attr('data-id');
      var employee_name = $(this).attr('data-name');
      $("#changePasswordUserId").val(user_id);
      $("#changePasswordEmployeeName").val(employee_name);
      $("#modalChangePassword").modal('show');
    });

    $(document).on('click', '#closeEditEmployeeModal', function() {
      $("#modalEditEmployee").modal('hide');
    });

    $(document).on('click', '#closedChangePasswordModal', function() {
      $("#modalChangePassword").modal('hide');
    });

    $(document).on('click', '#updateEmployee', function() {
      let values = {};
      $.each($('#editEmployeeForm').serializeArray(), function(i, field) {
        values[field.name] = field.value;
      });

      if (values['firstname'] && values['lastname'] && values['email'] && values['username'] && values['role']) {
        $.ajax({
          url: base_url + 'users/_update_employee',
          type: "POST",
          dataType: "json",
          data: {
            values: values
          },
          success: function(data) {
            if (data == 1) {
              $("#modalEditEmployee").modal('hide');
              Swal.fire({
                title: 'Success',
                text: "Employee record s has been Updated.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
              }).then((result) => {
                if (result.value) {
                  location.reload()
                }
              });
            } else {
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: 'Failed',
                text: "Something is wrong in the process",
                icon: 'warning'
              });
            }
          }
        });
      } else {
        Swal.fire({
          showConfirmButton: false,
          timer: 2000,
          title: 'Failed',
          text: "Something is wrong in the process",
          icon: 'warning'
        });
      }

    });

    $('.showPass').click(function() {
      $(this).toggleClass('fa-eye-slash');
      if ($(this).prev('input[type="password"]').length == 1) {
        $(this).prev('input[type="password"]').attr('type', 'text');
        $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
      } else {
        $(this).prev('input[type="text"]').attr('type', 'password');
        $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
      }
    });
    $('.showConfirmPass').click(function() {
      $(this).toggleClass('fa-eye-slash');
      if ($(this).prev('input[type="password"]').length == 1) {
        $(this).prev('input[type="password"]').attr('type', 'text');
        $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
      } else {
        $(this).prev('input[type="text"]').attr('type', 'password');
        $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
      }
    });


  });
</script>