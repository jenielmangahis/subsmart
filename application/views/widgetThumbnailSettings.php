<style>
    .display_none { 
        display: none; 
    }

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
    
    #widgetThumbnail_tabContent {
        text-align: left !important;
    }

    /* Customize Thumbnail & Widget Styles */
    #sortable .card {
        min-height: 200px;
    }

    #sortable>.col {
        min-width: 500px;
    }

    .cardContainers {
        display: none;
    }

    .cardEditState {
        border: dashed 2px #198754 !important;
    }

    .dragHandle {
        cursor: grab;
        display: none;
        letter-spacing: -.2em;
        position: absolute;
        bottom: 7px;
        right: 10px;
        color: gray;
    }

    .widthResizeHandle {
        right: -10px;
        top: 50%;
        transform: translateY(-50%);
        position: absolute;
        padding: 15px 5px;
        background: green;
        cursor: ew-resize;
        display: none;
    }

    .heightResizeHandle {
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        position: absolute;
        padding: 5px 15px;
        background: green;
        cursor: ns-resize;
        display: none;
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
                                                                    <span class='optionItems $optionState input-group-text d-flex justify-content-between w-100' title='$thumbnailWidgetOptions->description'>
                                                                        <div class='d-flex align-items-center'>
                                                                            <i class='$thumbnailWidgetOptions->icon text-muted fs-4'></i>&nbsp;&nbsp;&nbsp;
                                                                            <div class='text-start'>
                                                                                <span class='content-title d-block mb-1'>$thumbnailWidgetOptions->title</span>
                                                                                <span class='content-subtitle d-block'>$shortDescription</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-check form-switch m-0 ms-auto'>
                                                                            <input class='enableDisableSwitch form-check-input' type='checkbox' data-id='$thumbnailWidgetOptions->id' data-category='$thumbnailWidgetOptions->category' data-type='$thumbnailWidgetOptions->type' $switchState>
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
                                            <div class='col-md-6 mt-3'><i class="text-muted">Currently testing this part...</i></div>
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

                                                    $shortDescription = (strlen($text = explode('.', $thumbnailWidgetOptions->description)[0]) > 41) ? substr($text, 0, 41) . '...' : $text . '.';
                                                    if ($thumbnailWidgetOptions->type == "widget") {
                                                        echo "
                                                            <div class='col-md-6 mb-3'>
                                                                <div class='input-group align-items-center'>
                                                                    <span class='optionItems $optionState input-group-text d-flex justify-content-between w-100' title='$thumbnailWidgetOptions->description'>
                                                                        <div class='d-flex align-items-center'>
                                                                            <i class='$thumbnailWidgetOptions->icon text-muted fs-4'></i>&nbsp;&nbsp;&nbsp;
                                                                            <div class='text-start'>
                                                                                <span class='content-title d-block mb-1'>$thumbnailWidgetOptions->title</span>
                                                                                <span class='content-subtitle d-block'>$shortDescription</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-check form-switch m-0 ms-auto'>
                                                                            <input class='enableDisableSwitch form-check-input' type='checkbox' data-id='$thumbnailWidgetOptions->id' data-category='$thumbnailWidgetOptions->category' data-type='$thumbnailWidgetOptions->type' $switchState>
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
    let getPresetData = `<?php echo $thumbnailWidgetPreset[0]->thumbnail; ?>`;
    let enabledOptionIDs = (getPresetData) ? JSON.parse(getPresetData) : [];
    $(document).on('change', '.enableDisableSwitch', function(e) {
        let checkbox = $(this);
        let optionItem = checkbox.closest('.optionItems');
        let isChecked = checkbox.prop('checked');
        let option_id = checkbox.attr('data-id');
        let option_category = checkbox.attr('data-category');
        let option_type = checkbox.attr('data-type');
        let option_cardContainer = `${option_category}${option_id}${option_type}`;
        let option_cardClass = `card_${option_category}${option_id}`;
        let totalEnabledOptions = $('.optionItems.enableOption').length;
        let requestOnAjax = true;
        let graphState = $(`.graphDataContainer_${option_id}`).css('display');
        let initialLoader = `<div class='col-lg-3 mt-3 cardLoader'><div class='card shadow'><div class='card-body'><div class='row'><div class='col-md-12'><p class='card-text placeholder-glow'><span class='placeholder col-3' style='color:#6a4a86'></span><span class='placeholder col-11 mt-3'></span><span class='placeholder col-12'></span><span class='placeholder col-4'></span><span class='placeholder placeholder-lg col-12 mt-3 mb-3'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-12'></span><span class='placeholder col-2 mt-3 float-end'></span></p></div></div></div></div></div>`;

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
                enabledOptionIDs.push({
                    id: option_id,
                    width: null,
                    colWidth: null,
                    height: null,
                    graphDisplayState: 'none',
                });

                if ($(`.${option_cardContainer}`).length > 0) {
                    $(`.${option_cardContainer}`).fadeIn();
                } else {
                    $('.cardContainers1').append(initialLoader);
                }
            }
        } else {
            optionItem.removeClass('enableOption');
            for (let i = enabledOptionIDs.length - 1; i >= 0; i--) {
                if (enabledOptionIDs[i].id === option_id) {
                    enabledOptionIDs.splice(i, 1);
                }
            }

            if ($(`.${option_cardContainer}`).length > 0) {
                $(`.${option_cardContainer}`).hide();
                $(`.${option_cardContainer}`).appendTo('.cardContainers1');
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
                    preset_data: enabledOptionIDs,
                },
                beforeSend: function() {},
                success: function(response) {
                    $('.cardLoader').remove();
                    if (!$(`.${option_cardContainer}`).length > 0) {
                        $('.cardContainers1').append(`<div class='col-lg-3 mt-3 ${option_cardContainer}' data-id='${option_id}'>${response}</div>`);
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

        console.log(enabledOptionIDs);
    });

    $(document).on('click', '.optionItems', function(e) {
        if ($(e.target).is('.enableDisableSwitch')) return;
        let optionItem = $(this);
        let checkbox = optionItem.find('.enableDisableSwitch');
        checkbox.trigger('click');
    });

    $(document).on('click', '.removeDashboardCard', function() {
        let id = $(this).attr('data-id');
        $(`.enableDisableSwitch[data-id="${id}"]`).prop('checked', false).change();
    });

    $(document).on('click', '.showGraphButton', function(e) {
        if (!$(e.target).is('.form-check-input')) {
            e.stopPropagation();
            let checkbox = $(this).find('.form-check-input');
            checkbox.prop('checked', !checkbox.prop('checked')).change();
        }

        let sortableList = $(".sortable");
        let newLayoutOptionIDs = [];
            sortableList.children(':visible').each(function(index) {
                let id = $(this).data("id");
                let thumbnailGraphState = $(this).find('.thumbnailGraphDisplay').css('display');
                newLayoutOptionIDs.push({
                    id: id,
                    width: $(this).find('.card').css("width"),
                    colWidth: $(this).css("width"),
                    height: $(this).find('.card').css("height"),
                    graphDisplayState: thumbnailGraphState
                });
            });

        console.log(newLayoutOptionIDs);
    });

    $(document).on('click', '.showGraphButton .form-check-input', function(e) {
        e.stopPropagation();
    });

    // Customize Thumbnail & Widget Settings script
    $(document).ready(function() {
        let sortableList = $(".sortable");
        let sortableInstance = null;
        let isEditing = false;
        let savedLayout = localStorage.getItem("cardLayout1");

        $(document).on('click', '.customizeThumbnailLayout', function() {
            thumbnailMasonry.destroy();
            $('.customizeThumbnailLayout').hide();
            $('.saveThumbnailLayout').show();
            $('.cancelThumbnailLayout').show();
            $('.thumbnailDropdownMenu').show();

            $('.dragHandle, .widthResizeHandle, .heightResizeHandle').show();
            $(".sortable > div > .card").addClass("cardEditState").removeClass('shadow');
            sortableInstance = new Sortable(sortableList[0], {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.dragHandle',
            });
        });

        $(document).on('click', '.saveThumbnailLayout', function() {
            $('.customizeThumbnailLayout').show();
            $('.saveThumbnailLayout').hide();
            $('.cancelThumbnailLayout').hide();
            $('.thumbnailDropdownMenu').hide();

            $('.dragHandle, .widthResizeHandle, .heightResizeHandle').hide();
            $(".sortable > div > .card").removeClass("cardEditState").addClass('shadow');

            let newLayoutOptionIDs = [];
            sortableList.children(':visible').each(function(index) {
                let id = $(this).data("id");
                let thumbnailGraphState = $(this).find('.thumbnailGraphDisplay').css('display');
                newLayoutOptionIDs.push({
                    id: id,
                    width: $(this).find('.card').css("width"),
                    colWidth: $(this).css("width"),
                    height: $(this).find('.card').css("height"),
                    graphDisplayState: thumbnailGraphState
                });
            });

            console.log(newLayoutOptionIDs);

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

        $(document).on('click', '.cancelThumbnailLayout', function() {
            $('.customizeThumbnailLayout').show();
            $('.saveThumbnailLayout').hide();
            $('.cancelThumbnailLayout').hide();
            $('.thumbnailDropdownMenu').hide();

            $('.dragHandle, .widthResizeHandle, .heightResizeHandle').hide();
            $(".sortable > div > .card").removeClass("cardEditState").addClass('shadow');

            thumbnailMasonry = new Masonry(document.getElementById('thumbnailMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
        });

        $('.widthResizeHandle').on('mousedown', function(e) {
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

        $('.heightResizeHandle').on('mousedown', function(e) {
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

    $('#dashboardThumbnailWidgetSettingsModal').on('show.bs.modal', function(e) {
        thumbnailMasonry.destroy();
    });

    $('#dashboardThumbnailWidgetSettingsModal').on('hide.bs.modal', function(e) {
        thumbnailMasonry = new Masonry(document.getElementById('thumbnailMasonry'), {
            percentPosition: true,
            horizontalOrder: true,
        });
    });
</script>