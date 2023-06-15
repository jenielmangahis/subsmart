<style>

</style>
<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>SMS</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div id="customer-sms-messages"></div>

            <div class="col-12 col-md-4">
                <button role="button" class="nsm-button w-100 ms-0 mt-3 send-sms-message" data-customer-name="<?= ucwords($profile_info->first_name) . ' ' . ucwords($profile_info->last_name) ?>" data-id="<?= $profile_info->prof_id; ?>" data-phone="<?= $profile_info->phone_m; ?>">
                    <i class='bx bx-fw bx-send'></i> Send SMS
                </button>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    load_customer_sms_messages();
    function load_customer_sms_messages(){
        var cid = "<?= $customer_id; ?>";
        var url = "<?= base_url('customer/_load_customer_sms_messages') ?>";
        var _container = $("#customer-sms-messages");

        showLoader(_container);

        $.ajax({
            async:false,
            type: 'POST',
            url: url,
            data: {cid:cid},
            success: function(result) {
                _container.html(result);                
            },
        });
    }
});
</script>
