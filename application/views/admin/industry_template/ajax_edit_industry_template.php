<input type="hidden" name="tid" id="edit-tid" value="<?= $industryTemplate->id; ?>">
<div class="row">
    <div class="col-md-12">
        <label for="">Name</label>
        <input type="text" name="template_name" id="edit-template-name" value="<?= $industryTemplate->name; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="status" class="form-control" autocomplete="off">
            <option <?= $industryTemplate->status == 1 ? 'selected="selected"' : ''; ?> value="1">Active</option>
            <option <?= $industryTemplate->status == 0 ? 'selected="selected"' : ''; ?> value="0">Inactive</option>
        </select>
    </div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="section-title mt-5">Assign Modules</div>
    <ul class="list-modules" style="max-height: 200px; overflow-y: scroll;">
        <?php if($industryModules){ 
              $module_id = array();
              if($industryTemplateModules) {
                foreach ($industryTemplateModules as $key => $industryTemplateModule) {
                   $module_id[] = $industryTemplateModule->industry_module_id;
                }
              }

             foreach ($industryModules as $key => $industryModule) {   
                 $checked = "";
                     if(in_array($industryModule->id, $module_id)  ){$checked = "checked";    }                  ?>
                <li>
                  <div class="checkbox">
                    <input type="checkbox" <?php echo $checked; ?> class="form-check-input" name="modules[]" id="edit-module-<?= $industryModule->id; ?>" value="<?php echo $industryModule->id; ?>" >
                   <label class="" for="edit-module-<?= $industryModule->id; ?>"><?php echo $industryModule->name; ?></label>
                  </div>
                </li>
        <?php } ?>
    <?php } ?>
    </ul>
    </div>
</div>