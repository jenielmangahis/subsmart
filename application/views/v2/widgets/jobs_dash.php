<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-lg-12">';
endif;
?>
<style>
    .js-body .row.js-row {
        background: #f6ebff;
    }

    .row.js-row {
        margin-top: 20px;
        box-shadow: 9px 3px 14px 0px #d2c2c26e;
        padding: 14px;
        border-radius: 16px;
    }

    .table-container {
        font-weight: bold;
        text-align: -webkit-center;
    }

    .js-table {
        padding: 0 4%;
        font-size: 12px;
        width: 100%;
        text-align: center;
    }

    .row.js-row.js-row-margin {
        margin-top: 13px;

    }

    .js-margin-bot {
        margin-bottom: 26px;
    }

    .cent {
        margin: 0 10%;
    }

    .col-2 {
        text-align: left !important;
    }
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Jobs Status</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>job">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content jobs_stat">
        <div class="nsm-widget-table">

            <div class="table-container">
                <div class="js-table">
                    <div class="js-header">
                        <div class="row js-row">
                            <div class="col-2">Job Name</div>
                            <div class="col">Draft</div>
                            <div class="col">Schedule</div>
                            <div class="col">Arrival</div>
                            <div class="col">Start</div>
                            <div class="col">Approved</div>
                            <div class="col">Finish</div>
                            <div class="col">Invoice</div>
                            <div class="col">Complete</div>
                        </div>
                    </div>
                    <div class="js-body">

                        <?php

                        if ($jobsStatus) {
                            $limit = 4;
                            $count = 0;

                            foreach ($jobsStatus as $jobs) {
                                if ($count < $limit) {
                        ?>
                                    <div class="row js-row">
                                        <div class="col-2"><?php echo $jobs->job_name ?></div>
                                        <div class="col">
                                            <?php if($jobs->draft != " "){if($jobs->status == "draft"){ ?> Mon<br> <?php echo $jobs->draft; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->draft; }} ?>
                                        </div>
                                        <div class="col">
                                        <?php if($jobs->schedule != ""){if($jobs->status == "schedule"){ ?> Mon<br> <?php echo $jobs->schedule; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->schedule; }} ?>
                                        </div>
                                        <div class="col">
                                        <?php if($jobs->arrival != ""){if($jobs->status == "arrival"){ ?> Mon<br> <?php echo $jobs->arrival; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->arrival; }} ?>
                                        </div>
                                        <div class="col"><?php if($jobs->start != ""){if($jobs->status == "start"){ ?> Mon <br> <?php echo $jobs->start; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->start; }} ?></div>
                                        <div class="col">
                                        <?php if($jobs->approved != ""){if($jobs->status == "approved"){ ?> Mon<br> <?php echo $jobs->approved; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->approved; }} ?>
                                        </div>
                                        <div class="col">
                                        <?php if($jobs->finish != ""){if($jobs->status == "finish"){ ?> Mon<br> <?php echo $jobs->finish; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->finish; }} ?>
                                        </div>
                                        <div class="col">
                                        <?php if($jobs->invoice != ""){if($jobs->status == "invoice"){ ?> Mon<br> <?php echo $jobs->invoice; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->invoice; }} ?>
                                        </div>
                                        <div class="col">
                                        <?php if($jobs->complete != ""){if($jobs->status == "complete"){ ?> Mon<br>  <?php echo $jobs->complete; }else{?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->complete; }} ?>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }

                        ?>


                        <!-- <div class="row js-row">
                            <div class="col-2">Programmer</div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-11-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-13-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-17-22
                            </div>
                            <div class="col">Mon<br> 02-22-22</div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div> -->
                        <!-- <div class="row js-row js-row-margin">
                            <div class="col-2">System Analyst</div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-11-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-13-22
                            </div>
                            <div class="col">Tues<br> 02-17-22</div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                        <div class="row js-row js-row-margin">
                            <div class="col-2">Manager</div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-11-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-13-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-17-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-18-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-18-22
                            </div>
                            <div class="col">Thu<br> 02-28-22</div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                        <div class="row js-row js-row-margin js-margin-bot">
                            <div class="col-2">Boss Amo Manager</div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-11-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div></i> 02-13-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-17-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-19-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-19-22
                            </div>
                            <div class="col">
                                <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> 02-21-22
                            </div>
                            <div class="col">Fri<br> 02-29-22</div>
                            <div class="col"></div>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log($(".jobs_stat").parent().attr('class'));
        $('body').delegate('draggable', '.jobs_stat', function() {

        })
    })
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>