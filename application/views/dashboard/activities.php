<div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3" id="activities">
    <div class="c65 c61">
        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                <div class="MuiCardHeader-avatar">
                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
                    </svg>
                </div>
                <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss56">Activity</span>
                                    </h6>
                                </span>
                </div>
            </div>
            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
            <div class="MuiCardContent-root jss60" style="height: 309px;">
                <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 30px;">
                        <ul class="timeline">
                            <?php foreach($activity_list as $al) { ?>
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
                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="customer#settings">
                        <?php if($activity_list_count > 5) {?>
                            <span class="MuiButton-label">Load More</span>
                            <span class="MuiTouchRipple-root"></span>
                        <?php } ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
