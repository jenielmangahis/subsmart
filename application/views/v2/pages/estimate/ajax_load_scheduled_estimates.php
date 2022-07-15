<table class="nsm-table" id="estimates_table">
    <thead>
        <tr>
            <td data-name="Estimate Details"></td>
            <td data-name="Status"></td>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($scheduledEstimates)) : ?>
            <?php foreach ($scheduledEstimates as $estimate) : ?>
                <tr class="schedule-estimates" style="cursor: pointer" onclick="location.href='<?php echo base_url('job/new_job1/' . $jb->id); ?>'">
                    <td>
                        <label class="content-title" style="cursor: pointer"><?= $estimate->first_name . ' ' . $estimate->last_name; ?> <span class="text-muted">(<?= $estimate->estimate_number; ?>)</span></label>
                    </td>
                    <td class="text-end">
                        <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer"><?= date("Y-m-d",strtotime($estimate->estimate_date)); ?></label>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="2">
                    <div class="nsm-empty">
                        <span>No unscheduled estimates for now.</span>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>