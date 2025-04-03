<div class="row">
    <div class="col-lg-12 col-md-12 mb-2">
        <strong>Name</strong>
        <input value="<?php echo $item->title; ?>" type="text" class="form-control " name="title" id="title" required/>
    </div>
    <div class="col-lg-6 col-md-6 mb-2">
        <strong>Price</strong>
        <input value="<?php echo $item->price; ?>" type="number" step="any" class="form-control" name="price" id="price" required/>
    </div>
    <div class="col-lg-6 col-md-6 mb-2">
        <strong>Frequency</strong>
        <select class="form-control" name="frequency" id="frequency" required>
            <option <?php echo $item->frequency == 'One Time' ? 'selected' : ''; ?> value="One Time" selected>One Time</option>
            <option <?php echo $item->frequency == 'Daily' ? 'selected' : ''; ?> value="Daily">Daily</option>
            <option <?php echo $item->frequency == 'Monthly' ? 'selected' : ''; ?> value="Monthly">Monthly</option>
            <option <?php echo $item->frequency == 'Yearly' ? 'selected' : ''; ?> value="Yearly">Yearly</option>
        </select>
    </div>
    <div class="col-lg-12 col-md-12 mb-2">
        <strong>Description</strong>
        <textarea class="form-control " name="description" id="description"><?php echo $item->description; ?></textarea>
    </div>
</div>