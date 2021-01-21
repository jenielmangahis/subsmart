<div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="tech_leaderbord">
    <div class="c65 c61">
        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                <div class="MuiCardHeader-avatar">
                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"></path>
                    </svg>
                </div>
                <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss99">Tech leaderboard</span>
                                    </h6>
                                </span>
                </div>
            </div>
            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
            <div class="MuiCardContent-root jss60" style="height: 309px;">
                <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1">
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="text-align: center;">
                        <h6 class="MuiTypography-root MuiTypography-subtitle1">All Time</h6>
                    </div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                        <?php $empCounter=0;?>
                        <?php foreach($users as $emp): ?>
                            <?php if($empCounter < 4): ?>
                                <?php $empCounter++;?>
                                <div class="MuiGrid-root MuiGrid-container MuiGrid-align-items-xs-center">
                                    <div class="MuiGrid-root jss96 MuiGrid-item MuiGrid-grid-xs-9">
                                        <div class="MuiAvatar-root MuiAvatar-circle jss94" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                            <img src="<?php echo userProfileImage($emp->id) ?>" alt="user" class="rounded-circle" style="height: 50px;">
                                        </div>
                                        <div style="width: 99.9829%;" class="jss97">
                                            <p class="MuiTypography-root jss98 MuiTypography-body1">$0</p>
                                        </div>
                                    </div>
                                    <div class="MuiGrid-root jss95 MuiGrid-item MuiGrid-grid-xs-3">0 jobs</div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
