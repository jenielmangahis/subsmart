<?php
if (!empty($emailBlast)) :
?>
    <?php
    foreach ($emailBlast as $eb) :
        switch ($eb->status):
            case "1":
                $badge = "success";
                break;
            case "3":
                $badge = "error";
                break;
            case "2":
                $badge = "secondary";
                break;
            default:
                $badge = "";
                break;
        endswitch;
    ?>
        <tr>
            <td>
                <div class="table-row-icon">
                    <i class='bx bx-envelope'></i>
                </div>
            </td>
            <td class="fw-bold nsm-text-primary"><?= $eb->campaign_name; ?></td>
            <td>
                <?php
                if ($eb->sending_type == 0) :
                    echo '-';
                else :
                    echo $sendToOptions[$eb->sending_type];
                endif;
                ?>
            </td>
            <td>
                <?php
                if ($eb->date_sent == '0000-00-00') :
                    echo '-';
                else :
                    echo date("Y-m-d", strtotime($eb->date_sent));
                endif;
                ?>
            </td>
            <td><span class="nsm-badge <?= $badge ?>"><?= $statusOptions[$eb->status]; ?></span></td>
            <td>
                <div class="dropdown table-management">
                    <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" name="dropdown_preview" href="<?php echo base_url('email_campaigns/view_campaign/' . $eb->id) ?>">Preview</a>
                        </li>
                        <li>
                            <a class="dropdown-item" name="dropdown_edit" href="<?php echo base_url('email_campaigns/edit_campaign/' . $eb->id) ?>">Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item clone-item" name="dropdown_clone" href="javascript:void(0);" data-name="<?= $eb->campaign_name; ?>" data-id="<?= $eb->id; ?>">Clone</a>
                        </li>
                        <?php if ($eb->status != 3) : ?>
                            <li>
                                <a class="dropdown-item close-item" name="dropdown_close" href="javascript:void(0);" data-name="<?= $eb->campaign_name; ?>" data-id="<?= $eb->id; ?>">Close</a>
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
        <td colspan="6">
            <div class="nsm-empty">
                <span>No results found.</span>
            </div>
        </td>
    </tr>
<?php
endif;
?>