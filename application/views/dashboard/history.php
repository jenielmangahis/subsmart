<div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3" id="history">
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
                                        <span class="jss55 jss56">History</span>
                                    </h6>
                                </span>
                </div>
            </div>
            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
            <div class="MuiCardContent-root jss60" style="height: 309px;">
                <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 30px;">
                        <ul class="timeline">
                            <?php foreach($history_activity_list as $al) { ?>
                                <li class="timeline-item">
                                    <p class="timeline-content"><?=$al['activity']?></p>
                                    <p class="event-time"><?=$al['createdAt']?></p>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                <div style="margin: auto;">
                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false">
                        <?php if($history_activity_list_count > 5) {?>
                            <span class="MuiButton-label">Load More</span>
                            <span class="MuiTouchRipple-root"></span>
                        <?php } ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
