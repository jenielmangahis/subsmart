<?php
$title = "Subscription Revenue";
$description = "Tracks recurring customer plans. This card displays the total number and amount of active subscriptions.";
$icon = '<i class="fas fa-file-invoice-dollar"></i>';
$type = "thumbnail";
$category = "subscription_revenue";
?>
<style>
    .display_none { 
        display: none; 
    }

    .dnone {
        display: none;
    }

    .showHideGraphCheckbox {
        height: 17px;
        width: 17px;
        cursor: pointer;
    } 
</style>
<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo "$icon&nbsp;&nbsp;$title"; ?> <span class="badge bg-secondary position-absolute opacity-25"><?php echo ucfirst($type); ?></span>
                    </a>
                    <div class="dropdown float-end">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item removeDashboardCard" data-id='<?php echo $id; ?>' href="javascript:void(0)">Remove</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="px-3">
                                <div class="form-check" style="margin: -4px;">
                                    <input class="form-check-input showHideGraphCheckbox" type="checkbox">
                                    <label class="form-check-label text-muted" style=" margin-top: 4px; margin-left: 4px;">Show Graph</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <span><?php echo $description; ?></span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <select class="form-select thumbnailFilter1">
                        <option value="all_time">All Time</option>
                        <option value="last_7_days">Last 7 Days</option>
                        <option value="last_14_days">Last 14 Days</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="last_60_days">Last 60 Days</option>
                    </select>
                    <select class="form-select thumbnailFilter2">
                        <option value="all_status">All Status</option>
                        <option value="Active w/RAR">Active w/RAR</option>
                        <option value="Active w/RQR">Active w/RQR</option>
                        <option value="Active w/RMR">Active w/RMR</option>
                        <option value="Active w/RYR">Active w/RYR</option>
                        <option value="Inactive w/RMM">Inactive w/RMM</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col textDataContainer">
                <div class="text-center">
                    <strong class="text-muted text-uppercase">TOTAL SUBSCRIPTION REVENUE</strong>
                    <h2 class="textData1"></h2>
                </div>
            </div>
            <div class="col textDataContainer">
                <div class="text-center">
                    <strong class="text-muted text-uppercase">TOTAL SUBSCRIBERS</strong>
                    <h2 class="textData2"></h2>
                </div>
            </div>
            <div class="col graphDataContainer dnone">
                <div id="apexThumbnailGraph"></div>
            </div>
            <div class="col graphLoaderContainer dnone">
                <div class="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="col noRecordFoundContainer dnone">
                <div class="text-center">No Record Found...</div>
            </div>
        </div>
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>
<script>
    function graphColorRandomizer() {
        const colors = [
            '#FF5733', 
            '#C70039', 
            '#900C3F', 
            '#581845', 
            '#8E44AD', 
            '#2980B9', 
            '#1F618D', 
            '#16A085', 
            '#27AE60', 
            '#D35400', 
            '#A04000', 
            '#7D3C98',
        ];
        return colors[Math.floor(Math.random() * colors.length)];
    }

    function processData(category, dateFrom, dateTo, filter2) {
        $.ajax({
            url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
            type: "POST",
            data: {
                category: category,
                dateFrom: dateFrom,
                dateTo: dateTo,
                filter2: filter2,
            },
            beforeSend: function() {
                $('.textDataContainer').hide();
                $('.graphDataContainer').hide();
                $('.graphLoaderContainer').fadeIn();
                $('.noRecordFoundContainer').hide();
            },
            success: function(response) {
                let textData1 = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(JSON.parse(response)['TOTAL_SUBSCRIPTION_REVENUE']);
                let textData2 = JSON.parse(response)['TOTAL_SUBSCRIBERS'];
                let graphData = JSON.parse(response)['GRAPH'];
                let currentYear = new Date().getFullYear().toString();

                let filteredGraphData = Object.keys(graphData)
                    .filter(key => key.startsWith(currentYear))
                    .reduce((obj, key) => {
                        obj[key] = parseFloat(graphData[key]);
                        return obj;
                    }, {});

                let categories = Object.keys(filteredGraphData).map(month => month.split(' ')[1]);
                let values = Object.values(filteredGraphData);

                if (values.length === 0) {
                    $('.textDataContainer').hide();
                    $('.graphDataContainer').hide();
                    $('.graphLoaderContainer').hide();
                    $('.noRecordFoundContainer').fadeIn();
                } else {
                    if ($('.showHideGraphCheckbox').is(':checked')) {
                        $('.textDataContainer').hide();
                        $('.graphDataContainer').fadeIn();
                    } else {
                        $('.textDataContainer').fadeIn();
                        $('.graphDataContainer').hide();
                    }
                    $('.graphLoaderContainer').hide();
                    $('.noRecordFoundContainer').hide();
                    $('.textData1').text(textData1);
                    $('.textData2').text(textData2);

                    chart.updateOptions({
                        xaxis: { categories: categories },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
                                }
                            }
                        },
                        colors: [graphColorRandomizer()]
                    });

                    chart.updateSeries([{
                        name: "Subscription Revenue",
                        data: values
                    }]);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Request failed!");
                console.error("Status:", textStatus);
                console.error("Error:", errorThrown);
            }
        });
    }

    const category = '<?php echo $category; ?>';
    const dateFrom = '1970-01-01';
    const dateTo = new Date().toISOString().split('T')[0];
    const filter2 = 'all_status';
    processData(category, dateFrom, dateTo, filter2);
    
    var options = {
        series: [{ name: "Subscription Revenue", data: [] }],
        xaxis: { categories: [] },
        chart: { height: 150, type: 'line', zoom: { enabled: false }, toolbar: { show: false } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        grid: { show: true, xaxis: { lines: { show: true } } },
        markers: { size: 6, strokeWidth: 3, hover: { size: 10 } },
        colors: [graphColorRandomizer()]
    };

    var chart = new ApexCharts(document.querySelector("#apexThumbnailGraph"), options);
    chart.render(); 

    $(document).on('change', '.thumbnailFilter1, .thumbnailFilter2', function() {
        const category = '<?php echo $category; ?>';
        const filter1 = $('.thumbnailFilter1 option:selected').val();
        const filter2 = $('.thumbnailFilter2 option:selected').val();
        let dateFrom = '1970-01-01';
        let dateTo = new Date().toISOString().split('T')[0];
        const today = new Date();

        switch (filter1) {
            case 'last_7_days':
                dateTo = new Date(today.setDate(today.getDate() - 7)).toISOString().split('T')[0];
                break;
            case 'last_14_days':
                dateTo = new Date(today.setDate(today.getDate() - 14)).toISOString().split('T')[0];
                break;
            case 'last_30_days':
                dateTo = new Date(today.setDate(today.getDate() - 30)).toISOString().split('T')[0];
                break;
            case 'last_60_days':
                dateTo = new Date(today.setDate(today.getDate() - 60)).toISOString().split('T')[0];
                break;
            case 'all_time':
            default:
                dateTo = new Date().toISOString().split('T')[0];
                break;
        }

        processData(category, dateFrom, dateTo, filter2);
    });

    $(document).on('change', '.showHideGraphCheckbox', function() {
        if (!$('.noRecordFoundContainer').is(':visible')) {
            if ($(this).is(':checked')) {
                $('.textDataContainer').hide();
                $('.graphDataContainer').fadeIn();
            } else {
                $('.textDataContainer').fadeIn();
                $('.graphDataContainer').hide();
            }
        }
    });
</script>