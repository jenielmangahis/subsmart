<input type="hidden" name="tsid" value="<?= $taskStatus->status_id; ?>">
<div class="row">                                
    <div class="col-md-12 mt-3 company-select">
        <label for="">Status Name</label>
        <input type="text" name="status_text" id="status-text" value="<?= $taskStatus->status_text; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status Color</label>
        <input type="text" name="status_color" class="form-control edit-colorpicker" value="<?= $taskStatus->status_color; ?>" required="">
    </div>
</div>
<script>
$(function(){
    $('.edit-colorpicker').colorpicker({
        format: "hex",
        horizontal:true
    });
});
</script>