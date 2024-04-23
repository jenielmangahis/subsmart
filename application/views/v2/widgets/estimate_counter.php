<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="thumbnail_<?php echo $id; ?>" draggable="true">

<div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-estimate">
                        <i class="bx bx-bar-chart-square"></i>
                    </div>
                    <span style="color:#6a4a86  ">Estimate</span>
                </div>
            </div>
        </div>
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item" href="#" onclick="removeThumbnail('<?php echo $id; ?>');">Remove
                            Thumbnail</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px);">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                   <div id="estimate-title" class="h-100 ">
                   <label for="">Estimate</label>
                <h1 id="estimate-count"><span class="bx bx-loader bx-spin"></span></h1>
                   </div>
                   <div id="canvas_container" style="width: 250px; display:none" >
                  
                   <canvas id="GuageEstimate" data-open="<?php echo count($estimates); ?>" data-total="<?php echo count($estimate_draft); ?>"></canvas>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class=" btn-sm m-0 me-2" href="estimate">
            <i class='bx bx-right-arrow-alt' style="color: #6a4a86"></i>
        </a>
    </div>
</div>
<script>
var openCount = $('#GuageEstimate').data('open');
var totalCount = $('#GuageEstimate').data('total');
var ctx = document.getElementById('GuageEstimate').getContext('2d');
var gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(106,74,134, 1)'); // Start color
gradient.addColorStop(1, 'rgba(142,43,227, 1)'); // End color
     const gauge_estimate_data = {
      labels: ['Score','Gray Area'],
      datasets: [{
        label: 'Weekly Sales',
        data: [openCount, totalCount],
        backgroundColor: [
            gradient,
            'rgb(240,240,240)'
        ],
        borderColor: [
            gradient,
             'rgb(240,240,240)'
        ],
        borderWidth: 1,
        cutout:'80%',
        circumference:300,
        rotation:210
      }]
    };

const gaugeChartText = {
    id: 'gaugeChartText',
    afterDatasetDraw(chart,args,pluginOptions){
        const {ctx,data, chartArea: { top,bottom,left,right,width,height
        },scales: {r} } = chart;

        ctx.save();
       console.log(r);
       const xCoor = chart.getDatasetMeta(0).data[0].x;
       const yCoor = chart.getDatasetMeta(0).data[0].y;

       ctx.font =  '30px FontAwesome';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#6a4a86'; // Color of the icon
        ctx.fillText('\uf681',xCoor,yCoor-30); 

       ctx.font= '16px sans-serif';
       ctx.fillStyle = "rgb(40, 40, 43)";
       ctx.textBaseLine ='top';
       ctx.textAlign = 'left';
       ctx.fillText('Total',left+80,yCoor+5);
       ctx.textAlign = 'right';
       ctx.fillText('Open',right-80,yCoor+5);
       ctx.font= '16px sans-serif';
       ctx.textAlign = 'left';
       ctx.fillText(totalCount,left+90,yCoor+25);
       ctx.textAlign = 'right';
       ctx.fillText(openCount,right-90,yCoor+25);
       ctx.font = '16px sans-serif'
       ctx.textAlign = 'center';
       ctx.textBaseLine = 'bottom';


    }
}


    // config 
    const gauge_estimate_config = {
      type: 'doughnut',
      data : gauge_estimate_data,
      options: {
        aspectRatio:1.5,
        plugins:{
            legend:{
                display:false
            },
            tooltip:{
                enabled:false
            }
        }
      },
      plugins:[gaugeChartText],
    };
$( document ).ready(function() {
    $('#canvas_container').show();
    $('#estimate-title').hide();
    
    const gauge_estimate_Chart = new Chart(
      document.getElementById('GuageEstimate'),
      gauge_estimate_config
    );
});
    // render init block
 


    </script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>