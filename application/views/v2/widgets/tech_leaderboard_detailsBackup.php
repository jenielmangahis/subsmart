<?php
if (count($techLeaderBoards) > 0) :
    $count = 0;
    foreach ($techLeaderBoards as $tech) :
?>
        <?php 
            if( $count > 10 ){
                break;
            }   
        
        ?>
        <div class="widget-item">
            <?php
            $image = userProfilePicture($tech['uid']);
            if (is_null($image)) :
            ?>
                <div class="nsm-profile">
                    <span><?php echo getLoggedNameInitials($tech['uid']); ?></span>
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
                    <span class="content-title"><?= $tech['name']; ?></span>
                    <span class="content-subtitle d-block"><?= $tech['email'] ?></span>
                </div>
                <div class="controls">
                    <span class="content-subtitle d-block nsm-text-success fw-bold"><?= $tech['total_jobs']; ?> <?= $tech['total_jobs'] > 1 ? ' Jobs' : ' Job'; ?></span>
                </div>
            </div>
        </div>
    <?php
    $count++;
    endforeach;
else :
    ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Tech Leaderboard is empty.</span>
    </div>
<?php
endif;
?>