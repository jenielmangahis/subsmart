<?php include viewPath('includes/header_business_view'); ?>
<style>
.container {
    width: 1170px;
}
.container, .container-fluid {
    padding-left: 15px;
    padding-right: 15px;
}
.container,.container-fluid {
    margin-right: auto;
    margin-left: auto;
}
.row {
    margin-left: -15px;
    margin-right: -15px;
    display: block;
}
.share a {
    font-size: 32px;
    margin-right: 21px;
}
ul.business-info li {
    font-size: 15px;
    list-style-type: disc;
    margin-left: 17px;
    margin-bottom: 4px;
}
hr {
    margin-top: 1rem !important;
    margin-bottom: 1rem !important;
}
.icon-top {
    color: #9264b9;
    font-size: 30px;
    width: 100%;
    font-weight: bold;
}
ul.deal-stats.clearfix li {
    width: 33.33%;
    float: left;
}
a.btn-purple {
    float: right;color: #ffffff;font-weight: bold;background: #64477d;padding: 7px 28px;border-radius: 25px;
}
ul.deal-stats.clearfix li span {
    color: #757171 !important;
    font-size: 16px;
    margin-top: 10px;
}
.business-img{
  height: 105px;
}
</style>
<?php 
  $today      = new DateTime();
  $valid_to   = new DateTime($dealsSteals->valid_to);
  $days_dif   = $valid_to->diff($today)->format("%a");

  $diff_increase  = $dealsSteals->original_price - $dealsSteals->deal_price;
  $percentage_off = ($diff_increase / $dealsSteals->original_price) * 100;

  $slug = createSlug($dealsSteals->title,'-');
  $deal_url = url('deal/' . $slug . '/' . $dealsSteals->id);
?>
<div class="container" style="padding-top: 0px;background:white;padding-left:37px;padding-right:37px;">
   <div class="header-cnt">
      <div class="btn-back-cnt">
         <a class="btn-purple" href="<?= base_url('business/' . $company->profile_slug); ?>">View all my deals</a>
      </div>
      <div class="row">
         <div class="col-sm-18">
            <h1><?= $dealsSteals->title; ?></h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 left pl-0" style="border-right:1px solid #e5e5e5;min-height:807px;">
         <div class="deal-cnt">
            <div class="image-carousel">
               <div class="image-carousel-slides" data-image-carousel="slides" style="height: auto;margin-bottom:40px;">
                  <div class="deals-image" data-image-carousel="slide">
                     <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>">
                  </div>
               </div>
            </div>
            <div class="deal-subtitle bold">What You'll Get</div>
            <hr>
            <p class="margin-bottom"><?= $dealsSteals->description; ?></p>
            <div class="deal-subtitle bold">Terms &amp; Conditions</div>
            <hr>
            <p class="margin-bottom">
               <?= $dealsSteals->terms_conditions; ?>                              
            </p>
         </div>
      </div>
      <div class="col-md-6 left pr-4 pl-4">
         <ul class="deal-stats clearfix">
            <li>
               <i class="fa fa-scissors icon-top"></i>
               <span class="deal-stats-discount text-ter">Discount <?= $percentage_off; ?>%</span>
            </li>
            <li>
               <i class="fa fa-calendar-check-o icon-top"></i>
               <span>Expires in <?= $days_dif; ?> days</span>
            </li>
            <li>
               <i class="fa fa-eye icon-top"></i>
               <span>Under <?= $dealsSteals->views_count; ?> viewed</span>
            </li>
         </ul>
         <hr class="deals-stats-hr">
         <div class="text-center margin-bottom-ter" style="margin-bottom:50px;">
            <div class="row">
               <div class="col-6 left text-right">
                  <div class="deal-price-cnt">
                     <div class="deal-price-label text-sec bold">Deal Price</div>
                     <div class="deal-price text-sec" style="font-size:28px;">
                        $<?= number_format($dealsSteals->deal_price,2); ?>                           
                     </div>
                  </div>
               </div>
               <div class="col-6 left text-left">
                  <div class="deal-price-original-cnt">
                     <div class="deal-price-original-label text-ter bold">Was</div>
                     <div class="deal-price-original text-ter" style="margin-top:8px;font-size:20px;text-decoration: line-through">
                        $<?= number_format($dealsSteals->original_price,2); ?>                            
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br class="clearfix"/><br/>
         <a class="btn btn-primary btn-lg btn-block" style="background-color:#64477d !important;" href="<?= base_url('deal/booking/' . $dealsSteals->id); ?>">Book This Deal</a>
         <div class="text-center margin-top-sec">
            <span class="text-ter text-sm">No credit card required</span>
         </div>
         <hr class="margin-top margin-bottom">
         <div class="side-title bold">Share This Deal</div>
         <div class="share">
            <?php 

            ?>
            <a class="share-circle share-facebook" style="color:#3b5998;" href="javascript:void(0);" target="_blank"><span class="fa fa-facebook"></span></a>
            <a class="share-circle share-twitter" style="color:#00acee;" href="https://twitter.com/share?url=<?= $deal_url; ?>" target="_blank"><span class="fa fa-twitter"></span></a>
            <a class="share-circle share-google" style="color:#4285F4;" href="https://plus.google.com/share?url=<?= $deal_url; ?>&title=<?= $dealsSteals->title; ?>&" target="_blank"><span class="fa fa-google"></span></a>
            <a class="share-circle share-pinterest" style="color:#E60023;" href="http://pinterest.com/pin/create/button/?url=<?= $deal_url; ?>&description=<?= $dealsSteals->title; ?>&" target="_blank"><span class="fa fa-pinterest"></span></a>
            <a class="share-circle share-mail" style="color:#4285f4;" href="mailto:?subject=<?= $dealsSteals->title; ?>&body=I thought you would like this deals <?= $deal_url; ?>" target="_blank"><span class="fa fa-envelope"></span></a>
         </div>
         <br>
         <div class="side-title bold">About <?= $company->business_name; ?></div>
         <br/>
         <div class="business">
            <img class="business-img" src="<?= getCompanyCoverPhoto($dealsSteals->company_id); ?>">
         </div>
         <br/>
         <ul class="business-info">
            <li>
                <span class="business-name"><?= $company->business_name; ?></span>
                <span class="business-location"><?= $company->street; ?>, <?= $company->state; ?></span>
            </li>
            <li>
               Business since <?= $company->year_est; ?>                
            </li>
            <li>
               Licensed in FL                
            </li>
            <?php if($company->is_bonded == 1){ ?>
            <li>
               Bonded
            </li>
            <?php } ?>
            <?php if($company->is_business_insured == 1){ ?>
            <li>
               Insured
            </li>
            <?php } ?>
         </ul>
         <br/><!-- 
         <span class="text-ter">About</span>
         <p>Panhandle’s Honeywell alarm dealership</p> -->
      </div>
   </div>
</div>
<?php include viewPath('includes/footer_pages'); ?>

