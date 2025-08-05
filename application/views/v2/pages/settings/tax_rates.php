<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/invoice/invoice_modals'); ?>
<style>
.nsm-table .nsm-badge {
    font-size:13px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
        <i class="bx bx-receipt"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoce_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing all your predefined tax rates.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('settings/tax_rates') ?>" method="get"> 
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find by Name" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>                    
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i> 
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter"> 
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>                         
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_tax_rate_modal">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>                        
                                <td class="table-icon"></td>
                                <td data-name="Name">Name</td>
                                <td data-name="Rate" style="width:10%;">Rate</td>
                                <td data-name="Default" style="width:5%;">Default</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($taxRates)) :
                            ?>
                                <?php
                                foreach ($taxRates as $tax_rate) :
                                    if ($tax_rate['is_default'] == 1):
                                        $value = 'Yes'; 
                                        $badge = "success";
                                    else:
                                        $value = 'No'; 
                                        $badge = "";
                                    endif;
                                ?>
                                    <tr>
                                        <td>
                                            <input class="form-check-input row-select table-select" name="tax_rates[]" type="checkbox" value="<?= $tax_rate['id']; ?>">
                                        </td>                                    
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-dollar-circle'></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary nsm-link default"><?= $tax_rate['name']; ?></td>
                                        <td><?= $tax_rate['rate']; ?></td>
                                        <td><span class="nsm-badge <?= $badge ?>"><?= $value; ?></span></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $tax_rate['id']; ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $tax_rate['id']; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            <?php
                            else :
                            ?>
                                <tr>
                                    <td colspan="6">
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
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '#select-all', function(){
            $('.row-select:checkbox').prop('checked', this.checked);  
            let total= $('input[name="tax_rates[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('input[name="tax_rates[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });      
        
        $(document).on('click', '#with-selected-delete', function(){
            let total= $('input[name="tax_rates[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Tax Rates',
                    html: `Are you sure you want to delete selected tax rates?<br /><br /><small>You will no longer recover this data.</small>`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'settings/_delete_selected_tax_rates',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Tax Rates',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        });           
        
        $(".nsm-table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");

            _form.submit();
        }, 1500));        

        $(document).on("click", ".edit-item", function(){
            let tid = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>settings/ajax_edit_tax_rate";

            $("#tid").val(tid);
            $("#edit_tax_rate_modal").modal("show");

            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o){
                  $("#edit_tax_rate_cont").html(o);
               }
            });
        });

        $(document).on("click", ".delete-item", function(){
            let tid = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>settings/_delete_tax_rate";

            Swal.fire({
                title: 'Delete Tax Rate',
                text: "Are you sure you want to delete selected Tax Rate?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {tid:tid},
                        dataType: 'json',
                        success: function(o){
                            Swal.fire({                                
                                text: "Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>