

<?php include viewPath('accounting/estimate_one_modal'); ?>
<?php include viewPath('accounting/customer_invoice_modal'); ?>
<?php // include viewPath('accounting/customer_receive_payment_modal');?>
<?php include viewPath('accounting/customer_estimate_modal'); ?>
<?php include viewPath('accounting/customer_credit_memo_modal');?>
<?php include viewPath('accounting/customer_sales_receipt_modal'); ?>
<?php include viewPath('accounting/customer_refund_receipt_modal'); ?>
<?php include viewPath('accounting/customer_delayed_credit_modal'); ?>
<?php include viewPath('accounting/customer_delayed_charge_modal'); ?>

<!-- vendors -->
<?php include viewPath('accounting/vendor_vendor_credit_modal'); ?>
<?php include viewPath('accounting/vendor_credit_card_modal'); ?>
<?php include viewPath('accounting/vendor_print_checks_modal'); ?>
<?php include viewPath('accounting/customer_includes/receive_payment/receive_payment_modal'); ?>
<?php include viewPath('accounting/customer_includes/create_charge/create_charge'); ?>
<?php include viewPath('accounting/customer_includes/create_invoice/create_invoice_modal'); ?>
<?php include viewPath('accounting/add_new_term'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".btnAdd").click(function() {
            alert('test');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>accounting/customer_credit_memo_modal",
                success: function(returndata) {
                    // $('#myModal').modal('show');
                    //   alert('test');
                    $('.testingNi').html(returndata);

                    //  $('#myModal').html(returndata);
                    $('#addcreditmemoModal').modal('show');
                },
                dataType: "html"
            });
        });
    });
</script>