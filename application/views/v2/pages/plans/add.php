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
</style>

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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="discount_fixed">Status</label><br />
                                            <select name="status" class="groups-select form-control" >
                                                <option value="1">Actived</option>
                                                <option value="0">Deactived</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-6">
                                        <h5>Assign Items</h5>
                                    </div>
                                    <div class="col-sm-6" style="text-align: right;">
                                        <a href="#" class="nsm-button primary small" id="add_another_old" data-bs-toggle="modal" data-bs-target="#item_list"><i class="fa fa-plus"></i> Add Items</a>
                                    </div>
                                    <div class="col-sm-12">
                                        <table class="nsm-table">
                                            <input type="hidden" name="count" value="0" id="count">
                                            <thead>
                                                <tr>
                                                    <th>DESCRIPTION</th>
                                                    <th>Type</th>
                                                    <th width="100px">Quantity</th>
                                                    <!-- <th>LOCATION</th> -->
                                                    <th width="100px">COST</th>
                                                    <th width="100px">Discount</th>
                                                    <th>Tax(7.5%)</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jobs_items_table_body"></tbody>
                                        </table>
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
<?php include viewPath('v2/pages/plans/modals/add_modal') ?>
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/custom.js"></script>

<script>
   $(document).ready(function() {
     $('.form-validate').validate();
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
   });
</script>
<script>
   $('.select2').select2();
</script>
