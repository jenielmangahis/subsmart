<input type="hidden" name="smstid" value="<?php echo $smsTemplate->id; ?>">
<div class="row">                                                                
    <div class="col-md-12 mt-3">
        <label for="">Template Name</label>
        <input type="text" class="nsm-field form-control" name="title" id="title" value="<?= $smsTemplate->title; ?>" required/>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Template Type</label>
        <select class="form-control" data-style="btn-white" name="type_id" required>
            <?php foreach($option_template_types as $key => $value){ ?>
                <option <?= $smsTemplate->type_id == $key ? 'selected="selected"' : ''; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>                                    
        </select>
    </div>                                    
    <div class="col-md-12 mt-3">
        <label for="">Details</label>   
        <select class="form-control" data-style="btn-white" name="details" required>
            <?php foreach($option_details as $key => $value){ ?>
                <option <?= $smsTemplate->details == $key ? 'selected="selected"' : ''; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">SMS</label>
        <textarea id="summernote" class="nsm-field form-control" name="sms_body" style="width:100%; height: 100px;" required><?= $smsTemplate->sms_body; ?></textarea>
    </div>  
</div>