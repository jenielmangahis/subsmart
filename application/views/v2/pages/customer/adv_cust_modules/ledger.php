<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Ledger</span>
            </div>
        </div>
        <div class="nsm-card-content" id="widget-ledger">
            
        </div>
    </div>
</div>
<script>
$(function(){
    customerLedger();
    function customerLedger(){
        var customer_id = "<?= $cus_id; ?>";
        $.ajax({
            type: "POST",
            url: base_url + "customer/_ledger",
            data: {customer_id:customer_id},
            success: function(result)
            {
                $('#widget-ledger').html(result);
            },
            beforeSend: function() {
                $('#widget-ledger').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }
});
</script>