<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style>
.custom__border .card-body>.row {
    background: none !important;
}
.custom__border .card-body>.row {
    border-bottom: 0;
    padding-bottom: 20px;
    margin-bottom: 20px;
    background: #f2f2f2;
     padding: 0px !important;
    margin: 0;
    /* margin-bottom: 20px; */
    /* border-radius: 8px; */
}
.dropdown .btn {
    position: relative;
    top:12px;
}
.subtle-txt {
    color: rgba(42, 49, 66, 0.7);
}
.form-control-block {
    display: block;
    width: 100%;
    color: #363636;
    font-size: 16px;
    border-radius: 2px;
    height: 27px;
    padding: 3px 0 0 0;
    text-align: center;
}
.item-link-sm {
    font-style: italic;
    font-size: 12px;
    color: #8f8f8f;
    display: none;
}
.float-right.d-none.d-md-block {
    position: relative;
    bottom: 11px;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  margin-bottom: 0px !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
<div class="wrapper" role="wrapper">

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <?php echo form_open_multipart('credit_notes/update', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <input type="hidden" id="inst_cost" value="0">
            <input type="hidden" id="one_time" value="0">
            <input type="hidden" id="m_monitoring" value="0">

            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div>
                            <div class="row align-items-center">
                              <div class="col-sm-6">
                                  <h3 class="page-title mt-0">New Credit Note</h3>
                              </div>
                              <div class="col-sm-6">
                                  <div class="float-right d-none d-md-block">
                                      <div class="dropdown">
                                          <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                              <a href="<?php echo base_url('credit_notes') ?>" class="btn btn-primary"
                                                 aria-expanded="false">
                                                  <i class="mdi mdi-settings mr-2"></i> Go Back to Credit Note List
                                              </a>
                                          <?php //endif ?>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="pl-3 pr-3 mt-2 row">
                              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add a new credit note.</span>
                              </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 form-group">
                                    <label for="customers">Customer</label>
                                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option></option>
                                        <?php foreach($customers as $c){ ?>
                                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="job_name">Job Name</label>
                                    <span class="help help-sm">(optional)</span>
                                    <input type="text" class="form-control" name="job_name" id="job_name"
                                           placeholder="" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">Credit Note#</label>
                                    <input type="text" class="form-control" name="credit_note_number" id="estimate_date"
                                           required placeholder="" autofocus value="<?php echo $auto_increment_estimate_id; ?>"
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">Date Issued</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="date_issued" id="estimate_date"
                                               placeholder="">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="expiry_date" id="expiry_date"
                                               placeholder="">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="plansItemDiv">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover table-items">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead>
                                        <tr style="background-color: #b8b8b8;">
                                            <th colspan="8"><b>Manage items</b></th>
                                        </tr>
                                        <tr style="background-color: #b8b8b8;font-weight: bold;">
                                            <th><b>Type</b></th>
                                            <th><b>Item</b></th>
                                            <th width="100px"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th><b>Tax(%)</b></th>
                                            <th><b>Total</b></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        <tr>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                </select></td>
                                            <td><input type="text" class="form-control getItems"
                                                       onKeyup="creditNoteGetItems(this)" name="item[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control itemid" name="itemIds[]" id="itemid_0" value="0">
                                                <input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1">
                                            </td>
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn-set-discount" data-id="0">
                                                    <span class="form-control-block">
                                                        <span class="discount-0">0.00</span>
                                                    </span>
                                                    <input type="hidden" class="form-control discount" name="discount[]" data-counter="0" id="discount_0" value="0"readonly>
                                                    <i class="item-link-sm">set discount</i>
                                                </a>

                                            </td>
                                            <td>
                                                <input type="hidden" name="tax[]" id="tax_0" value="">
                                                <span id="span_tax_0">0.00 (7.5%)</span>
                                            </td>
                                            <td>
                                                <input type="hidden" name="itemTotal[]" id="item_total_0" value="">
                                                <span id="span_total_0">0.00</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a href="javascript:void(0);" class="btn btn-primary" id="credit-note-add-item">Add Item</a>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Equipment Cost</td>
                                            <td class="d-flex align-items-center">
                                                <input type="text" value="0.00" name="eqpt_cost" id="eqpt_cost" readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales Tax</td>
                                            <td class="d-flex align-items-center">
                                                <input type="text" value="0.00" name="sales_tax" id="sales_tax" readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Discount</td>
                                            <td class="d-flex align-items-center">
                                                <input type="text" value="0.00" name="total_discount" id="total_discount" readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="adjustment_name" placeholder="Adjustment"></td>
                                            <td class="d-flex align-items-center">
                                                <input type="text" name="adjustment_total" value="0.00" id="adjustment-total" class="form-control" style="margin-right: 11px; width: 16%;">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td class="d-flex align-items-center">
                                                <input type="text" value="0.00" name="total_due" id="g_total_due" readonly class="form-control">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Message to Customer</label> <span class="help help-sm help-block">Add a message that will be displayed on the estimate.</span>
                                        <textarea name="customer_message" cols="40" rows="2" class="form-control">I would be happy to have an opportunity to work with you.</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Terms &amp; Conditions</label> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Save as Draft</button>
                                    <a href="<?php echo url('credit_notes') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Discount -->
            <div class="modal fade" id="modalAddDiscount" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Set Discount</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="margin-bottom">Set fixed or percent discount. Input 0 to remove the discount.</p>
                            <form name="discount-modal-form" class="discount-form">
                                <input type="hidden" id="row-id" value="0">
                                <input type="hidden" id="discount-type" value="percent">
                                <div class="form-inline">
                                    <div class="btn-group margin-right-sec" role="group">
                                        <button class="btn btn-primary" type="button" name="discount_type_percent">%</button>
                                        <button class="btn btn-default" type="button" name="discount_type_amount">$</button>
                                    </div>
                                    <input class="form-control" name="discount_value" id="discount_value" value="0" type="text" style="width: 260px;">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-apply-discount">Set Discount</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="source_name" value="" class="form-control"
                                           autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

        <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
    function creditNoteGetItems(obj) {
      var sk = jQuery(obj).val();
      var site_url = jQuery("#siteurl").val();
      jQuery.ajax({
        url: site_url + "items/getitems",
        data: { sk: sk },
        type: "GET",
        success: function (data) {
          /* alert(data); */
          jQuery(obj).parent().find(".suggestions").empty().html(data);
        },
        error: function () {
          alert("An error has occurred");
        },
      });
    }

    function addAdjustment(){
        var adjustment_amount = $("#adjustment-total").val();
        var total_due         = $("#g_total_due").val();

        var new_total_due = parseFloat(total_due) + parseFloat(adjustment_amount);
        $("#g_total_due").val(new_total_due.toFixed(2));
    }

    $(document).ready(function () {
        $("#adjustment-total").focusout(function(){
          var count = $("#count").val();
          calculation(count);
          addAdjustment();
        });

        $('button[name="discount_type_percent"]').click(function(){
            $("#discount-type").val("percent");

            $(this).addClass('btn-primary');
            $(this).removeClass('btn-default');

            $('button[name="discount_type_amount"]').removeClass('btn-primary');
            $('button[name="discount_type_amount"]').addClass('btn-default');
        });

        $('button[name="discount_type_amount"]').click(function(){
            $("#discount-type").val("amount");

            $(this).addClass('btn-primary');
            $(this).removeClass('btn-default');

            $('button[name="discount_type_percent"]').removeClass('btn-primary');
            $('button[name="discount_type_percent"]').addClass('btn-default');
        });

        $(".btn-set-discount").click(function(){
            var row_id = $(this).attr("data-id");

            $("#row-id").val(row_id);
            $("#modalAddDiscount").modal('show');
        });

        $(".btn-apply-discount").click(function(){
            var row_id = $("#row-id").val();
            var price  = $("#price_"+row_id).val();
            var qty    = $("#quantity_"+row_id).val();
            var d_type = $("#discount-type").val();
            var discount_amount = $("#discount_value").val();

            if( discount_amount > 0 ){
                if( d_type == 'percent' ){
                    var total_discount = parseFloat(price) * (parseFloat(discount_amount) / 100);
                }else{
                    var total_discount = parseFloat(discount_amount);
                }
            }else{
                var total_discount = 0;
            }

            $("#discount_"+row_id).val(total_discount);

            calculation(row_id);

            $("#discount_value").val(0);
            $(".discount-"+row_id).html(total_discount.toFixed(2));
            $("#modalAddDiscount").modal('hide');
        });

        $("#sel-customer").select2({
            placeholder: "Select Customer"
        });

        $("#credit-note-add-item").click(function(){
            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);

            var html =
            "<tr>\n" +
            '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +
            "<td>\n" +
            '<input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul>\n' +
            "</td>\n" +
            "<td>\n" +
            '<input type="hidden" class="form-control itemid" name="itemIds[]" id="itemid_' + count +'" value="0"><input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
            count +
            '" id="quantity_' +
            count +
            '" value="1">\n' +
            "</td>\n" +
            "<td>\n" +
            '<input type="number" class="form-control price" name="price[]" data-counter="' +
            count +
            '" id="price_' +
            count +
            '" min="0" value="0">\n' +
            "</td>\n" +
            "<td>\n" +
            '<a href="javascript:void(0);" class="btn-set-discount" data-id="' + count + '"><span class="form-control-block"><span class="discount-' + count + '">0.00</span></span><i class="item-link-sm">set discount</i></a><input type="hidden" class="form-control discount" name="discount[]" data-counter="0" id="discount_'+count+'" value="0"readonly>' +
            "</td>\n" +
            "<td>\n" +
            '<span id="span_tax_' +
            count +
            '">0.00 (7.5%)</span>\n' +
            "<input type='hidden' name='tax[]'' id='tax_" + count + "' value=''></td>\n" +
            "<td>\n" +
            '<span id="span_total_' +
            count +
            '">0.00</span>\n' +
            "<input type='hidden' name='itemTotal[]'' id='item_total_" + count + "' value=''></td>\n" +
            "<td>\n" +
            '<a href="#" class="remove btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>\n' +
            "</td>\n" +
            "</tr> ";

            $(html).hide().appendTo("#table_body").fadeIn(500);

            $(".btn-set-discount").click(function(){
                var row_id = $(this).attr("data-id");

                $("#row-id").val(row_id);
                $("#modalAddDiscount").modal('show');
            });
        });
    });
</script>
