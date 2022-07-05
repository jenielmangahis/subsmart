<span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Module Status that will trigger auto sms notification">
<select name="module_status" id="module-status" class="form-control" required="">
    <?php foreach($moduleStatus as $key => $status){ ?>
        <option value="<?= $key; ?>"><?= $status; ?></option>
    <?php } ?>    
</select>
</span>
<script>
$(function(){
    $('.auto-sms-popover').popover({
        trigger:"hover"
    });
});
</script>