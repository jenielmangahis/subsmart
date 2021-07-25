<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.hide {
    display:none;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <div class="container-page">
    <div class="container-fluid">

<div class="row">
    <div class="col-md-12 col-lg-12">

    <div class="row align-items-center" style="margin-top: 30px;">
      <div class="col-sm-12">
          <h3 class="page-title">My Account</h3>
      </div>
    </div>
    <div class="pl-3 pr-3 mt-1 row">
        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">My Account Infomation</span>
        </div>
    </div>


<div class="card">
        <div class="row">
            <div class="col-md-2">
                <strong>Business Name</strong>
            </div>
            <div class="col-md-3">
                <div>
                    <a class="profile-avatar-img" data-fileuploadmodal="open-modal" href="#"><img height="100" data-fileuploadmodal="image-parent" id="img_profile" src="<?php echo (businessProfileImage($business->id)) ? businessProfileImage($business->id) : $url->assets ?>"></a>
                </div>
                <?= $business->business_name; ?>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-2">
                <strong>Business Description</strong>
            </div>
            <div class="col-md-3"><?= $business->business_desc; ?></div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-2">
                <strong>Email</strong>
            </div>
            <div class="col-md-3"><?= $business->business_email; ?></div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-2">
                <strong>Contact Name</strong>
            </div>
            <div class="col-md-3"><?= $business->contact_name; ?></div>
        </div>
        <br />
</div>

<div class="card">
    <div class="row">
        <div class="col-md-2">
            <strong>Address</strong>
        </div>
        <div class="col-md-3"><?= $business->address; ?></div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-2">
            <strong>ZIP</strong>
        </div>
        <div class="col-md-3"><?= $business->zip; ?></div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-2">
            <strong>Contact Name</strong>
        </div>
        <div class="col-md-3"><?= $business->contact_name; ?></div>
    </div>
    <br />
</div>

<div class="card-spacer"></div>


<div class="card-spacer"></div>



    </div>
</div>
    </div>
</div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>