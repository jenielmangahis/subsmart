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
    .set__box .nsm-button:hover{
        border-top:1px solid #d3d3d3 !important;
    }
</style>

<div class="row page-content g-0">
    <div class="nsm-page-nav mb-3">
        <?php include viewPath('v2/includes/page_navigations/files_vault_tab'); ?>
    </div>
    <div>
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            Edit before and after photos.
        </div>
    </div>

    <?php echo form_open_multipart(null, ['class' => 'form-validate require-validation', 'id' => 'frm-update-photos', 'autocomplete' => 'off']); ?>
        <input type="hidden" name="bfid" value="<?=$beforeAfter->id;?>">
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="d-flex justify-content-between">
                    <h6>Customer <span style="margin-left:2px;" class="bx bxs-help-circle" id="help-popover-customer"></span></h6>
                    <a class="nsm-button btn-small d-flex align-items-center" id="btn-add-new-customer" data-bs-toggle="modal" data-bs-target="#quick-add-customer" href="javascript:void(0);">
                        <span class="bx bx-plus"></span>Add New Customer
                    </a>
                </div>
                <select id="sel-customer" name="customer_id" class="form-control searchable-dropdown" required="">
                    <?php if( $beforeAfter->prof_id ){ ?>
                        <option value="<?= $beforeAfter->prof_id; ?>" selected=""><?= $beforeAfter->first_name . ' ' . $beforeAfter->last_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="card" data-fileupload="list" style="border:1px solid white;">            
            <div class="row upload-group">
                <div class="col-md-4 col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box__separator"></div>
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="0,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="0,0"><span class="fa fa-camera"></span></div>
                            <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "uploads/beforeandafter/".$beforeAfter->company_id."/". $beforeAfter->before_image ?>">
                            <div class="set__box__date"></div>
                            <span class="nsm-button primary fileinput-button">Upload Before<input data-fileupload="file" data-position="0,0" data-orientation="h" onchange="readURLv2(this, 'b1_img');" name="b1_img" type="file"></span>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="0,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="0,1"><span class="fa fa-camera"></span></div>
                            <img data-fileupload-image="0,0" id="a1_img" src="<?php echo base_url() . "uploads/beforeandafter/".$beforeAfter->company_id."/". $beforeAfter->after_image ?>">
                            <div class="set__box__date"></div>
                            <span class="nsm-button primary fileinput-button">Upload After <input data-fileupload="file" data-position="0,1" data-orientation="h" onchange="readURLv2(this, 'a1_img');" name="a1_img" type="file"></span>
                        </div>
                    </div>
                </div>                
                <div class="col-md-3 col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea name="note" class="form-control txt-notes" autocomplete="off"><?=$beforeAfter->note;?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a class="nsm-button" href="<?= base_url('before_after_photos'); ?>">Cancel</a>
            <button type="submit" class="nsm-button primary mb-0" id="" style="border:0; height:34px;">Save</button>
        </div>
    <?php echo form_close(); ?>
</div>
<?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
<?php include viewPath('v2/includes/footer');?>
<script>
$(function(){

    $('#btn-add-new-customer').on('click', function(){
        $('#target-id-dropdown').val('sel-customer');
        $('#origin-modal-id').val('');
    });

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

    $('#frm-update-photos').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var url = base_url + "before_after_photos/_update_photos";
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
                        title: 'Edit Photos',
                        text: "Photos was successfully updated.",
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