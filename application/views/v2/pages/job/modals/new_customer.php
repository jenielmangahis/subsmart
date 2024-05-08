<!-- New Customer Modal -->
<div class="modal fade nsm-modal" id="new_customer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:580px;">
            <div class="modal-header mb-0">
                <span id="newcustomerLabel" class="modal-title content-title"><i class='bx bx-plus-medical' ></i> Add New Customer</span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">
                    <div class="row">   
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label>Customer Type</label>
                                <select id="customer_type" name="customer_type" class="form-control">
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>                            
                        </div>  
                        <hr />
                    </div>             
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
                                <input type="text" name="ssn" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 grp-customer-business" style="display:none;">
                            <div class="form-group">
                                <label>Business Name</label>
                                <input type="text" name="business_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="phone_m" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone_h" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="mail_add" class="form-control" required>
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
                                <button type="button" id="NEW_CUSTOMER_MODAL_CLOSE" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="new_customer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Add new customer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">
                    <div class="contact-info">
                        <div class="row">
    
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Middle Initial</label>
                                            <input type="text" name="middle_name" class="form-control" placeholder="optional" >
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone_h" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="mail_add" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input type="text" name="zip_code" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div> -->
<script>
$(function(){
    $('#customer_type').on('change', function(){
        var type = $(this).val();
        if( type == 'Commercial' ){
            $('.grp-customer-business').show();
        }else{
            $('.grp-customer-business').hide();
        }
    });

    $('#new_customer').on('shown.bs.modal', function (e) {
        $('#new_customer_form')[0].reset();
    });

    $('.phone_number').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
});
</script>