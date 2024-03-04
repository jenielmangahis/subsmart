<!-- New Customer Modal -->
<div class="modal fade nsm-modal" id="quick-add-lead" tabindex="-1" role="dialog" aria-labelledby="quick-add-leadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:580px;">
            <div class="modal-header mb-0">
                <span id="newcustomerLabel" class="modal-title content-title"><i class='bx bx-plus-medical' ></i> Add New Lead</span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <form id="frm-quick-add-lead">
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Social Security Number</label>
                                <input type="text" name="sss_num" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="phone_cell" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone_home" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" name="zip_code" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="nsm-button primary">Save</button>
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#frm-quick-add-lead").submit(function(e) {
        e.preventDefault(); 
        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "customer/_quick_add_lead",
            data: form.serialize(), 
            dataType:'json',
            success: function(result)
            {
                if(result.is_success == 1){
                    $('#quick-add-lead').modal('hide');
                    Swal.fire({
                        html: 'Lead Added Successfully',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        
                    });                        
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });                        
                }
            }
        });
    });
});
</script>