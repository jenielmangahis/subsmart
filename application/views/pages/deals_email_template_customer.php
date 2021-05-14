<div style="width:100%;">
  <img src="<?= getCompanyCoverPhoto($dealsSteals->company_id); ?>" style="height: 100px;margin-bottom: 15px;">
  <p>You have successfully booked the deal <b><?= $dealsSteals->title; ?></b></p><br/>
  <p>We have received your contact details and will be in touch with you shortly</p><br/>
  <?php if($company->business_number != ''){ ?>
  <p>However, if you would like to reach us quicker please feel free to call us at <b><?= $company->business_number; ?></b></p><br/>
  <?php } ?>
  <p>We look forward to speaking with you soon!</p><br/>
  <p>Thank you</p>
  <p><?= $company->business_name; ?></p>
</div>