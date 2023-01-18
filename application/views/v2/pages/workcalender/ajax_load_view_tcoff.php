<style>
.font-15{
    font-size: 15px;
}
.appointment-view-header{
    background-color: #6A4A86;
    padding: 10px;
    color: #ffffff;
    font-size: 14px;
}
.task-details{
    display: block;
    min-height: 100px;
    max-height: 300px;
    overflow: auto;
    background-color: #cccccc;
    padding: 10px;
    width: 100%;
}
</style>
<?php if ($technicianScheduleOff) { ?>    
    <?php 
        $technicians_ids = explode(",", $technicianScheduleOff->technician_user_ids);
        $tech_names  = array();        
        $users = $this->Users_model->getAllByIds($technicians_ids);
        $createdBy    = $this->Users_model->getUser($technicianScheduleOff->user_id);
        $taskAssigned = $this->Users_model->getUser($technicianScheduleOff->task_to_user_id);
        foreach( $users as $u ){
            $tech_names[] = $u->FName . ' ' . $u->LName;            
        }
    ?>
    <div class="col-12 col-md-12">
        <label class="content-subtitle fw-bold d-block mb-2" style="font-size:20px;">
            Schedule Off - <?= implode(", ", $tech_names); ?> 
        </label>
    </div>
    <div class="col-12 col-md-12">
        <label class="content-subtitle d-block mb-2 font-15" style="margin-bottom: 5px;">
            <span class="fw-bold"><i class='bx bxs-calendar'></i> Leave Date : </span> 
            <?= date("F j ", strtotime($technicianScheduleOff->leave_start_date)); ?> to <?= date("F j, Y", strtotime($technicianScheduleOff->leave_end_date)); ?> 
        </label>        
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header mt-3">Task Details</label>
            <div class="d-flex">
            <span class="task-details"><?= $technicianScheduleOff->task_details; ?></span>
        </div>
        <?php if( $taskAssigned->FName != '' ){ ?>
            <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Task Assigned : <?= $taskAssigned->FName . ' ' . $taskAssigned->LName; ?></label>
        <?php } ?>
        
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Created By : <?= $createdBy->FName . ' ' . $createdBy->LName; ?></label>
    </div>
    <hr />
<?php } else { ?>
    <div class="col-12">
        <div class="nsm-empty">
            <span>Data not found.</span>
        </div>
    </div>
<?php } ?>