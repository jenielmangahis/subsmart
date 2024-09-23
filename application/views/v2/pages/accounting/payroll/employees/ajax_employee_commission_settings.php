<?php foreach($employeeCommissionSettings as $ecs) { ?>
    <div class="col-md-4">
        <strong class="text-muted"><?= $ecs->name; ?></strong>
        <p class="text_value">$<?= number_format($ecs->commission_value,2,".","") ?> (<?= ucfirst($ecs->commission_type) ?>)</p>
    </div>
<?php } ?>