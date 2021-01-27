<h5>Setup Gmail Email</h5>
<div id="emailSetup">
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> Send To <span class="text-danger">*</span></label>
        <input type="text" name="" id="sendTo" placeholder="Please enter an email where you send it to" class="form-control required" required>
    </div>
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> CC </label>
        <input type="text" name="" id="cc" placeholder="Who you would like to cc this email" class="form-control">
    </div>
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> BCC </label>
        <input type="text" name="" id="bcc" placeholder="Who you would like to bcc this email" class="form-control">
    </div>
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> From <span class="text-danger">*</span> </label>
        <input type="text" name="" id="from" placeholder="From whom does this email come from" class="form-control required" required>
    </div>
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> From Name </label>
        <input type="text" name="" id="fromName" placeholder="" class="form-control" required>
    </div>
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> Subject <span class="text-danger">*</span> </label>
        <input type="text" name="" id="subject" placeholder="Please enter the subject for this email" class="form-control required" required>
    </div>
    <div class="form-group">
        <label><img class="float-left mr-2" src="<?php echo $url->assets . $img ?>" width="18"> Body <span class="text-danger">*</span> </label>
        <textarea id="emailBody" class="form-control required" style="height: 50px; text-left" required></textarea>
    </div>
    <div class="form-group">
        <a class="btn btn-success btn-small float-right ml-2" id="saveSetupBtn" onclick="saveSetup()" >Save Setup</a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        
        var errorCount = 0;
        
        saveSetup = function(){
            $('#emailSetup .required').each(function(){
                 if($(this).val()==""){
                     $(this).addClass('is-invalid');
                     errorCount = parseInt(errorCount) + 1;
                 }
            });
            
            if(errorCount==0)
            {
                
                $.ajax({
                    url: '<?php echo base_url(); ?>wizard_app_config/saveGmailSetup',
                    method: 'post',
                    data: { 
                        sendTo      : $('#sendTo').val(),
                        cc          : $('#cc').val(),
                        bcc         : $('#bcc').val(),
                        from        : $('#from').val(),
                        fromName    : $('#fromName').val(),
                        subject     : $('#subject').val(),
                        emailBody   : $('#emailBody').val()
                    },
                    dataType:'json',
                    success: function (response) {
                        if(response.status)
                        {
                            alert(response.msg);
                            $('#config_data').val(response.app_func_id);
                            $('#saveSetupBtn').hide();
                            $('#configSetUp').hide();
                            $('#wizEnabled').show();
                            $('#saveWizBtn').show();
                            $('#actionCheck').show(500);
                            $('#config_name').val('gmail');
                        }else{
                            alert(response.msg);
                        }
                    }
                });
            }
        };
        
        
    });

</script>