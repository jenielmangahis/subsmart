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
    .TECH_ICON {
        width: 30px !important;
        height: 30px !important;
        font-size: 12px !important;
        font-weight: bold !important;
        border: 1px solid black !important;
    }
    .STACK_ICON {
        margin-top: -30px; 
        margin-left: 23px;
    }
    #JOB_ACTIVITY_TABLE_length,
    #JOB_ACTIVITY_TABLE_filter,
    #JOB_ACTIVITY_TABLE_info {
        display: none;
    }
    /*.nsm-table {
        display: none;
    }*/
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }
    table.dataTable.no-footer {
         border-bottom: 1px solid #ebebeb !important; 
    }
    .JOB_PREVIEW:hover {
        cursor: pointer;
        font-weight: bold;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Jobs Activities</span>
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
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-reponsinve">
                        <table id="JOB_ACTIVITY_TABLE" class="table table-hover mb-3">
                            <thead>
                                <tr>
                                    <th>Updated</th>
                                    <th>Job&nbsp;No.</th>
                                    <th><?php echo $company_id == 58 ? 'Proposed' : 'Amount' ?></th>
                                    <th style="width: 0%;">View&nbsp;Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    function getInitials($string = null) {
                                        return array_reduce(
                                            explode(' ', $string),
                                            function ($initials, $word) {
                                                return strtoupper(sprintf('%s%s', $initials, substr($word, 0, 1)));
                                            },
                                            ''
                                        );
                                    }
                                    $VIEW_INFO = "";
                                    $TECH_BADGE = "";
                                    $ADDRESS = "";
                                    $UPDATED = "";
                                    $JOB_PREVIEW = "";
                                    foreach($latestJobs as $latestJobs_data){
                                        ($latestJobs_data->TECH_1 != "") ? $TECH_BADGE .= "<br>- $latestJobs_data->TECH_1" : null;
                                        ($latestJobs_data->TECH_2 != "") ? $TECH_BADGE .= "<br>- $latestJobs_data->TECH_1" : null;
                                        ($latestJobs_data->TECH_3 != "") ? $TECH_BADGE .= "<br>- $latestJobs_data->TECH_1" : null;
                                        ($latestJobs_data->TECH_4 != "") ? $TECH_BADGE .= "<br>- $latestJobs_data->TECH_1" : null;
                                        ($latestJobs_data->TECH_5 != "") ? $TECH_BADGE .= "<br>- $latestJobs_data->TECH_1" : null;
                                        ($latestJobs_data->TECH_6 != "") ? $TECH_BADGE .= "<br>- $latestJobs_data->TECH_1" : null;

                                        if ($latestJobs_data->city == "") {
                                            $ADDRESS = "Not Available";
                                        } else {
                                            $ADDRESS = "$latestJobs_data->city, $latestJobs_data->state";
                                        }

                                        $UPDATED = date_format(date_create($job->date_updated), 'M').", ".date_format(date_create($job->date_updated), 'd');
                                        $JOB_PREVIEW = base_url('job/job_preview/').$latestJobs_data->id;

                                        $VIEW_INFO = "<strong>Name:</strong> $latestJobs_data->first_name, $latestJobs_data->last_name<br><strong>Address:</strong> $ADDRESS<br><strong>Tech Rep</strong>:$TECH_BADGE<br><strong>Amount:</strong> $$latestJobs_data->amount<br><strong>Updated:</strong> $UPDATED";
                                ?>  
                                <tr>
                                    <td><?php echo date_format(date_create($job->date_updated), 'M').", ".date_format(date_create($job->date_updated), 'd'); ?></td>
                                    <td class="JOB_PREVIEW" onclick="location.replace('<?php echo $JOB_PREVIEW; ?>')"><?php echo "$latestJobs_data->job_number"; ?></td>
                                    <!-- <td><small><?php echo "$latestJobs_data->first_name, $latestJobs_data->last_name"; ?></small></td> -->
                                    <td><?php echo "$$latestJobs_data->amount"; ?></td>
                                    <td style="width: 0%;"><button class="nsm-button small" data-bs-trigger="hover focus" data-bs-toggle="popover" title="<?php echo "$latestJobs_data->job_number"; ?>" data-bs-content="<?php echo $VIEW_INFO; ?>" data-bs-html="true"><i class='bx bx-search-alt'></i></button></td>
                                </tr>
                                <?php 
                                    $TECH_BADGE = "";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>  
            </div>
        </div>
    </div>   
</div>


<script>
$(function(){
    var JOB_ACTIVITY_TABLE = $("#JOB_ACTIVITY_TABLE").DataTable({
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
});
 $('[data-bs-toggle="popover"]').popover();  
    // $("#jobs_list").nsmPagination({itemsPerPage:5});
});
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>