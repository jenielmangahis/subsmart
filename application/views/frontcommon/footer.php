	<!-- Footer section -->
	<footer class="footer-section spad">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-xl-3 col-lg-3 col-sm-6 float-left">
						<ul class="footer-list">
							<li><h5 class="font-kanit text-white weight-600">Get Started</h5></li>
							<li><a href="#">Features</a></li>
							<li><a href="#">Pricing</a></li>
						</ul>
					</div>
					<div class="col-xl-3 col-lg-3 col-sm-6 float-left">
						<ul class="footer-list">
							<li><h5 class="font-kanit text-white weight-600">Our Company</h5></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>
					<div class="col-xl-3 col-lg-3 col-sm-6 float-left">
						<ul class="footer-list">
							<li><h5 class="font-kanit text-white weight-600">Legal</h5></li>
							<li><a href="#">Terms & Condition</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Anti-spam Policy</a></li>
						</ul>
					</div>
					<div class="col-xl-3 col-lg-3 col-sm-6 float-left">
						<ul class="footer-list">
							<li><h5 class="font-kanit text-white weight-600">Connect</h5></li>
							<!-- <li><a href="#">***Social Media icons***</a></li> -->
						</ul>
						<div class="footer-social text-left">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a>
						</div>						
					</div>
					<!-- <div class="footer-widget about-widget">
						<img src="<?php echo $url->assets ?>frontend/images/nsmar.jpg" alt="">
						<p><strong>OFFICE LOCATION</strong> <br />1234 Street address, thecity, FL 305262</p>
						<p><strong>Tel. (850) ###-####</strong> <br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
						<p>Copyright 2019. nSmarTrac.com. All Rights Reserved.</p>

					</div> -->
				</div>
				<hr class="line-footer"/>

				<div class="col-sm-9 m-auto">
					<div class="col-sm-4 float-left">
						<img src="<?php echo $url->assets ?>frontend/images/nsmar.jpg" alt="">
					</div>
					<div class="col-sm-8 float-left">
						<span class="font-kanit footer-copyright">All rifghts reserved &copy; 2020 nSmartTrac Corporation Pensacola, FL, USA
					</div>
				</div>
				<!-- <div class="col-md-4">
					<div class="footer-widget footer-widget-right">
						<div class="footer-social text-right">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a>

						</div> -->

						<!--<form class="footer-search">
							<h2 class="fw-title">JOIN OUR NEWSLETTER!</h2>
							<div style="position:relative">
							<input type="text" placeholder="Search">
							<button>Subscribe</button>
							</div>
						</form> -->
					</div>
				</div>
			</div>
		</div>


	<!--====== Javascripts & Jquery ======-->
	<script src="<?php echo $url->assets ?>frontend/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $url->assets ?>frontend/js/bootstrap.min.js"></script>
	<script src="<?php echo $url->assets ?>frontend/js/jquery.slicknav.min.js"></script>
	<script src="<?php echo $url->assets ?>frontend/js/owl.carousel.min.js"></script>
	<script src="<?php echo $url->assets ?>frontend/js/circle-progress.min.js"></script>
	<script src="<?php echo $url->assets ?>frontend/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo $url->assets ?>frontend/js/main.js"></script>
	<?php
		if (isset($footerBottomScripts)) {
			echo $footerBottomScripts;
		}
	?>
	</body>
</html>
