<div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3 short_id" id="item_2">
    <div class="c65 c61">
        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                <div class="MuiCardHeader-avatar">
                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                    </svg>
                </div>
                <div class="MuiCardHeader-content">
                    <span class="">
                        <h6 class="MuiTypography-root MuiTypography-subtitle1">
                            <span class="jss55 jss62">Open estimates</span>
                        </h6>
                    </span>
                </div>
                <div class="MuiCardHeader-action">
                    <span title="Add estimate" class="jss57">
                        <a class="MuiButtonBase-root MuiIconButton-root" tabindex="0" aria-disabled="false" href="/pro/new_estimate">
                            <span class="MuiIconButton-label">
                                <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;">
                                <path d="M6,18v-3H4v3H1v2h3v3h2v-3h3v-2H6z"></path>
                                <g>
                                <path d="M19.001,2.939h-4.179c-0.42-1.087-1.519-1.875-2.819-1.875c-1.299,0-2.399,0.787-2.819,1.875H5.004c-1.1,0-2,0.844-2,1.875 V13h2V4.813h2v2.812h9.997V4.813h2v14.997H11v1.875h8.001c1.099,0,1.999-0.844,1.999-1.875V4.813C21,3.783,20.1,2.939,19.001,2.939 z M12.003,4.813c-0.549,0-1-0.422-1-0.937c0-0.516,0.451-0.938,1-0.938c0.551,0,0.999,0.422,0.999,0.938 C13.002,4.392,12.554,4.813,12.003,4.813z"></path>
                                </g>
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
                        <?php $estCounter = 0; ?>
                        <?php
                        if ($estimate) {
                            foreach ($estimate as $est) :
                                ?>
                                <?php if ($estCounter < 2) : ?>
            <?php $estCounter++; ?>
                                    <a class="MuiButtonBase-root MuiButton-root jss107 MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="/pro/estimates/new/60749141">
                                        <span class="MuiButton-label">
                                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="margin-bottom: 5px;"><?php echo get_format_date_with_day($est->estimate_date); ?></h6>
                                                <div class="MuiGrid-root MuiGrid-container">
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3" style="padding-right: 8px;">
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo get_format_time($est->created_at); ?></h6>
                                                        <div class="MuiGrid-root MuiGrid-container" style="margin-top: 5px; margin-bottom: 5px;">
                                                            <div class="MuiGrid-root jss110 MuiGrid-item MuiGrid-grid-xs-12">
                                                                <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap MuiTypography-alignCenter" style="color: rgb(33, 150, 243);"><?php echo strtoupper($est->status); ?></div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap">Arrival window:</div>
                                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap"><?php echo get_format_time($est->created_at); ?>-<?php echo get_format_time_plus_hours($est->created_at); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-7" style="border-left: 0.1em solid rgb(234, 234, 234); padding-left: 8px;">
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo strtoupper($est->job_name); ?> </h6>
                                                        <!-- <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"><?php //echo get_customer_by_id($est->customer_id);    ?></p> -->
                                                        <div>
                                                            <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"> <?php echo strtoupper($est->job_location); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1" style="margin-left: 5px; display: flex; justify-content: center;">
                                                        <div class="MuiAvatar-root MuiAvatar-circle" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                                            <img alt="Robert Leo" src="assets/img/customer_sm.png" class="MuiAvatar-img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                        <span class="MuiTouchRipple-root"></span>
                                    </a>
                                <?php endif; ?>
                            <?php
                            endforeach;
                        }
                        ?>
                        <?php if ($estCounter == 0) : ?>
                            <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700; margin: auto; padding-top: 100px;">NO ESTIMATES YET</h6>
                        <?php endif; ?>
                    </div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                    </div>
                </div>
            </div>
            <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                <div style="margin: auto;">
                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="estimate">
                        <?php if ($estCounter > 0) : ?>
                            <span class="MuiButton-label">SEE ALL ESTIMATES</span>
                        <?php endif; ?>
                        <span class="MuiTouchRipple-root"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>