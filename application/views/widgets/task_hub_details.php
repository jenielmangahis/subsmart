<style>
.tasks {
    padding: 0;
    border-right: 1px solid #d1d4d7;
    margin: -30px 15px -30px -15px
}
.task-list {
    padding: 30px 15px;
    height: 100%
}

.graph {
    height: 100%
}

.priority.high {
    background: #fffdfd;
    margin-bottom: 1px
}

.priority.high span {
    background: #f86c6b;
    padding: 2px 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px
}

.priority.medium {
    background: #fff0ab;
    margin-bottom: 1px
}

.priority.medium span {
    background: #f8cb00;
    padding: 2px 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px
}

.priority.low {
    background: #cfedda;
    margin-bottom: 1px
}

.priority.low span {
    background: #4dbd74;
    padding: 2px 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px
}

.task {
    border-bottom: 1px solid #e4e5e6;
    margin-bottom: 5px;
    position: relative;
    cursor: pointer;
}

.task .desc {
    display: inline-block;
    width: 70%;
    padding: 10px 10px;
    font-size: 12px
}

.task .desc .title {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px
}

.task .time {
    display: inline-block;
    width: 20%;
    padding: 10px 10px 10px 0;
    font-size: 12px;
    text-align: right;
    position: absolute;
    top: 0;
    right: 0
}

.task .time .date {
    font-size: 12px;
    margin-bottom: 5px
}

.task.last {
    border-bottom: 1px solid transparent
}

.task.high {
    border-left: 2px solid #f86c6b
}

.task.medium {
    border-left: 2px solid #f8cb00
}

.task.low {
    border-left: 2px solid #4dbd74
}

.timeline {
    width: auto;
    height: 100%;
    margin: 20px auto;
    position: relative
}

.timeline:before {
    position: absolute;
    content: '';
    height: 100%;
    width: 4px;
    background: #d1d4d7;
    left: 50%;
    margin-left: -2px
}

.timeslot {
    display: inline-block;
    position: relative;
    width: 100%;
    margin: 5px 0
}

.timeslot .task {
    position: relative;
    width: 44%;
    display: block;
    border: none;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.timeslot .task span {
    border: 2px solid #63c2de;
    background: #e1f3f9;
    padding: 5px;
    display: block;
    font-size: 11px
}

.timeslot .task span span.details {
    font-size: 16px;
    margin-bottom: 10px
}

.timeslot .task span span.remaining {
    font-size: 14px
}

.timeslot .task span span {
    border: 0;
    background: 0 0;
    padding: 0
}

.timeslot .task .arrow {
    position: absolute;
    top: 6px;
    right: 0;
    height: 20px;
    width: 20px;
    border-left: 12px solid #63c2de;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent;
    margin-right: -18px
}

.timeslot .task .arrow:after {
    position: absolute;
    content: '';
    top: -12px;
    right: 3px;
    height: 20px;
    width: 20px;
    border-left: 12px solid #e1f3f9;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent
}

.timeslot .icon {
    position: absolute;
    border: 2px solid #d1d4d7;
    background: #2a2c36;
    -webkit-border-radius: 50em;
    -moz-border-radius: 50em;
    border-radius: 50em;
    height: 30px;
    width: 30px;
    top: 0;
    left: 50%;
    margin-left: -17px;
    color: #fff;
    font-size: 14px;
    line-height: 30px;
    text-align: center;
    text-shadow: none;
    z-index: 2;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.timeslot .time {
    background: #d1d4d7;
    position: absolute;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    top: 1px;
    left: 50%;
    padding: 5px 10px 5px 40px;
    z-index: 1;
    margin-top: 1px
}

.timeslot.alt .task {
    margin-left: 56%;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.timeslot.alt .task .arrow {
    position: absolute;
    top: 6px;
    left: 0;
    height: 20px;
    width: 20px;
    border-left: none;
    border-right: 12px solid #63c2de;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent;
    margin-left: -18px
}

.timeslot.alt .task .arrow:after {
    top: -12px;
    left: 3px;
    height: 20px;
    width: 20px;
    border-left: none;
    border-right: 12px solid #e1f3f9;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent
}

.timeslot.alt .time {
    top: 1px;
    left: auto;
    right: 50%;
    padding: 5px 40px 5px 10px
}

@media only screen and (min-width:992px) and (max-width:1199px) {
    task .desc {
        display: inline-block;
        width: 70%;
        padding: 10px 10px;
        font-size: 12px
    }
    task .desc .title {
        font-size: 16px;
        margin-bottom: 5px
    }
    task .time {
        display: inline-block;
        float: right;
        width: 20%;
        padding: 10px 10px;
        font-size: 12px;
        text-align: right
    }
    task .time .date {
        font-size: 16px;
        margin-bottom: 5px
    }
}

@media only screen and (min-width:768px) and (max-width:991px) {
    .task {
        margin-bottom: 1px
    }
    .task .desc {
        display: inline-block;
        width: 65%;
        padding: 10px 10px;
        font-size: 10px;
        margin-right: -20px
    }
    .task .desc .title {
        font-size: 14px;
        margin-bottom: 5px
    }
    .task .time {
        display: inline-block;
        float: right;
        width: 25%;
        padding: 10px 10px;
        font-size: 10px;
        text-align: right
    }
    .task .time .date {
        font-size: 14px;
        margin-bottom: 5px
    }
    .timeslot .task span {
        padding: 5px;
        display: block;
        font-size: 10px
    }
    .timeslot .task span span {
        border: 0;
        background: 0 0;
        padding: 0
    }
    .timeslot .task span span.details {
        font-size: 14px;
        margin-bottom: 0
    }
    .timeslot .task span span.remaining {
        font-size: 12px
    }
}

@media only screen and (max-width:767px) {
    .tasks {
        position: relative;
        margin: 0!important
    }
    .graph {
        position: relative;
        margin: 0!important
    }
    .task {
        margin-bottom: 1px
    }
    .task .desc {
        display: inline-block;
        width: 65%;
        padding: 10px 10px;
        font-size: 10px;
        margin-right: -20px
    }
    .task .desc .title {
        font-size: 14px;
        margin-bottom: 5px
    }
    .task .time {
        display: inline-block;
        float: right;
        width: 25%;
        padding: 10px 10px;
        font-size: 10px;
        text-align: right
    }
    .task .time .date {
        font-size: 14px;
        margin-bottom: 5px
    }
    .timeslot .task span {
        padding: 5px;
        display: block;
        font-size: 10px
    }
    .timeslot .task span span {
        border: 0;
        background: 0 0;
        padding: 0
    }
    .timeslot .task span span.details {
        font-size: 14px;
        margin-bottom: 0
    }
    .timeslot .task span span.remaining {
        font-size: 12px
    }
}
</style>
<div class="col-lg-12 mt-2 task-list">
    <?php
    //print_r($tasks);
        foreach($tasks as $task):
            
            switch($task->priority):
                case 'High':
                    $class = "high";
                break;
                case 'Medium':
                    $class = "medium";
                break;
                case 'Low':
                    $class = "low";
                break;    
                    
            endswitch;
    ?>
    
    <div class="priority <?= $class ?>"><span><?= strtoupper($task->priority.' priority') ?></span></div>
    <div onclick="document.location='<?= base_url("taskhub/view/".$task->task_id) ?>'" class="task <?= $class ?>">
        <div class="desc">
            <div class="title"><?= strtoupper($task->subject) ?></div>
            <div><?= ucfirst(strtolower($task->description)) ?></div>
        </div>
        <div class="time">
            <div class="date"><?= date('M d, Y', strtotime($task->estimated_date_complete)) ?></div>
        </div>
    </div>
    <?php 
        endforeach;
    ?>
</div>