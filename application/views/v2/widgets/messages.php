<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Messages</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>">
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
        <!-- <div class="nsm-widget-table">
            <div class="widget-item">
                <div class="nsm-profile">
                    <span>JD</span>
                </div>
                <div class="content nsm-messages">
                    <div class="details">
                        <span class="content-title">John Doe</span>
                        <span class="content-subtitle d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </div>
                    <div class="controls">
                        <span class="content-subtitle d-block">09/21/2021 7:00 PM</span>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="nsm-empty">
            <i class='bx bx-meh-blank'></i>
            <span>Message list is empty.</span>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>