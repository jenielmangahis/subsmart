<div class="col-lg-12">
    <h6 class="text-center">All Time</h6>
    <?php foreach($tech_leaderboard as $tech): ?>
    <div class="col-lg-12 float-left techLeadDetails">
        <img title="<?= $tech->FName.' '.$tech->LName ?>" src="<?php echo userProfileImage($tech->id) ?>" alt="user" class="rounded-circle float-left mr-2" style="height: 30px; width: 30px;">
        <div class="progress col-lg-8 no-padding mt-3 float-left" style="height: 20px;">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo ($tech->id==105?'100%':'10%') ?>" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                <div class="text-left ml-2"><?php echo ($tech->id==105?'$9,980.00':0) ?></div>
            </div>
        </div>
        <div class="jobs float-right col-lg-2 no-padding mt-3"><?php echo ($tech->id==105?'1':0) ?> Jobs</div>
    </div>
    <?php endforeach ?>
</div>