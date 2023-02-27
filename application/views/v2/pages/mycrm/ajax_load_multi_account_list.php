<style>
.list-multi-accounts{
    list-style: none;
    padding: 0px;
}
.list-multi-accounts li{
    display: block;
    width: 100%;
}
.multi-info-container{
    display: inline-block;
    width: 60%;
    height: 59px;
}
.multi-action-container{
    display: inline-block;
    width: 39%;
    height: 59px;
    vertical-align: middle;
    text-align: right;
}
.multi-company-name{
    font-size: 14px;
    display: block;
    font-weight: bold;
}
.multi-email-status{
    font-size: 13px;
}
.badge-warning {
    color: #212529;
    background-color: #ffc107;
}
</style>
<ul class="list-multi-accounts">
    <?php foreach($multiAccounts as $m){ ?>
        <li>
            <div class="multi-info-container">
                <span class="multi-company-name"><?= $m->company_name; ?></span>
                <span class="multi-email-status">
                    <?= $m->user_email; ?>
                    <?php if( $m->status == $status_verified ){ ?>
                        <span class="badge badge-primary"><?= $m->status; ?></span>
                    <?php }else{ ?>
                        <span class="badge badge-warning"><?= $m->status; ?></span>
                    <?php } ?>
                </span>
            </div>
            <div class="multi-action-container">
                <!-- <a class="nsm-button btn-sm btn-resend-activation" href="javascript:void(0);" data-userid="<?= $m->link_user_id; ?>" data-email="<?= $m->user_email; ?>"><i class='bx bx-mail-send' ></i> Resend Activation</a> -->
                <a class="nsm-button btn-sm btn-delete-multi-account" data-companyname="<?= $m->company_name; ?>" data-id="<?= $m->id; ?>" href="javascript:void(0);"><i class='bx bx-trash' ></i> Delete</a>                
            </div>
        </li>
    <?php } ?>
</ul>