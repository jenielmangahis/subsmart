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
.remove{
    display:block;
    width:38px;
    float:right;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
#plan-item-list thead td, #estimate-items-table thead td {
    background-color: #6a4a86;
    color: #ffffff;
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
                                Edit Estimate Plan.
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
                    <?php echo form_open(null, ['class' => 'form-validate', 'id' => 'frm-update-plan']); ?>
                        <input type="hidden" name="pid" value="<?= $plan->id; ?>" />
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="formClient-Name">Name *</label>
                                    <input type="text" class="form-control" name="plan_name" id="formClient-Name" required placeholder="Enter Name" autofocus value="<?php echo $plan->plan_name ?>"/>
                                </div>
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="discount_fixed">Is Enabled</label>
                                    <select name="status" class="groups-select form-control">
                                        <option value="1" <?php if($plan->status==1) echo 'slected'; ?>>Yes</option>
                                        <option value="0" <?php if($plan->status==0) echo 'slected'; ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <?php 
                                    $i=0;
                                    $plan_items  = unserialize($plan->items);
                                    $count_items = 0;
                                    if( $plan_items > 0 ){
                                        $count_items = count($plan_items)-1;
                                    }
                                ?>		
                                <input type="hidden" name="count" value="<?php echo $count_items; ?>" id="count">				
                                <table class="nsm-table" id="plan-item-list">
                                    <thead>
                                        <tr>
                                            <td data-name="Description">Description</td>
                                            <td data-name="Type">Type</td>
                                            <td data-name="Quantity">Quantity</td>
                                            <td data-name="Cost">Cost</td>
                                            <td data-name="Discount">Discount</td>
                                            <td data-name="Tax">Tax</td>
                                            <td data-name="Description" style="text-align: right;">Total</td>
                                            <td data-name="Manage"></td>
                                        </tr>
                                    </thead>
                                    <tbody id="jobs_items_table_body">
                                        <?php if($plan_items!=''){
                                            $total = 0;
                                            foreach($plan_items as $row){ 
                                                $total = $row['tax'] + $row['price'];
                                                ?>
                                                <tr>
                                                    <td width="30%">
                                                        <input type="hidden" class="form-control" name="item_id[]" value="<?php echo $row['item_id']; ?>">
                                                        <input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="items[]" value="<?php echo $row['item']; ?>">
                                                    </td>
                                                    <td width="20%"><select name="item_type[]" class="form-control">
                                                        <option value="product" <?php if($row['item_type']=='product') echo 'selected'; ?>>Product</option>
                                                        <option value="material" <?php if($row['item_type']=='material') echo 'selected'; ?>>Material</option>
                                                        <option value="service" <?php if($row['item_type']=='service') echo 'selected'; ?>>Service</option>
                                                        </select></td>
                                                    <td width="10%"><input type="text" class="form-control quantity" name="quantity[]" value="<?php echo $row['quantity'] ?>" data-counter="<?=$i?>" id="quantity_<?=$i?>"></td>
                                                    <!-- <td><input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>"></td> -->
                                                    <td width="10%"><input readonly type="number" step="any" class="form-control price" name="price[]" data-counter="<?=$i?>" id="price_<?=$i?>" min="0" value="<?php echo number_format($row['price'],2,".",""); ?>"></td>
                                                    <td><input type="number" class="form-control discount" name="discount[]" data-counter="<?=$i?>" id="discount_<?=$i?>" min="0" value="<?php echo $row['discount'] ?>"></td>
                                                    <td width="10%">
                                                        <input type="text" data-itemid="<?=$i?>" class="form-control tax_change valid" name="tax[]" data-counter="<?=$i?>" id="tax1_<?=$i?>" readonly="" min="0" value="<?php echo $row['tax']; ?>" aria-invalid="false">
                                                    </td>
                                                    <td width="10%" style="text-align: right;">
                                                        <?php 
                                                            $total = $row['price'] * $row['quantity'];
                                                            $total = $total + $row['tax'];
                                                            $total = $total - $row['discount'];
                                                        ?>
                                                        <span id="span_total_<?=$i?>"><?= number_format($total, 2,".",""); ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="remove nsm-button danger remove" id="<?= $row['item_id']; ?>"><i class='bx bx-trash'></i></a>
                                                    </td>
                                                </tr>	
                                            <?php $i++; } ?>										
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <a href="javascript:void(0);" class="nsm-button" id="btn-add-items">Add Items</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-3 text-end">									
                                <button type="button" class="nsm-button back">Cancel</button>
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
<?php include viewPath('v2/includes/plans/add_modal') ?>
<!-- page wrapper end -->
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script>
   $(document).ready(function() {        
    $('.check-select-all-p').on('change', function() {
        $('.check-select-p').attr('checked', $(this).is(':checked'));
    });

    $('.select2').select2();

    $('#estimate-items-table').nsmPagination({itemsPerPage:8});
    $("#items_search_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $('#btn-add-items').on('click', function(){
        $('#estimate-items-table').nsmPagination({itemsPerPage:8});
        $('#item_list').modal('show');
    });

    $('#frm-update-plan').on('submit', function(e){
      e.preventDefault();

      let _this = $(this);

      var url = base_url + "plans/_update_estimate_plan";
      _this.find("button[type=submit]").html("Saving");
      _this.find("button[type=submit]").prop("disabled", true);

      $.ajax({
          type: 'POST',
          url: url,
          data: _this.serialize(),
          dataType:"json",
          success: function(result) {
              if (result.is_success) {
                  Swal.fire({
                      title: 'Estimate Plan',
                      text: "Plan was has been updated successfully.",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Okay'
                  }).then((result) => {
                      //if (result.value) {
                          location.href= base_url + "plans";
                      //}
                  });
              } else {
                  Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      html: result.msg
                  });
              }                    

              _this.find("button[type=submit]").html("Save");
              _this.find("button[type=submit]").prop("disabled", false);
          },
      });
    });

     $(document).on('click', '.select_item2a', function(){     
      // taxRate();
          var idd = this.id;
          var title = $(this).data('itemname');
          var price = parseInt($(this).attr('data-price'));
          // var qty = parseInt($(this).attr('data-quantity'));
          var location_name = $(this).data('location_name');
          var location_id = $(this).data('location_id');
          var item_type = $(this).data('item_type');
          if(!$(this).data('quantity')){
            var qty = 1;
          }else{
            var qty = $(this).data('data-quantity');
          }
          var return_first = function () {
              var tax_rate = null;
              $.ajax({
                  'async': false,
                  type : 'POST',
                  url: "<?php echo base_url(); ?>/workorder/getTaxRate",
                  success: function(result){
                      tax_rate = result;
                  }
              });
          return tax_rate;
          }();

          // alert(return_first);
          var json = $.parseJSON(return_first);
          var tax_rate_ = 0;
          for (var i=0;i<json.length;++i)
          {
              tax_rate_ = json[i].rate;
          }
          // alert(tax_rate_);
          var taxRate = tax_rate_;

          var count = parseInt($("#count").val()) + 1;
          $("#count").val(count);
          var total_ = price * qty;
          var tax_ =(parseFloat(total_).toFixed(2) * taxRate) / 100;
          var taxes_t = parseFloat(tax_).toFixed(2);
          var total = parseFloat(total_).toFixed(2);
          var withCommas = Number(total).toLocaleString('en');
          //total = '$' + withCommas + '.00';
          total = withCommas + '.00';
          $("#ITEMLIST_PRODUCT_"+idd).hide();
          if( item_type == 'Product' ){
              var item_type_dropdown = '<select name="item_type[]" class="form-control"><option selected="selected" value="product">Product</option><option value="service">Service</option><option value="fee">Fee</option></select>';
          }else if( item_type == 'Fees' ){
              var item_type_dropdown = '<select name="item_type[]" class="form-control"><option value="product">Product</option><option value="service">Service</option><option selected="selected" value="fee">Fee</option></select>';
          }else if( item_type == 'Service' ){
              var item_type_dropdown = '<select name="item_type[]" class="form-control"><option value="product">Product</option><option  selected="selected" value="service">Service</option><option value="fee">Fee</option></select>';
          }else{
              var item_type_dropdown = '<select name="item_type[]" class="form-control"><option selected="selected" value="product">Product</option><option  value="service">Service</option><option value="fee">Fee</option></select>';
          }
          markup = '<tr id="row'+ idd +'">' +
              "<td width=\"30%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
              "<td width=\"20%\"><div class=\"dropdown-wrapper\">"+item_type_dropdown+"</div></td>\n" +
              "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
              // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
              "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price.toFixed(2)+"'  type=\"number\" step=\"any\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+count+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price.toFixed(2)+"</span></div></td>\n" +
              // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
              // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
              "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
              // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
              "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
              "<td style=\"text-align: right\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
              // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
              "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
              "<td>\n" +
              "<a href=\"#\" class=\"remove nsm-button danger\" id='"+count+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
              "</td>\n" +
              "</tr>"
          ;
        tableBody = $("#jobs_items_table_body");          
        tableBody.append(markup);

        is_Confirm = 1;
    });

     
   });
   var is_Confirm = 0;
    $(document).on("click", ".remove", function (e) {
        is_Confirm = 1;
    })
    $(document).on("click", ".back", function (e) {
        if(is_Confirm == 1){
            confirm();
        }else{
            location.href= '<?= base_url('plans'); ?>';
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