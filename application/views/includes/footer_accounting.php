<!-- Footer -->
<footer class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">Copyright © 2020 nSmartrac. All rights reserved.</div>
		</div>
	</div>
</footer><!-- End Footer -->
<!-- jQuery  -->
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery-initialize/jquery.initialize.min.js"></script>
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--Chartist Chart-->
<!-- <script src="../plugins/chartist/js/chartist.min.js"></script>
<script src="../plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="../plugins/peity-chart/jquery.peity.min.js"></script> -->
<!-- App js<script src="<?php echo $url->assets ?>dashboard/pages/dashboard.js"></script> -->
<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="<?php echo $url->assets ?>plugins/datatables.net/export/dataTables.buttons.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.bootstrap.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/jszip.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/pdfmake.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/vfs_fonts.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.html5.min.js"></script>
<!-- Validate  -->
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/raphael/raphael.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/morris.js/morris.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery.validate.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/bootstrap-treeview/bootstrap-treeview.js"></script>
<!--Accounting JS/-->
<script src="<?php echo $url->assets ?>js/accounting/main.js"></script>
<!--Dropzone JS-->
<script src="<?php echo $url->assets ?>plugins/dropzone/dist/dropzone.js"></script>
<!-- Include calender js files -->
<!-- <script src="<?php //echo base_url() ?>calender/assets/js/calendar.js"></script> -->
<!-- dynamic assets goes  -->
<!-- <#?php echo put_footer_assets(); ?> -->


<!-- <script src="<?php //echo $url->assets ?>jSignature-master/libs/jquery.js"></script>
<script src="<?php //echo $url->assets ?>jSignature-master/libs/jSignature.min.js"></script>
<script src="<?php //echo $url->assets ?>jSignature-master/libs/modernizr.js"></script> -->
<script src="<?php echo $url->assets ?>signature_pad-master/js/signature_pad.js"></script>	
<!-- <script src="<?php echo $url->assets ?>js/jquery.signaturepad.js"></script>
<script src="<?php echo $url->assets ?>js/sign_new.js"></script>
<script src="<?php echo $url->assets ?>js/sign.js"></script>
<script src="<?php echo $url->assets ?>js/sign2.js"></script>
<script>
	jQuery(document).ready(function () {
		jQuery('#smoothed').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
		jQuery("#CustomerSign").on("click touchstart", function () {
			var canvas = document.getElementById("CustomerSign");
			var dataURL = canvas.toDataURL("image/png");
			jQuery("#saveSignatureDB").val(dataURL);
		});
	});
</script> -->
<script type="text/javascript">
	window.base_url = <?php echo json_encode(base_url()); ?>;
</script>
<script>
  $(function () {
    "use strict";
    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666},
        {y: '2011 Q2', item1: 2778},
        {y: '2011 Q3', item1: 4912},
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
  });
   $(document).ready(function() {
        $('#all_sales_table').DataTable();
    } );
</script>

<style>
	.suggestions {
		padding: 0px;
		list-style: none;
		position: absolute;
		z-index: 66666;
		background: #fff;
		width: 325px;
	}

	.suggestions li {
		padding: 10px 8px;
		border-bottom: 1px solid;
		cursor: pointer;
	}

	.mdc-top-app-bar-fixed-adjust {
		position: fixed;
		bottom: 0;
		width: 100%;
		z-index: 99;
		display: flex;
		justify-content: space-evenly;
	}

	.mdc-top-app-bar-fixed-adjust .mdc-bottom-navigation__list {
		height: 100%;
		display: flex;
		display: flex;
		align-items: center;
		justify-content: space-around;
	}

	.mdc-top-app-bar-fixed-adjust .mdc-bottom-navigation__list .mdc-bottom-navigation__list-item {
		display: flex;
		flex-direction: column;
		text-align: center;
	}
</style>

</body>

</html>