<?php include viewPath('v2/includes/header'); ?>

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
label>input {
  visibility: initial !important;
  position: initial !important; 
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
.getItems_hidden{
  display: none;
}
.show_mobile_view{
  display: none;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
.remove{
    display:block;
    width:38px;
    float:right;
}
</style>

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
                                Add New Company Plan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <?php echo form_open('plans/save', [ 'class' => 'form-validate' ]); ?>
                <div class="nsm-card">
                    <div class="nsm-card-content">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                        <label for="formClient-Name">Package Name *</label>
                                        <input type="text" class="form-control" name="plan_name" id="formClient-Name" required placeholder="Enter Name" autofocus />
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="discount_fixed">Status</label><br />
                                            <select name="status" class="groups-select form-control" >
                                                <option value="1">Actived</option>
                                                <option value="0">Deactived</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-sm-6">
                                        <h5>Assign Items</h5>
                                    </div>                                    
                                    <div class="col-sm-12">
                                        <table class="table table-hover">
                                            <input type="hidden" name="count" value="0" id="count">
                                            <thead style="background-color:#E9E8EA;">
                                              <tr>
                                                  <th>Description</th>
                                                  <th>Type</th>                                                  
                                                  <th width="150px">Quantity</th>                                                  
                                                  <th width="150px">Cost</th>
                                                  <th class="hidden_mobile_view" width="150px">Discount</th>
                                                  <th class="hidden_mobile_view" width="150px">Tax(7.5%)</th>
                                                  <th class="hidden_mobile_view">Total</th>
                                                  <th class="hidden_mobile_view"></th>
                                              </tr>
                                            </thead>                                            
                                            <tbody id="jobs_items_table_body"></tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <a href="#" class="nsm-button primary small" id="add_another_old" data-bs-toggle="modal" data-bs-target="#item_list"><i class='bx bxs-plus-square'></i> Add Items</a>
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3 text-end">                  
                    <button type="submit" class="nsm-button" onclick="location.href='<?php echo base_url('plans'); ?>'">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- Modal -->
<?php include viewPath('v2/includes/plans/add_modal') ?>
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/custom.js"></script>

<script>
  $(document).ready(function() {
      var ITEMS_TABLE = $('#items_table').DataTable({
          "ordering": false,
      });

      $("#ITEM_CUSTOM_SEARCH").keyup(function() {
          ITEMS_TABLE.search($(this).val()).draw()
      });

     $('.select2').select2();
     //$('.form-validate').validate();
     $('.check-select-all-p').on('change', function() {
       $('.check-select-p').attr('checked', $(this).is(':checked'));
     });

     $('.table-DT').DataTable({
       "ordering": false,
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
              "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
              "<td width=\"20%\"><div class=\"dropdown-wrapper\">"+item_type_dropdown+"</div></td>\n" +
              "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
              // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
              "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+count+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
              // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
              // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
              "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
              // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
              "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
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
    });
  });
</script>
