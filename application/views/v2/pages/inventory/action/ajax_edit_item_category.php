<div class="row">
    <input type="hidden" name="icid" value="<?php echo $itemCategory->item_categories_id; ?>">
    <div class="col-lg-12 mb-2">
        <strong>Name</strong>
        <input value="<?php echo $itemCategory->name; ?>" type="text" class="form-control" name="category_name" id="category_name" required/>
    </div>
    <div class="col-lg-12 mb-2">
        <strong>Description</strong>
        <textarea class="form-control" name="category_description" id="category_description"><?php echo $itemCategory->description; ?></textarea>
    </div>
</div>