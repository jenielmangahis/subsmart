<?php include viewPath('v2/includes/header_customer'); ?>
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
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Notifications list.
                        </div>
                    </div>
                </div>                
                <?php if( $notifications ){ ?>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Module Name">Message</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($notifications as $notification){ ?>
                        <tr>
                            <td>
                                <b><?= $notification->notification_message; ?></b>
                                <span style="display:block; font-size: 13px;"><?= date("F d, Y g:i A", strtotime($notification->created)); ?></span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php }else{ ?>
                <div class="nsm-empty">
                    <i class="bx bx-meh-blank"></i>
                    <span>You have no notification.</span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });    
</script>
<?php include viewPath('v2/includes/footer_customer'); ?>