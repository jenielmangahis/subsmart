<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('appointment_types/index') ?>'">
        <i class='bx bx-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            Appointment Types<br />
                            Make scheduling appointments simple and streamlined with the CRM color setting. Now, with just a few clicks, users can add and assign colors to employees, events, and job types.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_new" class="nsm-button primary btn-create-appointment-type">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name" style="width:80%;">Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($appointmentTypes) > 0) : ?>
                            <?php foreach ($appointmentTypes as $a) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $a->name; ?></td>
                                    <td>
                                        <?php $eid = hashids_encrypt($ch->id, '', 15); ?>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-edit-appointment-type" data-id="<?= $a->id; ?>" data-name="<?= $a->name; ?>" name="dropdown_edit" href="javascript:void(0);">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-delete-appointment-type" name="dropdown_delete" href="javascript:void(0);" data-name="<?= $a->name; ?>" data-id="<?= $a->id; ?>">Delete</a>
                                                </li>
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
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });

    $(document).on('click', '.btn-create-appointment-type', function(){
        $('#create_appointment_type_modal').modal('show');
    });

    $(document).on('click', '.btn-edit-appointment-type', function(){
        var aid   = $(this).data('id');
        var aname = $(this).data('name');

        $('#appointment-type-id').val(aid);
        $('#appointment-type-name').val(aname);

        $('#edit_appointment_type_modal').modal('show');
    });

    $(document).on('submit','#frm-create-appointment-type', function(e){
        e.preventDefault();

        var url = base_url + 'appointment_types/_create_appointment_type';
        $(".btn-save-appointment-type").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-create-appointment-type")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#create_appointment_type_modal").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Appointment type was successfully saved.",
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
                    html: o.msg
                  });
                } 

                $(".btn-save-appointment-type").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-update-appointment-type', function(e){
        e.preventDefault();

        var url = base_url + 'appointment_types/_update_appointment_type';
        $(".btn-update-appointment-type").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-update-appointment-type")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#edit_appointment_type_modal").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Appointment type was successfully saved.",
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
                    html: o.msg
                  });
                } 

                $(".btn-update-appointment-type").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".btn-delete-appointment-type", function(event) {
        var id = $(this).data("id");
        var name = $(this).data("name");

        Swal.fire({
            //title: 'Delete Appointment Type',
            html: "Delete appointment type <b>"+ name +"</b>?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('appointment_types/_delete_appointment_type') ?>",
                    data: {
                        aid: id
                    },
                    success: function(result) {
                        Swal.fire({
                            title: 'Delete Success!',
                            text: "Appointment Type has been deleted successfully.",
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
</script>
<?php include viewPath('v2/includes/footer'); ?>