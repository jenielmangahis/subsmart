<style>
    .optionItems:hover {
        background: #80710021;
        cursor: pointer;
    }

    .enableOption {
        background: #00800021;
    }

    #dashboardThumbnailWidgetSettingsModal .modal-body {
        margin-bottom: -10px;
    }
</style>
<div class="modal fade" id="dashboardThumbnailWidgetSettingsModal" role="dialog" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Dashboard Thumbnail & Widget Settings</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <ul class="nav nav-pills" id="widgetThumbnail_tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="thumbnailPill_tab" data-bs-toggle="pill" data-bs-target="#thumbnail_pill" type="button" role="tab" aria-controls="thumbnail_pill" aria-selected="true">Thumbnail</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="widgetPill_tab" data-bs-toggle="pill" data-bs-target="#widget_pill" type="button" role="tab" aria-controls="widget_pill" aria-selected="false">Widget</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="tab-content" id="widgetThumbnail_tabContent">
                                    <div class="tab-pane fade show active" id="thumbnail_pill" role="tabpanel" aria-labelledby="thumbnailPill_tab">
                                        <label>Choose specific thumbnails to display. You can select up to a maximum of 8 thumbnails.</label>
                                        <div class="row">
                                            <?php
                                                foreach ($thumbnailWidgetOption as $thumbnailWidgetOptions) {
                                                    $shortDescription = (strlen($text = explode('.', $thumbnailWidgetOptions->description)[0]) > 38) ? substr($text, 0, 38) . '...' : $text . '.';
                                                    if ($thumbnailWidgetOptions->type == "thumbnail") {
                                                        echo "
                                                            <div class='col-md-6 mt-3'>
                                                                <div class='input-group align-items-center'>
                                                                    <span class='optionItems input-group-text d-flex justify-content-between w-100' title='$thumbnailWidgetOptions->description'>
                                                                        <div class='d-flex align-items-center'>
                                                                            <i class='$thumbnailWidgetOptions->icon text-muted fs-4'></i>&nbsp;&nbsp;&nbsp;
                                                                            <div class='text-start'>
                                                                                <span class='content-title d-block mb-1'>$thumbnailWidgetOptions->title</span>
                                                                                <span class='content-subtitle d-block'>$shortDescription</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-check form-switch m-0 ms-auto'>
                                                                            <input class='enableDisableSwitch form-check-input' type='checkbox' data-id='$thumbnailWidgetOptions->id' data-category='$thumbnailWidgetOptions->category' data-type='$thumbnailWidgetOptions->type'>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        ";
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="widget_pill" role="tabpanel" aria-labelledby="widgetPill_tab">
                                        <label>Select widgets to display with no limit on the number of widgets you can choose.</label>
                                        <div class="row mt-3">
                                            <?php
                                                foreach ($thumbnailWidgetOption as $thumbnailWidgetOptions) {
                                                    $shortDescription = (strlen($text = explode('.', $thumbnailWidgetOptions->description)[0]) > 41) ? substr($text, 0, 41) . '...' : $text . '.';
                                                    if ($thumbnailWidgetOptions->type == "widget") {
                                                        echo "
                                                            <div class='col-md-6 mb-3'>
                                                                <div class='input-group align-items-center'>
                                                                    <span class='optionItems input-group-text d-flex justify-content-between w-100' title='$thumbnailWidgetOptions->description'>
                                                                        <div class='d-flex align-items-center'>
                                                                            <i class='$thumbnailWidgetOptions->icon text-muted fs-4'></i>&nbsp;&nbsp;&nbsp;
                                                                            <div class='text-start'>
                                                                                <span class='content-title d-block mb-1'>$thumbnailWidgetOptions->title</span>
                                                                                <span class='content-subtitle d-block'>$shortDescription</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-check form-switch m-0 ms-auto'>
                                                                            <input class='enableDisableSwitch form-check-input' type='checkbox' data-id='$thumbnailWidgetOptions->id' data-category='$thumbnailWidgetOptions->category' data-type='$thumbnailWidgetOptions->type'>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        ";
                                                    }
                                                }
                                            ?>
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

<script>
$(document).on('change', '.enableDisableSwitch', function (e) {
    let checkbox = $(this);
    let optionItem = checkbox.closest('.optionItems');
    let isChecked = checkbox.prop('checked');
    let option_id = checkbox.attr('data-id');
    let option_category = checkbox.attr('data-category');
    let option_type = checkbox.attr('data-type');
    let option_cardClass = `${option_category}${option_id}${option_type}`;
    let totalEnabledOptions = $('.optionItems.enableOption').length;
    let initialLoader = `<div class='col-lg-4 mt-3 cardLoader'><div class='card shadow'><div class='card-body'><div class='row'><div class='col-md-12'><p class='card-text placeholder-glow'><span class='placeholder col-3' style='color:#6a4a86'></span><span class='placeholder col-11 mt-3'></span><span class='placeholder col-12'></span><span class='placeholder col-4'></span><span class='placeholder placeholder-lg col-12 mt-3 mb-3'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-2 mt-3 float-end'></span></p></div></div></div></div></div>`;

    // Get all enabled option IDs before making any changes
    let enabledOptionIDs = $('.optionItems.enableOption .enableDisableSwitch').map(function () {
        return $(this).attr('data-id');
    }).get();

    if (isChecked) {
        if (totalEnabledOptions >= 8) {
            e.preventDefault();
            checkbox.prop('checked', false);
            Swal.fire({
                icon: "error",
                title: "Unable to show more",
                html: "You can only select up to 8 thumbnails.",
            });
        } else {
            optionItem.addClass('enableOption');

            if ($(`.${option_cardClass}`).length > 0) {
                $(`.${option_cardClass}`).fadeIn();
            } else {
                $('.cardContainers1').append(initialLoader);
            }
        }
    } else {
        optionItem.removeClass('enableOption');
        
        if ($(`.${option_cardClass}`).length > 0) {
            $(`.${option_cardClass}`).hide();
        }
    }

    // Update enabledOptionIDs after the change
    enabledOptionIDs = $('.optionItems.enableOption .enableDisableSwitch').map(function () {
        return $(this).attr('data-id');
    }).get();

    // Always send AJAX request regardless of enabling or disabling
    $.ajax({
        type: "POST",
        url: `${window.location.origin}/dashboard/showHideThumbnails`,
        data: {
            id: option_id,
            category: option_category,
            type: option_type,
            preset_data: enabledOptionIDs,
        },
        beforeSend: function () {
            if (!$(`.${option_cardClass}`).length > 0) {
                $('.cardContainers1').append(initialLoader);
            }
        },
        success: function (response) {
            $('.cardLoader').remove();
            if (!$(`.${option_cardClass}`).length > 0) {
                $('.cardContainers1').append(`<div class='col-lg-4 mt-3 ${option_cardClass}' data-id='${option_id}'>${response}</div>`);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.cardLoader').remove();
            console.error("Request failed!");
            console.error("Status:", textStatus);
            console.error("Error:", errorThrown);
        },
    });
});

$(document).on('click', '.optionItems', function (e) {
    if ($(e.target).is('.enableDisableSwitch')) return;
    let optionItem = $(this);
    let checkbox = optionItem.find('.enableDisableSwitch');
    checkbox.trigger('click');
});

$(document).on('click', '.removeDashboardCard', function () {
    const id = $(this).attr('data-id');
    $(`.enableDisableSwitch[data-id="${id}"]`).prop('checked', false).change();
});
</script>

<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dashboardThumbnailWidgetSettingsModal">TEST DASHBOARD SETTINGS</button> -->