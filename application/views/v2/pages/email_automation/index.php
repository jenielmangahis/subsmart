<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo url('email_automation/add_email_automation') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-mail-send"></i>
            </div>
            <span class="nsm-fab-label">Add Email Automation</span>
        </li>
        <li onclick="location.href='<?php echo url('email_automation/templates') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-cog"></i>
            </div>
            <span class="nsm-fab-label">Manage Default Templates</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            List all automations.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('email_automation/add_email_automation') ?>'">
                                <i class='bx bx-fw bx-mail-send'></i> Add Email Automation
                            </button>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('email_automation/templates') ?>'">
                                <i class='bx bx-fw bx-cog'></i> Manage Default Templates
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
                            <td data-name="Texts">Texts</td>
                            <td data-name="Active">Active</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody id="email_automation_container"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadEmailAutomations();

        $(document).on("change", ".email-auto-switch", function() {
            let id = $(this).attr("data-id");
            let isActive = $(this).prop("checked") ? 1 : 0;
            let url = "<?php echo base_url(); ?>email_automation/_update_automation_is_active";

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    automation_id: id,
                    is_active: isActive
                },
                dataType: "JSON",
                success: function(result) {
                }
            });
        });

        $(document).on("click", ".delete-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>email_automation/_delete_automation";

            Swal.fire({
                title: 'Delete Email Automation',
                text: "Are you sure you want to delete this Email Automation?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            automationid: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        loadEmailAutomations();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });
    });

    function loadEmailAutomations() {
        let _container = $("#email_automation_container");
        let url = "<?php echo base_url(); ?>email_automation/_load_automation_list";

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