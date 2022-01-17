<?php 
if($data_count == "NaN"){
    $data_count=1;
}
if($prelim_pages!=null){
    foreach($prelim_pages as $page){
?>
        <input type="text" name="preliminary_page_id[]" value="1" style="display: none;">
        <div class="page" data-count="<?=$data_count?>">
            <div class="form-check" style="padding: 0 12px;">
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="include_this_page[]" id="include_this_page_<?=$data_count?>" checked>
                    <label for="include_this_page_<?=$data_count?>">Include this page</label>
                </div>
                <i class="fa fa-trash-o delete-page-btn" aria-hidden="true" data-id="1"></i>
            </div>
            <div class="form-group">
                <div class="label">
                    Page title
                </div>
                <input type="text" class="form-control " name="preliminary_page_title[]" placeholder="e.g. Executive summary, Accountant’s letter">
            </div>
            <div class="page-content">
                <div class="form-group">
                    <div class="label">
                        Page content
                    </div>
                </div>
                <div class="page-content-field">
                    <textarea class="form-control" name="prelimenary_page_content[]" id="prelimenary_page_content_<?=$data_count?>" cols="40" rows="20"></textarea>
                </div>
            </div>
        </div>
<?php
    }
    $data_count++;
}else{
?>
   <input type="text" name="preliminary_page_id[]" value="1" style="display: none;">
        <div class="page" data-count="<?=$data_count?>">
            <div class="form-check" style="padding: 0 12px;">
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="include_this_page[]" id="include_this_page_<?=$data_count?>" checked>
                    <label for="include_this_page_<?=$data_count?>">Include this page</label>
                </div>
                <i class="fa fa-trash-o delete-page-btn" aria-hidden="true" data-id="1"></i>
            </div>
            <div class="form-group">
                <div class="label">
                    Page title
                </div>
                <input type="text" class="form-control " name="preliminary_page_title[]" placeholder="e.g. Executive summary, Accountant’s letter">
            </div>
            <div class="page-content">
                <div class="form-group">
                    <div class="label">
                        Page content
                    </div>
                </div>
                <div class="page-content-field">
                    <textarea class="form-control" name="prelimenary_page_content[]" id="prelimenary_page_content_<?=$data_count?>" cols="40" rows="20"></textarea>
                </div>
            </div>
        </div> 
<?php
}
?>