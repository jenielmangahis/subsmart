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
</style>

<div class="modal fade nsm-modal fade" id="modal-quick-access-calendar-schedule" tabindex="-1" aria-labelledby="modal-quick-access-calendar-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Calendar Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div id="quick-access-calendar-schedule"></div>
            </div>            
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-view-upcoming-schedule" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Calendar Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" style="max-height:700px; overflow: auto;">
                <div class="view-schedule-container row"></div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" data-id="" data-type="" id="upcoming-schedule-view-more-details">View More Details</button>
            </div>           
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-appointment" aria-labelledby="modal-quick-add-appointment-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="frm-quick-add-create-appointment" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Appointment</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                                        
                </div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button" style="display:none;">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>