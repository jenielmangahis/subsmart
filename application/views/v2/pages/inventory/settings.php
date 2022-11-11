<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#custom-field-modal">
                                <i class='bx bx-fw bx-list-plus'></i> New Field
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="custom-fields-table">
                    <thead>
                        <tr>
                            <td data-name="Custom Field Name">Custom Field Name</td>
                            <td data-name="Date Created">Date Created</td>
                            <td data-name="Date Updated">Date Updated</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($fields)) : ?>
                        <?php foreach ($fields as $field) : ?>
                        <tr>
                            <tr>
                                <td class="fw-bold nsm-text-primary"><?=$field->name?></td>
                                <td><?=$field->created_at?></td>
                                <td><?=$field->updated_at?></td>
                                <td class="text-end">
                                    <button class="nsm-button btn-sm m-0 me-2 update-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#custom-field-modal" field-id="<?=$field->id?>" field-name="<?=$field->name?>">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
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
        $("#custom-fields-table").nsmPagination({
            itemsPerPage: 20
        });

        $(document).on("click", ".update-item", function() {
            let id = $(this).attr('field-id');
            let name = $(this).attr('field-name');
            $('#custom-field-modal form').attr('action', `${base_url}inventory/update-custom-field/${id}`);
            $('#custom-field-name').val(name);
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>