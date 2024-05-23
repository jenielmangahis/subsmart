<style>
.hdr-multi-company-name {
    display: inline-block;
    vertical-align: top;
    line-height: 23px;
    margin-left: 7px;
    height: 35px;
    width: 74%;
} 
</style>
<?php $is_main = 1; ?>
<?php if( $multiAccounts ){ ?>
    <ul id="hdr-list-multi-accounts" class="mt-3">
        <?php if( $loggedMultiAccount['multi_account_parent_company_id'] > 0 ){ ?>
            <?php 
                $fields = ['id', 'business_name'];
                $cid    = $loggedMultiAccount['multi_account_parent_company_id'];                    
                $hdrCompanyData     = getCompanyData($cid, $fields);
            ?>
            <li>
                <a href="javascript:void(0);" class="hdr-multi-account-switch-back">
                    <div class="hdr-multi-company-img" style="background-image: url('<?= businessProfileImage($hdrCompanyData->id); ?>')"></div>
                    <span class="hdr-multi-company-name">Switch Back to <b><?= $hdrCompanyData->business_name; ?></b></span>
                </a>
            </li>
            <?php $is_main = 0; ?>
        <?php } ?>
        <?php foreach($multiAccounts as $account){ ?>
            <li>
                <a href="javascript:void(0);" data-hash="<?= $account->hash_id; ?>" class="hdr-multi-account">                    
                    <div class="hdr-multi-company-img" style="background-image: url('<?= businessProfileImageByCompanyId($account->link_company_id); ?>')"></div>
                    <span class="hdr-multi-company-name"><?= $account->company_name; ?></span>
                </a>
            </li>
        <?php } ?>   
        <?php if( $is_main == 1 ){ ?>
            <li>
                <a class="nsm-button default" id="btn-quick-link-account" href="javascript:void(0);"><i class='bx bx-plus-circle'></i> Link Account</a>
            </li>     
        <?php } ?>
    </ul>
<?php }else{ ?>
    <?php if( $loggedMultiAccount['multi_account_parent_company_id'] > 0 ){ ?>
        <ul id="hdr-list-multi-accounts" class="mt-3">
            <?php 
                $fields = ['id', 'business_name'];
                $cid    = $loggedMultiAccount['multi_account_parent_company_id'];                    
                $hdrCompanyData     = getCompanyData($cid, $fields);
            ?>
            <li>
                <a href="javascript:void(0);" class="hdr-multi-account-switch-back">
                    <div class="hdr-multi-company-img" style="background-image: url('<?= businessProfileImage($hdrCompanyData->id); ?>')"></div>
                    <span class="hdr-multi-company-name">Switch Back to <b><?= $hdrCompanyData->business_name; ?></b></span>
                </a>
            </li>
            <?php $is_main = 0; ?>
            <?php if( $is_main == 1 ){ ?>
                <li>
                    <a class="nsm-button default" id="btn-quick-link-account" href="javascript:void(0);"><i class='bx bx-plus-circle'></i> Link Account</a>
                </li>     
            <?php } ?>
        </ul>
    <?php }else{ ?>
        <div class="alert alert-primary" role="alert" style="margin-top:18px;background-color:#dad1e0 !important;">
            No link accounts found. To setup your link accounts, go to <a style="display: inline;" href="<?= base_url('users/businessview#link-accounts'); ?>"><b>Business view</b></a>
        </div>
    <?php } ?>    
<?php } ?>
<?php include viewPath('v2/includes/mycrm/quick_link_company'); ?>
<script>
$(function(){
    $('#btn-quick-link-account').on('click', function(){
        var url = "<?php echo base_url('mycrm/_check_max_link_account'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function(result) {
                if( result.is_limit == 1 ){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }else{
                    $('#sidebar-modal-add-multi-account').modal({backdrop: false});
                    $('#sidebar-modal-add-multi-account').modal('show');
                }
            }
        });
    });

    $('.hdr-multi-account').on('click', function(){
        var hashid = $(this).attr('data-hash');
        var url = base_url + "mycrm/_login_multi_account";

        $('#hdr_multi_account_loading_modal').modal('show');
        $('#hdr_multi_account_loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Switching account...');

        setTimeout(function () {
            $.ajax({
                type: 'POST',
                url: url,
                data: {hashid: hashid},
                dataType: 'json',
                beforeSend: function(data) {
                    
                },
                success: function(data) {
                    $('#hdr_multi_account_loading_modal').modal('hide');
                    $('#hdr_multi_account_loading_modal .modal-body').html('');

                    if( data.is_valid == 1 ){
                        location.href = '<?= base_url('dashboard'); ?>';
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }, 800);        
    });

    $('.hdr-multi-account-switch-back').on('click', function(){
        var url = base_url + "mycrm/_login_main_multi_account";

        $('#hdr_multi_account_loading_modal').modal('show');
        $('#hdr_multi_account_loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Switching to main account...');

        setTimeout(function () {
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                beforeSend: function(data) {
                    
                },
                success: function(data) {
                    $('#hdr_multi_account_loading_modal').modal('hide');
                    $('#hdr_multi_account_loading_modal .modal-body').html('');

                    if( data.is_valid == 1 ){
                        location.href = '<?= base_url('dashboard'); ?>';
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }, 800); 
    });
});
</script>