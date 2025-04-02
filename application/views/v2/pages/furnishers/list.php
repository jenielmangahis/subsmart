<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<style>
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
    .cb-account-numbers{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .cb-account-numbers li{
        display: block;
        width: 100%;
        margin: 5px;
    }
    .cb-status-icon{
        font-size: 28px;
        margin-bottom: 8px;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            Manage your creditors / furnishers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a type="button" class="nsm-button primary" href="javascript:void(0);" id="btn-add-new-credit-industry">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table" id="credit-industry-list-table">
                        <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Address">Address</td>                    
                            <td data-name="Contact Number">Contact Number</td>                                
                            <td data-name="Account Type">Account Type</td>  
                            <td data-name="Manage" style="width:3%;"></td>
                        </tr>
                        </thead>
                        <tbody>
                          <?php foreach($creditorFurnishers as $f){ ?>
                              <tr>
                                <td><div class="table-row-icon"><i class='bx bx-briefcase'></i></div></td>
                                <td class="fw-bold nsm-text-primary"><?= $f->name; ?></td>
                                <td class="nsm-text-primary"><span><?= $f->address != '' ? $f->address : '---'; ?></span></td>
                                <td class="nsm-text-primary">
                                  <?php 
                                    $contact_number = '---';
                                    if( $f->ext != '' && $f->phone != '' ){
                                      $contact_number = '('. $f->ext .') ' . formatPhoneNumber($f->phone);
                                    }
                                    echo $contact_number;
                                  ?>                                  
                                </td>
                                <td class="nsm-text-primary"><?= $f->account_type != '' ? $f->account_type : '---'; ?></td>
                                <td>
                                  <div class="dropdown table-management">
                                      <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                          <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-menu-end">                                          
                                          <li><a class="dropdown-item row-edit-item" href="javascript:void(0);" data-id="<?= $f->id; ?>">Edit</a></li>                                            
                                          <li><a class="dropdown-item row-delete-item" href="javascript:void(0);" data-name="<?= $f->name; ?>" data-id="<?= $f->id; ?>">Delete</a></li>                                            
                                      </ul>
                                  </div>
                                </td>
                              </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Add New Modal -->
                <div class="modal fade nsm-modal" id="modal-add-new-credit-industry" role="dialog" data-bs-backdrop="static" aria-labelledby="modal-add-new-credit-industryLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header mb-0">
                                <span id="newcustomerLabel" class="modal-title content-title"><i class='bx bx-fw bx-plus'></i> Add New Credit Industry</span>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                            </div>
                            <form id="frm-create-credit-industry">
                                <div class="modal-body">                     
                                    <div class="row">  
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="f-name">Company name</label>
                                                <input type="text" class="form-control" placeholder="Company Name" name="f_company_name" id="f-name" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="f-account-type">Account Type</label>
                                                <input type="text" class="form-control" placeholder="Account Type" name="f_account_type" id="f-account-type" placeholder="" required/>
                                            </div>
                                        </div>    
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="f-account-type">Phone Number</label><br />
                                                <input type="text" class="form-control phone_number" placeholder="Phone Number" style="display:inline-block;width:50%;" name="f_phone" id="f-phone" placeholder="" required />
                                                <input type="text" class="form-control" name="f_ext" id="" placeholder="Ext" required style="display:inline-block;width: 25%;"/>
                                            </div>
                                        </div>    
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="f-address">Address</label>
                                                <input type="text" class="form-control" placeholder="Address" name="f_address" id="f-address" placeholder="" required/>
                                            </div>
                                        </div>  
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="estimate_date">City</label>
                                                <input type="text" class="form-control" placeholder="City" name="f_city" id="" placeholder="" required/>
                                            </div>
                                        </div>   
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="f-state">State</label>
                                                <input type="text" class="form-control" placeholder="State" name="f_state" id="f-state" placeholder="" required/>
                                            </div>
                                        </div> 
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label for="estimate_date">Zip</label>
                                                <input type="text" class="form-control" placeholder="Zip" name="f_zipcode" id="" placeholder="" required/>
                                            </div>
                                        </div>      
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="f-note">Note</label>
                                                <textarea class="form-control" name="f_note" id="f-note" style="height:100px;"></textarea>
                                            </div>
                                        </div>                      
                                    </div>  
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="nsm-button primary" id="btn-save-credit-industry">Save</button>
                                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade nsm-modal" id="modal-edit-credit-industry" role="dialog" data-bs-backdrop="static" aria-labelledby="modal-edit-credit-industryLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header mb-0">
                                <span id="newcustomerLabel" class="modal-title content-title"><i class='bx bx-fw bx-edit'></i> Edit Credit Industry</span>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                            </div>
                            <form id="frm-update-credit-industry">
                                <input type="hidden" name="fid" id="fid" value="" />
                                <div class="modal-body" id="edit-credit-industry-container"></div>
                                <div class="modal-footer">
                                    <button type="submit" class="nsm-button primary" id="btn-update-credit-industry">Save</button>
                                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $('#btn-add-new-credit-industry').on('click', function(){
            $('#modal-add-new-credit-industry').modal('show');
        });

        $('.row-edit-item').on('click', function(){
            var fid = $(this).attr('data-id');
            
            $('#fid').val(fid);
            $('#modal-edit-credit-industry').modal('show');
            
            $.ajax({
                type: "POST",
                url: base_url + "creditor_furnisher/_edit_furnisher",
                data: {fid:fid},
                success: function(result)
                {
                    $('#edit-credit-industry-container').html(result);
                },
                beforeSend: function() {
                    $('#edit-credit-industry-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('.phone_number').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        $(document).on("click", ".row-delete-item", function() {
            let fid  = $(this).attr("data-id");
            let name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Credit Industry',
                html: `Are you sure you want to delete credit industry <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "creditor_furnisher/_delete_creditor_furnisher",
                        data: {fid: fid},
                        dataType:"json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Credit Industry',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: result.msg
                                });
                            }
                        },
                    });
                }
            });
        });

        $('#frm-create-credit-industry').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "creditor_furnisher/_create_furnisher",
                data: $(this).serialize(),
                dataType:"json",
                success: function(result)
                {
                    if(result.is_success){
                        $('#modal-add-new-credit-industry').modal('hide');

                        Swal.fire({
                            title: 'Credit Industry',
                            text: "Credit industry has been created successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }

                    $('#btn-save-credit-industry').html('Save');
                },
                beforeSend: function() {
                    $('#btn-save-credit-industry').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-update-credit-industry').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "creditor_furnisher/_update_furnisher",
                data: $(this).serialize(),
                dataType:"json",
                success: function(result)
                {
                    if(result.is_success){
                        $('#modal-edit-credit-industry').modal('hide');

                        Swal.fire({
                            title: 'Credit Industry',
                            text: "Credit industry has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }

                    $('#btn-update-credit-industry').html('Save');
                },
                beforeSend: function() {
                    $('#btn-update-credit-industry').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });
    });
</script>