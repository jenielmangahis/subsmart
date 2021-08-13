<style>
hr{
    border: 0.5px solid #32243d !important;
    width: 100%;
}
.form-group {
    margin-bottom: 2px !important;
}
.banking-tab-container {
    border-bottom: 1px solid grey;
    padding-left: 0;
}
.form-line{
    padding-bottom: 1px;
}
.input_select{
    color: #363636;
    border: 2px solid #e0e0e0;
    box-shadow: none;
    display: inline-block !important;
    width: 100%;
    background-color: #fff;
    background-clip: padding-box;
    font-size: 11px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 15px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
 <?php include viewPath('includes/sidebars/inventory'); ?>
   <?php include viewPath('includes/notifications'); ?>
   <div wrapper__section>
   <div class="container-fluid p-40">
      <section class="content">
         <!-- Default box -->
         <div class="box">
            <?php echo form_open('plans/save', [ 'class' => 'form-validate' ]); ?>
            <div class="row custom__border">
				<div class="col-xl-12">
					<div class="card">
            <div style="padding:14px ​0px 11px !important;">
              <div class="row align-items-center">
                <div class="col-sm-6">
                  <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Package</h5>
                </div>
                <div class="col-sm-6">
                  <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                      <a href="<?php echo url('plans') ?>" class="btn btn-primary" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Go Back to Plans
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add New Plan.</span>
              </div>
            </div>
						<div class="card-body" style="padding: 0px;">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label for="formClient-Name">Package Name *</label>
									  <input type="text" class="form-control" name="plan_name" id="formClient-Name" required placeholder="Enter Name" autofocus />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">
										<label for="discount_fixed">Status</label>
										<select name="status" class="groups-select form-control">
											<option value="1">Actived</option>
											<option value="0">Deactived</option>
										</select>
									</div>
								</div>

								<div class="col-md-12 table-responsive">
									<h5>Assign Items</h5>
									<table class="table table-hover">
										<input type="hidden" name="count" value="0" id="count">
										<thead>
											<tr>
												<th>DESCRIPTION</th>
												<th>Type</th>
												<th width="100px">Quantity</th>
												<!-- <th>LOCATION</th> -->
												<th width="100px">COST</th>
												<th width="100px">Discount</th>
												<th>Tax(%)</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody id="jobs_items_table_body">
											<tr>
												<td><input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul></td>
												<td><select name="item_type[]" class="form-control">
													<option value="product">Product</option>
													<option value="material">Material</option>
													<option value="service">Service</option>
													</select></td>
												<td width="100px"><input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1"></td>
												<!-- <td><input type="text" class="form-control" name="location[]"></td> -->
												<td width="140px"><input readonly type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0"></td>
												<td width="100px"><input type="number" class="form-control discount" name="discount[]" data-counter="0" id="discount_0" min="0" value="0"></td>
												<td width="100px"><span id="span_tax_0">0.00 (7.5%)</span></td>
												<td><span id="span_total_0">0.00</span></td>
											</tr>
										</tbody>
									</table>
									<a href="#" class="btn btn-primary" id="add_another_old" data-toggle="modal" data-target="#item_list">Add Items</a>
								</div>

								<div class="col-sm-6 mt-3">
									<button type="submit" class="btn btn-flat btn-primary">Submit</button>
								</div>

							</div>
						</div>
					</div>
				</div>
            </div>

            <?php echo form_close(); ?>
         </div>
         <!-- /.box -->
      </section>
      <!-- end row -->
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->

<!-- Modal -->
<div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="items_table_estimate" class="table table-hover" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <td> Name</td>
                                            <td> Rebatable</td>
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td><?php echo $item->rebate; ?></td>
                                                <td></td>
                                                <td><?php echo $item->price; ?></td>
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">
                                                <span class="fa fa-plus"></span>
                                            </button></td>
                                            </tr>
                                            
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready(function() {

     $('.form-validate').validate();



     $('.check-select-all-p').on('change', function() {



       $('.check-select-p').attr('checked', $(this).is(':checked'));



     })



     $('.table-DT').DataTable({

       "ordering": false,

     });

   })



</script>
<script>
   //Initialize Select2 Elements

   $('.select2').select2()

</script>
