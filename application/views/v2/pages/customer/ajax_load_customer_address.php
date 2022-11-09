<div class="mt-3" style="background-color: #416FA6;color: #ffffff;padding: 6px;">
<label class="content-title" style="cursor: pointer">
    <i class="bx bxs-map-pin"></i> Address :  <?= $customer->mail_add . ' ' . $customer->city . ' ' . $customer->state . ' '. $customer->zip_code; ?>
</label>
<label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
    <i class="bx bxs-phone"></i> Contact Number : <?= $customer->phone_m != '' ? $customer->phone_m : '---'; ?>
</label>
</div>
