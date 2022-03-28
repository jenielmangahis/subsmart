<div class="form-group" style="margin-bottom:22px !important;">  
<div class="row"> 
    <div class="col-5">
        <label for="" style="width:100%;text-align: left;">To</label>
        <input type="text" class="form-control" name="receiver_email" id="receiver-email" value="<?= $customer->email; ?>" readonl="" disabled="">
    </div>       
    <div class="col-5">
        <label for="" style="width:100%;text-align: left;">Subject</label>
        <input type="text" class="form-control" name="message_subject" id="message-subject" value="Welcome to nSmarTrac">
    </div>       
</div>
</div> 
<div class="form-group">   
    <div class="col-12">
        <label for="" style="width:100%;text-align: left;">Message</label>
        <textarea class="form-control" name="message_body" id="editor-body" style="height: 200px;">
            <p>Hi <?= $customer->first_name ?>,</p>

            <p>Welcome to <b>nSmarTrac</b> – we’re excited to have you on board and we’d love to say thank you on behalf of our whole company for chosing us.</p>

            <p>Have any questions or need more information? Just shoot us an email! We’re always here to help. Feel free to hit us up on Facebook (link) or Twitter (link), if you want a fast response, too.</p>
            <Br />
            Take care,
            nSmarTrac Team

        </textarea>
    </div>       
</div>     
<script>
$(function(){
    CKEDITOR.replace('editor-body');
});
</script>