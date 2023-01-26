<input type="hidden" id="action_select_date" value="" />        
<input type="hidden" id="action_select_time" value="" />        
<input type="hidden" id="action_select_user" value="" />  
<div class="nsm-card primary">
    <div class="nsm-card-content">            
        <div class="row g-3 appointment-form">
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">When</label>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <input type="text" name="appointment_date" id="appointment_date" class="nsm-field form-control datepicker" placeholder="Date" required style="padding: 0.375rem 0.75rem;" value="<?= date("l, F d, Y", strtotime($default_start_date)); ?>">                                    
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" name="appointment_time_from" id="appointment_time" class="nsm-field form-control timepicker-from" value="" placeholder="Time From" required />
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" name="appointment_time_to" id="appointment_time_to" class="nsm-field form-control timepicker-to" placeholder="Time To" value="<?= $default_time_to; ?>" required />
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Created By</label>
                <span id="wait-list-created-by">
                    <input type="text" value="<?= $userLogged->FName . ' ' . $userLogged->LName; ?>" class="nsm-field" readonly="readonly" disabled="disabled">
                </span>                                                        
            </div>
            <div class="col-12 event-description-container" style="<?= $default_appointment_type_id != 4 ? 'display: none;' : ''; ?>">
                <label class="content-subtitle fw-bold d-block mb-2">Event Name</label>
                <span id="wait-list-created-by">
                    <input type="text" value="" name="appointment_event_name" class="nsm-field form-control" />
                </span>                                                        
            </div>
            <div class="col-12 event-location-container" style="<?= $default_appointment_type_id != 4 ? 'display: none;' : ''; ?>">
                <label class="content-subtitle fw-bold d-block mb-2">Event Location</label>
                <span id="wait-list-created-by">
                    <textarea id="appointment-event-location" name="appointment_event_location" class="nsm-field form-control"></textarea>
                </span>                                                        
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Attendees</label>
                <span id="wait-list-add-employee-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_user_id[]" id="appointment-user" multiple="multiple"></select>
                </span>                                                        
            </div>
            <div class="col-12 appointment-add-sales-agent" style="display:none;">
                <label class="content-subtitle fw-bold d-block mb-2">Sales Agent</label>
                <span id="wait-list-add-sales-agent-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_sales_agent_id" id="appointment-sales-agent-id"></select>
                </span>                                                        
            </div>
            
            <div class="col-12 customer-container" style="">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
                    </div>
                    <div class="col-6 text-end">
                        <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-quick-add-customer"><i class='bx bx-fw bx-plus'></i>  Add New Customer</a>
                    </div>
                </div>
                <span id="add-customer-popover" data-toggle="popover" data-placement="right"data-container="body">
                    <select class="nsm-field form-select" name="appointment_customer_id" id="appointment-customer"></select>
                </span>
                <div class="customer-address"></div>
            </div>
            <div class="col-12">
                <div class="row">  
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                        <select name="appointment_type_id" class="nsm-field form-select add-appointment-type" required>
                            <?php $start = 0; ?>
                            <option value="0">- Select Appointment Type -</option>
                            <?php foreach ($appointmentTypes as $a) { ?>
                                <option value="<?= $a->id; ?>"><?= $a->name; ?></option>
                            <?php $start++; } ?>
                        </select>                                
                    </div>                              
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Priority</label>
                        <select name="appointment_priority" class="nsm-field form-select add-appointment-priority" required>
                            <?php foreach($appointmentPriorityEventOptions as $priority){ ?>
                                <option value="<?= $priority; ?>"><?= $priority; ?></option>
                            <?php } ?>
                        </select>   
                        <input type="text" value="" name="appointment_priority_others" placeholder="Please specify" class="nsm-field form-select priority-others" style="margin-top:5px;display: none;">
                    </div>
                </div>
                
            </div>
            <div class="col-12 invoice-price-container" style="display:none;">
                <div class="row">
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Invoice Number</label>
                        <input type="text" id="appointment-invoice-number" name="appointment_invoice_number" class="nsm-field form-control" />
                    </div>
                    <div class="col-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Price</label>
                        <input type="number" id="appointment-price" name="appointment_price" class="nsm-field form-control" />
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
                            </div>
                            <div class="col-6 text-end">
                                <?php 
                                    if( $default_appointment_type_id == 4 ){ //Events
                                        $manage_tags_url = base_url('events/event_tags');
                                    }else{
                                        $manage_tags_url = base_url('job/job_tags');
                                    }
                                ?>
                                <a href="<?= $manage_tags_url; ?>" class="content-subtitle d-block mb-2 nsm-link btn-quick-add-manage-tags"><i class='bx bx-fw bx-plus'></i>  Manage Tags</a>
                            </div>
                        </div>
                        
                        <span id="add-tag-popover" data-toggle="popover" data-placement="right"data-container="body">
                            <select class="nsm-field form-select" name="appointment_tags[]" id="appointment-tags" multiple="multiple"></select>
                        </span> 
                    </div>                           
                </div>
            </div>   
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">URL Link <small style="color:#ff4d4d;">(Must be public url)</small></label>
                        <input type="text" name="url_link" id="ulr-link" class="nsm-field form-control" placeholder="URL Link" style="padding: 0.375rem 0.75rem;">
                    </div>
                </div>
            </div>            
            <div class="col-12">
                <div class="col-12">
                    <label class="content-subtitle fw-bold d-block mb-2">Notes</label>
                    <textarea id="appointment-notes" name="appointment_notes" class="nsm-field form-control"></textarea>
                </div>
            </div>
        </div> 
    </div>
</div>
<script>
$(function(){
    $('#appointment-tags').select2({
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
        dropdownParent: $("#modal-quick-add-appointment"),
        placeholder: 'Select Tags',
        minimumInputLength: 0,
        templateResult: formatRepoTag,
        templateSelection: formatRepoTagSelection
    });

    function formatRepoTag(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div class="d-flex align-items-center"><label>' + repo.name + '</label></div>'
        );

        return $container;
    }

    function formatRepoTagSelection(repo) {
        if (repo.name != null) {
            return repo.name;
        } else {
            return repo.text;
        }

    }

    $('.datepicker').datepicker({
        //format: 'yyyy-mm-dd',
        format: 'DD, MM dd, yyyy',
        autoclose: true,
    });

    $(".timepicker-from").datetimepicker({            
        format: 'hh:mm A',            
    }).on('dp.change', function(e){             
        var default_interval = "<?= $default_time_to_interval; ?>";
        if( default_interval > 0 ){
            var formatedValue = e.date.format(e.date._f);
            var newDateTime = moment(formatedValue, "LT").add(default_interval, 'hours').format('LT');
            $('.timepicker-to').val(newDateTime);            
        }            
    });

    $(".timepicker-to").datetimepicker({
        format: 'hh:mm A'
    });

    $('#appointment-user').select2({
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
            cache: true
        },
        dropdownParent: $("#modal-quick-add-appointment"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    /*function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }*/

    $('#appointment-customer').on("select2:select", function(e) { 
        let prof_id = e.params.data.id;
        let url = "<?= base_url('customer/_load_customer_address') ?>";

        $.ajax({
            type: "POST",
            url: url,
            data: {prof_id: prof_id},
            success: function(result) {
                $('.customer-address').html(result);
            }
        });
    });

    $('#appointment-customer').select2({
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
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        dropdownParent: $("#modal-quick-add-appointment"),
        placeholder: 'Select Customer',
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            return repo.first_name + ' ' + repo.last_name;
        } else {
            return repo.text;
        }
    }

    $(document).on('click', '.add-appointment-type', function(){
        var appointmentEventPriorityOptions = <?= json_encode($appointmentPriorityEventOptions); ?>;
        var appointmentPriorityOptions      = <?= json_encode($appointmentPriorityOptions); ?>;
        var appointment_type = $(this).val();

        $('.appointment-form').show();        
        if( appointment_type ==  2 ){
            $('.appointment-add-sales-agent').fadeOut(500);
            $('.invoice-price-container').fadeIn(500);
        }else{
            $('.appointment-add-sales-agent').fadeOut(500);
            $('.invoice-price-container').fadeOut(500);
        }

        if( appointment_type == 4 ){ //Event
            $('.customer-container').fadeOut(500);
            $('.event-description-container').fadeIn(500);
            $('.event-location-container').fadeIn(500);
            $("a.btn-quick-add-manage-tags").attr("href", base_url + 'events/event_tags');
            $("#appointment-tags").empty().trigger('change');
            $('#appointment-tags').select2({
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
                dropdownParent: $("#modal-quick-add-appointment"),
                placeholder: 'Select Tags',
                minimumInputLength: 0,
                templateResult: formatRepoTag,
                templateSelection: formatRepoTagSelection
            });
        }else{
            $('.customer-container').fadeIn(500);
            $('.event-description-container').fadeOut(500);
            $('.event-location-container').fadeOut(500);
            $("a.btn-quick-add-manage-tags").attr("href", base_url + 'job/job_tags');
            $("#appointment-tags").empty().trigger('change');
            $('#appointment-tags').select2({
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
                dropdownParent: $("#modal-quick-add-appointment"),
                placeholder: 'Select Tags',
                minimumInputLength: 0,
                templateResult: formatRepoTag,
                templateSelection: formatRepoTagSelection
            });
        }

        if( appointment_type == 4 ){
            $('.create-tech-attendees').text('Attendees');
            $('#wait-list-add-employee-popover').popover('dispose');
            $('#wait-list-add-employee-popover').popover({    
                content:'Who will attend the event',
                title:'Attendees',        
                trigger: 'hover'
            });

            var $el = $(".add-appointment-priority");
            $el.empty(); // remove old options
            $.each(appointmentEventPriorityOptions, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value).text(value));
            });

        }else{
            $('.create-tech-attendees').text('Assigned Techincian');
            $('#wait-list-add-employee-popover').popover('dispose');
            $('#wait-list-add-employee-popover').popover({    
                content:'Assign employee that will handle the appointment',
                title:'Which Employee',        
                trigger: 'hover'
            }); 

            var $el = $(".add-appointment-priority");
            $el.empty(); // remove old options
            $.each(appointmentPriorityOptions, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value).text(value));
            });           
        }
    });
});
</script>
 