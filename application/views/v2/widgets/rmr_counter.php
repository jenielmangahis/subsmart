<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
$category = "rmr";
$thumbanailName = "Recurring Monthly Revenue";
$description = "Recurring Monthly Revenue tracks consistent income from subscriptions. This card displays the total revenue generated from recurring payments.";
$icon = '<i class="fas fa-money-bill-wave-alt"></i>';
?>
<style> .display_none { display: none; }</style>
<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo $icon; ?>&nbsp;&nbsp;<?php echo $thumbanailName; ?> <span class="badge bg-secondary position-absolute opacity-25">Thumbnail</span>
                    </a>
                    <div class="dropdown float-end">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="removeThumbnail('<?php echo $id; ?>');">Remove Thumbnail</a>
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
        <div class="row">
            <div class="col textData_<?php echo $id; ?> <?php echo $isListView == 1 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">TOTAL RECURRING PAYMENT</strong>
                    <h2 id="first_content_<?php echo $id; ?>"><?php echo '$'.number_format($total_recurring_payment->SUM_RECURRING_PAYMENT, 2); ?></h2>
                </div>
            </div>
        </div>
        <strong class="thumbnailDragHandle">⣿⣿⣿⣿</strong>
        <span class="thumbnailWidthResizeHandle"></span>
        <span class="thumbnailHeightResizeHandle"></span>
    </div>
</div>
<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
?>