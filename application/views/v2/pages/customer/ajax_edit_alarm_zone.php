<div class="row">
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label>Zone ID</label>
            <input type="text" class="form-control" name="zone_id" value="<?= $alarmZone->zone_id; ?>" placeholder="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label>Type</label>
            <input type="text" class="form-control" name="zone_type" value="<?= $alarmZone->type; ?>" placeholder="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label>Event Code</label>
            <input type="text" class="form-control" name="zone_event_code" value="<?= $alarmZone->event_code; ?>" placeholder="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label>Location</label>
            <input type="text" class="form-control" name="zone_location" value="<?= $alarmZone->location; ?>" placeholder="">
        </div>
    </div>
</div>