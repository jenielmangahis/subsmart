<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/users/payscale_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#add_payscale_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage Payscale.
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search List">
                        </div>
                    </div>   
                    <div class="col-8 grid-mb text-end">                        
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">                          
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <?php if(checkRoleCanAccessModule('user-payscale', 'write')){ ?>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#add_payscale_modal"><i class='bx bx-fw bx-plus'></i> Create Payscale</button>  
                            <?php } ?>                         
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">           
                <table class="nsm-table" id="tbl-payscale-list">
                    <thead>
                        <tr>
                            <td><input type="checkbox" class="form-check-input" id="chk-all-row" /></td>
                            <td data-name="Pay Scale" style="width:70%;">Pay Scale</td>
                            <td data-name="Pay Type" style="width:30%;">Pay Type</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($payscale)) : ?>
                            <?php foreach ($payscale as $p) : ?>
                                <tr>
                                    <td>
                                        <?php if( $p->company_id > 0 ){ ?>
                                        <input type="checkbox" name="row_selected[]" class="form-check-input chk-row" value="<?= $lt->id; ?>" />
                                        <?php } ?>
                                    </td>
                                    <td class="nsm-text-primary"><?= $p->payscale_name; ?></td>
                                    <td class="nsm-text-primary"><?= $p->pay_type; ?></td>
                                    <td>
                                        <?php if( $p->company_id > 0 ){ ?>
                                        <div class="dropdown table-management">                                            
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>                                            
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('user-payscale', 'write')){ ?>
                                                    <li><a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $p->id ?>" data-name="<?= $p->payscale_name; ?>" data-type="<?= $p->pay_type; ?>">Edit</a></li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('user-payscale', 'delete')){ ?>
                                                    <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $p->id ?>">Delete</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php } ?>
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
                </form>
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

        $('#chk-all-row').on('change', function(){
            $('#tbl-payscale-list .chk-row:checkbox').prop('checked', this.checked);  
            let total= $('#tbl-payscale-list input[name="row_selected[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.chk-row', function(){
            let total= $('#tbl-payscale-list input[name="row_selected[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $('.btn-with-selected').on('click', function(){
            var action = $(this).attr('data-action');

            var total_selected = $('input[name="row_selected[]"]:checked').length;
            if( total_selected > 0 ){
                var msg = 'Proceed with <b>deleting</b> selected rows?';
                var url = base_url + 'users/_delete_selected_payscale';

                Swal.fire({
                    title: 'With Selected Action',
                    html: msg,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: $('#frm-with-selected').serialize(),
                            dataType:'json',
                            success: function(result) {
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: result.msg,
                                    }).then((result) => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            }
                        });
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select row',
                });
            }        
        });

        $("#add_payscale_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            let url = "<?php echo base_url('users/_add_payscale'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "New pay scale has been added successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });

                        $("#add_payscale_modal").modal('hide');
                        _this.trigger("reset");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".edit-item", function() {
            let _this = $(this);
            let _modal = $("#edit_payscale_modal");
            let name = _this.attr("data-name");
            let type = _this.attr('data-type');
            let id = _this.attr("data-id");
            console.log(name);

            _modal.find("input[name=payscale_name]").val(name);
            _modal.find("input[name=pid]").val(id);
            _modal.find(".pay-type").val(type);
            _modal.modal("show");
        });

        $("#edit_payscale_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            let url = "<?php echo base_url('users/_update_payscale'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Pay scale was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });

                        $("#edit_payscale_modal").modal('hide');
                        _this.trigger("reset");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });        

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Pay Scale',
                text: "Are you sure you want to delete this pay scale?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>users/_delete_payscale",
                        data: {
                            pid: id
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Success',
                                    text: "Pay scale was successfully deleted.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
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
</script>
<?php include viewPath('v2/includes/footer'); ?>