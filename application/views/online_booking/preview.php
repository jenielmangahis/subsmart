<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-20">

            <div class="row">
                <div class="col">
                  <h3 class="page-title mt-0">Online Booking</h3>
                </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Copy / Paste the iframe code on a page on your website.</span>
              </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label style="width: 100%;">
                                        Booking Page URL 
                                        <a style="float: right;" class="a-ter copy-clipboard btn btn-sm btn-primary" href="javascript:void(0);"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                    </label>                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea style="min-height: 50px !important; background-color: #bababa;" class="input-focus form-control" id="product-url" readonly=""><?php echo base_url('/booking/products/' . $eid); ?></textarea>   
                                            <br />
                                                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label style="width: 100%;">
                                        Iframe Code
                                        <a class="a-ter btn btn-sm btn-primary iframe-copy-clipboard" style="float:right;" href="javascript:void(0);"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                    </label>                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php 
                                                $url = base_url('/booking/products/' . $eid);
                                            ?>
                                            <textarea style="min-height: 200px !important; background-color: #bababa;" class="input-focus form-control" rows="3" readonly="" id="code-iframe">&lt;iframe id="markate-widget-booking-iframe" src="<?= $url; ?>" width="100%" height="1000" scrolling="no" frameborder="0" allowTransparency="true" style="border:none;overflow:hidden"&gt;&lt;/iframe&gt;</textarea>   
                                            <br />
                                                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   

                        <div class="row dashboard-container-1">
                            <div class="col-md-4">
                                <a class="btn btn-primary" href="<?php echo base_url('/booking/products/' . $eid); ?>" target="_blank"><span class="fa fa-external-link fa-margin-right"></span> View Booking Page</a>
                            </div>
                        </div>  

                                <!-- <div class="row dashboard-container-1">
                                    <div class="col-md-12">
                                        <div style="margin-bottom: 5px;">Javascript Code</div>
                                        <div style="margin-bottom: 10px;">
                                            <textarea style="min-height: 100px !important;" class="input-focus form-control" rows="3" readonly="" id="code.javascript">&lt;div id="nsmartrac-widget-booking"&gt;&lt;/div&gt;
                            &lt;script&gt;(function() { function async() {var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
                            var u = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.nsmartrac.com/public/widget/booking/js'; 
                            var t = Math.random()*10000000000000000;
                            s.src = u + '?id=c47dc3fa8aa0b78a7f4e95d52b3b5450:14356:1c7836db&amp;ref=' + encodeURIComponent(window.location.href) + '&amp;t=' + t;
                            var w = document.getElementById('nsmartrac-widget-booking'); w.parentNode.insertBefore(s, w);
                            } if (window.attachEvent) { window.attachEvent('onload', async); } else { window.addEventListener('load', async, false); }
                            })();&lt;/script&gt;</textarea>
                                        </div>
                                        <div class="c2c">
                                            <div class="c2c-confirm hide" data-clipboard="copied" data-ref="code.javascript">copied</div>
                                            <a class="a-ter" data-clipboard="copy" data-ref="code.javascript" href="#"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                        </div>
                                    </div>
                                </div> -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
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