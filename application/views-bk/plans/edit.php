<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
      <!-- end row -->                     
      <section class="content">
         <!-- Default box -->
         <div class="box">
			<div class="page-title-box">
				<div class="row align-items-center">
					<div class="col-sm-6">
						<h1 class="page-title">Plans</h1>
						<ol class="breadcrumb">
							<li class="breadcrumb-item active">Edit Plans</li>
						</ol>
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
			
            <?php echo form_open('plans/update/'.$plan->id, [ 'class' => 'form-validate' ]); ?>
            <div class="row custom__border">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label for="formClient-Name">Name *</label>
									  <input type="text" class="form-control" name="plan_name" id="formClient-Name" required placeholder="Enter Name" autofocus value="<?php echo $plan->plan_name ?>"/>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label for="discount_fixed">Status</label>
										<select name="status" class="groups-select form-control">
											<option value="1" <?php if($plan->status==1) echo 'slected'; ?>>Active</option>
											<option value="0" <?php if($plan->status==0) echo 'slected'; ?>>De-Active</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-12 table-responsive">
									<h5>Assign Items</h5>
									<table class="table table-hover">
										
										<thead>
											<tr>
												<th>DESCRIPTION</th>
												<th>Type</th>
												<th width="100px">Quantity</th>
												<th>LOCATION</th>
												<th width="100px">COST</th>
												<th width="100px">Discount</th>
												<th>Tax(%)</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody id="table_body">
											<?php 
											$i=0;
											if($plan->items!=''){?>
												<input type="hidden" name="count" value="<?php echo count(unserialize($plan->items))-1; ?>" id="count">
											<?php
												foreach(unserialize($plan->items) as $row){ ?>
												<tr>
													<td><input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]" value="<?php echo $row['item'] ?>"><ul class="suggestions"></ul></td>
													<td><select name="item_type[]" class="form-control">
														<option value="product" <?php if($row['item_type']=='product') echo 'selected'; ?>>Product</option>
														<option value="material" <?php if($row['item_type']=='material') echo 'selected'; ?>>Material</option>
														<option value="service" <?php if($row['item_type']=='service') echo 'selected'; ?>>Service</option>
														</select></td>
													<td><input type="text" class="form-control quantity" name="quantity[]" value="<?php echo $row['quantity'] ?>" data-counter="<?=$i?>" id="quantity_<?=$i?>"></td>
													<td><input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>"></td>
													<td><input readonly type="number" class="form-control price" name="price[]" data-counter="<?=$i?>" id="price_<?=$i?>" min="0" value="<?php echo $row['price'] ?>"></td>
													<td><input type="number" class="form-control discount" name="discount[]" data-counter="<?=$i?>" id="discount_<?=$i?>" min="0" value="<?php echo $row['discount'] ?>" readonly></td>
													<td><span id="span_tax_<?=$i?>">0.00 (7.5%)</span></td>
													<td><span id="span_total_<?=$i?>">0.00</span></td>
												</tr>											
												<?php 
												$i++;
												} 
											}else{											
											?>
											<input type="hidden" name="count" value="0" id="count">
											<tr>
												<td><input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul></td>
												<td><select name="item_type[]" class="form-control">
													<option value="product">Product</option>
													<option value="material">Material</option>
													<option value="service">Service</option>
													</select></td>
												<td><input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1"></td>
												<td><input type="text" class="form-control" name="location[]"></td>
												<td><input readonly type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0"></td>
												<td><input type="number" class="form-control discount" name="discount[]" data-counter="0" id="discount_0" min="0" value="0" readonly></td>
												<td><span id="span_tax_0">0.00 (7.5%)</span></td>
												<td><span id="span_total_0">0.00</span></td>
											</tr>
											<?php 
											} ?>
										</tbody>
									</table>
									<a href="#" class="btn btn-primary" id="add_another">Add Items</a>
								</div>
								   
								<div class="col-sm-6 mt-3">
									<button type="submit" class="btn btn-flat btn-primary">Submit</button>
								</div>
										   
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- /.box-footer-->
            <?php echo form_close(); ?>
         </div>
         <!-- /.box -->
      </section>
      <!-- end row -->           
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready(function() {
   
	<?php  for($cc=0;$cc<=count(unserialize($plan->items));$cc++){ ?>
		calculation(<?php echo $cc; ?>);
	<?php } ?>
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