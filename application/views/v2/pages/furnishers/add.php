<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Add New Creditor/Furnisher
                        </div>
                    </div>
                    <?php echo form_open_multipart('', ['class' => 'form-validate require-validation', 'id' => 'frm-create-furnisher', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div>
                            <div class="row align-items-center">
                              <div class="col-sm-6">
                                  <h3 class="page-title mt-0">Add New Creditor/Furnisher</h3>
                              </div>
                              <div class="col-sm-6">
                                  <div class="float-right d-none d-md-block">
                                      <div class="dropdown">
                                          <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                              <a href="<?php echo base_url('creditor_furnisher/list') ?>" class="btn btn-primary"
                                                 aria-expanded="false">
                                                  <i class="mdi mdi-settings mr-2"></i> Go Back to Creditor/Furnisher List
                                              </a>
                                          <?php //endif ?>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="pl-3 pr-3 mt-2 row">
                              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add a new Creditor/Furnisher.</span>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="f-name">Company name</label>
                                    <input type="text" class="form-control" name="f_company_name" id="f-name" placeholder="" required/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="f-account-type">Account Type</label>
                                    <input type="text" class="form-control" name="f_account_type" id="f-account-type" placeholder="" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="f-address">Address</label>
                                    <input type="text" class="form-control" name="f_address" id="f-address" placeholder="" required/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">City</label>
                                    <input type="text" class="form-control" name="f_city" id="" placeholder="" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="f-state">State</label>
                                    <input type="text" class="form-control" name="f_state" id="f-state" placeholder="" required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="estimate_date">Zip Code</label>
                                    <input type="text" class="form-control" name="f_zipcode" id="" placeholder="" required/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="f-phone">Phone</label><br />
                                    <input type="text" class="form-control" name="f_phone" id="f-phone" placeholder="" required style="display:inline-block;width: 40%;" />
                                    <input type="text" class="form-control" name="f_ext" id="" placeholder="Ext" required style="display:inline-block; width: 25%;"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="f-note">Note</label>
                                    <textarea class="form-control" name="f_note" id="f-note" style="height:100px;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary btn-create-furnisher">Save</button>
                                    <a href="<?php echo url('creditor_furnisher/list') ?>" class="btn btn-primary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include viewPath('v2/includes/footer'); ?>