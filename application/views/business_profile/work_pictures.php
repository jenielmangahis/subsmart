<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-12 col-lg-12">
        <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div class="card">

<h1>Work Pictures</h1>

<div class="row">
    <div class="col-md-12 col-lg-12">
<form id="form-business-credentials" method="post" action="#">
    <div class="validation-error hide"></div>

    <div class="card">
        <p>Add photos to spotlight features of your business or past projects pictures.  You can upload up to <b>25 images.</b></p>
        <p><b>Tips</b> - Click and drag the images to reorder them, and click on "Set caption" to describe the image.

        </p><hr>

        <div class="alert alert-danger gallery-alert" data-fileupload="error" role="alert" style="display: none;"></div>

        <ul class="gallery ui-sortable" id="gallery">
        <li id="picture-id-9083">
    <div class="picture-container ui-sortable-handle">
        <div class="img">
            <img src="https://markate.blob.core.windows.net/cdn/20200412/buspor_13050_a138193f55_md.jpg">
            <a class="delete" data-fileupload="delete" data-id="9083" href=""><span class="fa fa-remove"></span></a>
        </div>
        <div class="caption editable editable-pre-wrapped editable-click" data-id="9083" data-emptytext="Set caption..." data-placeholder="" data-title="Set Caption">Lorem</div>
    </div>
</li>
        </ul>

        <hr>

        <div class="" data-fileupload="progressbar" style="display: none;">
            <div class="text">Uploading</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload Image <input data-fileupload="file" name="fileimage" type="file"></span>
        </div>
    </div>

    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		    	</div>
    	<div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="availability">« Back</a>
    		    		    		<a href="profilesetting" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
    		    	</div>
    </div>
</div>
</form>

    </div>
</div>
    </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
   <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
         <span class="mdc-bottom-navigation__list-item__text">Recents</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
         <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
            <span class="material-icons mdc-bottom-navigation__list-item__icon">
               <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                  <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
               </svg>
            </span>
            <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
         </span>
      </nav>
   </div>
</div>
<?php include viewPath('includes/footer'); ?>

