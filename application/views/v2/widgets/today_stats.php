<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter h3 {
        margin: unset;
        font-weight: bold;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="thumbnail_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Today's Stats</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row h-100 g-2">
        <div class="col-12 col-md-6">
            <div class="nsm-counter success h-100 mb-2">
                <div class="row h-100">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <i class='bx bx-wallet'></i>
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                        <h3 id="earned"></h3>
                        <span>Earned</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="nsm-counter primary h-100 mb-2">
                <div class="row h-100">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <i class='bx bx-box'></i>
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                        <h3 id="collected"></h3>
                        <span>Collected</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="nsm-counter success h-100 mb-2">
                <div class="row h-100">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <i class='bx bx-list-check'></i>
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                        <h2 id="jobs_completed"></h2>
                        <span>Jobs Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="nsm-counter h-100 mb-2">
                <div class="row h-100">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <i class='bx bx-bookmarks'></i>
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                        <h2 id="jobs_added"></h2>
                        <span>New Jobs Booked Online</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="nsm-counter error h-100 mb-2">
                <div class="row h-100">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <i class='bx bx-task-x'></i>
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                        <h2 id="lost_accounts"></h2>
                        <span>Lost Accounts</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="nsm-counter primary h-100 mb-2">
                <div class="row h-100">
                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                        <i class='bx bx-box'></i>
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                        <h2 id="collections"></h2>
                        <span>Collections</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>