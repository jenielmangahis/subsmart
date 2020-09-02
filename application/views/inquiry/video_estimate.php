<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inquiries'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card">
            <div class="container-fluid">
                <h1 class="heading-beta">Virtual Video Estimate<span>Beta</span></h1>
                <p class="margin-bottom">
                    Offer contactless Video estimates for your Clients. Replace in-home estimates with the convenience of Virtual Video Estimate. The client simply has to let you know they would like a contactless estimate and you can schedule a time to look at the Job, while video chatting the client so they can walk us through any work to be done. All estimates are paperless and sent via Markate.
                </p>
                <div id="app-builder">
                    <div class="margin-bottom">
                        <div class="text-ter margin-bottom-sec">Code will be available after you configure the widget.</div> 
                        <div class="row margin-bottom-ter"><div class="col-sm-6"><div style="margin-bottom: 5px;">Iframe Code</div> 
                        <div style="margin-bottom: 10px;">
                            <textarea rows="3" readonly="readonly" id="code.iframe" class="input-focus form-control"></textarea>
                        </div> 
                        <div class="c2c"><!----> 
                            <a href="#" class="a-ter"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div style="margin-bottom: 5px;">Javascript Code</div> 
                        <div style="margin-bottom: 10px;">
                            <textarea rows="3" readonly="readonly" id="code.javascript" class="input-focus form-control"></textarea>
                        </div> 
                        <div class="c2c"><!---->
                            <a href="#" class="a-ter"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-3">
                        <div style="margin-bottom: 5px;"> Contact Page URL</div> 
                        <div style="margin-bottom: 10px;">
                            <textarea rows="1" readonly="readonly" id="code.pageUrl" class="input-focus form-control"></textarea>
                        </div> 
                        <div class="c2c"><!----> 
                            <a href="#" class="a-ter"><span class="fa fa-clipboard fa-margin-right"></span> Copy to clipboard</a>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="text-ter" style="margin-top: 36px;"> (share the Page URL with your customers or social sites)</div>
                    </div>
                </div>
            </div> 
            <hr class="card-hr" style="margin-bottom: 0px;"> 
            <div id="validationError" class="validation-error" style="display: none;"><p></p></div> 
            
            <div class="row">
                <div class="col-sm-6 margin-top">
                    <div class="weight-medium">Customize Form Fields</div> 
                    <p class="help">Select the fields that will be part of the form and add custom ones.</p> 
                    <div class="fields-list-header">
                        <div class="row">
                            <div class="col-sm-6">Field</div> 
                            <div class="col-sm-3">Visible</div> 
                            <div class="col-sm-3">Required</div>
                        </div>
                    </div> 
                    <ul class="fields-list">
                        <li>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="fields-list__name-cnt">
                                        <div class="fields-list__sortable_handle">
                                            <span class="fa fa-ellipsis-v"></span> 
                                            <span class="fa fa-ellipsis-v"></span>
                                        </div> 
                                        <div class="fields-list__name">Name</div>
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
                        <li>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="fields-list__name-cnt">
                                        <div class="fields-list__sortable_handle">
                                            <span class="fa fa-ellipsis-v"></span> 
                                            <span class="fa fa-ellipsis-v"></span>
                                        </div> 
                                        <div class="fields-list__name">Phone</div>
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
                        <li>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="fields-list__name-cnt">
                                        <div class="fields-list__sortable_handle">
                                            <span class="fa fa-ellipsis-v"></span> 
                                            <span class="fa fa-ellipsis-v"></span>
                                        </div> 
                                        <div class="fields-list__name">Email</div>
                                    </div>
                                </div> 
                                <div class="col-sm-3">
                                    <div class="checkbox checkbox-sec no-margin">
                                        <input type="checkbox" id="email_visible" true-value="1"> 
                                        <label for="email_visible"></label>
                                    </div>
                                </div> 
                                <div class="col-sm-3">
                                    <div class="fields-list__col-last">
                                        <div class="checkbox checkbox-sec no-margin">
                                            <input type="checkbox" id="email_required" true-value="1"> 
                                            <label for="email_required"></label>
                                        </div> <!---->
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="fields-list__name-cnt">
                                        <div class="fields-list__sortable_handle">
                                            <span class="fa fa-ellipsis-v"></span> 
                                            <span class="fa fa-ellipsis-v"></span>
                                        </div> 
                                        <div class="fields-list__name">Message</div>
                                    </div>
                                </div> 
                                <div class="col-sm-3">
                                    <div class="checkbox checkbox-sec no-margin">
                                        <input type="checkbox" id="message_visible" true-value="1"> 
                                        <label for="message_visible"></label>
                                    </div>
                                </div> 
                                <div class="col-sm-3">
                                    <div class="fields-list__col-last">
                                        <div class="checkbox checkbox-sec no-margin">
                                            <input type="checkbox" id="message_required" true-value="1"> 
                                            <label for="message_required"></label>
                                        </div> <!---->
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul> 
                    <a href="#" class="a-sec item-add-line-btn">
                        <span class="fa fa-plus-square fa-margin-right"></span>Add form field
                    </a> <!----> 
                    <div class="appearance margin-top">
                        <div class="weight-medium">Form Appearance</div> 
                        <p class="help margin-bottom-sec">Change the color and size of the font.</p> 
                        <div class="form-group row">
                            <label class="col-sm-6 weight-normal form-control-text">Text Color</label> 
                            <div class="col-sm-18">
                                <div class="form-inline" style="position: relative; z-index: 3;">
                                    <div class="col-sm-5 pl-0 pr-5">
                                        <input id="button-text-color" class="form-control" value='#276cb8' />
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-6 weight-normal form-control-text">Text Size</label> 
                            <div class="col-sm-18">
                                <div class="form-inline">
                                    <select name="formOptions.textSize" class="form-control formOptions-text">
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
                                    <select name="formOptions.textFont" class="form-control formOptions-text">
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
                                        <input id="button-color" class="form-control" value='#276cb8' />
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-6 weight-normal form-control-text">Button Text Color</label> 
                            <div class="col-sm-18">
                                <div class="form-inline" style="position: relative; z-index: 1;">
                                    <div class="col-sm-5 pl-0 pr-5">
                                        <input id="button-text-color" class="form-control" value='#276cb8' />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-6">
                    <div style="padding: 40px; border: 0px solid rgb(221, 221, 221); background: rgb(242, 242, 242) none repeat scroll 0% 0%; min-height: 900px;">
                        <div class="weight-medium margin-bottom">Preview Form</div> 
                        <div style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 30px;">
                            <div id="app" class="markate-widget-estimate" style="color: rgb(34, 34, 34); font-size: 16px; font-family: &quot;roboto&quot;, Arial, Helvetica, sans-serif;"><!----> 
                                <form name="widget-estimate" method="post">
                                    <div class="form-group">
                                        <label>Name</label><span class="form-required">*</span> 
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label> <span class="form-required">*</span> 
                                        <input type="tel" class="form-control">
                                    </div><!----><!---->
                                </form> 
                                <hr class="card-hr"> 
                                <div class="widget-estimate-submit">
                                    <button class="btn btn-primary margin-right" style="background-color: rgb(42, 179, 99); color: rgb(255, 255, 255);">Start Video Chat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <hr class="card-hr" style="margin-top: 0px;"> 
            <div class="row">
                <div class="col-sm-6">
                    <div class="weight-medium">Video Call Meeting URLs</div> 
                    <div class="help margin-bottom-sec">The customer will click on one of the URLs below to initiate a call with you.</div> 
                    <div class="form-group">
                        <label class="weight-normal">Facebook Video URL</label> 
                        <div class="help help-sm help-block">(sample url: https://www.facebook.com/videocall/incall/?peer_id=123)</div> 
                        <input type="text" name="url_facebook" value="" autocomplete="off" class="form-control"></div> 
                        <div class="form-group">
                            <label class="weight-normal">Google Meet URL</label> 
                            <div class="help help-sm help-block">(sample url: https://meet.google.com/abc-def)</div> 
                            <input type="text" name="url_google" value="" autocomplete="off" class="form-control">
                        </div> 
                        <div>
                            <label class="weight-normal">Skype URL</label> 
                            <span class="help help-sm help-block">(sample url: https://join.skype.com/invite/abcd)</span> 
                            <input type="text" name="url_skype" value="" autocomplete="off" class="form-control">
                        </div>
                    </div>
                </div> 
                <hr class="card-hr"> 
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Confirmation Page Instructions</label> 
                            <div class="help help-block">
                                Input a text with some help or instruction.
                            </div> 
                            <textarea name="page_confirm_available" rows="3" class="form-control"></textarea>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Not Available Message</label> 
                            <div class="help help-block">
                                Input a text to display when the widget is inactive or not in contact time.
                            </div> 
                            <textarea name="page_confirm_not_available" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="weight-medium">Notifications</div> 
                            <div class="help margin-bottom-sec">Select how you want to be notified on a new inquiry.</div> 
                            <div class="checkbox checkbox-sec margin-right">
                                <input type="checkbox" id="config.notify_email" true-value="1">
                                <label for="config.notify_email"> Email</label>
                            </div> 
                            <div class="checkbox checkbox-sec">
                                <input type="checkbox" id="config.notify_push" true-value="1">
                                <label for="config.notify_push"> App Notification</label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                        <label>Widget Status</label> 
                        <div class="help margin-bottom-sec">Switch the widget off while you are on vacation.</div> 
                        <select name="status" class="form-control">
                            <option value="1">Active</option> 
                            <option value="2">Inactive</option>
                        </select>
                    </div> 
                    <div class="col-sm-12"></div>
                </div>
            </div>
        </div>
    </div> 
    <hr class="card-hr"> 
    <button data-on-click-label="Saving..." class="btn btn-primary margin-right">Save Plugin Settings</button>
</div>

    </div>
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
