<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.tabs-menu {
    margin-bottom: 20px;
    padding: 0;
    margin-top: 20px;
}
.tabs-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.tabs-menu .active, .tabs-menu .active a {
    color: #2ab363;
}
.tabs-menu li {
    float: left;
    margin: 0;
    padding: 0px 83px 0px 0px;
    font-weight: 600;
    font-size: 17px;
}
.group-tags .btn{
    display: inline-block;
    width: auto;
    margin: 5px;
    padding: 5px 10px;
}
.modal-tags-list li{
    margin-bottom: : 30px;
}
.tags-group-name{
    background-color: #32243D;
    color : #ffffff;
    padding: 10px !important;
    margin-top: 20px;
    margin-bottom: 10px;
}
.phone {
    display: inline-block;
    background: url(<?php echo base_url() ?>/assets/img/sms_preview_phone.png) no-repeat 0 0;
    width: 350px;
    height: 530px;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.tabs-menu {
    margin-bottom: 20px;
    padding: 0;
    margin-top: 20px;
}
.tabs-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.md-right {
  float: right;
  width: max-content;
  display: block;
  padding-right: 0px;
}
.phone__cnt {
    margin: 190px 65px 0 50px;
}
.sms-blast-msg {
    background: #e5e5ea;
    border-radius: 20px;
    padding: 15px;
    margin-bottom: 10px;
    text-align: left;
    position: relative;
}
.sms-blast-msg:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 20%;
    width: 0;
    height: 0;
    border: 20px solid transparent;
    border-right-color: #e5e5ea;
    border-left: 0;
    border-bottom: 0;
    margin-top: -5px;
    margin-left: -10px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'create_email_blast', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Email Blast</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('email_campaigns') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Email Blast list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Build and preview the email.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Create Campaign</li>
                                  <li>2. Select Customers</li>
                                  <li class="active">3. Build Email</li>
                                  <li>4. Preview</li>
                                  <li>5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Subject</label>
                                        <input type="text" class="form-control" name="email_subject" value="<?= $emailCampaign ? $emailCampaign->email_subject : ''; ?>" id="email_subject" required placeholder="" autofocus/>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Email Body</label>
                                        <textarea name="email_body" cols="40" rows="30"  class="form-control" id="mail_body" autocomplete="off">
                                          <?php if($emailCampaign->email_body != ''){ ?>
                                            <?= $emailCampaign->email_body; ?>
                                          <?php }else{ ?>
                                            <h2>Dear {{customer.first_name}},</h2>
                                            <br />
                                            <p>Sample email content.</p>
                                            <br />
                                            <p>Thanks,</p>
                                            <p><?= $company->business_name; ?></p>
                                            <p><?= $company->phone_number; ?></p>
                                          <?php } ?>
                                        </textarea>
                                    </div>
                                  </div>
                                  
                              </div>
                              <div class="col-md-6">
                                  <div class="panel-info">
                                      <label>Personalize your email with Smart Tags</label>
                                      <p class="margin-bottom">Click to select and insert smart tags in the content which will dynamically be replaced with the appropriate data.</p>
                                      <div>
                                          <a class="btn btn-default btn-insert-smart-tags" href="javascript:void(0);">Insert Smart Tags</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <hr>
                          <div class="row margin-top">
                              <div class="col-sm-6">
                                  <a class="btn btn-default margin-right btn-preview-email" href="javascript:void(0);">Preview Email</a>
                              </div>
                              <div class="col-sm-6 text-right">
                                  <a class="btn btn-default margin-right" href="<?php echo url('sms_campaigns/add_campaign_send_to/'); ?>" style="margin-right: 10px;">&laquo; Back</a>
                                  <button class="btn btn-primary btn-create-email-msg" type="submit">Continue &raquo;</button>
                              </div>
                          </div>

                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>

            <div class="modal fade" id="modalSmartTags" tabindex="-1" role="dialog" aria-labelledby="modalSmartTagsTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Insert Smart Tags</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 0px 30px;">
                        <ul class="modal-tags-list" data-tags-modal="list">
                            <li>
                                <div class="text-ter weight-medium tags-group-name">Customer</div>
                                <div class="group-tags">
                                    <a class="btn btn-default btn-stag" data-id="customer.name">Full Name</a>
                                    <a class="btn btn-default btn-stag" data-id="customer.first_name">First Name</a>
                                    <a class="btn btn-default btn-stag" data-id="customer.last_name">Last Name</a>
                                    <a class="btn btn-default btn-stag" data-id="customer.phone">Phone</a>
                                </div>
                            </li>
                            <li>
                                <div class="text-ter weight-medium tags-group-name">Business</div>
                                <div class="group-tags">
                                    <a class="btn btn-default btn-stag" data-id="business.name">Name</a>
                                    <a class="btn btn-default btn-stag" data-id="business.email">Email</a>
                                    <a class="btn btn-default btn-stag" data-id="business.phone">Phone</a>
                                </div>
                            </li>
                            <li>
                                <div class="text-ter weight-medium tags-group-name">Other</div>
                                <div class="group-tags">
                                    <a class="btn btn-default btn-stag" data-id="estimate.custom_number">Estimate Number (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="estimate.date_added_text">Estimate Date  (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="estimate.total_text">Estimate Amount (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="invoice.custom_number">Invoice Number (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="invoice.date_issued_text">Invoice Date Issued (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="invoice.total_text">Invoice Amount (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="event.date_start_text">Job Date (last)</a>
                                </div>
                            </li>
                        </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPreviewEmail" tabindex="-1" role="dialog" aria-labelledby="modalPreviewEmailTitle" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document" style="margin-top:5%;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Preview Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 0px 30px;">
                        <div class="email-blast-msg"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>plugins/ckeditor/ckeditor.js"></script>
<script>
$(function(){
    $(".btn-insert-smart-tags").click(function(){
        $("#modalSmartTags").modal('show');
    });

    $(".btn-stag").click(function(){
        var sms_message = $("#sms-txt").val();
        var tag = "{{" + $(this).attr("data-id") + "}}";

        CKEDITOR.instances['mail_body'].insertHtml(tag);
        $("#modalSmartTags").modal("hide");
    });

    $("#create_email_blast").submit(function(e){
        e.preventDefault();
        var url = base_url + 'email_campaigns/create_email_message';
        $(".btn-create-email-msg").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_email_blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "email_campaigns/preview_email_message";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                    $(".btn-create-email-msg").html('Continue »');
                }
             }
          });
        }, 1000);
    });

    $(".btn-preview-email").click(function(){
        var email_body = CKEDITOR.instances['mail_body'].getData();
        var email_subject = $("#email_subject").val();
        $("#modalPreviewEmail").modal('show');

        var url = base_url + 'email_campaigns/_generate_preview';
        $(".email-blast-msg").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {email_body:email_body, email_subject:email_subject},
             success: function(o)
             {
                $(".email-blast-msg").html(o);
             }
          });
        }, 1000);

    });

    // instance, using default configuration.
    CKEDITOR.replace('mail_body', {
        height: '400'
        //removePlugins: 'toolbar',
        //allowedContent: 'p h1 h2 strong em; a[!href]; img[!src,width,height] alignment;'
    });

    CKEDITOR.config.allowedContent = true;
});
</script>
