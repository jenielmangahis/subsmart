	<!-- Footer section -->
	<footer class="footer-section spad">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="footer-widget about-widget">
						<img src="<?php echo $url->assets ?>frontend/images/nsmar.jpg" alt="">
						<p><strong>OFFICE LOCATION</strong> <br />1234 Street address, thecity, FL 305262</p>
						<p><strong>Tel. (850) ###-####</strong> <br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
						<p>Copyright 2019. nSmarTrac.com. All Rights Reserved.</p>
						
					</div>
				</div>
				 
				<!-- <div class="col-md-4">
					<div class="footer-widget footer-widget-right">
						<div class="footer-social text-right">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a>
						
						</div> -->
													
						<form class="footer-search">
							<h2 class="fw-title">JOIN OUR NEWSLETTER!</h2>
							<div style="position:relative">
							<input type="text" placeholder="Search">
							<button>Subscribe</button>
							</div>
						</form>
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
