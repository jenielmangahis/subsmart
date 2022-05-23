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
  margin-bottom: 30px;
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
</style>
<?php if ( !empty($events) ) { ?>
  <div class="panel-body">
      <ul class="media-list">
  <?php foreach($events as $event) { ?>
    <?php foreach($event as $e){ ?>      
      <li class="media">
          <div class="media-left">
              <div class="custom-panel panel-danger text-center date" style="border:1px solid #ebccd1;box-shadow: 3px 3px #888888;">
                  <div class="panel-heading month" style="border:1px solid #ebccd1;">
                      <span class="panel-title strong" style="font-size: 25px;padding:10px;"><?= date("M",strtotime($e['start_date'])); ?></span>
                  </div>
                  <div class="panel-body day text-danger" style="padding:9px; font-size:21px;"><?= date("d",strtotime($e['start_date'])); ?></div>
              </div>
          </div>
          <div class="media-body">
              <h4 class="media-heading" style="margin-top: 0px;"><?= $e['event_title']; ?></h4>
              <?php if( $e['start_time'] != '00:00:00' ){ ?>
                <span class="event-time"><?= $e['start_time'] . ' - ' . $e['end_time']; ?></span>
              <?php } ?>
              <?php if( $e['event_description'] != '' ){ ?>
                <p><?= $e['event_description']; ?></p>
              <?php } ?>
          </div>
      </li>
    <?php } ?>
  <?php } ?>
    </ul>
  </div>
<?php }else{ ?>
  <div class="cue-event-name">NO UPCOMING EVENTS</div>
<?php } ?>