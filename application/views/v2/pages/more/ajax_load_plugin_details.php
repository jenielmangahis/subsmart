<div class="row text-center gy-3">
    <div class="col-12">
        <label class="content-title d-block mb-2"><?= $plugin->name; ?></label>
        <label class="content-subtitle d-block"><?= $plugin->description; ?></label>
        <hr>
        <label class="nsm-subtitle text-success">
            <?php
            if ($plugin->sms_fee > 0) {
                echo "$" . $plugin->sms_fee . "/SMS + $" . $plugin->service_fee . " service fee";
            } else {
                echo "$" . $plugin->service_fee . " service fee";
            }
            ?>
        </label>
    </div>

</div>