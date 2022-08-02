<style>
.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 800px;
    overflow-y: scroll
}

.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}
</style>
<main class="content">
    <div class="container p-0">
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <?php if( $customerMessages ){ ?>
                                <?php foreach($customerMessages as $msg){ ?>
                                    <?php 
                                        $message_position = 'chat-message-left'; //Customer
                                        $default_profile_image = base_url('assets/img/default-customer.png');
                                        $chat_user_name   = $msg->first_name . ' ' . $msg->last_name;
                                        $box_msg_css      = 'ml-3';
                                        if( $msg->user_id > 0 ){ //User
                                            $message_position = 'chat-message-right';
                                            $default_profile_image = businessProfileImage($business->id);
                                            $chat_user_name = $business->business_name;
                                            $box_msg_css      = 'mr-3';
                                        }

                                    ?>

                                    <div class="<?= $message_position; ?> pb-4">
                                        <div>
                                            <img src="<?= $default_profile_image; ?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2"><?= timeLapsedString($msg->message_date); ?></div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 <?= $box_msg_css; ?>">
                                            <div class="font-weight-bold mb-1"><b><?= $chat_user_name; ?></b></div>
                                            <?= $msg->message; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="nsm-empty">
                                    <i class="bx bx-meh-blank"></i>
                                    <span>You have no messages.</span>
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                    
                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">             
                                <input type="hidden" name="profid" id="prof-id" value="<?= $profid; ?>">               
                                <input type="text" class="form-control" name="customer_message" id="customer-message" required="" placeholder="Type your message">
                                <button class="nsm-button primary btn-send-message" type="submit" style="margin-bottom:0px;">Send</button>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>