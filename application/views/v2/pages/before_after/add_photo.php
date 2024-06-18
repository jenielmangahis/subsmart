<?php
defined('BASEPATH') or exit('No direct script access allowed');
echo put_header_assets();
include viewPath('v2/includes/header');
?>
<style>
    .select2-container,
    .set__box__icon,
    .set--h .set__box__separator{
        z-index: unset !important;
    }

    .set {
        border: 0;
        background-color: unset;
        background: unset;
        display: flex;
        gap: 1rem;
    }
    .set--h .set__box {
        --size: 100%;
        width: var(--size);
        height: var(--size);
        background-color: #6a4a86;
    }
    .set__box img {
        width: inherit;
        height: 300px;
        object-fit: cover;
    }

    .fileinput-button {
        position: relative;
        overflow: hidden;
        display: block;
        text-align: center;
        border-left:0px;
        border-right:0px;
    }
    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .upload-group {
        margin-bottom: 5rem;
    }
    .upload-group:last-child {
        margin-bottom: 1rem;
    }
    span.nsm-button{
        margin:0px !important;
        border-radius:0px !important;
    }
    .notes{
        border:none !important;
    }
    .txt-notes{
        height : 150px;
    }
</style>

<div class="row page-content g-0">
    <div class="nsm-page-nav mb-3">
        <ul>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/mylibrary') ?>">
                    <span>My Library</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/vault') ?>">

                    <span>Shared Library</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/businessformtemplates') ?>">

                    <span>Business Form Templates</span>
                </a>
            </li>
            <li  class="active">
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/beforeafter') ?>">

                    <span>Photos Gallery</span>
                </a>
            </li>

            <!-- Do not remove the last li -->
            <li><label></label></li>
        </ul>
    </div>

    <?php include viewPath('includes/v2/notifications');?>
    <div>
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            Upload your before and after photos.
        </div>
    </div>

    <?php if (empty($photos)): ?>
        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'frm-save-photos', 'autocomplete' => 'off']); ?>
    <?php else: ?>
        <?php echo form_open('before-after/update-before-after', ['class' => 'form-validate require-validation', 'id' => 'frm-update-photos', 'autocomplete' => 'off']); ?>
    <?php endif;?>
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="d-flex justify-content-between">
                    <h6>Customer <span style="margin-left:2px;" class="bx bxs-help-circle" id="help-popover-customer"></span></h6>
                    <a class="nsm-link d-flex align-items-center" id="add_another_invoice" data-bs-toggle="modal" data-bs-target="#new_customer" href="javascript:void(0);">
                        <span class="bx bx-plus"></span>Create Customer
                    </a>
                </div>
                <select id="sel-customer" name="customer_id" class="form-control searchable-dropdown" required=""></select>
                <input type="hidden" id="job_customer_id" name="">
                <input type="hidden" id="group_number" name="group_number" value="<?php echo $group_number; ?>">
            </div>
        </div>
        <div class="card" data-fileupload="list" style="border:1px solid white;">
            <div class="row upload-group">
                <div class="col-md-4 col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="0,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="0,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[0])): ?>
                                <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "uploads/" . $photos[0]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                            <span class="nsm-button primary fileinput-button">Upload Before
                                <input data-fileupload="file" id="b1-image" data-position="0,0" data-orientation="h" onchange="readURLv2(this, 'b1_img');" name="b1_img" type="file" accept="image/*">
                            </span>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="0,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="0,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[0]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a1_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a1_img" src="<?php echo base_url() . "uploads/" . $photos[0]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                            <span class="nsm-button primary fileinput-button">Upload After <input data-fileupload="file" id="a1-image" data-position="0,1" data-orientation="h" onchange="readURLv2(this, 'a1_img');" name="a1_img" type="file" accept="image/*"></span>
                        </div>
                    </div>
                </div>                
                <div class="col-md-3 col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[]" value="" class="form-control txt-notes" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>

            <div class="row upload-group">
                <div class="col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="1,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="1,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[1])): ?>
                                <img data-fileupload-image="0,0" id="b2_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b2_img" src="<?php echo base_url() . "uploads/" . $photos[1]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                            <span class="nsm-button primary fileinput-button">Upload Before<input data-fileupload="file" id="b2-image" data-position="1,0" data-orientation="h" onchange="readURLv2(this, 'b2_img');" name="b2_img" type="file" accept="image/*"></span>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="1,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="1,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[1]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a2_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a2_img" src="<?php echo base_url() . "uploads/" . $photos[1]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                            <span class="nsm-button primary fileinput-button">Upload After <input data-fileupload="file" id="a2-image" data-position="1,1" data-orientation="h" onchange="readURLv2(this, 'a2_img');" name="a2_img" type="file" accept="image/*"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[]" value="" class="form-control txt-notes" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="mt-4">
            <a class="nsm-button" href="<?= base_url('before_after_photos'); ?>">Cancel</a>
            <button type="submit" class="nsm-button primary mb-0" id="" style="border:0; height:34px;">Save images</button>
        </div>
    <?php echo form_close(); ?>
</div>
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
<?php include viewPath('v2/includes/footer');?>
<script>
$(function(){
    $('#sel-customer').select2({
        ajax: {
            url: '<?= base_url('autocomplete/_company_customer') ?>',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                q: params.term, // search term
                page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                results: data
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
                };
            },
            cache: true
            },
            placeholder: "Select Customer",
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomerSelection(repo) {
        if( repo.first_name != null ){
            return repo.first_name + ' ' + repo.last_name;      
        }else{
            return repo.text;
        }
    }

    function formatRepoCustomer(repo) {
        if (repo.loading) {
        return repo.text;
        }

        var $container = $(
        '<div>'+repo.first_name + ' ' + repo.last_name +'<br><small>'+repo.phone_m+' / '+repo.email+'</small></div>'
        );

        return $container;
    }

    $('#help-popover-customer').popover({
        placement: 'top',
        html : true,
        trigger: "hover focus",
        content: function() {
            return 'Tag photos to customer';
        } 
    });

    $('#frm-save-photos').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var total_photos = 0;
        var total_empty  = 0;
        
        $("input[type='file']").each(function(){
            if( $(this).val() === '' ){
                total_empty++;
            }
            total_photos++;
        });

        if( total_empty ==  total_photos ){

            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: 'Please select a photo'
            });

            return false;
        }

        if( Math.abs(total_empty % 2) == 1 ){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: 'Some photos is missing before or after image. Both image are needed.'
            });

            return false;
        }

        var url = base_url + "before_after_photos/_create_photos";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        let formData = new FormData(_this[0]);   

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData:false,
            cache:false,
            success: function(result) {
                if( result.is_success == 1 ){
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Photos was successfully saved.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.href = base_url + 'before_after_photos';
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }          
                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });

    });
});
</script>