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
.toggle.android { border-radius: 0px;}
.toggle.android .toggle-handle { border-radius: 0px;}
.toggle-handle {
    background-color: #ffffff;
}
</style>
<ul class="modules-list">
    <?php foreach( $templateModules as $t ){ ?>
        <?php if( $t->industry_module_name != '' ){ ?>
        <li>
            <h3 style="font-size: 15px;margin-bottom: 0px;"><?= $t->industry_module_name; ?></h3>
            <p><?= $t->industry_module_description; ?></p>
            <hr />
            <div style="width: 100%;display: block;text-align: center;">
            <?php 
                $is_checked = 'checked';
                if( in_array($t->id, $deactivated_modules) ){
                    $is_checked = '';
                }
            ?>
            <input type="checkbox" class="b-toggle" data-id="<?= $t->id; ?>" data-cid="<?= $subscriber->id; ?>" <?= $is_checked; ?> data-toggle="toggle" data-width="200" data-on="Activated" data-off="Deactivated" data-onstyle="success" data-offstyle="danger">
            </div>
        </li>
        <?php } ?>
    <?php } ?>
</ul>
<script>
$(function(){
    $(".b-toggle").bootstrapToggle();
    $(".b-toggle").change(function(){
        var url        = base_url + 'admin/save_company_deactivated_module';
        var module_id  = $(this).attr("data-id");
        var company_id = $(this).attr("data-cid");

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
             data: {module_id:module_id, is_activated:is_activated, company_id:company_id},
             success: function(o)
             {
                /*if( o.is_success ){
                    Swal.fire({
                        title: 'Update Successful!',
                        //text: '',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href= base_url + 'admin/companies';
                        }
                    });
                    
                }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Cannot save data.',
                      text: o.msg
                    });
                }*/
             }
          });
        }, 1000);
    });
});    
</script>