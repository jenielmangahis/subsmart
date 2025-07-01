<input type="hidden" id="plugin-name" value="<?= $plugin->name; ?>" />
<div class="row gy-3">
    <div class="col-12">
        <label class="content-title d-block mb-4" style="font-size:22px;font-weight:bold;"><i class='bx bxs-package' style="position:relative;top:2px;"></i> <?= $plugin->name; ?></label>
        <label class="content-subtitle d-block"><?= $plugin->description; ?></label>
        <hr>
        <label class="nsm-subtitle" style="font-size:20px;font-weight:bold;">
            <?php
            if ($plugin->sms_fee > 0) {
                echo "$" . number_format($plugin->sms_fee,2,".",",") . "/ SMS + $" . $plugin->service_fee . " Service Fee";
            } else {
                echo "$" . number_format($plugin->service_fee,2,".",",") . " Service Fee";
            }
            ?>
        </label>
    </div>

</div>