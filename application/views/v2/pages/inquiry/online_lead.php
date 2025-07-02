<?php include viewPath('v2/includes/header'); ?>
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
.a-ter {
    color: #888;
    text-decoration: none; 
}
.text-ter {
    color: #888888;
}
.a-sec {
    color: #259e57;
}
.a-sec:hover,
.a-sec:focus {
    color: #2ab363;
    /*#2bde73;*/
    text-decoration: underline;
    outline: none;
}
.help {
    color: #858585;
}
.help-block {
    margin: 0 0 10px 0;
}

.help-sm {
    font-size: 14px;
    line-height: 18px;
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

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>

    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Place a contact form on your website and collect leads from your customers directly into Markate. Customize the way the form looks and get notifications on new contact inquiries or check the leads online. Copy/Paste the iframe or javascript code on a page on your website.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12" id="app-builder">
                        <div class="margin-bottom">
                            <div class="row margin-bottom-ter">
                                <div class="col-sm-6">
                                    <div style="margin-bottom: 5px;">Iframe Code</div>
                                    <div style="margin-bottom: 10px;">
                                        <textarea rows="3" readonly="readonly" name="iframe_code" id="code.iframe" class="input-focus form-control"><?php echo $lead_forms->iframe_code != '' ? $lead_forms->iframe_code : ''; ?></textarea>
                                    </div>
                                    <div class="c2c"><!---->
                                        <a href="#" class="a-ter">
                                        <i class='bx bx-clipboard'></i> Copy to clipboard
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
                                        <a href="#" class="a-ter"><i class='bx bx-clipboard'></i> Copy to clipboard</a>
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
                    </div>
                </div>
                <!-- end iframe -->
                <hr class="card-hr" style="margin-bottom: 0px;">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
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
                                        <a href="javascript:void(0)" id="addFormField" class="a-sec item-add-line-btn"><i class='bx bxs-add-to-queue'></i>Add form field</a>
                                        <div class="appearance margin-top">
                                            <div class="weight-medium">Form Appearance</div>
                                            <p class="help margin-bottom-sec">Change the color and size of the font.</p>

                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label class="content-subtitle mb-2">
                                                        Text Color
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" id="button-text-color" value="#276cb8" class="nsm-field form-control" required/>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label class="content-subtitle mb-2">Text Size</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="formOptions.textSize" class="formOptions-text nsm-field form-select">
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
                                            
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label class="content-subtitle mb-2">Text Font</label>
                                                </div>
                                                <div class="col-md-4">
                                                        <select name="formOptions.textFont" class="formOptions-text nsm-field form-select">
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
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label class="content-subtitle mb-2">
                                                        Button Color
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" id="button-color" value="#276cb8" class="nsm-field form-control" required/>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label class="content-subtitle mb-2">
                                                        Button Text Color
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" id="button-text-color" value="#276cb8" class="nsm-field form-control"  required/>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                    <div >
                                        <div class="weight-medium margin-bottom">Preview Form</div>
                                        <div>
                                            <div id="app" class="markate-widget-contact"><!---->
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
                                                    <button class="nsm-button primary margin-right" >Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            <?php echo form_close(); ?>

                                </div>
                            </div>
                </div>
                <!-- end of customize -->
                <hr class="card-hr" style="margin-top: 0px;">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
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
                                    <button type="submit" data-on-click-label="Saving..." class="nsm-button primary margin-right">Save Plugin Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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