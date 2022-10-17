<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.getItems_hidden{
  display: none;
}
.show_mobile_view{
  display: none;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
label>input {
  visibility: initial !important;
  position: initial !important; 
}
</style>
<?php include viewPath('v2/includes/header'); ?>
<!-- page wrapper start -->
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate_subtabs'); ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="nsm-page">
                <div class="nsm-page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-callout primary">
                                <button><i class='bx bx-x'></i></button>
                                Edit Plan Details.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="nsm-card">
                <div class="nsm-card-content">
                    <div class="col-sm-12">
                    <?php echo form_open('plans/update/'.$plan->id, [ 'class' => 'form-validate' ]); ?>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="formClient-Name">Name *</label>
                                    <input type="text" class="form-control" name="plan_name" id="formClient-Name" required placeholder="Enter Name" autofocus value="<?php echo $plan->plan_name ?>"/>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="discount_fixed">Status</label>
                                    <select name="status" class="groups-select form-control">
                                        <option value="1" <?php if($plan->status==1) echo 'slected'; ?>>Actived</option>
                                        <option value="0" <?php if($plan->status==0) echo 'slected'; ?>>Deactived</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>Assign Items</h5>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <a href="#" class="nsm-button primary small" id="add_another_old" data-bs-toggle="modal" data-bs-target="#item_list"><i class='bx bx-plus'></i> Add Items</a>
                                    </div>
                                    </div>			
                                <?php 
                                    $i=0;
                                    $plan_items  = unserialize($plan->items);
                                    $count_items = 0;
                                    if( $plan_items > 0 ){
                                        $count_items = count($plan_items)-1;
                                    }
                                ?>		
                                <input type="hidden" name="count" value="<?php echo $count_items; ?>" id="count">				
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>Type</th>
                                            <th width="100px">Quantity</th>
                                            <!-- <th>LOCATION</th> -->
                                            <th width="100px">COST</th>
                                            <th width="100px">Discount</th>
                                            <th width="110px">Tax(%)</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="jobs_items_table_body">
                                        <?php if($plan_items!=''){
                                            $total = 0;
                                            foreach($plan_items as $row){ 
                                                $total = $row['tax'] + $row['price'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" class="form-control" name="item_id[]" value="<?php echo $row['item_id']; ?>">
                                                        <input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="items[]" value="<?php echo $row['item']; ?>">
                                                        <ul class="suggestions"></ul>
                                                    </td>
                                                    <td><select name="item_type[]" class="form-control">
                                                        <option value="product" <?php if($row['item_type']=='product') echo 'selected'; ?>>Product</option>
                                                        <option value="material" <?php if($row['item_type']=='material') echo 'selected'; ?>>Material</option>
                                                        <option value="service" <?php if($row['item_type']=='service') echo 'selected'; ?>>Service</option>
                                                        </select></td>
                                                    <td><input type="text" class="form-control quantity" name="quantity[]" value="<?php echo $row['quantity'] ?>" data-counter="<?=$i?>" id="quantity_<?=$i?>"></td>
                                                    <!-- <td><input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>"></td> -->
                                                    <td><input readonly type="number" class="form-control price" name="price[]" data-counter="<?=$i?>" id="price_<?=$i?>" min="0" value="<?php echo $row['price'] ?>"></td>
                                                    <td><input type="number" class="form-control discount" name="discount[]" data-counter="<?=$i?>" id="discount_<?=$i?>" min="0" value="<?php echo $row['discount'] ?>"></td>
                                                    <td>
                                                        <input type="text" data-itemid="<?=$i?>" class="form-control tax_change valid" name="tax[]" data-counter="<?=$i?>" id="tax1_<?=$i?>" readonly="" min="0" value="<?php echo $row['tax']; ?>" aria-invalid="false">
                                                    </td>
                                                    <td><span id="span_total_<?=$i?>">0.00</span></td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="remove nsm-button error" id="<?= $row['item_id']; ?>"><i class='bx bx-trash'></i></a>
                                                    </td>
                                                </tr>	
                                            <?php $i++; } ?>										
                                        <?php }else{ ?>
                                        <!-- <tr>
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
                                        </tr> -->
                                        <?php 
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-3 text-end">									
                                <button type="button" class="nsm-button back">Back To Plan Lists</button>
                                <button type="submit" class="nsm-button primary">Save</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php include viewPath('v2/includes/plans/edit_modal') ?>
<!-- page wrapper end -->
<?php include viewPath('v2/includes/footer'); ?>
<!-- <script src="<?php echo $url->assets ?>js/custom.js"></script> -->
<script>
   $(document).ready(function() {   
	<?php  for($cc=0;$cc<=count(unserialize($plan->items));$cc++){ ?>
		calculation(<?php echo $cc; ?>);
	<?php } ?>
     $('.form-validate').validate();
     $('.check-select-all-p').on('change', function() {
       $('.check-select-p').attr('checked', $(this).is(':checked'));
     });

     $('#modal_items_table_estimate').DataTable({
       "autoWidth" : false,
       "columnDefs": [
        { width: 540, targets: 0 },
        { width: 100, targets: 0 },
        { width: 100, targets: 0 }
      ],
       "ordering": false,
     });
   
     $('.table-DT').DataTable({   
       "ordering": false,   
     });

     $('.select2').select2();

     
   });
   var is_Confirm = 0;
   $(document).on("click", ".remove", function (e) {
        is_Confirm = 1;
     })
     $(document).on("click", ".back", function (e) {
        if(is_Confirm == 1){
            confirm();
        }
     })
     function confirm(){
            Swal.fire({
                title: 'Unsaved Changes',
                text: 'Your changes have not been saved. Are you sure you want to go back?',
                icon: 'warning',
                showCancelButton: true,
                showDenyButton: true,
                showConfirmButton: false,
                confirmButtonColor: '#32243d',
                denyButtonColor: '#6a4a86',
                confirmButtonText: 'Save',
                denyButtonText: 'Go back without saving'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('sure');
                } else if (result.isDenied) {
                    location.href= '<?= base_url('plans'); ?>';
                }
            });
        }
</script>