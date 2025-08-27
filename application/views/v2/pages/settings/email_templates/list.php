<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('settings/email_templates_create') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

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
                            Customize your emails that are sent on different events.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('settings-email-templates', 'write')){ ?>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button name="btn_link" type="button" class="nsm-button primary" onclick="location.href='<?= base_url('settings/email_templates_create') ?>'">
                                <i class='bx bx-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Template Name" style="width:70%;">Template Name</td>
                            <td data-name="Type">Template Type</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($invoice_templates)) :
                        ?>
                            <?php
                            foreach ($invoice_templates as $invoice_template) :
                                switch ($invoice_template->type_id):
                                    case 1:
                                        $type_name = 'Invoice';
                                        break;
                                    case 2:
                                        $type_name = 'Estimate';
                                        break;
                                    case 3:
                                        $type_name = 'Schedule';
                                        break;
                                    case 4:
                                        $type_name = 'Review';
                                        break;
                                    case 5:
                                        $type_name = 'Notes';
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-envelope'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('settings/email_templates_edit/') . $invoice_template->id; ?>'"><?= $invoice_template->title; ?></label>
                                    </td>
                                    <td><?= $type_name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('settings-email-templates', 'write')){ ?>
                                                    <li><a class="dropdown-item" name="dropdown_edit" href="<?= base_url('settings/email_templates_edit/').$invoice_template->id; ?>">Edit</a></li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('settings-email-templates', 'delete')){ ?>
                                                    <li><a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-id="<?php echo $invoice_template->id; ?>" data-name="<?= $invoice_template->title; ?>">Delete</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');
            let template_name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Email Template',
                html: "Are you sure you want to delete email template <b>" + template_name + "</b>?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "settings/_delete_email_template",
                        data: {tid: id},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ){
                                Swal.fire({
                                    title: 'Email Template',
                                    text: "Email template has been added successfully.",
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
                                    title: 'Error',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    
                                });
                            }
                            
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>