<div class="col-lg-12">
    <h6 class="text-center">All Time</h6>
    <?php foreach($tech_leaderboard as $tech): ?>
    <div class="col-lg-12 float-left techLeadDetails">
        <img title="<?= $tech->FName.' '.$tech->LName ?>" src="<?php echo userProfileImage($tech->id) ?>" alt="user" class="rounded-circle float-left mr-2" style="height: 30px; width: 30px;">
        <div class="progress col-lg-8 no-padding float-left" style="height: 20px;padding: 1px 0 0 5px;margin-top: 5px ;">
            <?= $tech->FName.' '.$tech->LName ?>
        </div>
        <div class="jobs float-right col-lg-2 no-padding" style="padding: 1px 0 0 5px;margin-top: 5px ;"><?= $tech->totalJobs; ?> <?= $tech->totalJobs > 1 ? ' Jobs':' Job'; ?> </div>
    </div>
    <?php endforeach ?>
</div>