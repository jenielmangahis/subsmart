<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>
<style>
table {
    width: 100% !important;
}
#custom-fields-table_filter, #custom-fields-table_length, #custom-fields-table_info{
    display: none;
}
table.dataTable thead th, table.dataTable thead td {
padding: 10px 18px;
border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
        border-bottom: 0px solid #111; 
        margin-bottom: 10px;
}
.nsm-table tr:not(.nsm-row-collapse) td:not(:last-child) {    
    max-width: initial !important;
}
</style>
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
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">                            
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field_custom" placeholder="Search Item">
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="custom-fields-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Custom Field Name">Custom Field Name</td>                            
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($inventoryCustomFields)) : ?>                        
                            <?php foreach ($inventoryCustomFields as $field) : ?>
                                <tr>
                                    <td><div class="table-row-icon"><i class='bx bx-cube'></i></div></td>
                                    <td class="f"><?= $field->name ?></td>                                
                                    <td class="text-end">
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item update-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-custom-field-modal" data-id="<?=$field->id?>" data-name="<?=$field->name?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $field->id?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>                                    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">
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
        /* $("#custom-fields-table").nsmPagination({
            itemsPerPage: 20
        }); */
        var CUSTOM_FIELD_TBL = $("#custom-fields-table").DataTable({
            "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
            "columns": [
                { "width": "1%" },
                { "width": "90%" },
                null        
            ]
        });

        $("#search_field_custom").keyup(function() {
            CUSTOM_FIELD_TBL.search($(this).val()).draw()
        });        

        $('#form-add-custom-field').on('submit', function(e){            
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "inventory/_create_custom_field";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                success: function(result) {
                    if (result.is_success === 1) {
                        $("#custom-field-modal").modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Custom field has been created successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }
                    
                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $('#form-update-custom-field').on('submit', function(e){            
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "inventory/_update_custom_field";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                success: function(result) {
                    if (result.is_success === 1) {
                        $("#edit-custom-field-modal").modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Custom field has been upated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }
                    
                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".delete-item", function() {
            let cfid = $(this).attr("data-id");

            Swal.fire({
                title: 'Delete Custom Field',
                text: "Are you sure you want to delete selected item?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "inventory/_delete_custom_field",
                        data: {
                            cfid: cfid
                        },
                        dataType:'json',
                        success: function(result) {
                            console.log(result);
                            if (result.is_success === 1) {
                                Swal.fire({
                                    //title: 'Good job!',
                                    text: "Data Deleted Successfully!",
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
                                    html: result.msg
                                }); 
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".update-item", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            $('#cfid').val(id);
            $('#edit-custom-field-name').val(name);
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>