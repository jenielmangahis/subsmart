<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('sms_automation/add_sms_automation') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            List all automations.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_add_sms_automation" class="nsm-button primary" onclick="location.href='<?php echo url('sms_automation/add_sms_automation') ?>'">
                                <i class='bx bx-fw bx-message-square-add'></i> Add SMS Automation
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Automation Name">Automation Name</td>
                            <td data-name="Event">Event</td>
                            <td data-name="Details">Details</td>
                            <td data-name="Active">Active</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody id="sms_automation_container">
                    </tbody>
                </table>
            </div>

            <!-- View Modal -->
            <div class="modal fade nsm-modal fade" id="modalView" aria-labelledby="modalViewLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadSMSAutomation();

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete SMS Automation',
                text: "Are you sure you want to delete this SMS Automation?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>sms_automation/_delete_automation",
                        data: {
                            automationid: id
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        loadSMSAutomation();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });
    });

    $(document).on('click', '.btn-view', function(){
        var url = base_url + 'sms_automation/_view_sms_automation';
        var sms_id = $(this).data('id');

        $('#modalView').modal('show');
        $('#modalView .modal-body').html('<span class="bx bx-loader bx-spin"></span>');
        
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {sms_id:sms_id},             
             success: function(o)
             {          
                $('#modalView .modal-body').html(o);
             }
          });
        }, 800);
    });

    function loadSMSAutomation(status = "all") {
        let _container = $("#sms_automation_container");
        let url = "<?php echo base_url(); ?>sms_automation/_load_automation_list/" + status;

        _container.html(
            '<tr>' +
            '<td colspan="7">' +
            '<div class="nsm-loader">' +
            '<i class="bx bx-loader-alt bx-spin"></i>' +
            '</div>' +
            '</td>' +
            '</tr>'
        );

        $.ajax({
            type: 'POST',
            url: url,
            success: function(result) {
                _container.html(result);
                $(".nsm-table").nsmPagination();
            },
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>