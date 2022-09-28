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
            <?php foreach($defaultSmartTags as $key => $value){ ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
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
        <ul class="list-chk-options">
            <li>
                <div class="form-check">
                  <input <?= $is_send_all ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_to_all" id="edit-chk-send-all">
                  <label class="form-check-label" for="edit-chk-send-all">
                    Send to all
                  </label>
                </div>
            </li>
            <li>
                <div class="form-check">
                  <input <?= $autoSms->send_to_creator == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_creator" id="edit-chk-send-creator">
                  <label class="form-check-label" for="edit-chk-send-creator">
                    Send to Module Item Creator
                  </label>
                </div>
            </li>
            <li>
                <div class="form-check">
                  <input <?= $autoSms->send_to_company_admin == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_company_admin" id="edit-chk-send-company-admin">
                  <label class="form-check-label" for="edit-chk-send-company-admin">
                    Send to Company Admin
                  </label>
                </div>   
            </li>
            <li class="edit-grp-send-assigned-user" style="<?= $autoSms->module_name == 'lead' || $autoSms->module_name == 'taskhub' || $autoSms->module_name == 'job' ? 'display: inline-block;' : 'display: none'; ?>">
                <div class="form-check">
                  <input <?= $autoSms->send_to_assigned_user == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_assigned_user" id="edit-chk-assigned-user">
                  <label class="form-check-label" for="edit-chk-assigned-user">
                    Send to Assigned User
                  </label>
                </div>
            </li>
            <li class="edit-grp-send-assigned-agent" style="<?= $autoSms->module_name == 'lead' || $autoSms->module_name == 'workorder' ? 'display: inline-block;' : 'display: none'; ?>">
                <div class="form-check">
                  <input <?= $autoSms->send_to_assigned_agent == 1 ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" value="all" name="send_assigned_agent" id="edit-chk-assigned-agent">
                  <label class="form-check-label" for="edit-chk-assigned-agent">
                    Send to Assigned Agent
                  </label>
                </div>
            </li>
        </ul>   
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
            url: base_url + 'autocomplete/_company_users?mobile=1',
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

      if( repo.mobile != '' ){
        var mobile = repo.mobile;         
      }else{
        var mobile = 'Undefined';
      }

      var $container = $(
        '<div><div class="autocomplete-left"><img class="autocomplete-img" src="'+repo.user_image+'" /></div><div class="autocomplete-right">'+repo.FName + ' ' + repo.LName +'<br /><small>Mobile Number : '+mobile+'</small></div></div>'
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
    var url_module_status = base_url + 'settings/_load_auto_sms_notification_module_status';
    var url_smart_tags    = base_url + 'settings/_load_auto_sms_notification_module_smart_tags';

    $(".edit-module-status-container").html('<span class="bx bx-loader bx-spin"></span>');

    if( module_name == 'taskhub' || module_name == 'lead' || module_name == 'job' ){
        $('.edit-grp-send-assigned-user').show();
        //$('.edit-grp-send-assigned-user').css('display', 'inline-block');
    }else{
        $('.edit-grp-send-assigned-user').hide();
    }

    if( module_name == 'lead' || module_name == 'workorder' ){
        $('.edit-grp-send-assigned-agent').show();
    }else{
        $('.edit-grp-send-assigned-agent').hide();
    }

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url_module_status,
         data: {module_name:module_name},
         success: function(o)
         {          
            $('.edit-module-status-container').html(o);
         }
      });
    }, 800);

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url_smart_tags,
         data: {module_name:module_name},
         dataType: 'json',
         success: function(data)
         {          
            $('#edit-cmb-smart-tags').empty();
            $('#edit-cmb-smart-tags').append('<option value="0">Insert Smart Tags</option>');
            data.forEach(function(entry){
                $('#edit-cmb-smart-tags').append('<option value="' + entry.key+ '">' + entry.value + '</option>');
            });
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