<?php
if (count($salesLeaderBoards) > 0) :
    $count = 0;
    foreach ($salesLeaderBoards as $sales) :
?>
        <?php 
            if( $count > 10 ){
                break;
            }   
        
        ?>
        <div class="widget-item">
            <?php
            $image = userProfilePicture($sales['uid']);
            if (is_null($image)) :
            ?>
                <div class="nsm-profile">
                    <span><?php echo getLoggedNameInitials($sales['uid']); ?></span>
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
                    <span class="content-title"><?= $sales['name']; ?></span>
                    <span class="content-subtitle d-block"><?= $sales['email'] ?></span>
                </div>
                <div class="controls">
                    <span class="content-subtitle d-block nsm-text-success fw-bold">$<?= number_format($sales['total_sales'],2); ?></span>
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
        <span>Sales Leaderboard is empty.</span>
    </div>
<?php
endif;
?>