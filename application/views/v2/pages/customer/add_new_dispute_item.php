<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
.list-cb-account-numbers{
    margin-top: 10px;
}
.list-cb-account-numbers li{
    margin: 5px;
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
.cb-list{
    padding: 0px;
    list-style: none;
    margin: 0px;
}
.cb-list li{
    display: block;
    width: 200px;
    margin: 13px;
}
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

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
                            Add dispute item
                        </div>
                    </div>
                </div>
                <div class="row">
                     <?php echo form_open_multipart('', ['class' => 'form-validate require-validation', 'id' => 'frm-create-dispute-item', 'autocomplete' => 'off']); ?>
            <input type="hidden" name="cus_id" id="cid" value="<?= $cid; ?>">
            <div class="row custom__border">
                <div class="col-xl-12">
                        <div>
                            <div class="row align-items-center">
                              <div class="col-sm-6">
                                <h2 class="page-title" style="display:inline-block;">Add Item </h2>
                                <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                              </div>
                              <div class="col-sm-6">
                                  <div class="float-right d-none d-md-block">
                                      <div class="dropdown">                                          
                                          <a href="<?php echo base_url('customer/credit_industry/'.$cid) ?>" class="btn btn-primary"
                                             aria-expanded="false">
                                              <i class="mdi mdi-settings mr-2"></i> Go Back to Credit Industry List
                                          </a>                                          
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="job_name">Select Credited Bureaus</label>
                                    <ul class="cb-list">
                                    <?php foreach($creditBureaus as $cb){ ?>
                                        <li>
                                            <div class="form-check">
                                              <input class="form-check-input cb-check" data-name="<?= $cb->name; ?>" data-id="<?= $cb->id; ?>" data-logo="<?= $cb->logo; ?>" type="checkbox" value="<?= $cb->id; ?>" name="creditedBureau[]" id="cb-<?= $cb->id; ?>" />
                                              <label class="form-check-label" for="cb-<?= $cb->id; ?>">
                                                <img style="width:97px;" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>" alt="<?= $cb->name; ?>" />
                                              </label>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">Creditor / Furnisher</label>
                                    <select class="company-furnishers form-control" name="furnisher_id"></select>                                    
                                    <a class="btn btn-sm btn-primary btn-add-creditor-furnisher" href="javascript:void(0);" style="margin-top:5px;">Add Creditor/Furnisher</a>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">Account Numbers (opt)</label>
                                    <select class="form-control" name="account_number_opt" id="account-number-type">
                                        <option value="acc_num_same">Same for all bureaus</option>
                                        <option value="acc_num_diff">Different for each bureau</option>
                                    </select>

                                    <div class="cb-account-number-all">
                                        <input type="text" class="form-control" name="account_number_all" placeholder="Account Number">
                                    </div>
                                    <div class="cb-account-number-diff" style="display:none;">
                                        <ul class="list-cb-account-numbers">
                                            <?php foreach($creditBureaus as $cb){ ?>
                                                <li class="cb-account-<?= $cb->id; ?>" style="display: none;">
                                                    <label><?= $cb->name; ?></label><br />
                                                    <input type="text" class="form-control" name="cb_account_number[<?= $cb->id; ?>]" placeholder="Account Number" />
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- <div class="cb-acccount-numbers-container">
                                        <input type="text" class="form-control" name="account_number_all" placeholder="Account Number">
                                    </div> -->
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="estimate_date">Reason</label>
                                    <select class="company-reasons form-control" name="dispute_reason"></select>
                                    <span style="font-size:13px;margin-top: 4px; margin-bottom: 4px;display: block;">(if you can't find an appropriate reason. choose "other information i would like to changed")</span><br />
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-manage-reasons">Manage Reasons</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group grp-option-instructions">
                                    <label for="estimate_date">Instructions</label>
                                    <select class="company-instructions form-control" name="list_instruction"></select>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-add-new-instruction">Add New Instructions</a>
                                </div>
                                <div class="col-md-4 form-group grp-add-instructions" style="display: none;">
                                    <label for="estimate_date">Instructions</label>
                                    <input type="text" class="form-control" name="new_instruction" id="new-instruction" style="margin-bottom: 10px;" />
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-list-instructions">Choose from list</a><br /><br />
                                    <small style="display: block;margin-bottom: 5px;">(i.e: "This is not my account. Please remove")</small>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="save-new-instruction" name="create_instruction" value="1">
                                      <label class="form-check-label" for="save-new-instruction">
                                        Save "explaination" for future use
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div style="display: block; width: 100%;background-color: #32243d; color: #ffffff; ">
                                    <h3 style="font-size: 15px; padding: 10px; display:inline-block; width: 30%;">OTHER FIELDS</h3>
                                    <select class="opt-other-fields form-control" name="other_fields_type" style="width: 16%;float: right;margin-top: 6px !important; margin-right:10px !important;">
                                        <option value="same">Same for all bureaus</option>
                                        <option value="diff">Different for each bureau</option>
                                    </select>
                                </div>

                                <div class="other-fields-group" style="width: 100%;">
                                    <?php include_once('dispute_other_fields/group.php'); ?>
                                </div>
                                <div class="other-fields-individual" style="display: none; width: 100%;">
                                    <?php include_once('dispute_other_fields/individual.php'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group" style="margin-top: 20px !important;">
                                    <button type="submit" class="btn btn-flat btn-primary btn-create-dispute-item">Save</button>
                                    <a href="<?php echo url('customer/credit_industry/'.$cid) ?>" class="btn btn-primary">Cancel</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <?php echo form_close(); ?>

            <!-- Modal Create Creditor / Furnisher -->
            <div class="modal fade bd-example-modal-md" id="modal-create-creditor-furnisher" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add Creditor/Furnisher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>     
                    <?php echo form_open_multipart('', ['class' => 'form-validate require-validation', 'id' => 'frm-quick-add-furnisher', 'autocomplete' => 'off']); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group" style="margin-bottom:8px !important;">
                                <label for="">Creditor/Furnisher Name *</label>
                                <input type="text" class="form-control" name="f_creditor_name" required="" />                                          
                            </div>
                            <div class="furnisher-other-info" style="display: none; padding:0px 18px;">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="f-address">Address</label>
                                        <input type="text" class="form-control" name="f_address" id="f-address" placeholder=""/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="fa-city">City</label>
                                        <input type="text" class="form-control" name="f_city" id="fa-city" placeholder=""/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="f-state">State</label>
                                        <input type="text" class="form-control" name="f_state" id="f-state" placeholder=""/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="f-zip">Zip Code</label>
                                        <input type="text" class="form-control" name="f_zipcode" id="f-zip" placeholder=""/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="f-phone">Phone</label><br />
                                        <input type="text" class="form-control" name="f_phone" id="f-phone" placeholder="" style="display:inline-block;width: 40%;" />
                                        <input type="text" class="form-control" name="f_ext" id="" placeholder="Ext" style="display:inline-block; width: 25%;"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="f-note">Note</label>
                                        <textarea class="form-control" name="f_note" id="f-note" style="height:100px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-primary btn-sm btn-add-furnisher-more-detail more" href="javascript:void(0);" style="margin-top:5px;margin-bottom: 10px;margin-left: 15px;">+ More detail (Optional)</a>
                        </div>
                    </div>
                      <div class="modal-footer" style="margin-top:-2.5rem;">
                          <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary btn-quick-add-creditor-furnisher" name="action" value="create_appointment">Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
              </div>
            </div>

            <!-- Modal Manage Reasons -->
            <div class="modal fade bd-example-modal-md" id="modal-manage-reasons" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-list"></i> Manage Reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>                          
                  <div class="modal-body">
                    <a class="btn btn-md btn-primary btn-add-reason" href="javascript:void(0);" style="float: right;margin-bottom: 21px;"><i class="fa fa-plus"></i> Add New Reason</a>
                    <table class="table table-striped" style="height: 300px; overflow-y: scroll;display: block;">
                        <tr class="row-add-reason" style="display: none;">
                            <td>
                                <input type="text" class="form-control" name="new_reason" id="input-new-reason">
                            </td>
                            <td style="width:22%; text-align: right;">
                                <a class="btn btn-sm btn-primary btn-create-reason" href="javascript:void(0);" style="display:inline-block;">Save</a>
                                <a class="btn btn-sm btn-primary btn-delete-reaon" href="javascript:void(0);" style="display:inline-block;">Delete</a>
                            </td>
                        </tr>
                        <tbody class="company-reasons-container"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

<script>
  $(function () {    

    $(document).on('click', '.btn-add-reason', function(){
        $('.row-add-reason').show();
    });

    $(document).on('click', '.btn-delete-reaon', function(){
        $('.row-add-reason').hide();
    });

    $(document).on('click', '#account-number-type', function(){
        var selected = $(this).val();
        if( selected == 'acc_num_same' ){
            $('.cb-account-number-all').show();
            $('.cb-account-number-diff').hide();
        }else{
            $('.cb-account-number-all').hide();
            $('.cb-account-number-diff').show();
        }
    });

    $(document).on('click', '.btn-add-new-instruction', function(){
        $('.grp-option-instructions').hide();
        $('.grp-add-instructions').show();
    });

    $(document).on('click', '.btn-list-instructions', function(){
        $('.grp-option-instructions').show();
        $('.grp-add-instructions').hide(); 
        $('#new-instruction').val("");
    });

    $(document).on('click', '.btn-add-furnisher-more-detail', function(){        
        if( $(this).hasClass('more') ){
            $(this).removeClass('more');
            $(this).addClass('less');

            $('.furnisher-other-info').show();
            $(this).text('- Less detail');

        }else{
            $(this).removeClass('less');
            $(this).addClass('more');

            $(this).text('+ More detail (Optional)');
            $('.furnisher-other-info').hide();
        }
    });

    $(document).on('click', '.btn-add-creditor-furnisher', function(){
        $('#modal-create-creditor-furnisher').modal('show');
    });

    $(document).on('click', '.opt-other-fields', function(){
        var type = $(this).val();
        if( type == 'same' ){
            $('.other-fields-group').show();
            $('.other-fields-individual').hide();
        }else{
            $('.other-fields-group').hide();
            $('.other-fields-individual').show();
        }
    });

    $('.company-reasons').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_reasons',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            /*formatResult: function(item){ 
                return '<div>'+item.reason+'</div>';
            },*/
            cache: true
          },
          placeholder: 'Select Reason',
          minimumInputLength: 0,
          //templateResult: formatRepoTag,
          //templateSelection: formatRepoTagSelection
    });

    $('.company-instructions').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_instructions',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            /*formatResult: function(item){ 
                return '<div>'+item.reason+'</div>';
            },*/
            cache: true
          },
          placeholder: 'Select Instructions',
          minimumInputLength: 0,
          //templateResult: formatRepoTag,
          //templateSelection: formatRepoTagSelection
    });

    $('.company-furnishers').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_furnishers',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            /*formatResult: function(item){ 
                return '<div>'+item.reason+'</div>';
            },*/
            cache: true
          },
          placeholder: 'Select Furnishers',
          minimumInputLength: 0,
          templateResult: formatFurnisher,
          //templateSelection: formatRepoTagSelection
    });

    $('.autocomplete-status').select2({});

    function formatFurnisher(repo) {
      if (repo.loading) {
        return repo.text;
      }

      var $container = $(
        '<div><b>'+repo.text+'</b></div><div class="autocomplete-right"><small>'+repo.address+'</small></div>'
      );

      return $container;
    }

    $(document).on('click', '.btn-create-reason', function(){
        var company_reason = $('#input-new-reason').val();

        $(".btn-create-reason").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        if( company_reason != '' ){
            var url = base_url + 'customer/_create_company_reason';
            setTimeout(function () {
              $.ajax({
                 type: "POST",
                 url: url,
                 dataType: 'json',
                 data: {company_reason:company_reason},
                 success: function(o)
                 {      
                    if( o.is_success == 1 ){
                      Swal.fire({
                          title: 'Great!',
                          text: 'Company reason was successfully created.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          load_reason_list();
                          $('#input-new-reason').val('');
                          $('.row-add-reason').hide();
                      });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            confirmButtonColor: '#32243d',
                            html: 'Cannot save data'
                        });
                    } 

                    $(".btn-create-reason").html('Save');
                 }    
                    
              });
            }, 800);
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                confirmButtonColor: '#32243d',
                html: 'Please specify reason'
            });
        }
    });

    $(document).on('click', '.btn-manage-reasons', function(){
        $('#modal-manage-reasons').modal('show');
        load_reason_list();
    });

    $(document).on('change', '.cb-check', function(){
        var cb_id = $(this).attr('data-id');
        if($(this).is(':checked')) {
            $('.cb-account-'+cb_id).show();
            $('.other-field-cb-logo-'+cb_id).show();
            $('.other-field-group-cb-container-'+cb_id).show();
        }else{
            $('.cb-account-'+cb_id).hide();
            $('.other-field-cb-logo-'+cb_id).hide();
            $('.other-field-group-cb-container-'+cb_id).hide();
        }
    });

    function load_reason_list(){
        var url = base_url + 'customer/_load_company_reasons';
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             success: function(o)
             {      
                $('.company-reasons-container').html(o);
             }    
                
          });
        }, 800);
    }

    $("#frm-create-dispute-item").submit(function(e){
      e.preventDefault();
      var cid = $('#cid').val();
      var url = base_url + 'customer/_create_dispute_item';
      $(".btn-create-dispute-item").html('<span class="spinner-border spinner-border-sm m-0"></span>');

      var formData = new FormData($("#frm-create-dispute-item")[0]);   

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){
                  Swal.fire({
                      title: 'Great!',
                      text: 'Dispute item was successfully created.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      location.href = base_url + "customer/credit_industry/"+ cid;
                  });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: o.msg
                  });
                } 
                $(".btn-create-dispute-item").html('Save');
             }
          });
      }, 800);
    });

    $('#frm-quick-add-furnisher').submit(function(e){
        e.preventDefault();
        var url = base_url + 'creditor_furnisher/_quick_save';
        $(".btn-quick-add-creditor-furnisher").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        
        var formData = new FormData($("#frm-quick-add-furnisher")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {         
                if( o.is_success == 1 ){
                  $('#modal-create-creditor-furnisher').modal('hide');
                  $('#frm-quick-add-furnisher')[0].reset();
                  Swal.fire({
                      title: 'Great!',
                      text: 'Creditor / Furnisher was successfully created.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      
                  });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: o.msg
                  });
                } 

                $(".btn-quick-add-creditor-furnisher").html('Save');
             }
          });
        }, 800);
    });

    $('.f-other-info-date').datepicker({
        format: 'mm/dd/yyyy',      
        autoclose: true,
    });

  });
</script>


<?php include viewPath('v2/includes/footer'); ?>
