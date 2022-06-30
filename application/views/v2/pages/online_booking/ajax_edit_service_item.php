<input type="hidden" id="service_item_id" name="service_item_id" value="<?= $service_item_id; ?>">
<div class="row g-3">
    <div class="col-12 col-md-7">
        <div class="row g-3">
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Category</label>
                <select class="nsm-field form-control" id="category_id" name="category_id" required>
                    <option value="" disabled>Select Category</option>
                    <?php foreach( $category as $cat ): ?>
                        <option <?= $service_item->category_id == $cat->id ? 'selected=""' : ''; ?> value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                <input type="text" placeholder="Name" name="name" id="name" class="nsm-field form-control" required value="<?= $service_item->name; ?>" />
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                <textarea class="nsm-field form-control" cols="40" rows="5" name="description" id="description" placeholder="Description"><?= $service_item->description; ?></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Price ($)</label>
                <input type="text" name="price" id="price" value="0" class="nsm-field form-control" required value="<?= $service_item->price; ?>" />
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Price Unit</label>
                <select class="nsm-field form-control" id="price_unit" name="price_unit" required>
                    <option value="" disabled>Select Price Unit</option>
                    <option <?= $service_item->price_unit == 'each' ? 'selected=""' : ''; ?> value="each">each</option>
                    <option <?= $service_item->price_unit == 'sq. ft.' ? 'selected=""' : ''; ?> value="sq. ft.">sq. ft.</option>
                    <option <?= $service_item->price_unit == 'sq. yd.' ? 'selected=""' : ''; ?> value="sq. yd.">sq. yd.</option>
                    <option <?= $service_item->price_unit == 'linear ft.' ? 'selected=""' : ''; ?> value="linear ft.">linear ft.</option>
                    <option <?= $service_item->price_unit == 'item' ? 'selected=""' : ''; ?> value="item">item</option>
                    <option <?= $service_item->price_unit == 'room' ? 'selected=""' : ''; ?> value="room">room</option>
                    <option <?= $service_item->price_unit == 'hour' ? 'selected=""' : ''; ?> value="hour">hour</option>
                    <option <?= $service_item->price_unit == 'day' ? 'selected=""' : ''; ?> value="day">day</option>
                    <option <?= $service_item->price_unit == 'lb' ? 'selected=""' : ''; ?> value="lb">lb</option>
                    <option <?= $service_item->price_unit == 'total' ? 'selected=""' : ''; ?> value="total">total</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <?php
        $service_item_thumb = $service_item->image;
        if (file_exists('uploads/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {

            $service_item_thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg');
            if (file_exists('uploads/service_item/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                $service_item_thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg');
            } else {
                $service_item_thumb_img = base_url('uploads/service_item/' . $service_item_thumb);
            }
        } else {
            $service_item_thumb_img = base_url('uploads/' . $service_item_thumb);
        }
        ?>
        <label class="content-subtitle fw-bold d-block mb-2">Image</label>
        <div class="nsm-img-upload" style="background-image: url('<?php echo $service_item_thumb_img; ?>')">
            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
            <input type="file" name="product-image" class="nsm-upload" accept="image/*">
        </div>
    </div>
</div>