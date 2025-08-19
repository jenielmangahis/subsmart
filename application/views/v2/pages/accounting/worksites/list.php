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

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">                            
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>                        

                        <div class="nsm-page-buttons page-button-container">                            
                            <?php //if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <div class="btn-group nsm-main-buttons" style="margin-bottom: 4px !important;">
                                <button type="button" class="btn btn-nsm" data-bs-toggle="modal" data-bs-target="#add-worksite-modal"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Worksite</button>
                            </div>
                            <?php //} ?>
                        </div>

                    </div>
                </div>
                <form id="frm-with-selected">
                    <input type="hidden" name="with_selected_action" value="" id="with-selected-action" />                
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
                </form>
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
    
    $('.btn-with-selected').on('click', function(){
        var action = $(this).attr('data-action');

        var total_selected = $('input[name="row_selected[]"]:checked').length;
        if( total_selected > 0 ){
            if( action == 'delete' ){
                var msg = 'Proceed with <b>deleting</b> selected rows?';
                var url = base_url + 'accounting/worksites/_delete_selected';
                $('#with-selected-action').val('delete');
            }

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

})

</script>

<?php include viewPath('v2/includes/footer'); ?>