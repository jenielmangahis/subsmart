<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-lg-12">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Customer Status</span>
        </div>
        <div class="nsm-card-controls">
            <!--<a role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
                See More
            </a>-->
            <a href="<?= base_url('customer') ?>" role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
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
    <div class="nsm-card-content jobs_stat">
        <div class="nsm-widget-table">
            <div class="stat_content">
                <div class="row row-pad">
                    <div class="col">
                        <div class="row">
                            <div class="col-9">
                                <h6>Customer Status</h6>
                            </div>
                            <div class="col-3" style="text-align: center;">
                                <h6>Count</h6>
                            </div>
                        </div>
                    </div>
                    <?php foreach($customerStatus as $status): ?>
                    <div class="row js-row-dash">
                        <div class="col">
                            <div class="row">
                                <div class="col-9 marg-top">
                                    <div class="jname"> <?= $status->status ? $status->status : 'Pending' ; ?></div>
                                </div>
                                <div class="col-3 col-center">
                                    <div class="row">
                                        <div class="col col-align">
                                            <span class="nsm-badge success" style="font-size:12px;"><?= $status->statusCount; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>