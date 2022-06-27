<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Bank Accounts</span>
        </div>
        <div class="nsm-card-controls">
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
            <?php foreach($accounts as $account) : ?>
                <div class="widget-item">
                    <div class="nsm-list-icon">
                        <i class='bx bx-building-house'></i>
                    </div>
                    <div class="content ms-2">
                        <div class="details">
                            <span class="content-title mb-1"><?=$account->name; ?></span>
                            <span class="content-subtitle d-block">Bank balance: $0.00</span>
                            <span class="content-subtitle d-block">In nSmartrac: <?=str_replace("$-", "-$", '$'.number_format(floatval($account->balance), 2, '.', ','))?></span>
                        </div>
                        <div class="controls">
                            <!-- <span class="nsm-badge">Updated 1 day ago</span> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- <div class="widget-item">
                <div class="nsm-list-icon">
                    <i class='bx bx-wallet'></i>
                </div>
                <div class="content ms-2">
                    <div class="details">
                        <span class="content-title mb-1">Cash on hand</span>
                        <span class="content-subtitle d-block"></span>
                        <span class="content-subtitle d-block">In nSmartrac: $111,101.00</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge">Updated</span>
                    </div>
                </div>

            </div>
            <div class="widget-item">
                <div class="nsm-list-icon">
                    <i class='bx bx-building-house'></i>
                </div>
                <div class="content ms-2">
                    <div class="details">
                        <span class="content-title mb-1">Corporate Account (XXXXXX 5850)</span>
                        <span class="content-subtitle d-block"></span>
                        <span class="content-subtitle d-block">In nSmartrac: $0</span>
                    </div>
                    <div class="controls">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>