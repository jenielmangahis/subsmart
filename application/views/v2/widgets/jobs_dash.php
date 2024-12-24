<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-lg-12">';
endif;
?>
<style>
    :root {
        --jobs-primary: #214548;
        --jobs-secondary: #5F8F93;
        --jobs-tertiary: #387478;
        --jobs-quaternary: #AFC7C9;
        --black: #000;
        --jobs-color1: #162E30;
        --jobs-color2: #629584;
        --jobs-color3: #E2F1E7;
        --jobs-color4: #6a9c8982;
    }


    .row-item {
        position: relative;
        height: 80%;
    }

    .row-item img {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    /* .filter-item {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(24deg, var(--jobs-secondary), var(--jobs-color3));
        position: relative;
        overflow: hidden;
    } */
    .header-banner {
        position: relative;
    }

    .header-banner img {
        position: absolute;
        top: 0;
        width: 100%;

    }

    .filter-item {
        position: relative;
        padding-top: 186px;
        padding-bottom: 0px;
    }


    #STATUS_COUNT_TAB {
        border-bottom: none !important;
    }

    #STATUS_COUNT_TAB .nav-link.active {
        background: var(--jobs-secondary) !important;
        border-radius: 25px !important;
        color: #fff !important;
        padding: 3px !important;
        width: 100px !important;
    }

    #STATUS_COUNT_TAB .nav-link {
        border-radius: 25px;
        color: #000;
        padding: 3px;
        width: 100px;
        border: 1px solid var(--jobs-secondary);
        margin-right: 10px;
    }

    .jobs-separator {
        height: 5px;
        background: var(--jobs-primary);
        border-radius: 25px;
        float: left;
        margin-left: 20px;
        width: 14%;
        margin: 16px 0;
    }

    .jobs-separator2 {
        height: 5px;
        background: var(--jobs-primary);
        border-radius: 25px;
        margin-left: 20px;
        width: 32%;
        margin: 16px 0;
        float: right;
        background: linear-gradient(305deg, var(--jobs-primary), var(--jobs-color3));
    }

    .jobs-separator3 {
        height: 5px;
        background: var(--jobs-primary);
        border-radius: 25px;
        float: right;
        margin-left: 20px;
        width: 14%;
        margin: 16px 0;
    }

    .jobs-separator4 {
        height: 5px;
        background: var(--jobs-primary);
        border-radius: 25px;
        margin-left: 20px;
        width: 32%;
        margin: 16px 0;
        float: left;
        background: linear-gradient(305deg, var(--jobs-primary), var(--jobs-color3));
    }


    .jobs-status-items .item {
        display: flex;
        padding: 10px;
        /* background: linear-gradient(6deg, var(--jobs-secondary), var(--jobs-color3)); */
        color: var(--jobs-color1);
        border-radius: 10px;
        gap: 10px;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
    }

    .jobs-status-items .item .box {
        width: 50px;
        height: 16px;
        background: var(--jobs-color4);
        offset-position: 124px -3px;
        offset-path: ray(45deg);
        position: absolute;
        opacity: .2;
        border-radius: 25px;
    }

    .jobs-status-items .item .box3 {
        width: 100px;
        height: 15px;
        background: var(--jobs-color4);
        offset-position: 141px 7px;
        offset-path: ray(45deg);
        position: absolute;
        opacity: .2;
        border-radius: 25px;
    }

    .jobs-status-items .item .box2 {
        width: 69px;
        height: 60px;
        background: #6A9C89;
        offset-position: -28px -5px;
        offset-path: ray(-19deg);
        position: absolute;
        opacity: 0.2;
        border-radius: 0%;
    }


    .jobs-status-items .item .icons {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 75px;
        border-radius: 100%;
    }


    .jobs-status-items .item .count {
        width: 100%;
        text-align: left;
        color: var(--jobs-primary);
    }

    .jobs-status-items .item .count label {
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
    }

    .jobs-status-items .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
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
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span style="color:var(--jobs-primary)">Jobs Status</span>
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
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content jobs_stat">
        <div class="d-flex flex-column">
            <div class="header-banner">
                <img src="./assets/img/jobs-status-wave-top.svg" alt="" />
                <img src="./assets/img/jobs-status-wave-top-2.svg" alt="" />
            </div>
            <div class="filter-item">

                <ul class="nav nav-tabs" id="STATUS_COUNT_TAB" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="MONTH-tab" data-bs-toggle="tab" data-bs-target="#MONTH"
                            type="button" role="tab" aria-controls="MONTH" aria-selected="true">Month</button>
                    </li>
                    <li class="nav-item " role="presentation">
                        <button class="nav-link" id="YEAR-tab" data-bs-toggle="tab" data-bs-target="#YEAR"
                            type="button" role="tab" aria-controls="YEAR" aria-selected="false">Year</button>
                    </li>
                </ul>
                <div class="col-md-12">
                    <div class="jobs-separator"></div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="STATUS_COUNT_TABCONTENT">
            <div class="tab-pane fade show active" id="MONTH" role="tabpanel" aria-labelledby="MONTH-tab">
                <div class="row row-item">


                    <div class="col-md-12 jobs-status-items mt-3">
                        <div class="row " id="MONTH_COUNT">
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                                <div class="jobs-separator2"></div>
                            </div> -->
                </div>

            </div>
            <div class="tab-pane fade" id="YEAR" role="tabpanel" aria-labelledby="YEAR-tab">

                <div class="row row-item">
                    <!-- <div class="col-md-12">
                                <div class="jobs-separator3"></div>
                            </div> -->
                    <div class="col-md-12 jobs-status-items mt-3">
                        <div class="row" id="YEAR_COUNT"></div>
                    </div>
                    <!-- <div class="col-md-12">
                                <div class="jobs-separator4"></div>
                            </div> -->
                </div>
            </div>
        </div>
        <div class="footer-banner">
            <!-- <img src="./assets/img/jobs-status-wave.svg" alt=""> -->
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
                    <div class="col">Finished</div>
                    <div class="col">Invoice</div>
                    <div class="col">Complete</div>
                </div>
            </div>
            <div class="js-body">



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
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
