<style>
/* Using panels to display blog date */
.panel.date {
    margin: 0px;
    width: 60px;
    text-align: center;
}

.panel.date .month {
    padding: 2px 0px;
    font-weight: 700;
    text-transform: uppercase;
}

.panel.date .day {
    padding: 3px 0px;
    font-weight: 700;
    font-size: 1.5em;
}
.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
    color: inherit;
}
.panel.date .day {
    padding: 3px 0px;
    font-weight: 700;
    font-size: 1.5em;
}
.panel-body {
    padding: 15px;
}
.text-danger {
    color: #a94442;
}
.media-list {
    padding-left: 0;
    list-style: none;
}
.media-left, .media-right, .media-body {
    display: table-cell;
    vertical-align: top;
}
.media-left, .media>.pull-left {
    padding-right: 10px;
}
.panel-danger>.panel-heading {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.panel-danger>.panel-heading {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.media{
  margin-bottom: 9px;
  border-bottom: 1px solid #dddddd;
}
.date .month {
    padding: 2px 0px;
    font-weight: 700;
    text-transform: uppercase;
}
.panel-heading {
    padding: 10px 15px;
    /* border-bottom: 1px solid transparent; */
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.custom-panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.media-body{
  margin-left: 20px;
  border-left: 1px solid #ddd;
  padding-left: 10px;
  height: 130px;
}
.event-time{
  font-size: 14px;
  margin-bottom: 11px;
  display: block;
}
.estimate-gray{
  color:#888888 !important;
  font-size: 13px;
}
.estimate-details h4{
  font-size: 17px;
  margin-bottom: 0px;
}
</style>
<?php if ( !empty($upcomingJobs) ) { ?>
  <div class="panel-body" style="padding: 0px;">
    <ul class="media-list">
      <?php foreach($upcomingJobs as $uj){ ?>
        <li class="media">
          <div class="estimate-details">
            <h4><?= $uj->first_name . ' ' . $uj->last_name; ?> <span class="estimate-gray">(<?= $uj->job_number; ?>)</span></h4>
            <span class="estimate-gray"><i class="fa fa-calendar"></i> <?= date("Y-m-d",strtotime($uj->start_date)) . ' - ' . date("Y-m-d",strtotime($uj->end_date)); ?></span>
          </div>
      </li>
      <?php } ?>
    </ul>
  </div>
<?php }else{ ?>
  <div class="cue-event-name">NO UPCOMING JOBS</div>
<?php } ?>