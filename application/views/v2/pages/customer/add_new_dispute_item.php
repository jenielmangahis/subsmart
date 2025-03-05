<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
.list-cb-account-numbers{
    margin:8px 0px;
    list-style:none;
    padding:0px;
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
    display: inline-block;
    width: 200px;
    margin: 13px;
    margin-left:0px;
}
.cb-list li .form-check{
    background-color: #dad1e0;
    padding: 10px;    
}
.cb-list li .form-check .cb-check{
    margin-left: 0px;
    margin-right: 7px;
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
                            Add dispute item for customer <b><?= $customer->first_name .' '. $customer->last_name; ?></b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php echo form_open_multipart('', ['class' => 'form-validate require-validation', 'id' => 'frm-create-dispute-item', 'autocomplete' => 'off']); ?>
                    <input type="hidden" name="cus_id" id="cid" value="<?= $cid; ?>">
                    <div class="row custom__border">
                        <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Select Credited Bureaus</label>
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

                                <div class="row mt-4">
                                    <div class="col-md-3 form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="select-company-furnishers">Creditor / Furnisher</label>
                                            <a class="nsm-button btn-small d-flex align-items-center btn-add-creditor-furnisher" href="javascript:void(0);">
                                                <span class="bx bx-plus"></span>Add New Creditor/Furnisher
                                            </a>
                                        </div>
                                        <select class="company-furnishers form-control" id="select-company-furnishers" name="furnisher_id" required=""></select>   
                                    </div>

                                    
                                    <div class="col-md-4 form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="company-reasons">Reason</label>
                                            <a class="nsm-button btn-small d-flex align-items-center btn-manage-reasons" href="javascript:void(0);">
                                                <span class="bx bx-plus"></span>Manage Reasons
                                            </a>

                                        </div>
                                        <select class="company-reasons form-control" id="company-reasons" name="dispute_reason" required=""></select>
                                        <span style="font-size:13px;margin-top: 4px; margin-bottom: 4px;display: block;">(if you can't find an appropriate reason. choose "other information i would like to changed")</span>
                                    </div>

                                    <div class="col-md-4 form-group grp-option-instructions">
                                        <div class="d-flex justify-content-between">
                                            <label for="list-instructions">Instructions</label>
                                            <a class="nsm-button btn-small d-flex align-items-center btn-add-new-instruction" href="javascript:void(0);">
                                                <span class="bx bx-plus"></span>Add New Instructions
                                            </a>
                                        </div>
                                        <select class="company-instructions form-control" id="list-instructions" name="list_instruction"></select>
                                    </div>  

                                    <div class="col-md-4 form-group grp-add-instructions" style="display: none;">
                                        <label for="save-new-instruction">Instructions</label>
                                        <input type="text" class="form-control" name="new_instruction" id="new-instruction" style="margin-bottom: 10px;" />
                                        <a href="javascript:void(0);" class="nsm-button btn-small btn-list-instructions">Choose from list</a><br /><br />
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
                                    <div class="col-md-3">
                                        <label for="estimate_date">Account Numbers (opt)</label>
                                        <select class="form-control" name="account_number_opt" id="account-number-type">
                                            <option value="acc_num_same">Same for all bureaus</option>
                                            <option value="acc_num_diff">Different for each bureau</option>
                                        </select>

                                        <div class="cb-account-number-all mt-2">
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
                                    </div> 
                                    <div class="col-md-12 mt-4"><hr /></div>                                                                     
                                </div>
                                <div class="mt-5"> 
                                    <div class="mb-4" style="display:block;margin-bottom:10px;">  
                                        <select class="opt-other-fields form-control" name="other_fields_type" style="width:20%;float:right;">
                                            <option value="same">Same for all bureaus</option>
                                            <option value="diff">Different for each bureau</option>
                                        </select>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="other-fields-group" style="width: 100%;">
                                        <?php include_once('dispute_other_fields/group.php'); ?>
                                    </div>
                                    <div class="other-fields-individual row" style="display: none; width: 100%;">
                                        <?php include_once('dispute_other_fields/individual.php'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="margin-top: 20px !important;">
                                        <button type="submit" class="nsm-button primary btn-create-dispute-item" style="margin-left:0px;">Save</button>
                                        <a href="<?php echo url('customer/credit_industry/'.$cid) ?>" class="nsm-button primary">Cancel</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                    <!-- Modal Create Creditor / Furnisher -->
                    <div class="modal fade nsm-modal fade" id="modal-create-creditor-furnisher" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-create-creditor-furnisher_modal_label" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">        
                            <div class="modal-content">
                                <?php echo form_open_multipart('', ['class' => 'form-validate require-validation', 'id' => 'frm-quick-add-furnisher', 'autocomplete' => 'off']); ?>
                                    <div class="modal-header">
                                        <span class="modal-title content-title">Add Creditor/Furnisher</span>
                                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                    </div>
                                    <div class="modal-body">                    
                                        <div class="row">
                                            <div class="col-md-7 form-group">
                                                <label for="">Creditor/Furnisher Name *</label>
                                                <input type="text" class="form-control" name="f_creditor_name" required="" />                                          
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label for="f-phone">Phone</label><br />
                                                <input type="text" class="form-control phone_number" name="f_phone" id="f-phone" placeholder="" style="display:inline-block;width: 73%;" />
                                                <input type="text" class="form-control" name="f_ext" id="" placeholder="Ext" style="display:inline-block; width: 25%;"/>                                        
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-7 form-group">
                                                <label for="f-address">Address</label>
                                                <input type="text" class="form-control" name="f_address" id="f-address" placeholder=""/>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label for="fa-city">City</label>
                                                <input type="text" class="form-control" name="f_city" id="fa-city" placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-3 form-group">
                                                <label for="f-state">State</label>
                                                <input type="text" class="form-control" name="f_state" id="f-state" placeholder=""/>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="f-zip">Zip Code</label>
                                                <input type="text" class="form-control" name="f_zipcode" id="f-zip" placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 form-group">
                                                <label for="f-note">Note</label>
                                                <textarea class="form-control" name="f_note" id="f-note" style="height:100px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="nsm-button primary btn-quick-add-creditor-furnisher">Save</button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Manage Reasons -->
                    <div class="modal fade nsm-modal fade" id="modal-manage-reasons" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-manage-reasons_modal_label" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">        
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title content-title">Manage Reasons</span>
                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                </div>
                                <div class="modal-body">                    
                                    <a class="nsm-button primary btn-add-reason" href="javascript:void(0);" style="float: right;margin-bottom: 21px;"><i class="fa fa-plus"></i> Add New Reason</a>
                                    <table class="table table-striped" style="height: 300px; overflow-y: scroll;display: block;">
                                        <tr class="row-add-reason" style="display: none;">
                                            <td>
                                                <input type="text" class="form-control" name="new_reason" id="input-new-reason">
                                            </td>
                                            <td style="width:22%;">
                                                <a class="nsm-button btn-small btn-create-reason" href="javascript:void(0);" style="display:inline-block;width:60px;text-align:center;">Save</a>
                                                <a class="nsm-button btn-small btn-delete-reaon" href="javascript:void(0);" style="display:inline-block;width:60px;text-align:center;margin-top:3px;">Cancel</a>
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

    $('.phone_number').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $(document).on('click', '.btn-add-reason', function(){
        $('.row-add-reason').show();
    });

    $(document).on('click', '.btn-delete-reaon', function(){
        $('.row-add-reason').hide();
    });

    $(document).on('change', '#account-number-type', function(){
        var selected = $(this).val();
        var bureaus = $('.cb-check:checked');
        if( selected == 'acc_num_same' ){
            $('.cb-account-number-all').show();
            $('.cb-account-number-diff').hide();
        }else{
            if( bureaus.length > 0 ){
                $('.cb-account-number-all').hide();
                $('.cb-account-number-diff').show();
            }else{
                $(this).val('acc_num_same').trigger('change');
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: 'Please select bureau(s)'
                });
            }            
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

    $(document).on('change', '.opt-other-fields', function(){
        var type   = $(this).val();
        var bureaus = $('.cb-check:checked');
        if( type == 'same' ){
            $('.other-fields-group').show();
            $('.other-fields-individual').hide();
        }else{
            if( bureaus.length > 0 ){
                $('.other-fields-group').hide();
                $('.other-fields-individual').show();
            }else{
                $(this).val('same').trigger('change');
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: 'Please select bureau(s)'
                });
            }
            
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

    $('#select-company-furnishers').select2({
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
        '<div>'+repo.text+'</div>'
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
                        $('#modal-manage-reasons').modal('hide');
                        $('#input-new-reason').val('');
                        $('.row-add-reason').hide();

                        $('#company-reasons').append($('<option>', {
                            value: o.rid,
                            text: o.reason
                        }));
                        $('#company-reasons').val(o.rid).trigger("change");
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
        var cb_id   = $(this).attr('data-id');
        var bureaus = $('.cb-check:checked');
        if($(this).is(':checked')) {
            $('.cb-account-'+cb_id).show();
            $('.other-field-cb-logo-'+cb_id).show();
            $('.other-field-group-cb-container-'+cb_id).show();
        }else{
            if( bureaus.length > 0 ){
                $('.cb-account-'+cb_id).hide();
                $('.other-field-cb-logo-'+cb_id).hide();
                $('.other-field-group-cb-container-'+cb_id).hide();
            }else{
                $('.opt-other-fields').val('same').trigger('change');
                $('#account-number-type').val('acc_num_same').trigger('change');
            }
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

    $(document).on('click', '.row-reason-delete', function(){
        var rid = $(this).attr('data-id');
        var url = base_url + 'customer/_delete_reason';
        Swal.fire({
            title: 'Delete Company Reason',
            html: `Are you sure you want to delete selected company reason?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: {rid:rid},
                    success: function(o)
                    {         
                        if( o.is_success == 1 ){
                            $(`#row-reason-${rid}`).remove();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: o.msg,
                            });
                        } 
                    },
                    beforeSend: function(){
                        
                    }
                });
            }
        });
    });

    $('#frm-quick-add-furnisher').submit(function(e){
        e.preventDefault();
        var url = base_url + 'creditor_furnisher/_quick_save';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $("#frm-quick-add-furnisher").serialize(),
            success: function(o)
            {         
                if( o.is_success == 1 ){
                    $('#modal-create-creditor-furnisher').modal('hide');
                    $('#frm-quick-add-furnisher')[0].reset();

                    $('#select-company-furnishers').append($('<option>', {
                        value: o.fid,
                        text: o.name
                    }));                    
                    $('#select-company-furnishers').val(o.fid).trigger("change");

                    Swal.fire({
                        title: 'Add Creditor / Furnisher',
                        text: 'Data was successfully created.',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: o.msg,
                    });
                } 

                $(".btn-quick-add-creditor-furnisher").html('Save');
            },
            beforeSend: function(){
                $(".btn-quick-add-creditor-furnisher").html('<span class="spinner-border spinner-border-sm m-0"></span>');
            }
        });
    });

    // $('.f-other-info-date').datepicker({
    //     format: 'mm/dd/yyyy',      
    //     autoclose: true,
    // });

  });
</script>


<?php include viewPath('v2/includes/footer'); ?>
