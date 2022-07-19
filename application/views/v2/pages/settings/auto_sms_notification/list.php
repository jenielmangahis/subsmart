<?php include viewPath('v2/includes/header'); ?>
<style>
.hoverEffect {
    font-size: 29px;
    position: absolute;
    margin: 30px 55px;
    cursor: pointer;
}
.bs-popover-top .arrow:after, .bs-popover-top .arrow:before {
  border-top-color: #32243D !important;
}
.bs-popover-bottom .arrow:after, .bs-popover-bottom .arrow:before {
  border-bottom-color: #32243D !important;
}
.autocomplete-img {
    height: 50px;
    width: 50px;
}
.autocomplete-left {
    display: inline-block;
    width: 65px;
}
.autocomplete-right {
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_templates_tabs'); ?>
    </div>   
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Create your auto sms notification.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-create-auto-sms-setting">
                                <i class='bx bx-fw bx-cog'></i> Add New Auto SMS Notification Setting
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Module Name">Auto SMS Condition</td>
                            <td data-name="SMS Message">SMS Message</td>
                            <td data-name="Send To">Send To</td>
                            <td data-name="Is Enabled" style="width: 10%;">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($autoSms)) { ?>
                            <?php foreach ($autoSms as $asms){ ?>
                            <tr>
                                <td>
                                    <?php if( $asms->module_status == 'Email Opened' ){ ?>
                                        Send auto sms notification if <b><?= ucfirst(str_replace("_", " ", $asms->module_name)) ?> Email is Opened</b></b>                                    
                                    <?php }else{ ?>
                                        Send auto sms notification if <b><?= ucfirst(str_replace("_", " ", $asms->module_name)) ?></b> having status <br /> <b><?= ucfirst($asms->module_status); ?></b>                                    
                                    <?php } ?>
                                    
                                </td>
                                <td><?= $asms->sms_text; ?></td>
                                <td>
                                    <ul>
                                    <?php if( !empty($recipients[$asms->id]) ){ ?>
                                        <?php foreach($recipients[$asms->id] as $value){ ?>
                                            <li><?= $value; ?></li>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <li>-</li>
                                    <?php } ?>                                    
                                    </ul>
                                </td>
                                <td>
                                    <?php if($asms->is_enabled == 1) { ?>
                                        <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Enabled</span>
                                    <?php }else{ ?>
                                        <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Disabled</span>
                                    <?php } ?>                                        
                                </td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-auto-sms" href="javascript:void(0);" data-id="<?= $asms->id; ?>">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-auto-sms" href="javascript:void(0);" data-id="<?= $asms->id; ?>">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Create auto sms notification -->
                <div class="modal fade nsm-modal fade" id="modalCreateAutoSmsNotification" aria-labelledby="modalCreateAutoSmsNotificationLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Create Auto SMS Notification Setting</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form action="" id="frm-create-auto-sms-notification">
                            <div class="modal-body">
                                <div class="row">                                                                
                                    <div class="col-md-12 mt-3">
                                        <label for="">Module Name</label>
                                        <span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Module that will apply the auto sms notification">
                                        <select class="form-control" name="module_name" id="module-name" required="">
                                            <option value="">- Select Module -</option>
                                            <?php foreach($moduleList as $key => $module){ ?>
                                                <option value="<?= $key; ?>"><?= $module; ?></option>
                                            <?php } ?>
                                        </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="">Module Status</label>
                                        <div class="module-status-container">
                                            <span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Module Status that will trigger auto sms notification">
                                            <select name="module_status" id="module-status" class="form-control" required="">
                                                <option value="">Select Status</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="">SMS Message</label>
                                        <select class="form-control" id="cmb-smart-tags" name="smart_tags" style="width:30% !important; float: right;">
                                            <option value="0">Insert Smart Tags</option>
                                            <option value="{{order.number}}">Order Number</option>
                                            <option value="{{customer.name}}">Customer Name</option>
                                            <option value="{{business.name}}">Company Name</option>
                                            <!-- <option value="{{customer.email}}">Customer Email</option>
                                            <option value="{{customer.phone}}">Customer Phone</option> -->
                                        </select>
                                        <textarea class="form-control" name="sms_text" id="sms-txt" style="height:130px;margin-top: 17px;" required=""></textarea>
                                    </div>                                    
                                    <div class="col-md-12 mt-3">
                                        <label for="">Send To</label>   
                                        <br />
                                        <span id="" class="auto-sms-popover" data-bs-toggle="popover" data-bs-content="Employee(s) that will receive the auto notification">
                                            <select name="send_to[]" id="send-to-user" class="form-control" multiple=""></select>
                                        </span>                                        
                                        <div class="form-check" style="margin-top:5px;display: inline-block;">
                                          <input class="form-check-input" type="checkbox" value="all" name="send_to_all" id="chk-send-all">
                                          <label class="form-check-label" for="flexCheckDefault">
                                            Send to all
                                          </label>
                                        </div>
                                        <div class="form-check" style="margin-top:5px; display: inline-block;margin-left: 10px;">
                                          <input class="form-check-input" type="checkbox" value="all" name="send_creator" id="chk-send-creator">
                                          <label class="form-check-label" for="flexCheckDefault">
                                            Send to Module Item Creator
                                          </label>
                                        </div>
                                        <div class="form-check" style="margin-top:5px; display: inline-block;margin-left: 10px;">
                                          <input class="form-check-input" type="checkbox" value="all" name="send_company_admin" id="chk-send-company-admin">
                                          <label class="form-check-label" for="flexCheckDefault">
                                            Send to Company Admin
                                          </label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="">Status</label>
                                        <select name="is_enabled" class="form-control">
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary btn-save-auto-sms">Save</button>
                            </div>
                            </form>                      
                        </div>
                    </div>
                </div>

                <!-- Edit auto sms notification -->
                <div class="modal fade nsm-modal fade" id="modalEditAutoSmsNotification" aria-labelledby="modalEditAutoSmsNotificationLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Edit Auto SMS Notification Setting</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form action="" id="frm-edit-auto-sms-notification">
                            <div class="modal-body modal-edit-auto-sms-container"></div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary btn-update-auto-sms">Save</button>
                            </div>
                            </form>                      
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination(); 
        $('.auto-sms-popover').popover({
            trigger:"hover"
        });

        $('#send-to-user').select2({
            dropdownParent: $("#modalCreateAutoSmsNotification"),
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
              templateResult: formatRepoUser,
              templateSelection: formatRepoSelectionUser
        });       

        function formatRepoUser(repo) {
          if (repo.loading) {
            return repo.text;
          }

          var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="'+repo.user_image+'" /></div><div class="autocomplete-right">'+repo.FName + ' ' + repo.LName +'<br /><small>'+repo.email+'</small></div></div>'
          );

          return $container;
        }

        function formatRepoSelectionUser (repo) {            
            return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
        }
    });

    $(document).on('change', '#module-name', function(e){
        e.preventDefault();

        var module_name = $(this).val();
        var url = base_url + 'settings/_load_auto_sms_notification_module_status';
        $(".module-status-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {module_name:module_name},
             success: function(o)
             {          
                $('.module-status-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('click', '.btn-create-auto-sms-setting', function(){
        $('#modalCreateAutoSmsNotification').modal('show');
    });

    $(document).on('click', '.edit-auto-sms', function(){
        var sid = $(this).attr('data-id');
        var url = base_url + 'settings/_edit_auto_sms_notification';

        $('#modalEditAutoSmsNotification').modal('show');
        $(".modal-edit-auto-sms-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {sid:sid},
             success: function(o)
             {          
                $('.modal-edit-auto-sms-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('change', '#chk-send-all', function(){
        $('#send-to-user').val(null).trigger('change');
        if ($(this).is(':checked')) {
            $('#send-to-user').select2('enable', false);
        }else{
            $('#send-to-user').removeAttr('disabled');
        }
    });

    $(document).on('submit','#frm-create-auto-sms-notification', function(e){
        e.preventDefault();

        var url = base_url + 'settings/_create_sms_auto_notification';
        $(".btn-save-auto-sms").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-create-auto-sms-notification")[0]);   

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
                    $("#modalCreateAutoSmsNotification").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Auto SMS notification was successfully saved.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-save-auto-sms").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('change', '#cmb-smart-tags', function(){
        var smart_tags  = $(this).val();
        var sms_message = $('#sms-txt').val();
        var new_sms_message = sms_message + ' ' + smart_tags;

        $('#sms-txt').val(new_sms_message);

        //alert(new_sms_message);

        $(this).val(0);
    });

    $(document).on('submit','#frm-edit-auto-sms-notification', function(e){
        e.preventDefault();

        var url = base_url + 'settings/_update_sms_auto_notification';
        $(".btn-update-auto-sms").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-auto-sms-notification")[0]);   

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
                    $("#modalEditAutoSmsNotification").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Auto SMS notification was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-update-auto-sms").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-auto-sms", function(e) {
        var asmsid = $(this).attr("data-id");
        var url = base_url + 'settings/_delete_auto_sms_notification';

        Swal.fire({
            title: 'Delete Auto SMS Notification',
            html: "Are you sure you want to delete selected auto sms notification?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {asmsid:asmsid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Auto SMS Notification Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>