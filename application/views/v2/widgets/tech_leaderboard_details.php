<?php
if (count($tech_leaderboard) > 0) :
    foreach ($tech_leaderboard as $tech) :
?>
        <div class="widget-item">
            <?php
            $image = userProfilePicture($tech->id);
            if (is_null($image)) :
            ?>
                <div class="nsm-profile">
                    <span><?php echo getLoggedNameInitials($tech->id); ?></span>
                </div>
            <?php
            else :
            ?>
                <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
            <?php
            endif;
            ?>
            <div class="content">
                <div class="details">
                    <span class="content-title"><?= $tech->FName . ' ' . $tech->LName ?></span>
                    <span class="content-subtitle d-block"><?= $tech->email ?></span>
                </div>
                <div class="controls">
                    <span class="content-subtitle d-block nsm-text-success fw-bold"><?= $tech->totalJobs; ?> <?= $tech->totalJobs > 1 ? ' Jobs' : ' Job'; ?></span>
                </div>
            </div>
        </div>
    <?php
    endforeach;
else :
    ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Tech leaderboard is empty.</span>
    </div>
<?php
endif;
?>