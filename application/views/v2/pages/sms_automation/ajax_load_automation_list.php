<?php
if (!empty($smsAutomation)) :
?>
    <?php
    foreach ($smsAutomation as $s) :
    ?>
        <tr>
            <td>
                <div class="table-row-icon">
                    <i class='bx bx-message-square-detail'></i>
                </div>
            </td>
            <td class="fw-bold nsm-text-primary"><?= $s->automation_name; ?></td>
            <td><?= $optionRuleEvent[$s->rule_event]; ?></td>
            <td><?= $optionRuleNotifyAt[$s->rule_notify_at]; ?></td>            
            <td><?= $optionStatus[$s->status]; ?></td>
            <td>
                <div class="dropdown table-management">
                    <a href="#" name="dropdown_list" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item btn-view" name="dropdown_view" href="javascript:void(0);" data-id="<?= $s->id; ?>">View</a>
                        </li>
                        <li>
                            <a class="dropdown-item" name="dropdown_view" href="<?php echo base_url('sms_automation/view_logs/' . $s->id); ?>">Logs</a>
                        </li>
                        <li>
                            <a class="dropdown-item" name="dropdown_edit" href="<?php echo base_url('sms_automation/edit_automation/' . $s->id) ?>">Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-name="<?= $s->automation_name; ?>" data-id="<?= $s->id; ?>">Delete</a>
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