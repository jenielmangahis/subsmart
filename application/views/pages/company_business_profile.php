<?php include viewPath('includes/header_business_view'); ?>
<style>
    #company-cover-photo {
        background-size: cover;
        background-position: center;
        height: 420px;
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

    .list-availability li {
        margin-top: 10px;
    }

    .credential .credential-badge {
        position: absolute;
        top: 0;
        left: 0;
        width: 100px;
        text-align: center;
    }

    .profile-cnt-h h1 {
        font-size: 25px !important;
    }

    .credential .credential-cnt {
        padding-left: 110px;
        position: relative;
        margin: 0px !important;
        width: 100%;
    }

    .credential .credential-badge img {
      width: 80px;
      height: 80px;
      margin: 0 auto;
      object-fit: scale-down;
    }

    .credential .credential-badge .badge-label {
        padding-top: 5px;
        display: block;
        color: #888;
    }

    .credential .credential-badge .badge-label.bond {
      font-size: 16px;
      font-weight: 600;
      color: #f4902f;
    }

    .credential .credential-badge .badge-label.insurance {
      font-size: 16px;
      font-weight: 600;
      color: #102243;
    }

    .credential .credential-badge .badge-label.license {
      font-size: 16px;
      font-weight: 600;
      color: #6a4a85 ;
    }

 
    .credential .credential-badge .badge-label.accreditation {
      font-size: 16px;
      font-weight: 600;
      color: #bb2844;
    }

    .credential .credential-badge .badge-label.since {
      color: #03a8dd;
      font-weight: 600;
    }

    .credential .credential-badge .badge-label.verifications {
      color: #27b05f;
      font-weight: 600;
      font-size: 16px;
    }



    .credential-cnt span {
        margin: 10px 0px;
        display: block;
    }

    .left {
        float: left;
    }

    .credential-badge-year-text {
      position: absolute;
      bottom: 11px;
      left: 0;
      width: 100%;
      font-size: 19px;
      text-align: center;
      font-weight: 600;
      color: #4881c7;
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

    .credential-verification span {
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

    h3 {
        font-size: 22px;
        margin-bottom: 0px;
    }
    .mb-5{
      margin-bottom: 5rem !important;
    }

    /*.image-caption{
  position: relative;
    top: -25px;
    left: 16px;
    color: #ffffff;
}*/
    .gallery li {
        width: 30%;
        display: inline-flex;
        margin-right: 10px;
        margin-bottom: 10px;
        height: 392px;
    }

    div.picture-container div.img img {
        object-fit: cover;
        height: 286px;
        width: 100% !important;
    }

    .border-menu {
        border-bottom: 1px solid #eaeaea;
        display: inline-block;
        padding-top: 14px;
    }

    ul.profile-nav li a {
        font-weight: 300;
        font-size: 15px;
    }

    .floating-box {
        position: absolute;
        box-shadow: rgb(0 0 0 / 30%) 0px 0px 5px;
        width: 360px;
        background: white;
        padding: 25px 22px;
        top: -61px;
    }

    p.gray {
        color: #888888;
    }

    p {
        font-size: 16px;
        margin-bottom: 0px;
    }

    section.mr-23 {
        margin-left: 7px;
    }

    .social-share a {
        font-size: 25px;
        margin-right: 20px;
    }

    .facebook-color {
        color: #6279ae;
    }

    .twitter-color {
        color: #2ba2dc;
    }

    .gmail-color {
        color: #f3392a;
    }

    .pinterest-color {
        color: #ce232b;
    }

    .email-color {
        color: #ee710e;
    }

    .image-caption,
    .deals-caption {
        background: linear-gradient(to right, #2d1a3e 0%, #4a385d 100%);
        color: #ffffff;
        padding: 8px;
        height: 41px;
    }

    .gallery-img {
        display: inline-block;
        height: 126px;
    }
</style>
<div role="wrapper" style="padding-top: 0px;background:white;">
    <div class="profile__top">
        <?php
        $company_id = 0;
        if ($profiledata) {
            $company_id = $profiledata->company_id;
        }
        ?>
        <div class="img-responsive" id="company-cover-photo"
            style="background-color: #dddddd;background-image: url('<?= getCompanyCoverPhoto($company_id) ?>');"></div>
        <!-- <img src="<?= getCompanyCoverPhoto($company_id) ?>" /> -->
    </div>
    <div class="headline">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="profile-headline profile-headline1">
                        <img class="profile-avatar"
                            style="background-image:url('<?= getPublicCompanyBusinessProfileImage($company_id) ?>');background-size:contain;">
                        <div class="profile-cnt">
                            <div class="profile-cnt">
                                <div class="profile-cnt-h">
                                    <h1><?php echo $profiledata->business_name; ?></h1>
                                </div>
                                <div class="profile-address"><?php echo $profiledata->city; ?>, <?php echo $profiledata->state; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 border-menu">
        <div class="container">
            <div class="col-8 pl-0 left">
                <ul class="profile-nav clearfix">
                    <li><a class="a-default active" href="#profile-nav-overview">Overview</a></li>
                    <li><a class="a-default" href="#profile-nav-credentials">Credentials</a></li>
                    <li><a class="a-default" href="#profile-nav-deals">Deals</a></li>
                    <li><a class="a-default" href="#profile-nav-portfolio">Portfolio</a></li>
                    <li><a class="a-default" href="#profile-nav-reviews">Reviews</a></li>
                </ul>
            </div>
            <div class="col-4 left">
                <div class="floating-box">
                    <div class="text-center">
                        <p>Business Phone</p>
                        <p><?= $profiledata->business_phone ?></p>
                    </div>
                    <hr />
                    <div id="streetViewBody" class="col-md-6 float-left no-padding"></div>
                    <div id="map" style="height: 196px;margin-bottom: 36px;"></div>
                    <p class="bold">Contact Name</p>
                    <p><?= $profiledata->contact_name ?></p>
                    <br />
                    <p class="bold"><?= $profiledata->business_name ?></p>
                    <p><?= $profiledata->street ?></p>
                    <p><?= $profiledata->city . ' ' . $profiledata->postal_code . ' ' . $profiledata->state ?></p>
                    <br />
                    <?php if( $profiledata->website != '' ){ ?>
                    <p class="bold">Website</p>
                    <p style="font-size: 12px;"><a href="<?= $profiledata->website ?>"><?= $profiledata->website ?></a>
                    </p>
                    <br />
                    <?php } ?>
                    <p class="bold">Quick Facts</p>
                    <ul>
                        <li>Business since <?= $profiledata->year_est ?></li>
                        <li><?= $profiledata->employee_count ?> employees</li>
                    </ul>
                    <br />
                    <p class="bold">Availability</p>
                    <p>Working Days</p>
                    <p class="gray">Tue - Wed Fri - Sun</p>
                    <hr />
                    <p class="bold mb-2">Share</p>
                    <div class="social-share">
                        <?php if( $profiledata->sm_facebook != '' ){ ?>
                        <a class="share-circle share-facebook facebook-color" href="<?= $profiledata->sm_facebook ?>"
                            target="_blank"><span class="fa fa-facebook"></span></a>
                        <?php } ?>

                        <?php if( $profiledata->sm_twitter != '' ){ ?>
                        <a class="share-circle share-twitter twitter-color" href="<?= $profiledata->sm_twitter ?>"
                            target="_blank"><span class="fa fa-twitter"></span></a>
                        <?php } ?>

                        <?php if( $profiledata->sm_google != '' ){ ?>
                        <a class="share-circle share-google gmail-color" href="<?= $profiledata->sm_google ?>"
                            target="_blank"><span class="fa fa-google"></span></a>
                        <?php } ?>

                        <?php if( $profiledata->sm_pinterest != '' ){ ?>
                        <a class="share-circle share-pinterest pinterest-color" href="<?= $profiledata->sm_pinterest ?>"
                            target="_blank"><span class="fa fa-pinterest"></span></a>
                        <?php } ?>

                        <a class="share-circle share-mail email-color" href="#" target="_blank"><span
                                class="fa fa-envelope"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-8" style="margin-bottom: 52px; margin-top: 46px;">

                <!-- Services Offered -->
                <div role="white__holder_section_holder">
                    <div class="profile-service">
                        <div class="profile-service-category">
                            <div class="margin-bottom-sec">
                                <div class="profile-service-title">
                                    <h3 class="profile-subtitle">Residential Services Offered</h3>
                                </div>
                                <br />
                                <?php if($selectedCategories){ ?>
                                <?php foreach($selectedCategories as $s){ ?>
                                <span
                                    class="label label-default tag"><?= $s->service_name ?><!-- <a class="cat-tag-remove" id="cat-tag-remove-93" href="#"><span class="icon fa fa-remove"></span></a> --></span>
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-8" style="margin-bottom: 52px;">
                <!-- Business Credentials -->
                <div role="white__holder_section_holder">
                    <div class="profile-content-section" id="profile-nav-credentials">
                        <h3 class="profile-subtitle">Business Credentials</h3>
                        <div class="row mt-4">
                            <?php if($profiledata->is_show_licensed == 1): ?>
                            <div class="col-md-6 mb-5">
                                <div class="credential">
                                    <div class="credential-badge">
                                        <img src="<?= $url->assets . 'img/badge_1.png' ?>"> <span
                                            class="badge-label license">License</span>
                                    </div>
                                    <?php if( $profiledata->is_licensed == 1 ){ ?>
                                    <div class="credential-cnt">
                                        <span>State/Province : <?= $profiledata->license_state ?><br>Expires on:
                                            <b><?= date('m/d/Y', strtotime($profiledata->license_expiry_date)) ?></b></span>
                                        <span>Class : <?= $profiledata->license_class ?>,
                                            Nr:<?= $profiledata->license_number ?></span>
                                        <?php if( $profiledata->license_image != '' ){ ?>
                                        <img class="credential-img" src="<?php echo licenseImage($profiledata->id) ? licenseImage($profiledata->id) : $url->assets; ?>">
                                        <a style="color:#888;" href="<?php echo licenseImage($profiledata->id) ? licenseImage($profiledata->id) : $url->assets; ?>" target="_blank">View
                                            License</a>
                                        <?php } ?>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="credential-cnt">Not Licensed</div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profiledata->is_show_bonded == 1): ?>
                            <div class="col-md-6 mb-5">

                                <div class="credential">
                                    <div class="credential-badge">
                                        <img src="<?= $url->assets . 'img/bond-icon.png' ?>"> <span
                                            class="badge-label bond">Bond</span>
                                    </div>
                                    <?php if( $profiledata->is_bonded == 1 ){ ?>
                                    <div class="credential-cnt">
                                        <span>Insured Amount: <b>$<?= number_format($profiledata->bond_amount, 2) ?></b></span>
                                        <span>Expires on:
                                            <b><?= date('m/d/Y', strtotime($profiledata->bond_expiry_date)) ?></b></span>
                                        <?php if( $profiledata->bond_image != '' ){ ?>
                                        <img class="credential-img" src="<?php echo bondImage($profiledata->id) ? bondImage($profiledata->id) : $url->assets; ?>">
                                        <a style="color:#888;" href="<?php echo bondImage($profiledata->id) ? bondImage($profiledata->id) : $url->assets; ?>" target="_blank">View
                                            Bonded</a>
                                        <?php } ?>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="credential-cnt">Not Bonded</div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($profiledata->is_show_business_insured == 1): ?>
                            <div class="col-md-6  mb-5">

                                <div class="credential">
                                    <div class="credential-badge">
                                        <img src="<?= $url->assets . 'img/insurance-icon.png' ?>"> <span
                                            class="badge-label insurance">Insurance</span>
                                    </div>
                                    <?php if( $profiledata->is_business_insured == 1 ){ ?>
                                    <div class="credential-cnt">
                                        <span>Insured amount:
                                            <b>$<?= number_format($profiledata->insured_amount, 2) ?></b></span>
                                        <span>Expires on:
                                            <b><?= date('m/d/Y', strtotime($profiledata->insurance_expiry_date)) ?></b></span>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="credential-cnt">Not Insured</div>
                                    <?php } ?>
                                </div>
                            </div>
                            <br style="clear:both;"><br />
                            <?php endif; ?>
                            <?php if($profiledata->is_show_bbb_acredited == 1): ?>
                            <div class="col-md-6  mb-5">

                                <div class="credential">
                                    <div class="credential-badge">
                                        <img src="<?= $url->assets . 'img/accreditation-logo.png' ?>"> <span
                                            class="badge-label accreditation">Accreditation</span>
                                    </div>
                                    <?php if( $profiledata->is_bbb_accredited == 1 ){ ?>
                                    <div class="credential-cnt">
                                        <span>BBB Accredited</span>
                                        <span><a href="<?= $profiledata->bbb_link ?>" target="_blank">View BBB
                                                page</a></span>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="credential-cnt"><span>Not Accredited</span></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-6 mb-5">
                                <div class="credential">
                                    <div class="credential-badge">
                                        <div class="credential-badge-year">
                                            <img src="<?= $url->assets . 'img/since-icon.png' ?>">
                                            <div class="credential-badge-year-text">
                                                <?= $profiledata->year_est > 0 ? $profiledata->year_est : '' ?></div>
                                        </div>
                                        <span class="badge-label since">Since</span>
                                    </div>
                                    <?php if( $profiledata->year_est > 0 ){ ?>
                                    <div class="credential-cnt">
                                        <span>Business since:<b> <?= $profiledata->year_est ?></b></span>
                                        <?php
                                        $total_years = date('Y') - $profiledata->year_est;
                                        ?>
                                        <span></span>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <?php if($profiledata->is_show_links == 1): ?>
                            <div class="col-md-6  my-4">
                                <div class="credential">
                                    <div class="credential-badge">
                                        <img src="<?= $url->assets . 'img/badge_6.png' ?>"> <span
                                            class="badge-label verifications">Verifications</span>
                                    </div>
                                    <div class="credential-cnt">
                                        <div class="row credential-verification">
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_facebook? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> Facebook
                                            </div>
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_twitter? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> Twitter
                                            </div>
                                        </div>

                                        <div class="row credential-verification">
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_google? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> Google
                                            </div>
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_youtube? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> Youtube
                                            </div>
                                        </div>

                                        <div class="row credential-verification">
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_instagram? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> Instagram
                                            </div>
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_pinterest? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> Pinterest
                                            </div>
                                        </div>
                                        <div class="row credential-verification">
                                            <div class="col-md-6">
                                                <span class="<?= $profiledata->sm_linkedin? 'fa fa-check active' : 'fa fa-circle-o'?>"></span> LinkedIn
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br style="clear:both;"><br />
                            </div>
                            <?php endif; ?>
                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8" style="margin-bottom: 52px; ">
                <div class="col-sm-12 pl-0 left">
                    <h3 class="page-title pl-0 mb-2">Deals</h3>
                    <section class="content mr-23 mb-5">
                        <?php if($dealsSteals){ ?>
                        <ul class="gallery ui-sortable" id="gallery">
                            <?php foreach($dealsSteals as $ds){ ?>
                            <li class="col-image-<?= $key ?>"
                                style="width:28%;margin-right: 15px;text-align: center;height: auto;margin-bottom:38px;">
                                <div class="">
                                    <div class="img">
                                        <?php
                                        $slug = createSlug($ds->title, '-');
                                        $deal_url = url('deal/' . $slug . '/' . $ds->id);
                                        ?>
                                        <a href="<?= $deal_url ?>">
                                            <?php
                                            if ($ds->photos != '') {
                                                $deals_image = base_url('uploads/deals_steals/' . $ds->company_id . '/' . $ds->photos);
                                                if (!file_exists(FCPATH . 'uploads/deals_steals/' . $ds->company_id . '/' . $ds->photos)) {
                                                    $deals_image = base_url('assets/img/default-deals.jpg');
                                                }
                                            } else {
                                                $deals_image = base_url('assets/img/default-deals.jpg');
                                            }
                                            
                                            ?>
                                            <img class="gallery-img" src="<?= $deals_image ?>" style="width: 100%;">
                                            <div class="image-caption deals-caption">
                                                <b><?= $ds->title ?></b>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php }else{ ?>
                        <p class="profile-content-margin">No deals at this moment.</p>
                        <?php } ?>
                    </section>

                </div>
            </div>

            <div class="col-md-8" style="margin-bottom: 52px; ">
                <div class="col-sm-12 pl-0 left">
                    <h3 class="page-title pl-0 mb-2">Portfolio</h3>
                    <section class="content mr-23 mb-5">
                        <?php
                        $images = [];
                        if ($profiledata->work_images != '') {
                            $images = unserialize($profiledata->work_images);
                        }
                        ?>
                        <?php if($images){ ?>
                        <ul class="gallery ui-sortable" id="gallery">
                            <?php foreach($images as $key => $i){ ?>
                            <li class="col-image-<?= $key ?>">
                                <div class="picture-container ui-sortable-handle">
                                    <div class="img">
                                        <a href="<?= url('uploads/work_pictures/' . $profiledata->company_id . '/' . $i['file']) ?>"
                                            data-fancybox="gallery" data-caption="<?= $i['caption'] ?>">
                                            <img class="gallery-img"
                                                src="<?= url('uploads/work_pictures/' . $profiledata->company_id . '/' . $i['file']) ?>">
                                            <div class="image-caption image-caption-container-<?= $key ?>">
                                                <?= $i['caption'] ?>
                                            </div>
                                        </a>
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
</div>
<!-- include viewPath('includes/footer_pages'); ?> -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=&v=weekly"
    async></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    var geocoder;

    function initMap(address = null) {
        if (address == null) {
            address = '<?= $profiledata->street . ' ' . $profiledata->city . ' ' . $profiledata->postal_code ?>';
        }
        const myLatLng = {
            lat: -25.363,
            lng: 131.044
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            height: 220,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "",
        });
        geocoder = new google.maps.Geocoder();
        codeAddress(geocoder, map, address);
    }

    function codeAddress(geocoder, map, address) {
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                console.log(status);
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
