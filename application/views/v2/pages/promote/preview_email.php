<style>
p{
  margin-bottom: 5px;
}
h2{
  font-size: 24px;
}
</style>
<div class="row">
  <div class="col-md-12 col-12">
    <table width="100%">
      <tr>
        <td style="font-size: 25px;text-align:center;"><b><?= $subject; ?></b></td>
      </tr>
    </table>
    <br><br>
    <table width="100%" cellspacing="0" cellpadding="20" align="center" bgcolor="#ffffff">
      <tbody>
        <tr>
          <td height="84">
            <a href="<?= base_url('business/'.$company->profile_slug); ?>">
              <img src="<?= base_url('/uploads/users/business_profile/'.$company->id.'/'.$company->business_image); ?>" style="width:20%;" alt="nSmarTrac" />
            </a>
          </td>
        </tr>
      <tr>
        <td align="left" style="padding: 40px; text-align: left;"><?= $message; ?></td>
      </tr>
      <tr>
          <td style="padding: 40px; background: #fafafa; border-top: 1px solid #e6e6e9; text-align: center; font-size: 18px; color: #222222;">
              <a style="color: #222; text-decoration: none;" href="<?= base_url("/"); ?>">Powered by nSmarTrac</a>
          </td>
      </tr>
      </tbody>
    </table>

    <table class="table">
        <tbody><tr>
            <td style="text-align: center; font-size: 12px; color: #999999;">
                <p style="margin-bottom:6px;">
                    <a style="font-size: 12px; color: #999999; text-decoration: none;" href="<?= base_url("terms-and-condition"); ?>" target="_new">Terms &amp; Conditions</a> | 
                    <a style="font-size: 12px; color: #999999; text-decoration: none;" href="<?= base_url("privacy-policy"); ?>" target="_new">Privacy Policy</a> | 
                    <a style="font-size: 12px; color: #999999; text-decoration: none;" href="<?= base_url("contact"); ?>">Contact Support</a>
                </p>
                <p style="color: #999999; margin-bottom:6px;">Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.</p>
            </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>