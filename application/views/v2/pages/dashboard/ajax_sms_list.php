    <style>
.nsm-messages .details{
    display: inline-block;
    width: 68%;
}
.nsm-messages .sms-date{
    display: inline-block;
    width: 30%;
    vertical-align: top;
    text-align: right;
}
.truncate-message {
  width: 345px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
<?php if( $smsMessages ){ ?>
    <table class="nsm-table" id="sms_list_table">
        <thead>
            <tr>
                <td data-name=""></td>
            </tr>
        </thead>
        <tbody>
        <?php foreach($smsMessages as $sms){ ?>
            <tr>
                <td>
                    <div class="content nsm-messages">
                        <div class="details">
                            <span class="content-title"><?= $sms['from']; ?></span>
                            <span class="content-subtitle d-block truncate-message dashboard-sms-message" data-msg="<?= $sms['msg']; ?>"><?= $sms['msg']; ?></span>
                        </div>
                        <div class="sms-date">
                            <span class="content-subtitle d-block"><?= date("F j, Y g:i A", strtotime($sms['date'])); ?></span>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php }else{ ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Message list is empty.</span>
    </div>
<?php } ?>
<script>
$(function(){
    $("#sms_list_table").nsmPagination({itemsPerPage:5});
});
</script>