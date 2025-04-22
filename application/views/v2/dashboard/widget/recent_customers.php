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
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo "<i class='$icon'></i>&nbsp;&nbsp;$title"; ?> <span class="badge widgetBadge position-absolute opacity-25"><?php echo ucfirst($type); ?></span>
                    </a>
                    <div class="dropdown float-end widgetDropdownMenu display_none">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item removeDashboardCard" data-id='<?php echo $id; ?>' href="javascript:void(0)">Remove</a></li>
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
        <!-- <div class="row mb-2">
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
        </div> -->
        <div class="row">
            <div class="col text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="table-responsive">
                    <table class="table <?php echo "tableData_$id"; ?> table-hover w-100 mb-0">
                        <tbody>
                            
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
            "#FEA303",
            "#D9A1A0",
            "#BEAFC2",
            "#EFB6C8"
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
                    let data = JSON.parse(response);
                    
                    Object.entries(data).forEach(([key, value]) => {
                        const initials = data[key].customer.split(' ').map(word => word.charAt(0)).join('');
                        const timestamp = new Date(data[key].date).toLocaleString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true }).replace(/(AM|PM)/, match => match.toUpperCase()).replace(',', '');
                        const urlByID = `${window.origin}/customer/preview/${data[key].id}`;

                        $('.<?php echo "tableData_$id"; ?> > tbody').append(`
                            <tr style="cursor: pointer;" onclick="window.open('${urlByID}', '_blank')">
                                <td class="p-2 align-middle">
                                    <div class="d-flex position-relative">
                                        <div class="me-2 flex-shrink-0">
                                            <div class="nsm-profile" style="background-color:#d9a1a0!important;">
                                                <span>${initials}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 min-width-0">
                                            <strong>${data[key].customer}</strong><br>
                                            <span class="d-block text-wrap" style="font-size: 13px;">${data[key].address}</span>
                                        </div>
                                        <small class="text-muted position-absolute" style="top: 0; right: 1px;">${data[key].customer_type}</small>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });

                    const urlModule = `${window.origin}/customer`;
                    $('.<?php echo "tableData_$id"; ?> > tbody').append(`
                        <tr style="cursor: pointer;" onclick="window.open('${urlModule}', '_blank')">
                            <td class="p-2 align-middle">
                                <div class="d-flex position-relative">
                                    <div class="flex-grow-1 min-width-0">
                                        <a href="javascript:void(0)" class="d-block text-wrap text-decoration-none" style="font-size: 13px;">Click here to see more details.</a>
                                    </div>
                               </div>
                            </td>
                        </tr>
                    `);

                    $('.<?php echo "textDataContainer_$id"; ?>').show();
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.<?php echo "textDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphDataContainer_$id"; ?>').hide();
                $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                $('.<?php echo "networkErrorContainer_$id"; ?>').show();
                console.error('Unable to retrieve results due to a network error.');
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

    $(document).on('change', '.<?php echo "showHideGraphCheckbox_$id"; ?>', function() {
        if (!$('.<?php echo "noRecordFoundContainer_$id"; ?>').is(':visible')) {
            if ($(this).is(':checked')) {
                $('.<?php echo "textDataContainer_$id"; ?>').hide();
            } else {
                $('.<?php echo "textDataContainer_$id"; ?>').show();
            }
        }
    });
</script>