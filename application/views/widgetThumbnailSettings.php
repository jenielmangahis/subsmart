<style>
    .display_none { 
        display: none; 
    }

    .enableOption {
        background: #00800021;
    }

    #dashboardThumbnailWidgetSettingsModal .modal-body {
        margin-bottom: -10px;
    }
    
    #widgetThumbnail_tabContent {
        text-align: left !important;
    }

    .cardEditState {
        border: dashed 2px #198754 !important;
    }

    .graphCheckbox {
        height: 17px; 
        width: 17px; 
        cursor: pointer;
    }

    .graphCheckboxLabel {
        margin-top: 4px; 
        margin-left: 4px;
    }

    .thumbnailOptionItems:hover, 
    .widgetOptionItems:hover {
        background: #80710021;
        cursor: pointer;
    }

    .thumbnailDragHandle, 
    .widgetDragHandle {
        cursor: grab;
        display: none;
        letter-spacing: -.2em;
        position: absolute;
        bottom: 7px;
        right: 10px;
        color: gray;
    }

    .thumbnailWidthResizeHandle,
    .widgetWidthResizeHandle {
        right: -10px;
        top: 50%;
        transform: translateY(-50%);
        position: absolute;
        padding: 15px 5px;
        background: green;
        cursor: ew-resize;
        display: none;
    }

    .thumbnailHeightResizeHandle,
    .widgetHeightResizeHandle {
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        position: absolute;
        padding: 5px 15px;
        background: green;
        cursor: ns-resize;
        display: none;
    }

    .thumbnailBorder {
        border: 2px solid #6a4a86;
        border-radius: 10px;
    }

    .thumbnailBadge {
        background: #6a4a86;
    }

    .widgetBorder {
        border: 2px solid #6a4a86;
        border-radius: 10px;
    }

    .widgetBadge {
        background: #6a4a86;
    }

    .textData {
        background: #00000008;
        border-radius: 10px;
        border: 1px solid #d9d9d9;
        padding: 5px;
        margin-top: 10px;

    }

    .textData:hover {
        background: #ffa7001a;
        cursor: pointer;
    }

    .adCarouselIndicators [data-bs-target] {
            border-radius: 100%;
            width: 12px;
            height: 12px;
        }
</style>
<div class="modal fade" id="dashboardThumbnailWidgetSettingsModal" role="dialog" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Thumbnail & Widget Settings</span>
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
                                                    if (count($presetThumbnail) != 0) {
                                                        foreach ($presetThumbnail as $presetThumbnails) {
                                                            if ($thumbnailWidgetOptions->id == $presetThumbnails['id']) {
                                                                $optionState = "enableOption";
                                                                $switchState = "checked";
                                                                break;
                                                            } else {
                                                                $optionState = "";
                                                                $switchState = "";
                                                            }
                                                        }
                                                    }

                                                    $shortDescription = (strlen($text = explode('.', $thumbnailWidgetOptions->description)[0]) > 38) ? substr($text, 0, 38) . '...' : $text . '.';
                                                    if ($thumbnailWidgetOptions->type == "thumbnail") {
                                                        echo "
                                                            <div class='col-md-6 mt-3'>
                                                                <div class='input-group align-items-center'>
                                                                    <span class='thumbnailOptionItems $optionState input-group-text d-flex justify-content-between w-100' title='$thumbnailWidgetOptions->description'>
                                                                        <div class='d-flex align-items-center'>
                                                                            <i class='$thumbnailWidgetOptions->icon text-muted fs-4'></i>&nbsp;&nbsp;&nbsp;
                                                                            <div class='text-start'>
                                                                                <span class='content-title d-block mb-1'>$thumbnailWidgetOptions->title</span>
                                                                                <span class='content-subtitle d-block'>$shortDescription</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-check form-switch m-0 ms-auto'>
                                                                            <input class='thumbnailEnableDisableSwitch form-check-input' type='checkbox' data-id='$thumbnailWidgetOptions->id' data-category='$thumbnailWidgetOptions->category' data-type='$thumbnailWidgetOptions->type' $switchState>
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
                                        <div class="row">
                                            <?php
                                                foreach ($thumbnailWidgetOption as $thumbnailWidgetOptions) {
                                                    if (count($presetWidget) != 0) {
                                                        foreach ($presetWidget as $presetWidgets) {
                                                            if ($thumbnailWidgetOptions->id == $presetWidgets['id']) {
                                                                $optionState = "enableOption";
                                                                $switchState = "checked";
                                                                break;
                                                            } else {
                                                                $optionState = "";
                                                                $switchState = "";
                                                            }
                                                        }
                                                    }

                                                    $shortDescription = (strlen($text = explode('.', $thumbnailWidgetOptions->description)[0]) > 41) ? substr($text, 0, 41) . '...' : $text . '.';
                                                    if ($thumbnailWidgetOptions->type == "widget") {
                                                        echo "
                                                            <div class='col-md-6 mt-3'>
                                                                <div class='input-group align-items-center'>
                                                                    <span class='widgetOptionItems $optionState input-group-text d-flex justify-content-between w-100' title='$thumbnailWidgetOptions->description'>
                                                                        <div class='d-flex align-items-center'>
                                                                            <i class='$thumbnailWidgetOptions->icon text-muted fs-4'></i>&nbsp;&nbsp;&nbsp;
                                                                            <div class='text-start'>
                                                                                <span class='content-title d-block mb-1'>$thumbnailWidgetOptions->title</span>
                                                                                <span class='content-subtitle d-block'>$shortDescription</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-check form-switch m-0 ms-auto'>
                                                                            <input class='widgetEnableDisableSwitch form-check-input' type='checkbox' data-id='$thumbnailWidgetOptions->id' data-category='$thumbnailWidgetOptions->category' data-type='$thumbnailWidgetOptions->type' $switchState>
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
    // script for thumbnails
    $(document).ready(function () {
        let thumbnailGetPresetData = `<?php echo $thumbnailWidgetPreset[0]->thumbnail; ?>`;
        let thumbnailEnabledOptionIDs = (thumbnailGetPresetData) ? JSON.parse(thumbnailGetPresetData) : [];
        let initialLoader = `<div class='col-lg-3 mt-3 cardLoader'><div class='card shadow'><div class='card-body'><div class='row'><div class='col-md-12'><p class='card-text placeholder-glow'><span class='placeholder col-3' style='color:#6a4a86'></span><span class='placeholder col-11 mt-3'></span><span class='placeholder col-12'></span><span class='placeholder col-4'></span><span class='placeholder placeholder-lg col-12 mt-3 mb-3'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-2 mt-3 float-end'></span></p></div></div></div></div></div>`;
        let thumbnailSortableList = $(".thumbnailSortable");
        let thumbnailSortableInstance = null;

        $(document).on('change', '.thumbnailEnableDisableSwitch', function(e) {
            let checkbox = $(this);
            let optionItem = checkbox.closest('.thumbnailOptionItems');
            let isChecked = checkbox.prop('checked');
            let option_id = checkbox.attr('data-id');
            let option_category = checkbox.attr('data-category');
            let option_type = checkbox.attr('data-type');
            let option_cardContainer = `${option_category}${option_id}${option_type}`;
            let option_cardClass = `card_${option_category}${option_id}`;
            let totalEnabledOptions = $('.thumbnailOptionItems.enableOption').length;
            let graphState = $(`.graphDataContainer_${option_id}`).css('display');
            let requestOnAjax = true;

            if (isChecked) {
                if (totalEnabledOptions >= 8) {
                    e.preventDefault();
                    checkbox.prop('checked', false);
                    Swal.fire({
                        icon: "error",
                        title: "Unable to show more",
                        html: "You can only select up to 8 thumbnails.",
                    });
                    requestOnAjax = false;
                } else {
                    optionItem.addClass('enableOption');
                    thumbnailEnabledOptionIDs.push({
                        id: option_id,
                        width: null,
                        colWidth: null,
                        height: null,
                        graphDisplayState: 'none',
                    });

                    if ($(`.${option_cardContainer}`).length > 0) {
                        $(`.${option_cardContainer}`).fadeIn();
                    } else {
                        $('.thumbnailCardContainers').append(initialLoader);
                    }
                }
            } else {
                optionItem.removeClass('enableOption');
                for (let i = thumbnailEnabledOptionIDs.length - 1; i >= 0; i--) {
                    if (thumbnailEnabledOptionIDs[i].id === option_id) {
                        thumbnailEnabledOptionIDs.splice(i, 1);
                    }
                }

                if ($(`.${option_cardContainer}`).length > 0) {
                    $(`.${option_cardContainer}`).hide();
                    $(`.${option_cardContainer}`).appendTo('.thumbnailCardContainers');
                }
            }

            if (requestOnAjax) {
                $.ajax({
                    type: "POST",
                    url: `${window.location.origin}/dashboard/showHideThumbnails`,
                    data: {
                        id: option_id,
                        category: option_category,
                        type: option_type,
                        preset_data: thumbnailEnabledOptionIDs,
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        $('.cardLoader').remove();
                        if (!$(`.${option_cardContainer}`).length > 0) {
                            $('.thumbnailCardContainers').append(`<div class='col-lg-3 mt-3 ${option_cardContainer}' data-id='${option_id}'>${response}</div>`);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.cardLoader').remove();
                        console.error("Request failed!");
                        console.error("Status:", textStatus);
                        console.error("Error:", errorThrown);
                    },
                });
            }
        });

        $(document).on('click', '.thumbnailOptionItems', function(e) {
            if ($(e.target).is('.thumbnailEnableDisableSwitch')) return;
            let optionItem = $(this);
            let checkbox = optionItem.find('.thumbnailEnableDisableSwitch');
            checkbox.trigger('click');
        });

        $(document).on('click', '.thumbnailCustomizeLayout', function() {
            thumbnailMasonry.destroy();
            $('.thumbnailCustomizeLayout').hide();
            $('.thumbnailSaveLayout').show();
            $('.thumbnailCancelLayout').show();
            $('.thumbnailDropdownMenu').show();

            $('.thumbnailDragHandle, .thumbnailWidthResizeHandle, .thumbnailHeightResizeHandle').show();
            $(".thumbnailSortable > div > .card").addClass("cardEditState").removeClass('shadow');
            thumbnailSortableInstance = new Sortable(thumbnailSortableList[0], {
                animation: 150,
                ghostClass: 'thumbnailSortable-ghost',
                handle: '.thumbnailDragHandle',
            });
        });

        $(document).on('click', '.thumbnailSaveLayout', function() {
            $('.thumbnailCustomizeLayout').show();
            $('.thumbnailSaveLayout').hide();
            $('.thumbnailCancelLayout').hide();
            $('.thumbnailDropdownMenu').hide();

            $('.thumbnailDragHandle, .thumbnailWidthResizeHandle, .thumbnailHeightResizeHandle').hide();
            $(".thumbnailSortable > div > .card").removeClass("cardEditState").addClass('shadow');

            let newLayoutOptionIDs = [];
            thumbnailSortableList.children(':visible').each(function(index) {
                let id = $(this).data("id");
                let thumbnailGraphState = $(this).find('.thumbnailGraphDisplay').css('display');
                newLayoutOptionIDs.push({
                    id: id,
                    // width: $(this).find('.card').css("width"),
                    // colWidth: $(this).css("width"),
                    // height: $(this).find('.card').css("height"),
                    width: "",
                    colWidth: "",
                    height: "",
                    graphDisplayState: thumbnailGraphState
                });
            });

            $.ajax({
                type: "POST",
                url: `${window.location.origin}/dashboard/saveDashboardPreference`,
                data: {
                    type: "thumbnail",
                    preset_data: newLayoutOptionIDs,
                },
                beforeSend: function() {},
                success: function(response) {},
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.cardLoader').remove();
                    console.error("Request failed!");
                    console.error("Status:", textStatus);
                    console.error("Error:", errorThrown);
                },
            });

            thumbnailMasonry = new Masonry(document.getElementById('thumbnailMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
        });

        $(document).on('click', '.thumbnailCancelLayout', function() {
            $('.thumbnailCustomizeLayout').show();
            $('.thumbnailSaveLayout').hide();
            $('.thumbnailCancelLayout').hide();
            $('.thumbnailDropdownMenu').hide();

            $('.thumbnailDragHandle, .thumbnailWidthResizeHandle, .thumbnailHeightResizeHandle').hide();
            $(".thumbnailSortable > div > .card").removeClass("cardEditState").addClass('shadow');

            thumbnailMasonry = new Masonry(document.getElementById('thumbnailMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
        });

        $(document).on('mousedown', '.thumbnailWidthResizeHandle', function(e) {
            e.preventDefault();
            let col = $(this).closest('div.col');
            let startX = e.pageX;
            let startWidth = col.outerWidth();
            $('.cardEditState').css('height', 'unset');
            $(document).on('mousemove', function(e) {
                let newWidth = startWidth + Math.round((e.pageX - startX) / 10) * 10;
                col.css('width', newWidth + 'px');
            }).on('mouseup', function() {
                $(this).off('mousemove mouseup');
            });
        });

        $(document).on('mousedown', '.thumbnailHeightResizeHandle', function(e) {
            e.preventDefault();
            let card = $(this).closest('.card');
            let startY = e.pageY;
            let startHeight = card.outerHeight();
            $(document).on('mousemove', function(e) {
                let newHeight = startHeight + Math.round((e.pageY - startY) / 10) * 10;
                card.css('height', newHeight + 'px');
            }).on('mouseup', function() {
                $(this).off('mousemove mouseup');
            });
        });
    });
        
    // script for widgets
    $(document).ready(function () {
        let widgetGetPresetData = `<?php echo $thumbnailWidgetPreset[0]->widget; ?>`;
        let widgetEnabledOptionIDs = (widgetGetPresetData) ? JSON.parse(widgetGetPresetData) : [];
        let initialLoader = `<div class='col-lg-3 mt-3 cardLoader'><div class='card shadow'><div class='card-body'><div class='row'><div class='col-md-12'><p class='card-text placeholder-glow'><span class='placeholder col-3' style='color:#6a4a86'></span><span class='placeholder col-11 mt-3'></span><span class='placeholder col-12'></span><span class='placeholder col-4'></span><span class='placeholder placeholder-lg col-12 mt-3 mb-3'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-2 mt-3 float-end'></span></p></div></div></div></div></div>`;
        let widgetSortableList = $(".widgetSortable");
        let widgetSortableInstance = null;

        $(document).on('change', '.widgetEnableDisableSwitch', function(e) {
            let checkbox = $(this);
            let optionItem = checkbox.closest('.widgetOptionItems');
            let isChecked = checkbox.prop('checked');
            let option_id = checkbox.attr('data-id');
            let option_category = checkbox.attr('data-category');
            let option_type = checkbox.attr('data-type');
            let option_cardContainer = `${option_category}${option_id}${option_type}`;
            let option_cardClass = `card_${option_category}${option_id}`;
            let totalEnabledOptions = $('.widgetOptionItems.enableOption').length;
            let graphState = $(`.graphDataContainer_${option_id}`).css('display');
            let requestOnAjax = true;

            if (isChecked) {
                    optionItem.addClass('enableOption');
                    widgetEnabledOptionIDs.push({
                        id: option_id,
                        width: null,
                        colWidth: null,
                        height: null,
                        graphDisplayState: 'none',
                    });

                    if ($(`.${option_cardContainer}`).length > 0) {
                        $(`.${option_cardContainer}`).fadeIn();
                    } else {
                        $('.widgetCardContainers').append(initialLoader);
                    }
            } else {
                optionItem.removeClass('enableOption');
                for (let i = widgetEnabledOptionIDs.length - 1; i >= 0; i--) {
                    if (widgetEnabledOptionIDs[i].id === option_id) {
                        widgetEnabledOptionIDs.splice(i, 1);
                    }
                }

                if ($(`.${option_cardContainer}`).length > 0) {
                    $(`.${option_cardContainer}`).hide();
                    $(`.${option_cardContainer}`).appendTo('.widgetCardContainers');
                }
            }

            if (requestOnAjax) {
                $.ajax({
                    type: "POST",
                    url: `${window.location.origin}/dashboard/showHideThumbnails`,
                    data: {
                        id: option_id,
                        category: option_category,
                        type: option_type,
                        preset_data: widgetEnabledOptionIDs,
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        $('.cardLoader').remove();
                        if (!$(`.${option_cardContainer}`).length > 0) {
                            $('.widgetCardContainers').append(`<div class='col-lg-4 mt-3 ${option_cardContainer}' data-id='${option_id}'>${response}</div>`);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.cardLoader').remove();
                        console.error("Request failed!");
                        console.error("Status:", textStatus);
                        console.error("Error:", errorThrown);
                    },
                });
            }

        });

        $(document).on('click', '.widgetOptionItems', function(e) {
            if ($(e.target).is('.widgetEnableDisableSwitch')) return;
            let optionItem = $(this);
            let checkbox = optionItem.find('.widgetEnableDisableSwitch');
            checkbox.trigger('click');
        });

        $(document).on('click', '.widgetCustomizeLayout', function() {
            widgetMasonry.destroy();
            $('.widgetCustomizeLayout').hide();
            $('.widgetSaveLayout').show();
            $('.widgetCancelLayout').show();
            $('.widgetDropdownMenu').show();

            $('.widgetDragHandle, .widgetWidthResizeHandle, .widgetHeightResizeHandle').show();
            $(".widgetSortable > div > .card").addClass("cardEditState").removeClass('shadow');
            widgetSortableInstance = new Sortable(widgetSortableList[0], {
                animation: 150,
                ghostClass: 'widgetSortable-ghost',
                handle: '.widgetDragHandle',
            });
        });

        $(document).on('click', '.widgetSaveLayout', function() {
            $('.widgetCustomizeLayout').show();
            $('.widgetSaveLayout').hide();
            $('.widgetCancelLayout').hide();
            $('.widgetDropdownMenu').hide();

            $('.widgetDragHandle, .widgetWidthResizeHandle, .widgetHeightResizeHandle').hide();
            $(".widgetSortable > div > .card").removeClass("cardEditState").addClass('shadow');

            let newLayoutOptionIDs = [];
            widgetSortableList.children(':visible').each(function(index) {
                let id = $(this).data("id");
                let widgetGraphState = $(this).find('.widgetGraphDisplay').css('display');
                newLayoutOptionIDs.push({
                    id: id,
                    // width: $(this).find('.card').css("width"),
                    // colWidth: $(this).css("width"),
                    // height: $(this).find('.card').css("height"),
                    width: "",
                    colWidth: "",
                    height: "",
                    graphDisplayState: widgetGraphState
                });
            });

            $.ajax({
                type: "POST",
                url: `${window.location.origin}/dashboard/saveDashboardPreference`,
                data: {
                    type: "widget",
                    preset_data: newLayoutOptionIDs,
                },
                beforeSend: function() {},
                success: function(response) {},
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.cardLoader').remove();
                    console.error("Request failed!");
                    console.error("Status:", textStatus);
                    console.error("Error:", errorThrown);
                },
            });

            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
        });

        $(document).on('click', '.widgetCancelLayout', function() {
            $('.widgetCustomizeLayout').show();
            $('.widgetSaveLayout').hide();
            $('.widgetCancelLayout').hide();
            $('.widgetDropdownMenu').hide();

            $('.widgetDragHandle, .widgetWidthResizeHandle, .widgetHeightResizeHandle').hide();
            $(".widgetSortable > div > .card").removeClass("cardEditState").addClass('shadow');

            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
        });

        $(document).on('mousedown', '.widgetWidthResizeHandle', function(e) {
            e.preventDefault();
            let col = $(this).closest('div.col');
            let startX = e.pageX;
            let startWidth = col.outerWidth();
            $('.cardEditState').css('height', 'unset');
            $(document).on('mousemove', function(e) {
                let newWidth = startWidth + Math.round((e.pageX - startX) / 10) * 10;
                col.css('width', newWidth + 'px');
            }).on('mouseup', function() {
                $(this).off('mousemove mouseup');
            });
        });

        $(document).on('mousedown', '.widgetHeightResizeHandle', function(e) {
            e.preventDefault();
            let card = $(this).closest('.card');
            let startY = e.pageY;
            let startHeight = card.outerHeight();
            $(document).on('mousemove', function(e) {
                let newHeight = startHeight + Math.round((e.pageY - startY) / 10) * 10;
                card.css('height', newHeight + 'px');
            }).on('mouseup', function() {
                $(this).off('mousemove mouseup');
            });
        });
    });

    // global script for both thumbnails & widgets
    $(document).ready(function () {
        $(document).on('click', '.removeDashboardCard', function() {
            let id = $(this).attr('data-id');
            $(`.thumbnailEnableDisableSwitch[data-id="${id}"]`).prop('checked', false).change();
            $(`.widgetEnableDisableSwitch[data-id="${id}"]`).prop('checked', false).change();
        });

        $(document).on('click', '.showGraphButton', function(e) {
            if (!$(e.target).is('.form-check-input')) {
                e.stopPropagation();
                let checkbox = $(this).find('.form-check-input');
                checkbox.prop('checked', !checkbox.prop('checked')).change();
            }
        });

        $(document).on('click', '.showGraphButton .form-check-input', function(e) {
            e.stopPropagation();
        });

        $('#dashboardThumbnailWidgetSettingsModal').on('show.bs.modal', function(e) {
            try {
                thumbnailMasonry.destroy();
                widgetMasonry.destroy();
            } catch (e) {}
        });

        $('#dashboardThumbnailWidgetSettingsModal').on('hide.bs.modal', function(e) {
            thumbnailMasonry = new Masonry(document.getElementById('thumbnailMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });

            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
        });
    });
</script>