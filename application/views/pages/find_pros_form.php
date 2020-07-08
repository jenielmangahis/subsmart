<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<style>
.find-pro-container{
  position: absolute;
}
</style>
<div class="container find-pro-form">
  <h1 class="find-pro-header">Let's find you <b><?php echo $find_pro; ?></b></h1>
  <span class="find-pro-subtle">Please give us a few details so we can connect you with the best pros.</span>
  <img src="<?php echo $url->assets ?>frontend/images/map-marker.png" class="img-marker"/>
</div>
<?php echo form_open('find-pros/search', [ 'type' => 'POST', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
<?php echo form_hidden('find_pro',$find_pro) ?>
<?php
  $location_type = [
    'type' => 'hidden',
    'name' => 'location_type',
    'value' => 'Home / Residence',
    'id' => 'locationType'
  ];

  echo form_input($location_type);
?>
<section class="find-pro center-form">
  <div class="container" style="min-height: 400px; position: relative;">
    <div class="find-pro-a find-pro-container">
      <h2>What is the location of your project</h2>
      <div class="form-indent">
        <div class="form-group">
          <label>Street*</label>
          <input type="text" class="form-control" name="location_street" required="">
        </div>
        <div class="form-group">
          <label>Zip*</label>
          <input type="text" class="form-control" data-next="b" name="location_zip" required="">
        </div>
        <a class="about-btn btn-color-white next-find-pro" data-next="b">Next</a>
      </div>
    </div>
    <div class="find-pro-b find-pro-container" style="display: none;">
      <h2>What kind of location is this?</h2>
      <div class="form-indent">
        <div class="form-group">
          <a class="btn-home-residence">
            <div class="location-home-residence-container">
              <span class="selector-link">Home / Residence</span>
            </div>
          </a>
          <a class="btn-business">
            <div class="location-business-container">
              <span class="selector-link">Business</span>
            </div>
          </a>
          <div class="center-btn">
            <a class="fnd-btn prev-find-pro" data-prev="a">Previous</a>
            <a class="fnd-btn next-find-pro" data-next="c">Next</a>
         </div>
        </div>
      </div>
    </div>
    <div class="find-pro-c find-pro-container" style="display: none;">
      <h2>What kind of pro is needed?</h2>
      <div class="form-indent-b">
        <div class="radio-divider">
          <input type="radio" name="pro_type" class="form-control-radio" value="Ready to Hire">
          <span class="span-radio">Ready to Hire</span>
        </div>
        <div class="radio-divider">
          <input type="radio" name="pro_type" class="form-control-radio" value="Planning & Budgeting">
          <span class="span-radio">Planning & Budgeting</span>
        </div>
      </div>
      <div class="center-btn">
        <a class="fnd-btn prev-find-pro" data-prev="b">Previous</a>
        <a class="fnd-btn next-find-pro" data-next="d">Next</a>
      </div>
    </div>
    <div class="find-pro-d find-pro-container" style="display: none;">
      <h2>How often does your <br/> home need to be cleaned?</h2>
      <div class="form-indent-b">
        <div class="radio-divider">
          <input type="radio" name="recurring_cleaning" class="form-control-radio" value="Timing is flexible">
          <span class="span-radio">Timing is flexible</span>
        </div>
        <div class="radio-divider">
          <input type="radio" name="recurring_cleaning" class="form-control-radio" value="Less than 2 months">
          <span class="span-radio">Less than 2 months</span>
        </div>
        <div class="radio-divider">
          <input type="radio" name="recurring_cleaning" class="form-control-radio" value="More than 2 months">
          <span class="span-radio">More than 2 months</span>
        </div>
      </div>
      <div class="center-btn">
        <a class="fnd-btn prev-find-pro" data-prev="c">Previous</a>
        <a class="fnd-btn next-find-pro" data-next="e">Next</a>
      </div>
    </div>
    <div class="find-pro-e find-pro-container" style="display: none;">
      <h2>Your contact details</h2>
      <div class="form-indent">
        <div class="form-group">
          <label>Name*</label>
          <input type="text" class="form-control" id="proName" name="name" required="">
        </div>
        <div class="form-group">
          <label>Contact Number*</label>
          <input type="text" class="form-control" id="proContactNumber" name="contact_number" required="">
        </div>

        <div class="form-group">
          <label>Email*</label>
          <input type="text" class="form-control" id="proEmailAddress" name="email_address" required="">
        </div>
      </div>
      <div class="center-btn">
        <a class="fnd-btn prev-find-pro" data-prev="d">Previous</a>
        <a class="fnd-btn next-find-pro" data-next="f">Next</a>
      </div>
    </div>
    <div class="find-pro-f find-pro-container" style="display: none;">
      <h2 class="mb-0">We have matching Pros in your area</h2>
      <span class="finalize-spn">Does the info look correct?</span>
      <br/>
      <div class="form-indent">
        <span class="info-name info-text"></span>
        <span class="info-contact-number info-text"></span>
        <span class="info-email info-text"></span>
      </div>
      <div class="center-btn">
        <a class="fnd-btn prev-find-pro" data-prev="e">Previous</a>
        <a class="fnd-btn prev-find-pro" class="btn btn-info">Send</a>
      </div>
    </div>
  </div>
</section>
<br style="clear:both;"/>
<br/>
<?php echo form_close(); ?>
<?php include viewPath('frontcommon/footer'); ?>

<script>
$(function(){
  $(".next-find-pro").click(function(){
    var next = $(this).attr("data-next");

    if( next == 'f' ){
      $(".info-name").text($("#proName").val());
      $(".info-contact-number").text($("#proContactNumber").val());
      $(".info-email").text($("#proEmailAddress").val());
    }

    $(".find-pro-container").fadeOut();
    $(".find-pro-" + next).fadeIn();
  });
  $(".prev-find-pro").click(function(){
    var prev = $(this).attr("data-prev");
    $(".find-pro-container").fadeOut();
    $(".find-pro-" + prev).fadeIn();
  });

  $(".btn-home-residence").click(function(){
    $("#locationType").val('Home / Residence');
    $("div.location-business-container span").removeClass('location-active');
    $("div.location-home-residence-container span").addClass('location-active');
  });

  $(".btn-business").click(function(){
    $("#locationType").val('Business');
    $("div.location-home-residence-container span").removeClass('location-active');
    $("div.location-business-container span").addClass('location-active');
  });
});
</script>
