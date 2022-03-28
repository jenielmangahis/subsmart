<?php
if (!empty($smsBlast)) :
?>
    <?php
    foreach ($smsBlast as $sb) :
    ?>
        <tr>
            <td>
                <div class="table-row-icon">
                    <i class='bx bx-chat'></i>
                </div>
            </td>
            <td class="fw-bold nsm-text-primary"><?= $sb->campaign_name; ?></td>
            <td>
                <?php
                if ($sb->sending_type == 0) :
                    echo "-";
                else :
                    echo $sendToOptions[$sb->sending_type];
                endif;
                ?>
            </td>
            <td>
                <?php
                if ($sb->date_sent == '0000-00-00') :
                    echo "-";
                else :
                    echo date("Y-m-d", strtotime($sb->date_sent));
                endif;
                ?>
            </td>
            <td>0 - <a href="<?php echo base_url('sms_campaigns/view_logs/' . $sb->id) ?>" class="nsm-link">View Log</a></td>
            <td><?= $statusOptions[$sb->status]; ?></td>
            <td>
                <div class="dropdown table-management">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if ($sb->status != $status_draft) : ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url('sms_campaigns/view_campaign/' . $sb->id) ?>" data-id="<?= $lead_type->lead_id; ?>">View</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($sb->status != 3) : ?>
                            <li>
                                <a class="dropdown-item edit-item" href="<?php echo base_url('sms_campaigns/edit_campaign/' . $sb->id) ?>">Edit</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a class="dropdown-item clone-item" href="javascript:void(0);" data-name="<?= $sb->campaign_name; ?>" data-id="<?= $sb->id; ?>">Clone</a>
                        </li>
                        <?php if ($sb->status != 3) : ?>
                            <li>
                                <a class="dropdown-item close-item" href="javascript:void(0);" data-name="<?= $sb->campaign_name; ?>" data-id="<?= $sb->id; ?>">Close</a>
                            </li>
                        <?php endif; ?>
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