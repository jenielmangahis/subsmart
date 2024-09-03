<style>
#moneyInLegend {
    background: #53b700;
    padding-left: 18px;
    border-radius: 100px;
    border: 1px solid gray;
    margin-right: 6px;
}

#moneyOutLegend {
    background: #05a4b5;
    padding-left: 18px;
    border-radius: 100px;
    border: 1px solid gray;
    margin-right: 6px;
}

#cashBalanceLegend {
    border-bottom: 2px solid #53b700;
    padding-right: 20px;
    margin-right: 6px;
}

#projectedLegend {
    border-bottom: 2px dotted #53b700;
    padding-right: 20px;
    margin-right: 6px;
}

#cashbalanceLegendInfo {
    display: none;
}
.apexcharts-tooltip {
    top: -70px !important;
}
.summary-container .tileContent{
    padding:10px;
}
.chart-container{
    height:482px;
}
.no-padding{
    padding:0px !important;
}
.nsm-widget-table:hover, .nsm-card:hover{
    cursor:auto !important;
}
</style>
<br>
<div class="nsm-callout primary">
    <button><i class='bx bx-x'></i></button>
    <p>Your customer made a <a href="#" style="color:#0077C5;" class="ajax-modal" data-view="receive_payment_modal" data-toggle="modal" data-target="#receivePaymentModal">payment</a> more than the invoice balance, which created a credit. 
    <a href="#" class="ajax-modal" style="color:#0077C5;" data-view="credit_memo_modal" data-toggle="modal" data-target="#creditMemoModal">How to apply a credit from an overpayment.</a>

    <p>Some nSmarTrac Payments deposits weren't automatically recorded. After you receive the funds in your account, record them manually as a Bank Deposit. <br> <a href="#" style="color:#0077C5;" class="ajax-modal" data-view="bank_deposit_modal" data-toggle="modal" data-target="#depositModal">Take Action</a></p>

    <p>A bank transfer from your customer received as payment for Invoice 13053 has been canceled due to a problem with their account. To keep your <br>books accurate, you should follow the steps to <a href="#" style="color:#0077C5;" class="ajax-modal" data-view="transfer_modal" data-toggle="modal" data-target="#transferModal">handle a canceled bank transfer.</a></p>
</div>
<div class="row mt-3">
    <div class="col-9 col-md-9">
        <div class="chart-container tile-container">
            <div class="inner-container">
                <div class="tileContent">
                    <div class="clear">                        
                        <div class="nsm-card-content">        
                            <div class="nsm-widget-table" style="margin-top: 2px;padding: 13px;">
                                
                                <div class="col-md-12 mt-5 mb-3">
                                    <div class="float-start">
                                        <span class="fw-xnormal">Today's Balance</span></br>
                                        <h1 class="fw-bold todays_balance">$0.00</h1>
                                        <select class="form-select form-select graph_month_span">
                                            <option value="12_month">12 months</option>
                                            <option value="6_month">6 months</option>
                                            <option value="3_month">3 months</option>
                                            <option value="this_month">This month</option>
                                        </select>
                                    </div>
                                    <div class="float-end">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="graph" id="moneyInOut_ID" checked>
                                            <label class="nsm-button btn btn-outline-secondary" for="moneyInOut_ID"><i class="fa fa-bar-chart" aria-hidden="true"></i> Money In/Out</label>
                                            <!--  -->
                                            <input type="radio" class="btn-check" name="graph" id="cashbalance_ID">
                                            <label class="nsm-button btn btn-outline-secondary" for="cashbalance_ID"><i class="fa fa-line-chart" aria-hidden="true"></i> Cash Balance</label>
                                        </div>
                                        <span id="moneyInOutLegendInfo">
                                            <div class="row g-3 align-items-center">
                                                <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="moneyInLegend"></span> Money In</label></div>
                                                <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="moneyOutLegend"></span> Money Out</label></div>
                                            </div>
                                        </span>
                                        <span id="cashbalanceLegendInfo">
                                            <div class="row g-3 align-items-center">
                                                <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="cashBalanceLegend"></span>Cash Balance</label></div>
                                                <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="projectedLegend"></span>Projected</label></div>
                                            </div>
                                        </span>
                                    </div>            
                                    <div id="chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-md-3">
        
        <div class="tile-container summary-container" style="height:445px;">
            <div class="inner-container">
                <div class="tileContent">
                    <div class="clear">                        
                        <div class="nsm-card-content">        
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="nsm-counter h-100">
                                        <div class="row h-100">
                                            <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                <i class="bx bx-receipt"></i>
                                            </div>
                                            <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                <span>Open Invoices</span>
                                                <h2><?php $total = 0; $overdue =0;
                                                    foreach ($upcomingInvoice as $UI) {
                                                        if ($UI->status == "Due" || $UI->status == 'Approved' || $UI->status == 'Partially Paid') {
                                                            $total++;
                                                        }else if($UI->status == "Overdue"){
                                                            $overdue++;
                                                        }
                                                    }
                                                    echo $total; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="nsm-counter h-100">
                                        <div class="row h-100">
                                            <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                <i class="bx bx-calendar-exclamation"></i>
                                            </div>
                                            <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                <span>Overdue Invoices</span>
                                                <h2><?php echo $overdue; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="nsm-counter success h-100">
                                        <div class="row h-100">
                                            <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                <i class="bx bx-badge-check"></i>
                                            </div>
                                            <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                <span>Paid last 30 days</span>
                                                <h2><?php $totalPaid = 0;
                                                        foreach($upcomingInvoice as $UI){
                                                            if(date("Y-m-d")>=date("Y-m-d",strtotime($UI->date_updated)) && date("Y-m-d",strtotime("-30 days"))<=date("Y-m-d",strtotime($UI->date_updated)) && $UI->status == "Paid"){
                                                                $totalPaid++;
                                                            }
                                                        }
                                                        echo $totalPaid;
                                                ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-counter yellow h-100">
                                        <div class="row h-100">
                                            <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                                <i class="bx bx-box subs"></i>
                                            </div>
                                            <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                                <span>Subscription</span>
                                                <h2><?php echo "$".number_format($subs->TOTAL_MMR, 2); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="row mt-3">
    <div class="col-9 col-md-9">
        
        <div class="nsm-card nsm-grid" style="box-shadow:0 2px 8px 0 rgba(0, 0, 0, .2);">
            <div class="nsm-card-header">
                <div class="nsm-card-title"></div>
                <div class="nsm-card-controls"></div>
            </div>

            
            <div class="nsm-card-content ">
                <canvas id="expenses_chart" class="nsm-chart" width="335" height="335"></canvas>
            </div>
        </div>
                                                        
    
    </div>
    <div class="col-3 col-md-3">
        <div class="bank-accounts nsm-card nsm-grid" style="box-shadow:0 2px 8px 0 rgba(0, 0, 0, .2);height:50%;">
            <div class="nsm-card-header">
                <div class="nsm-card-title">Bank Accounts</div>
                <div class="nsm-card-controls">
                    <a href="javascript:void(0);" role="button" class="nsm-button btn-sm m-0 me-2 btn-connect-plaid" id="table-modal">
                        Connect Bank Account
                    </a>
                </div>
            </div>

            
            <div class="nsm-card-content" style="height:400px !important;">
                <div class="nsm-widget-table" style="max-height: 400px;overflow: auto;margin-top: 2px;padding: 13px;">
                    <div class="plaid-accounts"></div>
                </div>
            </div>
        </div>

        <div class="nsm-card nsm-grid mt-5" style="box-shadow:0 2px 8px 0 rgba(0, 0, 0, .2);height:50%;">
            <div class="nsm-card-header">
                <div class="nsm-card-title">Shortcuts</div>
                <div class="nsm-card-controls"></div>
            </div>

            
            <div class="nsm-card-content" style="height:400px !important;">
                <div class="nsm-widget-table" style="max-height: 400px;overflow: auto;margin-top: 2px;padding: 13px;overflow:hidden !important;">
                    <div class="row">
                        <div class="col-lg-12 no-padding">
                            <div class="float-left col-lg-3 no-padding text-center">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="print_checks_modal" data-toggle="modal" data-target="#printChecksModal">
                                    <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'01_print_a_check.png' ?>" />
                                    <p>Print a Check</p>
                                </a>
                            </div>   
                            <div class="float-left col-lg-3 no-padding text-center">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="sales_receipt_modal" data-toggle="modal" data-target="#salesReceiptModal">
                                    <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'05_add_receipt.png' ?>" />
                                    <p>Add Receipt</p>
                                </a>
                            </div>                         
                            <div class="col-lg-3 no-padding float-left text-center">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="receive_payment_modal" data-toggle="modal" data-target="#receivePaymentModal">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'04_recieve_payment.png' ?>" />
                                    <p>Receive Payments</p>
                                </a>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="invoice_modal" data-toggle="modal" data-target="#invoiceModal">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'03_add_invoice.png' ?>" />
                                    <p>Add Invoice</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">                            
                            <div class="col-lg-3 no-padding float-left text-center ">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="bill_modal" data-toggle="modal" data-target="#billModal">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'06_add_bill.png' ?>" />
                                    <p>Add Bill</p>
                                </a>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center ">
                                <a href="<?= base_url('accounting/salesTax'); ?>">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'07_add_sales_tax.png' ?>" />
                                    <p>Add Sales Tax</p>
                                </a>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="pay_bills_modal" data-toggle="modal" data-target="#payBillsModal">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'08_pay_bill.png' ?>" />
                                    <p>Pay Bill</p>
                                </a>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center ">
                                <a href="<?= base_url('accounting/link_bank'); ?>">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'10_sync_bank.png' ?>" />
                                    <p>Bank Sync</p>
                                </a>
                            </div>                            
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center">
                                <a href="javascript:void(0);" class="ajax-modal" data-view="payroll_modal" data-toggle="modal" data-target="#payrollModal">
                                    <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'09_run_payroll.png' ?>" />
                                    <p>Run Payroll</p>
                                </a>
                            </div>                            
                            <div class="col-lg-3 no-padding float-left text-center ">
                                <a href="<?= base_url('accounting/credit-notes'); ?>">
                                    <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'11_add_credit_notes.png' ?>" />
                                    <p>Add Credit Notes</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<script>
$(function(){
    // Show/Hide Manipulation ===============
    $('#moneyInOut_ID').click(function(e) {
        $('#moneyInOutLegendInfo').show();
        $('#cashbalanceLegendInfo').hide();
    });

    $('#cashbalance_ID').click(function(e) {
        $('#moneyInOutLegendInfo').hide();
        $('#cashbalanceLegendInfo').show();
    });

    $('select[name="frequency"]').change(function(e) {
        e.preventDefault();
        const value = $(this).val();
        if (value == "one_time") {
            $('.frequency_settings').hide();
        } else {
            $('.frequency_settings').show();
        }
    });    
    // Show/Hide Manipulation ===============
    
    
    load_plaid_accounts();
    function load_plaid_accounts(){
        var url = base_url + '_load_connected_bank_accounts';
        $('.plaid-accounts').html('<span class="bx bx-loader bx-spin"></span>');
        setTimeout(function () {
        $.ajax({
            type: "POST",
            url: url,
            success: function(o)
            {          
                $('.plaid-accounts').html(o);
            }
        });
        }, 800);
    }

    $(".graph_month_span").change(function(e) {
        if ($('input[name="graph"]').prop("checked") === true) {
            if ($(this).val() == "12_month") {
                getGraphData("bar_12_month");
            } else if ($(this).val() == "6_month") {
                getGraphData("bar_6_month");
            } else if ($(this).val() == "3_month") {
                getGraphData("bar_3_month");
            } else {
                getGraphData("bar_this_month");
            }
        } else { 

        }
    });

    initializeExpensesChart();
    <?php $chartData = set_expense_graph_data([]); ?>
    function initializeExpensesChart(){
        var expeneses = $("#expenses_chart");
        const expensesChart = new Chart(expeneses, {
          type: 'doughnut',
          data: {
            labels: <?= $chartData['account_names']; ?>,
            datasets: [{
              label: 'Expenses',
              data: <?= $chartData['account_expenses']; ?>,
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgb(255, 205, 86, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgb(255, 205, 86, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)',
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'bottom',
              },
            },
            maintainAspectRatio: false,
          }
        });
    }

    var options = {
        series: [{
                name: 'Money in',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
            {
                name: 'Money out',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
        ],
        plotOptions: {
            bar: {
                columnWidth: '50%',
                borderRadius: 5,
            }
        },
        fill: {
            colors: ['#53b700', '#05a4b5'],
        },
        chart: {
            type: 'bar',
            height: 300,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['#FFF', '#FFF']
        },
        tooltip: {
            shared: true,
            intersect: false,
            custom: function({series,seriesIndex,dataPointIndex,w}) {
                let moneyInValue = (series[0][dataPointIndex]) ? formatCurrency(series[0][dataPointIndex]) : "$0.00";
                let moneyOutValue = (series[1][dataPointIndex]) ? formatCurrency(series[1][dataPointIndex]) : "$0.00";
                let netChange = formatCurrency(series[0][dataPointIndex] - series[1][dataPointIndex]);
                const customTooltip = '<div class="row" style="border-radius: 5px; padding: 10px; width: 230px;"> <div class="col-md-12 mt-1"> <h5 class="fw-bold">' + w.globals.labels[dataPointIndex] + '</h5> </div> <div class="col-md-12 mb-1"> <span style="background: #53b700; padding-left: 7px; margin-right: 6px;"></span> <label>Money In:</label>&nbsp;&nbsp;<span class="fw-xnormal">' + moneyInValue + '</span> </div> <div class="col-md-12"> <span style="background: #05a4b5; padding-left: 7px; margin-right: 6px;"></span> <label>Money Out:</label>&nbsp;&nbsp;<span class="fw-xnormal">' + moneyOutValue + '</span> </div> <div class="col-md-12"> <hr style="margin: 5px;"> </div> <div class="col-md-12"><label>Net Change</label>&nbsp;&nbsp;<span class="fw-xnormal">' + netChange + '</span> </div> </div>';
                return customTooltip;
            }

        },
        legend: {
            show: false,
        },
        xaxis: {
            categories: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    function getGraphData(type) {
        switch (type) {
            case "bar_12_month":
                $.ajax({
                    url: base_url + "accounting/cashflowplanner_crud/get_12month_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [{
                                    offsetX: 60,
                                    x: month[9], // Index for "Feb"
                                    x2: month[11], // Index for "Feb"
                                    borderColor: 'darkgreen',
                                    strokeDashArray: 8,
                                    label: {
                                        offsetX: 135,
                                        orientation: 'horizontal',
                                        borderColor: '#53b700',
                                        style: {
                                            color: '#fff',
                                            background: '#53b700',
                                        },
                                        text: 'PROJECTION',
                                    },
                                }, ],
                            },

                        });
                    },
                });
            break;
            case "bar_6_month":
                $.ajax({
                    url: base_url + "accounting/cashflowplanner_crud/get_6month_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [{
                                    offsetX: 130,
                                    x: month[3], // Index for "Feb"
                                    x2: month[5], // Index for "Feb"
                                    borderColor: 'darkgreen',
                                    strokeDashArray: 8,
                                    label: {
                                        offsetX: 200,
                                        orientation: 'horizontal',
                                        borderColor: '#53b700',
                                        style: {
                                            color: '#fff',
                                            background: '#53b700',
                                        },
                                        text: 'PROJECTION',
                                    },
                                }, ],
                            },
                        });
                    },
                });
            break;
            case "bar_3_month":
                $.ajax({
                    url: base_url + "accounting/cashflowplanner_crud/get_3month_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [{
                                    offsetX: 285,
                                    x: month[1], // Index for "Feb"
                                    x2: month[2], // Index for "Feb"
                                    borderColor: 'darkgreen',
                                    strokeDashArray: 8,
                                    label: {
                                        offsetX: 370,
                                        orientation: 'horizontal',
                                        borderColor: '#53b700',
                                        style: {
                                            color: '#fff',
                                            background: '#53b700',
                                        },
                                        text: 'PROJECTION',
                                    },
                                }, ],
                            },
                        });
                    },
                });
            break;
            case "bar_this_month":
                $.ajax({
                    url: base_url + "accounting/cashflowplanner_crud/get_thismonth_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [],
                            },
                        });
                    },
                });
            break;
        }
    }

    function formatCurrency(value) {
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
        return formatter.format(value);
    }

    function updateAllData() {
        getBalance();
        getProjectionData();

        if ($('input[name="graph"]').prop("checked") === true) {
            if ($(".graph_month_span").val() == "12_month") {
                getGraphData("bar_12_month");
            } else if ($(".graph_month_span").val() == "6_month") {
                getGraphData("bar_6_month");
            } else if ($(".graph_month_span").val() == "3_month") {
                getGraphData("bar_3_month");
            } else {
                getGraphData("bar_this_month");
            }
        } else {
            
        }

    }
    updateAllData();

    function getBalance() {
        $.ajax({
            url: base_url + "accounting/cashflowplanner_crud/get_balance",
            method: "POST",
            success: function(response) {
                $('.todays_balance').text(formatCurrency(response));
            },
        });
    }

    function getProjectionData() {
        $.ajax({
            url: base_url + "accounting/cashflowplanner_crud/get_projection_data",
            method: "POST",
        });
    }

    // Plaid
    <?php if( $plaid_handler_open == 1 ){ ?>
    var linkHandler = Plaid.create({
        env: '<?= PLAID_API_ENV ?>',
        clientName: '<?= $client_name; ?>',
        token: '<?= $plaid_token; ?>',
        product: ['auth','transactions'],
        receivedRedirectUri : window.location.href,
        selectAccount: true,
        onSuccess: function(public_token, metadata) {
            if( public_token != '' ){
                var url = base_url + '_create_plaid_account';
                var account_id = metadata.account.id;
                var ins_id     = metadata.institution.institution_id;
                var ins_name   = metadata.institution.name;
                var meta_data   = JSON.stringify(metadata);
                //console.log('metadata: ' + JSON.stringify(metadata));
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {public_token:public_token,meta_data:meta_data},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ){
                            //load bank details
                            load_plaid_accounts();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }
                    }
                }); 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Cannot connect to Plaid. Please try again later.'
                });
            }                        
        },
    });
    linkHandler.open();
    <?php } ?>
    $(document).on('click', '.btn-connect-plaid', function(){
        var url = base_url + '_launch_plaid_accounts';
        var redirect_url = '<?= PLAID_API_REDIRECT_URL_DASHBOARD; ?>';
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data:{redirect_url:redirect_url},
            success: function(o)
            {          
                if( o.is_valid == 1 ){
                    var linkHandler = Plaid.create({
                        env: '<?= PLAID_API_ENV ?>',
                        clientName: o.client_name,
                        token: o.plaid_token,
                        product: ['auth','transactions'],                    
                        selectAccount: true,
                        onSuccess: function(public_token, metadata) {
                            if( public_token != '' ){
                                var url = base_url + '_create_plaid_account';
                                var account_id = metadata.account.id;
                                var ins_id     = metadata.institution.institution_id;
                                var ins_name   = metadata.institution.name;
                                var meta_data   = JSON.stringify(metadata);
                                //console.log('metadata: ' + JSON.stringify(metadata));
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: {public_token:public_token,meta_data:meta_data},
                                    dataType:'json',
                                    success: function(result) {
                                        if( result.is_success == 1 ){
                                            //load bank details
                                            load_plaid_accounts();
                                        }else{
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                html: result.msg
                                            });
                                        }
                                    }
                                }); 
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: 'Cannot connect to Plaid. Please try again later.'
                                });
                            }                        
                        },
                    });
                    linkHandler.open();
                }else{
                    var api_connect_url = base_url + 'tools/api_connectors';
                    //var html_message = o.msg + "<br />To check your Plaid API credentials click <a href='"+api_connect_url+"'>API Connectors</a>";
                    var html_message = o.msg;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: html_message
                    });
                }            
            }
        });
    });
    
});
</script>