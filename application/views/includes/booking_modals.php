<!-- Modal Add Category --> 
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="modalAddCategoryTitle" aria-hidden="true">
  <?php echo form_open_multipart('booking/create_category', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <input type="text" name="category_name" id="category_name" value="" class="form-control" autocomplete="off">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add</button>
	      </div>
	    </div>
	  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Edit Category --> 
<div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="modalEditCategoryTitle" aria-hidden="true">
  	<?php echo form_open_multipart('booking/update_category', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <!-- <input type="text" name="category_name" id="category_name" value="" class="form-control" autocomplete="off"> -->
		        <div class="modal-edit-category-container"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Update</button>
		      </div>
		    </div>
	  	</div>
  	<?php echo form_close(); ?>
</div>

<!-- Modal Add Service/Item -->
<div class="modal fade bd-example-modal-lg" id="modalAddServiceItem" tabindex="-1" role="dialog" aria-labelledby="modalAddServiceItemTitle" aria-hidden="true">
  <?php echo form_open_multipart('booking/create_service_item', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Service/Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-7">
	      		<div class="form-group">
                    <label>Category</label> <span class="help"></span>
                    <select name="category_id" id="category_id" class="form-control">
                    	<?php foreach( $category as $cat ){ ?>
                    			<option value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
                    	<?php } ?>
						
					</select>
                </div>	

				<div class="form-group">
                    <label>Name</label> <span class="help">(e.g. Cleaning)</span>
                    <input type="text" name="name" id="name" value="" class="form-control" autocomplete="off" required="">
                </div>	  

				<div class="form-group">
                    <label>Description</label> <span class="help">(optional)</span>
                    <textarea name="description" id="description" cols="40" rows="5" class="form-control"></textarea>
                </div> 

				<div class="form-group">
	                <div class="row">
	                    <div class="col-sm-6">
	                        <label>Price ($)</label>
	                        <div class="input-group">
	                            <input type="text" name="price" id="price" value="0" class="form-control" autocomplete="off" required="">
	                        </div>
	                    </div>
	                    <div class="col-sm-6">
	                        <label>Price Unit</label>
	                        <select name="price_unit" id="price_unit" class="form-control">
								<option value="each">each</option>
								<option value="sq. ft.">sq. ft.</option>
								<option value="sq. yd.">sq. yd.</option>
								<option value="linear ft.">linear ft.</option>
								<option value="item">item</option>
								<option value="room">room</option>
								<option value="hour">hour</option>
								<option value="day">day</option>
								<option value="lb">lb</option>
								<option value="total">total</option>
							</select>
	                    </div>
	                </div>
                </div>      

	      	</div>
	      	<div class="col-md-5">

                <label>Image</label>
                <div class="margin-bottom-sec">
                    <div class="product-edit__image-cnt"> 
                        <img style="width: 153px;" class="img-responsive" data-fileupload="product-image" src="<?php echo base_url('/assets/dashboard/images/product-no-image.jpg') ?>">
                    </div>
                    <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload Image <input data-fileupload="product-file" name="product-image" type="file"></span>
                    <a class="a-default margin-left" href="#" data-fileupload="product-delete"><span class="fa fa-trash"></span> Delete</a>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Edit Service/Item -->
<div class="modal fade bd-example-modal-lg" id="modalEditServiceItem" tabindex="-1" role="dialog" aria-labelledby="modalEditServiceItemTitle" aria-hidden="true">
  <?php echo form_open_multipart('booking/update_service_item', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Service/Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    	<div id="modal-edit-service-item-container" class="modal-edit-service-item-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Add Coupon -->
<div class="modal fade bd-example-modal-lg" id="modalAddCoupon" tabindex="-1" role="dialog" aria-labelledby="modalAddCouponTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add New Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('booking/create_coupon', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <div class="modal-body">        
          <div class="validation-error hide"></div>

          <div class="form-group">
              <label>Coupon Name</label> <span class="form-required">*</span>
              <input type="text" name="name" value=""  class="form-control" required="" autocomplete="off" />
          </div>
          <div class="form-group">
              <label>Code</label> <span class="form-required">*</span> &nbsp; <span class="help help-sm">(a unique code, can contain only letters, numbers and - _ .)</span>
              <input type="text" name="code" value=""  class="form-control" required="" autocomplete="off" />
          </div>
          <div class="form-group">
              <label>Discount from Total</label> <span class="form-required">*</span>
              <div class="row">
                  <div class="col-sm-8">
                      <select name="discount_type" class="form-control coupon-discount-type" required="">
                        <option value="1">Percentage %</option>
                        <option value="2">Amount $</option>
                      </select>
                  </div>
                  <div id="discount_percent_cnt" class="">
                      <div class="">
                          <div class="input-group">
                              <div class="input-group-addon bold">%</div>
                              <input type="text" name="discount_percent" value="" required="" class="form-control" autocomplete="off" />
                          </div>
                      </div>
                  </div>
                  <div id="discount_amount_cnt" class="hide">
                      <div class="">
                          <div class="input-group">
                              <div class="input-group-addon bold">$</div>
                              <input type="text" name="discount_amount" value="" required="" class="form-control" autocomplete="off" />
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-sm-8">
                      <label>Valid From</label>
                      <div class="input-group">
                          <input type="text" name="valid_from" value=""  class="form-control coupon_valid_from" required="" id="coupon_valid_from" autocomplete="off" />
                          <div class="input-group-addon calendar-button" data-for="coupon_valid_from">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-8">
                      <label>Valid To</label>
                      <div class="input-group">
                          <input type="text" name="valid_to" value=""  class="form-control coupon_valid_to" required="" id="coupon_valid_to" autocomplete="off" />
                          <div class="input-group-addon calendar-button" data-for="coupon_valid_to">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-8">
                      <label>Uses per coupon</label>
                      <input type="text" name="uses_max" value="" required="" class="form-control" autocomplete="off" />
                  </div>
              </div>
          </div>
          <div class="row margin-bottom-sec">
              <div class="col-sm-8">
                  <label>Status</label>
                  <select name="status" class="form-control" autocomplete="off">
                    <option value="1">Active</option>
                    <option value="0">Closed</option>
                  </select>
              </div>
          </div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Edit Coupon -->
<div class="modal fade bd-example-modal-lg" id="modalEditCoupon" tabindex="-1" role="dialog" aria-labelledby="modalAddCouponTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-pencil"></i> Edit Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('booking/update_coupon', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <div class="modal-body modal-edit-coupon"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Delete Coupon -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteCoupon" tabindex="-1" role="dialog" aria-labelledby="modalAddCouponTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('booking/delete_coupon', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => '', 'id' => 'cid'));?>
      <div class="modal-body">        
          <p>Delete selected coupon?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Delete Category --> 
<div class="modal fade" id="modalDeleteCategory" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCategoryTitle" aria-hidden="true">
    <?php echo form_open_multipart('booking/delete_category', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <?php echo form_input(array('name' => 'cat_id', 'type' => 'hidden', 'value' => '', 'id' => 'cat_id'));?>
	   <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Category</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Delete selected category & associated services/items?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		        <button type="submit" class="btn btn-danger">Yes</button>
		      </div>
		    </div>
	    </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Delete Service/Item --> 
<div class="modal fade" id="modalDeleteServiceItem" tabindex="-1" role="dialog" aria-labelledby="modalDeleteServiceItemTitle" aria-hidden="true">
    <?php echo form_open_multipart('booking/delete_service_item', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <?php echo form_input(array('name' => 'siid', 'type' => 'hidden', 'value' => '', 'id' => 'siid'));?>
	   <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Service/Item</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Delete selected service/item?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		        <button type="submit" class="btn btn-danger">Yes</button>
		      </div>
		    </div>
	    </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Update Setting -->
<div class="modal fade bd-example-modal-md" id="modalUpdateSetting" tabindex="-1" role="dialog" aria-labelledby="modalUpdateSettingTitle" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-gear"></i> Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-setting-msg"></div>      
    </div>
  </div>
</div>

<!-- Modal Update Time Slot -->
<div class="modal fade bd-example-modal-md" id="modalUpdateTimeSlot" tabindex="-1" role="dialog" aria-labelledby="modalUpdateTimeSlotTitle" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-calendar"></i> Time Slots</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-time-slot-msg"></div>      
    </div>
  </div>
</div>

<!-- Modal Delete Time Slot --> 
<div class="modal fade" id="modalDeleteTimeSlot" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTimeSlotTitle" aria-hidden="true">
    <?php echo form_open_multipart('booking/delete_time_slot', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid'));?>
     <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Time Slot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Delete selected time slot?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>

