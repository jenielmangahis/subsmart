<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header" id="discover_more_widget">
        <div class="nsm-card-title">
            <span>Discover More</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .adCarouselIndicators [data-bs-target] {
            border-radius: 100%;
            width: 12px;
            height: 12px;
        }
    </style>

    <div class="nsm-card-content adbanner_card">
        <div id="discover_carousel" class="carousel slide h-100 pb-4" data-bs-ride="carousel">
            <div class="carousel-indicators adCarouselIndicators d-flex"></div>
            <div class="carousel-inner adCarouselContent h-100"></div>
        </div>
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
                                    <video class="rounded mx-auto d-block w-100" autoplay muted loop>
                                        <source src="${window.origin}/uploads/BusinessBanner/${banner.file}" type="video/${fileExtension}">
                                        Your browser does not support the video tag.
                                    </video>
                                `;
                            } else {
                                mediaContent = `
                                    <img src="${window.origin}/uploads/BusinessBanner/${banner.file}" 
                                         class="rounded mx-auto d-block w-100" alt="${banner.title}">
                                `;
                            }

                            inner.append(`
                                <div class="carousel-item h-100 ${activeClass}" data-bs-interval="${duration}">
                                    <div class="row">
                                        <div class="col-12">
                                            ${mediaContent}
                                        </div>
                                    </div>
                                    <div class="row h-100 mt-3 mb-3">
                                        <div class="col-12 col-md-7 order-last order-md-first">
                                            <span class="content-title mb-2">${banner.title}</span>
                                            <span class="content-subtitle d-block mb-2">${banner.description}</span>
                                            <a href="${link}" target="_blank" class="content-subtitle nsm-link d-block">${banner.url_alias}</a>
                                        </div> 
                                    </div>
                                </div>
                            `);
                        }
                    });
                }
            },
        });
    });   
</script>


<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>
