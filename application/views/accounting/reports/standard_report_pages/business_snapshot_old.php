<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>

.chart{
    height:500px;
    width:500px;
}
.pie-legend {
	list-style: none;
	margin: 0;
	padding: 0;
}
.pie-legend span {
	display: inline-block;
	width: 14px;
	height: 14px;
	border-radius: 100%;
	margin-right: 16px;
	margin-bottom: -2px;
}
.pie-legend li {
	margin-bottom: 10px;
}
.pie-legend
{
    display: none;
}

.flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

 .card {
     background: #fff;
     border-width: 0;
     border-radius: .25rem;
     box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
     margin-bottom: 1.5rem
 }

 .card {
     position: relative;
     display: flex;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid rgba(19, 24, 44, .125);
     border-radius: .25rem
 }

 .card-header {
     padding: .75rem 1.25rem;
     margin-bottom: 0;
     background-color: rgba(19, 24, 44, .03);
     border-bottom: 1px solid rgba(19, 24, 44, .125)
 }

 .card-header:first-child {
     border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
 }

 card-footer,
 .card-header {
     background-color: transparent;
     border-color: rgba(160, 175, 185, .15);
     background-clip: padding-box
 }
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                            <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.5rem !important;font-weight: 600 !important;">Business Snapshot</h3>
                            <a href="<?php echo url('accounting/reports')?>" class="" style="color:#479cd4;">
                                <i class="fa fa-angle-left" style="font-size:24px"></i> Back to report list
                            </a>
                            <br>
                            <a href="#" class="" data-toggle="popover" title="See a snapshot in time" data-content="Choose a time period to see where things stood at the end of it." style="text-decoration:underline;text-decoration-style: dotted;">
                                <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Report period</span>
                            </a>
                    </div>
                    <br>

                    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                    <!------ Include the above in your HEAD tag ---------->



                    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center shadow">
                                <div class="card-header text-left"><b>My Income</b></div>
                                <div class="card-body">
                                    <div class="chart" style="height:200px !important;">
                                        <canvas id="property_types" class="pie"></canvas>
                                        <div id="pie_legend" class="py-3 text-left col-md-7 mx-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center shadow">
                                <div class="card-header text-left"><b>My Expense</b></div>
                                <div class="card-body">
                                    <div class="chart" style="height:200px !important;">
                                        <canvas id="property_types2" class="pie"></canvas>
                                        <div id="pie_legend2" class="py-3 text-left col-md-7 mx-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row"> -->
                    <!-- <div class="page-content page-container" id="page-content">
                        <div class="padding"> -->
                            <div class="row">
                                <!-- <div class="container-fluid d-flex justify-content-center"> -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">Previous Year Income Comparison</div>
                                            <div class="card-body" style="height: 420px">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">Previous Year Expense Comparison</div>
                                            <div class="card-body" style="height: 420px">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> <canvas id="chart-line2" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                        <!-- </div>
                    </div> -->
                    <!-- </div> -->



                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
    </div>
        <!-- end container-fluid -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>

	// global options variable
	var options = {
		responsive: true,
		easing:'easeInExpo',
		scaleBeginAtZero: true,
        // you don't have to define this here, it exists inside the global defaults
		legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	}

		// PIE
		// PROPERTY TYPE DISTRIBUTION
		// context
		var ctxPTD = $("#property_types").get(0).getContext("2d");
		// data
		var dataPTD = [
			{
				// label: "Single Family Residence",
				color: "#5093ce",
				highlight: "#78acd9",
				value: 52
			},
			{
				// label: "Townhouse/Condo",
				color: "#c7ccd1",
				highlight: "#e3e6e8",
				value: 12
			},
			{
				// label: "Land",
				color: "#7fc77f",
				highlight: "#a3d7a3",
				value: 6
			},
			{
				// label: "Multifamily",
				color: "#fab657",
				highlight: "#fbcb88",
				value: 8
			},
			{
				// label: "Farm/Ranch",
				color: "#eaaede",
				highlight: "#f5d6ef",
				value: 8
			},
			{
				// label: "Commercial",
				color: "#dd6864",
				highlight: "#e6918e",
				value: 14
			},
			
		]

		// Property Type Distribution
		var propertyTypes = new Chart(ctxPTD).Pie(dataPTD, options);
			// pie chart legend
			$("#pie_legend").html(propertyTypes.generateLegend());




</script>

<script>

	// global options variable
	var options = {
		responsive: true,
		easing:'easeInExpo',
		scaleBeginAtZero: true,
        // you don't have to define this here, it exists inside the global defaults
		legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	}

		// PIE
		// PROPERTY TYPE DISTRIBUTION
		// context
		var ctxPTD = $("#property_types2").get(0).getContext("2d");
		// data
		var dataPTD = [
			{
				// label: "Single Family Residence",
				color: "#e27d36",
				highlight: "#e27d36",
				value: 52
			},
			{
				// label: "Townhouse/Condo",
				color: "#f3811a",
				highlight: "#e3e6e8",
				value: 12
			},
			{
				// label: "Land",
				color: "#fee18d",
				highlight: "#a3d7a3",
				value: 6
			},
			{
				// label: "Multifamily",
				color: "#f0a3a3",
				highlight: "#fbcb88",
				value: 8
			},
			{
				// label: "Farm/Ranch",
				color: "#fef0c4",
				highlight: "#f5d6ef",
				value: 8
			},
			{
				// label: "Commercial",
				color: "#db1f1f",
				highlight: "#e6918e",
				value: 14
			},
			
		]

		// Property Type Distribution
		var propertyTypes = new Chart(ctxPTD).Pie(dataPTD, options);
			// pie chart legend
			$("#pie_legend2").html(propertyTypes.generateLegend());




</script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script>
    $(document).ready(function() {
        var ctx = $("#chart-line");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
                datasets: [{
                    data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                    label: "",
                    borderColor: "#009dd4",
                    backgroundColor: '#009dd4',
                    fill: false
                }, {
                    data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                    label: "",
                    borderColor: "#60c21f",
                    fill: true,
                    backgroundColor: '#60c21f'
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Income Comparison'
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var ctx = $("#chart-line2");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
                datasets: [{
                    data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                    label: "",
                    borderColor: "#f6a71d",
                    backgroundColor: '#f6a71d',
                    fill: false
                }, {
                    data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                    label: "",
                    borderColor: "#e45919",
                    fill: true,
                    backgroundColor: '#e45919'
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Expense Comparison'
                }
            }
        });
    });
</script>
