<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/affiliate_tabs'); ?>
</div>
<style>
.affiliate-photo{
    height: 273px;
    /* width: 306px; */
}
</style>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Affiliates partners are other professionals who refer new leads/clients to you. They are often Mortgage Brokers, Realtors, Auto Dealers, whose business depends upon having clients with good credit. Visit Affiliate Payments to set commission options and record payments for your affiliates. To see an overview of revenue from affiliates on your Affiliates Stats Dashboard.
    </div>
</div>
<div class="col-12">
    <div class="nsm-page">
        <div class="nsm-page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">
                                        <div class="right-text">
                                            <span class="page-title " style="font-weight: bold;font-size: 18px;">Edit Affiliate</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="nsm-card-body">                                
                                <?php echo form_open_multipart(null, [ 'id'=> 'form-affiliate-details', 'class' => 'form-validate']); ?>    
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="country-name">First Name</label>
                                            <input type="hidden" name="affiliate_id" value="<?php echo (isset($affiliate)) ? $affiliate->id : ''; ?>">
                                            <input type="text" name="first_name" required class="form-control" placeholder="First name" value="<?php echo (isset($affiliate)) ? $affiliate->first_name : ''; ?>">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="country-iso">Last Name</label>
                                            <input type="text" name="last_name" required class="form-control" placeholder="Last name" value="<?php echo (isset($affiliate)) ? $affiliate->last_name : ''; ?>">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="country-name">Email</label>
                                            <input type="text" name="email" required class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->email : ''; ?>"  placeholder="Email">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="country-name">Gender</label>
                                            <select class="form-control" name="gender" id="">
                                                <option <?php echo $affiliate->gender == 'Male' ? 'selected="selected"' : ''; ?> value="Male">Male</option>
                                                <option <?php echo $affiliate->gender == 'Female' ? 'selected="selected"' : ''; ?> value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="country-name">Status</label>
                                            <select class="form-control" name="status" id="">
                                                <option <?php echo $affiliate->status == 'active' ? 'selected="selected"' : ''; ?> value="active">Active</option>
                                                <option <?php echo $affiliate->status == 'inactive' ? 'selected="selected"' : ''; ?> value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="blog-photo-container">
                                            <?php if (isset($affiliate)) : ?>
                                                <img class="affiliate-photo" src="../uploads/affiliate/<?php echo logged('company_id') . '/' . $affiliate->photo; ?>" id="photoAffiliate" alt="">
                                            <?php else :?>
                                                <img class="affiliate-photo" src="../uploads/users/default.png" id="photoAffiliate" alt="">
                                            <?php endif ;?>
                                        </div>
                                        <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                            <label class="custom-file-label" for="photoInputFile">(Only jpeg, jpg and png)</label>
                                            <input type="file" class="form-control" name="image" id="formClient-Image"
                                                    placeholder="Upload Image" accept="image/*"
                                                    onchange="readURL(this, 'photoAffiliate');">                                          
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>                                    
                                <div class="row mt-5">
                                <span class="page-title " style="font-weight: bold;font-size: 18px;">Company Information</span>
                                    <div class="col-5">                    
                                        <div class="form-group mt-3">
                                        <label for="country-name">Company Name</label>
                                        <input type="text" name="company" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->company : ''; ?>" placeholder="Company">
                                        </div>
                                        <div class="form-group mt-3">
                                        <label for="country-name">Website URL</label>
                                        <input type="text" name="website_url" id="websiteUrl" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->website_url : ''; ?>" placeholder="Website URL">
                                        </div>
                                        <div class="form-group mt-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="country-name">Fax</label>
                                                    <input type="text" name="fax" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->fax : ''; ?>" placeholder="Fax">
                                                </div>
                                                <div class="col-4">
                                                    <label for="country-name">Ext</label>
                                                    <input type="text" style="width:100px;" name="phone_ext" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->phone_ext : ''; ?>" placeholder="Extension">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-5">                    
                                        <div class="form-group mt-3">
                                        <label for="country-name">Phone</label>
                                        <input type="text" name="phone" required class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->phone : ''; ?>" style="width:400px;" placeholder="Phone">
                                        </div>
                                        <div class="form-group mt-3">
                                        <label for="country-name">Mobile</label>
                                        <input type="text" name="alternate_phone" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->alternate_phone : ''; ?>" style="width:400px;" placeholder="Aleternate Phone">
                                        </div>                                            
                                    </div>
                                </div>                                    
                                <div class="row mt-5">
                                <span class="page-title " style="font-weight: bold;font-size: 18px;">Mailing Address</span>
                                    <div class="col-5">  
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mt-3">
                                                    <label for="country-name">Country</label>
                                                    <input type="text" name="country" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->country : ''; ?>" placeholder="Country">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-3">
                                                    <label for="country-name">City</label>
                                                    <input type="text" name="city" value="<?php echo (isset($affiliate)) ? $affiliate->city : ''; ?>" class="form-control" placeholder="City">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mt-3">
                                                    <label for="country-name">State</label>
                                                    <input type="text" name="state" value="<?php echo (isset($affiliate)) ? $affiliate->state : ''; ?>" class="form-control" placeholder="State">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-3">
                                                    <label for="country-name">Zip code</label>
                                                    <input style="width:200px;" type="text" name="zipcode" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->zipcode : ''; ?>" placeholder="Zip Code">
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                    <div class="col-5">       
                                        <div class="form-group mt-3">
                                            <label for="country-name">Address</label>
                                            <textarea style="width:400px;height: 150px;" name="mailing_address" class="form-control"><?php echo (isset($affiliate)) ? $affiliate->mailing_address : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>                                    
                                <div class="row">
                                    <span class="page-title " style="font-weight: bold;font-size: 18px;">Other Information</span>
                                    <div class="col-5">
                                        <div class="form-group mt-3">
                                        <label for="country-name">Notes (internal)</label>
                                        <textarea name="notes" class="form-control"><?php echo (isset($affiliate)) ? $affiliate->notes : ''; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" <?php (isset($affiliate)) ? (($affiliate->add_master_contact_list) ? 'checked' : 'checked') : '' ?> name="add_masterlist" id="add_masterlist">
                                                <label for="add_masterlist" style="line-height: 20px;">Add to master contact list</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group mt-3">
                                            <label for="country-name">Portal Access <i class="fa fa-question" data-toggle="tooltip" data-html="true" title='<i class="fa fa-lightbulb-o fa-lg" aria-hidden="true"></i> When you add an affiliate, you can grant them access to your portal to send you new leads and see the progress of the clients they refer. The client will always see the photo and contact information of the affiliate who referred them to you.'></i></label>
                                            <select class="form-control" name="portal_access" id="" style="width:400px;">
                                                <option <?php echo $affiliate->portal_access == 1 ? 'selected="selected"' : ''; ?> value="1">Yes</option>
                                                <option <?php echo $affiliate->portal_access == 0 ? 'selected="selected"' : ''; ?> value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ml-2 pt-4">                                                                
                                    <div class="col-7 mt-5 pl-0">     
                                        <div class="float-end">                                   
                                            <button class="nsm-button" type="button" id="btn-cancel">Cancel</button>
                                            <button type="submit" class="nsm-button primary" id="btn-save-affiliate"><i class='bx bx-save'></i>&nbsp;Save</button>                                            
                                        </div>
                                    </div>                                             
                                </div>  

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
$(function(){
    $('#btn-cancel').on('click', function(){
        location.href = base_url + 'affiliate';
    });

    $("#form-affiliate-details").submit(function(e) {
        e.preventDefault(); 
        var url = base_url + "affiliate/_save_affiliate"; 
       
        $.ajax({
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            dataType: 'json',
            success: function(result) {
                if (result.is_success == 1) {
                    Swal.fire({                        
                        text: "Affiliate has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.href = base_url + 'affiliate'
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

                $('#btn-save-affiliate').html("Save");
                $('#btn-save-affiliate').prop("disabled", false);
            },
            beforeSend: function(data) {
                $('#btn-save-affiliate').html("Saving");
                $('#btn-save-affiliate').prop("disabled", true);
            },
            
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>