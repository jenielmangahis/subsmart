<style>
.dash-tags{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.dash-tags li{
    width: 20%;
    margin: 5px;
    display: inline-block;
}
.stat-bar{
    height: 14px;
    padding: 6px;
    border-radius: 0px !important;    
    margin: 0px 10px !important;
}
#tags_chart{
    margin-bottom: 47px;
}
</style>
<div class="row">
    <canvas id="tags_chart" class="nsm-chart" data-chart-type="tags"></canvas>
<?php foreach ($tags as $tag){ ?>
    <div class="col-md-6">
        <a class="tagsData" href="javascript:void(0);" onclick="window.open('<?= base_url('job?job_tag='.$tag->id) ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
            <span class="nsm-badge big badge-circle"><b><?= $tag->total_job_tags; ?></b> <span class="nsm-badge small badge-circle stat-bar stats-item" data-tag="<?= ucwords($tag->name); ?>" data-tagcount="<?= $tag->total_job_tags; ?>"></span> <?= ucwords($tag->name); ?></span>
        </a>
    </div>
<?php } ?>
</div>
<script>
$(function(){
    initializeTagsChart();
});
function initializeTagsChart(){    
    var tagsChart = $("#tags_chart");
    new Chart(tagsChart, {
      type: 'pie',
      data: {
        labels: stat_tags,
        datasets: [{
          label: 'Tags',
          data: stat_tag_count,
          backgroundColor: stat_colors,
          borderColor: stat_colors,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
        },
        aspectRatio: 1.5,
      }
    });
}
</script>