<style>
.bs-popover-top .arrow:after, .bs-popover-top .arrow:before {
  border-top-color: #32243D !important;
}
.bs-popover-bottom .arrow:after, .bs-popover-bottom .arrow:before {
  border-bottom-color: #32243D !important;
}
.modal {
    z-index: 1051 !important;
}
.fc-event-main{
    font-size: 15px !important;
    padding: 5px;
    overflow: auto;
}
.timepicker-icon{
    font-size: 30px;
}
.calendar-tile-details{
    display: none;
    padding: 5px;
    /*margin-top: 11px;*/
}
.calendar-title-header{    
    padding: 2px;
    display: inline-flex;
    /*border-bottom: 1px solid;*/
    min-width: 100%;
}
.calendar-tile-details{
    border-top: 1px solid;
    padding-top: 11px !important;
}
.calendar-tile-view, .calendar-tile-add-gcalendar{
    display: inline-block;
    font-size: 12px !important;
    margin: 5px 0px !important;
    /*width: 60px;*/
}
.calendar-tile-view i, .calendar-tile-add-gcalendar i{
    position: relative;
    top: 1px;
}
.calendar-tile-minmax{
    margin-left: 0px !important;
    color: #ffffff;
}
.calendar-tile-assigned-tech{
    min-width: 25px !important;
    height: 25px !important;
    margin-right: 5px !important;
}
.calendar-tile-minmax:hover{
    color: #ffffff;
}
.fc .fc-daygrid-event{    
}
.multiple-date{
    z-index: 999 !important;
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
.quick-calendar-tile span{
    font-size:16px;
    font-weight:bold;
    display:inline-block;
    color: #ffffff;
}
#upcoming-schedule-view-more-details, #edit-upcoming-schedule{
    width: 150px;
}
.quick-select-calendar-schedule-type{
    /*width: 100% !important;*/
    display: block;
    margin: 5px;
    /*padding-left: 25%;*/
    font-size: 20px;
}
#modal-quick-add-job .modal-lg, #modal-quick-add-service-ticket .modal-lg{
    max-width:1107px !important;
}
#quick-add-job-form-container{
    /*max-height: 650px;
    overflow: auto;*/
}
.swal2-container{
    z-index: 9999999 !important;
}
#quick-access-calendar-loading{
    position: absolute;
    top: 289px;
    z-index: 9999;
    left: 38%;
    font-weight: bold;
}
.alert-purple{
    background-color: #6a4a86 !important;
    color: #ffffff;
}
</style>

<div class="modal fade nsm-modal fade" id="modal-quick-access-calendar-schedule" tabindex="-1" aria-labelledby="modal-quick-access-calendar-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Calendar Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div id="quick-access-calendar-loading"></div>
                <div id="quick-access-calendar-schedule"></div>
            </div>            
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-view-upcoming-schedule" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Calendar Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" style="max-height:700px; overflow: auto;">
                <div class="view-schedule-container"></div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" data-id="" data-type="" id="upcoming-schedule-view-more-details">View More Details</button>
                <button type="button" class="nsm-button primary quick-edit-schedule" data-id="" data-type="" id="edit-upcoming-schedule">Edit</button>
            </div>           
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-select-schedule-type" tabindex="-1" aria-labelledby="modal-quick-access-calendar-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top: 5%;">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Schedule Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="quick-add-date-selected" value="" />                
                <div class="row">
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-job" href="javascript:void(0);"><i class="bx bx-fw bx-message-square-error"></i>Job</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-service-ticket" href="javascript:void(0);"><i class="bx bx-fw bx bx-fw bx-note"></i>Service Ticket</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-event" href="javascript:void(0);"><i class='bx bx-fw bx-calendar-event'></i>Event</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-appointment" href="javascript:void(0);"><i class='bx bx-fw bxs-user-pin'></i>Appointment</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-tc-off" href="javascript:void(0);"><i class='bx bx-fw bx-calendar-week' ></i>Technician Off</a>
                    </div>                    
                </div>
            </div>            
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-job" aria-labelledby="modal-quick-add-job-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-job-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Job</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-job-form-container"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-job-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-service-ticket" aria-labelledby="modal-quick-add-service-ticket-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-service-ticket-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Service Ticket</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-service-ticket-form-container" style="max-height: 800px; overflow: auto;"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-service-ticket-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="modal fade nsm-modal fade" id="modal-quick-add-event" aria-labelledby="modal-quick-add-event-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-event-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Event</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-event-form-container" style="max-height: 800px; overflow: auto;"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-event-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-appointment" aria-labelledby="modal-quick-add-appointment-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-appointment-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Appointment</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-appointment-form-container"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-appointment-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-tc-off" tabindex="-1" aria-labelledby="modal-quick-add-tc-off-label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="quick-add-tc-off-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Schedule Technician Off</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-tc-off-form-container"></div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-tc-off-submit">Schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-edit-tc-off" tabindex="-1" aria-labelledby="modal-quick-edit-tc-off-label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="quick-edit-tc-off-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Schedule Technician Off</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-edit-tc-off-form-container"></div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-tc-off-submit">Update Schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-panel-type" tabindex="-1" aria-labelledby="modal-quick-add-panel-type-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-panel-type-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Panel Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="panel-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="panel_type_name" id="panel-type-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-panel-type-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="modal-quick-add-plan-type" tabindex="-1" aria-labelledby="modal-quick-add-plan-type-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-plan-type-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Plan Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="plan-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="plan_type_name" id="plan-type-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-plan-type-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-job-type" tabindex="-1" aria-labelledby="modal-quick-add-plan-type-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-job-type-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Job Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="plan-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="plan_type_name" id="plan-type-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-job-type-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>