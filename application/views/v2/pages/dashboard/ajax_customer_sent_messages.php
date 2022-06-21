<style>
.chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}
.chat {
    list-style: none;
    margin: 0;
    padding: 0;
}
.pull-left {
    float: left!important;
}
.img-circle {
    border-radius: 50%;
}
.chat li.left .chat-body {
    margin-left: 60px;
}
.pull-right {
    float: right!important;
}
.text-muted {
    color: #777;
}
</style>
<?php if( $sentMessages && $companySms ){ ?>
<ul class="chat" style="height:590px; overflow-x:none; overflow-y: scroll; padding:17px;">
    <?php foreach($sentMessages as $s){ ?>
        <?php if( $s['from'] == $companySms->from_number ){ ?>
            <li class="left clearfix">
                <span class="chat-img pull-left">
                    <div class="nsm-profile">
                        <span>NS</span>
                    </div>
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font"><?= $company->business_name; ?></strong> <small class="pull-right text-muted">
                        <i class='bx bxs-calendar'></i><?= timeLapsedString($s['date']); ?></small>
                    </div>
                    <p><?= $s['msg']; ?></p>
                </div>
            </li>
        <?php }else{ ?>
            <li class="right clearfix">
                <span class="chat-img pull-right">
                    <div class="nsm-profile" style="margin-left: 23px;">
                        <span><?= ucwords($companySms->first_name[0]) . ucwords($companySms->last_name[0]); ?></span>
                    </div>
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted"><i class='bx bxs-calendar'></i><?= timeLapsedString($s['date']); ?></small>
                        <strong class="pull-right primary-font"><?= $companySms->first_name . ' ' . $companySms->last_name; ?></strong>
                    </div>
                    <p style="text-align: right;padding-right: 65px;"><?= $s['msg']; ?></p>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>
<?php }else{ ?>
<div class="nsm-empty alert alert-danger">
    <span>No messages found.</span>
</div>
<?php } ?>

<div class="modal-footer">
<a class="nsm-button primary send-message" data-customer-name="<?= ucwords($customer->first_name) . ' ' . ucwords($customer->last_name) ?>" data-id="<?= $customer->prof_id; ?>" data-phone="<?= $customer->phone_m; ?>" href="javascript:void(0);">Send Message</a>
</div>
