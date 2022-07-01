<input type="hidden" name="category_id" id="category_id" value="<?= $category_id ?>">
<div class="row g-3">
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Category Name</label>
        <input type="text" placeholder="Name" name="category_name" id="category_name" class="nsm-field form-control" required value="<?= $category->name; ?>"/>
    </div>
</div>