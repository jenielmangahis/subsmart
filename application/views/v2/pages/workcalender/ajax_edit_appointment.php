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
            <div class="col-12 mb-2">
                <label class="content-subtitle fw-bold d-block mb-2 edit-tech-attendees">Attendees</label>
                <span id="edit-wait-list-add-employee-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_user_id[]" id="edit-appointment-user" multiple="multiple">
                        <?php foreach($attendees as $key => $user){ ?>
                            <option value="<?= $user['id']; ?>" selected><?= $user['name']; ?></option>
                        <?php } ?>
                    </select>
                </span>                                                        
            </div>
            <div class="col-12 mb-2 appointment-edit-sales-agent" <?= ( $appointment->appointment_type_id == 3 || $appointment->appointment_type_id == 1 ) ? '' : 'style="display:none;"'; ?>>
                <label class="content-subtitle fw-bold d-block mb-2">Sales Agent</label>
                <span id="wait-list-add-sales-agent-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_sales_agent_id" id="edit-appointment-sales-agent-id">
                        <?php if($salesAgent){ ?>
                            <option value="<?= $salesAgent->id; ?>" selected><?= $salesAgent->FName . ' ' . $salesAgent->LName; ?></option>
                        <?php } ?>
                    </select>
                </span>                                                        
            </div>
            <div class="col-12 mb-2 edit-customer-container" style="<?= $appointment->appointment_type_id == 4 ? 'display: none;' : ''; ?>">
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
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                        <select name="appointment_type_id" class="nsm-field form-select edit-appointment-type" required>
                            <?php foreach ($appointmentTypes as $a) { ?>
                                <option <?= $appointment->appointment_type_id == $a->id ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-6">
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
                </div>
            </div>
            <div class="col-12 mb-2 edit-invoice-price-container" <?= ( $appointment->appointment_type_id != 4 ) ? '' : 'style="display:none;"'; ?>>
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
            <div class="col-12 mb-2">
                <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
                <span id="edit-tag-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_tags[]" id="edit-appointment-tags" multiple="multiple">
                        <?php foreach ($a_selected_tags as $key => $value) { ?>
                            <option value="<?= $key; ?>" selected><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </span>
            </div>  
            <div class="col-12 mb-2">
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
        if( appointment_type ==  3 || appointment_type == 1 ){
            $('.appointment-edit-sales-agent').fadeIn(500);
            $('.edit-invoice-price-container').fadeIn(500);
        }else if( appointment_type ==  2 ){
            $('.appointment-edit-sales-agent').fadeOut(500);
            $('.edit-invoice-price-container').fadeIn(500);
        }else{
            $('.appointment-edit-sales-agent').fadeOut(500);
            $('.edit-invoice-price-container').fadeOut(500);
        }

        if( appointment_type == 4 ){ //Event
            $('.edit-customer-container').fadeOut(500);
            $('.edit-event-description-container').fadeIn(500);
            $('.edit-event-location-container').fadeIn(500);
            $("a.edit-btn-manage-tags").attr("href", base_url + 'events/event_tags');
            $("#edit-appointment-tags").empty().trigger('change');
            $('#edit-appointment-tags').select2({
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
            $('.edit-customer-container').fadeIn(500);
            $('.edit-event-description-container').fadeOut(500);
            $('.edit-event-location-container').fadeOut(500);
            $("a.edit-btn-manage-tags").attr("href", base_url + 'job/job_tags');
            $("#edit-appointment-tags").empty().trigger('change');
            $('#edit-appointment-tags').select2({
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

        if( appointment_type == 4 ){
            $('.edit-tech-attendees').text('Attendees');
            $('#edit-wait-list-add-employee-popover').popover('dispose');
            $('#edit-wait-list-add-employee-popover').popover({    
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

        }else{
            $('.edit-tech-attendees').text('Assigned Techincian');
            $('#edit-wait-list-add-employee-popover').popover('dispose');
            $('#edit-wait-list-add-employee-popover').popover({    
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

    $('#edit-appointment-tags').select2({
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