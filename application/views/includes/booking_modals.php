<!-- Modal Add Category -->
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="modalAddCategoryTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="category_name" value="" class="form-control" autocomplete="off">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Service/Item -->
<div class="modal fade bd-example-modal-lg" id="modalAddServiceItem" tabindex="-1" role="dialog" aria-labelledby="modalAddServiceItemTitle" aria-hidden="true">
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
                    <select name="category" class="form-control">
						<option value="1">Category1</option>
						<option value="2">Category2</option>
						<option value="3">Category3</option>
					</select>
                </div>	

				<div class="form-group">
                    <label>Name</label> <span class="help">(e.g. Cleaning)</span>
                    <input type="text" name="name" value="" class="form-control" autocomplete="off">
                </div>	  

				<div class="form-group">
                    <label>Description</label> <span class="help">(optional)</span>
                    <textarea name="description" cols="40" rows="5" class="form-control"></textarea>
                </div> 

				<div class="form-group">
	                <div class="row">
	                    <div class="col-sm-6">
	                        <label>Price ($)</label>
	                        <div class="input-group">
	                            <input type="text" name="price" value="0" class="form-control" autocomplete="off">
	                        </div>
	                    </div>
	                    <div class="col-sm-6">
	                        <label>Price Unit</label>
	                        <select name="price_unit" class="form-control">
								<option value="1">each</option>
								<option value="2">sq. ft.</option>
								<option value="3">sq. yd.</option>
								<option value="10">linear ft.</option>
								<option value="4">item</option>
								<option value="5">room</option>
								<option value="6">hour</option>
								<option value="7">day</option>
								<option value="8">lb</option>
								<option value="9">total</option>
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
        <button type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
