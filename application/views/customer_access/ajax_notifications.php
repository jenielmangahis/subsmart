<div class="text-center py-3">
    <?php if( $notifications ){ ?>  
        <?php foreach($notifications as $msg){ ?>
            <div class="list-item">
                <div class="nsm-notification-item">
                    <div class="nsm-notification-content read">
                        <?php 
                            if( $msg->module == 'Messages' ){
                                $url = base_url('acs_access/messages');
                            }
                        ?>
                        <a href="<?= $url; ?>" style="text-align:left;text-decoration: none; color:#212529 !important;">
                        <span class="content-title fw-bold mb-1" >Messages</span>
                        <span class="content-subtitle"><?= $msg->notification_message; ?></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <span class="content-subtitle">No notifications for now.</span>
    <?php } ?>
</div>