<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style>
.custom__border .card-body>.row {
    background: none !important;
}
.custom__border .card-body>.row {
    border-bottom: 0;
    padding-bottom: 20px;
    margin-bottom: 20px;
    background: #f2f2f2;
     padding: 0px !important; 
    margin: 0;
    /* margin-bottom: 20px; */
    /* border-radius: 8px; */
}
.form-control-block {
    display: block;
    width: 100%;
    color: #363636;
    font-size: 16px;
    border-radius: 2px;
    height: 27px;
    padding: 3px 0 0 0;
    text-align: center;
}
.item-link-sm {
    font-style: italic;
    font-size: 12px;
    color: #8f8f8f;
    display: none;
}
#cke_26{
    display: none;
}
</style>
<div class="wrapper" role="wrapper">

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Send Credit Note# <?= $creditNote->credit_note_number; ?></h1>
                        <p style="margin-top: 20px;margin-bottom: 30px; font-size: 16px;">Edit the credit note email and the recipients.</p>                        
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('credit_notes') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Credit Note List
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('credit_notes/update', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <div class="card">
                    <div class="row">
                    <div class="col-lg-18 col-xl-12">
                        <div class="margin-bottom-sec">
                            <label>From:</label> <?= $client->business_name; ?>
                        </div>
                        <div class="form-group">
                            <label>To</label> <span class="help help-sm">(select or input email address)</span>
                            <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                <option></option>
                                <?php foreach($customers as $c){ ?>
                                    <option <?= $c->id == $creditNote->customer_id ? '' : 'selected="selected"'; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                <?php } ?>
                            </select>
                            <!-- <select name="to[]" id="to" class="form-control" multiple="multiple"></select> -->
                        </div>
                        <div class="form-group">
                            <div class="cc-label">
                                <label>Cc</label>
                                <select id="sel-cc-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                    <option></option>
                                    <?php foreach($customers as $c){ ?>
                                        <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                    <?php } ?>
                                </select>
                                <!-- <a class="bcc-toggle" id="bcc-toggle" href="#">+ Bcc</a> -->
                            </div>
                            <!-- <select name="cc[]" id="cc" class="form-control" multiple="multiple"></select> -->
                        </div>
                        <div class="form-group hide" id="bcc-cnt">
                            <div>
                                <label>Bcc</label>
                            </div>
                            <select id="sel-bcc-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                <option></option>
                                <?php foreach($customers as $c){ ?>
                                    <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="mail_subject" value="Credit Note from <?= $client->business_name; ?> (Credit Note#<?= $creditNote->credit_note_number; ?>)"  class="form-control" autocomplete="off" />
                        </div>
                        <div>
                            <label>Email Body</label>
                            <textarea name="mail_body" cols="40" rows="20"  class="form-control" id="mail_body" autocomplete="off">
                                <p style="font-size: 28px;">Credit Note from <?= $client->business_name; ?> (Credit Note #<?= $creditNote->credit_note_number; ?>)</p>
                                <p>Dear Bryann Revina, <br /><br />Thank you for your business! <br />Please find the attached Credit Note #<?= $creditNote->credit_note_number; ?> with this email.<br />We will apply the credit amount shown on this notice to the invoice on our next service. <br /><br /><strong>Credits: $<?= number_format($creditNote->grand_total,2); ?></strong> <br /><br />You can click the button below to view this credit note online.</p>
                                <p>&nbsp;</p>
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                <td align="center">
                                <table border="0" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                <tr>
                                <td style="-webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px;" align="center" bgcolor="#2ab363"><a style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; padding: 12px 34px; display: inline-block;" href="https://www.markate.com/public/pros/credit_note/view/685d63370ac83dc5e834ed559bfe33f9:67:735b90" target="_blank" rel="noopener"> View Credit Note Online </a></td>
                                </tr>
                                </tbody>
                                </table>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp;</p>
                                <p>If you have any questions, please call us at <strong><?= $client->phone_number; ?></strong> <br /><br />Thanks,<br /><?= $client->business_name; ?></p>

                            </textarea>
                        </div>
                    </div>
                </div>
                <hr>
                
                <div class="row">
                    <div class="col-md-4 form-group">
                        <button type="submit" class="btn btn-flat btn-primary">Send Credit Note</button>
                        <a href="<?php echo url('credit_notes') ?>" class="btn btn-danger">Cancel this</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
            <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    
        <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script src="<?php echo $url->assets ?>plugins/ckeditor/ckeditor.js"></script>

<script>
    $(function () {
        $("#sel-customer").select2({
            multiple: true,
            placeholder: "Select Email"
        });
        $("#sel-cc-customer").select2({
            multiple: true,
            placeholder: "Select Email"
        });
        $("#sel-bcc-customer").select2({
            multiple: true,
            placeholder: "Select Email"
        });
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('mail_body', {
            //removePlugins: 'toolbar',
            //allowedContent: 'p h1 h2 strong em; a[!href]; img[!src,width,height] alignment;'
        });
    });
</script>