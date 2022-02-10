<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<style>
.affiliate-photo{
    margin: 0 auto;
    height: 265px !important;
    width: auto;
    margin-bottom: 23px;
}
.form-header{
    background-color: #32243d;
    padding: 10px;
    font-size: 17px;
    color: #ffffff;
    margin-bottom: 31px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/affiliate'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <?php if( $action == 'add' ){ ?>
                                    <h3 class="page-title">Add Affiliate Partner</h3>
                                    <?php }else{ ?>
                                    <h3 class="page-title">Edit Affiliate Partner</h3>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-2" role="alert">
                            <span style="color:black;">Affiliates partners are other professionals who refer new leads/clients to you. They are often Mortgage Brokers, Realtors, Auto Dealers, whose business depends upon having clients with good credit. Visit Affiliate Payments to set commission options and record payments for your affiliates. To see an overview of revenue from affiliates on your Affiliates Stats Dashboard. </span>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                            <?php echo form_open_multipart('affiliate/saveAffiliate', [ 'id'=> 'form-affiliate-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                            <h3 class="form-header">Affiliate</h3>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                      <label for="country-name">First Name</label>
                                      <input type="hidden" name="affiliate_id" value="<?php echo (isset($affiliate)) ? $affiliate->id : ''; ?>">
                                            <input type="text" name="first_name" required class="form-control" placeholder="First name" value="<?php echo (isset($affiliate)) ? $affiliate->first_name : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="country-iso">Last Name</label>
                                      <input type="text" name="last_name" required class="form-control" placeholder="Last name" value="<?php echo (isset($affiliate)) ? $affiliate->last_name : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="country-name">Email</label>
                                      <input type="text" name="email" required class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->email : ''; ?>"  placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="country-name">Gender</label>
                                        <select class="form-control" name="gender" id="">
                                            <option <?php echo $affiliate->gender == 'Male' ? 'selected="selected"' : ''; ?> value="Male">Male</option>
                                            <option <?php echo $affiliate->gender == 'Female' ? 'selected="selected"' : ''; ?> value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="country-name">Status</label>
                                        <select class="form-control" name="status" id="">
                                            <option <?php echo $affiliate->status == 'active' ? 'selected="selected"' : ''; ?> value="active">Active</option>
                                            <option <?php echo $affiliate->status == 'inactive' ? 'selected="selected"' : ''; ?> value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="blog-photo-container">
                                        <?php if (isset($affiliate)) : ?>
                                            <img class="affiliate-photo" src="../uploads/affiliate/<?php echo logged('company_id') . '/' . $affiliate->photo; ?>" id="photoAffiliate" alt="">
                                        <?php else :?>
                                            <img class="affiliate-photo" src="../uploads/users/default.png" id="photoAffiliate" alt="">
                                        <?php endif ;?>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group" style="width:70%;margin: 0 auto;">
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
                            <h3 class="form-header">Company Information</h3>
                            <div class="row">
                                <div class="col-6">                    
                                    <div class="form-group">
                                      <label for="country-name">Company</label>
                                      <input type="text" name="company" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->company : ''; ?>" placeholder="Company">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">Website URL</label>
                                      <input type="text" name="website_url" id="websiteUrl" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->website_url : ''; ?>" placeholder="Website URL">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">Fax</label>
                                      <input type="text" name="fax" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->fax : ''; ?>" placeholder="Fax">
                                    </div>
                                </div>
                                <div class="col-6">                    
                                    <div class="form-group">
                                      <label for="country-name">Phone</label>
                                      <input type="text" name="phone" required class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->phone : ''; ?>" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">Alternate Phone</label>
                                      <input type="text" name="alternate_phone" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->alternate_phone : ''; ?>" placeholder="Aleternate Phone">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">Ext</label>
                                      <input type="text" name="phone_ext" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->phone_ext : ''; ?>" placeholder="Extension">
                                    </div>
                                </div>
                            </div>
                            <h3 class="form-header">Mailing Address<h3>
                            <div class="row">
                                <div class="col-6">       
                                    <div class="form-group">
                                      <label for="country-name">Country</label>
                                      <input type="text" name="country" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->country : ''; ?>" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">Address</label>
                                      <textarea name="mailing_address" style="height: 195px;" class="form-control"><?php echo (isset($affiliate)) ? $affiliate->mailing_address : ''; ?></textarea>
                                    </div>                                    
                                </div>
                                <div class="col-6">       
                                    <div class="form-group">
                                      <label for="country-name">City</label>
                                      <input type="text" name="city" value="<?php echo (isset($affiliate)) ? $affiliate->city : ''; ?>" class="form-control" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">State</label>
                                      <input type="text" name="state" value="<?php echo (isset($affiliate)) ? $affiliate->state : ''; ?>" class="form-control" placeholder="State">
                                    </div>
                                    <div class="form-group">
                                      <label for="country-name">Zip code</label>
                                      <input type="text" name="zipcode" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->zipcode : ''; ?>" placeholder="Zip Code">
                                    </div>
                                </div>
                            </div>
                            <h3 class="form-header">Other Information<h3>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="country-name">Portal Access <i class="fa fa-question" data-toggle="tooltip" data-html="true" title='<i class="fa fa-lightbulb-o fa-lg" aria-hidden="true"></i> When you add an affiliate, you can grant them access to your portal to send you new leads and see the progress of the clients they refer. The client will always see the photo and contact information of the affiliate who referred them to you.'></i></label>
                                        <select class="form-control" name="portal_access" id="">
                                            <option <?php echo $affiliate->portal_access == 1 ? 'selected="selected"' : ''; ?> value="1">Yes</option>
                                            <option <?php echo $affiliate->portal_access == 0 ? 'selected="selected"' : ''; ?> value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-2 pt-4">                                                                
                                <div class="col-sm-12 mt-5 pl-0">
                                    <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                    <a class="btn btn-danger" href="<?php echo url('affiliate') ?>">Cancel this</a>
                                </div>                                             
                             </div>                   
                             <?php echo form_close(); ?>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $('.custom-file-label').click(function(){
        $('#formClient-Image').click();
    });
});
</script>
