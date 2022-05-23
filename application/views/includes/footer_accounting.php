<!-- Footer -->
<div class="loader">
	<img src="<?php echo base_url(); ?>/assets/img/loader.svg" />
</div>
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
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
Chartist Chart-->
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
<script src="<?php echo $url->assets ?>js/accounting/vendors.js"></script>

<script src="<?php echo $url->assets;?>js/timesheet/clock.js"></script>
<script src="<?php echo $url->assets;?>js/icons/icon.navbar.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>


<script src="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<!--Accounting JS-->
<?php echo put_footer_assets();?>
<script type="text/javascript">
	window.base_url = <?php echo json_encode(base_url()); ?>;
</script>

<script>
jQuery(document).ready(function () {
$('#reportstable').DataTable();
});
</script>

<script>
// jQuery(document).ready(function () {
	$("#division").hover(function(){
		$('.to-show-div').show();
		$('.to-hide-div').hide();
	},function(){
		$('.to-show-div').hide();
		$('.to-hide-div').show();
	});
// });
$('#e2').on('click', function(){
    var title = $(this).val();
    $(this).css('background-color', title);
});

$('.ajax-modal_invoice').click(function(e){
  e.preventDefault(); 
  alert("sana all");
//   $.ajax({
//    type: "POST",
//    url: '<?php //echo base_url('/accounting/modal_invoice') ?>',
//    success: function (html) {
//     $("#addinvoiceModal").modal('show'); //insert retrieved data into modal, and then show it
//    },
//    error: function() {
//     alert('Ajax did not succeed');
//    }
//   });
});
<<<<<<< HEAD
=======


function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});


$(document).ready(function () {
    $('#datepickerinv').datepicker({
      uiLibrary: 'bootstrap'
    });
	$('#datepickerinv2').datepicker({
      uiLibrary: 'bootstrap'
    });
	$('#datepickerinv3').datepicker({
      uiLibrary: 'bootstrap'
    });

	document.getElementById("addNewTerms").onchange = function() {
    if (this.value == '0') {
        // alert('yeah');
		$('#exampleModal').modal('toggle');
    	}
	}
});


>>>>>>> ad3fe0ffd9ca5a6a5044ee0f7e0dffa46146fa80
</script>

<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: "Salary Trends"
	},
	animationEnabled: true,
	exportEnabled: true,
	data: [
	{
		type: "spline", //change it to line, area, column, pie, etc
		dataPoints: [
			{ x: 10, y: 10 },
			{ x: 20, y: 12 },
			{ x: 30, y: 8 },
			{ x: 40, y: 14 },
			{ x: 50, y: 6 },
			{ x: 60, y: 24 },
			{ x: 70, y: -4 },
			{ x: 80, y: 10 }
		]
	}
	]
};
$("#chartContainer").CanvasJSChart(options);

}
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
		appendFavoriteReports();
        $('#all_sales_table').DataTable();
        $('#manage_reports_table').DataTable();
		var screenWidth = $( window ).width();
		
		setTimeout(function(){
			//console.log(123);
			//console.log($("#sidebar").width());
			if(screenWidth > 768){
				if($("#sidebar").width() == 40){
						
						$("div[wrapper__section]").css({"margin-left":"40px"});
					}
					else{
						$("div[wrapper__section]").css({"margin-left":"260px"});
					}
			}
		}, 100);
			
		$('.nav-close').click(function() {
			$(".sidebar-accounting .submenus ul").hide();
			var screenWidth = $( window ).width();
			
			if(screenWidth > 768){
				if($("#sidebar").width() == 40){
					$("div[wrapper__section]").css({"margin-left":"260px"});
				}
				else{
					$("div[wrapper__section]").css({"margin-left":"40px"});
				}
			}
		});
		
		$(".reports-page .menu-reports .card-body ul li a .fa").hover(function(){
			  $(this).css("color","#498002");  
			  $(this).removeClass("fa-star-o");
			  $(this).addClass("fa-star");
			  
		  }, function () {
			  $(this).css("color","#6c757d");
			  $(this).addClass("fa-star-o");
			  $(this).removeClass("fa-star");
		  });
		  $(".reports-page #favorites .card-body ul li a .fa").hover(function(){
				$(this).css("color","#6c757d");
				$(this).addClass("fa-star-o");
				$(this).removeClass("fa-star");
			  
		  }, function () {
				$(this).css("color","#498002");  
				$(this).removeClass("fa-star-o");
				$(this).addClass("fa-star");
		  });
    } );
	function showAddBtnModal(){
		$("#addBtnModal").modal("show");
	}
	function appendFavoriteReports(){
		var favoriteReports = JSON.parse(getCookie('favorite-reports'));
		favoriteReports.sort();
		var reports;
	   
	   $("#favorites-reports").empty();
	   for(var x=0;x < favoriteReports.length ;x++){
		   reports = "";
		   reports = '<li class="border-bottom p-3 cursor-pointer">'
						+ '<a href="'+favoriteReports[x][1]+'" class="h5 mb-0 font-weight-normal">'+favoriteReports[x][0]+'</a>'
						+ '<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o"></i></a>'
						+ '<div class="dropdown pull-right d-inline-block">'
							+ '<span type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v fa-lg"></i></span>'
							+ '<ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"><li><a href="#" class="dropdown-item">Customize</a></li></ul>'
						+ '</div>'
						+ '<a href="#" onclick="removeFavoriteReports('+x+')" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star fa-lg"></i></a>'
					+ '</li>';
			$("#favorites-reports").append(reports);
	   }
	}
	function removeFavoriteReports(n){
		var favoriteReports = JSON.parse(getCookie('favorite-reports'));
		favoriteReports.sort();
		favoriteReports.splice(n, 1);
		
		setCookie('favorite-reports', JSON.stringify(favoriteReports), 999999);
		appendFavoriteReports();
	}
	function dropdownAccounting(n){
		var id = $(n).attr('href');
		var sidebar = $("#sidebar").width();
		var s;
		if(sidebar == 40){
			s = "41px";
		}else if(sidebar == 210){
			s = "211px";
		}else{
			s = "261px";
		}
		
		if($(id).css('display') == 'none')
		{
			$(".sidebar-accounting li ul").hide();
			$("#sidebar ul li > ul").css("left",s);
			$(id).slideDown();
			
			
		}else{
			$(id).slideUp();
			
		}
	}
	function addToFavorites(n){
		var chk = 0;
		var addArray = [$(n).attr("data-name"),$(n).attr("data-link")];
		var getCookieValue = JSON.parse(getCookie('favorite-reports'));
		for(var x = 0; x < getCookieValue.length ; x++){
			if(getCookieValue[x][0] == $(n).attr("data-name")){
				chk = 1
			}
		}
		
		if(chk == 0){
			getCookieValue.push(addArray);
		}

		setCookie('favorite-reports', JSON.stringify(getCookieValue), 999999);
		appendFavoriteReports();
	}
	function setCookie(key, value, expiry) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
    }

    function getCookie(key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }

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
