<!-- Modal Add Category --> 
<style>
.calendar-button{
  padding-top: 12px;
  margin-left: 7px;
}
</style>
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="modalAddCategoryTitle" aria-hidden="true">
  <?php echo form_open_multipart('booking/create_category', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add Category</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
          <div class="form-group">
            <label for="">Category Name</label><br />
            <input type="text" name="category_name" id="category_name" value="" class="form-control" autocomplete="off">
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

<!-- Modal Edit Category --> 
<div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="modalEditCategoryTitle" aria-hidden="true">
  	<?php echo form_open_multipart('booking/update_category', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-edit"></i> Edit Category</h5>
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
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add Service/Item</h5>
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
	      	<div class="col-md-5 text-center">

                <label>Image</label>
                <div class="margin-bottom-sec">
                    <div class="product-edit__image-cnt"> 
                        <img style="display: initial; margin-bottom: 48px; margin-top: 26px;" id="preview-img-container" class="img-responsive" data-fileupload="product-image" src="<?php echo base_url('/assets/dashboard/images/product-no-image.jpg') ?>">
                    </div>
                    <span class="btn btn-default fileinput-button vertical-top">
                    	<span class="fa fa-camera"></span> Add Image 
                    	<input data-fileupload="product-file" name="product-image" value="" id="product-image" type="file" onchange="loadPreviewImg(event)" >
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
<div class="modal fade nsm-modal fade" id="modalAddCoupon" tabindex="-1" aria-labelledby="modalAddCoupon-label" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Add New Coupon</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
      </div>
      <?php echo form_open_multipart(null, ['id' => 'frm-booking-coupon', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <div class="modal-body">        
          <div class="row">
            <div class="col-6">
              <label>Coupon Name</label> <span class="form-required">*</span>
              <input type="text" name="name" value=""  class="form-control" required="" autocomplete="off" />
            </div>
            <div class="col-6">
              <label>Coupon Code</label> <span class="form-required">*</span>
              <input type="text" name="code" id="coupon-code" value=""  class="form-control" required="" autocomplete="off" />
            </div>
            <div class="col-6 mt-2">
              <label>Discount Type</label> <span class="form-required">*</span>
              <select name="discount_type" class="form-control coupon-discount-type" required="">
                <option value="1">Percentage %</option>
                <option value="2">Amount $</option>
              </select>
            </div>
            <div class="col-6 mt-2">
              <label>Discount Amount <span class="form-required">*</span>
              <div id="discount_percent_cnt" class="">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
                    <input type="number" step="any" name="discount_percent" value="0" class="form-control" />
                  </div>
              </div>
              <div id="discount_amount_cnt" class="hide">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" name="discount_amount" value="0" class="form-control" autocomplete="off" />
                  </div>
              </div>
            </div>
            <div class="col-6 mt-2">
              <label>Valid From</label>
              <input type="date" name="valid_from" value="<?= date("Y-m-d"); ?>"  class="form-control coupon_valid_from" required="" id="coupon_valid_from" autocomplete="off" />
            </div>
            <div class="col-6 mt-2">
              <label>Valid To</label>
              <input type="date" name="valid_to" value="<?= date("Y-m-d"); ?>"  class="form-control coupon_valid_to" required="" id="coupon_valid_to" autocomplete="off" />
            </div>
            <div class="col-6 mt-2">
              <label>Max usage</label>
              <input type="number" name="uses_max" value="1" required="" class="form-control" autocomplete="off" />
            </div>
            <div class="col-6 mt-2">
              <label>Status</label>
              <select name="status" class="form-control" autocomplete="off">
                <option value="1">Active</option>
                <option value="0">Closed</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="nsm-button primary" id="btn-save-coupon">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal Edit Coupon -->
<div class="modal fade nsm-modal fade" id="modalEditCoupon" tabindex="-1" aria-labelledby="modalEditCoupon-label" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Edit Coupon</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
      </div>
      <?php echo form_open_multipart(null, ['id' => 'frm-edit-booking-coupon', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <div class="modal-body modal-edit-coupon"></div>
      <div class="modal-footer">
        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="nsm-button primary" id="btn-update-coupon">Save</button>
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

<!-- Modal Add Form Field --> 
<div class="modal fade nsm-modal fade" id="modalAddFormField" tabindex="-1" aria-labelledby="modalAddFormField-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add New Form Field</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart(null, [ 'id' => 'frm-booking-add-field', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                <div class="row">                        
                  <div class="col-sm-12 mt-2">
                      <label class="mb-2">Field Name</label>
                      <div class="input-group">
                          <input type="text" name="field_name" id="field_name" value="" class="form-control" required="" autocomplete="off">
                      </div>
                      
                  </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="nsm-button primary" id="btn-save-form-field">Save</button>
                    <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Change Status Inquiry --> 
<div class="modal fade" id="modalViewChangeStatus" tabindex="-1" role="dialog" aria-labelledby="modalViewChangeStatus" aria-hidden="true">
   <?php echo form_open_multipart('booking/update_inquiry_status', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
   <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-flag-o"></i> Update Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="inquiry-change-status-body"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>        
      </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- Modal Edit Info Inquiry --> 
<div class="modal fade" id="modalViewEditInquiryInfo" tabindex="-1" role="dialog" aria-labelledby="modalViewEditInquiryInfoTitle" aria-hidden="true">
   <?php echo form_open_multipart('booking/update_inquiry_details', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-pencil"></i> Edit Inquiry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="inquiry-edit-info-body"></div>
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>        
      </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- Modal Delete Inquiry -->
<div class="modal fade bd-example-modal-sm" id="modalDeleteInquiry" tabindex="-1" role="dialog" aria-labelledby="modalAddCouponTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Inquiry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('booking/delete_inquiry', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <?php echo form_input(array('name' => 'iid', 'type' => 'hidden', 'value' => '', 'id' => 'iid'));?>
      <div class="modal-body">        
          <p>Delete selected inquiry?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal View Inquiry --> 
<div class="modal fade" id="modalViewInquiry" tabindex="-1" role="dialog" aria-labelledby="modalViewEditInquiryInfoTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-eye"></i> View Inquiry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="view-inquiry-body"></div>
        </div>
      </div>
    </div>
</div>