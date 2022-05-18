<style>
.event-tag {
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

<input type="hidden" name="etid" value="<?= $eventTag->id; ?>">
<div class="row">                                
    <div class="col-md-12 mt-3 company-select">
        <label for="">Company</label>
        <select name="company_id" id="companyList" class="nsm-field mb-2 form-control add-company" required="">     
            <option value="">Select Company</option>           
            <?php foreach($companies as $c){ ?>
                <option <?= $eventTag->company_id == $c->company_id ? 'selected="selected"' : ''; ?> value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Event Tag Name</label>
        <input type="text" name="event_tag_name" value="<?= $eventTag->name; ?>" id="event-tag-name" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Icon / Marker</label>
        <?php 
            if ($eventTag->marker_icon != '') :
                if ($eventTag->is_marker_icon_default_list == 1) :
                    $marker = base_url("uploads/icons/" . $eventTag->marker_icon);
                else :
                    $marker = base_url("uploads/event_tags/" . $eventTag->company_id . "/" . $eventTag->marker_icon);
                endif;
            else :
                $marker = base_url("uploads/event_tags/default_no_image.jpg");
            endif;
        ?>
        <div class="event-tag" style="background-image: url('<?php echo $marker ?>')"></div>        
        <input type="file" name="image_marker" class="form-control" />
    </div>
</div>