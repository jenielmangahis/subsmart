<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.list-icon li{
  display: inline-block;
  /*width: 30%;*/
  height:100px;
  margin: 3px;
}
#form-business-details .card {
    padding: 30px 25px !important;
    border-radius: 6px;
}
.mt-18 {
  margin-top: 10px;
}
</style>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
        <?php echo form_open_multipart('users/saveservices', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div class="card">

<div class="row pl-0 pr-0">
    <div class="col-md-24 col-lg-24 col-xl-18"><form id="form-business-services" method="post" action="#">

    <div class="card mt-0">
        <h3 class="page-title mb-0 mt-18">Services</h3>
        <div class="margin-bottom">
            Selected services:
            <div class="cat-selected" id="cat-selected">
            <span class="label label-default tag">Security<a class="cat-tag-remove" id="cat-tag-remove-93" href="#"><span class="icon fa fa-remove"></span></a></span>            <script async="" src="https://www.google-analytics.com/analytics.js"></script><script id="cat-selected-tag" type="text/x-handlebars-template">
            <span class="label label-default tag">{{name}}<a class="cat-tag-remove" id="cat-tag-remove-{{id}}" href="#"><span class="icon fa fa-remove"></span></a></span>
            </script>
            </div>
        </div>

        <div class="validation-error" style="display: none;"></div>


        <?php  $service = 1;
           foreach($businessTypes as $businessType){  ?>
        <div class="service-type">
            <div class="checkbox checkbox-sec" data-action="toggle" data-id="servicetype<?php echo $service; ?>" data-checked="">
                <span class="icon">+</span>
                <label><span class="section-header"><?php echo $businessType; ?></span></label>
                <div class="section-body servicetype<?php echo $service; ?>" data-off-for="servicetype<?php echo $service; ?>" style="">
                    <span class="text-ter">Click to open and select services.</span>
                </div>
            </div>
            <div class="section-body servicetype<?php echo $service; ?>" data-on-for="servicetype<?php echo $service; ?>" style="">
                <div class="row">

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

    <hr class="card-hr mt-2">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		    		<button class="btn btn-default btn-lg" name="btn-save" type="submit">Save</button> <span class="alert-inline-text margin-left hide">Saved</span>
    		    	</div>
    	<div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="businessdetail">« Back</a>
    		    		    		<a href="credentials" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
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
   $(".checkbox-sec").click(function(){
        var servicetype = $(this).attr("data-id");
        $("."+servicetype).toggle();
    });
});
</script>
