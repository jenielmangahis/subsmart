<html>
<body style="margin-top:20px;font-family:arial;">
    <div style="padding:10px;">
        <image src="https://nsmartrac.com/assets/frontend/images/logo.png" style="width:206px;margin-bottom:28px;" />
        <p>Hi <?= $user->FName; ?></p>
        <p><b>nSmarTrac</b> has detected a login from a new device. Here are the details:</p>
        <p style="margin-top:30px;">Country : <b><?= $ip_data['country']; ?></b></p>
        <p>Location : <b><?= $ip_data['location']; ?></b></p>
        <p>IP Address : <b><?= $ip_data['ip']; ?></b></p>
        <p style="margin-top:30px;">If you recognize this login, no further action is needed. If you don't recognize this login, please reset your password.</p>
        <a href="<?= base_url('login/unauthorize_access/'.$encrypted_user_id).'?ip='.$ip_data['ip']; ?>" style="background-color:#6a4a86;color:#ffffff;border:1px solid #d3d3d3;padding:0.5em 0.7em;border-radius:5px;font-size:14px;font-weight:700;display:inline-block;margin-top:7px;font-family:Arial;text-decoration:none;">This wasn't me</a>
    </div>
</body>
</html>