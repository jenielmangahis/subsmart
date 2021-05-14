<div style="width:100%;">
  <?php $nsmart_logo  = base_url("assets/dashboard/images/logo.png"); ?>
  <img src="<?= $nsmart_logo; ?>" style="height: 100px;margin-bottom: 15px;">
  <p>You have received a new deal booking on <?= date("d-M-Y H:i"); ?></p><br/>
  <p>Name  : <?= $booking_data['name']; ?></p>
  <p>Phone : <?= $booking_data['name']; ?></p>
  <p>Email : <?= $booking_data['email']; ?></p>
  <p>Address : <?= $booking_data['address_full']; ?></p>
  <p>Message : <?= $booking_data['message']; ?></p><br/>
  <p>Booked Deal : <?= $dealsSteals->title; ?></p><br/><br/>
  <?php 
    $slug = createSlug($dealsSteals->title,'-');
    $deal_url = url('deal/' . $slug . '/' . $dealsSteals->id);
  ?>
  <p><a href="<?= $deal_url; ?>" target="_new" style='background-color:#32243d;color:#fff;padding:10px 25px;border:1px solid transparent;border-radius:2px;font-size:22px;text-decoration:none;'>View Online</a></p><br/>
  <p>Kind Regards</p>
  <p>nSmarTrac</p><br/><br/><br/>
  <p style="text-align: center;">Powered by <a href="<?= base_url("/"); ?>" target="_new">nSmarTrac</a></p>
</div>