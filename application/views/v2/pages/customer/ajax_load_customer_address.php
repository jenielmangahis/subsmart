<style>
.address-list{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.address-list li{
    margin-right: 0px;
    vertical-align: top;
    display: inline-block;
}
.address-label{
    display: inline-block;
}
</style>
<div class="mt-3" style="background-color: #416FA6;color: #ffffff;padding: 6px;">
    <input type="hidden" id="m-customer-prof" value="<?= $customer->prof_id; ?>">
<label class="content-title" style="cursor: pointer">
    <ul class="address-list">
        <li><span class="address-label" style="width:165px;"><i class="bx bxs-map-pin"></i> Customer Address :</span></li>  
        <li><input type="text" class="nsm-field form-control" id="m-customer-address" value="<?= $customer->mail_add; ?>" placeholder="Address" /></li>
        <li><input type="text" class="nsm-field form-control" id="m-customer-city" style="width:105px" value="<?= $customer->city; ?>" placeholder="City" /></li>
        <li><input type="text" class="nsm-field form-control" id="m-customer-state" style="width:105px" value="<?= $customer->state; ?>" placeholder="State" /></li>
        <li><input type="text" class="nsm-field form-control" id="m-customer-zip" style="width:105px" value="<?= $customer->zip_code; ?>" placeholder="ZIP" /></li>        
    </ul>    
</label>
<label class="content-title" style="cursor: pointer;margin-bottom: 4px;margin-top: 5px;">
    <span class="address-label" style="width:165px;"><i class="bx bxs-phone"></i> Contact Number : </span>
    <input type="text" style="display:inline-block;width: 20%;width:178px;" id="m-customer-mobile" class="nsm-field form-control" value="<?= $customer->phone_m != '' ? $customer->phone_m : '---'; ?>" />
    <button type="button" class="nsm-button btn-update-customer-info" style="display:inline-block;background-color: #ffffff;margin:0px;">
        <i class='bx bxs-user-check' style="position: relative;top:2px;line-height: 0px;"></i> Update
    </button>
</label>
</div>
<script>
$(function(){
    $('.btn-update-customer-info').click(function(){
        var isLoading = false;
        var url = "<?= base_url('customer/_update_address_mobile'); ?>";

        var cus_address = $('#m-customer-address').val();
        var cus_city    = $('#m-customer-city').val();
        var cus_state   = $('#m-customer-state').val();
        var cus_zip     = $('#m-customer-zip').val();
        var cus_mobile  = $('#m-customer-mobile').val();
        var cus_prof    =  $('#m-customer-prof').val();
        if (!isLoading) {
            $.ajax({
                type: 'POST',
                url: url,
                dataType:'json',
                data: {cus_prof:cus_prof,cus_address:cus_address,cus_city:cus_city,cus_state:cus_state,cus_zip:cus_zip,cus_mobile:cus_mobile},
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({                    
                            text: 'Update Successful!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot find customer',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } 

                    sLoading = false;           
                },
            });
        }
    });
});
</script>
