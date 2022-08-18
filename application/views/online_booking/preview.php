<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
<style>
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.row-category, .row-category a{
    background-color: #32243d;
    color: #ffffff;
}
.a-ter {
    color: #888;
}
textarea{
    margin-top: 10px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Copy / Paste the iframe code on a page on your website.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-12">
                            <div class="nsm-card">
                                <div class="nsm-card-content">
                                    <div class="form-group">
                                        <label style="width: 100%;">
                                            Booking Page URL 
                                            <a style="float: right;" class="a-ter copy-clipboard nsm-button primary" href="javascript:void(0);"><i class='bx bx-copy' ></i> Copy to clipboard</a>
                                        </label>                                    
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea style="min-height: 50px !important;" class="input-focus form-control" id="product-url" readonly=""><?php echo base_url('/booking/products/' . $eid); ?></textarea>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end booking page url card -->
                    <div class="col-lg-6">
                        <div class="col-12">
                            <div class="nsm-card">
                                <div class="nsm-card-content">
                                    <div class="form-group">
                                        <label style="width: 100%;">
                                            Iframe Code
                                            <a class="a-ter nsm-button primary iframe-copy-clipboard" style="float:right;" href="javascript:void(0);"><i class='bx bx-copy' ></i> Copy to clipboard</a>
                                        </label>                                    
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $url = base_url('/booking/products/' . $eid);
                                                ?>
                                                <textarea style="min-height: 200px !important;" class="input-focus form-control" rows="3" readonly="" id="code-iframe">&lt;iframe id="markate-widget-booking-iframe" src="<?= $url; ?>" width="100%" height="1000" scrolling="no" frameborder="0" allowTransparency="true" style="border:none;overflow:hidden"&gt;&lt;/iframe&gt;</textarea>   
                                                <br />
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end i frame card -->
                </div>
                <!-- end first row -->
                <div class="row dashboard-container-1">
                    <div class="col-md-4">
                        <a class="nsm-button primary" href="<?php echo base_url('/booking/products/' . $eid); ?>" target="_blank"><i class='bx bx-link-external'></i> View Booking Page</a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

<?php //include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".copy-clipboard").click(function(){
      var copyText = document.getElementById("product-url");
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      document.execCommand("copy");
    });

    $(".iframe-copy-clipboard").click(function(){
      var copyText = document.getElementById("code-iframe");
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      document.execCommand("copy");
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
