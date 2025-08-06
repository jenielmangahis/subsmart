<?php include viewPath('v2/includes/header'); ?>
<style type="text/css">
    #COMMISSION_HISTORY_SEARCH, #PAY_HISTORY_SEARCH {
        width: 200px;
    }

     #PAY_SELECTION {
        width: 100px;
     }

    #COMMISSION_HISTORY_TABLE_length, 
    #COMMISSION_HISTORY_TABLE_filter, 
    #PAY_HISTORY_TABLE_length, 
    #PAY_HISTORY_TABLE_filter {
        display: none;
    }
    .customTable.dataTable thead th, .customTable.dataTable thead td {
        padding: 5px;
    }
    .customTable.dataTable.no-footer {
        border: 1px solid lightgray;
    }
    .customTable.dataTable, .customTable.dataTable th, .customTable.dataTable td {
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
                    <div class="col-12 col-md-3 grid-mb">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                              <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?php echo userProfile($User->id) ?>" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                  <h4><?= $User->FName . ' ' . $User->LName; ?></h4>
                                  <p class="text-secondary mb-1"><?php echo getUserType($User->user_type); ?></p>
                                  <br />
                                  <a class="nsm-button primary" style="width:152px;display:inline-block;" href="javascript:void(0)" data-name="<?php echo $User->FName . ' ' . $User->LName; ?>" data-id="<?php echo $User->id ?>" id="changePassword" style="width: 100%; margin-bottom: 10px;">Change Password</a>
                                  <a class="nsm-button primary" style="width:152px;display:inline-block;" id="editEmployee" data-id="<?= $User->id; ?>" href="javascript:void(0);" style="width: 100%;">Edit Profile</a>
                                  <br />
                                  <?php //if ($current_user_id == $User->id): ?>
                                  <!-- <button class="nsm-button mt-3 COMMISSION_HISTORY" data-bs-toggle="modal" data-bs-target="#paycommission_history_modal">Pay / Commission History</button> -->
                                  <?php //endif; ?>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-4">
                                    <div class="col-md-2 col-12"><h6><i class='bx bxs-id-card'></i> Employee Number</h6></div>
                                    <div class="col-md-5 col-12"><?= $User->employee_number; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2 col-12"><h6><i class='bx bxs-user' ></i> Name</h6></div>
                                    <div class="col-md-5 col-12"><?= $User->FName . ' ' . $User->LName; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2 col-12"><h6><i class='bx bxs-envelope' ></i> Email</h6></div>
                                    <div class="col-md-9 col-12"><?= $User->email; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2 col-12"><h6><i class='bx bxs-phone' ></i> Phone</h6></div>
                                    <div class="col-md-9 col-12"><?= $User->phone ? formatPhoneNumber($User->phone) : '---'; ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2 col-12"><h6><i class='bx bx-mobile' ></i> Mobile</h6></div>
                                    <div class="col-md-9 col-12"><?= $User->mobile ? formatPhoneNumber($User->mobile) : '---'; ?></div>
                                </div>                                     
                                <div class="row mb-4">
                                    <div class="col-md-2 col-12"><h6><i class='bx bxs-map-pin' ></i> Address</h6></div>
                                    <div class="col-md-9 col-12">
                                            <?= $User->address . ' ' . $User->city . ", " . $User->state . ' ' . $User->postal_code; ?>
                                            
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
                                      <td data-name="Message">Message</td>
                                      <td data-name="DateTime" style="width:15%;">Date Time</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($User->activity as $row) : ?>
                                      <tr>
                                        <td><?php echo $row->activity_name ?></td>
                                        <td><?php echo date('m/d/Y H:i A', strtotime($row->created_at)) ?></td>
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

<div class="modal fade" id="paycommission_history_modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">History Information</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive">
                        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-pay-tab" data-bs-toggle="pill" data-bs-target="#pills-pay" type="button" role="tab" aria-controls="pills-pay" aria-selected="true">Pay</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-commission-tab" data-bs-toggle="pill" data-bs-target="#pills-commission" type="button" role="tab" aria-controls="pills-commission" aria-selected="false">Commission</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane show active" id="pills-pay" role="tabpanel" aria-labelledby="pills-pay-tab">
                                
                                <div>
                                    <input id="PAY_HISTORY_SEARCH" class="form-control mb-2 float-start" type="text" name="" placeholder="Search History...">
                                    <select id="PAY_SELECTION" class="form-select float-end">
                                        <option value="Hourly">Hourly</option>
                                        <option disabled value="Weekly">Weekly</option>
                                        <option disabled value="Monthly">Monthly</option>
                                    </select>
                                </div>
                                <table id="PAY_HISTORY_TABLE" class="table table-hover table-sm customTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Shift Date</th>
                                            <th>Payable Hours</th>
                                            <th>Hourly Rate</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($hourly_pay_info as $hourly_pay_infos): ?>
                                        <tr>
                                            <td><?php echo $hourly_pay_infos->SHIFT_DATE; ?></td>
                                            <td><?php echo $hourly_pay_infos->PAYABLE_HOURS; ?></td>
                                            <td><?php echo "$".$hourly_pay_infos->HOURLY_RATE; ?></td>
                                            <td><?php echo "$".$hourly_pay_infos->TOTAL; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                              <!--   
                                <script type="text/javascript">
                                        $('#PAY_SELECTION').change(function(event) {
                                            let tableSelection = $(this).val();
                                            if (tableSelection == "Hourly") {
                                                alert(tableSelection);
                                            } else if (tableSelection == "Weekly") {
                                                alert(tableSelection);
                                            } else {
                                                alert(tableSelection);
                                            }
                                        });
                                    </script> -->
                            </div>
                            <div class="tab-pane" id="pills-commission" role="tabpanel" aria-labelledby="pills-commission-tab">
                                <input id="COMMISSION_HISTORY_SEARCH" class="form-control mb-2" type="text" name="" placeholder="Search History...">
                                <table id="COMMISSION_HISTORY_TABLE" class="table table-hover table-sm customTable">
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

    var PAY_HISTORY_TABLE = $('#PAY_HISTORY_TABLE').DataTable({
        "ordering": false,
    });
    $("#PAY_HISTORY_SEARCH").keyup(function() {
        PAY_HISTORY_TABLE.search($(this).val()).draw()
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