<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;

function formatEstimateNumber($number) {
    if (strpos(strtoupper($number), 'EST-') !== 0) {
        return $number;
    }

    $numericPart = (int) str_replace('EST-', '', $number);
    return 'EST-' . str_pad($numericPart, 7, '0', STR_PAD_LEFT);
}
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Open Estimates</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url("estimate") ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="nsm-widget-table">
            <?php
            if ($estimates) :
                $estimate_limit = 5;
                $estimate_count = 0;
                foreach ($estimates as $estimate) :
                    switch ($estimate->status):
                        case 'Submitted':
                            $class = "primary";
                            break;
                        case 'Draft':
                            $class = "default";
                            break;
                        case 'Accepted':
                            $class = "success";
                            break;
                        default:
                            $class = "default";
                            break;
                    endswitch;

                    if ($estimate_count < $estimate_limit) :
            ?>
                        <div class="widget-item">
                            <div class="content">
                                <div class="details">
                                    <span class="content-title"><?php echo formatEstimateNumber($estimate->estimate_number); ?> </span>
                                    <span class="content-subtitle d-block"><?php if($estimate->grand_total == NULL || $estimate->grand_total == 0){ echo '$0.00';}else{ echo currency($estimate->grand_total);  } ?></span>
                                </div>

                                <div class="controls">
                                    <span class="nsm-badge <?= $class ?>"><?php echo ucwords($estimate->status); ?></span>
                                    <span class="content-subtitle mt-1 d-block">Last Update: <?php echo date('F d, Y', strtotime($estimate->updated_at)); ?></span>
                                </div>
                            </div>
                        </div>

                <?php
                    endif;
                    $estimate_count++;
                endforeach;
            else :
                ?>
                <div class="nsm-empty">
                    <i class='bx bx-meh-blank'></i>
                    <span>Open estimate list is empty.</span>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>