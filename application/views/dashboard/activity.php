<?php
defined('BASEPATH') or exit('No direct script access allowed');
$sql ="SELECT * FROM esign_activity where user_id = ".logged('id')." ORDER BY createdAt DESC LIMIT 10";
$response = $this->db->query($sql)->result();
?>
<div class="col-xl-4 ui-state-default db-card" id="activity">
    <div class="card tile-container" style="top:0px; margin-bottom: 30px; height:auto;">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-4" style="border-bottom:1px solid gray; padding-bottom:15px;"><i class="fa fa-tag" aria-hidden="true"></i> Activity</h4>
            <ol class="activity-feed mb-0">
                <?php
                foreach($response as $res){
                ?>
                    <li class="feed-item">
                        <div class="feed-item-list"><span class="date"><?=$res->createdAt?></span> 
                        <span class="activity-text"><?=$res->activity?></span></div>
                    </li>
                <?php
                }
                ?>
            </ol>
            <?php if(sizeof($response) > 9){ ?>
            <div class="text-center"><a  class="btn btn-primary" style="color:#FFFFFF !important;">Load More</a></div>
            <?php } ?>
        </div>
    </div>
</div>