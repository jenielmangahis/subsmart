<?php include viewPath('v2/includes/header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/jquery.minicolors.css") ?>">
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('workstatus/add') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage Workorder Status
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-add-workstatus">
                                <i class='bx bx-fw bx-checkbox-square'></i> New Workorder Status
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Title" style="width:80%;">Name</td>
                            <td data-name="Color">Color</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($workstatus)) :
                        ?>
                            <?php
                            foreach ($workstatus as $ws) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-checkbox-square'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $ws->title ?></td>
                                    <td><span class="nsm-badge" style="background-color: <?php echo $ws->color ?>; color: #fff;font-size:14px;"><?php echo $ws->color ?></span></td> 
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item btn-edit-workstatus" data-name="<?= $ws->title; ?>" data-color="<?= $ws->color; ?>" data-id="<?= $ws->id; ?>" href="javascript:void(0);">Edit</a></li>
                                                <li><a class="dropdown-item btn-delete-workstatus" data-id="<?= $ws->id; ?>" href="javascript:void(0);">Delete</a></li>
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
    <div class="modal fade nsm-modal fade" id="modal-add-new-work-status" tabindex="-1" aria-labelledby="modal-add-new-work-status_label" aria-hidden="true">
        <div class="modal-dialog">
            <form id="frm-create-workorder-status">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="new_tax_rate_modal_label">Add Workorder Status</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status Name</label> <span class="form-required">*</span>
                            <input type="text" class="form-control" name="title" id="title" required placeholder="Name" autofocus />
                        </div>
                        <div class="form-group mt-3">
                            <label>Color</label> <span class="form-required">*</span>
                            <input type="text" name="color" class="form-control cpicker" data-swatches="#ef9a9a|#90caf9|#a5d6a7|#fff59d|#ffcc80|#bcaaa4|#eeeeee|#f44336|#2196f3|#4caf50|#ffeb3b|#ff9800|#795548|#9e9e9e" value="#ff6161">
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary btn-save-workorder-type">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-work-status" tabindex="-1" aria-labelledby="modal-edit-work-status_label" aria-hidden="true">
        <div class="modal-dialog">
            <form id="frm-update-workorder-status">
                <input type="hidden" name="wtid" id="wtid" />
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="new_tax_rate_modal_label">Edit Workorder Status</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status Name</label> <span class="form-required">*</span>
                            <input type="text" class="form-control" name="title" id="edit-name" required placeholder="Name" autofocus />
                        </div>
                        <div class="form-group mt-3">
                            <label>Color</label> <span class="form-required">*</span>
                            <input type="text" id="edit-color" name="color" class="form-control cpicker" data-swatches="#ef9a9a|#90caf9|#a5d6a7|#fff59d|#ffcc80|#bcaaa4|#eeeeee|#f44336|#2196f3|#4caf50|#ffeb3b|#ff9800|#795548|#9e9e9e" value="#ff6161">
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary btn-save-workorder-type">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination();
        
    $('.cpicker').minicolors({
        swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
        theme: 'bootstrap'
    });

    $('.btn-edit-workstatus').on('click', function(){
        var wtid    = $(this).attr('data-id');
        var wcolor  = $(this).attr('data-color');
        var wname   = $(this).attr('data-name');

        $('#wtid').val(wtid);
        $('#edit-name').val(wname);
        $('#edit-color').val(wcolor);

        $('#modal-edit-work-status').modal('show');
    });

    $('.btn-add-workstatus').on('click', function(){
        $('#modal-add-new-work-status').modal('show');
    });

    $("#frm-create-workorder-status").submit(function(e){
        e.preventDefault();
        var url = base_url + 'workstatus/_create_workorder_type';
        $(".btn-save-workorder-type").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: url,
                data: $('#frm-create-workorder-status').serialize(),
                dataType: 'json',
                success: function(o)
                {
                    if( o.is_success == 1 ){
                        $('#modal-add-new-work-status').modal('hide');
                        Swal.fire({
                            //title: 'Success',
                            text: 'Workorder status was successfully created.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data.',
                        text: o.msg
                        });
                    }

                    $(".btn-save-workorder-type").html('Save');
                }
            });
        }, 300);        
    });
    

    $("#frm-update-workorder-status").submit(function(e){
        e.preventDefault();
        var url = base_url + 'workstatus/_update_workorder_type';
        $(".btn-update-workorder-type").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                 type: "POST",
                 url: url,
                 data: $('#frm-update-workorder-status').serialize(),
                 dataType: 'json',
                 success: function(o)
                 {
                    if( o.is_success == 1 ){
                        $('#modal-edit-work-status').modal('hide');

                        Swal.fire({
                            //title: 'Success',
                            text: 'Workorder status was successfully updated.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot update data.',
                          text: o.msg
                        });
                    }

                    $(".btn-update-workorder-type").html('Save');
                 }
            });
        }, 300);        
    });

    $('.btn-delete-workstatus').on('click',function(){
        var wtid = $(this).attr('data-id');
        Swal.fire({
            title: 'Delete seleted Workorder Status?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('workstatus/_delete_workorder_status'); ?>",
                    data: {wtid: wtid}, 
                    dataType:'json',
                    success: function(data) {
                        if (data.is_success === 1) {
                            Swal.fire({
                                icon: 'success',
                                //title: 'Success',
                                text: 'Data deleted successfully!',
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to Delete Job!',
                            });
                        }
                    }
                });
            }
        });
    });    
});    
</script>
<?php include viewPath('v2/includes/footer'); ?>