<?php
if (!empty($emailAutomation)) :
?>
    <?php
    foreach ($emailAutomation as $s) :
    ?>
        <tr>
            <td>
                <div class="table-row-icon">
                    <i class='bx bx-mail-send'></i>
                </div>
            </td>
            <td class="fw-bold nsm-text-primary"><?= $s->name; ?></td>
            <td><?= $optionRuleEvent[$s->rule_event]; ?></td>
            <td><?= $optionRuleNotifyAt[$s->rule_notify_at]; ?></td>
            <td>0 - <a href="javascript:void(0)" name="btn_view_logs" class="nsm-link">View Log</td>
            <td>
                <?php
                $is_active = '';
                if ($s->is_active == 1) {
                    $is_active = 'checked';
                }
                ?>
                <div class="form-check form-switch nsm-switch">
                    <input class="form-check-input email-auto-switch" type="checkbox" id="switch_<?= $s->id ?>" data-id="<?= $s->id; ?>" <?= $is_active ?>>
                    <label class="form-check-label" for="switch_<?= $s->id ?>"></label>
                </div>
            </td>
            <td>
                <div class="dropdown table-management">
                    <a href="#" class="dropdown-toggle" name="dropdown_link" data-bs-toggle="dropdown">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" name="dropdown_edit" href="<?php echo base_url('email_automation/edit_automation/' . $s->id) ?>">Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-name="<?= $s->name; ?>" data-id="<?= $s->id; ?>">Delete</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
<?php
else :
?>
    <tr>
        <td colspan="7">
            <div class="nsm-empty">
                <span>No results found.</span>
            </div>
        </td>
    </tr>
<?php
endif;
?>