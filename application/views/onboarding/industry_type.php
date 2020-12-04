<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
.wrapper-onboarding {
  padding: 40px;
  max-width: 1340px;
  margin: 0 auto;
  width: 100%;
}
.profile-avatar-help-container span {
  color: #6b3a96;
}
.submit-onboard {
  width: 97.5%;
  float: right;
}
.card {
  background: white !important;
  box-shadow: none !important;
}
img.banner-reg-b {
  background: black;
  object-fit: cover;
  height: 250px;
  width: 100%;
  margin-bottom: 8px;
}
.checkbox.checkbox-head label {
  padding-top: 7px;
  margin-bottom: 10px;
}
.row.sb-list {
  padding-left: 22px;
  margin-bottom: 10px;f
}
.validation-error-field {
  padding-top: 0px !important;
}
.margin-top-img {
  margin-top: 24px;
}
.text-right-v {
  text-align: right;
}
.card h3 {
  padding-bottom: 6px;
  border-bottom: 1px solid #e6e3e3;
  margin-bottom: 0px;
  margin-left: 15px;
  margin-right: 15px;
}
.label-default {
  background-color: #64d28f !important;
  font-size: 13px;
  line-height: 13px;
  padding: 3px 10px 4px 10px;
  color: white;
}
.icon-btn:hover {
  background: #4440ce;
}
.icon-btn {
  background: #20bf60;
  height: 25px;
  width: 24px;
  position: absolute;
  border-radius: 190px;
  left: 27px;
  margin-top: 7.3px;
  cursor: pointer;
}
.checkbox span.icon {
  font-weight: bold;
  font-size: 20px;
  color: #ffffff;
  cursor: pointer;
  position: relative;
  left: 6px;
  bottom: 2.5px;
}
span.text-ter {
  padding-top: 0px !important;
  display: block;
  margin-left: 20px;
  margin-bottom: 10px;
  position: relative;
  bottom: 10px;
}
.service-type {
  padding-left: 10px;
}
#form-business-details .card {
  padding: 20px 30px !important;
}
@media only screen and (max-width: 600px) {
  .icon-btn {
    background: #20bf60;
    height: 24px;
    width: 24px;
    position: absolute;
    border-radius: 190px;
    left: 8px;
    margin-top: 7.3px;
    cursor: pointer;
  }
  header#topnav {
    min-height: 0px !important;
  }
  .card.mb-0 {
      text-align: center;
      width: max-content;
      margin: 0 auto;
      display: contents;
  }
  body #topnav {
    min-height: 0px;
  }
  .col-md-9, .col-md-3, .col-md-4, .col-md-6 {
      padding-left: 0px !important;
      padding-right: 0px !important;
  }
  .text-right-v {
    text-align: center !important;
  }
  .profile-avatar-container {
    margin-bottom: 15px;
  }
  span.text-ter {
    font-size: 11px !important;
  }
  .checkbox-sec label span {
    font-size: 13px !important;
  }
  .checkbox span.icon {
    font-weight: bold;
    font-size: 20px;
    color: #ffffff;
    cursor: pointer;
    position: relative;
    left: 6px;
    bottom: 2.5px;
  }
  #form-business-details .card {
    padding: 20px 10px !important;
  }
  .wrapper-onboarding {
    padding: 20px 10px 60px 10px;
  }
  .card {
    width: 100% !important;
  }
  .col-md-6 {
    padding-top: 10px !important;
  }
  .checkbox.checkbox-sec label span {
      width: 100% !important;
      font-size: 11px !important;
  }
}
</style>
<?php include viewPath('includes/no_menu_header'); ?>
<!-- page wrapper start -->
<div>
   <div class="wrapper-onboarding">
      <div class="col-md-24 col-lg-24 col-xl-18">
        <h3 style="background-color: #4A2268;color:#ffffff;padding:11px;">My Services</h3>
        <img class="banner-reg-b" src="<?php echo base_url('assets/img/business-registration/fp-b.jpg') ?>" alt="">
        <?php echo form_open_multipart('onboarding/saveservices', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div class="card st-vl">

<h3>What type of services does your business offer?</h3>
<div class="row">
    <div class="col-md-12"><form id="form-business-services" method="post" action="#">
      <?php include viewPath('flash'); ?>
    <div class="card">
        <?php  $service = 1;
           foreach($businessTypes as $businessType){  ?>
        <div class="service-type">
            <div class="checkbox checkbox-head" data-action="toggle" data-id="servicetype<?php echo $service; ?>" data-id2="servicetypeoff<?php echo $service; ?>"  data-checked="">
                <div class="icon-btn"><span class="icon plus-icon collapse-group"><i class="fa fa-plus" style="font-size: 14px; line-height: 31px;"></i></span></div>
                <label><span class="section-header"><?php echo $businessType; ?></span></label>
                <div class="section-body servicetypeoff<?php echo $service; ?>" data-off-for="servicetype<?php echo $service; ?>" style="">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body servicetype<?php echo $service; ?>" data-on-for="servicetype<?php echo $service; ?>" style="">
                <div class="row sb-list">

                <?php foreach($industryType as $industryValue){ ?>
                    <?php if($industryValue->business_type_name == $businessType){
                          $select = false;
                          if($selectedCategories){
                            foreach ($selectedCategories as $key => $selectedCategory) {
                              if($industryValue->id == $selectedCategory->industry_type_id){
                                $select = true;
                              }
                            }
                          }
                    ?>
                    <div class="col-xs-24 col-sm-12 col-md-6">
                        <div class="checkbox checkbox-sec">
                            <input type="checkbox"  <?php if($select){ ?> checked="checked" <?php } ?> name="categories[<?php echo $industryValue->id; ?>]" value="<?php echo $industryValue->name; ?>" class="cat-cat" id="category-<?php echo $industryValue->id; ?>">
                            <label for="category-<?php echo $industryValue->id; ?>"><span><?php echo $industryValue->name; ?></span></label>
                        </div>
                    </div>

                <?php     }
                    }//end foreach  ?>

                </div>
            </div>
        </div>


      <?php $service++;  } //endforeach ?>

    </div>

    <hr class="card-hr">
<div class="card mb-0">
    <div class="row">
    	<div class="col-md-8">
    	    <!-- <button class="btn btn-default btn-lg" name="btn-save" type="submit">Save</button>  -->
    	</div>
    	<div class="col-md-4 text-right-v">
    		    		<a class="btn btn-default btn-lg" href="about">« Back</a>
    		    		    	<!--	<a href="credentials" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>  -->
                        <button class="btn btn-primary btn-lg margin-left" name="btn-save" type="submit">Next »</button>
    		    	</div>
    </div>
</div>
</form>

<div class="modal alert-modal" id="alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Add More Services</h4>
            </div>
            <div class="modal-body">
                <p>
                    You reached the maximum number of services for your plan.
                </p>
                <!--
                <p>
                    If you want to add more services, you need to upgrade your current plan.
                </p>
                 -->
            </div>
            <div class="modal-footer">
                <!--
                <a class="btn btn-primary" href="https://www.markate.com/pro/account/plan">Upgrade Now</a>
                 -->
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>    </div>
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
<script type="text/javascript">
$(function(){
   var service = 0;
   $(".checkbox").click(function(){
        var servicetype = $(this).attr("data-id");
        var servicetype2 = $(this).attr("data-id2");
        $("."+servicetype).toggle();
        if(service==1){
          $("."+servicetype2).toggle();
        }
    });
   $(".checkbox").click();
   service = 1;

   $(".plus-icon").click(function(){
    if( $(this).hasClass('collapse-group') ){
      $(this).removeClass('collapse-group');
      $(this).addClass('uncollapse-group');

      $(this).find("i.fa").removeClass("fa-plus");
      $(this).find("i.fa").addClass("fa-minus");
    }else{
      $(this).addClass('collapse-group');
      $(this).removeClass('uncollapse-group');

      $(this).find("i.fa").addClass("fa-plus");
      $(this).find("i.fa").removeClass("fa-minus");
    }
   });

});
</script>
