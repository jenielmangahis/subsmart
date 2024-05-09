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
</style>
<?php include viewPath('v2/includes/header'); ?>
<!-- page wrapper start -->
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate__tabs_v2'); ?>
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
                                View Plan Details.
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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="formClient-Name">Name *</label>
                                    <input readonly="" disabled="" type="text" class="form-control" name="plan_name" id="formClient-Name" required placeholder="Enter Name" autofocus value="<?php echo $plan->plan_name ?>"/>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="discount_fixed">Status</label>
                                    <select readonly="" disabled="" name="status" class="groups-select form-control">
                                        <option value="1" <?php if($plan->status==1) echo 'slected'; ?>>Actived</option>
                                        <option value="0" <?php if($plan->status==0) echo 'slected'; ?>>Deactived</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-6">
                                        <h5>Items</h5>
                                    </div>
                                    </div>									
                                <table class="nsm-table">
                                    
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
                                        <?php 
                                        $i=0;
                                        if($plan->items!=''){
                                            ?>
                                            <input type="hidden" name="count" value="<?php echo count(unserialize($plan->items))-1; ?>" id="count">
                                        <?php
                                            foreach(unserialize($plan->items) as $row){ ?>
                                            <tr>
                                                <td><input readonly="" disabled="" type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]" value="<?php echo $row['item'] ?>"><ul class="suggestions"></ul></td>
                                                <td><select readonly="" disabled="" name="item_type[]" class="form-control">
                                                    <option value="product" <?php if($row['item_type']=='product') echo 'selected'; ?>>Product</option>
                                                    <option value="material" <?php if($row['item_type']=='material') echo 'selected'; ?>>Material</option>
                                                    <option value="service" <?php if($row['item_type']=='service') echo 'selected'; ?>>Service</option>
                                                    </select></td>
                                                <td><input readonly="" disabled="" type="text" class="form-control quantity" name="quantity[]" value="<?php echo $row['quantity'] ?>" data-counter="<?=$i?>" id="quantity_<?=$i?>"></td>
                                                <!-- <td><input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>"></td> -->
                                                <td><input readonly="" disabled="" type="number" class="form-control price" name="price[]" data-counter="<?=$i?>" id="price_<?=$i?>" min="0" value="<?php echo $row['price'] ?>"></td>
                                                <td><input readonly="" disabled="" type="number" class="form-control discount" name="discount[]" data-counter="<?=$i?>" id="discount_<?=$i?>" min="0" value="<?php echo $row['discount'] ?>" readonly></td>
                                                <td><span id="span_tax_<?=$i?>"><?php echo number_format($row['tax'], 2); ?></span></td>
                                                <td>
                                                    <?php 
                                                        $total = ($row['quantity'] * $row['price'] + $row['tax']) - $row['discount'];
                                                    ?>
                                                    <span id="span_total_<?=$i?>"><?php echo number_format($total, 2); ?></span>
                                                </td>
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
                                <!-- <a href="#" class="btn btn-primary" id="add_another">Add Items</a> -->
                            </div>	 
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-3 text-end">   
                                <a class="nsm-button" href="<?php echo base_url('plans'); ?>">Back To Plan List</a>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('v2/includes/footer'); ?>
