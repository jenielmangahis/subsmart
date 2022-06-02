<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>sass/styles.scss">
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
<style>
.active-template
{
    /* background-color: #D9C6F9; */
    background-image: linear-gradient(#7F52CC, #D571FA, #4EF1ED);
}

</style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card">
                <!-- <h3>Work Order Templates</h3> -->

                <!-- <div class="row">
                    <div class="col-md-1">
                    <div class="square">
                        <h3>Module Name</h3>
                        <p>Module is used for this and that</p>
                    </div>
                    </div>
                </div> -->
                
            <input type="hidden" name="template_id_field" id="template_id">

                <h1>Choose Your Template</h1>
                <div class="container">
                    <div class="product active-template whole-div" style="border: solid #F8F8F8 2px;border-radius: 25px;box-shadow: 3px 6px #E7E6E6;" id="standard-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <!-- <div class="content">
                            <div class="exercise"></div>
                        </div> -->
                        <span class="title">
                        Standard Template
                        <span>Default</span>
                        </span>
                    </div>
                    <div class="product active-template" style="border: solid #F8F8F8 2px;border-radius: 25px;box-shadow: 3px 6px #E7E6E6;" id="alarm-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <!-- <div class="content">
                        <div class="sleep"></div>
                        </div> -->
                        <span class="title">
                        Alarm Template
                        <!-- <span>Restore Balance</span> -->
                        </span>
                    </div>
                    <?php 
                        $company_id = logged('company_id');
                        if($company_id == '4'){
                    ?>
                    <div class="product active-template" style="border: solid #F8F8F8 2px;border-radius: 25px;box-shadow: 3px 6px #E7E6E6;" id="solar-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <!-- <div class="content">
                        <div class="sleep"></div>
                        </div> -->
                        <span class="title">
                        Solar Template
                        <!-- <span>Restore Balance</span> -->
                        </span>
                    </div>
                    <?php } ?>
                    <div class="product active-template" style="border: solid #F8F8F8 2px;border-radius: 25px;box-shadow: 3px 6px #E7E6E6;" id="other-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <!-- <div class="content">
                        <div class="meditation"></div>
                        </div> -->
                        <span class="title">
                        Other Template
                        <!-- <span>Practice gratitude</span> -->
                        </span>
                    </div>
                </div>
<!-- 
                <div id="popUpOverlay"></div>
                <div id="popUpBox">
                    <div id="box" style="padding-bottom:10px;">
                        <h1>Set Template</h1>
                        <input type="button" value="Set">
                        <div id="closeModal"></div>
                    </div>
                </div>

                <div id="open-modal" class="modal-window">
  <div>
    <a href="#modal-close" title="Close" class="modal-close">close &times;</a>
    <h1>CSS Modal</h1>
    <div>The quick brown fox jumped over the lazy dog.</div>
  </div>
</div> -->
                
            </div>
            
        </div>
    <!-- end container-fluid -->
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div> -->
          <div class="modal-body">
            <center><h4>Set  <span id="temptitle"></span> as Template</h4></center>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-success set_template">Set</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <div id="successm" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div> -->
          <div class="modal-body">
            <center><h2>Successfully changed!</h2>
            <button type="button" class="btn btn-success workordermodal" data-toggle="modal" data-target="#workordermodal">Create New Work Order</button></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <div class="modal fade" id="workordermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Work Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center" id="selecting_form">
              <p class="text-lg margin-bottom">
                  What type of Work Order you want to create
              </p><center>
              <div class="margin-bottom text-center" style="width:60%;">
                  <div class="help help-sm">Create new work Order</div>
                  <?php if(empty($company_work_order_used->work_order_template_id)){ ?>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/NewworkOrder') ?>"><span class="fa fa-file-text-o"></span> New Work Order</a>
                  <?php }
                  elseif($company_work_order_used->work_order_template_id == '0'){ ?>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/NewworkOrder') ?>"><span class="fa fa-file-text-o"></span> New Work Order</a>
                  <?php }
                  elseif($company_work_order_used->work_order_template_id == '1'){ ?>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/NewworkOrderAlarm') ?>"><span class="fa fa-file-text-o"></span> New Work Order</a>
                  <?php }
                  elseif($company_work_order_used->work_order_template_id == '2'){ ?>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/addsolarworkorder') ?>"><span class="fa fa-file-text-o"></span> New Work Order</a>
                  <?php } ?>
              </div>
              <div class="margin-bottom" style="width:60%;">
                  <div class="help help-sm">Existing Work Order</div>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/NewworkOrder?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Existing </a>
              </div></center>
        </div>
    </div>
</div>


<?php include viewPath('includes/footer'); ?>

<script>
$(document).on('click','#standard-template',function(){
    // alert('standard');
    var template1 = '0';
    var temp = $('#template_id').val(template1);
    var template = $('#template_id').val();
    var temptitle = $('#temptitle').html('Standard');
    $("#myModal").modal("show");

    $(".set_template").click(function() {
        $.ajax({
            url:"<?php echo base_url(); ?>workorder/changeTemplate",
            type: "POST",
            data: {template : template },
            success: function(dataResult){
                $("#myModal").modal("hide");
                $("#successm").modal("show");
                $('#selecting_form').load(window.location.href +  ' #selecting_form');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
    });

    $(".workordermodal").click(function() {
        $("#successm").modal("hide");
    });

});

$(document).on('click','#alarm-template',function(){
    // alert('alarm');
    var template1 = '1';
    var temp = $('#template_id').val(template1);
    var template = $('#template_id').val();
    // alert(template);
    var temptitle = $('#temptitle').html('Alarm System');
    $("#myModal").modal("show");

    $(".set_template").click(function() {
        $.ajax({
            url:"<?php echo base_url(); ?>workorder/changeTemplate",
            type: "POST",
            data: {template : template },
            success: function(dataResult){
              // alert('success');
                $("#myModal").modal("hide");
                $("#successm").modal("show");
                $('#selecting_form').load(window.location.href +  ' #selecting_form');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
    });

    $(".workordermodal").click(function() {
        $("#successm").modal("hide");
    });
});

$(document).on('click','#solar-template',function(){
    // alert('alarm');
    var template1 = '2';
    var temp = $('#template_id').val(template1);
    var template = $('#template_id').val();
    // alert(template);
    var temptitle = $('#temptitle').html('Solar System');
    $("#myModal").modal("show");

    $(".set_template").click(function() {
        $.ajax({
            url:"<?php echo base_url(); ?>workorder/changeTemplate",
            type: "POST",
            data: {template : template },
            success: function(dataResult){
              // alert('success');
                $("#myModal").modal("hide");
                $("#successm").modal("show");
                $('#selecting_form').load(window.location.href +  ' #selecting_form');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
    });

    $(".workordermodal").click(function() {
        $("#successm").modal("hide");
    });
});

$(document).on('click','#other-template',function(){
    alert('other');
});
</script>

<script>
var Alert = new CustomAlert();

function CustomAlert(){
  this.render = function(){
      //Show Modal
      let popUpBox = document.getElementById('popUpBox');
      popUpBox.style.display = "block";

      //Close Modal
      document.getElementById('closeModal').innerHTML = '<button onclick="Alert.ok()">Cancel</button>';

  }

  

this.ok = function(){

  document.getElementById('popUpBox').style.display = "none";
  document.getElementById('popUpOverlay').style.display = "none";

}

}
</script>
