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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
   

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">New Credit Note</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add a new credit note.</li>
                        </ol>
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
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('estimate/save', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
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
                                    <input type="text" class="form-control" name="estimate_number" id="estimate_date"
                                           required placeholder="" autofocus value="<?php echo $auto_increment_estimate_id; ?>" 
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">Date Issued</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="estimate_date" id="estimate_date"
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
                                            <td><input type="text" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                                            <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                            <td><span id="span_total_0">0.00</span></td>
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
                                            <td>Subtotal</td>
                                            <td class="d-flex align-items-center">$<span id="total_due">0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Adjustment</td>
                                            <td class="d-flex align-items-center">$<span id="total_due">0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td class="d-flex align-items-center">$<span id="total_due">0.00</span>
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

            <!-- Modal Additional Contact -->
            <div class="modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
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
    <!-- page wrapper end -->
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer'); ?>

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

    $(document).ready(function () {
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
            '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
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
            '<input type="number" class="form-control discount" name="discount[]" data-counter="' +
            count +
            '" id="discount_' +
            count +
            '" min="0" value="0" readonly>\n' +
            "</td>\n" +
            "<td>\n" +
            '<span id="span_tax_' +
            count +
            '">0.00 (7.5%)</span>\n' +
            "</td>\n" +
            "<td>\n" +
            '<span id="span_total_' +
            count +
            '">0.00</span>\n' +
            "</td>\n" +
            "<td>\n" +
            '<a href="#" class="remove btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>\n' +
            "</td>\n" +
            "</tr> ";

            $(html).hide().appendTo("#table_body").fadeIn(500);
        });
    });
</script>