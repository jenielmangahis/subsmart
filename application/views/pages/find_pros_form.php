<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<style>
.location-active{
  background-color: red;
  padding: 10px;
}  
.find-pro-container{
  position: absolute;
}
</style>
<h1>Let's find you <b><?php echo $find_pro; ?></b></h1>
<small>Please give us a few details so we can connect you with the best pros.</small>
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
<section class="find-pro">
  <div class="container" style="min-height: 400px; position: relative;">
    <div class="find-pro-a find-pro-container">
      <h2>What is the location of your project</h2>
      <div class="form-group">
        <label>Street*</label>
        <input type="text" class="form-control" name="location_street" required="">
      </div>
      <div class="form-group">
        <label>Zip*</label>
        <input type="text" class="form-control" data-next="b" name="location_zip" required="">
      </div>
      <a class="btn btn-info next-find-pro" data-next="b">Next</a>
    </div>
    <div class="find-pro-b find-pro-container" style="display: none;">
      <h2>What kind of location is this?</h2>
      <div class="form-group">
        <a class="btn-home-residence">
          <div class="location-home-residence-container">
            <span>Home / Residence</span>
          </div>
        </a>
        <a class="btn-business">
          <div class="location-business-container">
            <span>Business</span>
          </div>
        </a>
        <a class="btn btn-info prev-find-pro" data-prev="a">Previous</a>
        <a class="btn btn-info next-find-pro" data-next="c">Next</a>
      </div>
    </div>
    <div class="find-pro-c find-pro-container" style="display: none;">
      <h2>What kind of pro is needed?</h2>
      <input type="radio" name="pro_type" class="form-control" value="Ready to Hire"> Ready to Hire<br>
      <input type="radio" name="pro_type" class="form-control" value="Planning & Budgeting"> Planning & Budgeting<br>
      <a class="btn btn-info prev-find-pro" data-prev="b">Previous</a>
      <a class="btn btn-info next-find-pro" data-next="d">Next</a>
    </div>
    <div class="find-pro-d find-pro-container" style="display: none;">
      <h2>how often does your home need to be cleaned?</h2>
      <input type="radio" name="recurring_cleaning" class="form-control" value="Timing is flexible"> Timing is flexible<br>
      <input type="radio" name="recurring_cleaning" class="form-control" value="Less than 2 months"> Less than 2 months<br>
      <input type="radio" name="recurring_cleaning" class="form-control" value="More than 2 months"> More than 2 months<br>
      <a class="btn btn-info prev-find-pro" data-prev="c">Previous</a>
      <a class="btn btn-info next-find-pro" data-next="e">Next</a>
    </div>
    <div class="find-pro-e find-pro-container" style="display: none;">
      <h2>Your contact details</h2>
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

      <a class="btn btn-info prev-find-pro" data-prev="d">Previous</a>
      <a class="btn btn-info next-find-pro" data-next="f">Next</a>
    </div>
    <div class="find-pro-f find-pro-container" style="display: none;">
      <h2>We have matching Pros in your area</h2>
      <h3>Does the info look correct?</h3>
      <span class="info-name"></span><br />
      <span class="info-contact-number"></span><br />
      <span class="info-email"></span><br />
      <a class="btn btn-info prev-find-pro" data-prev="e">Previous</a>
      <button type="submit" class="btn btn-info">Send</button>
    </div>
  </div>
</section>
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
    $(".location-business-container").removeClass('location-active');
    $(".location-home-residence-container").addClass('location-active');
  });

  $(".btn-business").click(function(){
    $("#locationType").val('Business');
    $(".location-home-residence-container").removeClass('location-active');
    $(".location-business-container").addClass('location-active');
  });
});
</script>
