<style>
.list-headers{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.list-headers li{
    display: inline-block;
    width: 20%;
    margin:17px;
}
</style>
<div class="card" style="height: 300px;">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12">
            <h6>Customer List : Show table headers</h6>
            <a class="btn btn-primary pull-right btn-save-settings-customer-header" href="javascript:void(0);">Save</a>
            <form id="customer-headers">
            <ul class="list-headers">
                <?php foreach($customer_list_headers as $key => $value){ ?>
                    <li>
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="<?= $key; ?>" name="headers[<?= $key; ?>]">
                        <label class="form-check-label" for="<?= $key; ?>"><?= $value; ?></label>
                      </div>
                    </li>
                <?php } ?>
            </ul>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    $(".btn-save-settings-customer-header").click(function(){
        var url = base_url + 'customer/save_customer_headers'; 
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: $("#customer-headers").serialize(),
           success: function(o)
           {
              Swal.fire({
                  title: 'Update Successful!',
                  text: 'Your customer headers has been updated',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#32243d',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok'
              }).then((result) => {
                  
              });
           }
        });
    });
});
</script>