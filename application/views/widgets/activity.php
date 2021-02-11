<div class="col-lg-3 col-md-6 col-sm-12"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #fff4e6;">
            <i class="fa fa-tasks" aria-hidden="true"></i> Activity
        </div>
        <div class="card-body" style="padding:5px 10px;">
            <div class="row" style="height: 310px; overflow-y: scroll">
                <div class="col-lg-12 text-center">
                    <h5 class="mt-5">Activity Here</h5>
                </div>
                
<!--                <ul class="timeline" id="activityBody">
                    <?php
                        if (!empty($activity_list)) {
                            foreach ($activity_list as $al) {
                                ?>
                                <li class="timeline-item">
                                    <p class="timeline-content"><?= $al['activity'] ?></p>
                                    <p class="event-time"><?= $al['createdAt'] ?></p>
                                </li>
                            <?php
                            }
                        }
                        ?>
                </ul>-->
            </div>
            <div class="text-center">
                <a class="text-info" href="#">Load More</a>
            </div>

        </div>

    </div>
</div>
