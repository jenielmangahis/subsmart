<div id="employees-view-jobs-panel" class="overflow-auto panel-closed" style="top:0;">
    <div class="employee-name" style="min-width:439px;">
        <p><span class="name">Lou Pinton</span>
        </p>
    </div>
    <div class="close-btn"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
    <div class="panel-content">
        <div class="filter-panel" class="row no-margin">
            <form action="#" id="employee-jobs-filter-form">
                <div class="row no-margin">
                    <div class="col-md-5 no-padding" style="margin-bottom: 12px">
                        <label for="from_date_logs" class="week-label">From:</label>
                        <input type="text" name="date_from" id="employee-jobs-from" class="form-control"
                            value="<?php echo date('m/d/Y', strtotime("monday this week")) ?>">
                    </div>
                    <div class="col-md-5 no-padding" style="margin-bottom: 12px">
                        <label for="to_date_logs" class="week-label">To:</label>
                        <input type="text" name="date_to" id="employee-jobs-to" class="form-control"
                            value="<?php echo date('m/d/Y') ?>">
                    </div>
                    <div class="col-md-2" style="margin-bottom: 12px">
                        <div><label for="to_date_logs" class="week-label">&nbsp;</label>
                        </div>
                        <button type="submit" class="btn btn-success action-btn btn-sm">View</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="loader" style="display: none;">
            <center>
                <img src="<?=base_url('assets/img/trac360/loader1.gif')?>"
                    alt="">
            </center>
        </div>
        <div id="jobs-lists-setion">

        </div>
    </div>
</div>