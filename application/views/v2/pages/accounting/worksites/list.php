<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/worksite_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <?php if( $this->session->flashdata() ) { ?>

                            <?php if($this->session->flashdata('success')) { ?>
                                <div class="nsm-callout warning">
                                    <button><i class='bx bx-x'></i></button>
                                    <?php echo $this->session->flashdata('success')?>
                                </div> 
                            <?php } else { ?>
                                <div class="nsm-callout warning">
                                    <button><i class='bx bx-x'></i></button>
                                    <?php echo $this->session->flashdata('error')?>
                                </div> 
                            <?php } ?>                            

                        <?php } else { ?>

                            <div class="nsm-callout primary">
                                <button><i class='bx bx-x'></i></button>
                                Get started by adding a worksite.
                            </div>     

                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- 
                        <form action="<?php //echo base_url('accounting/worksites') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find a worksites" value="<?=!empty($search) ? $search : ''?>">
                            </div>
                        </form>
                        -->

                        <form action="<?php echo base_url('accounting/worksites') ?>" method="get">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find a worksites" value="<?=!empty($search) ? $search : ''?>" style="width:90%; display:inline-block;">                     
                            <button class="nsm-button primary" id="btn-search-list" type="submit"><i class='bx bx-search-alt-2'></i></button>
                        </form>                        
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">

                        <!-- 
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>           
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Status</label>
                                        <select class="nsm-field form-select filter-contractor-status" name="filter_type" id="filter-contractor-status">  
                                            <option value="all" <?=$status == 'all' ? 'selected' : ''?>>All</option>          
                                            <option value="active" <?=$status == 'active' ? 'selected' : ''?>>Active</option>
                                            <option value="inactive" <?=$status == 'inactive' ? 'selected' : ''?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-filter-contractor-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        -->

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add-worksite-modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add Worksite
                            </button>

                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="worksite-table">
                    <thead>
                        <tr>
                            <td><input type="checkbox" class="form-check-input" id="chk-all-row" /></td>
                            <td data-name="Name">NAME</td>
                            <td style="width: 70%;" data-name="Address">ADDRESS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($worksites) > 0) : ?>
						<?php foreach($worksites as $worksite) : ?>
                            <tr data-id="<?=$worksite->id?>" data-name="<?=$worksite->name?>">
                                <td><input type="checkbox" name="row_selected[]" class="form-check-input chk-row" value="<?= $worksite->id; ?>" /></td>
                                <td class=""><strong><?= $worksite->name ?></strong></td>
                                <td><?php echo $worksite->street . ", " . $worksite->city . ", " . $worksite->state . ", " . $worksite->zip_code; ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-worksite" id="edit-worksite" data-bs-toggle="modal" data-bs-target="#edit-worksite-modal" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-worksite" href="#">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
						<?php else : ?>
                            <tr>
                                <td colspan="14">
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

<script>

$(document).ready(function() {
    $("#worksite-table").nsmPagination({itemsPerPage:10});

    $('#apply-filter-contractor-button').on('click', function() {
        var filterType = $('.filter-contractor-status').val();            
        var url = `${base_url}accounting/worksites?`;
        url += filterType !== 0 ? `status=${filterType}&` : '';
        if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
            url = url.slice(0, -1); 
        }
        location.href = url;
    });

    $('.delete-worksite').on('click', function(e) {
        e.preventDefault();

        var row = $(this).closest('tr');
        var id = row.data().id;

        Swal.fire({
            html: 'Are you sure you want to delete this worksite?',
            icon: 'question',
            showCloseButton: false,
            confirmButtonText: 'Yes',
            showCancelButton: true,
            cancelButtonText: 'No',
        }).then((result) => {
            if(result.isConfirmed) {
                location.href= base_url+`accounting/worksites/delete/${id}`;
            }
        });
    });    

    $(".edit-worksite").on('click', function(e) {
        e.preventDefault();

        var row = $(this).closest('tr');
        var id = row.data().id;

        $.get(base_url + `accounting/worksites/get-details/${id}`, function(res) {
            var worksite = JSON.parse(res);

            $('#edit-worksite-modal #worksite-id').val(worksite.id);
            $('#edit-worksite-modal #name').val(worksite.name);
            $('#edit-worksite-modal #street').val(worksite.street);
            $('#edit-worksite-modal #city').val(worksite.city);
            $('#edit-worksite-modal #state').val(worksite.state);
            $('#edit-worksite-modal #zip-code').val(worksite.zip_code);

            $('#edit-worksite-modal form').attr('action', base_url + `accounting/worksites/${id}/update-details`);
            //$('#contractor-modal').modal('show');
        });
    });

    $('#chk-all-row').on('change', function(){
        if( $(this).prop('checked') ){
            $('.chk-row').prop('checked',true);
        }else{
            $('.chk-row').prop('checked',false);
        }
    });    

})

</script>

<?php include viewPath('v2/includes/footer'); ?>