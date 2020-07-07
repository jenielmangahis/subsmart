<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include viewPath('includes/header');
?>

<div class="wrapper" role="wrapper">
  <div wrapper__section>

    <div class="card py-5">
      <div class="card-content">
      
      
      
        <h1 class="text-center">
          Welcome to the survey page
        </h1>
        <p class="text-center">
          What would you like to do?
        </p>

        <div class="w-100">
          
        </div>

        <div class="row d-flex w-100 justify-content-around">
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card py-5">
              <div class="card-content text-center">
                <h3>Add new survey</h3>
                <a href="<?=base_url()?>survey/add" class="stretched-link"></a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
            <div class="card py-5">
              <div class="card-content text-center">
                <h3>Go to Workspaces</h3>
                <a href="<?=base_url()?>survey/workspace" class="stretched-link"></a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
            <div class="card py-5">
              <div class="card-content text-center">
                <h3>Show themes</h3>
                <a href="<?=base_url()?>survey/themes" class="stretched-link"></a>
              </div>
            </div>
          </div>  
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card  py-5">
              <div class="card-content text-center">
                <h3>Add new survey</h3>
              </div>
            </div>
          </div>
        </div>

        <div id="recent-survey-container">
          
        </div>
        
        
        
        
      </div>
    </div>

  </div>
	<?php include viewPath('includes/sidebars/marketing'); ?>
</div>