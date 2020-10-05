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

<h1>Availability</h1>

<div class="row">
    <div class="col-md-12 col-lg-12"><form id="form-business-availability" method="post" action="#">
    <div class="validation-error" style="display: none;"></div>

    <div class="card">
        <h3>Working Days</h3>
        <p>Your working days will appear on your public profile.</p>
        <ul class="wd-weekday clearfix">
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[0]" value="1" checked="checked" id="weekday_0">
                    <label for="weekday_0"><span>Mon</span></label>
                </div>
            </li>
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[1]" value="1" checked="checked" id="weekday_1">
                    <label for="weekday_1"><span>Tue</span></label>
                </div>
            </li>
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[2]" value="1" checked="checked" id="weekday_2">
                    <label for="weekday_2"><span>Wed</span></label>
                </div>
            </li>
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[3]" value="1" checked="checked" id="weekday_3">
                    <label for="weekday_3"><span>Thu</span></label>
                </div>
            </li>
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[4]" value="1" checked="checked" id="weekday_4">
                    <label for="weekday_4"><span>Fri</span></label>
                </div>
            </li>
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[5]" value="1" id="weekday_5">
                    <label for="weekday_5"><span>Sat</span></label>
                </div>
            </li>
                        <li>
                <div class="checkbox checkbox-sec checkbox-border">
                    <input type="checkbox" name="weekday[6]" value="1" id="weekday_6">
                    <label for="weekday_6"><span>Sun</span></label>
                </div>
            </li>
                    </ul>
    </div>

    <hr class="card-hr">

    <div class="card">
        <h3>Time Off / Unavailability</h3>
        <p>Please set your unavailable timings and time-off.</p>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-4 times-availability">
                    <label>Time Off From</label>
                    <div class="input-group">
                       <input type="text" name="timeoff_from" value="" class="form-control hasDatepicker" id="timeoff_from">
                       	<div class="input-group-addon calendar-button" data-for="timeoff_from">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="timeoff_from" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="col-lg-4 times-availability">
                    <label>Time Off To</label>
                    <div class="input-group">
                        <input type="text" name="timeoff_to" value="" class="form-control hasDatepicker" id="timeoff_to">
                        <div class="input-group-addon calendar-button" data-for="timeoff_to">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="timeoff_to" data-formerrors-message="true" style="display: none;"></span>
                </div>
            </div>
        </div>
    </div>

    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		    		<button class="btn btn-default btn-lg" name="btn-save" type="button">Save</button> <span class="alert-inline-text margin-left hide">Saved</span>
    		    	</div>
    	<div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="credentials">« Back</a>
    		    		    		<a href="workpictures" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
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

