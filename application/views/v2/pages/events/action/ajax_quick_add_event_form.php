<style type="text/css">
    .color-box-custom {
    padding: 0px 0px;
    }
    .color-box-custom ul {
    margin: 0px;
    padding: 0px;
    list-style: none;
    }
    .color-box-custom ul li {
    display: inline-block;
    }
    .color-box-custom ul li span {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #000;
    display: block;
    }
    .color-box-custom ul li span.bg-1 {
    background-color: #4baf51;
    }
    .color-box-custom ul li span.bg-2 {
    background-color: #d86566;
    }
    .color-box-custom ul li span.bg-3 {
    background-color: #e57399;
    }
    .color-box-custom ul li span.bg-4 {
    background-color: #b273b3;
    }
    .color-box-custom ul li span.bg-5 {
    background-color: #8b63d7;
    }
    .color-box-custom ul li span.bg-6 {
    background-color: #678cda;
    }
    .color-box-custom ul li span.bg-7 {
    background-color: #59bdb3;
    }
    .color-box-custom ul li span.bg-8 {
    background-color: #64ae89;
    }
    .color-box-custom ul li span.bg-9 {
    background-color: #f1a740;
    }
    .nsm-badge.primary-enhanced {
    background-color: #6a4a86;
    }
    table {
    width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
    display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
    }
    table.dataTable.no-footer {
    border-bottom: 0px solid #111; 
    margin-bottom: 10px;
    }
    #CUSTOM_FILTER_DROPDOWN:hover {
    border-color: gray !important; 
    background-color: white !important; 
    color: black !important;
    cursor: pointer; 
    }
    .SHORTCUT_LINK { 
        text-decoration: none;
        float: right;
        margin-top: -25px;
    }
    .select2-results__option {
        text-align: left;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        text-align: left;
    }
    .autocomplete-img{
      height: 50px;
      width: 50px;
    }
    .autocomplete-left{
      display: inline-block;
      width: 65px;
    }
    .autocomplete-right{
        display: inline-block;
        width: 80%;
        vertical-align: top;
    }
    .clear{
        clear: both;
    }
    .event-color-scheme{
        border-radius: 0px;
        border: 1px solid black;
        margin-bottom: 4px;
        height: 35px;
        width: 35px;
    }
    .event-color-check{
        font-size: 20px;
        color: #ffffff;
        position: relative;
        top: -3px;
        left: -4px;;
    }
    .calendar_button {
        color: #ffffff;
        font-size: 20px;
        padding-top: 3px;
        position: relative;
        top: -1px;
        left: -3px;
    }
    .autocomplete-container {
        position: relative;
    }
</style>
<div class="row page-content g-0">        
    <div class="col-lg-12 mb-3">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="nsm-card primary h-auto">
                    <div class="nsm-card-header d-block">
                        <div class="nsm-card-title"><span><i class='bx bx-calendar'></i>&nbsp;Event Details</span></div>
                    </div>
                    <hr>
                    <div class="nsm-card-content">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-lg-2">
                                            <h6>From:</h6>
                                        </div>
                                        <div class="col-lg-5">
                                            <input required type="date" name="start_date" id="start_date" class="form-control" value="<?= date("Y-m-d", strtotime($default_date)); ?>">
                                        </div>
                                        <div class="col-lg-5">
                                            <select required id="start_time" name="start_time" class="form-control">
                                                <option value selected disabled>Start time</option>
                                                <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                <option value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-lg-2">
                                            <h6>To:</h6>
                                        </div>
                                        <div class="col-lg-5">
                                            <input required type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= date("Y-m-d", strtotime($default_date)) ?>">
                                        </div>
                                        <div class="col-lg-5">
                                            <select required id="end_time" name="end_time" class="form-control">
                                                <option value selected disabled>End time</option>
                                                <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                <option value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h6>Attendees</h6>
                                    <select required id="event_employee_id" name="employee_id[]" class="form-control" multiple="multiple"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="color-box-custom">
                                    <h6>Event Color on Calendar</h6>
                                    <ul id="EVENT_COLOR_LIST">
                                        <?php if(isset($color_settings)): ?>
                                        <?php foreach ($color_settings as $color): ?>
                                        <li>
                                            <a data-color="<?php echo $color->color_code; ?>" style="background-color: <?php echo $color->color_code; ?>;" id="<?php echo $color->id; ?>" type="button" class="btn btn-default event-color-scheme btn-circle bg-1" title="<?php echo $color->color_name; ?>">
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <input value="" id="job_color_id" name="event_color" type="hidden" />
                                    <input id="event-color" type="hidden" value="#2e9e39">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h6>Customer Reminder Notification</h6>
                                <select required id="customer_reminder" name="customer_reminder_notification" class="form-control">
                                        <?php foreach($optionsCustomerNotifications as $key => $value){ ?>
                                            <option <?= $eventSettings && $eventSettings->customer_reminder_notification == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                        <?php } ?>     
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h6>Time Zone</h6>                                
                                <select required id="inputState" name="timezone" class="form-control">                                    
                                    <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                        <option value="<?php echo $key ?>" <?= $eventSettings && $eventSettings->timezone == $key ? 'selected="selected"' : ''; ?>>
                                            <?php echo $zone ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h6>Location</h6>
                                <div id="autocomplete" class="autocomplete-container"></div>
                                <input required id="event_address" value="" name="event_address" class="form-control" type="hidden" placeholder="Enter a location" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h6>URL Link</h6>
                                <input required type="url" name="url_link" placeholder="https://www.domain.com" class="form-control checkDescription" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h6>Private Notes</h6>
                                <textarea required name="private_notes" cols="50" style="width: 100%;margin-bottom: 8px;height:54px;" id="note_txt" class="form-control input"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <h6>Event Type</h6><a class="SHORTCUT_LINK" href="<?php echo base_url('events/event_types'); ?>">+ Manage Event Type</a>
                                <select required id="event_type_option" name="event_types" class="form-control">
                                    <option selected hidden disabled value>- Select Event Type -</option>
                                    <?php if(!empty($job_types)): ?>
                                    <?php foreach ($job_types as $type): ?>
                                    <option value="<?php echo $type->title; ?>" data-image="<?php echo $type->icon_marker ?>"><?php echo $type->title; ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <h6>Event Tag</h6><a class="SHORTCUT_LINK" href="<?php echo base_url('events/event_tags'); ?>">+ Manage Event Tag</a>
                                <select required id="event_tags_option" name="event_tags" class="form-control">
                                    <option selected hidden disabled value>- Select Event Tag -</option>
                                    <?php if(!empty($job_tags)): ?>
                                    <?php foreach ($job_tags as $tag): ?>
                                    <option value="<?php echo $tag->name; ?>" data-image="<?php echo $tag->marker_icon ?>"><?php echo $tag->name; ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h6>Description of Event</h6>
                                <textarea required name="event_description" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>                
        </div>
    </div>
</div>

<!-- Map files -->
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>

<script type="text/javascript">
var myAPIKey = "<?= GEOAPIKEY ?>"; 
setTimeout(() => {
    autocompleteInput = new autocomplete.GeocoderAutocomplete(
        document.getElementById("autocomplete"), 
        myAPIKey, 
        { /* Geocoder options */ 
    });

    autocompleteInput.on('select', (location) => {
        if (location) {    
            $('#event_address').val(location.properties.address_line2);            
        }
    });
}, 500);
$(function () {
    $("#start_time, #end_time, #customer_reminder, #inputState").select2();
    $('#event_employee_id').select2({
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
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $("#start_date").change(function (event) {
        $("#end_date").val($("#start_date").val());
    });

    $("#event_type_option, #event_tags_option").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    function formatRepoUser(repo) {
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
    }

    function formatState (opt) {
        if (!opt.id) {
            return opt.text;
        } 
        var optimage = $(opt.element).attr('data-image'); 
        if(!optimage){
           return opt.text;
        } else {                    
            var $opt = $(
               '<span><img src="<?php echo base_url('uploads/icons/'); ?>' + optimage + '" style="width: 20px; margin-top: -4px;" /> ' + opt.text + '</span>'
            );
            return $opt;
        }
    }

    $('.event-color-scheme').on('click', function(){
        var id = this.id;
        $('[id="job_color_id"]').val(id);
        $( "#"+id ).append( "<i class=\"bx bx-check calendar_button\" aria-hidden=\"true\"></i>" );
        remove_other_event_color(id);        
    });

    function remove_other_event_color(color_id){
        $('.event-color-scheme').each(function(index) {
            var idd = this.id;
            if(idd !== color_id){
                $( "#"+idd ).empty();
            }
        });
    }

});
</script>

