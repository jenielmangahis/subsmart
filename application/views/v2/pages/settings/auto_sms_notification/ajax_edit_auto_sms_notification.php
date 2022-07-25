<input type="hidden" name="smsid" value="<?= $autoSms->id ?>" />
<div class="row">                                                                
    <div class="col-md-12 mt-3">
        <label for="">Module Name</label>
        <span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Module that will apply the auto sms notification">
        <select class="form-control" name="module_name" id="edit-module-name" required="">
            <option value="">- Select Module -</option>
            <?php foreach($moduleList as $key => $module){ ?>
                <option <?= $autoSms->module_name == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $module; ?></option>
            <?php } ?>
        </select>
        </span>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Module Status</label>
        <div class="edit-module-status-container">
            <span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Module Status that will trigger auto sms notification">
            <select name="module_status" id="module-status" class="form-control" required="">
                <?php foreach($moduleStatus as $key => $status){ ?>
                    <option <?= $autoSms->module_status == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $status; ?></option>
                <?php } ?>
            </select>
            </span>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">SMS Message</label>
        <select class="form-control" id="edit-cmb-smart-tags" name="smart_tags" style="width:30% !important; float: right;">
            <option value="0">Insert Smart Tags</option>
            <option value="{{order_number}}">Order Number</option>
            <option value="{{customer_name}}">Customer Name</option>
            <option value="{{company_name}}">Company Name</option>
            <!-- <option value="{{customer.email}}">Customer Email</option>
            <option value="{{customer.phone}}">Customer Phone</option> -->
        </select>
        <textarea class="form-control" name="sms_text" id="edit-sms-txt" style="height:130px;" required=""><?= $autoSms->sms_text; ?></textarea>
    </div>                                    
    <div class="col-md-12 mt-3">
        <label for="">Send To</label>   
        <br />
        <span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Employee(s) that will receive the auto notification">
            <select <?= $is_send_all ? 'disabled="disabled"' : ''; ?> name="send_to[]" id="edit-send-to-user" class="form-control" multiple="">
                <?php if( !$is_send_all ){ ?>
                <?php foreach($recipients as $key => $name){ ?>
                    <option selected="selected" value="<?= $key; ?>"><?= $name; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </span>                                        
        <div class="form-check" style="margin-top:5px; display: inline-block;margin-left: 10px;">
          <input <?= $is_send_all ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_to_all" id="edit-chk-send-all">
          <label class="form-check-label" for="flexCheckDefault">
            Send to all
          </label>
        </div>
        <div class="form-check" style="margin-top:5px; display: inline-block;margin-left: 10px;">
          <input <?= $autoSms->send_to_creator == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_creator" id="chk-send-creator">
          <label class="form-check-label" for="flexCheckDefault">
            Send to Module Item Creator
          </label>
        </div>
        <div class="form-check" style="margin-top:5px; display: inline-block;margin-left: 10px;">
          <input <?= $autoSms->send_to_company_admin == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_company_admin" id="chk-send-company-admin">
          <label class="form-check-label" for="flexCheckDefault">
            Send to Company Admin
          </label>
        </div>        
        <div class="form-check edit-grp-send-assigned-user" style="margin-top:5px; margin-left: 10px;<?= $autoSms->module_name != 'taskhub' ? 'display: none;' : 'display: inline-block'; ?>">
          <input <?= $autoSms->send_to_assigned_user == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_assigned_user" id="chk-assigned-user">
          <label class="form-check-label" for="flexCheckDefault">
            Send to Assigned User
          </label>
        </div>
        
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="is_enabled" class="form-control">
            <option <?= $autoSms->is_enabled == 1 ? 'selected="selected"' : ''; ?> value="1">Enabled</option>
            <option <?= $autoSms->is_enabled == 0 ? 'selected="selected"' : ''; ?> value="0">Disabled</option>
        </select>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.auto-sms-popover').popover({
        trigger:"hover"
    });

    $(document).on('change', '#edit-cmb-smart-tags', function(){
        var smart_tags  = $(this).val();
        var sms_message = $('#edit-sms-txt').val();
        var new_sms_message = sms_message + ' ' + smart_tags;

        $('#edit-sms-txt').val(new_sms_message);

        //alert(new_sms_message);

        $(this).val(0);
    });

    $('#edit-send-to-user').select2({
        dropdownParent: $("#modalEditAutoSmsNotification"),
        width: '100%',
        //placeholder: 'Select User',
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
          minimumInputLength: 0,
          templateResult: editFormatRepoUser,
          templateSelection: editFormatRepoSelectionUser
    }); 

    function editFormatRepoUser(repo) {
      if (repo.loading) {
        return repo.text;
      }

      var $container = $(
        '<div><div class="autocomplete-left"><img class="autocomplete-img" src="'+repo.user_image+'" /></div><div class="autocomplete-right">'+repo.FName + ' ' + repo.LName +'<br /><small>'+repo.email+'</small></div></div>'
      );

      return $container;
    }

    function editFormatRepoSelectionUser (repo) {            
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }
});

$(document).on('change', '#edit-module-name', function(e){
    e.preventDefault();

    var module_name = $(this).val();
    var url = base_url + 'settings/_load_auto_sms_notification_module_status';
    $(".edit-module-status-container").html('<span class="bx bx-loader bx-spin"></span>');

    if( module_name == 'taskhub' ){
        $('.edit-grp-send-assigned-user').show();
        $('.edit-grp-send-assigned-user').css('display', 'inline-block');
    }else{
        $('.edit-grp-send-assigned-user').hide();
    }

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         data: {module_name:module_name},
         success: function(o)
         {          
            $('.edit-module-status-container').html(o);
         }
      });
    }, 800);
});

$(document).on('change', '#edit-chk-send-all', function(){
    $('#edit-send-to-user').val(null).trigger('change');
    if ($(this).is(':checked')) {
        $('#edit-send-to-user').select2('enable', false);
    }else{
        $('#edit-send-to-user').removeAttr('disabled');
    }
});
</script>