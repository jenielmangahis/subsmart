<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/payment_terms_modals'); ?>

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
                            Every freelancer or small business owner has been there. You complete a project, send out the invoice, and get back nothing but silence. Maybe your invoice is sitting forgotten in your client's inbox. Or, perhaps, they've chosen to skip out on paying you for your work. Fortunately, carefully crafting your invoice wording for immediate payment can help you separate the former from the latter. You can do that here.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/terms') ?>" method="get">
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
                            <!-- <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-file'></i> Run Report
                            </button> -->
                            <button type="button" class="nsm-button primary" id="add-payment-term-button">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_payment_terms_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <!-- 
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Other</p>
                                <div class="form-check">
                                    <input type="checkbox" id="inc_inactive" class="form-check-input" <?=$inactive ? 'checked' : ''?>>
                                    <label for="inc_inactive" class="form-check-label">Include inactive</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            50
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                    </ul>
                                </div>
                            </ul>
                            -->
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                    <table class="nsm-table" id="payment-terms-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>                              
                                <td data-name="Name">NAME</td>
                                <td data-name="Status">STATUS</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($terms) > 0) : ?>
                            <?php foreach($terms as $term) : ?>
                            <tr data-id="<?=$term['id']?>">
                                <td>
                                    <input class="form-check-input row-select table-select" name="terms[]" type="checkbox" value="<?= $term['id']; ?>">
                                </td>                                
                                <td class="fw-bold nsm-text-primary nsm-link default"><?=$term['name']?></td>
                                <?php 
                                    $status = "";
                                    $badge  = "";
                                    if($term['status'] == 1) {
                                        $badge = "success";
                                        $status = "Active";
                                    }elseif($term['status'] == 0) {
                                        $badge = "error";
                                        $status = "Inactive";
                                    }
                                ?>
                                <td class="fw-bold nsm-text-primary nsm-link default">
                                    <span class="status-label nsm-badge <?= $badge ?>"><?php echo $status; ?></span>
                                </td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <?php if($term['status'] === '1') : ?>
                                            <li>
                                                <a class="dropdown-item edit-term" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item term-status" href="javascript:void(0);" data-id="<?= $term['id']; ?>" data-status="0">Make Inactive</a>
                                            </li>
                                            <?php else : ?>
                                            <li>
                                                <a class="dropdown-item term-status" href="javascript:void(0);" data-id="<?= $term['id']; ?>" data-status="1">Make Active</a>
                                            </li>
                                            <?php endif; ?>
                                            <li>
                                                <a class="dropdown-item delete-term" href="javascript:void(0);" data-id="<?= $term['id']; ?>">Delete</a>
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
                </form>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('input[name="terms[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('input[name="terms[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });      
    
    $(document).on('click', '#with-selected-delete', function(){
        let total= $('input[name="terms[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Payment Terms',
                html: `Are you sure you want to delete selected terms?<br /><br /><small>You will no longer recover this data.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'accounting/payment_terms/_delete_selected_payment_terms',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Terms',
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
    
    $(document).on("click", ".delete-term", function(){
        let tid = $(this).attr("data-id");
        let url = "<?php echo base_url(); ?>accounting/terms/_delete_term";

        Swal.fire({
            title: 'Delete Tax Rate',
            text: "Are you sure you want to delete selected Payment term?",
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
                            location.reload();
                        });
                    }
                });
            }
        });
    });    

    
    $(document).on("click", ".term-status", function(){
        let tid = $(this).attr("data-id");
        let t_status = $(this).attr("data-status");
        let turl = "<?php echo base_url(); ?>accounting/terms/_update_status";

        if(t_status == 0) {
            var swal_text = "Are you sure you want to change term status to Inactive?";
        } else {
            var swal_text = "Are you sure you want to change term status to Active?";
        }

        Swal.fire({
            title: 'Change Term Status',
            text: swal_text,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: turl,
                    data: {
                        tid:tid,
                        t_status:t_status
                    },
                    dataType: 'json',
                    success: function(o){
                        Swal.fire({                                
                            text: "Status Successfully Change!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });       
})

</script>

<?php include viewPath('v2/includes/footer'); ?>