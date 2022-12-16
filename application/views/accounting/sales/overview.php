<?php include viewPath('v2/includes/accounting_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The Sales Overview is available for you to see and track transactions pertaining to sales. This new
                            screen allows you to see at a glance income over a period of time, mobile payment options, pending
                            invoices and upcoming deposits. Each of the areas can be clicked to view details. From invoices to
                            inventory it can be done here.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-7">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    INCOME OVER TIME <i class="bx bx-info-circle" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="filter-section">
                                    <div class="duration">
                                        <label for="">Duration:</label>
                                        <select name="duration" class="duration">
                                            <option value="">This month</option>
                                            <option value="">Last month</option>
                                            <option value="">This quarter</option>
                                            <option value="">Last quarter</option>
                                            <option value="">This year by month</option>
                                            <option value="">This year by quarter</option>
                                            <option value="">Last year by month</option>
                                            <option value="">Last year by quarter</option>
                                        </select>
                                    </div>
                                    <div class="compare-prev-year">
                                        <label class="main-label">Compare previous year:</label>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" on class="custom-control-input"
                                                    id="compare-prev-year">
                                                <label class="custom-control-label"
                                                    for="compare-prev-year"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-monitary-highlight">
                                        $<span class="amount"><?=number_format($income_this_month, 2)?></span>
                                        <span class="label">This month</span>
                                    </div>
                                    <div class="monitary-increase">
                                        $<?=number_format($income_this_month-$income_last_month, 2)?>
                                        more than <?=date("M d", strtotime("first day of previous month"))?>
                                        - <?=date("d, Y", strtotime("last day of previous month"))?>
                                    </div>
                                    <div id="chartContainer11" class="dynamic-graph-container"
                                        style="display:none;width: 100%; height:200px;">

                                    </div>
                                    <canvas id="overview_chart" style="height: 200px; width: 100%;"></canvas>
                                    <div class="no-graph">
                                        <div class="text">No data found.</div>
                                    </div>
                            </div>
                        </div>
                        <!-- <div class="nsm-card primary" style="margin-top:10px;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">  </div>
                            </div>
                            <div class="nsm-card-content">
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-5">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title"> SETUP </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="headway">
									<div class="label">
										50% Done
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: 50%"
											aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon success">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Set up ways for customers to pay you
											</div>
										</div>
									</div>
								</div>

								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon ">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Learn how to use payments
											</div>
										</div>
										<div class="col-md-2">
											<div class="checklist-link">
												<a href="#">Start</a>
											</div>
										</div>
									</div>
								</div>

								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon ">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Order a card reader
											</div>
										</div>
										<div class="col-md-2">
											<div class="checklist-link">
												<a href="#">Start</a>
											</div>
										</div>
									</div>
								</div>

								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon success">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Send an invoice that your customer can pay online
											</div>
										</div>
										<div class="col-md-2">
											<div class="checklist-link">
												<a href="#">Edit</a>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div>

                        <!-- <div class="nsm-card primary" style="margin-top:10px;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title"> DISCOVER MORE </div>
                            </div>
                            <div class="nsm-card-content">
                            </div>
                        </div>  -->                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
	var chart;
	var graph_data = {};
	var graph_data_prev = {};
	var income_per_day;
	var income_per_month;
	var income_per_quarter;
	var last_income_per_day;
	var last_income_per_month;
	var last_income_per_quarter;
	var income_label = "";
	var last_income_label = "";
	var income_month_label = "";
	var income_year_label = "";

	window.onload = function() {
		income_overtime_duration_changed();
	}
</script>
