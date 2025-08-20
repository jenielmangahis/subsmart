<?php include viewPath('v2/includes/header'); ?>
<style>
    @media (max-width: 768px) {
        .activity-log-email {
            display:none !important;
        }
        .table-icon, .collapse, .bx-chevron-down{
            display:none !important;
        }
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/activity_logs_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Track and monitor user activities
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Logs">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">                                
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="nsm-page-buttons page-button-container">                            
                            <button type="button" name="btn_link" class="nsm-button primary" id="btn-export-list">
                                <i class='bx bx-fw bx-export'></i> Export List
                            </button>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="activity-logs">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td class="show" data-name="LogUser" style="width:20%;"></td>                            
                            <td class="show" data-name="LogDetails" style="width:60%;">Activity</td>
                            <td class="show" data-name="LogDate">Date</td>    
                            <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                <td data-name="Manage" style="width:2%;"></td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($activityLogs)){ ?>
                            <?php foreach ($activityLogs as $log) { ?>
                              <tr>
                                <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="logs[]" type="checkbox" value="<?= $log->id; ?>">
                                    </td>
                                <?php } ?>
                                <td><div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($log->user_id); ?>');"></div></td>
                                <td class="nsm-text-primary show">
                                    <label class="d-block fw-bold"><?php echo $log->first_name . ' ' . $log->last_name ?></label>
                                    <label class="content-subtitle activity-log-email fst-italic d-block"><i class='bx bx-envelope'></i><?php echo $log->email; ?></label>
                                </td>                                
                                <td  class="nsm-text-primary show"><?= $log->activity_name; ?></td>
                                <td class="show"><?= date("m/d/Y h:i:s A",strtotime($log->created_at)); ?></td>
                                <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item delete-item" data-name="<?php echo ucwords(strtolower($row->FName)) . ' ' . ucwords(strtolower($row->LName)); ?>" name="btn_delete" href="javascript:void(0);" data-id="<?= $row->id; ?>">Delete</a></li>                                    
                                        </ul>
                                    </div>
                                </td>
                                <?php } ?>
                              </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No data found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#activity-logs").nsmPagination({itemsPerPage:5});

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#activity-logs input[name="logs[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#activity-logs input[name="logs[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-export-list').on('click', function(){
        location.href = base_url + 'activity_logs/export';
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#activity-logs input[name="logs[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Activity Logs',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_archive_selected_users',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Users',
                                    text: "Data deleted successfully!",
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
  });
</script>
<?php include viewPath('v2/includes/footer'); ?>