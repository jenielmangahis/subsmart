<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Auto SMS Notification Logs.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/calls') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Logs" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_auto_sms_notification') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>                        
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="CompanyName">Company Name</td>
                            <td data-name="ModuleName">Module</td>
                            <td data-name="MobileNumber" style="width:10%;">Mobile Number</td>
                            <td data-name="IsSent" style="width:5%;">Is Sent</td>
                            <td data-name=""></td>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cronAutoSms)) { ?>
                            <?php foreach ($cronAutoSms as $log) { ?>
                                <tr>
                                    <td><?= $log->business_name; ?></td>  
                                    <td><?= ucwords(str_replace("_", " ", $log->module_name)); ?></td>                
                                    <td><?= $log->mobile_number; ?></td>
                                    <td>
                                        <?php if($log->is_sent == 1) { ?>
                                            <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Yes</span>
                                        <?php }else{ ?>
                                            <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">No</span>
                                        <?php } ?>
                                    </td>
                                    <td class="center actions-col">
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-view-auto-sms" href="javascript:void(0)" data-id="<?= $log->id; ?>"><i class='bx bx-fw bx-show'></i> View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-resend-sms" href="javascript:void(0)" data-id="<?= $log->id; ?>" data-mobile="<?= $log->mobile_number; ?>"><i class='bx bx-fw bxs-edit'></i> Resend</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-code" href="javascript:void(0);" data-id="<?= $log->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <nav class="nsm-table-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!--View Auto SMS-->
            <div class="modal fade nsm-modal fade" id="modalViewAutoSmsNotification" tabindex="-1" aria-labelledby="modalViewAutoSmsNotificationLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View Auto SMS Notification</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body modal-view-container"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/calls';
    });
});

$(document).on("click", ".btn-resend-sms", function(e) {
    var logid = $(this).attr("data-id");
    var mobile_number = $(this).attr('data-mobile');
    var url = base_url + 'admin/ajaxResendAutoSMSNotification';

    Swal.fire({
        title: 'Resend Auto SMS Notification',
        html: "Are you sure you want to resend selected auto sms notification to <b>"+ mobile_number +"</b>?",
        icon: 'question',
        confirmButtonText: 'Send',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: {logid:logid},
                success: function(o) {
                    if( o.is_success == 1 ){   
                        Swal.fire({
                            title: 'Send Successful!',
                            html: "Auto SMS Notification was successfully sent to <b>"+mobile_number+"</b>!",
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

$(document).on('click', '.btn-view-auto-sms', function(){
    var logid = $(this).attr('data-id');
    var url = base_url + 'admin/ajaxViewAutoSMSNotification';

    $('#modalViewAutoSmsNotification').modal('show');

    $(".modal-view-container").html('<span class="bx bx-loader bx-spin"></span>');

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,         
         data: {logid:logid},
         success: function(o)
         {          
            $(".modal-view-container").html(o);
         }
      });
    }, 800);
    
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>