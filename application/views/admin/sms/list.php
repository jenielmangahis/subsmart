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
                            Listing of all company sent sms.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/sms') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search SMS" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_sms') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>                        
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon" style="width: 30%;">Company Name</td>
                            <td data-name="Event Type Name">From Number</td>
                            <td data-name="Company Name">To Number</td>
                            <td data-name="Company Name">API</td>
                            <td data-name="Manage" style="width: 5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($companySms)){ ?>
                            <?php foreach ($companySms as $sms) { ?>
                                <tr>
                                    <td><?= $sms->business_name; ?></td>                                    
                                    <td><?= $sms->from_number; ?></td>
                                    <td><?= $sms->to_number; ?></td>
                                    <td><?= ucfirst($sms->sms_api); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item view-messages" data-id="<?= $sms->id; ?>" href="javascript:void(0);">View Messages</a>
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
        location.href = base_url + 'admin/sms';
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