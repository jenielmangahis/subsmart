<?php include viewPath('v2/includes/header'); ?>

<style>
.select2-results__option {
    text-align: left;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    text-align: left;
}
.autocomplete-img{
  height: 50px;
  width: 50px;
}
.autocomplete-left{
  display: inline-block;
  width: 65px;
}
.autocomplete-right{
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="nsm-page">
                <div class="nsm-page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-callout primary">
                                <button><i class='bx bx-x'></i></button>
                                Schedule invoice email notification
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form id="frm-schedule-invoice" method="post" action="">
            <input type="hidden" name="invoice_id" value="<?php echo $invoice->id ?> ">
                <div class="nsm-card-content">
                    <div class="col-md-12">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-4 col">
                                    <div class="nsm-card primary h-auto">
                                        <h5>Email notification for invoice number <?= $invoice->invoice_number; ?></h5>
                                        <div class="form-group">
                                            <label for="formClient-Name">Send Date</label>
                                            <input type="text" name="email_scheduled_date" id="" class="form-control send-date">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>To</label>                                         
                                            <input type="text" value="<?= $customer->email; ?>" class="form-control" readonly="" disabled="" name="customer_email" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>BCC</label>
                                            <select class="nsm-field form-select" name="bcc[]" id="bcc-email" multiple="multiple"></select>                                                
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-3 text-end">                  
                                                <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('invoice/genview/'.$invoice->id); ?>'">Cancel</button>
                                                <button type="submit" class="nsm-button primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-8 col">
                                    <div class="nsm-card primary h-auto">
                                        <div class="form-group">
                                            <label>Message</label>                                                    
                                            <textarea id="email-body" name="email_body" class="form-control">
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
                                                                                    style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; background-color:#6a4a86; color: #ffffff; text-decoration: none; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; padding: 12px 34px; display: inline-block;" 
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
                                                    <strong><?php echo formatPhoneNumber($company->business_phone); ?></strong> <br><br>Thanks,<br><?php echo $company->business_name;  ?>
                                                </p>
                                            </textarea>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- Modal -->
<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript" src="<?php echo $url->assets ?>ckeditor/ckeditor.js"></script>
<script>
$(function(){
    CKEDITOR.replace('email-body');

    $('#frm-schedule-invoice').on('submit', function(e){
        e.preventDefault();
        var url = base_url + "invoice/_schedule_email_notification";
        
        CKEDITOR.instances['email-body'].updateElement();

        $.ajax({
            type: 'POST',
            url: url,
            data: $("#frm-schedule-invoice").serialize(),
            dataType: "json",
            success: function(o) {
                if (o.is_success == 1) {
                    Swal.fire({
                        html: "Email notification was successfully created.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.href = base_url + 'invoice/genview/' + o.invoice_id;
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: o.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            },
        });
    });

    $('.send-date').datepicker({    
        startDate: new Date(),   
        format: 'DD, MM dd, yyyy',
        autoclose: true,
    });

    $('#to-email').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#bcc-email').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }
});
</script>
