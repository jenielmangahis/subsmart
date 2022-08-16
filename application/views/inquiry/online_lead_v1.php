<style>
.bottom-txt {
    width: 100%;
    position: absolute;
    bottom: 20px;
    color: #36c12a;
    text-align: center;
    right: 0px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 30px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
    position: relative;
    left: 13px;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
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
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div class="container-fluid pl-0 pr-0">
                            <h3 class="page-title">Lead Contact Form</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                              <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Place a contact form on your website and collect leads from your customers directly into Markate. Customize the way the form looks and get notifications on new contact inquiries or check the leads online. Copy/Paste the iframe or javascript code on a page on your website.</span>
                              </div>
                            </div>
                            <div id="app-builder">
                            <?php echo form_open('/inquiries/save_online_lead_form', ['method' => 'POST', 'autocomplete' => 'off']); ?>
                                <div class="margin-bottom">
                                    <div class="row margin-bottom-ter">
                                        <div class="col-sm-6">
                                            <div style="margin-bottom: 5px;">
                                                Iframe Code
                                            </div>
                                            <div style="margin-bottom: 10px;">
                                                <textarea rows="3" readonly="readonly" name="iframe_code" id="code.iframe" class="input-focus form-control"><?php echo $lead_forms->iframe_code; ?></textarea>
                                            </div>
                                            <div class="c2c"><!---->
                                                <a href="#" class="a-ter">
                                                    <span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="margin-bottom: 5px;">
                                                Javascript Code
                                            </div>
                                            <div style="margin-bottom: 10px;">
                                                <textarea rows="3" readonly="readonly" name="javascript_code" id="code.javascript" class="input-focus form-control"><?php echo $lead_forms->javascript_code; ?></textarea>
                                            </div>
                                            <div class="c2c"><!---->
                                                <a href="#" class="a-ter"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div style="margin-bottom: 5px;">Contact Page URL</div>
                                            <div style="margin-bottom: 10px;">
                                                <textarea rows="1" readonly="readonly" name="contact_page_url" id="code.pageUrl" class="input-focus form-control"><?php echo $lead_forms->contact_page_url; ?></textarea>
                                            </div>
                                            <div class="c2c"><!---->
                                                <a href="#" class="a-ter"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-ter" style="margin-top: 36px;">
                                                (share the Contact Page URL with your customers or social sites)
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="card-hr" style="margin-bottom: 0px;">

                                <div id="validationError" class="validation-error" style="display: none;">
                                    <p></p>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 margin-top">
                                        <div class="weight-medium">Customize Form Fields</div>
                                        <p class="help">Select the fields that will be part of the form and required ones.</p>
                                        <div class="fields-list-header">
                                            <div class="row">
                                                <div class="col-sm-6">Field</div>
                                                <div class="col-sm-3">Visible</div>
                                                <div class="col-sm-3">Required</div>
                                            </div>
                                        </div>
                                        <ul id="customFieldList" class="fields-list">
                                            <?php foreach($customize_lead_forms_default as $form) : ?>
                                                <?php if ($form->field == "Name" || $form->field == "Phone") : ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="fields-list__name-cnt">
                                                                    <div class="fields-list__sortable_handle">
                                                                        <span class="fa fa-ellipsis-v"></span>
                                                                        <span class="fa fa-ellipsis-v"></span>
                                                                    </div>
                                                                    <div class="fields-list__name"><?php echo $form->field; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <span class="fa fa-check form-checked"></span>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="fields-list__col-last">
                                                                    <span class="fa fa-check form-checked"></span> <!---->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php else : ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="fields-list__name-cnt">
                                                                    <div class="fields-list__sortable_handle">
                                                                        <span class="fa fa-ellipsis-v"></span>
                                                                        <span class="fa fa-ellipsis-v"></span>
                                                                    </div>
                                                                    <div class="fields-list__name"><?php echo $form->field; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="checkbox checkbox-sec no-margin">
                                                                    <input type="checkbox" id="<?php echo "visible" . $form->field; ?>" data-name="<?php echo $form->field; ?>" data-type="visible" data-prefix="pf" <?php echo ($form->visible) ? 'checked' : '' ; ?> true-value="1">
                                                                    <label for="<?php echo "visible" . $form->field; ?>"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="fields-list__col-last">
                                                                    <div class="checkbox checkbox-sec no-margin">
                                                                        <input type="checkbox" id="<?php echo "required" . $form->field; ?>" data-name="<?php echo $form->field; ?>" data-type="required" data-prefix="pf_req" <?php echo ($form->required) ? 'checked' : '' ; ?> true-value="1">
                                                                        <label for="<?php echo "required" . $form->field; ?>"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php foreach($customize_lead_forms as $form) : ?>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="fields-list__name-cnt">
                                                                <div class="fields-list__sortable_handle">
                                                                    <span class="fa fa-ellipsis-v"></span>
                                                                    <span class="fa fa-ellipsis-v"></span>
                                                                </div>
                                                                <div class="fields-list__name"><?php echo $form->field; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="checkbox checkbox-sec no-margin">
                                                                <input type="checkbox" id="<?php echo "visible" . substr(str_replace(' ', '', $form->field), 0, 8); ?>" data-name="<?php echo substr(str_replace(' ', '', $form->field), 0, 8); ?>" data-type="visible" data-prefix="pf" <?php echo ($form->visible) ? 'checked' : '' ; ?> true-value="1">
                                                                <label for="<?php echo "visible" . substr(str_replace(' ', '', $form->field), 0, 8); ?>"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="fields-list__col-last">
                                                                <div class="checkbox checkbox-sec no-margin">
                                                                    <input type="checkbox" id="<?php echo "required" . substr(str_replace(' ', '', $form->field), 0, 8); ?>" data-name="<?php echo substr(str_replace(' ', '', $form->field), 0, 8); ?>" data-type="required" data-prefix="pf_req" <?php echo ($form->required) ? 'checked' : '' ; ?> true-value="1">
                                                                    <label for="<?php echo "required" . substr(str_replace(' ', '', $form->field), 0, 8); ?>"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <a href="javascript:void(0)" id="addFormField" class="a-sec item-add-line-btn"><span class="fa fa-plus-square fa-margin-right"></span>Add form field</a>
                                        <!---->
                                        <div class="appearance margin-top">
                                            <div class="weight-medium">Appearance</div>
                                            <p class="help margin-bottom-sec">Change the color and size of the font.</p>
                                            <div class="form-group row">
                                                <label class="col-sm-6 weight-normal form-control-text">Text Color</label>
                                            <div class="col-sm-5 pl-0 pr-5">
                                                <input id="color-picker" name="text_color" class="form-control" value='<?php echo $lead_forms->text_color; ?>' />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 weight-normal form-control-text">Text Size</label>
                                            <div class="col-sm-18">
                                                <div class="form-inline">
                                                    <select name="options.textSize" name="text_size" class="form-control options-text">
                                                        <option selected value="<?php echo $lead_forms->text_size; ?>"><?php echo $lead_forms->text_size; ?> px</option>
                                                        <option value="10">10 px</option>
                                                        <option value="11">11 px</option>
                                                        <option value="12">12 px</option>
                                                        <option value="13">13 px</option>
                                                        <option value="14">14 px</option>
                                                        <option value="15">15 px</option>
                                                        <option value="16">16 px</option>
                                                        <option value="17">17 px</option>
                                                        <option value="18">18 px</option>
                                                        <option value="19">19 px</option>
                                                        <option value="20">20 px</option>
                                                        <option value="21">21 px</option>
                                                        <option value="22">22 px</option>
                                                        <option value="23">23 px</option>
                                                        <option value="24">24 px</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 weight-normal form-control-text">Text Font</label>
                                            <div class="col-sm-18">
                                                <div class="form-inline">
                                                    <select name="options.textFont" name="text_font" class="form-control options-text">
                                                        <option selected value="<?php echo $lead_forms->text_font; ?>"><?php echo $lead_forms->text_font; ?></option>
                                                        <option value="roboto">Roboto</option>
                                                        <option value="Open Sans">Open Sans</option>
                                                        <option value="Lato">Lato</option>
                                                        <option value="Montserrat">Montserrat</option>
                                                        <option value="PT Serif">PT serif</option>
                                                        <option value="Ubuntu">Ubuntu</option>
                                                        <option value="Heebo">Heebo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 weight-normal form-control-text">Button Color</label>
                                            <div class="col-sm-18">
                                                <div class="form-inline" style="position: relative; z-index: 2;">
                                                    <div class="col-sm-5 pl-0 pr-5">
                                                        <input id="button-color" name="button_color" class="form-control" value='<?php echo $lead_forms->button_color; ?>' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 weight-normal form-control-text">Button Text Color</label>
                                            <div class="col-sm-18">
                                                <div class="form-inline" style="position: relative; z-index: 1;">
                                                    <div class="col-sm-5 pl-0 pr-5">
                                                        <input id="button-text-color" name="button_text_color" class="form-control" value='<?php echo $lead_forms->button_text_color; ?>' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="weight-medium">Notifications</div>
                                        <div class="help margin-bottom-sec">Select how you want to be notified on a new inquiry.</div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="email_notification" id="options.notify.email" <?php echo ($lead_forms->email_notification) ? 'checked' : '' ; ?> true-value="1">
                                            <label for="options.notify.email"> Email</label>
                                        </div>
                                        <div class="checkbox checkbox-sec">
                                            <input type="checkbox" name="app_notification" id="options.notify.push" true-value="1">
                                            <label for="options.notify.push"> App Notification</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="weight-medium">Google Analytics</div>
                                    <div class="help help-block margin-bottom-sec">
                                        Optionally you can enable Google Analytics for this widget.
                                    </div>
                                    <div class="form-group">
                                        <label class="weight-normal">Google Analytics Tracking Id</label>
                                        <div class="help help-block">
                                            The unique id set on your Google tracking code. e.g. UA-12345-1
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="google_analytics_tracking_id" value="" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="weight-normal">Website URL</label>
                                        <div class="help help-block">
                                            Your website URL where the widget is placed.
                                        </div>
                                        <input type="text" name="google_analytics_origin" value="" autocomplete="off" class="form-control">
                                    </div>
                                    <hr class="card-hr">
                                    <button type="submit" data-on-click-label="Saving..." class="btn btn-primary margin-right">Save Plugin Settings</button>
                                </div>
                                <div class="col-sm-6">
                                    <div style="padding: 40px; border: 0px solid rgb(221, 221, 221); background: rgb(242, 242, 242) none repeat scroll 0% 0%; min-height: 1100px;">
                                        <div class="weight-medium margin-bottom">Preview Form</div>
                                        <div style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 30px;">
                                            <div id="app" class="markate-widget-contact" style="color: rgb(34, 34, 34); font-size: 16px; font-family: &quot;roboto&quot;, Arial, Helvetica, sans-serif;"><!---->
                                                <form name="widget-contact" method="post">
                                                    <?php foreach($customize_lead_forms_default as $form) : ?>
                                                            <div id="<?php echo 'pf'.$form->field; ?>" class="form-group">
                                                                <label><?php echo $form->field; ?></label>
                                                                <span id="<?php echo 'pf_req'.$form->field; ?>" class="form-required">*</span>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                    <?php endforeach; ?>
                                                    <?php foreach($customize_lead_forms as $form) : ?>
                                                        <div id="<?php echo 'pf' . substr(str_replace(' ', '', $form->field), 0, 8); ?>" class="form-group">
                                                            <label><?php echo $form->field; ?></label>
                                                            <span id="<?php echo 'pf_req' . substr(str_replace(' ', '', $form->field), 0, 8); ?>" class="form-required">*</span>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </form>
                                                <hr class="card-hr">
                                                <div class="widget-contact-submit">
                                                    <button class="btn btn-primary margin-right" style="background-color: rgb(42, 179, 99); color: rgb(255, 255, 255);">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({

        columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        }],
        select: {
            'style': 'multi'
        },
        order: [[1, 'asc']],
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

</script>
