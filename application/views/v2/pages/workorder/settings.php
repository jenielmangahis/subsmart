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
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
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
                    <div class="col-12 col-md-3">
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
                                <button type="button" class="nsm-button">Manage work order notifications</button>
                                <button type="button" class="nsm-button primary btn-update-workorder-settings">Save Changes</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <?php if ($headers) : ?>
                            <?php echo form_open_multipart('workorder/updateheader', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>Work Order Header</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea id="updateheader" name="update_header" class="form-control">
                                                <?php echo $headers->content; ?>
                                            </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="nsm-button primary">Update Header</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        <?php else : ?>
                            <?php echo form_open_multipart('workorder/addheader', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
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
                                                    <textarea id="updateheader" name="add_header" class="form-control"></textarea>
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
                        <?php endif; ?>

                    <br><br>
                    <div class="col-12 col-md-12">
                        <?php if ($terms) : ?>
                            <?php echo form_open_multipart('workorder/updateWOTermsCond', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
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
                        <?php else : ?>
                            <?php echo form_open_multipart('workorder/addWOTermsCond', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
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
                                                    <textarea id="updateheader2" name="add_terms_content" class="form-control" style="height:400px"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="nsm-button primary">Add Terms and Conditions</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        <?php endif; ?>
                        <br><br>

                        <h4>Work Order Custom Fields</h4>
                        <div class="row g-3 mt-1">
                            <div class="col-12">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Custom Field Name">Custom Field Name</td>
                                            <td data-name="Date Created">Date Created</td>
                                            <td data-name="Date Updated">Date Updated</td>
                                            <td data-name="Manage"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($fields) : ?>
                                            <?php foreach ($fields as $field) : ?>
                                                <tr>
                                                    <td class="fw-bold nsm-text-primary"><?php echo $field->name; ?></td>
                                                    <td><?php echo $field->date_created; ?></td>
                                                    <td><?php echo $field->date_updated; ?></td>
                                                    <td class="text-end">
                                                        <button class="nsm-button btn-sm m-0 me-2 update-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#update_field_modal" field-id="<?php echo $field->id; ?>" field-name="<?php echo $field->name; ?>">
                                                            Update
                                                            </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">
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
        $(".nsm-table").nsmPagination();

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