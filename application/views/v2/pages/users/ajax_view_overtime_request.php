<?php if( $is_valid == 1 ){ ?>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date From</label>
            <div class="row">
                <div class="col-sm-6">
                    <input type="date" name="request_date_from" id="" class="form-control" value="<?= date("Y-m-d",strtotime($overtimeRequest->date_from)); ?>" disabled="" readonly="">
                </div>
                <div class="col-sm-6">
                    <input type="time" name="request_time_from" value="<?= date("H:i:s",strtotime($overtimeRequest->time_from)); ?>" id="" class="nsm-field form-control" placeholder="" disabled="" readonly="">
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date To</label>
            <div class="row">
                <div class="col-sm-6">
                    <input type="date" name="request_date_to" id="" class="form-control" value="<?= date("Y-m-d",strtotime($overtimeRequest->date_to)); ?>" disabled="" readonly="">
                </div>
                <div class="col-sm-6">
                    <input type="time" name="request_time_to" value="<?= date("H:i:s",strtotime($overtimeRequest->time_to)); ?>" id="" class="nsm-field form-control" placeholder="" disabled="" readonly="">
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
            <?php 
                    $status = 'Pending';
                    if( $overtimeRequest->status == 2 ){
                        $status = 'Approved';
                    }elseif( $overtimeRequest->status == 3 ){
                        $status = 'Disapproved';
                    } 
                ?>
                <input type="text" name="status" id="" class="form-control" value="<?= $status; ?>" disabled="" readonly="">
        </div>
        <div class="col-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
            <textarea name="request_reason" id="request-reason" class="nsm-field form-control" style="height:100px;" disabled="" readonly=""><?= $overtimeRequest->reason; ?></textarea>
        </div>          
        <?php if( $overtimeRequest->status == 3 ){ ?>                  
        <div class="col-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Disapproved Reason</label>
            <textarea name="request_reason" id="request-reason" class="nsm-field form-control" style="height:100px;" disabled="" readonly=""><?= $overtimeRequest->disapproved_reason; ?></textarea>
        </div>     
        <?php } ?>
    </div>
<?php }else{ ?>
    <?= $err_msg; ?>
<?php } ?>