<div class="mt-4 mb-4" id="img-payment-methods"></div>
<script>
$(function(){
    load_customer_payment_method_images();
    function load_customer_payment_method_images(){
        let customer_id = "<?= $cus_id; ?>";
        let url = base_url + 'customer/_payment_method_images';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                customer_id: customer_id
            },
            success: function(html) {
                $('#img-payment-methods').html(html);
            },
            beforeSend: function(){
                $('#img-payment-methods').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }
});
</script>