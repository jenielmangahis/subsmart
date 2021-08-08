<style>
.modules-list{
    list-style: none;
}
.modules-list li{
    display: inline-block;
    width: 30%;
    background-color: #DDDDDD;
    margin: 8px;
    padding: 10px;
    box-shadow: 10px 5px 8px #888888;
}
.toggle-off.btn {
    padding-left: 2.5rem !important;
}
.toggle-on.btn {
    padding-right: 2.5rem !important;
}
.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem !important; }
.toggle.ios .toggle-handle { border-radius: 20rem !important; }
</style>
<div style="height: 600px; overflow: auto; width: 100%;">
<ul class="modules-list">
    <?php foreach( $templateModules as $t ){ ?>
        <?php if( $t->industry_module_name != '' ){ ?>
        <li>
            <h3 style="font-size: 15px;margin-bottom: 0px;"><?= $t->industry_module_name; ?></h3>
            <p><?= $t->industry_module_description; ?></p>
            <hr />
            <div style="width: 100%;display: block;text-align: center;">
            <input type="checkbox" class="b-toggle" data-id="<?= $t->id; ?>" checked data-toggle="toggle" data-width="250" data-on="Activated" data-off="Deactivated" data-onstyle="success" data-offstyle="danger" data-style="ios">
            </div>
        </li>
        <?php } ?>
    <?php } ?>
</ul>
</div> 
<script>
$(function(){
    $(".b-toggle").bootstrapToggle();
    $(".b-toggle").change(function(){
        var module_id = $(this).attr("data-id");
        alert(module_id);
        if ($(this).is(':checked')) {
            var is_activated = 1;
        }else{
            var is_activated = 0;
        }

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#payment-sms-blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    Swal.fire({
                        title: 'Update Successful!',
                        text: 'SMS Campaign was successfully activated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href= base_url + 'sms_campaigns/payment_details';
                        }
                    });
                    
                }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Cannot activate campaign.',
                      text: o.msg
                    });
                }

                $(".btn-sms-purchase").html('Purchase');
             }
          });
        }, 1000);
    });
});    
</script>