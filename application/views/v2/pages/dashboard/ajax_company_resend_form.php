<div class="row">                                                                
    <div class="col-md-12 mt-3">
        <label for="">To Number</label>
        <input type="text" name="sms_to_number" value="<?= $companySms->to_number; ?>" id="resend-to-number" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Message</label>
        <textarea class="form-control" name="sms_txt_message" id="resend-sms-txt" style="height:150px;"><?= $companySms->txt_message; ?></textarea>                                    
    </div>
    <div class="help help-sm margin-bottom-sec">
        message characters: <span class="margin-right-sec resend-char-counter">0</span>
        left characters: <span class="margin-right-sec resend-char-counter-left">0</span>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#resend-to-number").inputmask({"mask": "(999) 999-9999"});
});
function smsResendCharCounter(){
    var chars_max   = 250;
    var chars_total = $("#resend-sms-txt").val().length;
    var chars_left  = chars_max - chars_total;

    $('.resend-char-counter').html(chars_total);
    $(".resend-char-counter-left").html(chars_left);

    return chars_left;
}

$("#resend-sms-txt").keydown(function(e){
    var chars_left = smsCharCounter();
    if( chars_left <= 0 ){
        if (e.keyCode != 46 && e.keyCode != 8 ) return false;
    }else{
        return true;
    }
});

smsResendCharCounter();
</script>