<div class="row" id="modal-edit-dispute-item-container">
    <div class="col-md-6 form-group">
        <label for="dispute-date">Date</label>
        <?= $dispute->date_dispute; ?>
        <input type="date" class="form-control default-datepicker" style="width:50%;" name="dispute_date" id="dispute-date" value="<?= date("Y-m-d",strtotime($dispute->date_dispute)); ?>">     
    </div>
    <div class="col-md-6 mt-2 form-group">
        <label for="cf-id">Creditor / Furnisher</label>
        <select class="company-furnishers form-control" id="cf-id" name="furnisher_id">
            <option selected="selected" value="<?= $dispute->furnisher_id; ?>"><?= $dispute->furnisher_name; ?></option>
        </select>    
    </div>
</div>
<div class="row">
    <div class="col-md-6 form-group">
        <label for="dispute-reason">Reason</label>
        <select class="company-reasons form-control" id="dispute-reason" name="dispute_reason">
            <option value="<?= $dispute->company_reason_id; ?>"><?= $dispute->reason; ?></option>
        </select>
    </div>
    <div class="col-md-6 mt-2 form-group">
        <label for="dispute-instruction">Instruction</label>
        <textarea class="form-control" name="dispute_instruction" id="dispute-instruction" style="height:150px;"><?= $dispute->instruction; ?></textarea>
    </div>
</div>
<hr />
<div class="other-fields-individual" style="width: 100%;">
    <?php include_once('dispute_other_fields/edit_fields.php'); ?>
</div>
<script>
$(function(){
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
          dropdownParent: $("#modal-edit-dispute-item-container"),
          //templateSelection: formatRepoTagSelection
    });

    function formatFurnisher(repo) {
      if (repo.loading) {
        return repo.text;
      }

      var $container = $(
        '<div>'+repo.text+'</div></div>'
      );

      return $container;
    }

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
          dropdownParent: $("#modal-edit-dispute-item-container"),
          placeholder: 'Select Reason',
          minimumInputLength: 0,
          //templateResult: formatRepoTag,
          //templateSelection: formatRepoTagSelection
    });
});
</script>