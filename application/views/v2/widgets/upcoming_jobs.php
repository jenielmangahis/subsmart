<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Upcoming Jobs</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>job">
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
                $jobs_limit = 4;
                $jobs_count = 0;
                foreach ($upcomingJobs as $jb) :
                    if ($jobs_count < $jobs_limit) {
            ?>
                        <div class="widget-item cursor-pointer" onclick="location.href='<?php echo base_url('job/new_job1/' . $jb->id); ?>'">
                            <div class="nsm-list-icon">
                                <i class='bx bx-calendar'></i>
                            </div>
                            <div class="content ms-2">
                                <div class="details">
                                    <span class="content-title"><?php echo $jb->job_type . ' - ' . $jb->tags_name; ?></span>
                                    <span class="content-subtitle d-block mb-1"><?= ucfirst($jb->first_name) . ' ' . ucfirst($jb->last_name); ?></span>
                                    <span class="content-subtitle d-block"><?= $jb->mail_add . ' ' . $jb->cust_city . ' ' . $jb->cust_state . ' ' . $jb->cust_zip_code; ?></span>
                                </div>
                                <div class="controls">
                                    <span class="nsm-badge primary"><?php echo ucfirst($jb->status); ?></span>
                                    <span class="content-subtitle d-block mt-1"><?= date('F d, Y', strtotime($jb->start_date)) ?> <?php echo date('g:i A', strtotime($jb->start_time)); ?>-<?php echo date('g:i A', strtotime($jb->end_time)); ?></span>
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