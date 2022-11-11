<?php
if (!empty($dealsSteals)) :
?>
    <?php
    foreach ($dealsSteals as $ds) :
        switch ($ds->status):
            case "1":
                $badge = "success";
                break;
            case "3":
                $badge = "primary";
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
                <div class="table-row-icon img" style="background-image: url('<?= base_url("uploads/deals_steals/" . $ds->company_id . "/" . $ds->photos); ?>')"></div>
            </td>
            <td class="fw-bold nsm-text-primary">
                <label class="d-block"><?= $ds->title; ?></label>
                <a class="nsm-link" name="btn_count" href="javascript:void(0);">
                    $<?= number_format($ds->deal_price, 2); ?>
                </a>
            </td>
            <td>0</td>
            <td>0</td>
            <td></td>
            <td><span class="nsm-badge <?= $badge ?>"><?= $statusOptions[$ds->status]; ?></span></td>
            <td>
                <div class="dropdown table-management">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" name="dropdown_list" href="<?php echo base_url('promote/view_deals/' . $ds->id) ?>">View</a>
                        </li>
                        <?php if ($ds->status != 3) : ?>
                            <li>
                                <a class="dropdown-item" name="dropdown_edit" href="<?php echo base_url('promote/edit_deals/' . $ds->id) ?>">Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item close-item" name="dropdown_close_deal" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>">Close Deal</a>
                            </li>
                            <?php //if ($ds->status != 1) : ?>
                                <li>
                                    <a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>">Delete</a>
                                </li>
                            <?php //endif; ?>
                        <?php endif; ?>
                        
                        <?php if($ds->status == $status_ended): ?>
                        <li>
                            <a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>">Delete</a>
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