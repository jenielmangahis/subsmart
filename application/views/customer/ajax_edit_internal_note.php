<div class="form-group">
  <label for="" style="width:100%;text-align: left;"><i class="fa fa-calendar"></i> Date</label>
  <div class="row g-3">
    <div class="col-sm-8">
      <input type="text" name="note_date" value="<?= date('m/d/Y', strtotime($internalNote->note_date)); ?>" class="form-control edit-note-datepicker note-date field-popover" placeholder="Date" aria-label="Date" data-trigger="hover" data-original-title="When" data-container="body" data-placement="right" autocomplete="off" data-content="">
    </div>
  </div>
</div>  
<div class="form-group">
    <label for="" style="width:100%;text-align: left;"><i class="fa fa-list"></i> Note</label>
    <div class="row g-3">
        <div class="col-sm-12">
        <textarea class="form-control" name="interal_notes" id="ckedit-note" style="height: 200px;"><?= $internalNote->notes; ?></textarea>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.edit-note-datepicker').datepicker({
        //format: 'yyyy-mm-dd',
        format: 'mm/dd/yyyy',
        autoclose: true,
    });

    CKEDITOR.replace('ckedit-note');
});
</script>