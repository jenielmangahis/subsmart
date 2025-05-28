<?php
    $id = trim($thumbnailsWidgetCard->id);
    $title = trim($thumbnailsWidgetCard->title);
    $description = trim($thumbnailsWidgetCard->description);
    $icon = trim($thumbnailsWidgetCard->icon);
    $type = trim($thumbnailsWidgetCard->type);
    $category = trim($thumbnailsWidgetCard->category);
?>
<style>
    .contentDescription {
        white-space: normal;
        font-size: unset;
    }

    .adFonts {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .adTitle {
        font-size: 15px;
    }

    .adSubTitleIcon {
        color:#6a4a86 !important
    }

    .adDescription {
        white-space: normal;
    }

    .adFooterDiv {
        background: #f0f2f5; 
        padding: 10px;
    }

    .adLinkAlias {
        font-size: 15px;
    }

    .adLearnMoreButton {
        /* opacity: 0.5;  */
        position: absolute;
        right: 10px;
    }
</style>
<div class='card shadow widgetBorder <?php echo "card_$category$id "; ?>'>
    <div class="card-body">
        <!-- <div class="row">
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
        </div> -->
        <!-- <div class="row mb-2">
            <div class="col-md-12">
                <span><?php echo $description; ?></span>
            </div>
        </div> -->
        <div class="row">
            <div class="col text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="nsm-card-content adbanner_card">
                    <div id="discover_carousel" class="carousel slide h-100" data-bs-ride="carousel">
                        <!-- <div class="carousel-indicators adCarouselIndicators d-flex"></div> -->
                        <div class="carousel-inner adCarouselContent h-100"></div>
                    </div>
                </div>
            </div>
            <div class="col mt-2 <?php echo "graphLoaderContainer_$id"; ?> graphLoader">
                <div class="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <strong class="widgetDragHandle">⣿⣿⣿⣿</strong>
        <span class="widgetWidthResizeHandle"></span>
        <span class="widgetHeightResizeHandle"></span>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/AdBanner/getAllBanners`,
            dataType: "JSON",
            success: function(response) {
                if (response == 0) {
                    $('.adbanner_card').parent().hide();
                } else {
                    let indicators = $(".adCarouselIndicators");
                    let inner = $(".adCarouselContent");

                    const acceptedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'wmv'];

                    response.forEach((banner, index) => {
                        let activeClass = index === 0 ? "active" : "";
                        indicators.append(`
                            <button type="button" data-bs-target="#discover_carousel" 
                                    data-bs-slide-to="${index}" class="${activeClass}" 
                                    aria-label="Slide ${index + 1}"></button>
                        `);

                        let duration = parseInt(banner.duration.replace("duration_", "").replace("sec", "")) * 1000 || 3000;

                        let link = banner.link;
                        if (!link.startsWith("http://") && !link.startsWith("https://")) {
                            link = "https://" + link;
                        }

                        let fileExtension = banner.file.split('.').pop().toLowerCase();

                        if (acceptedExtensions.includes(fileExtension)) {
                            let mediaContent;

                            if (['mp4', 'avi', 'mov', 'wmv'].includes(fileExtension)) {
                                mediaContent = `
                                    <video class="rounded img-fluid w-100" autoplay muted loop>
                                        <source src="${window.origin}/uploads/BusinessBanner/${banner.file}" type="video/${fileExtension}">
                                        Your browser does not support the video tag.
                                    </video>
                                `;
                            } else {
                                mediaContent = `
                                    <img class="rounded img-fluid w-100" src="${window.origin}/uploads/BusinessBanner/${banner.file}" alt="${banner.title}">
                                `;
                            }

                            inner.append(`
                                <div class="carousel-item h-100 ${activeClass}" data-bs-interval="${duration}">
                                    <div class="row">
                                        <div class="container-fluid adFonts">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="fw-normal" style="font-size: 15px;">${banner.title}</label> 
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="text-muted">Feature</label> <i class="fas fa-ad fs-5 adSubTitleIcon"></i> 
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <span class="adDescription">${banner.description}</span>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    ${mediaContent}
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between align-items-center adFooterDiv">
                                                        <div>
                                                            <small class="text-muted">NO CREDIT CARD REQUIRED. CANCEL ANYTIME.</small><br>
                                                            <span class="fw-normal adLinkAlias">${banner.url_alias}</span>
                                                        </div>
                                                        <a class="btn btn-secondary fw-bold adLearnMoreButton" href="${link}" target="_blank">LEARN MORE</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    });
                }
                setTimeout(() => {
                    $('.<?php echo "textDataContainer_$id"; ?>').show();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
                }, 500);
            },
        });

        $('#discover_carousel').on('slid.bs.carousel', function (e) {
            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
        });
    });   
</script>