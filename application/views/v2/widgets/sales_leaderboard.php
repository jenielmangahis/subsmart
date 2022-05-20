<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<style>
    .nsm-card .nsm-card-content.wow {
    display: block;
    height: 50px;
}
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Sales Leaderboard</span>
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
    <?php

     for ($x = 0; $x < count($salesLeaderboard); $x++) {
    // ?>
         <?php if(!empty($salesLeaderboard[$x][0])): ?>
    <!--    <div class="nsm-card-content wow">
    //         <div class="nsm-widget-table">
    //             <div class="widget-item">
    //                 <div class="nsm-profile">
    //                     <span><?= $salesLeaderboard[$x][0];  ?></span>
    //                 </div>
    //                 <div class="content">
    //                     <div class="details">
    //                         <span class="content-title"><?php echo $salesLeaderboard[$x][1];  ?></span>
    //                         <span class="content-subtitle d-block"><?php echo $salesLeaderboard[$x][2];  ?></span>
    //                     </div>
    //                     <div class="controls">
    //                         <span class="content-subtitle d-block nsm-text-success fw-bold">+<?php echo $salesLeaderboard[$x][3];  ?> Sale</span>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     </div> -->
      <?php endif; ?>
  <?php } ?>

    <div class="nsm-card-content jobs_stat">
        <div class="nsm-widget-table">
            <div class="widget-item">
                <div class="nsm-profile">
                    <span>WH</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Welyelf Hisula</span>
                        <span class="content-subtitle d-block">Sales Rep</span>
                    </div>
                    <div style="padding-top: 5px;">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$10.25</span>
                        <span class="content-subtitle d-block">revenue</span>
                        </div>
                    <div class="controls">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">50</span>
                        <span class="content-subtitle d-block">customers</span>
                    </div>
                </div>
            </div>

            <div class="widget-item">
                <div class="nsm-profile">
                    <span>BR</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Bryann Revina</span>
                        <span class="content-subtitle d-block">Sales Rep</span>
                    </div>
                    <div style="padding-top: 5px;">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$1,500.35</span>
                        <span class="content-subtitle d-block">revenue</span>
                        </div>
                    <div class="controls">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">1502</span>
                        <span class="content-subtitle d-block">customers</span>
                    </div>
                </div>
            </div>

            <div class="widget-item">
                <div class="nsm-profile">
                    <span>BR</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Tommy Nguyen</span>
                        <span class="content-subtitle d-block">Sales Rep</span>
                    </div>
                    <div style="padding-top: 5px;">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$0.00</span>
                        <span class="content-subtitle d-block">revenue</span>
                        </div>
                    <div class="controls">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">1</span>
                        <span class="content-subtitle d-block">customers</span>
                    </div>
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