<?php if( $is_valid == 1 ){ ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Leave Type</label>
            <select class="form-control" name="leave_type" id="leave-type" required>
                <?php foreach( $leaveTypes as $lt ){ ?>
                    <option value="<?= $lt->id; ?>" <?= $leaveRequest->pto_id == $lt->id ? 'selected="selected"' : ''; ?>><?= $lt->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date From</label>
            <input type="date" name="request_date_from" id="request-date-from" class="nsm-field form-control" value="<?= $leaveRequest->date_from; ?>" placeholder="" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date To</label>
            <input type="date" name="request_date_to" id="request-date-to" class="nsm-field form-control" value="<?= $leaveRequest->date_to; ?>" placeholder="" required>
        </div>
        <div class="col-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
            <textarea name="request_reason" id="request-reason" class="nsm-field form-control" required><?= $leaveRequest->reason; ?></textarea>
        </div>                            
    </div> 
<?php }else{ ?>
    <?= $err_msg; ?>
<?php } ?>
<script>
$(function(){
    <?php if( $is_valid == 1 ){ ?>
        $('#footer-edit-leave-request').show();
    <?php }else{ ?>
        $('#footer-edit-leave-request').hide();
    <?php } ?>
});
</script>