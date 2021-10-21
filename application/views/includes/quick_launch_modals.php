<!-- MODAL ADD CUSTOMER -->
<div class="modal fade modal-enhanced" id="modal-ql-add-customer" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Quick Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frm-ql-add-customer" method="post">
            <input type="hidden" id="ql-customer-open-modal" value="">
            <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                <div class="form-group">
                  <label for="" style="width:100%;text-align: left;">Customer Name</label>
                  <div class="row g-3">
                    <div class="col-sm-4">
                      <input type="text" name="ql_customer_first_name" class="form-control" placeholder="Firstname" aria-label="Firstname" required="" />
                    </div>
                    <div class="col-sm-4">
                      <input type="text" name="ql_customer_middle_name" class="form-control" placeholder="Middlename" aria-label="Middlename" required="" />
                    </div>
                    <div class="col-sm-4">
                      <input type="text" name="ql_customer_last_name" class="form-control" placeholder="Lastname" aria-label="Lastname" required="" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" style="width:100%;text-align: left;">Business Name</label>
                  <div class="row g-3">
                    <div class="col-sm-12">
                      <input type="text" name="ql_business_name" class="form-control" placeholder="Business Name" aria-label="Business Name" required="" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row g-3">
                    <div class="col-sm-6">
                      <label for="" style="width:100%;text-align: left;">Email</label>
                      <input type="text" name="ql_customer_email" class="form-control" placeholder="Email Address" aria-label="Firstname" required="" />
                    </div>
                    <div class="col-sm-6">
                      <label for="" style="width:100%;text-align: left;">Mobile Number</label>
                      <input type="text" name="ql_customer_phone_number" class="form-control" placeholder="Mobile Number" aria-label="Firstname" required="" />
                    </div>
                  </div>
                </div>
              <!-- <div class="form-group">
                <div class="row g-3">
                  <div class="col-sm-12">
                    <label for="" style="width:100%;text-align: left;">Address</label>
                    <input type="text" name="ql_first_name" class="form-control field-popover" placeholder="Email Address" aria-label="Firstname" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row g-3">
                  <div class="col-sm-6">
                    <label for="" style="width:100%;text-align: left;">State</label>
                    <input type="text" name="ql_first_name" class="form-control field-popover" placeholder="Email Address" aria-label="Firstname" />
                  </div>
                  <div class="col-sm-6">
                    <label for="" style="width:100%;text-align: left;">ZIP</label>
                    <input type="text" name="ql_first_name" class="form-control field-popover" placeholder="Phone Number" aria-label="Firstname" />
                  </div>
                </div>
              </div>
            </div> -->
          </div>
          <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
            <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-ql-add-customer" name="action" value="create_appointment">Save</button>
          </div>
          </form>
      </div>
  </div>
</div>