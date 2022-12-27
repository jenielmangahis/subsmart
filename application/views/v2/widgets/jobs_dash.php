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



    .js-table {
        padding: 0 4%;
        font-size: 12px;
        width: 100%;
        text-align: center;
        position: absolute;
        top: 58px;
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

    .row.js-row-dash {
        background-color: #f6ebff;
        margin-bottom: 3%;
        border-radius: 10px;
        margin: 1% 0%;
        box-shadow: 2px 2px 2px #dfdfdf;
        padding: 0;
    }


    .stat_content {

        padding: 0 2%;
    }

    .col-9.marg-top {
        display: flex;
        margin: 2% 0;
        font-weight: bold;
    }

    .col-3.col-center {
        margin-top: 1%;
        font-size: 15px;
        text-align: center;
    }

    .stat-item {
        font-weight: bold;
        color: white;
        background-color: #e373e3;
        width: 100%;
        font-size: 10px;
        border-radius: 18px;
    }

    .col.col-align {
        text-align: -webkit-center;
    }

    .prof {
        background-size: cover;
        background-image: url("<?php echo base_Url() ?>assets/dashboard/images/prof.jpg");
        width: 30px;
        height: 30px;
        border-radius: 15px;
    }

    .jname {
        margin-top: 3px;
        margin-left: 9px;
    }

    .title-modal h5 {
        font-weight: bold;
        font-size: 23px;
    }

    .table-container {
        font-weight: bold;
        text-align: -webkit-center;
        background-color: white;
        height: 548px;
        width: 1129px;
        position: relative;
        top: 21%;
        left: 20%;
        border-radius: 26px;
        padding-top: 16px;
    }

    .close-modal-table {
        position: absolute;
        top: 492px;
        left: 920px;
    }

    .modal-table {
        position: fixed;
        top: 0;
        z-index: 1059;
        width: 100%;
        height: 100%;

        display: none;
        left: 0;
        right: 0;
        background: #2929297a;
    }

    button.cl {
        background: #ff0f48bf;
        border: none;
        width: 80px;
        height: 35px;
        border-radius: 9px;
        color: white;
        font-weight: bold;
    }

    button.cl-edit {
        background: #00b4359e;
        border: none;
        width: 80px;
        height: 35px;
        border-radius: 9px;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    @media only screen and (max-width: 1521px) {
        .table-container {
            top: 14%;
            left: 13%;
        }
    }
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Jobs Status</span>
        </div>
        <div class="nsm-card-controls">
            <!--<a role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
                See More
            </a>-->
            <a href="<?= base_url('job') ?>" role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
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
            <div class="stat_content">
                <div class="row row-pad">
                    <ul class="nav nav-tabs" id="STATUS_COUNT_TAB" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="MONTH-tab" data-bs-toggle="tab" data-bs-target="#MONTH" type="button" role="tab" aria-controls="MONTH" aria-selected="true">Month</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="YEAR-tab" data-bs-toggle="tab" data-bs-target="#YEAR" type="button" role="tab" aria-controls="YEAR" aria-selected="false">Year</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="STATUS_COUNT_TABCONTENT">
                      <div class="tab-pane fade show active" id="MONTH" role="tabpanel" aria-labelledby="MONTH-tab">
                        <div id="MONTH_COUNT" class="mt-3"></div>
                      </div>
                      <div class="tab-pane fade" id="YEAR" role="tabpanel" aria-labelledby="YEAR-tab">
                        <div id="YEAR_COUNT" class="mt-3"></div>
                      </div>
                    </div>
                    <!-- <div class="col">
                        <div class="row">
                            <div class="col-9">
                                <h6>Status</h6>
                            </div>
                            <div class="col-3" style="text-align: center;">
                                <h6>Count</h6>
                            </div>
                        </div>
                    </div> -->  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-table">
    <div class="table-container" style="display: none;">
        <div class="title-modal">
            <h5>JOB TABLE</h5>
        </div>
        <div>
            <hr>
        </div>
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
                            $count++;
                ?>
                            <div class="row js-row">
                                <div class="col-2"><?php echo $jobs->job_name ?></div>
                                <div class="col">
                                    <?php if ($jobs->draft != " ") {
                                        if ($jobs->status == "draft") { ?> <?php $timestamp = strtotime($jobs->draft);
                                                                            $day = date('D', $timestamp);
                                                                            echo $day ?><br> <?php echo $jobs->draft;
                                                                                            } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div><div>Complete</div> <?php 
                                                                                                                                                                                                        }
                                                                                                                                                                                                    } ?>
                                </div>
                                <div class="col">
                                    <?php if ($jobs->schedule != "") {
                                        if ($jobs->status == "schedule") { ?> <?php $timestamp = strtotime($jobs->schedule);
                                                                                $day = date('D', $timestamp);
                                                                                echo $day ?><br> <?php echo $jobs->schedule;
                                                                                                } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->schedule;
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?>
                                </div>
                                <div class="col">
                                    <?php if ($jobs->arrival != "") {
                                        if ($jobs->status == "arrival") { ?> <?php $timestamp = strtotime($jobs->arrival);
                                                                                $day = date('D', $timestamp);
                                                                                echo $day ?><br> <?php echo $jobs->arrival;
                                                                                                } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->arrival;
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?>
                                </div>
                                <div class="col"><?php if ($jobs->start != "") {
                                                        if ($jobs->status == "start") { ?> <?php $timestamp = strtotime($jobs->start);
                                                                                            $day = date('D', $timestamp);
                                                                                            echo $day ?> <br> <?php echo $jobs->start;
                                                                                                            } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->start;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                    } ?></div>
                                <div class="col">
                                    <?php if ($jobs->approved != "") {
                                        if ($jobs->status == "approved") { ?> <?php $timestamp = strtotime($jobs->approved);
                                                                                $day = date('D', $timestamp);
                                                                                echo $day ?><br> <?php echo $jobs->approved;
                                                                                                } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->approved;
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?>
                                </div>
                                <div class="col">
                                    <?php if ($jobs->finish != "") {
                                        if ($jobs->status == "finish") { ?> <?php $timestamp = strtotime($jobs->finish);
                                                                            $day = date('D', $timestamp);
                                                                            echo $day ?><br> <?php echo $jobs->finish;
                                                                                            } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->finish;
                                                                                                                                                                                                        }
                                                                                                                                                                                                    } ?>
                                </div>
                                <div class="col">
                                    <?php if ($jobs->invoice != "") {
                                        if ($jobs->status == "invoice") { ?> <?php $timestamp = strtotime($jobs->invoice);
                                                                                $day = date('D', $timestamp);
                                                                                echo $day ?><br> <?php echo $jobs->invoice;
                                                                                                } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->invoice;
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?>
                                </div>
                                <div class="col">
                                    <?php if ($jobs->complete != "") {
                                        if ($jobs->status == "complete") { ?><?php $timestamp = strtotime($jobs->complete);
                                                                                $day = date('D', $timestamp);
                                                                                echo $day ?><br> <?php echo $jobs->complete;
                                                                                                } else { ?> <div class="cent"><i class="bx bx-check-circle" style="color: #4f7514; font-size: 15px;"></i></div> <?php echo $jobs->complete;
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?>
                                </div>
                            </div>
                <?php
                        }
                    }
                }

                ?>

            </div>
        </div>
        <div class="close-modal-table">
            <button class="cl-edit">EDIT</button><button class="cl">CLOSE</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#table-modal").on("click", function() {
            $(".modal-table").fadeIn();
            $(".table-container").fadeIn();

        })
        $(".cl").on("click", function() {
            $(".modal-table").fadeOut();
            $(".table-container").fadeOut();
        })

    })
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>