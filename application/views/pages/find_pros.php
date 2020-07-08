<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<!-- Headline Section -->
<section class="dyk-find desktop-only">
  <?php echo form_open('find-pros/search', [ 'method' => 'GET', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="container">
      <div class="white-card">
        <div>
          <span class="ft-purple">Tom, we thought you'd be interested in these projects!</span>
        </div>
        <div class="find-container">
          <span  data-height-value="150" class="material-icons icon-find ">search</span>
          <input type="text" placeholder="What service you need?" name="find_pro" required="" class="no-border"/>
          <button class="button-purple" type="submit">Find Pro</button>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</section>
<section class="dyk-find mobile-only">
  <?php echo form_open('find-pros/search', [ 'type' => 'GET', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="container">
      <div class="white-card">
        <div>
          <span class="ft-purple">Tom, we thought you'd be interested in these projects!</span>
        </div>
        <div class="find-container">
          <span  data-height-value="150" class="material-icons icon-find ">search</span>
          <input type="text" placeholder="What service you need?" name="find_pro" required="" class="no-border"/>
        </div>
        <div>
          <button class="button-purple" type="submit">Find Pro</button>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</section>



<section class="find-pro-b">
  <div class="container">
    <div class="card-accordion-find">
      <div class="accord-header-find-purple">
        <span class="text-find-white">Book now for top Projects</span>
        <a href="#" class="accord-quote">Get free quotes</a>
      </div>
      <div class="accord-header-find-white ft-accord-hide">
        <span  data-height-value="150" class="material-icons icon-fp-accord">house</span>
        <span class="text-find-black">Book now for top Projects</span>
        <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
        <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
        <div class="fb-desc">
          <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
        </div>
      </div>
      <div class="accord-header-find-white ft-accord-hide">
        <span  data-height-value="150" class="material-icons icon-fp-accord">switch_camera</span>
        <span class="text-find-black">Lorem Ipsum Dolor</span>
        <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
        <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
        <div class="fb-desc">
          <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
        </div>
      </div>
      <div class="accord-header-find-white ft-accord-hide">
        <span  data-height-value="150" class="material-icons icon-fp-accord">directions</span>
        <span class="text-find-black">Lorem Ipsum Dolor</span>
        <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
        <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
        <div class="fb-desc">
          <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
        </div>
      </div>
      <div class="accord-header-find-white ft-accord-hide">
        <span  data-height-value="150" class="material-icons icon-fp-accord">360</span>
        <span class="text-find-black">Lorem Ipsum Dolor</span>
        <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
        <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
        <div class="fb-desc">
          <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
        </div>
      </div>
    <div>
  </div>
  <br style="clear:both;"/>
  <div class="card-accordion-find-default">
    <div class="accord-header-find-orange">
      <span class="text-find-white">Book now for top Projects</span>
      <a href="#" class="accord-quote">Get free quotes</a>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">house</span>
      <span class="text-find-black">Book now for top Projects</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">switch_camera</span>
      <span class="text-find-black">Lorem Ipsum Dolor</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">directions</span>
      <span class="text-find-black">Lorem Ipsum Dolor</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">360</span>
      <span class="text-find-black">Lorem Ipsum Dolor</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
  </div>
  <br style="clear:both;"/>
  <div class="card-accordion-find-default">
    <div class="accord-header-find-green">
      <span class="text-find-white">Book now for top Projects</span>
      <a href="#" class="accord-quote">Get free quotes</a>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">house</span>
      <span class="text-find-black">Book now for top Projects</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">switch_camera</span>
      <span class="text-find-black">Lorem Ipsum Dolor</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">directions</span>
      <span class="text-find-black">Lorem Ipsum Dolor</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
    <div class="accord-header-find-white ft-accord-hide">
      <span  data-height-value="150" class="material-icons icon-fp-accord">360</span>
      <span class="text-find-black">Lorem Ipsum Dolor</span>
      <span class="material-icons icon-arrow-up-accord display-hidden">keyboard_arrow_up</span>
      <span class="material-icons icon-arrow-down-accord">keyboard_arrow_down</span>
      <div class="fb-desc">
        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
      </div>
    </div>
  </div>
  <div class="container desktop-only">
    <?php echo form_open('find-pros/search', [ 'method' => 'GET', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <div class="container-ft-footer">
        <div>
          <span class="ft-black">Have different project in mind?</span>
        </div>
        <div class="find-container">
          <span  data-height-value="150" class="material-icons icon-find ">search</span>
          <input type="text" placeholder="What service you need?" name="find_pro" required="" class="no-border"/>
          <button class="button-purple" type="submit">Find Pro</button>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div class="container mobile-only">
    <?php echo form_open('find-pros/search', [ 'method' => 'GET', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
      <div class="container-ft-footer">
        <div>
          <span class="ft-black">Have different project in mind?</span>
        </div>
        <div class="find-container">
          <span  data-height-value="150" class="material-icons icon-find ">search</span>
          <input type="text" placeholder="What service you need?" name="find_pro" required="" class="no-border"/>
        </div>
        <div>
          <button class="button-purple" type="submit">Find Pro</button>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
