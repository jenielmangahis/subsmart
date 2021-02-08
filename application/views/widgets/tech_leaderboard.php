<div class="col-lg-3 col-md-6 col-sm-12"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header">
            <i class="fa fa-mouse-pointer" aria-hidden="true"></i> Tech Leaderboard
        </div>
        <div class="card-body" style="padding:5px 10px;">
            <div class="row" id="techLeaderBoardBody" style="height: 310px; overflow-y: scroll">
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
