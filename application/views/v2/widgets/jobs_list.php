<?php
function widgetFormatJobNumber($number)
{
    $formatFunc = function ($prefix, $number) {
        $numericPart = (int) str_replace($prefix, '', $number);
        return 'JOB-' . str_pad($numericPart, 7, '0', STR_PAD_LEFT);
    };

    if (strpos(strtoupper($number), 'JOB-') === 0) {
        return $formatFunc('JOB-', $number);
    }

    if (strpos(strtoupper($number), 'JOB') === 0) {
        return $formatFunc('JOB', $number);
    }

    return $number;
}

if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-lg-12">';
endif;
?>
<style>
    :root {
        --jobs-activities-primary: #281c2d;
        --jobs-activities-secondary: #BEAFC2;
        --jobs-activities-tertiary: #d9a1a0;
        --jobs-activities-quaternary: #F5EFFF;
        --black: #000;
        --jobs-activities-color1: #BEAFC2;
        --jobs-activities-color2: #FEA303;
        --jobs-activities-color3: #281c2d;
        --jobs-activities-color4: #214548;
    }

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
        background-image: url("<?php echo base_Url(); ?>assets/dashboard/images/prof.jpg");
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

    .jobs-activities .table-reponsinve {
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        /* transform: translateY(-60px); */
        overflow: auto;
        height: 73%;
    }

    .jobs-activities-separator {
        width: 12%;
        height: 7px;
        background: var(--jobs-activities-color4);
        border-radius: 25px;
        transform: translateY(-47px);
        float: left;
        margin-left: 20px;
    }

    #dashboard-job-activities thead tr {
        font-size: 14px;
        font-weight: bold;
        color: var(--jobs-activities-color3);
    }

    #dashboard-job-activities tbody .job-number {
        color: var(--jobs-activities-primary);
    }

    #dashboard-job-activities tbody .last-update label {
        font-size: 14px;
        font-weight: 600;
    }

    #dashboard-job-activities tbody .amount label {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #000;
        font-size: 12px;
    }

    #dashboard-job-activities tbody .view button {
        font-size: 14px;
        padding: 5px;
        height: 30px;
    }

    #dashboard-job-activities tbody .view button i {
        color: var(--jobs-activities-primary);
    }

    #dashboard-job-activities .nsm-table-pagination .pagination {
        gap: 10px;
    }

    #dashboard-job-activities .nsm-table-pagination .pagination li a.prev,
    #dashboard-job-activities .nsm-table-pagination .pagination li a.next {
        border: none;
    }

    #dashboard-job-activities .nsm-table-pagination .pagination li a {
        border-radius: 50%;
    }

    #dashboard-job-activities .nsm-table-pagination .pagination li a.active {
        background: var(--jobs-activities-tertiary);
        border: 1px solid var(--jobs-activities-color1);
    }

    #dashboard-job-activities .nsm-row-collapse .content-subtitle label {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
    }

    #dashboard-job-activities .widget-item {
        align-items: center;
        gap: 10px;
    }



    @media screen and (max-width: 1366px) {

        #dashboard-job-activities thead tr {
            font-size: 12px;

        }

        #dashboard-job-activities tbody .amount label {
            padding: 1px 0px;
            width: 50px;
        }
    }

    @media screen and (max-width: 991px) {

        #dashboard-job-activities tbody .amount label {
            padding: 1px 20px;
            width: unset;
        }
    }

    @media screen and (max-width: 567px) {

        .jobs-activities .table-reponsinve {
            margin: unset;
            transform: unset;
        }
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
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content jobs-activities">
        <div class="banner">
            <img src="./assets/img/jobs-activities-banner.svg" alt="">
        </div>
        <div class="table-reponsinve nsm-widget-table">
            <table id="dashboard-job-activities" class="nsm-table mb-3">
                <thead>
                    <tr>
                        <td data-name="JobNumber">Job Number</td>
                        <td data-name="Updated" style="text-align:center">Last Updated</td>
                        <td data-name="Amount" style="text-align:center"><?php echo $company_id == 58 ? 'Proposed' : 'Amount'; ?></td>
                        <td data-name="ViewInfo" style="width: 0%;">View&nbsp;Info</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                                    $colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8'];
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
                                    $colorSelected= "";
                                    foreach($latestJobs as $latestJobs_data){
                                        $colorSelected = $colors[array_rand($colors)];

                                        ($latestJobs_data->TECH_1 != "") ? $TECH_BADGE .= "<li>$latestJobs_data->TECH_1</li>" : null;
                                        ($latestJobs_data->TECH_2 != "") ? $TECH_BADGE .= "<li>$latestJobs_data->TECH_2</li>" : null;
                                        ($latestJobs_data->TECH_3 != "") ? $TECH_BADGE .= "<li>$latestJobs_data->TECH_3</li>" : null;
                                        ($latestJobs_data->TECH_4 != "") ? $TECH_BADGE .= "<li>$latestJobs_data->TECH_4</li>" : null;
                                        ($latestJobs_data->TECH_5 != "") ? $TECH_BADGE .= "<li>$latestJobs_data->TECH_5</li>" : null;
                                        ($latestJobs_data->TECH_6 != "") ? $TECH_BADGE .= "<li>$latestJobs_data->TECH_6</li>" : null;

                                        if ($latestJobs_data->city == "") {
                                            $ADDRESS = "Not Specified";
                                        } else {
                                            $ADDRESS = $latestJobs_data->city . ', ' . $latestJobs_data->state . ' ' . $latestJobs_data->zip_code;
                                        }

                                        $TECH_BADGE = '<ul>'.$TECH_BADGE.'</ul>';

                                        $UPDATED = date_format(date_create($job->date_updated), 'M').", ".date_format(date_create($job->date_updated), 'd');
                                        $JOB_PREVIEW = base_url('job/job_preview/').$latestJobs_data->id;
                                        $amount_format = number_format($latestJobs_data->amount,2);
                                        $VIEW_INFO = "<strong><i class='bx bx-user-pin' ></i> Customer Name:</strong> $latestJobs_data->first_name, $latestJobs_data->last_name<br><strong><i class='bx bx-map-pin' ></i> Address:</strong> $ADDRESS<br><strong><i class='bx bxs-user-check' ></i> Tech Rep</strong>:$TECH_BADGE<hr /><strong>Amount:</strong> $$amount_format";
                                ?>
                    <tr>
                        <td class="JOB_PREVIEW ">
                            <div class="widget-item position-relative">
                                <div class="table-row-icon" style="background: <?= $colorSelected ?>;">
                                    <i class='bx bx-briefcase-alt-2' style="color: #fff !important"></i>
                                </div>
                                <div class="job-number">
                                    <b onclick="location.replace('<?php echo $JOB_PREVIEW; ?>')"><?php echo $latestJobs_data->job_number; ?></b>
                                </div>
                            </div>
                        </td>
                        <td class="last-update" style="text-align:center;">
                            <label>
                                <?php echo date('M d, Y', strtotime($latestJobs_data->date_updated)); ?></label>

                        </td>
                        <td style="text-align:center;" class="amount">
                            <label>
                                <?php echo $latestJobs_data->amount ? "$" . number_format($latestJobs_data->amount, 2) : '$0.00'; ?>
                            </label>
                        </td>
                        <td style="width: 0%;text-align:right;" class="view"><button class="nsm-button small"
                                data-bs-trigger="hover focus" data-bs-toggle="popover" title="<?php echo $latestJobs_data->job_number; ?>"
                                data-bs-content="<?php echo $VIEW_INFO; ?>" data-bs-html="true"><i
                                    class='bx bx-search-alt'></i></button></td>
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


<script>
    $(function() {
        $("#dashboard-job-activities").nsmPagination({
            itemsPerPage: 6
        });
        $('[data-bs-toggle="popover"]').popover();
    });
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
