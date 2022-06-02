<?php foreach($customerMessageReplies as $r){ ?>
    <?php 
        $li_message_type = 'messages-me';
        if( $r->prof_id > 0 ){
            $li_message_type = 'messages-you';
        }
    ?>

    <li class="<?= $li_message_type; ?> clearfix">
        <span class="message-img img-circle">
            <img src="<?= base_url('assets/img/user1-128x128.jpg') ?>" alt="User Avatar" class="avatar-sm border rounded-circle">
        </span>
        <div class="message-body clearfix">
            <div class="message-header">
                <strong class="messages-title"><?= $r->name; ?></strong> 
                <small class="time-messages text-muted">
                    <span class="fas fa-time"></span><?= date("F d, Y g:i A", strtotime($r->date_created)); ?>
                </small>
            </div>
            <p class="messages-p"><?= $r->message; ?></p>
        </div>
    </li>

<?php } ?>   