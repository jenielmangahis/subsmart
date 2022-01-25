<!-- Footer -->
<footer class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 ft-booking-txt">Copyright © 2020 nSmartrac. All rights reserved.</div>
		</div>
	</div>
</footer><!-- End Footer -->

<!-- jQuery  -->
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery-initialize/jquery.initialize.min.js"></script>
<!-- <script src="<?php //echo $url->assets ?>js/custom.js"></script> -->
<script src="<?php echo $url->assets ?>js/front_booking.js"></script>
<!-- <script src="<?php //echo $url->assets ?>js/folders_files.js"></script> -->
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>

<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<!-- Validate  -->
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery.validate.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery-timepicker/jquery.timepicker.min.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo $url->assets;?>plugins/sweetalert/sweetalert2@10.js">

<!-- dynamic assets goes  -->
<?php echo put_footer_assets(); ?>

<script type="text/javascript">
	window.base_url = <?php echo json_encode(base_url()); ?>;
	$(document).ready(function() {
		$("img.product__img").hover(function() {
			$(this).parent().find('div.product__img__hover').css("display", "block");
		});
		$("img.product__img").mouseleave(function() {
			$(this).parent().find('div.product__img__hover').css("display", "none");
		});
	});
</script>

</body>

</html>
