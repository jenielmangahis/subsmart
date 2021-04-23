<style>
p{
  margin-bottom: 5px;
}
h2{
  font-size: 24px;
}
</style>
<br><br><br>
<table>
  <tr>
    <td style="width: 100px;font-size: 18px;"><b>Subject</b></td>
    <td><?= $subject; ?></td>
  </tr>
</table>
<br><br>
<table width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" style="width: 100%; max-width: 700px !important; border: 1px solid #e6e6e9; padding: 0; margin: 0;">
  <tbody>
    <tr>
      <td height="84" bgcolor="#e0edf9" style="padding-left: 40px; text-align: left; background: linear-gradient(to top, #c4daeb, #F0F8FF); border-bottom: 1px solid #cad9e7; height: 84px;"><a href="<?= base_url("/"); ?>"><img src="<?= base_url('assets/dashboard/images/logo.png'); ?>" style="width:39%;" alt="nSmarTrac"></a></td>
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

<table align="center" style="width: 100%; max-width: 700px !important; clear: both !important; margin: 30px 0;">
    <tbody><tr>
        <td style="text-align: center; font-size: 12px; color: #999999;">
            <p style="margin-bottom:15px;">
                <a href="#"><img style="display: inline-block;" src="<?= base_url('assets/img/email_template/icon_fb.png'); ?>"></a>
                <a href="#"><img style="display: inline-block;" src="<?= base_url('assets/img/email_template/icon_fb.png'); ?>"></a>
            </p>
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