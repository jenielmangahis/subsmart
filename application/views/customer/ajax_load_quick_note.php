<div class="form-group">                                                  
    <div class="row">
        <div class="col-sm-8">
            <label for="" style="width:100%;text-align: left;">Subject</label>
            <input type="text" class="form-control" name="message_subject" id="message-subject" value="<?= $quickNote->subject; ?>">
        </div>
        <div class="col-sm-4">
            <label for="" style="width:66%;text-align: left;display: inline-block;">Use Quick Note</label>
            <a class="btn btn-sm  btn-primary" href="<?= base_url('quick_notes/add_new'); ?>" style="font-size: 12px;display: inline-block;margin-bottom: 5px;">Add Quick Note</a>
            <select class="form-control" name="use_quick_notes" id="use-quick-note">
                <option value="">-Select Quick Note-</option>
                <?php foreach($quickNotes as $qn){ ?>
                    <option <?= $quickNote->id == $qn->id ? 'selected="selected"' : ''; ?> value="<?= $qn->id; ?>"><?= $qn->subject; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>                                           
    <div class="form-group">
        <label for="" style="width:100%;text-align: left;">Message</label>
        <div class="row g-3">
            <div class="col-sm-12">
            <textarea class="form-control" name="message_body" id="editor-qn" style="height: 200px;"><?= $quickNote->message; ?></textarea>
            </div>
        </div>
    </div>
</div> 
<script>
$(function(){
    CKEDITOR.replace('editor-qn');
});
</script>