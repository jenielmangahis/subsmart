<?php
    $id = trim($thumbnailsWidgetCard->id);
    $title = trim($thumbnailsWidgetCard->title);
    $description = trim($thumbnailsWidgetCard->description);
    $icon = trim($thumbnailsWidgetCard->icon);
    $type = trim($thumbnailsWidgetCard->type);
    $category = trim($thumbnailsWidgetCard->category);
?>

<div class='card shadow widgetBorder <?php echo "card_$category$id "; ?>'>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none widget-header-widget-default-arrow" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo "<i class='$icon'></i>&nbsp;&nbsp;$title"; ?> <span class="badge widgetBadge position-absolute opacity-25"><?php echo ucfirst($type); ?></span>
                    </a>
                    <div class="dropdown float-end widgetDropdownMenu display_none">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item removeDashboardCard" data-id='<?php echo $id; ?>' href="javascript:void(0)">Remove</a></li>
                            <!-- <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="px-3 showGraphButton">
                                <div class="form-check" style="margin: -4px;">
                                    <input class="form-check-input <?php echo "showHideGraphCheckbox_$id"; ?> graphCheckbox" type="checkbox" <?php echo ($graphState == 'block') ? 'checked' : ''; ?>>
                                    <label class="form-check-label text-muted graphCheckboxLabel">Show Graph</label>
                                </div>
                            </li> -->
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
                    <select class="form-select <?php echo "widgetFilter1_$id"; ?>">
                        <option value="all_time">All Time</option>
                        <option value="this_year" selected>This Year</option>
                    </select>
                    <select class="form-select <?php echo "widgetFilter2_$id"; ?>">
                        <option value="recent" selected>Recent</option>
                        <option value="last_7_days">Last 7 Days</option>
                        <option value="last_14_days">Last 14 Days</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="last_60_days">Last 60 Days</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="table-responsive" style="max-height: 500px;">
                    <table class="table table-bordered <?php echo "tableData_$id"; ?> table-hover w-100 mb-3">
                        <thead style="background: #00000008;">
                            <tr>
                                <th>Employee</th>
                                <th>Job</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">No Records Found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mt-2 <?php echo "graphLoaderContainer_$id"; ?> graphLoader display_none">
                <div class="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="col mt-2 <?php echo "noRecordFoundContainer_$id"; ?> display_none">
                <div class="text-center">No Record Found...</div>
            </div>
            <div class="col mt-2 <?php echo "networkErrorContainer_$id"; ?> display_none">
                <div class="text-center">Unable to retrieve results due to a network error.<br>
                    <small>
                        <a class="text-decoration-none" href="javascript:void(0)" onclick='$(`.<?php echo "widgetFilter1_$id"; ?>`).change();'><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Refresh</a>
                    </small>
                </div>
            </div>
        </div>
        <strong class="widgetDragHandle">⣿⣿⣿⣿</strong>
        <span class="widgetWidthResizeHandle"></span>
        <span class="widgetHeightResizeHandle"></span>
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
                $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
                $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
            },
            success: function(response) {
                if (response != "null") {
                    const data = JSON.parse(response);
                    $('.<?php echo "tableData_$id"; ?> > tbody').html("");
                    $('.<?php echo "tableData_$id"; ?> > tbody').append(data.table_content);

                    $('.<?php echo "textDataContainer_$id"; ?>').show();
                    $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                    $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
                } else {
                    $('.<?php echo "textDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').show();
                    $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
                }
                widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.<?php echo "textDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                $('.<?php echo "networkErrorContainer_$id"; ?>').show();
                console.error('Unable to retrieve results due to a network error.');
                widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
            }
        });
    }

    <?php echo "processData_$id"; ?>(
        '<?php echo $category; ?>', 
        ($('.<?php echo "widgetFilter1_$id"; ?> option:selected').val() == 'all_time') ? '1970-01-01' : new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0], 
        new Date().toISOString().split('T')[0], 
        $('.<?php echo "widgetFilter3_$id"; ?> option:selected').val()
    );
 
    $(document).on('change', '.<?php echo "widgetFilter1_$id"; ?>, .<?php echo "widgetFilter2_$id"; ?>, .<?php echo "widgetFilter3_$id"; ?>', function() {
        let category = '<?php echo $category; ?>';
        let filter1 = $('.<?php echo "widgetFilter1_$id"; ?> option:selected').val();
        let filter2 = $('.<?php echo "widgetFilter2_$id"; ?> option:selected').val();
        let filter3 = $('.<?php echo "widgetFilter3_$id"; ?> option:selected').val();
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
</script>