<div style="width:100%;">
  <?php $nsmart_logo  = base_url("assets/frontend/images/logo.png"); ?>
  <img src="<?= $nsmart_logo; ?>" style="height: 100px;margin-bottom: 15px;">
  <p>You have received a new deal booking on <?= date("d-M-Y g:i A"); ?></p><br/>
  <p>Name  : <?= $booking_data['first_name'] . " " . $booking_data['last_name']; ?></p>
  <p>Phone : <?= $booking_data['phone']; ?></p>
  <p>Email : <?= $booking_data['email']; ?></p>
  <p>Address : <?= $booking_data['address_full']; ?></p>
  <p>Message : <?= $booking_data['message']; ?></p><br/>
  <p>Booked Deal : <?= $dealsSteals->title; ?></p><br/><br/>
  <?php 
    $slug     = createSlug($dealsSteals->title,'-');
    $deal_url = base_url('deal/' . $slug . '/' . $dealsSteals->id);
  ?>
  <p><a href="<?= $deal_url; ?>" target="_new" style='background-color:#32243d;color:#fff;padding:10px 25px;border:1px solid transparent;border-radius:2px;font-size:22px;text-decoration:none;'>View Online</a></p><br/>
  <br/><br/><br/>
  <p>Kind Regards</p>
  <p>nSmarTrac</p><br/><br/><br/>
  <p style="text-align: center;">Powered by <a href="https://nsmartrac.com/" target="_new">nSmarTrac</a></p>
</div>