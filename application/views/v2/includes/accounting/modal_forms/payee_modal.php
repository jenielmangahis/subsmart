<div id="payee-modal" class="modal fade modal-fluid nsm-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <form id="new-payee-form" class="w-50 m-auto">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">New Payee</span>
                    <button type="button" class="cancel-add-payee" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col-6">
                            <label for="name"><span class="text-danger">*</span> First Name</label>
                            <input type="text" name="first_name" id="first_name" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-6">
                            <label for="name"><span class="text-danger">*</span> Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-12" id="business_name_container" style="display: none;">
                            <label for="business_name"><span class="text-danger"></span> Business Name</label>
                            <input type="text" name="business_name" id="business_name" class="nsm-field form-control mb-2">
                        </div>
                        <?php if ($type !== 'vendor' && $type !== 'customer') : ?>
                            <div class="col-12">
                                <label for="name">Type</label>
                                <select name="payee_type" id="payee_type" class="nsm-field form-control">
                                    <option value="vendor">Vendor</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class="col-12" style="margin-top: 10px">
                            <div class="row">
                                <div class='customer-section'></div>
                            </div>
                        </div>
                        <?php if ($type === 'customer') : ?>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input data-type="customer_email" type="email" class="form-control nsm-field mb-2" name="email" id="email" required />
                            </div>
                            <div class="col-12">
                                <label for="phone-m">Mobile</label>
                                <input type="text" class="form-control nsm-field payee_phone_number mb-2" maxlength="12" placeholder="xxx-xxx-xxxx" name="mobile" id="phone-m" required />
                            </div>
                            <div class="col-12 mb-2">
                                <label for="customer-type">Customer Type</label>
                                <select id="customer-type" name="customer_type" data-customer-source="dropdown" class="form-control input_select" required>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="street">Address</label>
                                <input name="street" id="street" class="form-control nsm-field mb-2" placeholder="Street" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="city" type="text" class="form-control nsm-field mb-2" placeholder="City" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="state" type="text" class="form-control nsm-field mb-2" placeholder="State" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="zip_code" type="text" class="form-control nsm-field mb-2" placeholder="ZIP Code" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="country" type="text" class="form-control nsm-field mb-2" placeholder="Country">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <?php if ($type === 'vendor' || $type === 'payee') : ?>
                        <button type="button" class="nsm-button" id="add-payee-details"><i class="bx bx-fw bx-plus"></i> Details</button>
                    <?php endif; ?>
                    <button type="submit" class="nsm-button success float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
 
    $(function() {
        $(document).on('keyup', '.payee_phone_number', function(e) {
            var input = $(this).val();

            // Remove non-numeric characters
            input = input.replace(/\D/g, '');

            // Formatting the phone number (xxx-xxx-xxxx)
            if (input.length > 3 && input.length <= 6) {
                input = input.slice(0, 3) + '-' + input.slice(3);
            } else if (input.length > 6) {
                input = input.slice(0, 3) + '-' + input.slice(3, 6) + '-' + input.slice(6, 10);
            }

            // Set the formatted value back into the input
            $(this).val(input);
        });
    });
</script>

<script>
    $(document).ready(function() {
        console.log("Document is ready!");

        $('#customer-type').change(function() {
            var customerType = $(this).val();
            console.log('Customer Type:', customerType);
            var businessNameContainer = $('#business_name_container');

            if (customerType === 'Commercial') {
                console.log('Showing business name input');
                businessNameContainer.show();
            } else {
                console.log('Hiding business name input');
                businessNameContainer.hide();
            }
        });

    });
</script>