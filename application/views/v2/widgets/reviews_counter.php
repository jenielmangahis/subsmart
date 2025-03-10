<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
$category = "reviews";
$thumbanailName = "Reviews";
$description = "Boost your business with Google Reviews. From being found online to earning trust, reviews are a proven source of new business.";
$icon = '<i class="fas fa-star"></i>';
?>
<style> .display_none { display: none; }</style>
<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="#" style="color:#6a4a86 !important">
                        <?php echo $icon; ?>&nbsp;&nbsp;<?php echo $thumbanailName; ?>
                    </a>
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="removeThumbnail('<?php echo $id; ?>');">Remove Thumbnail</a>
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
        <!-- <div class="row">
            <div class="col textData_<?php echo $id; ?> <?php echo $isListView == 1 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">DATA</strong>
                    <h2 id="first_content_<?php echo $id; ?>"></h2>
                </div>
            </div>
        </div> -->
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>
<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
?>