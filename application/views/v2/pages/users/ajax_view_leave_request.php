<?php if( $is_valid == 1 ){ ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Leave Type</label>
            <input type="text" class="nsm-field form-control" value="<?= $leaveRequest->leave_type; ?>" readonly="" disabled="" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
            <?php 
                $status = 'Pending';
                if( $leaveRequest->status == 2 ){
                    $status = "Approved";
                }elseif( $leaveRequest->status == 3 ){
                    $status = "Disapproved";
                }
            ?>
            <input type="text" class="nsm-field form-control" value="<?= $status; ?>" readonly="" disabled="" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date From</label>
            <input type="date" class="nsm-field form-control" value="<?= $leaveRequest->date_from; ?>" readonly="" disabled="">
        </div>
        <div class="col-md-6 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Date To</label>
            <input type="date" class="nsm-field form-control" value="<?= $leaveRequest->date_to; ?>" readonly="" disabled="">
        </div>
        <div class="col-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
            <textarea class="nsm-field form-control" readonly="" disabled=""><?= $leaveRequest->reason; ?></textarea>
        </div>  
        <?php if( $leaveRequest->status == 3 ){ ?>                          
            <div class="col-12 mb-3">
            <label class="content-subtitle fw-bold d-block mb-2">Disapproved Reason</label>
            <textarea class="nsm-field form-control" readonly="" disabled=""><?= $leaveRequest->disapproved_reason; ?></textarea>
        </div>  
        <?php } ?>
    </div> 
<?php }else{ ?>
    <?= $err_msg; ?>
<?php } ?>