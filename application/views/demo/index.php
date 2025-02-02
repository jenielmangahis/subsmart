<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header-demo'); ?> 

<style>
.fc-day-number{
    cursor:pointer;
}
@-moz-keyframes three-quarters-loader {
  0% {
    -moz-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes three-quarters-loader {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes three-quarters-loader {
  0% {
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }

 
}

.schedule-date{
  font-size: 30px;
  font-weight: 600;
  padding-left: 10px;
  padding-bottom: 10px;
  color: #393a3d;
}

.details-text{
  font-size: 20px;
  font-weight: 400;
  padding-left: 10px;
  padding-bottom: 10px;
  color: #393a3d;
}


/* :not(:required) hides this rule from IE9 and below */
.three-quarters-loader:not(:required) {
  -moz-animation: three-quarters-loader 1250ms infinite linear;
  -webkit-animation: three-quarters-loader 1250ms infinite linear;
  animation: three-quarters-loader 1250ms infinite linear;
  border: 8px solid #38e;
  border-right-color: transparent;
  border-radius: 16px;
  box-sizing: border-box;
  display: inline-block;
  position: relative;
  overflow: hidden;
  text-indent: -9999px;
  width: 32px;
  height: 32px;
}

.nsmart-button.primary{
  background-color: #6a4a86 !important;
  color: #fff !important;
  border-color: unset !important;
}

.nsmart-button.default{
    color: #fff;
    background-color: #808080;
}

.swal2-styled.swal2-confirm{
  background-color: #7367f0 !important;
  color: #fff !important;
}
</style>
<section id="main" class="main-content-div">
      <section class="ccontainer cust-hero-container">
          <section class="ccontainer None">
              <div class="ctext cp-margin">
                  <h3 class="chart-headline">Get a Personalized Demo</h3>
                  <div class="chart-headline-sub">
                      <p>Get 30 minutes with an expert and learn how you can grow your business in <?= date("Y"); ?> with nSmarTrac platform</p>
                  </div>
              </div>
          </section>
        </section>
        <section class="ccontainer cust-hero-container">
          <div class="content-container" style="margin-bottom: 20px;padding-bottom:100px;">
              <div class="row">
                <div class="col-md-4 pl-0 pr-2">
                      <img width="300" src="<?php echo $url->assets ?>frontend/images/logo.png" alt="">
                      <br />
                      <br />
                      <h3 style="padding:20px 0px;">Schedule Demo</h3>
                      <div data-container="details" class="sp-ui">
                        <div class="sp-r">
                          <span class="fa fa-clock-o"></span><span class="sp-txt">1&nbsp;hr</span>
                        </div>
                        <div class="sp-r">
                          <span class="fa fa-phone"></span><span class="sp-txt">Phone call</span>
                        </div>
                      </div>
                      <br />
                      <p>Demo agenda: Understand your questions and requirements and show you how nSmarTrac can help your business needs.</p>
                      <p>We’d like to take this moment to thank you for your interest in nSmarTrac. We hope you will find this platform valuable and make your business unique in the competitive landscape.</p>
                      <br />
                      <p>Thank you,<br /><b>Team nSmarTrac</b></p>
                </div>

                <div class="col-md-6">
                    <div class="calendar-form">
                      <div id='loading'>loading...</div>
                      <div id='calendar'></div>
                      <div class="loader-container"></div>
                    </div>
                    <div class="schedule-fillup-form hidden">
                        <p class="schedule-date mb-4" id="schedule-date"></p>
                        <p class="details-text">Enter Details</p>
                        <form id="event-form">
                            <input type="hidden" name="demo_time" id="demo_time" >
                            <input type="hidden" name="demo_date" id="demo_date">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Demo name *" required />
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email *" required />
                                <a class="btn btn-info btn-add-guests pt-2 pb-2 nsmart-button primary" href="javascript:void(0);">Add Guests</a>
                            </div>
                            <div class="col-md-6 form-group hidden grp-guest-emails time-grp">
                                <textarea class="form-control mtc-13" name="guest_emails" id="guest_emails" placeholder="Guest Email(s)"></textarea>
                                <small>Notify up to 10 additional guests of the scheduled event.</small>
                            </div>
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="col-md-6 form-group time-grp">
                                    <input type="tel" class="form-control mtc-13" name="phone_number" id="phone_number" placeholder="Phone Number *" required />
                                    <input type="text" class="form-control mt-15" name="text_reminder" id="text_reminder" placeholder="Send text reminder to" />
                                </div>
                                <div class="col-md-6 form-group time-grp">
                                    <textarea class="form-control vr-cs" name="key_features" id="key_features" placeholder="Please let us know the key features you are interested to know. *" required></textarea>
                                </div>
                                <div class="col-sm-12 mt-3 calendar-btn align-center">
                                    <button type="submit" class="btn btn-flat btn-primary nsmart-button primary">Schedule Event</button>
                                    <a href="javascript:void(0);" class="btn nsmart-button default btn-change-schedule">Change Schedule</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2 time-schedule">
                  <div class="calendar-date-schedule"></div>
                </div>
              </div>
          </div>
        </section>
  </section>




<?php  include viewPath('frontcommon/footer-demo'); ?> 
<script>
    $(document).ready(function () {
        $('#event-form').on('submit', function (e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('demo/save_demo') ?>', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                    $('button[type="submit"]').prop('disabled', true).text('Saving...');
                },
                success: function (response) {
                    if (response.success) {
                        // alert('Event scheduled successfully!');
                        Swal.fire({
                          icon: 'success',
                          title:'We will contact you soonest. Thank you.'
                        }).then((item)=> {
                          $('#event-form')[0].reset(); 
                          // window.location.href='<?= base_url('demo/list') ?>'
                          handleCalendar(2)
                        });
                    
                    } else {
                        // alert('Error: ' + response.message);
                        Swal.fire({
                          icon: 'error',
                          title: 'Error!',
                          text:'Demo scheduled unsuccessfully save!'
                        });
                    }
                },
                error: function (xhr) {
                    alert('An error occurred while saving the event. Please try again.');
                },
                complete: function () {
                    $('button[type="submit"]').prop('disabled', false).text('Schedule Event');
                }
            });
        });

        $(document).on('click','#demo_time_schedule',function(){
            const demoTime = $(this).attr('data-key');
            const demoDateTime = $(this).attr('data-date');
            $("#demo_time").val(demoTime);
            $("#schedule-date").append(',   ' +demoDateTime);

            handleCalendar(1)
        });

        function handleCalendar(type){
          switch(type){
            case 1: 
              $(".calendar-date-schedule").html('');
              $(".calendar-form").addClass("hidden");
              $(".schedule-fillup-form").removeClass("hidden");
              break;

            case 2: 
              $(".btn-add-guests").removeClass("hidden");
              $(".grp-guest-emails").addClass("hidden");
              $(".schedule-fillup-form").addClass("hidden");
              $(".calendar-form").removeClass("hidden");
              $(".calendar-date-schedule").html("");
              break;
            default:
              break;
          }
    
        }
    });
</script>
<script>
var base_url = "<?php echo base_url();?>";

document.addEventListener('DOMContentLoaded', function() {

$(".btn-add-guests").click(function(){
  $(this).addClass("hidden");
  $(".grp-guest-emails").removeClass("hidden");
});

$(".btn-change-schedule").click(function(){
  $(".btn-add-guests").removeClass("hidden");
  $(".grp-guest-emails").addClass("hidden");
  $(".schedule-fillup-form").addClass("hidden");
  $(".calendar-form").removeClass("hidden");
  $(".calendar-date-schedule").html("");
});

var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
  plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
  header: {
    left: 'prev,next today',
    center: 'title',
    right: ''
  },
  dateClick: function(info) {
    $(".loader-container").html("<div class='three-quarters-loader loader-pos'></div>");
    setTimeout(function () {
        $.ajax({
           type: "POST",
           url: base_url + 'demo/time_schedule',
           data: {"date":info.dateStr},
           dataType:'json',
           success: function(o)
           {
              $(".calendar-date-schedule").html(o.output);
                          
              const date = new Date(o.data.date);
              const options = { weekday: 'long', month: 'short', day: '2-digit' }; 
              const formattedDate = date.toLocaleDateString('en-US', options);

              $("#schedule-date").html(formattedDate);

           },
           complete: function() {
              $("#demo_date").val(info.dateStr);
              $(".loader-container").html('');
           
          }
        });
    }, 1000);

  },
  /*defaultDate: '2020-02-12',*/
  editable: false,
  navLinks: false, // can click day/week names to navigate views
  eventLimit: true, // allow "more" link when too many events
  events: {
    url: base_url + 'demo/get_events',
    failure: function() {
      document.getElementById('script-warning').style.display = 'block'
    }
  },
  loading: function(bool) {
    document.getElementById('loading').style.display =
      bool ? 'block' : 'none';
  }
});



calendar.render();
});
</script>

