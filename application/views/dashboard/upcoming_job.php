<div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3 short_id" id="upcoming_job">
    <div class="c65 c61">
        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                <div class="MuiCardHeader-avatar">
                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                        <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
                    </svg>
                </div>
                <div class="MuiCardHeader-content" >
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss56">Upcoming jobs</span>
                                    </h6>
                                </span>
                </div>
                <div class="MuiCardHeader-action">
                                <span class="jss57">
                                    <a class="MuiButtonBase-root MuiIconButton-root" tabindex="0" aria-disabled="false" href="/pro/new_job">
                                        <span class="MuiIconButton-label">
                                            <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;">
                                                <path d="M21.117,17.975l-7.758-7.757c0.768-1.96,0.342-4.262-1.278-5.882C10.376,2.63,7.819,2.29,5.773,3.228l3.666,3.665 L6.881,9.45L3.13,5.785c-1.023,2.046-0.597,4.603,1.108,6.308c1.62,1.619,3.921,2.046,5.882,1.278l7.758,7.758 c0.341,0.34,0.853,0.34,1.193,0l1.96-1.961C21.458,18.827,21.458,18.23,21.117,17.975z"></path>
                                                <path d="M6,18v-3H4v3H1v2h3v3h2v-3h3v-2H6z"></path>
                                            </svg>
                                        </span>
                                        <span class="MuiTouchRipple-root"></span>
                                    </a>
                                </span>
                </div>
            </div>
            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
            <div class="MuiCardContent-root jss60" style="height: 260px;">
                <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">
                        <a class="MuiButtonBase-root MuiButton-root jss107 MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="job/new_job?job_num=1000">
                                        <span class="MuiButton-label">
                                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                <?php $jobCounter=0;?>
                                                <?php foreach($job as $jb) : ?>
                                                    <?php if(check_upcoming_date($jb->created_date)): ?>
                                                        <?php $jobCounter++;?>
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="margin-bottom: 5px;"><?php echo get_format_date_with_day($jb->created_date); ?></h6>
                                                        <div class="MuiGrid-root MuiGrid-container">
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3" style="padding-right: 8px;">
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo get_format_time($jb->created_date); ?></h6>
                                                        <div class="MuiGrid-root MuiGrid-container" style="margin-top: 5px; margin-bottom: 5px;">
                                                            <div class="MuiGrid-root jss110 MuiGrid-item MuiGrid-grid-xs-12">
                                                                <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap MuiTypography-alignCenter" style="color: rgb(33, 150, 243);"><?php echo strtoupper($jb->status); ?></div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap">Arrival window:</div>
                                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap"><?php echo get_format_time($jb->created_date); ?>-<?php echo get_format_time_plus_hours($jb->created_date); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-7" style="border-left: 0.1em solid rgb(234, 234, 234); padding-left: 8px;">
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo strtoupper($jb->job_name); ?> </h6>
                                                        <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"><?php echo get_customer_by_id($jb->customer_id); ?></p>
                                                        <div>
                                                            <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"><?php echo strtoupper($jb->job_location); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1" style="margin-left: 5px; display: flex; justify-content: center;">
                                                        <div class="MuiAvatar-root MuiAvatar-circle" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                                            <img alt="Garrett Rickman" src="assets/img/customer_sm.png" class="MuiAvatar-img">
                                                        </div>
                                                    </div>
                                                </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php if($jobCounter == 0) : ?>
                                                    <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700; margin: auto; padding-top: 100px;">NO JOBS YET</h6>
                                                <?php endif; ?>
                                            </div>
                                        </span>
                            <span class="MuiTouchRipple-root"></span>
                        </a>
                    </div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                    </div>
                </div>
            </div>
            <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                <div style="margin: auto;">
                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="<?php echo url('job') ?>">
                        <?php if($jobCounter > 0) : ?>
                            <span class="MuiButton-label">SEE ALL JOBS</span>
                        <?php endif; ?>
                        <span class="MuiTouchRipple-root"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
