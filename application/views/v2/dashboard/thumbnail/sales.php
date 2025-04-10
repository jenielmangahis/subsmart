<?php
    $id = trim($thumbnailsWidgetCard->id);
    $title = trim($thumbnailsWidgetCard->title);
    $description = trim($thumbnailsWidgetCard->description);
    $icon = trim($thumbnailsWidgetCard->icon);
    $type = trim($thumbnailsWidgetCard->type);
    $category = trim($thumbnailsWidgetCard->category);
?>

<div class='card shadow <?php echo "card_$category$id "; ?>'>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo "<i class='$icon'></i>&nbsp;&nbsp;$title"; ?> <span class="badge bg-secondary position-absolute opacity-25"><?php echo ucfirst($type); ?></span>
                    </a>
                    <div class="dropdown float-end thumbnailDropdownMenu display_none">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item removeDashboardCard" data-id='<?php echo $id; ?>' href="javascript:void(0)">Remove</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="px-3 showGraphButton">
                                <div class="form-check" style="margin: -4px;">
                                    <input class="form-check-input <?php echo "showHideGraphCheckbox_$id"; ?> graphCheckbox" type="checkbox" <?php echo ($graphState == 'block') ? 'checked' : ''; ?>>
                                    <label class="form-check-label text-muted graphCheckboxLabel">Show Graph</label>
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
                <div class="input-group">
                    <select class="form-select <?php echo "thumbnailFilter1_$id"; ?>">
                        <option value="all_time">All Time</option>
                        <option value="this_year">This Year</option>
                    </select>
                    <select class="form-select <?php echo "thumbnailFilter2_$id"; ?>">
                        <option value="recent">Recent</option>
                        <option value="last_7_days">Last 7 Days</option>
                        <option value="last_14_days">Last 14 Days</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="last_60_days">Last 60 Days</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-2 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center">
                    <strong class="text-muted text-uppercase">TOTAL AMOUNT</strong>
                    <h2 class="<?php echo "textData1_$id"; ?>"></h2>
                </div>
            </div>
            <div class="col mt-2 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center">
                    <strong class="text-muted text-uppercase">TOTAL COUNT</strong>
                    <h2 class="<?php echo "textData2_$id"; ?>"></h2>
                </div>
            </div>
            <div class="col mt-2 <?php echo "graphDataContainer_$id"; ?> thumbnailGraphDisplay display_none">
                <div id="<?php echo "apexThumbnailGraph_$id"; ?>"></div>
            </div>
            <div class="col mt-2 <?php echo "graphLoaderContainer_$id"; ?> display_none">
                <div class="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="col mt-2 <?php echo "noRecordFoundContainer_$id"; ?> display_none">
                <div class="text-center">No Record Found...</div>
            </div>
        </div>
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>
<script>
    
    function <?php echo "graphColorRandomizer_$id"; ?>(type = 'single', count = 20) {
        const colorPalette = [
            '#FF5733', '#C70039', '#900C3F', '#581845', 
            '#8E44AD', '#2980B9', '#1F618D', '#16A085', 
            '#27AE60', '#D35400', '#A04000', '#7D3C98',
            '#008FFB', '#00E396', '#FEB019', '#FF4560', 
            '#775DD0', '#3F51B5', '#4CAF50', '#FFC107'
        ];
        
        if (type === 'single') {
            return colorPalette[Math.floor(Math.random() * colorPalette.length)];
        } 
        else if (type === 'multiple') {
            const shuffled = [...colorPalette].sort(() => 0.5 - Math.random());
            return shuffled.slice(0, Math.min(count, colorPalette.length));
        }
        
        return colorPalette[0];
    }

    function <?php echo "processData_$id"; ?>(category, dateFrom, dateTo, filter3) { 
        $.ajax({
            url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
            type: "POST",
            data: {
                category: category,
                dateFrom: dateFrom,
                dateTo: dateTo,
                filter3: filter3,
            },
            beforeSend: function() {
                $('.<?php echo "textDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphLoaderContainer_$id"; ?>').fadeIn();
                $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            },
            success: function(response) {
                let <?php echo "textData1_$id"; ?> = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(JSON.parse(response)['TOTAL_AMOUNT']);
                let <?php echo "textData2_$id"; ?> = JSON.parse(response)['TOTAL_COUNT'];
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
                    $('.<?php echo "textDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').fadeIn();
                } else {
                    if ($('.<?php echo "showHideGraphCheckbox_$id"; ?>').is(':checked')) {
                        $('.<?php echo "textDataContainer_$id"; ?>').hide();
                        $('.<?php echo "graphDataContainer_$id"; ?>').fadeIn();
                    } else {
                        $('.<?php echo "textDataContainer_$id"; ?>').fadeIn();
                        $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                    }
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                    $('.<?php echo "textData1_$id"; ?>').text(<?php echo "textData1_$id"; ?>);
                    $('.<?php echo "textData2_$id"; ?>').text(<?php echo "textData2_$id"; ?>);

                    <?php echo "graphChart_$id"; ?>.updateOptions({
                        xaxis: { categories: categories },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
                                }
                            }
                        },
                        colors: <?php echo "graphColorRandomizer_$id"; ?>('multiple')
                    });

                    <?php echo "graphChart_$id"; ?>.updateSeries([{
                        name: "<?php echo $title; ?>",
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

    // let category = '<?php echo $category; ?>';
    // let dateFrom = new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0];
    // let dateTo = new Date().toISOString().split('T')[0];
    // let filter2 = 'all_status';
    <?php echo "processData_$id"; ?>(
        '<?php echo $category; ?>', 
        '1970-01-01', 
        new Date().toISOString().split('T')[0], 
        'all_status'
    );
    
    let <?php echo "options_$id"; ?> = {
        series: [{ name: "<?php echo $title; ?>", data: [] }],
        xaxis: { categories: [] },
        chart: { height: 150, type: 'bar', zoom: { enabled: false }, toolbar: { show: false } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        grid: { show: true, xaxis: { lines: { show: true } } },
        markers: { size: 6, strokeWidth: 3, hover: { size: 10 } },
        colors: <?php echo "graphColorRandomizer_$id"; ?>('multiple')
    };
    
    let <?php echo "graphChart_$id"; ?> = new ApexCharts(document.querySelector("#<?php echo "apexThumbnailGraph_$id"; ?>"), <?php echo "options_$id"; ?>);
    <?php echo "graphChart_$id"; ?>.render(); 

    $(document).on('change', '.<?php echo "thumbnailFilter1_$id"; ?>, .<?php echo "thumbnailFilter2_$id"; ?>, .<?php echo "thumbnailFilter3_$id"; ?>', function() {
        let category = '<?php echo $category; ?>';
        let filter1 = $('.<?php echo "thumbnailFilter1_$id"; ?> option:selected').val();
        let filter2 = $('.<?php echo "thumbnailFilter2_$id"; ?> option:selected').val();
        let filter3 = $('.<?php echo "thumbnailFilter3_$id"; ?> option:selected').val();
        let dateFrom = new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0];
        let dateTo = new Date().toISOString().split('T')[0];
        let today = new Date();

        switch (filter1) {
            case 'all_time':
                dateFrom = '1970-01-01';
                break;
            case 'this_year':
                dateFrom = new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0];
                break;
        }

        switch (filter2) {
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
            case 'recent':
            default:
                dateTo = new Date().toISOString().split('T')[0];
                break;
        }

        <?php echo "processData_$id"; ?>(category, dateFrom, dateTo, filter3);
    });

    $(document).on('change', '.<?php echo "showHideGraphCheckbox_$id"; ?>', function() {
        if (!$('.<?php echo "noRecordFoundContainer_$id"; ?>').is(':visible')) {
            if ($(this).is(':checked')) {
                $('.<?php echo "textDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphDataContainer_$id"; ?>').fadeIn();
            } else {
                $('.<?php echo "textDataContainer_$id"; ?>').fadeIn();
                $('.<?php echo "graphDataContainer_$id"; ?>').hide();
            }
        }
    });
</script>