<?php include viewPath('includes/header_front'); ?>
<style>
#company-cover-photo {
    background-size: cover;
    background-position: center;
    height: 50vh;
    width: 100%;
}
.profile-headline .profile-cnt h1 {
    font-size: 34px;
    margin: 10px 0 5px 0;
    padding: 0;
    color: #333;
}
.profile-headline .profile-avatar {
    position: absolute;
    width: 150px;
    height: 150px;
    top: 0;
    left: 0;
    margin-top: -75px;
    border-radius: 50%;
    border: 3px solid #e5eaea;
    background: #e5eaea;
    z-index: 200;
}
.profile-headline .profile-cnt {
    padding-left: 83px;
}
.label-default {
    background-color: #6a4a85 !important;
    font-size: 13px;
    line-height: 13px;
    color: white;
    border-radius: 26px;
    margin-bottom: 17px;
    display: inline-block;
    padding: 5px 15px !important;
}
.list-availability li{
  margin-top: 10px;
}
.credential .credential-badge {
    position: absolute;
    top: 0;
    left: 0;
    width: 100px;
    text-align: center;
}
.credential .credential-cnt {
    padding-left: 140px;
    position: relative;
    margin: 0px !important;
    width: 100%;
}
.credential .credential-badge img {
    width: 60px;
    height: 60px;
    margin: 0 auto;
}
.credential .credential-badge .badge-label {
    padding-top: 5px;
    display: block;
    color: #888;
}
.credential-cnt span{
  margin: 10px 0px;
  display: block;
}
.credential-badge-year-text {
    position: absolute;
    top: 14px;
    left: 0;
    width: 100%;
    font-size: 14px;
    text-align: center;
    font-weight: 500;
    color: #f38932;
}
.credential-verification {
    margin-bottom: 6px;
}
.credential-verification .fa.active {
    color: #2ab363;
}
.credential-verification .fa {
    color: #888;
    margin-right: 8px;
}
div[wrapper__section] [role="white__holder"] .profile-subtitle {
    font-size: 24px !important;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.credential-verification span{
  display: inline-block !important;
}
.credential .credential-cnt .credential-img {
    width: 37px;
    border: 1px solid #eaeaea;
    margin-top: 5px;
    margin-right: 10px;
    border-radius: 4px;
    display: inline-block;
}
.cat-selected .tag {
    margin-right: 5px;
    display: inline-block;
}
.label-default {
    background-color: #6a4a85 !important;
    font-size: 13px;
    line-height: 13px;
    color: white;
    border-radius: 26px;
    margin-bottom: 6px;
    display: inline-block;
    padding: 5px 15px !important;
}
.image-caption{
  position: relative;
    top: -25px;
    left: 16px;
    color: #ffffff;
}
.gallery li{
  width: 30%;
  display: inline-block;
  margin: 10px;
  height: 286px;
  float: left;
}
div.picture-container div.img img {
    object-fit: cover;
    height: 286px;
    width: 100% !important;
}
</style>
<div role="wrapper" style="padding-top: 0px;">
    <div class="profile__top">
      <?php
        $company_id = 0; 
        if($profiledata){
          $company_id = $profiledata->company_id;
        } 
      ?>
      <div class="img-responsive" id="company-cover-photo" style="background-image: url('<?= getCompanyCoverPhoto($company_id); ?>');"></div>
      <!-- <img src="<?= getCompanyCoverPhoto($company_id); ?>" /> -->
    </div>
    <div class="headline">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <div class="profile-headline profile-headline1">
              <img class="profile-avatar" src="<?php echo (businessProfileImage($profiledata->id)) ? businessProfileImage($profiledata->id) : $url->assets ?>">
              <div class="profile-cnt">
                <div class="profile-cnt">
                  <div class="profile-cnt-h">
                    <h1><?php echo $profiledata->business_name ?></h1>
                  </div>
                  <div class="profile-address"><?php echo $profiledata->city ?>, <?php echo $profiledata->state ?></div>
                </div>
              </div>
            </div>   
          </div>
          
          <div class="col-sm-7"></div>
        </div>
      </div>
    </div>
    <div class="profile-nav-section" data-profile-nav="nav">
      <div class="container">
        <ul class="profile-nav clearfix">
          <li><a class="a-default active" href="#profile-nav-overview">Overview</a></li>
          <li><a class="a-default" href="#profile-nav-credentials">Credentials</a></li>
          <li><a class="a-default" href="#profile-nav-deals">Deals</a></li>
          <li><a class="a-default" href="#profile-nav-portfolio">Portfolio</a></li>
          <li><a class="a-default" href="#profile-nav-reviews">Reviews</a></li>
        </ul>
      </div> 
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
            
            <!-- Services Offered -->
            <div role="white__holder_section_holder">
              <div class="profile-service">
                <div class="profile-service-category">
                  <div class="margin-bottom-sec">
                    <div class="profile-service-title"><h3 class="profile-subtitle">Residential Services Offered</h3></div>
                    <br />
                    <?php foreach($selectedCategories as $s){ ?>
                      <span class="label label-default tag"><?= $s->service_name; ?><!-- <a class="cat-tag-remove" id="cat-tag-remove-93" href="#"><span class="icon fa fa-remove"></span></a> --></span>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <div class="col-md-12">
            <!-- Business Credentials -->
            <div role="white__holder_section_holder">
              <div class="profile-content-section" id="profile-nav-credentials">
              <h3 class="profile-subtitle">Business Credentials</h3>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="credential">
                      <div class="credential-badge">
                        <img src="<?= $url->assets . "img/badge_1.png" ?>"> <span class="badge-label">License</span>
                      </div>
                      <?php if( $profiledata->is_licensed == 1 ){ ?>
                        <div class="credential-cnt">
                          <span>State/Province : <?= $profiledata->license_state; ?>, Expires on: <?= date("m/d/Y",strtotime($profiledata->license_expiry_date)); ?></span>
                          <span>Class : <?= $profiledata->license_class; ?>, Nr:<?= $profiledata->license_number; ?></span>
                          <?php if( $profiledata->license_image != '' ){ ?>
                            <img class="credential-img" src="<?php echo (licenseImage($profiledata->id)) ? licenseImage($profiledata->id) : $url->assets ?>">
                            <a style="color:#888;" href="<?php echo (licenseImage($profiledata->id)) ? licenseImage($profiledata->id) : $url->assets ?>" target="_blank">View License</a>
                          <?php } ?>
                        </div>
                      <?php }else{ ?>
                        <div class="credential-cnt">Not Licensed</div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="credential">
                      <div class="credential-badge">
                        <img src="<?= $url->assets . "img/badge_2.png" ?>"> <span class="badge-label">Bond</span>
                      </div>
                      <?php if( $profiledata->is_bonded == 1 ){ ?>
                        <div class="credential-cnt">
                          <span>Insured Amount: $<?= number_format($profiledata->bond_amount,2); ?></span>
                          <span>Expires on: <?= date("m/d/Y",strtotime($profiledata->bond_expiry_date)); ?></span>
                          <?php if( $profiledata->bond_image != '' ){ ?>
                            <img class="credential-img" src="<?php echo (bondImage($profiledata->id)) ? bondImage($profiledata->id) : $url->assets ?>">
                            <a style="color:#888;" href="<?php echo (bondImage($profiledata->id)) ? bondImage($profiledata->id) : $url->assets ?>" target="_blank">View Bonded</a>
                          <?php } ?>
                        </div>
                      <?php }else{ ?>
                        <div class="credential-cnt">Not Bonded</div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="credential">
                      <div class="credential-badge">
                        <img src="<?= $url->assets . "img/badge_3.png" ?>"> <span class="badge-label">Insurance</span>
                      </div>
                      <?php if( $profiledata->is_business_insured == 1 ){ ?>
                        <div class="credential-cnt">
                          <span>Insured amount: $<?= number_format($profiledata->insured_amount,2); ?></span>
                          <span>Expires on: <?= date("m/d/Y",strtotime($profiledata->insurance_expiry_date)); ?></span>
                        </div>
                      <?php }else{ ?>
                        <div class="credential-cnt">Not Insured</div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="credential">
                      <div class="credential-badge">
                        <img src="<?= $url->assets . "img/badge_4.png" ?>"> <span class="badge-label">Accreditation</span>
                      </div>
                      <?php if( $profiledata->is_bbb_accredited == 1 ){ ?>
                        <div class="credential-cnt">
                          <span>BBB Accredited</span>
                          <span><a href="<?= $profiledata->bbb_link; ?>" target="_blank">View BBB page</a></span>
                        </div>
                      <?php }else{ ?>
                        <div class="credential-cnt">Not Accredited</div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="credential">
                      <div class="credential-badge">
                        <img src="<?= $url->assets . "img/badge_6.png" ?>"> <span class="badge-label">Verifications</span>
                      </div>
                      <div class="credential-cnt">
                        <div class="row credential-verification">
                          <div class="col-md-6">
                            <span class="fa fa-check active"></span> Phone
                          </div>
                          <div class="col-md-6">
                            <span class="fa fa-check active"></span> Email
                          </div>
                        </div>

                        <div class="row credential-verification">
                          <div class="col-md-6">
                            <span class="fa fa-circle-o"></span> Facebook
                          </div>
                          <div class="col-md-6">
                            <span class="fa fa-check active"></span> Google
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="credential">
                      <div class="credential-badge">
                        <div class="credential-badge-year">
                          <img src="<?= $url->assets . "img/badge_5.png" ?>">
                          <div class="credential-badge-year-text"><?= $profiledata->year_est > 0 ? $profiledata->year_est : ''; ?></div>
                        </div>
                        <span class="badge-label">Since</span>
                      </div>
                      <?php if( $profiledata->year_est > 0 ){ ?>
                        <div class="credential-cnt">
                          <span>Business since:<b> <?= $profiledata->year_est; ?></b></span>
                            <?php
                              $total_years = date("Y") - $profiledata->year_est;
                            ?>
                                                    <span></span>
                        </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-12">
          <div class="col-sm-6 left">
              <h3 class="page-title">Portfolio</h3>
            </div>
          </div>
          <section class="content">
             <?php
              $images = array();
              if( $profiledata->work_images != '' ){
                $images = unserialize($profiledata->work_images);
              }
             ?>
             <?php if($images){ ?>
             <ul class="gallery ui-sortable" id="gallery">
                <?php foreach($images as $key => $i){ ?>
                  <li class="col-image-<?= $key ?>">
                    <div class="picture-container ui-sortable-handle">
                      <div class="img">
                          <img src="<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>">
                          <div class="image-caption image-caption-container-<?= $key; ?>">
                            <?= $i['caption']; ?>
                          </div>
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            <?php } ?>
          </section>
        </div>

      </div>
    </div>
    


  </div>
<?php include viewPath('includes/footer_pages'); ?>
