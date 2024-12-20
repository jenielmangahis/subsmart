<div class="col-12 col-md-8">
    <div class="nsm-card primary">
        <div class="nsm-card-header"><b><i class="bx bx-fw bxs-share" style="position:relative;top:1px;"></i> Share Login Page</b></div>
        <div class="nsm-card-content">
            <h6 class="card-subtitle mb-2 text-body-secondary">Allow existing clients to log into your client hub by adding the following URL to your website.</h6>
            <div class="row">
                <?php 
                    $customer_unique_id = hashids_encrypt($cus_id, '', 45);
                    $public_url = base_url('/client_hub/' . $customer_unique_id . "?source=share");
                ?>
                <div class="input-group rounded">
                    <button class="input-group-text border-0 copy-customer-public-url" id="copy-customer-public-url" onClick="javascript:copyCustomerPublicUrl();" style="background-color: #6a4a86; color: #ffffff;"><strong>COPY URL</strong></button>    
                    <input type="text" class="form-control rounded customer-public-url" id="customer-public-url" placeholder="" disabled value="<?php echo $public_url; ?>" >
                </div>            
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $(document).on('click', '.copy-customer-public-url', function(){
        const copyUrl = $("#customer-public-url").val();
        navigator.clipboard.writeText(copyUrl).then(() => {
            alert('url copied');
        }).catch(() => {
            alert('error copying url');
        })
    });
});
</script>

