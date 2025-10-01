<div class="col-12 col-md-4">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Item Details</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-md-12">
                    <div id="customer-items-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        load_customer_items();

        function load_customer_items(){
            let customer_id = '<?= $customer_profile_id; ?>';
            $.ajax({
                type: "POST",
                url: base_url + "customer/_load_item_details", 
                data: {customer_id : customer_id},
                success: function(html)
                {
                    $('#customer-items-container').html(html)
                },
                beforeSend: function(){
                    $('#customer-items-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        }
        $("#job-items-table").nsmPagination();
    });
</script>