<!-- Footer -->
<footer class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">Copyright © <?= date("Y"); ?> nSmartrac. All rights reserved.</div>
		</div>
	</div>
</footer><!-- End Footer -->
<!-- jQuery  -->
<script type="text/javascript">
	window.base_url = <?php echo json_encode(base_url()); ?>;
</script>
<script src="<?= assets_url('dashboard/js/jquery.min.js'); ?>"></script>
<script src="<?= assets_url('plugins/jquery-initialize/jquery.initialize.min.js'); ?>"></script>
<script src="<?= assets_url('dashboard/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= assets_url('dashboard/js/jquery.slimscroll.js'); ?>"></script>
<script src="<?= assets_url('dashboard/js/waves.min.js'); ?>"></script>
<script src="<?= assets_url('plugins/sweetalert/sweetalert2@10.js'); ?>"></script>
<?php echo put_footer_assets(); ?>
</body>

</html>