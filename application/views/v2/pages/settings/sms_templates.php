<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('settings/create_sms_template') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_templates_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Customize your sms that are sent on different events.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-add-sms-template">
                                <i class='bx bx-fw bx-message-rounded-detail'></i> Add New SMS Template
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Template Name">Template Name</td>
                            <td data-name="Details">Details</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($data_sms_templates)) :
                        ?>
                            <?php
                            foreach ($data_sms_templates as $value) :
                                foreach ($value['data'] as $d) :
                            ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-message-rounded-detail'></i>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('settings/email_templates_edit/').$d->id; ?>'"><?= $d->title; ?></label>
                                            <label class="content-subtitle fst-italic d-block"><?= $value['name']; ?></label>
                                        </td>
                                        <td><?= $d->details==1 ? 'Default Template' : 'Custom Template'; ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item btn-edit-sms-template" href="javascript:void(0);" data-id="<?= $d->id; ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $d->id; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Create sms template -->
            <div class="modal fade nsm-modal fade" id="modalCreateSmsTemplate" aria-labelledby="modalCreateSmsTemplateLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Create Auto SMS Notification Setting</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form method="post" id="frm-add-sms-template">
                        <div class="modal-body">
                            <div class="row">                                                                
                                <div class="col-md-12 mt-3">
                                    <label for="">Template Name</label>
                                    <input type="text" class="nsm-field form-control" name="title" id="title" required/>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Template Type</label>
                                    <select class="form-control" data-style="btn-white" name="type_id" required>
                                        <?php foreach($option_template_types as $key => $value){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } ?>                                    
                                    </select>
                                </div>                                    
                                <div class="col-md-12 mt-3">
                                    <label for="">Details</label>   
                                    <select class="form-control" data-style="btn-white" name="details" required>
                                        <?php foreach($option_details as $key => $value){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">SMS</label>
                                    <textarea id="summernote" class="nsm-field form-control" name="sms_body" style="width:100%; height: 100px;" required></textarea>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button name="btn_close_create_sms_template" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary btn-create-sms-template">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!-- Edit sms template -->
            <div class="modal fade nsm-modal fade" id="modalEditSmsTemplate" aria-labelledby="modalEditSmsTemplateLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Auto SMS Notification Setting</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form method="post" id="frm-update-sms-template">
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button name="btn_close_create_sms_template" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary btn-update-sms-template">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete SMS Template',
                text: "Are you sure you want to delete this SMS template?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('settings/delete_sms_template'); ?>",
                        data: {
                            smstid: id
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Good job!',
                                text: "Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });

        $("#frm-add-sms-template").submit(function(e){
            e.preventDefault();
            var url = base_url + 'settings/_create_sms_template';
            $(".btn-create-sms-template").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            setTimeout(function () {
                $.ajax({
                     type: "POST",
                     url: url,
                     data: $("#frm-add-sms-template").serialize(),
                     dataType: 'json',
                     success: function(o)
                     {
                        if( o.is_success == 1 ){
                            $('#modalCreateSmsTemplate').modal('hide');
                            Swal.fire({
                                title: 'Success',
                                text: 'SMS template was successfully created.',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Cannot save data.',
                              text: o.msg
                            });
                        }

                        $(".btn-create-sms-template").html('Save');
                     }
                });
            }, 300);        
        });

        $("#frm-update-sms-template").submit(function(e){
            e.preventDefault();
            var url = base_url + 'settings/_update_sms_template';
            $(".btn-update-sms-template").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            setTimeout(function () {
                $.ajax({
                     type: "POST",
                     url: url,
                     data: $("#frm-update-sms-template").serialize(),
                     dataType: 'json',
                     success: function(o)
                     {
                        if( o.is_success == 1 ){
                            $('#modalEditSmsTemplate').modal('hide');
                            Swal.fire({
                                title: 'Success',
                                text: 'SMS template was successfully updated.',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Cannot save data.',
                              text: o.msg
                            });
                        }

                        $(".btn-update-sms-template").html('Save');
                     }
                });
            }, 300);        
        });
    });

    $(document).on('click', '.btn-add-sms-template', function(){
        $('#modalCreateSmsTemplate').modal('show');
    });

    $(document).on('click', '.btn-edit-sms-template', function(){
        var smstid = $(this).data('id');
        var url = base_url + 'settings/_edit_sms_template';

        $('#modalEditSmsTemplate').modal('show');
        $("#modalEditSmsTemplate .modal-body").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {smstid:smstid},
             success: function(o)
             {          
                $('#modalEditSmsTemplate .modal-body').html(o);
             }
          });
        }, 800);
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>