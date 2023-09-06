<?php if (!empty($enabled_table_headers)) : ?>
    <table class="nsm-table" id="customer_table_print">
        <thead>
            <tr>
                <td class="table-icon"></td>
                <?php if (in_array('name', $enabled_table_headers)) : ?><td data-name="Name">Name</td><?php endif; ?>
                <?php if (in_array('city', $enabled_table_headers)) : ?><td data-name="City">City</td><?php endif; ?>
                <?php if (in_array('state', $enabled_table_headers)) : ?><td data-name="State">State</td><?php endif; ?>
                <?php if (in_array('source', $enabled_table_headers)) : ?><td data-name="Source">Source</td><?php endif; ?>
                <?php if (in_array('added', $enabled_table_headers)) : ?><td data-name="Added">Added</td><?php endif; ?>
                <?php if (in_array('sales_rep', $enabled_table_headers)) : ?><td data-name="Sales Rep">Sales Rep</td><?php endif; ?>
                <?php if (in_array('tech', $enabled_table_headers)) : ?><td data-name="Tech">Tech</td><?php endif; ?>
                <?php if (in_array('plan_type', $enabled_table_headers)) : ?><td data-name="Plan Type">Plan Type</td><?php endif; ?>
                <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><td data-name="Subscription Amount">Subscription Amount</td><?php endif; ?>
                <?php if (in_array('phone', $enabled_table_headers)) : ?><td data-name="Phone">Phone</td><?php endif; ?>
                <?php if (in_array('status', $enabled_table_headers)) : ?><td data-name="Status">Status</td><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($profiles)) :
            ?>
                <?php
                foreach ($profiles as $customer) :
                    switch ($customer->status):
                        case "INSTALLED":
                            $badge = "success";
                            break;
                        case "CANCELLED":
                            $badge = "error";
                            break;
                        case "COLLECTIONS":
                            $badge = "secondary";
                            break;
                        case "CHARGED BACK":
                            $badge = "primary";
                            break;
                        default:
                            $badge = "";
                            break;
                    endswitch;

                    $image = userProfilePicture($customer->id);
                ?>
                    <?php if (in_array('name', $enabled_table_headers)) : ?>
                        <td>
                            <?php if (is_null($image)) : ?>
                                <div class="nsm-profile">
                                    <span><?php echo getLoggedNameInitials($customer->id); ?></span>
                                </div>
                            <?php else : ?>
                                <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
                            <?php endif; ?>
                        </td>
                        <td class="nsm-text-primary">
                            <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                            <label class="content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                        </td>
                    <?php endif; ?>
                    <?php if (in_array('city', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->city; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('state', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->state; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('source', $enabled_table_headers)) : ?>
                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('added', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->entered_by; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('sales_rep', $enabled_table_headers)) : ?>
                        <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('tech', $enabled_table_headers)) : ?>
                        <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->system_type; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                        <td>$<?= $customer->total_amount; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('phone', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->phone_m; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('status', $enabled_table_headers)) : ?>
                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                    <?php endif; ?>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php
            else :
            ?>
                <tr>
                    <td colspan="13">
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
    <table class="nsm-table">
        <thead>
            <tr>
                <td class="table-icon"></td>
                <td data-name="Name">Name</td>
                <td data-name="City">City</td>
                <td data-name="State">State</td>
                <td data-name="Source">Source</td>
                <td data-name="Added">Added</td>
                <td data-name="Sales Rep">Sales Rep</td>
                <td data-name="Tech">Tech</td>
                <td data-name="Plan Type">Plan Type</td>
                <td data-name="Subscription Amount">Subscription Amount</td>
                <td data-name="Phone">Phone</td>
                <td data-name="Status">Status</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($profiles)) :
            ?>
                <?php
                foreach ($profiles as $customer) :
                    switch ($customer->status):
                        case "INSTALLED":
                            $badge = "success";
                            break;
                        case "CANCELLED":
                            $badge = "error";
                            break;
                        case "COLLECTIONS":
                            $badge = "secondary";
                            break;
                        case "CHARGED BACK":
                            $badge = "primary";
                            break;
                        default:
                            $badge = "";
                            break;
                    endswitch;

                    $image = userProfilePicture($customer->id);
                ?>
                    <tr>
                        <td>
                            <?php if (is_null($image)) : ?>
                                <div class="nsm-profile">
                                    <span><?php echo getLoggedNameInitials($customer->id); ?></span>
                                </div>
                            <?php else : ?>
                                <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
                            <?php endif; ?>
                        </td>
                        <td class="nsm-text-primary">
                            <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                            <label class="content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                        </td>
                        <td><?php echo $customer->city; ?></td>
                        <td><?php echo $customer->state; ?></td>
                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                        <td><?php echo $customer->entered_by; ?></td>
                        <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                        <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                        <td><?php echo $customer->system_type; ?></td>
                        <td>$<?= $customer->total_amount; ?></td>
                        <td><?php echo $customer->phone_m; ?></td>
                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php
            else :
            ?>
                <tr>
                    <td colspan="13">
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
<?php endif; ?>
<div style="display:none;">
<table class="w-100" id="customer_table_print_ajax">
    <?php if (!empty($enabled_table_headers)) : ?>
        <thead>
            <tr>
                <?php if (in_array('name', $enabled_table_headers)) : ?><td data-name="Name">Name</td><?php endif; ?>
                <?php if (in_array('city', $enabled_table_headers)) : ?><td data-name="City">City</td><?php endif; ?>
                <?php if (in_array('state', $enabled_table_headers)) : ?><td data-name="State">State</td><?php endif; ?>
                <?php if (in_array('source', $enabled_table_headers)) : ?><td data-name="Source">Source</td><?php endif; ?>
                <?php if (in_array('added', $enabled_table_headers)) : ?><td data-name="Added">Added</td><?php endif; ?>
                <?php if (in_array('sales_rep', $enabled_table_headers)) : ?><td data-name="Sales Rep">Sales Rep</td><?php endif; ?>
                <?php if (in_array('tech', $enabled_table_headers)) : ?><td data-name="Tech">Tech</td><?php endif; ?>
                <?php if (in_array('plan_type', $enabled_table_headers)) : ?><td data-name="Plan Type">Plan Type</td><?php endif; ?>
                <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><td data-name="Subscription Amount">Subscription Amount</td><?php endif; ?>
                <?php if (in_array('phone', $enabled_table_headers)) : ?><td data-name="Phone">Phone</td><?php endif; ?>
                <?php if (in_array('status', $enabled_table_headers)) : ?><td data-name="Status">Status</td><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($profiles)) :
            ?>
                <?php
                foreach ($profiles as $customer) :
                    switch ($customer->status):
                        case "INSTALLED":
                            $badge = "success";
                            break;
                        case "CANCELLED":
                            $badge = "error";
                            break;
                        case "COLLECTIONS":
                            $badge = "secondary";
                            break;
                        case "CHARGED BACK":
                            $badge = "primary";
                            break;
                        default:
                            $badge = "";
                            break;
                    endswitch;

                    $image = userProfilePicture($customer->id);
                ?>
                    <?php if (in_array('name', $enabled_table_headers)) : ?>
                        <td class="nsm-text-primary">
                            <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                            <label class="content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                        </td>
                    <?php endif; ?>
                    <?php if (in_array('city', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->city; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('state', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->state; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('source', $enabled_table_headers)) : ?>
                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('added', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->entered_by; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('sales_rep', $enabled_table_headers)) : ?>
                        <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('tech', $enabled_table_headers)) : ?>
                        <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->system_type; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                        <td>$<?= $customer->total_amount; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('phone', $enabled_table_headers)) : ?>
                        <td><?php echo $customer->phone_m; ?></td>
                    <?php endif; ?>
                    <?php if (in_array('status', $enabled_table_headers)) : ?>
                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                    <?php endif; ?>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php
            else :
            ?>
                <tr>
                    <td colspan="12">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    <?php else : ?>
        <thead>
            <tr>
                <td data-name="Name">Name</td>
                <td data-name="City">City</td>
                <td data-name="State">State</td>
                <td data-name="Source">Source</td>
                <td data-name="Added">Added</td>
                <td data-name="Sales Rep">Sales Rep</td>
                <td data-name="Tech">Tech</td>
                <td data-name="Plan Type">Plan Type</td>
                <td data-name="Subscription Amount">Subscription Amount</td>
                <td data-name="Phone">Phone</td>
                <td data-name="Status">Status</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($profiles)) :
            ?>
                <?php
                foreach ($profiles as $customer) :
                    switch ($customer->status):
                        case "INSTALLED":
                            $badge = "success";
                            break;
                        case "CANCELLED":
                            $badge = "error";
                            break;
                        case "COLLECTIONS":
                            $badge = "secondary";
                            break;
                        case "CHARGED BACK":
                            $badge = "primary";
                            break;
                        default:
                            $badge = "";
                            break;
                    endswitch;

                    $image = userProfilePicture($customer->id);
                ?>
                    <tr>
                        <td class="nsm-text-primary">
                            <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                            <label class="content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                        </td>
                        <td><?php echo $customer->city; ?></td>
                        <td><?php echo $customer->state; ?></td>
                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                        <td><?php echo $customer->entered_by; ?></td>
                        <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                        <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                        <td><?php echo $customer->system_type; ?></td>
                        <td>$<?= $customer->total_amount; ?></td>
                        <td><?php echo $customer->phone_m; ?></td>
                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php
            else :
            ?>
                <tr>
                    <td colspan="12">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    <?php endif; ?>
</table>
</div>

<script>
$(function(){
    $(".nsm-table").nsmPagination();
});
</script>