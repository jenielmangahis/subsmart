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

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_automation_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Set your own email templates and select them when building an automation.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">                            
                            <button type="button" name="btn_add_email_automation" class="nsm-button" onclick="location.href='<?php echo url('email_automation/add_template') ?>'">
                                <i class='bx bx-fw bx-mail-send'></i> Add Template
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Automation Name">Template Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($emailAutomationTemplates) > 0) : ?>
                            <?php foreach($emailAutomationTemplates as $template) { ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $template->name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-edit-appointment-type" name="dropdown_edit" href="<?= base_url("email_automation/edit_template/" . $template->id) ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-delete-template" name="dropdown_delete" data-id="<?php echo $template->id; ?>" href="javascript:void(0);" data-name="<?php echo $template->name; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });

    $(document).on("click", ".btn-delete-template", function(e) {
        var tid = $(this).attr("data-id");
        var template_name = $(this).attr('data-name');
        var url = base_url + 'email_automation/_delete_template';

        Swal.fire({
            title: 'Delete Template',
            html: "Are you sure you want to delete template <b>"+template_name+"</b>?",
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
                    data: {tid:tid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Email Automation Template Deleted Successfully!",
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