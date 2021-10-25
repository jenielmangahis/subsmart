<div class="form-group">
    <label for="" style="width:100%;text-align: left;"><i class="fa fa-calendar"></i> When</label>
    <div class="row g-3">
      <div class="col-sm-8">
        <input type="text" name="appointment_date" class="form-control edit-appointment-date" value="<?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?>" placeholder="Date" aria-label="Date">
      </div>
      <div class="col-sm-4">
        <input type="text" name="appointment_time" class="form-control edit-appointment-time" value="<?= date("h:i A", strtotime($appointment->appointment_time)); ?>" placeholder="Time" aria-label="Time">
      </div>
    </div>
</div>  
<div class="form-group">
    <label for="" style="width:100%;text-align: left;"><i class="fa fa-address-card-o"></i> Which Employee</label>
    <div class="row g-3">
      <div class="col-sm-12">
        <select name="appointment_user_id" id="edit-appointment-user" class="form-control">
          <option value="<?= $appointment->user_id; ?>" selected><?= $appointment->employee_name; ?></option>
        </select>
      </div>
    </div>
</div> 
<div class="form-group">
    <label for="" style="width:100%;text-align: left;"><i class="fa fa-user"></i> Which Customer</label>
    <div class="row g-3">
      <div class="col-sm-12">
        <select name="appointment_customer_id" id="edit-appointment-customer" class="form-control">
          <option value="<?= $appointment->prof_id; ?>" selected><?= $appointment->customer_name; ?></option>
        </select>
      </div>
    </div>
</div> 
<div class="form-group">
    <label for="" style="width:100%;text-align: left;"><i class="fa fa-list"></i> Appointment Type</label>
    <div class="row g-3">
      <div class="col-sm-12">
        <select name="appointment_type_id" id="appointment-type form-control" class="form-control" style="border:solid 1px rgba(0,0,0,0.35);">
          <?php foreach($appointmentTypes as $a){ ?>
              <option <?= $appointment->appointment_type_id == $a->id ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
</div>  
<div class="form-group">
    <label for="" style="width:100%;text-align: left;"><i class="fa fa-tag"></i> Tags</label>
    <div class="row g-3">
      <div class="col-sm-12">
        <select name="appointment_tags[]" id="edit-appointment-tags" multiple="multiple" class="form-control">
          <?php foreach($a_selected_tags as $key => $value){ ?>
            <option value="<?= $key; ?>" selected><?= $value; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
</div>

<script>
$(function(){
  $('#edit-appointment-tags').select2({
      ajax: {
          url: base_url + 'autocomplete/_company_event_tags',
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
          cache: true
        },
        placeholder: 'Select Tags',
        minimumInputLength: 0,
        templateResult: formatRepoTag,
        templateSelection: formatRepoTagSelection
  });

  $('#edit-appointment-customer').select2({
      ajax: {
          url: base_url + 'autocomplete/_company_customer',
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
          cache: true
        },
        placeholder: 'Select Customer',
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
  });

  $('#edit-appointment-user').select2({
      ajax: {
          url: base_url + 'autocomplete/_company_users',
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
          formatResult: function(item){ 
              //console.log(item);
              return '<div>'+item.FName + ' ' + item.LName +'<br /><small>'+item.email+'</small></div>';
          },
          cache: true
        },
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
  });

  $('.edit-appointment-date').datepicker({
      //format: 'yyyy-mm-dd',
      format: 'DD, MM dd, yy',
      autoclose: true,
  });

  $('.edit-appointment-time').timepicker({'timeFormat': 'h:i A'});
});
</script>