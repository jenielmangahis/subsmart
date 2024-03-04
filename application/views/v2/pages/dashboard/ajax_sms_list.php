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
.dashboard-sms-message:hover{
    cursor: pointer;
}
.sms-from{
    font-weight:bold;
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
                <td class="dashboard-sms-message" data-from="<?= $sms['from']; ?>" data-msg="<?= $sms['msg']; ?>">
                    <div class="content nsm-messages">
                        <div class="details">
                            <span class="content-title"><?= $sms['from']; ?></span>
                            <span class="content-subtitle d-block truncate-message"><?= $sms['msg']; ?></span>
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

<div class="modal fade nsm-modal fade" id="quick-view-sms" tabindex="-1" aria-labelledby="quick-view-sms_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick-view-sms_label"><i class='bx bx-message-dots'></i> SMS Message</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mt-2">
                        <label class="mb-3 sms-from"></label>
                        <label class="mb-2 sms-message"></label>                                               
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $("#sms_list_table").nsmPagination({itemsPerPage:5});
    $('.dashboard-sms-message').on('click', function(){
        var sms_message = $(this).attr('data-msg');
        var sms_from    = $(this).attr('data-from');

        $('.sms-from').html("<i class='bx bx-mobile' ></i>" + sms_from);
        $('.sms-message').html(sms_message);

        $('#quick-view-sms').modal('show');
    });
});
</script>