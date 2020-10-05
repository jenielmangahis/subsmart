<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
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
                                    <h3 class="page-title">Add Affiliate Partner</h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <!-- <a href="<?php echo url('inquiries/add') ?>" class="btn btn-primary" aria-expanded="false">
									<i class="mdi mdi-settings mr-2"></i> New inquiry
								</a>    -->
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('affiliate') ?>"><span
                                                            class="fa fa-caret-left"></span> Back</a>
                                            <?php //endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-2" role="alert">
                            <span style="color:black;">Affiliates partners are other professionals who refer new leads/clients to you. They are often Mortgage Brokers, Realtors, Auto Dealers, whose business depends upon having clients with good credit. Visit Affiliate Payments to set commission options and record payments for your affiliates. To see an overview of revenue from affiliates on your Afiliate Stats Dashboard. </span>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                            <?php echo form_open_multipart('affiliate/saveAffiliate', [ 'id'=> 'form-affiliate-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                             <div class="row ml-2 pt-4">
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">First Name<span style="color:red;">*</span> </label>
                                        </div>
                                        <div class="col">
                                            <input type="hidden" name="affiliate_id" value="<?php echo (isset($affiliate)) ? $affiliate->id : ''; ?>">
                                            <input type="text" name="first_name" required class="form-control" placeholder="First name" value="<?php echo (isset($affiliate)) ? $affiliate->first_name : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Last Name<span style="color:red;">*</span> </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="last_name" required class="form-control" placeholder="Last name" value="<?php echo (isset($affiliate)) ? $affiliate->last_name : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 mt-3">
                                    <div class="row">
                                        <div class="pr-5">
                                            <label for="">Gender<span style="color:red;">*</span> </label>
                                        </div>
                                        <div class="col">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genderRadioOptions" <?php echo (isset($affiliate)) ? (($affiliate->gender === "Male") ? 'checked' : '') : ''; ?> id="inlineRadio1" value="Male">
                                                <label class="form-check-label" for="inlineRadio1">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genderRadioOptions" <?php echo (isset($affiliate)) ? (($affiliate->gender === "Female") ? 'checked' : '') : ''; ?> id="inlineRadio2" value="Female">
                                                <label class="form-check-label" for="inlineRadio2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 mt-3">
                                    <div class="row">
                                        <div class="pt-2 pr-4">
                                            <label for="">Company </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="company" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->company : ''; ?>" placeholder="Company">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Website URL </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="website_url" id="websiteUrl" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->website_url : ''; ?>" placeholder="">
                                        </div>
                                        <div class="col mt-2">
                                            <a href="javascript:void(0)" id="checkAffiliateURL">Check URL</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-4 mt-3">
                                    <div class="row">
                                        <div class="pt-2 pr-5">
                                            <label for="">Email<span style="color:red;">*</span> </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="email" required class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->email : ''; ?>"  placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Phone<span style="color:red;">*</span> </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="phone" required class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->phone : ''; ?>" placeholder="">
                                        </div>
                                        <div class="pt-2 pr-2">
                                            <label for="">Ext</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="phone_ext" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->phone_ext : ''; ?>" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 mt-3">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Alternate Phone </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="alternate_phone" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->alternate_phone : ''; ?>" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Fax </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="fax" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->fax : ''; ?>" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-12 pl-0 mt-4">
                                    <a href="javascript:void(0)" id="addMailAdd"><span class="fa fa-plus"> Add mailing Address (optional)</a>
                                    <a href="javascript:void(0)" class="hide-address" id="hideMailAdd"><span class="fa fa-minus"> Add mailing Address (optional)</a>
                                </div>
                                <div class="col-sm-8 mt-4 hide-address">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Mailing Address </label>
                                        </div>
                                        <div class="col">
                                            <textarea name="mailing_address" class="form-control"><?php echo (isset($affiliate)) ? $affiliate->mail_address : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 hide-address"></div>
                                <div class="col-sm-4 mt-3 hide-address">
                                    <div class="row">
                                        <div class="pt-2 pr-5">
                                            <label for="">City </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="city" value="<?php echo (isset($affiliate)) ? $affiliate->city : ''; ?>" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3 hide-address">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">State </label>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->state : ''; ?>" name="state" id="exampleFormControlSelect1">
                                                <option value="all">All</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 hide-address"></div>
                                <div class="col-sm-4 mt-3 hide-address">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Zip code </label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="zipcode" class="form-control" value="<?php echo (isset($affiliate)) ? $affiliate->zipcode : ''; ?>" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3 hide-address">
                                    <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Country </label>
                                        </div>
                                        <div class="col pt-2 pr-2">
                                            <label for="">United States </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 hide-address"></div>
                                <div class="col-sm-4 mt-3 hide-address">
                                    <div class="row">
                                        <div class="pt-2 pr-3">
                                            <label for="">Status<span style="color:red;">*</span> </label>
                                        </div>
                                        <div class="col">
                                            <?php if (isset($affiliate)) : ?>
                                                <select class="form-control" name="status" id="exampleFormControlSelect1">
                                                    <option value="<?php echo $affiliate->status?>" selected><?php echo $affiliate->status?></option>
                                                    <option value="Active">Active (recommended)</option>
                                                    <option value="Inactive">Inactive</option>
                                                    <option value="Pending">Pending</option>
                                                </select>
                                            <?php else : ?>
                                                <select class="form-control" name="status" id="exampleFormControlSelect1">
                                                    <option value="" selected disabled>Select Status</option>
                                                    <option value="active">Active (recommended)</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 hide-address"></div>
                                <div class="col-sm-8 mt-4">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Notes (internal)</label>
                                        </div>
                                        <div class="col">
                                            <textarea name="notes" class="form-control"><?php echo (isset($affiliate)) ? $affiliate->notes : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8 mt-3">
                                     <div class="row">
                                        <div class="pt-3 pr-2">
                                            <label for="">Photo</label>
                                        </div>
                                        <div class="col pt-2 pr-2">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image" id="formClient-Image"
                                                placeholder="Upload Image" accept="image/*"
                                                onchange="readURL(this, 'photoAffiliate');">
                                        </div>
                                        </div>
                                        <div class="col pt-2 pr-2">
                                            (Only jpeg, jpg and png)
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-12">
                                    <?php if (isset($affiliate)) : ?>
                                        <img src="../uploads/affiliate/<?php echo logged('company_id') . '/' . $affiliate->photo; ?>" width="180" id="photoAffiliate" alt="">
                                    <?php else :?>
                                        <img src="../uploads/users/default.png" width="180" id="photoAffiliate" alt="">
                                    <?php endif ;?>
                                </div>
                                <div class="col-sm-8 mt-3">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Assigned To</label>
                                        </div>
                                        <div class="col pt-2 pr-2">
                                            <div class="form-check">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" name="id_selector" id="select1">
                                                    <label for="select1">Tomy Fico</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" name="id_selector1" id="select2">
                                                    <label for="select2">Fico Heroes</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8 mt-3">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" <?php (isset($affiliate)) ? (($affiliate->add_master_contact_list) ? 'checked' : 'checked') : '' ?> name="add_masterlist" id="add_masterlist">
                                                <label for="add_masterlist">Add to master contact list</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3" style="border-top:1px solid gray;">
                                     <div class="row">
                                        <div class="pt-2 pr-2">
                                            <label for="">Portal Access</label>
                                        </div>
                                        <div class="col mt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">On</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" checked type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Off</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-5 pl-0">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                </div> 
                                <div class="col-sm-12 mt-4 pl-0">
                                    <div class="alert alert-secondary" role="alert">
                                    <i class="fa fa-lightbulb-o fa-lg" aria-hidden="true"></i> When you add an affiliate, you can grant them access to your portal to send you new leads and see the progress of the clients they refer. The client will always see the photo and contact information of the affiliate who referred them to you. 
                                    </div>
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
<style>
.hide-address {
    display: none;
}
</style>
