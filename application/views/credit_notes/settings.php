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
  padding-top: 19px !important;
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
            <?php echo form_open_multipart('credit_notes/update_settings', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                      <div class="page-title-box" style="padding:5px 0 0 0;">
                          <div class="row align-items-center">
                              <div class="col-sm-6">
                                  <h3 class="page-title mt-0">Settings</h3>
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item active"></li>
                                  </ol>
                              </div>
                          </div>
                      </div>
                      <div class="pl-3 pr-3 mt-0 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                        </div>
                      </div>
                      <div class="form-group mt-2">
                            <label>Credit Note Number</label>
                            <div class="help help-sm help-block">Set the prefix and the next auto-generated number.</div>
                            <br />
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="margin-bottom-qui">Prefix</div>
                                    <input type="text" name="credit_note_number_prefix" value="<?= $settings->credit_note_number_prefix . '-'; ?>" class="form-control" autocomplete="off">
                                </div>
                                <?php
                                    $next_number = str_pad($settings->credit_note_number_next_number, 5, '0', STR_PAD_LEFT);
                                ?>
                                <div class="col-sm-5">
                                    <div class="margin-bottom-qui">Next number</div>
                                    <input type="text" name="credit_note_number_next_number" value="<?= $next_number; ?>" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <hr style="margin:44px;" />
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="margin-bottom-qui">Default Message</div>
                                    <textarea name="message" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""></textarea>
                                </div>
                                <div class="col-sm-5">
                                    <div class="margin-bottom-qui">Default Terms & Condition</div>
                                    <textarea name="terms" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""></textarea>
                                </div>
                            </div>
                            <br /><br />
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Save Changes</button>
                                    <a href="<?php echo base_url('credit_notes') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Credit Note List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>

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
