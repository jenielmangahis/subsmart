<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Copy/Paste the iframe or javascript code on a page on your website.</strong></div>
                            <div class="col-md-4 text-right"><a target="_blank" href="<?php echo base_url('/booking/products/' . $eid); ?>" target="_blank"><span class="fa fa-external-link fa-margin-right"></span> View Booking Page</a></div>
                        </div>  
                             
                        <hr />
                        <div class="row dashboard-container-2">
                            
                            <div class="col-md-6">
                                
                                <div class="row dashboard-container-1">
                                    <div class="col-md-12">
                                        <div style="margin-bottom: 5px;">Booking Page URL</div>
                                        <div style="margin-bottom: 10px;">
                                            <textarea style="min-height: 100px !important;" class="input-focus form-control" id="product-url" readonly=""><?php echo base_url('/booking/products/' . $eid); ?></textarea>
                                        </div>
                                        <div class="c2c">
                                            <div class="c2c-confirm hide" data-clipboard="copied" data-ref="code.pageUrl">copied</div>
                                            <a class="a-ter copy-clipboard" href="#"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                        </div>
                                    </div>
                                </div>    

                                <!-- <div class="row dashboard-container-1">
                                    <div class="col-md-12">
                                    <div style="margin-bottom: 5px;">Iframe Code</div>
                                    <div style="margin-bottom: 10px;">
                                        <textarea style="min-height: 100px !important;" class="input-focus form-control" rows="3" readonly="" id="code.iframe">&lt;iframe id="markate-widget-booking-iframe" src="https://www.nsmartrac.com/public/widget/booking/products/c47dc3fa8aa0b78a7f4e95d52b3b5450:14356:1c7836db" width="100%" height="1000" scrolling="no" frameborder="0" allowTransparency="true" style="border:none;overflow:hidden"&gt;&lt;/iframe&gt;</textarea>
                                    </div>
                                    <div class="c2c">
                                        <div class="c2c-confirm hide" data-clipboard="copied" data-ref="code.iframe">copied</div>
                                        <a class="a-ter" data-clipboard="copy" data-ref="code.iframe" href="#"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                    </div>                                        
                                    </div>
                                </div>  -->                            

                            </div>
                            <div class="col-md-6">

                                <div style="min-height: 191px !important;" class="row dashboard-container-1">
                                    <div class="col-md-12">

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

                        </div>
                        <hr />
                              
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
});
</script>