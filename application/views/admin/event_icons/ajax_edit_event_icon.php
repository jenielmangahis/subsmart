<style>
.event-icon {
    width: 50px;
    height: 50px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #f1f1f1;
    border-radius: 5px;
    margin-top: 12px;
    margin-bottom: 16px;
}
</style>
<input type="hidden" name="eiid" value="<?= $eventIcon->id; ?>">
<div class="row">    
    <div class="col-md-12 mt-3">
        <label for="">Icon Name</label>
        <input type="text" name="icon_name" id="icon-name" value="<?= $eventIcon->name; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Icon / Marker</label>
        <?php $marker = base_url("uploads/icons/" . $eventIcon->image); ?>
        <div class="event-icon" style="background-image: url('<?php echo $marker ?>')"></div>
        <input type="file" name="image_marker" class="form-control" />
    </div>
</div>