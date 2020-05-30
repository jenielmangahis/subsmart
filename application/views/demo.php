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
</style>
<!-- Headline Section -->
<section id="main" class="main-content-div">
  <section class="ccontainer cust-hero-container">
      <section class="ccontainer None">
          <div class="ctext cp-margin">
              <h3 class="chart-headline">Get a Personalized Demo</h3>
              <div class="chart-headline-sub">
                  <p>Get 30 minutes with an expert and learn how you can grow your business in 2020 with Nsmartrac platform</p>
              </div>
          </div>
      </section>
  </section>
  <section class="ccontainer cust-hero-container">
    <div class="content-container" style="margin-bottom: 20px;">
        <div class="row">
          <div class="col-md-5">
                <img width="300" src="<?php echo $url->assets ?>frontend/images/logo.png" alt="">                
                <br />
                <br />
                <h3 style="padding:20px 0px;">Schedule Demo</h3>
                <p>Demo agenda: Understand your questions and requirements and show you how Nsmartrac can help your business needs.</p>
                <p>We’d like to take this moment to thank you for your interest in Nsmartrac. We hope you will find this platform valuable and make your business unique in the competitive landscape.</p>
                <br />
                <p>Thank you,<br /><b>Team nSmartTrac</b></p>
          </div>

          <div class="col-md-7">
                <div id='loading'>loading...</div>
                <div id='calendar'></div>
                <div class="calendar-date-schedule"></div>
          </div>
        </div>        
    </div>
  </section>
</section>

<?php include viewPath('frontcommon/footer-demo'); ?>
<script>
var base_url = "<?php echo base_url();?>";
document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
      dateClick: function(info) {
        $(".calendar-date-schedule").html("<div class='three-quarters-loader'></div> Loading"); 
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: base_url + 'demo/time_schedule',      
               data: {"date":info.dateStr},
               success: function(o)
               {
                  $(".calendar-date-schedule").html(o); 
               },
               complete: function() {
                 
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
