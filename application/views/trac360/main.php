<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /* Set the size of the div element that contains the map */
   #map {
     height: 50vh;  /* The height is 400 pixels */
     width: 100%;  /* The width is the width of the web page */
    }

 </style>

<!-- page wrapper start -->
<!-- <div class="wrapper" role="wrapper"> -->
   <!--<div wrapper__section>-->
   <div class="container" style="margin-top: 7rem">     
      <div class="row">
         <div class="col-md-12">
            <div class="page-title-box">
               <div class="row align-items-center">
                  <div class="col-sm-6">
                     <h1 class="page-title">Trac360</h1>
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Search the globe online</li>
                     </ol>
                  </div>
                  <div class="col-sm-6">
                     
                  </div>
               </div>
            </div>
         </div>
      </div>               
      <div class="row">
         <div class="col-md-12">
          <?php echo $map ?>
         </div>
         <!-- end row -->           
      </div>
   </div>
   <!--</div>-->
   <!-- end container-fluid -->
<!-- </div> -->

<!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
<?php echo $map_js; ?>
<script>
  
</script>