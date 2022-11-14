<style>
.accordion-button:focus, .accordion-button:not(.collapsed) { 
    box-shadow:none !important;
}
.drawer-menu .accordion-button{
    font-size: 19px;
}
.drawer-icon{
    margin-right: 7px;
    position: relative;
    top: -1px;
    font-size: 22px;
}
#mini_calendar_collapse .fc .fc-daygrid-day.fc-day-today {
    background-color: #DAD1E0 !important;
}
</style>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#mini_calendar_collapse" aria-expanded="true" aria-controls="mini_calendar_collapse">
                        <i class='bx bxs-calendar-event drawer-icon'></i> Mini Calendar
                    </button>
                </h2>
                <div id="mini_calendar_collapse" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="mini-calendar"></div>
                        <div id="right-calendar"></div>
                        <div class="calendar-tooltip"></div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#calendars" aria-expanded="false" aria-controls="calendars">
                        <i class='bx bxs-calendar drawer-icon'></i> Calendar Events
                    </button>
                </h2>
                <div id="calendars" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php if (!empty($calendar_list)) : ?>
                            <label class="content-subtitle">Which calendar entries do you wish to show</label>
                            <table class="nsm-table">
                                <thead>
                                    <tr>
                                        <td data-name="Main">Main</td>
                                        <td data-name="Mini">Mini</td>
                                        <td data-name="Calendar Name">Calendar Name</td>
                                        <td data-name="Manage"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($calendar_list)) :
                                    ?>
                                        <?php
                                        foreach ($calendar_list as $calendar) :
                                            $is_checked = "";
                                            $is_mini_checked = "";

                                            if (!empty($enabled_calendar)) {
                                                if (in_array($calendar['id'], $enabled_calendar)) {
                                                    $is_checked = 'checked="checked"';
                                                }
                                            }

                                            if (!empty($enabled_mini_calendar)) {
                                                if (in_array($calendar['id'], $enabled_mini_calendar)) {
                                                    $is_mini_checked = 'checked="checked"';
                                                }
                                            }

                                            $rowBgColor = '#38a4f8';
                                            if ($calendar['backgroundColor'] != '') {
                                                $rowBgColor = $calendar['backgroundColor'];
                                            }
                                        ?>
                                            <tr>
                                                <td style="background-color: <?php echo $rowBgColor; ?>">
                                                    <input class="form-check-input select-primary chk-calendar-entries" type="checkbox" <?php echo $is_checked; ?> data-id="<?php echo $calendar['id']; ?>">
                                                </td>
                                                <td style="background-color: <?php echo $rowBgColor; ?>">
                                                    <input class="form-check-input select-primary chk-calendar-mini-entries" type="checkbox" <?php echo $is_mini_checked; ?> data-id="<?php echo $calendar['id']; ?>">
                                                </td>
                                                <td style="background-color: <?php echo $rowBgColor; ?>"><?php echo $calendar['summary']; ?></td>
                                                <td style="background-color: <?php echo $rowBgColor; ?>">
                                                    <!-- <a class="nsm-link default" title="Add Event" href="javascript:void(0);" data-id="<?php echo $calendar['id']; ?>">Edit</a> -->
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    <?php
                                    else :
                                    ?>
                                        <tr>
                                            <td colspan="4">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <label class="content-subtitle">To enable mini calendar events filtering, bind your gmail account in <a class="nsm-link" href="<?= base_url('settings/schedule') ?>">Calendar Settings</a></label>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#recent_contacts" aria-expanded="false" aria-controls="recent_contacts">
                        <i class='bx bxs-contact drawer-icon'></i> Recent Contacts
                    </button>
                </h2>
                <div id="recent_contacts" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td class="table-icon"></td>
                                    <td data-name="Name">Name</td>
                                    <td data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($get_recent_users)) :
                                ?>
                                    <?php
                                    foreach ($get_recent_users as $key => $recent_user) :
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="nsm-profile">
                                                    <?php
                                                    if ($recent_user->profile_img != null) {
                                                        $img_filename = userProfileImage($recent_user->id);
                                                        $default_imp_img = $img_filename;
                                                    } else {
                                                        $default_imp_img = base_url('uploads/users/default.png');
                                                    }
                                                    ?>
                                                    <div class="nsm-profile" style="background-image: url('<?php echo $default_imp_img ?>');"></div>
                                                </div>
                                            </td>
                                            <td class="nsm-text-primary">
                                                <label class="content-title"><?php echo $recent_user->FName . " " . $recent_user->LName  ?></label>
                                                <label class="content-subtitle"><?php echo $recent_user->email ?></label>
                                            </td>
                                            <td class="text-end">
                                                <a class="nsm-button btn-sm" href="tel:<?= $recent_user->phone; ?>"><i class='bx bxs-phone'></i></a>
                                                <a class="nsm-button btn-sm" href="mailto:<?= $recent_user->email; ?>"><i class='bx bx-mail-send'></i></a>
                                                <a class="nsm-button btn-sm" target="_blank" href="<?= base_url('workcalender/print_contact/' . $recent_user->id); ?>"><i class='bx bx-printer'></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                <?php
                                else :
                                ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="nsm-empty">
                                                <span>No results found.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#wait_list" aria-expanded="false" aria-controls="wait_list">
                        <i class='bx bx-detail drawer-icon'></i> Wait List
                    </button>
                </h2>
                <div id="wait_list" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="row g-3">
                            <div class="col-12 text-end">
                                <button type="button" class="nsm-button m-0 primary" id="btn_add_wait_list">
                                    <i class='bx bx-fw bx-plus'></i> Add Wait List
                                </button>
                            </div>
                            <div class="col-12">
                                <div id="wait_list_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>