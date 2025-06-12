<style>
.customer-info-heading{
	background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
</style>
<!-- New Customer Modal -->
<div class="modal fade nsm-modal" id="new_customer" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-0">
                <span id="newcustomerLabel" class="modal-title content-title">Add New Customer</span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">                     
                    <div class="row">  
                        <div class="col-md-12">
                            <div class="nsm-card primary" style="overflow-y:auto;max-height:800px;">                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-check" style="float:right;">
                                            <input class="form-check-input" type="checkbox" value="1" name="customer-add-billing-information" id="chk-show-billing">
                                            <label class="form-check-label" for="chk-show-billing">
                                                Show Billing Information
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h1 class="customer-info-heading"><i class="bx bx-fw bx-user"></i>Customer Information</h1>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Customer Type</label>
                                            <select id="customer_type" name="customer_type" class="form-control">
                                                <option value="Residential">Residential</option>
                                                <option value="Commercial">Commercial</option>
                                            </select>
                                        </div>                            
                                    </div> 
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
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Social Security Number</label>
                                            <input type="text" name="ssn" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control searchable-dropdown">
                                                <?php foreach($customerStatus as $status){ ?>
                                                    <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                                                <?php } ?>
                                            </select>
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
                                <div class="add-billing-information-container"></div>
                            </div>
                        </div>                        
                    </div>                    
                    <div class="row mt-2">
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

    $("#new_customer_form").submit(function(e) {
        e.preventDefault(); 
        
        $.ajax({
            type: "POST",
            url: base_url + "/customer/add_new_customer_from_jobs",
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data)
            {
                $("#select_with_data").append('<option value="5">Twitter</option>');
                $("#select_with_data").val('5');
                $("#select_with_data").trigger('change');
                if(data === "Success"){
                    sucess_add('Customer Added Successfully!',1);
                }else {
                    warning('There is an error adding Customer. Contact Administrator!');
                }
            }
        });
    });

    $('#chk-show-billing').on('change', function(){
        if( $(this).is(':checked') ){
            $.ajax({
                type: "POST",
                url: base_url + 'customer/_customer_add_billing_information',
                success: function(o) {
                    $('.add-billing-information-container').html(o);
                }, beforeSend: function() {
                    $(".add-billing-information-container").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        }else{
            $(".add-billing-information-container").html('');
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

    $('.searchable-dropdown').select2({
        dropdownParent: $('#new_customer')
    });
});
</script>