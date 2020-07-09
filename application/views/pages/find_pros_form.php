<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<style>
.label-error{
  display: block;
  margin-bottom: 26px;
  padding: 10px;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: .25em;
  background-color: #d9534f;
}
</style>
<div class="container find-pro-form">
  <!-- <h1 class="find-pro-header">Let's find you <b><?php echo $find_pro; ?></b></h1> -->
  <h1 class="find-pro-header">Let's find you some <b>Pro</b> to help</h1>
  <span class="find-pro-subtle">Please give us a few details so we can connect you with the best pros.</span>
</div>
<?php echo form_open('find-pros/send', [ 'type' => 'POST', 'class' => 'form-validate', 'id' => 'form-find-pros', 'autocomplete' => 'off' ]); ?>
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
  <div class="container" style="min-height: 400px; position: relative;padding-bottom:60px;">
    <div class="find-pro-a find-pro-container">
      <div>
        <img src="<?php echo $url->assets ?>frontend/images/map-marker.png" class="img-marker"/>
      </div>
      <h2>What is the location of your project</h2>
      <div class="form-indent">
        <div class="form-a-error"></div>
        <div class="form-group">
          <label>Street*</label>
          <input type="text" class="form-control" id="locationStreet" name="location_street" required="">
        </div>
        <div class="form-group">
          <label>Zip*</label>
          <input type="text" class="form-control" id="locationZip" data-next="b" name="location_zip" required="">
        </div>
        <a class="about-btn btn-color-white next-find-pro" data-next="b">Next</a>
      </div>
    </div>
    <div class="find-pro-b find-pro-container" style="display: none;">
      <h2>What kind of location is this?</h2>
      <div class="form-indent-c">
        <div class="form-group">
          <a class="btn-home-residence">
            <div class="location-home-residence-container">
              <span class="selector-link location-active">
                <img src="<?php echo $url->assets ?>frontend/images/home-icon.png"/>
                <br style="clear:both;"/>
                <br/>
                <span class="location-active">Home / Residence</span>
              </span>
            </div>
          </a>
          <a class="btn-business">
            <div class="location-business-container">
              <span class="selector-link">
                <img src="<?php echo $url->assets ?>frontend/images/business-icon.png"/>
                <br style="clear:both;"/>
                <br/>
                <span>Business</span>
              </span>
            </div>
          </a>
          <br style="clear:both;"/>
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
          <input type="radio" name="pro_type" checked="" class="form-control-radio" value="Ready to Hire">
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
      <h2>When would you like<br/> this request to be completed?</h2>
      <div class="form-indent-b">
        <div class="radio-divider">
          <input type="radio" name="recurring_cleaning" checked="" class="form-control-radio" value="Timing is flexible">
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
      <div class="form-e-error"></div>
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

        <div class="form-group">
          <label>Business Name*</label>
          <input id="google_search_place" type="text" name="business_name" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Name" autocomplete="on" runat="server" required="" />
        </div>

        <div class="form-group">
          <label>Business Address*</label>
          <input id="business_address" type="text" name="business_address" class="form-control ng-pristine ng-untouched ng-valid ng-empty" aria-label="Your Business Address" required="" />
        </div>

        <div class="form-group">
          <label>Your Industry*</label>
          <select class="reg-select z-100 cmb-industry" id="sel2">
            <option>--Select your Industry--</option>
              <?php foreach( $business as $key => $values ){ ?>
                  <optgroup label="<?php echo $key; ?>">
                  <?php foreach( $values as $value ){ ?>
                      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                  <?php } ?>
              <?php } ?>
          </select>
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
        <div class="center-btn"  style="text-align: center;">
        	<a href="javascript:void(0);" class="prev-find-pro" data-prev="e" style="margin:0 auto;">Edit</a>
    	</div>
      </div>
      <div class="send-msg"></div>
      <div class="center-btn">
        <a href="javascript:void(0);" class="fnd-btn send-pros"style="width:100%;">Submit</a>
      </div>
      <div class="clear"></div>
      <div style="display: block; font-size: 11px;margin-top: 32px;">
      	By clicking Submit, you affirm you have read and agree to the nSmartracs Terms, and you agree and authorize nSmartracs and its affiliates, and their networks of Service Professionals, to deliver marketing calls or texts using automated technology to the number you provided above regarding your project and other home services offers. Consent is not a condition of purchase.
      </div>
    </div>
  </div>
</section>
<br style="clear:both;"/>
<br/>
<?php echo form_close(); ?>
<?php include viewPath('frontcommon/footer'); ?>

<script>
var base_url = '<?php echo base_url(); ?>';

$(function(){
  $(".next-find-pro").click(function(){
    var next = $(this).attr("data-next");

    if( next == "b" ){
      if( $("#locationZip").val() == '' || $("#locationStreet").val() == '' ){
        var error = '<label class="label label-error">Both fields are required.</label>';
        $(".form-a-error").html(error);
      }else{
        $(".form-a-error").html("");
        $(".find-pro-container").hide();
        $(".find-pro-" + next).fadeIn();
      }
    }else if( next == 'f' ){
      var error = '';
      if( $("#proName").val() == '' ){
        var error = '<label class="label label-error">Your name is required.</label>';
      }else if( $("#proContactNumber").val() == '' ){
        var error = '<label class="label label-error">Your contact number is required.</label>';
      }else if( $("#proEmailAddress").val() == '' ){
        var error = '<label class="label label-error">Your email is required.</label>';
      }else if( $("#google_search_place").val() == '' ){
        var error = '<label class="label label-error">Your business name is required.</label>';
      }else if( $("#business_address").val() == '' ){
        var error = '<label class="label label-error">Your business address is required.</label>';
      }else if( $("#sel2").val() == '' ){
        var error = '<label class="label label-error">Please select industry.</label>';
      }

      if( error != '' ){
        $(".form-e-error").html(error);
      }else{
        $(".form-e-error").html("");
        $(".find-pro-container").hide();
        $(".find-pro-" + next).fadeIn();

        $(".info-name").text($("#proName").val());
        $(".info-contact-number").text($("#proContactNumber").val());
        $(".info-email").text($("#proEmailAddress").val());
        $(".info-business-name").text($("#google_search_place").val());
        $(".info-business-address").text($("#business_address").val());
      }

      
    }else {
      $(".find-pro-container").hide();
      $(".find-pro-" + next).fadeIn();
    }

  });

  $(".prev-find-pro").click(function(){
    var prev = $(this).attr("data-prev");
    $(".find-pro-container").hide();
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

  $(".send-pros").click(function(){
  	$.ajax({
       type: "POST",
       dataType: "json",
       url: base_url + 'find-pros/send',
       data: $("#form-find-pros").serialize(),
       success: function(o)
       {
          if( o.is_success == 1 ){
          	$(".find-pro-form").html("");
          	$(".find-pro").html("Your email has been sent.");
          }else{
          	$(".send-msg").html("Cannot send email");
          }
       }
    });
  });
});
</script>
