<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>
<link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
<style type="text/css">
.tt-suggestion
{
	margin: 0 !important;
}
.wizard-app-block .form-group {
    margin: 0 250px 30px !important;
}
.app-img {
    margin: 0 -14px !important;
}
.app-listing-box ul li {
    width: 17% !important;
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
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-4">
						<div class="wizard-leftbar">
							<div class="wizard-title creatwibx">
								<a href="#"><h2>Create a Wizard</h2></a>
							</div>

							<div class="wizard-tabs">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tb10">Dashboard</a>
									</li>
						    		<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tb1">Wizard Builder</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tb2">My work space</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-10 col-md-9 col-sm-8">
						<div class="wizard-right wizar-add-main">
							<h1><img src="<?php echo $url->assets ?>wizard/img/wizard-ic.png" alt=""> Welcome to Wizard</h1>

							<div class="tab-content">
							  	<div class="tab-pane active" id="tb10">
							  		<div class="wizard-app-block">
							  			<div class="wizard-apps">
								  			<div class="app-search-block">
									  			<h6>Select the apps you use to get your jobs done</h6>

									  			<div class="form-group div_margin">
									  				<div id="prefetch">
									  					<input type="text" name="search_box" id="search_box" placeholder="Search apps here..." class="form-control typeahead">
									  				<i class="fa fa-search"></i>
									  				</div>
									  			</div>
									  		</div>

									  		<div class="app-head">
									  			<span>Your Apps</span>
									  		</div>

									  		<div class="app-listing-box">
									  			<ul id="ulid">
									  				<?php
													foreach($this->wizard_apps_model->getApps() as $row)
													{
													?>
													<li id="li_<?=$row->id?>">
														<div class="app-imgbx">
										  					<div class="app-img">
																<img src="<?php echo $url->assets.$row->app_img ?>" alt="">
																<a href="#" onClick="del_app(<?= $row->id ?>)"><i class="fa fa-times"></i></a>
															</div>
														</div>
														<p><?= $row->app_name ?></p>
													</li>
													<?php
													}
													?>
									  				<!-- <li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic1.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Google Docs</p>
									  				</li> -->
									  				<!-- <li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Gmail</p>
									  				</li>
									  				<li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic3.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Google Contacts</p>
									  				</li>
									  				<li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic4.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Google Calender</p>
									  				</li>
									  				<li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic5.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Google Drive</p>
									  				</li>
									  				<li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Google Sheets</p>
									  				</li>
									  				<li>
									  					<div class="app-imgbx">
										  					<div class="app-img">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic7.png" alt="">
										  						<a href="#"><i class="fa fa-times"></i></a>
										  					</div>
										  				</div>
									  					<p>Google Slides</p>
									  				</li> -->
									  			</ul>
									  		</div>

									  		<div class="app-head">
									  			<span>worklows using your apps</span>
									  		</div>

									  		<div class="your-app-slider">
									  			<div class="prgrm-slid">
									  				<div class="slide-bx">
										  				<div class="slider-app">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic5.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>

										  			<div class="slide-bx">
										  				<div class="slider-app sheets-ap">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>

										  			<div class="slide-bx">
										  				<div class="slider-app calender-ap">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>

										  			<div class="slide-bx">
										  				<div class="slider-app mail-ap">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>

										  			<div class="slide-bx">
										  				<div class="slider-app calender-ap">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>

										  			<div class="slide-bx">
										  				<div class="slider-app sheets-ap">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>

										  			<div class="slide-bx">
										  				<div class="slider-app calender-ap">
										  					<div class="slide-ic">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic2.png" alt="">
										  						<img src="<?php echo $url->assets ?>wizard/img/google-ic6.png" alt="">
										  					</div>

										  					<div class="slid-cnt">
										  						<h6>Save new Gmail attechments to Google Drive</h6>
										  						<p>Gmail + Google Drive</p>
										  					</div>
										  				</div>
										  			</div>
									  			</div>
									  		</div>
									  	</div>

									  	<div class="hint-box">
									  		<div class="row">
									  			<div class="col-md-8 col-sm-8">
									  				<div class="hing-dt">
										  				<h4>Not seeing exactly what you are looking for?</h4>
										  				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
										  			</div>
									  			</div>
									  			<div class="col-md-4 col-sm-4">
									  				<a href="<?php echo base_url(); ?>wizard/build_wizard" class="btn-main">I want to build my own</a>
									  			</div>
									  		</div>
									  	</div>
							  		</div>
							  	</div>
							  	<!-- <div class="tab-pane fade" id="tb1">
							  		
							  	</div>
							  	<div class="tab-pane fade" id="tb2">
							  		
							  	</div>
							  	<div class="tab-pane fade" id="tb3">
							  		
							  	</div> -->
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
 <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
 <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
 
<script>
$(document).ready(function(){
	
	var sample_data = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch:'<?php echo base_url(); ?>wizard/fetch',
		remote:{
			url:'<?php echo base_url(); ?>wizard/fetch/%QUERY',
			wildcard:'%QUERY'
		}
	});
  

  	$('#prefetch .typeahead').typeahead(null, {
			name: 'sample_data',
			display: 'app_name',
			source:sample_data,
			limit:10,
			templates:{
				suggestion:Handlebars.compile(`<div class="row" onClick="myfunc('{{app_id}}','{{app_name}}','{{app_img}}')"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="<?php echo $url->assets ?>{{app_img}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{app_name}}</div></div>`)
			}
		});
	});

	function myfunc(app_id,app_name,app_img)
	{
		$.ajax({
			url:'<?php echo base_url(); ?>wizard/show_app',
			method: 'post',
			data: {app_id: app_id},
			dataType: 'json',
			success: function (response) {
				var mydiv = document.getElementById("ulid");
				var newcontent = document.createElement("li");
				newcontent.innerHTML = "<li id='li_"+app_id+"'><div class='app-imgbx'><div class='app-img'><img src='<?php echo $url->assets?>"+app_img+"' alt=''><a href='#' onClick='del_app("+app_id+")'><i class='fa fa-times'></i></a></div></div><p>"+app_name+"</p></li>";

				while (newcontent.firstChild) {
					mydiv.appendChild(newcontent.firstChild);
				}
		
			}
		});
	}

	function del_app(app_id) {
		$.ajax({
			url:'<?php echo base_url(); ?>wizard/del_app',
			method: 'post',
			data: {app_id: app_id},
			dataType: 'json',
			success: function(response){
				document.getElementById('li_'+app_id).remove();
			}
		});
	}
</script>
