<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
$category = "coupon_codes";
$thumbanailName = "Coupon Codes";
$description = "Coupons provide discounts or promotions on purchases. This card displays the total count of used and unused coupon codes.";
$icon = '<i class="fas fa-ticket-alt"></i>';
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
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeThumbnail('<?php echo $id; ?>');">Remove Thumbnail</a></li>
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
                <select class="form-select w-100" onChange="filterThumbnail(this.value, '<?php echo $id; ?>', '<?php echo $category; ?>')">
                    <option value="all">All time</option>
                    <option value="week">Last 7 days</option>
                    <option value="two-week">Last 14 days</option>
                    <option value="month">Last 30 days</option>
                    <option value="two-month">Last 60 days</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">TOTAL USED</strong>
                    <h2 id="first_content_<?php echo $id; ?>" class="mb-0"><?php echo count($used_offer_codes); ?></h2>
                </div>
            </div>
            <div class="col">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">TOTAL UNUSED</strong>
                    <h2 id="second_content_<?php echo $id; ?>" class="mb-0"><?php echo count($not_used_offer_codes); ?></h2>
                </div>
            </div>
        </div>
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>
<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
?>
<script>
$(function(){
    $('#widget-used-codes').on('click', function(){
        $('#modal-coupon-codes').modal('show');

        $.ajax({
            url: base_url + 'dashboard/_coupon_codes/used',
            method: 'post',
            success: function(response) {
                $('#widget-coupon-code-list-container').html(response);
            },
            beforeSend: function(){
                $('#widget-coupon-code-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#widget-available-codes').on('click', function(){
        $('#modal-coupon-codes').modal('show');

        $.ajax({
            url: base_url + 'dashboard/_coupon_codes/available',
            method: 'post',
            success: function(response) {
                $('#widget-coupon-code-list-container').html(response);
            },
            beforeSend: function(){
                $('#widget-coupon-code-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>