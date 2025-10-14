<div class="nsm-card primary">
    <div class="nsm-card-content">  
        <div class="row">

            <div class="col-12 mb-2">
                <label class="content-subtitle fw-bold d-block mb-2">When</label>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <input type="text" name="appointment_date" id="appointment_date" value="<?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?>" class="nsm-field form-control edit-datepicker" placeholder="Date" required style="padding: 0.375rem 0.75rem;">                                    
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="time" name="appointment_time_from" id="appointment_time" class="nsm-field form-control" value="<?= date("H:i:s", strtotime($appointment->appointment_time_from)); ?>" placeholder="Time From" required />
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="time" name="appointment_time_to" id="appointment_time_to" class="nsm-field form-control" placeholder="Time To" value="<?= date("H:i:s", strtotime($appointment->appointment_time_to)); ?>" required />
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                <select name="appointment_type_id" class="nsm-field form-select edit-appointment-type" required>
                    <?php foreach ($appointmentTypes as $a) { ?>
                        <option <?= $appointment->appointment_type_id == $a->id ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <label class="content-subtitle fw-bold d-block mb-2">Priority</label>
                <select name="appointment_priority" class="nsm-field form-select edit-appointment-priority" required>
                    <?php if( $appointment->appointment_type_id == 4 ){ ?>
                        <?php foreach($appointmentPriorityEventOptions as $priority){ ?>
                            <option value="<?= $priority; ?>"><?= $priority; ?></option>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php foreach($appointmentPriorityOptions as $priority){ ?>
                            <option value="<?= $priority; ?>"><?= $priority; ?></option>
                        <?php } ?>
                    <?php } ?>                
                </select>   
                <input type="text" value="" name="appointment_priority_others" placeholder="Please specify" class="nsm-field form-select priority-others" style="margin-top:5px;display: none;">   
            </div>
            <div class="col-12 mb-2 edit-event-description-container" style="<?= $appointment->appointment_type_id != 4 ? 'display: none;' : ''; ?>">
                <label class="content-subtitle fw-bold d-block mb-2">Event Name</label>
                <span id="wait-list-created-by">
                    <input type="text" value="<?= $appointment->event_name; ?>" name="appointment_event_name" class="nsm-field form-control" />
                </span>                                                        
            </div>
            <div class="col-12 mb-2 edit-event-description-container" style="<?= $appointment->appointment_type_id != 4 ? 'display: none;' : ''; ?>">
                <label class="content-subtitle fw-bold d-block mb-2">Event Location</label>
                <span id="wait-list-created-by">
                    <textarea name="appointment_event_location" class="nsm-field form-control"><?= $appointment->event_location ?></textarea>
                </span>                                                        
            </div>
            <div class="col-12 mb-2 edit-attendees-container" style="<?= $appointment->appointment_type_id == 4 || $appointment->appointment_type_id == 1 || $appointment->appointment_type_id == 2 || $appointment->appointment_type_id == 3 ? 'display: block;' : 'display:none'; ?>">
                <label class="content-subtitle fw-bold d-block mb-2 edit-tech-attendees quick-edit-create-tech-attendees">Attendees</label>
                <span id="quick-edit-employee-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_user_id[]" id="edit-appointment-user" multiple="multiple">
                        <?php foreach($attendees as $key => $user){ ?>
                            <option value="<?= $user['id']; ?>" selected><?= $user['name']; ?></option>
                        <?php } ?>
                    </select>
                </span>                                                        
            </div>
            <div class="col-12 mb-2 edit-appointment-sales-agent" <?= ( $appointment->appointment_type_id == 3 || $appointment->appointment_type_id == 1 ) ? '' : 'style="display:none;"'; ?>>
                <label class="content-subtitle fw-bold d-block mb-2">Sales Agent</label>
                <span id="wait-list-add-sales-agent-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_sales_agent_id" id="edit-appointment-sales-agent-id">
                        <?php if($salesAgent){ ?>
                            <option value="<?= $salesAgent->id; ?>" selected><?= $salesAgent->FName . ' ' . $salesAgent->LName; ?></option>
                        <?php } ?>
                    </select>
                </span>                                                        
            </div>
            <div class="col-12 col-md-12 mb-2 edit-customer-container" style="<?= $appointment->appointment_type_id == 1 || $appointment->appointment_type_id == 2 || $appointment->appointment_type_id == 3 ? '' : 'display:none'; ?>">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
                    </div>
                </div>
                <span id="add-customer-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_customer_id" id="edit-appointment-customer">
                        <option value="<?= $appointment->prof_id; ?>" selected><?= $appointment->customer_name; ?></option>
                    </select>
                </span>
                <div class="edit-customer-address"></div>
            </div>
            <div class="col-12 col-md-12 mb-2 edit-lead-container" style="<?= $appointment->appointment_type_id != 1 && $appointment->appointment_type_id != 2 && $appointment->appointment_type_id != 3 && $appointment->appointment_type_id != 4 ? '' : 'display:none'; ?>">
                <div class="row">
                    <div class="col-12 col-md-6 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">Appointment with</label>
                        <input type="text" value="<?= $appointment->lead_first_name; ?>" name="first_name" placeholder="First Name" class="nsm-field form-control" />                          
                    </div> 
                    <div class="col-12 col-md-6 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">&nbsp;</label>
                        <input type="text" value="<?= $appointment->lead_last_name; ?>" name="last_name" placeholder="Last Name" class="nsm-field form-control" />                          
                    </div>   
                    <div class="col-12 col-md-6 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">Contact Number</label>
                        <input type="text" value="<?= $appointment->lead_contact_number; ?>" name="contact_number" placeholder="xxx-xxx-xxxx" class="nsm-field form-control edit-phone-number-format" />                          
                    </div>  
                    <div class="col-12 col-md-6 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                        <input type="email" value="<?= $appointment->lead_contact_email; ?>" name="contact_email" placeholder="Email" class="nsm-field form-control" />                          
                    </div>  
                    <div class="col-12 col-md-12 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                        <input type="text" value="<?= $appointment->lead_address; ?>" name="address" placeholder="Address" class="nsm-field form-control" />   
                    </div>  
                    <div class="col-6 col-md-6 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">City</label>
                        <input type="text" value="<?= $appointment->lead_city; ?>" name="city" placeholder="City" class="nsm-field form-control" />                          
                    </div>  
                    <div class="col-6 col-md-4 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">State</label>
                        <input type="text" value="<?= $appointment->lead_state; ?>" name="state" placeholder="State" class="nsm-field form-control" />                          
                    </div>  
                    <div class="col-6 col-md-2 mb-2">
                        <label class="content-subtitle fw-bold d-block mb-2">Zip</label>
                        <input type="text" value="<?= $appointment->lead_zip; ?>" name="zip" placeholder="zip" class="nsm-field form-control" />                          
                    </div> 
                </div>
            </div>            
            <div class="col-12 col-md-12 mb-2 edit-invoice-price-container" <?= ( $appointment->appointment_type_id == 1 || $appointment->appointment_type_id == 2 || $appointment->appointment_type_id == 3 ) ? '' : 'style="display:none;"'; ?>>
                <div class="row">
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Invoice Number</label>
                        <input type="text" id="appointment-invoice-number" name="appointment_invoice_number" value="<?= $appointment->invoice_number; ?>" class="nsm-field form-control" />
                    </div>
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Price</label>
                        <input type="number" id="appointment-price" name="appointment_price" class="nsm-field form-control" value="<?= number_format($appointment->cost,2); ?>" />
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2 edit-tags-container" <?= ( $appointment->appointment_type_id == 1 || $appointment->appointment_type_id == 2 || $appointment->appointment_type_id == 3 || $appointment->appointment_type_id == 4 ) ? '' : 'style="display:none;"'; ?>>
                <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
                <span id="edit-tag-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_tags[]" id="quick-edit-appointment-tags" multiple="multiple">
                        <?php foreach ($a_selected_tags as $key => $value) { ?>
                            <option value="<?= $key; ?>" selected><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </span>
            </div>  
            <div class="col-12 col-md-6 mb-2 edit-url-link-container" style="<?= $appointment->appointment_type_id == 1 || $appointment->appointment_type_id == 2 || $appointment->appointment_type_id == 3 || $appointment->appointment_type_id == 4 ? '' : 'display:none'; ?>">
                <label class="content-subtitle fw-bold d-block mb-2">URL Link</label>
                <input type="text" name="url_link" id="ulr-link" class="nsm-field form-control" value="<?= $appointment->url_link; ?>" placeholder="URL Link" style="padding: 0.375rem 0.75rem;">
            </div>                      
            <div class="col-12">
                <div class="col-12">
                    <label class="content-subtitle fw-bold d-block mb-2">Notes</label>
                    <textarea id="appointment-notes" name="appointment_notes" class="nsm-field form-control"><?= $appointment->notes; ?></textarea>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(function(){
    $('.edit-datepicker').datepicker({
        //format: 'yyyy-mm-dd',
        format: 'DD, MM dd, yyyy',
        autoclose: true,
    });

    $('.edit-phone-number-format').keydown(function(e) {
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

    $('#edit-appointment-user').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            /*formatResult: function(item) {
                return '<div>' + item.FName + ' ' + item.LName + '<br />test<small>' + item.email + '</small></div>';
            },*/
            cache: true
        },
        dropdownParent: $("#edit_appointment_modal"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $(".edit-timepicker-from").datetimepicker({
        format: 'hh:mm A'
    });

    $(".edit-timepicker-to").datetimepicker({
        format: 'hh:mm A'
    });

    $(".edit-appointment-type").click(function(){
        var appointmentEventPriorityOptions = <?= json_encode($appointmentPriorityEventOptions); ?>;
        var appointmentPriorityOptions      = <?= json_encode($appointmentPriorityOptions); ?>;
        var appointment_type = $(this).val();

        if( appointment_type == 1 || appointment_type == 3  ){ //Job and Services
            $('.edit-attendees-container').fadeIn(500);
            $('.edit-appointment-sales-agent').fadeIn(500);
            $('.edit-invoice-price-container').fadeIn(500);
            $('.edit-url-link-container').fadeIn(500);
            $('.edit-tags-container').fadeIn(500);
            $('.edit-customer-container').fadeIn(500);

            $('.edit-event-description-container').fadeOut(500);
            $('.edit-event-location-container').fadeOut(500);
            $('.edit-lead-container').fadeOut(500);
        }else if( appointment_type == 2 ){ //Estimates
            $('.edit-attendees-container').fadeIn(500);
            $('.edit-appointment-sales-agent').fadeOut(500);
            $('.edit-invoice-price-container').fadeIn(500);
            $('.edit-url-link-container').fadeIn(500);
            $('.edit-tags-container').fadeIn(500);
            $('.edit-customer-container').fadeIn(500);

            $('.edit-event-description-container').fadeOut(500);
            $('.edit-event-location-container').fadeOut(500);
            $('.edit-lead-container').fadeOut(500);
        }else if( appointment_type == 4 ){ //Events
            $('.edit-attendees-container').fadeIn(500);
            $('.edit-url-link-container').fadeIn(500);
            $('.edit-tags-container').fadeIn(500);
            $('.edit-event-description-container').fadeIn(500);
            $('.edit-event-location-container').fadeIn(500);

            $('.edit-appointment-sales-agent').fadeOut(500);
            $('.edit-invoice-price-container').fadeOut(500);            
            $('.edit-customer-container').fadeOut(500);
            $('.edit-lead-container').fadeOut(500);
        }else{
            $('.edit-attendees-container').fadeOut(500);
            $('.edit-url-link-container').fadeOut(500);
            $('.edit-tags-container').fadeOut(500);
            $('.edit-event-description-container').fadeOut(500);
            $('.edit-event-location-container').fadeOut(500);
            $('.edit-appointment-sales-agent').fadeOut(500);
            $('.edit-invoice-price-container').fadeOut(500);            
            $('.edit-customer-container').fadeOut(500);

            $('.edit-lead-container').fadeIn(500);
        }

        if( appointment_type == 4 ){
            $('.quick-edit-create-tech-attendees').text('Attendees');
            $('#quick-edit-employee-popover').popover('dispose');
            $('#quick-edit-employee-popover').popover({    
                content:'Who will attend the event',
                title:'Attendees',        
                trigger: 'hover'
            });

            var $el = $(".edit-appointment-priority");
            $el.empty(); // remove old options
            $.each(appointmentEventPriorityOptions, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value).text(value));
            });

            $("#quick-edit-appointment-tags").empty().trigger('change');
            $('#quick-edit-appointment-tags').select2({
                ajax: {
                    url: base_url + 'autocomplete/_company_event_tags',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data,
                        };
                    },
                    cache: true
                },
                dropdownParent: $("#edit_appointment_modal"),
                placeholder: 'Select Tags',
                minimumInputLength: 0,
                templateResult: formatRepoTag,
                templateSelection: formatRepoTagSelection
            });

        }else{
            $('.quick-edit-create-tech-attendees').text('Assigned Techincian');
            $('#quick-edit-employee-popover').popover('dispose');
            $('#quick-edit-employee-popover').popover({    
                content:'Assign employee that will handle the appointment',
                title:'Which Employee',        
                trigger: 'hover'
            }); 

            var $el = $(".edit-appointment-priority");
            $el.empty(); // remove old options
            $.each(appointmentPriorityOptions, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value).text(value));
            });   
            
            $("#quick-edit-appointment-tags").empty().trigger('change');
            $('#quick-edit-appointment-tags').select2({
                ajax: {
                    url: base_url + 'autocomplete/_company_job_tags',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data,
                        };
                    },
                    cache: true
                },
                dropdownParent: $("#edit_appointment_modal"),
                placeholder: 'Select Tags',
                minimumInputLength: 0,
                templateResult: formatRepoTag,
                templateSelection: formatRepoTagSelection
            });
        }
    });

    $('#edit-appointment-customer').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data,
                    // pagination: {
                    //   more: (params.page * 30) < data.total_count
                    // }
                };
            },
            cache: true
        },
        dropdownParent: $("#edit_appointment_modal"),
        placeholder: 'Select Customer',
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
    });

    $('#edit-wait-list-add-employee-popover').popover({    
        content:'Who will attend the event',
        title:'Attendees',        
        trigger: 'hover'
    }); 

    $('#edit-tag-popover').popover({
        title: 'Tags', 
        content: "Pick a tags that will describe this appointment",
        trigger: 'hover'
    });

    $('#quick-edit-appointment-tags').select2({
        ajax: {
            url: "<?= base_url('autocomplete/_company_job_tags') ?>",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        dropdownParent: $("#edit_appointment_modal"),
        placeholder: 'Select Tags',
        minimumInputLength: 0,
        templateResult: formatRepoTag,
        templateSelection: formatRepoTagSelection
    });

    $('#edit-appointment-sales-agent-id').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            /*formatResult: function(item) {
                return '<div>' + item.FName + ' ' + item.LName + '<br />test<small>' + item.email + '</small></div>';
            },*/
            cache: true
        },
        dropdownParent: $("#edit_appointment_modal"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    load_edit_customer_info();

    function load_edit_customer_info(){
        let prof_id = $('#edit-appointment-customer').val();
        let url = "<?= base_url('customer/_load_customer_address') ?>";

        $.ajax({
            type: "POST",
            url: url,
            data: {prof_id: prof_id},
            success: function(result) {
                $('.edit-customer-address').html(result);
            }
        });
    }

    $('#edit-appointment-customer').on("select2:select", function(e) { 
        let prof_id = e.params.data.id;
        let url = "<?= base_url('customer/_load_customer_address') ?>";

        $.ajax({
            type: "POST",
            url: url,
            data: {prof_id: prof_id},
            success: function(result) {
                $('.edit-customer-address').html(result);
            }
        });
    });
});
</script>