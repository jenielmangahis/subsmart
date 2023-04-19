<?php if( $is_enable == 1 ){ ?>
<div class="row">
    <div class="col-12">
        <h3 style="margin-bottom: 22px;margin-top: 11px;">Enable <?= ucfirst($api_name); ?></h3>
        <?php if( $apiConnector ){ ?>
            <p>Click on Enable button to re-activate this add-on.</p>
        <?php }else{ ?>
            <p>Click on Enable button to activate this add-on.</p>
        <?php } ?>
    </div>    
</div>
<div class="modal-footer">
    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
    <button type="button" class="nsm-button primary btn-activate-api">Enable</button>
</div>
<?php }else{ ?>
<div class="row">
    <div class="col-12">
        <h3 style="margin-bottom: 22px;margin-top: 11px;">Disable <?= ucfirst($api_name); ?></h3>
        <p>Are you sure you want to disable this add-on?</p>
        <p>By disabling you will lose the functionality.</p>
    </div>    
</div>
<div class="modal-footer">
    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
    <button type="button" class="nsm-button primary btn-deactivate-api">Disable</button>
</div>
<?php } ?>

<script>
$(function(){
    $('.btn-activate-api').on('click', function(){
        var api_name = '<?= $api_name; ?>';
        var url = base_url + "tools/_enable_api";
        $.ajax({
            type: 'POST',
            url: url,                
            data: {api_name:api_name},
            dataType: "json",
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#enable_disable_api').modal('hide');
                    Swal.fire({
                        text: 'API was successfully enabled',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            },
        });
    });

    $('.btn-deactivate-api').on('click', function(){
        var api_name = '<?= $api_name; ?>';
        var url = base_url + "tools/_disable_api";
        $.ajax({
            type: 'POST',
            url: url,                
            data: {api_name:api_name},
            dataType: "json",
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#enable_disable_api').modal('hide');
                    Swal.fire({
                        text: 'API was successfully disabled',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            },
        });
    });
});
</script>