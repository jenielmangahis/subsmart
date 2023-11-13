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
.appointment-notes{
    display: block;
    min-height: 100px;
    max-height: 300px;
    overflow: auto;
    background-color: #cccccc;
    padding: 10px;
    width: 100%;
}
.location-list{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.location-list li{
    margin-right: 0px;
    vertical-align: top;
    display: inline-block;
}
.small-label{
    text-align: center;
    display: block;
    width: 100%;
    font-weight: bold;
    background-color: #DAD1E0;
    padding: 5px;
    margin-top: 9px;
}
</style>
<?php if ($event) { ?>    
    <div class="col-12 col-md-12">
        <label class="content-subtitle fw-bold d-block mb-2" style="font-size:20px;">
            <?= $event->event_number; ?>            
            <br /><small style="    font-size: 12px;margin-bottom: 13px;display: block;margin-top: 5px;">Event Type : <?= $event->event_type; ?></small>
        </label>
    </div>
    <div class="col-12 col-md-7">
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Event</label>
        <label class="content-subtitle fw-bold" style="font-size: 21px;margin-bottom: 20px;"><?= $event->description; ?></label>
        <label class="content-subtitle d-block mb-2 font-15"><span class="fw-bold"><i class='bx bxs-map-pin'></i> </span><?= $event->event_address; ?></label>
        <label class="content-subtitle d-block mb-2 font-15" style="margin-bottom: 5px;">
            <span class="fw-bold"><i class='bx bxs-calendar'></i></span> 
            <?php if( $event->start_date == $event->end_date ){ ?>
                <?= date("l, F d, Y", strtotime($event->start_date)); ?><br />            
            <?php }else{ ?>
                <?= date("l, F d, Y", strtotime($event->start_date)); ?> - <?= date("l, F d, Y", strtotime($event->end_date)); ?><br />            
            <?php } ?>
        </label>        
        <label class="content-subtitle d-block mb-2 font-15" style="margin-bottom: 5px;">
            <span class="fw-bold"><i class='bx bxs-time'></i></span>             
            <?= date("g:i A", strtotime($event->start_time)); ?> to <?= date("g:i A", strtotime($event->end_time)); ?> 
        </label>
        <label class="content-subtitle d-block mb-2 font-15"><span class="fw-bold"><i class='bx bxs-purchase-tag-alt' ></i> </span><?= $event->event_tag; ?></label>
        <?php if( $event->url_link != ''){ ?>
        <label class="content-subtitle d-block mb-2 font-15"><span class="fw-bold"><i class='bx bx-link'></i> </span>             
                <input type="hidden" id="url-link" value="<?= $appointment->url_link; ?>">
                <a href="<?= $appointment->url_link; ?>" target="_new"><?= $event->url_link; ?></a>
                <button type="button" class="nsm-button primary btn-sm btn-copy-url-link" style="display: block;margin-left:20px;margin-top: 10px;">Copy Link</button> 
        </label>            
       <?php } ?>
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header mt-5">Notes</label>
            <div class="d-flex">
            <span class="appointment-notes"><?= $event->notes; ?></span>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header">Created By</label>
        <div class="d-flex align-items-center">
            <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($event->created_by); ?>'); width: 40px;"></div>            
        </div>
        <label class="content-subtitle fw-bold d-block mb-2 appointment-view-header" style="margin-top: 8px;">Attendees</label>
        <div class="d-flex align-items-center">
            <?php $attendees = json_decode($event->employee_id); ?>
            <?php foreach($attendees as $eid){ ?>
                <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($eid); ?>'); width: 40px;"></div>
            <?php } ?>            
        </div>
    </div>
<?php } else { ?>
    <div class="col-12">
        <div class="nsm-empty">
            <span>Event not found.</span>
        </div>
    </div>
<?php } ?>