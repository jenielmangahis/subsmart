<?php
$msgs = array();
foreach ($jsonResponse->records as $r):
    //echo $r->subject.'<br />';
    $from = $r->from->phoneNumber;
    $msgItem = explode('-', $r->subject);
    $fromNum = json_decode($this->ringcentral->getNameByPhone(substr($r->from->phoneNumber, '2')));
    if (!in_array($from, $msgs)):
        ?>
        <a href="#" onclick="$('#viewSMSLogs').modal('show'),
                        $('#smsLogName').html('<?= $fromNum->hasRecord ? $fromNum->firstname . ' ' . $fromNum->lastname : $r->from->phoneNumber ?>'),
                        fetchPersonalSMS('<?= base64_encode($r->from->phoneNumber) ?>')" class="float-left col-lg-12 no-padding mt-3" style="border-bottom: 1px solid #ccc;">
            <img class="img-sm rounded-circle float-left" width="43" src="<?= base_url('uploads/users/default.png'); ?>" alt="profile">
            <div class="messages float-left ml-4 col-lg-8">
                <h6 class="no-margin" style="font-weight: bold; width: auto;"><?= $fromNum->hasRecord ? $fromNum->firstname . ' ' . $fromNum->lastname : $r->from->phoneNumber ?> &nbsp;&nbsp;</h6>
                <p style="color:gray;" ><?= trim($msgItem[1]); ?></p>
            </div>
            <div class="ml-auto float-right mt-3">
                <small class="muted timestamp" datetime="<?= $r->lastModifiedTime; ?>" style="color:#868e96;"><?= date('Y-m-d G:i:s', strtotime($r->lastModifiedTime)) ?></small>
            </div>
        </a>
        <?php
        array_push($msgs, $from);
    endif;
endforeach;
