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
    background-color: #D9C6F9;
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
                    <div class="product active-template" style="border: solid gray 2px;border-radius: 25px;" id="standard-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <div class="content">
                        <div class="exercise"></div>
                        </div>
                        <span class="title">
                        Standard Template
                        <span>Default</span>
                        </span>
                    </div>
                    <div class="product" style="border: solid gray 2px;border-radius: 25px;" id="alarm-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <div class="content">
                        <div class="sleep"></div>
                        </div>
                        <span class="title">
                        Alarm System Template
                        <!-- <span>Restore Balance</span> -->
                        </span>
                    </div>
                    <div class="product" style="border: solid gray 2px;border-radius: 25px;" id="other-template">
                        <div class="effect-1"></div>
                        <div class="effect-2"></div>
                        <div class="content">
                        <div class="meditation"></div>
                        </div>
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
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
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
                $("#myModal").modal("hide");
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
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
