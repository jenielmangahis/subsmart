<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Upcoming Calendar</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>events">
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
            if ($upcomingJobs) {
                $event_limit = 4;
                $event_count = 0;
                foreach ($upcomingEvents as $event) :
                    if ($event_count < $event_limit) {
            ?>
                        <div class="widget-item cursor-pointer" onclick="location.href='<?php echo base_url('events/event_preview/' . $jb->id); ?>'">
                            <div class="nsm-list-icon secondary">
                                <i class='bx bx-calendar-star'></i>
                            </div>
                            <div class="content ms-2">
                                <div class="details">
                                    <span class="content-title"><?php echo $event->event_number . ' : ' . $event->event_type . ' - ' . $event->event_tag; ?></span>
                                    <span class="content-subtitle d-block mb-1"><?= $event->event_description; ?></span>
                                    <span class="content-subtitle d-block"><?= $event->event_address ?></span>
                                </div>
                                <div class="controls">
                                    <span class="nsm-badge secondary"><?php echo ucfirst($event->status); ?></span>
                                    <span class="content-subtitle mt-1 d-block text-uppercase"><?php echo get_format_time($jb->date_created); ?>-<?php echo get_format_time_plus_hours($jb->date_created); ?></span>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    $jobs_count++;
                endforeach;
            } else {
                ?>
                <div class="nsm-empty">
                    <i class='bx bx-meh-blank'></i>
                    <span>Jobs list is empty.</span>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>