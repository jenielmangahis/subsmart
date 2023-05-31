<style type="text/css">
    #topnav, .footer {
        display: none;
    }
    div[role="wrapper"] {
        padding: 0;
        padding-top: 40px !important;
    }
</style>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
        <i class="bx bx-receipt"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            Edit the invoice email and the recipients.
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="wrapper" role="wrapper">
                            <div wrapper__section style="margin-left: 0px;">
                                <?php if (!empty($invoice)) : ?>
                                    <div class="custom__div">
                                        <div class="container-fluid">
                                                <h1>Send Invoice# <?php echo $invoice->invoice_number ?></h1>
                                                <p>Edit the invoice email and the recipients.</p>
                                                <hr class="margin-top margin-bottom">
                                                <form data-form="form" method="post" action="<?php echo base_url('invoice') .'/send_email' ?>">
                                                    <div class="validation-error hide"></div>
                                                    <?php if (!empty($scheduled)) : ?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Schedule Invoice</label>
                                                                <div class="help help-sm help-block">Send the invoice at a later date and time.</div>
                                                                <div class="row margin-bottom-sec">
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group mb-3">
                                                                            <input type="hidden" name="scheduled" value="<?php echo $scheduled ?>">
                                                                            <input type="text" name="email_scheduled_date" id="email_scheduled_date" class="form-control">
                                                                            <div class="input-group-append" data-for="email_scheduled_date">
                                                                                <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div data-calendar="time-start-container">
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" name="email_scheduled_time" value="7:00am" class="form-control ui-timepicker-input" id="email_scheduled_time" autocomplete="off">
                                                                                <div class="input-group-append calendar-button" data-for="email_scheduled_time">
                                                                                    <span class="input-group-text"><span class="fa fa-clock-o"></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control-text">
                                                                            Central Time                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="margin-top margin-bottom">
                                                    <?php endif; ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="margin-bottom-sec">
                                                                <label>From:</label> <?php echo $user->FName . ' ' . $user->LName ?> 
                                                                <input type="hidden" name="from_name" value="<?php echo $user->FName . ' ' . $user->LName ?>">
                                                                <input type="hidden" name="from_email" value="<?php echo $user->email ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>To</label> <span class="help help-sm">(select or input email address)</span>
                                                                <input type="hidden" name="invoice_id" value="<?php echo $invoice->id ?> ">
                                                                <select name="to[]" id="to" class="send-to-email" multiple="" tabindex="-1" aria-hidden="true">
                                                                    <option value="<?php echo get_customer_by_id($invoice->customer_id)->email ?>" selected="selected"><?php echo get_customer_by_id($invoice->customer_id)->FName.' '.get_customer_by_id($invoice->customer_id)->LName ?> (<?php echo get_customer_by_id($invoice->customer_id)->email ?>)</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="cc-label">
                                                                    <label>Cc</label>
                                                                    <a class="bcc-toggle link-modal-open" id="bcc-toggle" href="#">+ Bcc</a>
                                                                </div>
                                                                <select name="cc[]" id="to" class="send-cc-email" multiple="" tabindex="-1" aria-hidden="true">
                                                                    <option value="<?php echo get_customer_by_id($invoice->customer_id)->email ?>" selected="selected"><?php echo get_customer_by_id($invoice->customer_id)->FName.' '.get_customer_by_id($invoice->customer_id)->LName ?> (<?php echo get_customer_by_id($invoice->customer_id)->email ?>)</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="bcc-cnt" style="display: none;">
                                                                <div>
                                                                    <label>Bcc</label>
                                                                </div>
                                                                <select name="bcc[]" id="to" class="send-bcc-email" multiple="" tabindex="-1" aria-hidden="true">
                                                                    <option value="<?php echo get_customer_by_id($invoice->customer_id)->email ?>" selected="selected"><?php echo get_customer_by_id($invoice->customer_id)->FName.' '.get_customer_by_id($invoice->customer_id)->LName ?> (<?php echo get_customer_by_id($invoice->customer_id)->email ?>)</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Subject</label>
                                                                <input type="text" name="mail_subject" value="Invoice from <?php echo $user->FName . ' ' . $user->LName  ?> (Invoice #<?php echo $invoice->invoice_number ?>)" class="form-control" autocomplete="off">
                                                            </div>
                                                            <div>
                                                                <label>Email Body</label>
                                                                <textarea id="send-email" name="mail_msg" style="height:600px !important;">
                                                                <p style="font-size: 28px;" data-mce-style="font-size: 28px;">Invoice from <?php echo $user->FName . ' ' . $user->LName  ?> (Invoice #<?php echo $invoice->invoice_number ?>)</p>
                                                                <p>Dear <?php echo get_customer_by_id($invoice->customer_id)->first_name; ?>,<br></p>
                                                                <p>Thank you for your business! <br>Please find the attached invoice #<?php echo $invoice->invoice_number ?> with this email. <br><br>
                                                                    
                                                                    <strong>Amount due: $<?php echo number_format($invoice->grand_total, 2, '.', ',') ?></strong> <br><br>You can click the button below to securely pay this invoice online.
                                                                </p>
                                                                <p><br></p>
                                                                <table class="mce-item-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <table class="mce-item-table" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td bgcolor="#2ab363" align="center">
                                                                                                <a href="<?php echo base_url('invoice/pay_now_form_fr_email/' . $invoice->id) ?>" 
                                                                                                    target="_blank" 
                                                                                                    style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; padding: 12px 34px; display: inline-block;" 
                                                                                                    rel="noopener">Pay Invoice 
                                                                                                </a>
                                                                                                <br data-mce-bogus="1">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <p><br></p>
                                                                <p>If you have any questions, please call us at 
                                                                    <strong><?php echo $user->phone ?></strong> <br><br>Thanks,<br><?php echo $user->FName . ' ' . $user->LName  ?>
                                                                </p>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div>
                                                        <label>SMS notification:</label>send text to <?php echo $user->phone ?>                        
                                                    </div>
                                                    <hr class="margin-bottom">
                                                        <?php if (!empty($scheduled)) : ?>
                                                            <button class="btn btn-primary margin-right" type="submit" data-on-click-label="Sending Invoice...">Scheduled Invoice</button>
                                                        <?php else : ?>
                                                            <button class="btn btn-primary margin-right" type="submit" data-on-click-label="Sending Invoice...">Send Invoice Now</button>
                                                        <?php endif; ?>
                                                        <a class="a-ter" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">cancel this</a>
                                                </form>
                                                <!-- <div class="alert alert-danger margin-top-sec">
                                                    Can not deliver this invoice. Email and SMS notifications are turned off for this customer.
                                                </div>
                                                <a class="margin-right-sec" href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>"><span class="fa fa-pencil-square-o fa-margin-right"></span> Update customer notification options</a>
                                                or <a class="margin-left-sec" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">Return to invoice</a> -->
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#topnav').hide();
</script>
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('v2/includes/footer'); ?>
