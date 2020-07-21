  	<input type="hidden" id="service_item_id" name="service_item_id" value="<?= $service_item_id; ?>">
  	<div class="row">
      	<div class="col-md-7">
      		<div class="form-group">
                <label>Category</label> <span class="help"></span>
                <select name="category_id" id="category_id" class="form-control">
                	<?php foreach( $category as $cat ){ ?>
                			<option <?= $service_item->category_id == $cat->id ? 'selected=""' : ''; ?> value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
                	<?php } ?>
					
				</select>
            </div>	

			<div class="form-group">
                <label>Name</label> <span class="help">(e.g. Cleaning)</span>
                <input type="text" name="name" id="name" value="<?= $service_item->name; ?>" class="form-control" autocomplete="off" required="">
            </div>	  

			<div class="form-group">
                <label>Description</label> <span class="help">(optional)</span>
                <textarea name="description" id="description" cols="40" rows="5" class="form-control"><?= $service_item->description; ?></textarea>
            </div> 

			<div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Price ($)</label>
                        <div class="input-group">
                            <input type="text" name="price" id="price" value="<?= $service_item->price; ?>" class="form-control" autocomplete="off" required="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Price Unit</label>
                        <select name="price_unit" id="price_unit" class="form-control">
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

      	</div>
      	<div class="col-md-5">

            <label>Image</label>
            <div class="margin-bottom-sec">
                <div class="product-edit__image-cnt"> 

                    <?php 
                        $service_item_thumb = $service_item->image;
                        if(file_exists('uploads/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                            
                            $service_item_thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg'); 
                            if(file_exists('uploads/service_item/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                                $service_item_thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg'); 
                            } else {
                                $service_item_thumb_img = base_url('uploads/service_item/'.$service_item_thumb);
                            }

                        } else {
                            $service_item_thumb_img = base_url('uploads/'.$service_item_thumb);
                        }
                    ?>

                    <img style="width: 153px;" id="edit-preview-img-container" class="img-responsive" data-fileupload="product-image" src="<?php echo $service_item_thumb_img; ?>">
                </div>
                <span class="btn btn-default fileinput-button vertical-top">
                    <span class="fa fa-camera"></span> Add Image 
                    <input data-fileupload="product-file" name="product-image" id="product-image" value="" type="file" onchange="loadEditPreviewImg(event)">
                </span>
                <!-- <a class="a-default margin-left" href="#" data-fileupload="product-delete"><span class="fa fa-trash"></span> Delete</a> -->
            </div>
            <div class="" data-fileupload="product-progressbar" style="display: none;">
                <div class="text">Uploading</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
            </div>
            <div class="alert alert-danger" data-fileupload="product-error" role="alert" style="display: none;"></div>

      	</div>      		
  	</div>