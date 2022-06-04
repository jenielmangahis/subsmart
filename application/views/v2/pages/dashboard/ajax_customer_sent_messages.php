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
<?php if( $sentMessages ){ ?>
<ul class="chat">
    <?php foreach($sentMessages as $s){ ?>
        <?php if( $s->sender_type == 'customer' ){ ?>
            <li class="left clearfix">
                <span class="chat-img pull-left">
                    <div class="nsm-profile">
                        <span><?= ucwords($s->first_name[0]) . ucwords($s->last_name[0]); ?></span>
                    </div>
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font"><?= $s->first_name . ' ' . $s->last_name; ?></strong> <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-time"></span><?= timeLapsedString($s->date_created); ?></small>
                    </div>
                    <p><?= $s->txt_message; ?></p>
                </div>
            </li>
        <?php }else{ ?>
            <li class="right clearfix">
                <span class="chat-img pull-right">
                    <div class="nsm-profile" style="margin:21px;">
                        <span><?= ucwords($s->FName[0]) . ucwords($s->LName[0]); ?></span>
                    </div>
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?= timeLapsedString($s->date_created); ?></small>
                        <strong class="pull-right primary-font"><?= $s->FName . ' ' . $s->LName; ?></strong>
                    </div>
                    <p><?= $s->txt_message; ?></p>
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
