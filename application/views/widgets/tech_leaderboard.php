<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-mouse-pointer" aria-hidden="true"></i> Tech Leaderboard
    </div>

    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="techLeaderBoardBody" style="<?= $height; ?> overflow-y: scroll">
                    <div class="col-lg-12">
                        <h6 class="text-center">All Time</h6>

                        <div class="col-lg-12 float-left">
                            <img src="<?php echo userProfileImage($emp->id) ?>" alt="user" class="rounded-circle float-left mr-2" style="height: 50px;">
                            <div class="progress col-lg-8 no-padding mt-3 float-left" style="height: 20px;">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="text-left ml-2">$0</div>
                                </div>
                            </div>
                            <div class="float-right col-lg-2 no-padding mt-3">0 Jobs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
