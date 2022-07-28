<table class="nsm-table">
    <tr>
        <td>Company Name</td>        
        <td><?= $cronAutoSms->business_name; ?></td>
    </tr>
    <tr>
        <td>Send Condition</td>        
        <td>
            Send auto sms notification if <b><?= ucfirst(str_replace("_", " ", $cronAutoSms->module_name)) ?></b> having status <br /> <b><?= ucfirst($cronAutoSms->module_status); ?></b>
        </td>
    </tr>
    <tr>
        <td>Mobile Number</td>        
        <td><?= $cronAutoSms->mobile_number; ?></td>
    </tr>
    <tr>
        <td>Is Sent</td>        
        <td>
            <?php if($cronAutoSms->is_sent == 1) { ?>
                <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;width: 20%;">Yes</span>
            <?php }else{ ?>
                <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;width: 20%;">No</span>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>Error Message</td>        
        <td><?= $cronAutoSms->err_msg; ?></td>
    </tr>
</table>