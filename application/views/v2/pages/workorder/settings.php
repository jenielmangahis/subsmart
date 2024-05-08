<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>

<style>
    #cke_updateheader {
        border-radius: 5px;
        overflow: hidden;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">

                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-5">
                        <?php echo form_open('workorder/settings', ['class' => 'form-validate require-validation', 'id' => 'workorder-settings', 'autocomplete' => 'off']); ?>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Work Order Number</span>
                                                </div>
                                                <label class="nsm-subtitle">Set the prefix and the next auto-generated number.</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-3">
                                                        <input type="text" placeholder="Prefix" name="next_custom_number_prefix" id="number-prefix" class="nsm-field form-control" value="<?php echo $prefix ?>" autocomplete="off" />
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" placeholder="Next Number" name="next_custom_number_base" id="number-base" class="nsm-field form-control" value="<?php echo $order_num_next; ?>" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Work Order Template</span>
                                                </div>
                                                <label class="nsm-subtitle">Select from the options below the fields you want hidden on your work order template.</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" id="hide_from_email" name="hide_from_email" <?= $capture_signature > 0 ? 'checked="checked"' : ''; ?>>
                                                            <label class="form-check-label" for="hide_from_email">
                                                                Hide business email
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="button" class="nsm-button work-order-notification">Manage work order notifications</button>
                                <button type="button" class="nsm-button primary btn-update-workorder-settings">Save Changes</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="nsm-card primary">
                                <div class="col-12">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Work Order Custom Fields</span>
                                        </div>
                                        <label class="nsm-subtitle">Set custom fields for your workorders.</label>
                                        <a href="javascript:void(0);" class="btn-add-custom-field nsm-button small primary" style="float:right;">Add New</a>
                                    </div>                                
                                    <table class="nsm-table nsm-table-custom-field">
                                        <thead>
                                            <tr>
                                                <td data-name="Custom Field Name" style="width:60%;">Custom Field Name</td>
                                                <td data-name="Date Created">Date Created</td>
                                                <td data-name="Manage" style="width:20%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($customFields) : ?>
                                                <?php foreach ($customFields as $cf) : ?>
                                                    <tr>
                                                        <td class="fw-bold nsm-text-primary"><?php echo $cf->name; ?></td>
                                                        <td><?php echo $cf->date_created; ?></td>                                                        
                                                        <td class="text-end">
                                                            <button class="nsm-button btn-sm m-0 me-2 edit-custom-field" data-id="<?php echo $cf->id; ?>" data-name="<?php echo $cf->name; ?>">
                                                                Edit
                                                            </button>
                                                            <button class="nsm-button btn-sm m-0 me-2 delete-custom-field" data-id="<?php echo $cf->id; ?>" data-name="<?php echo $cf->name; ?>">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="nsm-empty">
                                                            <span>No results found.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'frm-update-header', 'autocomplete' => 'off']); ?>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Work Order Header</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea id="updateheader" name="update_header_content" class="form-control"><?php echo $headers->content; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="nsm-button primary">Add Header</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    <br><br>
                    <div class="col-12 col-md-12">
                        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'frm-update-terms-condition', 'autocomplete' => 'off']); ?>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Work Order Terms and Conditions</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" name="wo_tc" value="<?php echo $terms->id; ?>">
                                                <textarea id="updateheader2" name="update_terms_content" class="form-control" style="height:400px">
                                            <?php echo $terms->content; ?>
                                        </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="nsm-button primary">Update Terms and Conditions</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                    </div>
                </div>
                <?php echo form_close(); ?>
                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo $url->assets ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('updateheader');
        CKEDITOR.replace('updateheader2');
        $(".nsm-table-custom-field").nsmPagination();

        $(".work-order-notification").on("click", function(){            
            location.href = base_url + 'settings/notifications';
        });

        $('.btn-add-custom-field').on('click', function(){
            $('#new_custom_field_modal').modal('show');
        });

        $('.edit-custom-field').on('click', function(){
            var cf_id = $(this).attr('data-id');
            var cf_name = $(this).attr('data-name');

            $('#update_custom_field_modal').modal('show');
            $('#cfeid').val(cf_id);
            $('#custom_field_name_update').val(cf_name)
        });

        $('#frm-save-custom-field').on('submit', function(e){
            e.preventDefault();

            let url = base_url + "workorder/_save_custom_fields";
            $('.btn-save-custom-field').html('Saving...').prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: $("#frm-save-custom-field").serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success == 1) {
                        $('#new_custom_field_modal').modal('hide');
                        Swal.fire({
                            //title: 'Save Successful!',
                            html: "Custom field data was successfully created.",
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
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    $('.btn-save-custom-field').html('Save').prop("disabled", false);
                },
            });
        });        

        $('#frm-update-header').on('submit', function(e){
            e.preventDefault();
            let url = base_url + "workorder/_update_wo_header";
            
            CKEDITOR.instances['updateheader'].updateElement();

            $.ajax({
                type: 'POST',
                url: url,
                data: $("#frm-update-header").serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success == 1) {
                        Swal.fire({
                            html: "Work Order header was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                            
                            //}
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                },
            });
        });

        $('#frm-update-terms-condition').on('submit', function(e){
            e.preventDefault();
            let url = base_url + "workorder/_update_wo_terms_condition";
            
            CKEDITOR.instances['updateheader2'].updateElement();

            $.ajax({
                type: 'POST',
                url: url,
                data: $("#frm-update-terms-condition").serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success == 1) {
                        Swal.fire({
                            html: "Work Order terms and conditions was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                            
                            //}
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                },
            });
        });

        $('#frm-update-custom-field').on('submit', function(e){
            e.preventDefault();

            let url = base_url + "workorder/_update_custom_fields";
            $('.btn-update-custom-field').html('Saving...').prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: $("#frm-update-custom-field").serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success == 1) {
                        $('#update_custom_field_modal').modal('hide');
                        Swal.fire({
                            //title: 'Save Successful!',
                            html: "Custom field data was successfully updated.",
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
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    $('.btn-update-custom-field').html('Save').prop("disabled", false);
                },
            });
        });

        $('.delete-custom-field').on('click', function(){
            let cfeid = $(this).attr('data-id');
            let cfname = $(this).attr('data-name');

            Swal.fire({            
                html: "Delete custom field <b>"+cfname+"</b>?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    var url = base_url + "workorder/_delete_custom_fields";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data:{cfeid:cfeid},
                        beforeSend: function(data) {
                            
                        },
                        success: function(result) {   
                            if (result.is_success == 1) {
                                Swal.fire({                        
                                    text: "Custom field was successfully deleted.",
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
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }                                                                        
                        },
                        complete : function(){
                            
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        });

        $(".btn-update-workorder-settings").on("click", function(e) {
            let _this = $(this);
            let url = "<?php echo base_url(); ?>/workorder/_update_workorder_settings";
            _this.html('Saving...').prop("disabled", true);

            if ($("#number-prefix").val() == '') {
                Swal.fire({
                    title: 'Error',
                    text: "Please enter Work Order number prefix.",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
                _this.html('Save Changes').prop("disabled", false);
                return false;
            }

            if ($("#number-base").val() == '') {
                Swal.fire({
                    title: 'Error',
                    text: "Please enter Work Order number.",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
                _this.html('Save Changes').prop("disabled", false);
                return false;
            }

            $.ajax({
                type: 'POST',
                url: url,
                data: $("#workorder-settings").serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: result.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.html('Save Changes').prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".update-item", function() {
            let id = $(this).attr('field-id');
            let name = $(this).attr('field-name');
            $('#custom_id').val(id);
            $('#custom_name_update').val(name);
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>