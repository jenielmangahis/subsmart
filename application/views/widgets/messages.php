<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header">
            <i class="fa fa-envelope" aria-hidden="true"></i> Messages
        </div>
        <div class="card-body" style="padding:5px 10px;">
            <div style="<?= $height; ?> overflow-y: scroll" id="messagesBody">
                <div class="col-lg-12" id="msgs_body">
                    <div class="progress" style="height:40px;"><div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">System is fetching data</div></div>
                </div>
            </div>
            <div class="text-center">
                <a class="text-info" href="<?= base_url() ?>">SEE ALL MESSAGES</a>
            </div>

        </div>

    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        
        fetchSMS();
        
    });
    
        fetchSMS = function () {
            var num = $('#inputMobile').val();
            var msg = $('#inputText').val();

            $.ajax({
                url: '<?php echo base_url(); ?>ring_central/fetchSMS',
                method: 'GET',
                data: {to:num, message:msg},
                //dataType:'json',
                statusCode: {
                    500: function(xhr) {
                      $('#msgs_body').html(xhr.responseText)
                    }
                  },
                success: function (response) {
                    alert(response);
                    $('#createSMS').modal("hide");
                }
            });
        };
</script>    
