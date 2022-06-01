<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<?php $var = logged('company_id');
$widget_name = "";
if ($var == 1) {
    $widget_name = "Customer";
}else{
    $widget_name = "Recent Customer";
}

?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><?= $widget_name; ?></span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?><?php if($var==1){echo "customer";}else{echo "job";} ?>">
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
                if ($var != 1) :
                    if ($upcomingJobs) :
                        foreach ($upcomingJobs as $jb) :?>
                            <div class="widget-item cursor-pointer" onclick="location.href='<?php echo base_url('customer/module/' . $jb->prof_id); ?>'">
                                <div class="nsm-profile">
                                <span><?= strtoupper($jb->last_name[0].''.$jb->first_name[0]) ?></span>
                                </div>
                                <div class="content ms-2">
                                    <div class="details">
                                        <span class="content-title"><?php echo $jb->last_name . ', ' . $jb->first_name; ?></span>
                                        <span class="content-subtitle d-block"><?= $jb->city . ', ' . $jb->state . ' ' . $jb->zip_code; ?></span>
                                    </div>
                                    <div class="controls">
                                        <span class="nsm-badge primary"><?= $jb->status ? $jb->status : 'Pending'; ?></span>
                                        <span class="content-subtitle d-block mt-1"><?= $jb->email ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <div class="nsm-empty">
                            <i class='bx bx-meh-blank'></i>
                            <span>Jobs list is empty.</span>
                        </div>
                        <?php
                    endif;
                else: ?>
                    <?php foreach ($companies as $comp) :?>
                        <div class="widget-item cursor-pointer">
                            <div class="nsm-list-icon">
                                <i class='bx bx-fw bx-buildings'></i>
                            </div>
                            <div class="content ms-2">
                                <div class="details">
                                    <span class="content-title"><?= $comp->business_name ?></span>
                                    <span class="content-subtitle d-block mb-1"><?= $comp->website ?></span>
                                    <span class="content-subtitle d-block"><i>Since</i> <?= $comp->year_est ?></span>
                                </div>
                                <div class="controls">
                                    <span class="nsm-badge primary"></span>
                                    <span class="content-subtitle d-block mt-1"><?= $comp->business_email ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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