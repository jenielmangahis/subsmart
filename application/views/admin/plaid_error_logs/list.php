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
                            Plaid API Error Logs.
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/plaid_error_logs') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Logs" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_plaid_error_logs') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>                        
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="Company Name" style="width: 20%;">Company Name</td>
                            <td data-name="Date" style="width:10%;">Date</td>
                            <td data-name="Total" style="width:50%;">Error</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($plaidErrorLogs)){ ?>
                            <?php foreach ($plaidErrorLogs as $log) { ?>
                                <tr>
                                    <td><?= $log->business_name; ?></td>                                    
                                    <td><?= date("m/d/Y H:i:s", strtotime($log->log_date)); ?></td>
                                    <td><?= $log->log_msg; ?></td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No records found.</span>
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

            <!--View Messages modal-->
            <div class="modal fade nsm-modal fade" id="modalViewSmsMessages" tabindex="-1" aria-labelledby="modalViewSmsMessagesLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Messages</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>                        
                        <div class="modal-body view-sms-messages-container"></div>
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
        location.href = base_url + 'admin/plaid_error_logs';
    });

    $(document).on('click','.view-messages', function(){
        var smsid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_sms_messages';

        $('#modalViewSmsMessages').modal('show');
        $(".view-sms-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {smsid:smsid},
             success: function(o)
             {          
                $('.view-sms-messages-container').html(o);
             }
          });
        }, 800);
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>