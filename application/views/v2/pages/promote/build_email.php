<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Build and preview the email.</div>
                    </div>
                </div>
                <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'create_email_message', 'autocomplete' => 'off']); ?>                
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-badge-dollar'></i></div>
                                        </div>
                                        <h4 class="step-title">Create Deal</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-user-circle' ></i></div>
                                        </div>
                                        <h4 class="step-title">Select Customers</h4>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-envelope'></i></div>
                                        </div>
                                        <h4 class="step-title">Build Email</h4>
                                    </div>
                                    <?php if( $dealSteals && $dealSteals->status == 0 ){ ?>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-search-alt-2'></i></div>
                                        </div>
                                        <h4 class="step-title">Preview</h4>
                                    </div>
                                    <div class="step <?= $jobs_data->status == 'Invoiced' ? 'completed' : '' ?>">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-credit-card'></i></div>
                                        </div>
                                        <h4 class="step-title">Purchase</h4>
                                    </div>
                                    <?php } ?>
                                </div>  
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="formClient-Name"><b>Subject</b></label>
                        <input type="text" class="form-control" name="email_subject" value="<?= $dealsSteals ? $dealsSteals->email_subject : ''; ?>" id="email_subject" required placeholder="" autofocus/>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="formClient-Name"><b>Body</b></label>
                        <textarea name="email_body" cols="40" rows="30"  class="form-control" id="mail_body" autocomplete="off">
                            <?php if($dealsSteals->email_body != ''){ ?>
                            <?= $dealsSteals->email_body; ?>
                            <?php }else{ ?>
                            <p style="font-size: 28px; color: #222;">Dear {{customer.name}},</p>
                            <p><br />Thank you for choosing <?= $company->business_name; ?>, we really appreciate you as our customer. <br /><br />We are currently running a promotion <strong>test</strong>. If you would like to take advantage of this limited time offer simply book the deal below. <br /><br /></p>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                            <td style="border-top: 1px solid #eaeaea; font-size: 1px; height: 1px; line-height: 1px;" height="1">&nbsp;</td>
                            </tr>
                            <tr>
                            <td height="10">&nbsp;</td>
                            </tr>
                            </tbody>
                            </table>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                            <?php 
                                if( $dealsSteals->photos != '' ){
                                    $image = base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos);
                                }else{
                                    $image = base_url('assets/img/default-deals.jpg');
                                }
                                $slug = createSlug($dealsSteals->title, '-');
                                $deal_url = base_url('deal/'.$slug.'/'.$dealsSteals->id);
                            ?>
                            <td width="150"><a href="<?= base_url("promote/deal_test/" . $dealsSteals->id); ?>"><img style="width: 200px;" src="<?= $image; ?>" alt="deal pic" /></a></td>
                            <td width="20">&nbsp;</td>
                            <td><strong><?= $dealsSteals->title; ?></strong><br /><span style="font-size: 18px; color: #ba001a;">$<?= number_format($dealsSteals->deal_price,2); ?></span> <span style="text-decoration: line-through;">was $<?= number_format($dealsSteals->original_price,2); ?></span></td>
                            </tr>
                            </tbody>
                            </table>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                            <td height="10">&nbsp;</td>
                            </tr>
                            <tr>
                            <td style="border-top: 1px solid #eaeaea; font-size: 1px; height: 1px; line-height: 1px;" height="1">&nbsp;</td>
                            </tr>
                            <tr>
                            <td height="10">&nbsp;</td>
                            </tr>
                            </tbody>
                            </table>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                            <td align="center">
                            <table border="0" cellspacing="0" cellpadding="0" align="left">
                            <tbody>
                            <tr>
                            <td style="-webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px;" align="left"><a style="background-color:#6a4a86;font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; padding: 12px 34px; display: inline-block;" href="<?= $deal_url; ?>" target="_blank" rel="noopener">View Deal</a></td>
                            </tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            <p><br /><br />Looking forward to work with you again.<br /><br />Thanks,<br /><?= $company->business_name; ?>,<br />
                                <?= $company->business_phone; ?><br /><br /><br /><br /></p>                                            
                            <?php } ?>
                        </textarea>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mt-5">
                        <a class="nsm-button margin-right btn-preview-email mt-10" href="javascript:void(0);">Preview Email</a>
                    </div>
                    <div class="col-6 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('promote/add_send_to/' . $dealsSteals->id); ?>'">« Back</button>                        
                        <?php if( $dealSteals && $dealSteals->status == 0 ){ ?>
                            <button type="submit" name="btn_save" class="nsm-button primary btn-save-send-settings">Continue »</button>
                        <?php }else{ ?>
                            <button type="submit" name="btn_save" class="nsm-button primary btn-save-send-settings">Save</button>
                        <?php } ?>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modalPreviewEmail" aria-labelledby="modalPreviewEmailLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="new_feed_modal_label">Preview Email</span>
                        <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body modal-edit-auto-sms-container"><div class="email-blast-msg"></div></div>
                    <div class="modal-footer">
                        <button name="btn_close_modal" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>plugins/ckeditor/ckeditor.js"></script>
<script>
$(function(){
    $("#create_email_message").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'promote/create_email_message',
            dataType: "json",
            data: $("#create_email_message").serialize(),
            success: function(o)
            {
                $('.btn-save-send-settings').prop("disabled", false);
                $(".btn-save-send-settings").html('Continue »');

                if( o.is_success ){                        
                    //redirect to step4
                    <?php if( $dealSteals && $dealSteals->status == 0 ){ ?>
                        location.href = base_url + "promote/preview_email_message";
                    <?php }else{ ?>
                        location.href = base_url + "promote/deals";
                    <?php } ?>
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: o.err_msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function(){
                $('.btn-save-send-settings').html('<span class="bx bx-loader bx-spin"></span>');
                $('.btn-save-send-settings').prop("disabled", true);
            }
        });
    });

    $(".btn-preview-email").click(function(){
        var email_body = CKEDITOR.instances['mail_body'].getData();
        var email_subject = $("#email_subject").val();
        $("#modalPreviewEmail").modal('show');

        var url = base_url + 'promote/_generate_preview';
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