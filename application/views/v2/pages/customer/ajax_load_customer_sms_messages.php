<style>
.sms-message{
    display: block;
    padding: 5px 0px;
}
.sms-details{
    font-size: 11px;
}
</style>
<div class="nsm-page">
    <div class="nsm-page-content">
        <div class="row">
            <div class="col-12">                
                <table class="nsm-table" id="customer-sms-list">
                    <thead>
                        <tr><td class="SMS">Sent SMS</td></tr>
                    </thead>
                    <tbody>
                    <?php foreach($customerSentSms as $sms){ ?>
                    <tr>                
                        <td>
                            <span class="sms-message"><?= $sms->txt_message; ?></span>
                            <span class="sms-details"><i class='bx bx-mobile'></i><?= $sms->to_number; ?> / <i class='bx bxs-calendar' ></i><?= date("F j, Y g:i A", strtotime($sms->date_created)); ?></span>
                        </td>
                        
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>             
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $("#customer-sms-list").nsmPagination({itemsPerPage:5});
});
</script>