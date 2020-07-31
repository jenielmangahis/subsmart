<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>
<style type="text/css">
	
#myDiv div:nth-child(n+5) {
    display:none;
}
#myDiv2 div:nth-child(n+5) {
    display:none;
}
</style>
<div class="row">
	<div class="col-md-2">
		<div class="wrapper" role="wrapper">
			<?php include viewPath('includes/sidebars/upgrades'); ?>
		</div>
	</div>
	<div class="col-md-10">
		<!-- Wizard -->
		<section class="wizard-wrp">
			<div class="container">
				<div class="build-wizard-wrp">
					<div class="build-head">
						<h1><i class="fa fa-bolt"></i> 1. When this happens...</h1>
					</div>

					<div class="app-listing-wrp">
						<div class="app-search-build">
							<h4>Choose App & Event</h4>

							<div class="form-group">
								<input type="text" name="search_box" id="search_box" placeholder="Not seeing your app? Search here ...." class="form-control" onkeyup="mySearch()">
								<i class="fa fa-search"></i>
							</div>
						</div>

						<div class="app-listing-build">
							<h4>Your Apps</h4>

							<div class="row" id="myDiv">
								<?php
								foreach($this->wizard_apps_model->getApps() as $row)
								{
								?>
								<div class="col-md-3 col-sm-3 hideDiv">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<img src="<?php echo $url->assets.$row->app_img ?>" alt="">
										</div>
										<h4><?= $row->app_name ?></h4>
									</div></a>
								</div>
								<?php
								}
								?>

							</div>
							<button style="border: none;" type="button" href="#" class="show-btn" id="show_more">Show More</button>
						</div>

						<div class="app-listing-build">
							<h4>Built-In Apps</h4>

							<div class="row" id="myDiv2">
								<div class="col-md-3 col-sm-3">
									<a href="<?php echo base_url(); ?>wizard/mailchimp"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-bookmark"></i>
										</div>
										<h4>Schedule</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-list-alt"></i>
										</div>
										<h4>Estimates</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-list-alt"></i>
										</div>
										<h4>Work Orders</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-file-text-o"></i>
										</div>
										<h4>Invoices</h4>
									</div></a>
								</div>

								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-list"></i>
										</div>
										<h4>Plans</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-ticket"></i>
										</div>
										<h4>Tickets</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-question-circle"></i>
										</div>
										<h4>Leads</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-file"></i>
										</div>
										<h4>Esign</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-handshake-o"></i>
										</div>
										<h4>Affiliates</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-houzz"></i>
										</div>
										<h4>Inventory</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<i class="fa fa-2x fa-wpforms"></i>
										</div>
										<h4>Form Builder</h4>
									</div></a>
								</div>
							</div>

							<button style="border: none;" type="button" href="#" class="show-btn" id="show_more2">Show More</button>
						</div>

						<div class="app-listing-build">
							<h4>Popular Apps</h4>

							<div class="row">
								<div class="col-md-3 col-sm-3">
									<a href="mailchimp.html"><div class="app-box-choice">
										<div class="build-ap-ic">
											<img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt="">
										</div>
										<h4>Mailchimp</h4>
									</div></a>
								</div>
								<div class="col-md-3 col-sm-3">
									<a href="#"><div class="app-box-choice">
										<div class="build-ap-ic">
											<img src="<?php echo $url->assets ?>wizard/img/ac.png" alt="">
										</div>
										<h4>Active Campaign</h4>
									</div></a>
								</div>							
							</div>
						</div>
					</div>

					<div class="row">
							<i class="fa fa-2x fa-plus-circle" style="text-align:center;display: inline-block;width: 100%;" onclick="add_seq()"></i>
					</div>
				</div>

				<div class="build-wizard-wrp" id="hide-section" style="display: none;">
					<div class="build-head">
						<h1><i><img src="<?php echo $url->assets ?>wizard/img/mailchi.png"></i> <strong><span>when this happens...</span> 1. Mailchimp</strong></h1>
					</div>

					<div class="app-listing-wrp">
						<h4>Choose App & Event</h4>

						<div class="form-group">
							<label>Choose App <span>(Required)</span></label>
							<div class="dropdown">
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown"><img src="<?php echo $url->assets ?>wizard/img/mailchi.png" alt=""> Choose app
							  	<i class="fa fa-angle-down"></i></button>
							  	<ul class="dropdown-menu">
							  		<?php
									foreach($this->wizard_subapps_model->getApps() as $row)
									{
									?>
								    <li><a href="#" onclick="clicksub(<?=$row->id?>)"><img src="<?php echo $url->assets ?><?=$row->sub_app_img?>" alt=""> <?=$row->sub_app_name?></a></li>
								    <?php } ?>
							  	</ul>
							</div>
						</div>

						<div class="form-group">
							<label>Choose Trigger Event <span>(Required)</span></label>
							<div class="dropdown">
							  	<button class="btn-chmail dropdown-toggle" type="button" data-toggle="dropdown">Choose option
							  	<i class="fa fa-angle-down"></i></button>
							  	<ul class="dropdown-menu">
							  		<?php
									foreach($this->wizard_suboptions_model->getSubOptions("1") as $row)
									{
									?>
								    <li><a href="#"><?=$row->option_name?>  <span><?=$row->option_comment?></span></a></li>
								    <?php } ?>
							  	</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Wizard -->
	</div>
</div>
<?php include viewPath('includes/footer_wizard'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
function mySearch() {
  var input, filter, main_div, sub_div,i, txtValue;
  input = document.getElementById("search_box");
  filter = input.value.toUpperCase();
  main_div = document.getElementById("myDiv");
  sub_div = main_div.getElementsByTagName("h4");
  //alert(sub_div.length);
  for (i = 0; i < sub_div.length; i++) {
    console.log(main_div);
      txtValue = sub_div[i].textContent || sub_div[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
      	document.getElementsByClassName("hideDiv")[i].style.display="block";
      } else {
        document.getElementsByClassName("hideDiv")[i].style.display="none";
      }    
  }
}

$(function () {
    $('#show_more').click(function () {
        $('#myDiv div:hidden').slice(0, 10).show();
        if ($('#myDiv div').length == $('#myDiv div:visible').length) {
            $('#show_more ').hide();
        }
    });
    $('#show_more2').click(function () {
        $('#myDiv2 div:hidden').slice(0, 10).show();
        if ($('#myDiv2 div').length == $('#myDiv2 div:visible').length) {
            $('#show_more2').hide();
        }
    });
});
function add_seq()
{
	$("#hide-section").css('display','block');
}
function clicksub(id) {
	/*alert(id);
	$.ajax({
		url:'<?php echo base_url(); ?>wizard/getSubOptions',
	     method: 'post',
	     data: {id: id},
	     dataType: 'json',
	     success: function(response){
       		document.getElementById('sub_opt').innerHtml(response);
     }
	});*/
}
</script>