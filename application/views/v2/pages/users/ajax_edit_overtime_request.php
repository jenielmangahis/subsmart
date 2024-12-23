<?php if( $is_valid == 1 ){ ?>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date From</label>
            <div class="row">
                <div class="col-sm-6">
                    <input type="date" name="request_date_from" id="" class="form-control" value="<?= date("Y-m-d",strtotime($overtimeRequest->date_from)); ?>" required>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="request_time_from" value="<?= date("g:i A",strtotime($overtimeRequest->time_from)); ?>" id="" class="nsm-field form-control timepicker" placeholder="" required>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date To</label>
            <div class="row">
                <div class="col-sm-6">
                    <input type="date" name="request_date_to" id="" class="form-control" value="<?= date("Y-m-d",strtotime($overtimeRequest->date_to)); ?>" required>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="request_time_to" value="<?= date("g:i A",strtotime($overtimeRequest->time_to)); ?>" id="" class="nsm-field form-control timepicker" placeholder="" required>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
            <textarea name="request_reason" id="request-reason" class="nsm-field form-control" style="height:200px;" required><?= $overtimeRequest->reason; ?></textarea>
        </div>                            
    </div>
<?php }else{ ?>
    <?= $err_msg; ?>
<?php } ?>
<script>
$(function(){
    $(".timepicker").datetimepicker({
        format: 'hh:mm A'
    });
    
    <?php if( $is_valid == 1 ){ ?>
        $('#footer-edit-overtime-request').show();
    <?php }else{ ?>
        $('#footer-edit-overtime-request').hide();
    <?php } ?>
});
</script>