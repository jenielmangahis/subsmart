<?php include viewPath('v2/includes/header'); ?>
<style type="text/css">
    #COMMISSION_HISTORY_SEARCH {
        width: 200px;
    }

    #COMMISSION_HISTORY_TABLE_length, 
    #COMMISSION_HISTORY_TABLE_filter, 
    #COMMISSION_HISTORY_TABLE_info {
        display: none;
    }
    #COMMISSION_HISTORY_TABLE.dataTable thead th, #COMMISSION_HISTORY_TABLE.dataTable thead td {
        padding: 5px;
    }
    #COMMISSION_HISTORY_TABLE.dataTable.no-footer {
        border: 1px solid lightgray;
    }
    #COMMISSION_HISTORY_TABLE.dataTable, #COMMISSION_HISTORY_TABLE.dataTable th, #COMMISSION_HISTORY_TABLE.dataTable td {
        box-sizing: border-box;
    }
</style>


<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            View Employee.
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-3 grid-mb">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                              <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?php echo userProfile($User->id) ?>" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                  <h4><?= $User->FName . ' ' . $User->LName; ?></h4>
                                  <p class="text-secondary mb-1"><?php echo getUserType($User->user_type); ?></p>
                                  <br />
                                  <a class="nsm-button primary" href="javascript:void(0)" data-name="<?php echo $User->FName . ' ' . $User->LName; ?>" data-id="<?php echo $User->id ?>" id="changePassword" style="width: 100%; margin-bottom: 10px;">Change Password</a>
                                  <a class="nsm-button primary" id="editEmployee" data-id="<?= $User->id; ?>" href="javascript:void(0);" style="width: 100%;">Edit Profile</a>
                                  <br />
                                  <button class="nsm-button mt-3 COMMISSION_HISTORY" data-bs-toggle="modal" data-bs-target="#commission_history_modal">Commission History</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-4">
                                    <div class="col-2" style="width:10.666667% !important;"><h6><i class='bx bxs-id-card'></i> Employee Number</h6></div>
                                    <div class="col-9"><?= $User->employee_number; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-2" style="width:10.666667% !important;"><h6><i class='bx bxs-user' ></i> Name</h6></div>
                                    <div class="col-9"><?= $User->FName . ' ' . $User->LName; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-2" style="width:10.666667% !important;"><h6><i class='bx bxs-envelope' ></i> Email</h6></div>
                                    <div class="col-9"><?= $User->email; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-2" style="width:10.666667% !important;"><h6><i class='bx bxs-phone' ></i> Phone</h6></div>
                                    <div class="col-9"><?= $User->phone ? $User->phone : '---'; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-2" style="width:10.666667% !important;"><h6><i class='bx bx-mobile' ></i> Mobile</h6></div>
                                    <div class="col-9"><?= $User->mobile ? $User->mobile : '---'; ?></div>
                                </div>                                     
                                <div class="row mb-4">
                                    <div class="col-2" style="width:10.666667% !important;"><h6><i class='bx bxs-map-pin' ></i> Address</h6></div>
                                    <div class="col-9">
                                            <?= $User->address . '<br />' . $User->city . ", " . $User->state . ' ' . $User->postal_code; ?>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <h3 style="background-color: #6a4a86;color: #ffffff;font-size: 15px;padding: 10px;">Activity Logs</h3>
                                <table id="dt-activity-logs" class="nsm-table">
                                  <thead>
                                    <tr>
                                      <td data-name="IP" style="width:10%;">IP Address</td>
                                      <td data-name="Message">Message</td>
                                      <td data-name="DateTime" style="width:15%;">Date Time</td>
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
                
            </div>
        </div>
    </div>

<div class="modal fade" id="commission_history_modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Commission History</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive">
                        <input id="COMMISSION_HISTORY_SEARCH" class="form-control mb-2" type="text" name="" placeholder="Search History...">
                        <table id="COMMISSION_HISTORY_TABLE" class="table table-hover table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Datetime</th>
                                    <th>Module</th>
                                    <th>Type</th>
                                    <th>Percentage</th>
                                    <th>Commission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($commission_info as $commission_infos): ?>
                                <tr>
                                    <td><?php echo $commission_infos->datetime; ?></td>
                                    <td><?php echo $commission_infos->location; ?></td>
                                    <td><?php echo ($commission_infos->type == 0) ? "Percentage (Gross, Net)" : "Net + Percentage" ; ?></td>
                                    <td><?php echo ($commission_infos->percentage) ? ($commission_infos->percentage * 100)."%" : "0%"; ?></td>
                                    <td><?php echo ($commission_infos->commission) ? "+$".number_format($commission_infos->commission, 2) : "$0" ?></td>   
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade nsm-modal fade" id="modalEditEmployee" aria-labelledby="modalEditEmployeelabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <form action="" id="editEmployeeForm" enctype="multipart/form-data">
                <div class="modal-body modal-edit-employee" style="max-height: 500px; overflow: auto;"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="updateEmployee">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modalChangePassword" aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Change Password</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <form method="POST" id="change_password_form">
                <div class="modal-body">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Employee Name</label>
                            <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
                            <input type="text" class="nsm-field form-control" id="changePasswordEmployeeName" disabled="" readonly="" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">New Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="newPassword" name="new_password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Retype Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="rePassword" name="re_password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="updateEmployee">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
$(document).ready(function(){
    var COMMISSION_HISTORY_TABLE = $('#COMMISSION_HISTORY_TABLE').DataTable({
        "ordering": false,
    });
    $("#COMMISSION_HISTORY_SEARCH").keyup(function() {
        COMMISSION_HISTORY_TABLE.search($(this).val()).draw()
    });

    $('#modalEditEmployee').modal({backdrop: 'static', keyboard: false});
    $(".nsm-table").nsmPagination();

    $(document).on('click', '#editEmployee', function() {
      var user_id = $(this).attr('data-id');      
      $('#modalEditEmployee').modal('show');
      $(".modal-edit-employee").html('<span class="bx bx-loader bx-spin"></span>');

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

    $(document).on('click', '#changePassword', function(){
        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");

        $("#changePasswordUserId").val(id);
        $("#changePasswordEmployeeName").val(name);
        $("#modalChangePassword").modal("show");
    });

    $(document).on('submit', '#change_password_form', function(e){
        e.preventDefault();

        var _this = $(this);
        var url = "<?php echo base_url(); ?>users/ajaxUpdateEmployeePasswordV2";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType: "json",
            success: function(result) {
                if (result.is_success) {
                    $("#modalChangePassword").modal('hide');
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Employee password has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Failed',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });
    });

    $(".password-field").on("click", function(e) {
        var _this = $(this);
        var _container = _this.closest(".nsm-field-group");
        var shown = _container.hasClass("show");

        if (e.offsetX > 345) {
            if (shown) {
                _container.removeClass("show").addClass("hide");
                _this.attr("type", "text");
            } else {
                _container.removeClass("hide").addClass("show");
                _this.attr("type", "password");
            }
        }
    });

    $(document).on('submit', '#editEmployeeForm', function(e){
        e.preventDefault();

        var url = base_url + 'users/_update_employee';
        var formData = new FormData(this);
        $.ajax({
          url: base_url + 'users/_update_employee',
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data) {
                if (data.is_success == 1) {
                  $("#modalEditEmployee").modal('hide');
                  Swal.fire({
                    title: 'Success',
                    text: "Employee record s has been Updated.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#6a4a86',
                    cancelButtonColor: '#6a4a86',
                    confirmButtonText: 'Ok'
                  }).then((result) => {
                    //if (result.value) {
                      location.reload()
                    //}
                  });
                } else {
                  Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Failed',
                    text: data.msg,
                    icon: 'warning'
                  });
                }
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>