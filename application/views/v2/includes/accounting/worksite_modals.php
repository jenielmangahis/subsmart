<div class="modal fade nsm-modal" id="add-worksite-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- <form action="<?php echo base_url() ?>accounting/worksites/add-work-location" method="post" id="add-worksite-form" class="form-validate"> -->
        <form method="post" id="add-worksite-form" class="add-worksite-form" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Work Location</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control nsm-field" id="name" name="name" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="street">Street</label>
                            <input type="text" class="form-control nsm-field" id="street" name="street" required>
                        </div>
                        <div class="col-12 col-md-6 mt-2">
                            <label for="city">City</label>
                            <input type="text" class="form-control nsm-field" id="city" name="city" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control nsm-field" id="state" name="state" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="zip-code">ZIP code</label>
                            <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" id="btn-modal-add-work-location" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal edit-worksite-modal" id="edit-worksite-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" method="post" id="update-worksite-form" class="form-validate">
            <input type="hidden" name="worksite_id" id="worksite-id" />
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Work Location</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control nsm-field" id="name" name="name" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="street">Street</label>
                            <input type="text" class="form-control nsm-field" id="street" name="street" required>
                        </div>
                        <div class="col-12 col-md-6 mt-2">
                            <label for="city">City</label>
                            <input type="text" class="form-control nsm-field" id="city" name="city" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control nsm-field" id="state" name="state" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="zip-code">ZIP code</label>
                            <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" id="btn-modal-edit-work-location" class="nsm-button primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>

$(function() {

    $('#add-worksite-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "accounting/worksites/_save_worksite",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {
                $('#btn-modal-add-work-location').html('Save');
                if (data.is_success) {
                    $('#add-worksite-modal').modal('hide');

                    /*
                    var employee_details = data.employee_details;
                    $.each(employee_details, function(index) {
                        console.log(employee_details[index]);
                        var employee_number = employee_details[index].employee_number;      
                        var hire_date = employee_details[index].hire_date;   
                        var employee_status = employee_details[index].employee_status;
                        var worker_company_class = employee_details[index].worker_company_class;
                        var employee_title = employee_details[index].employee_title;
                        
                        $(`#emp-details-worker-company-class`).text(worker_company_class);
                        $(`#emp-details-employee-title`).text(employee_title);
                        $(`#emp-details-status`).text(employee_status);
                        $(`#emp-hire-date`).text(hire_date);  
                        $(`#emp-details-employee-number`).text(employee_number);                   
                    });
                    */

                    Swal.fire({
                        text: "Worksite location sucessfully added",
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
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {

                    });
                }
            },
            beforeSend: function() {
                $('#btn-modal-add-work-location').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#update-worksite-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "accounting/worksites/_update_worksite",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {
                $('#btn-modal-edit-work-location').html('Update');
                if (data.is_success) {
                    $('#edit-worksite-modal').modal('hide');

                    /*
                    var employee_details = data.employee_details;
                    $.each(employee_details, function(index) {
                        console.log(employee_details[index]);
                        var employee_number = employee_details[index].employee_number;      
                        var hire_date = employee_details[index].hire_date;   
                        var employee_status = employee_details[index].employee_status;
                        var worker_company_class = employee_details[index].worker_company_class;
                        var employee_title = employee_details[index].employee_title;
                        
                        $(`#emp-details-worker-company-class`).text(worker_company_class);
                        $(`#emp-details-employee-title`).text(employee_title);
                        $(`#emp-details-status`).text(employee_status);
                        $(`#emp-hire-date`).text(hire_date);  
                        $(`#emp-details-employee-number`).text(employee_number);                   
                    });
                    */

                    Swal.fire({
                        text: "Worksite location sucessfully updated",
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
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {

                    });
                }
            },
            beforeSend: function() {
                $('#btn-modal-edit-work-location').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });    
 
});



</script>