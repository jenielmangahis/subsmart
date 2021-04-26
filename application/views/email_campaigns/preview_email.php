<style>
p{
	margin-bottom: 5px;
}
h2{
	font-size: 24px;
}
</style>
<table>
	<tr>
		<td style="width: 100px;"><b>Subject</b></td>
		<td><?= $subject; ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<?= $message; ?>
		</td>
	</tr>
</table>
<div style="width: 100%;text-align: center;font-size: 17px; margin-top: 61px;"><?= $company->business_name; ?></div>
<div style="width: 100%;text-align: center;font-size: 17px; margin-top: 61px;">
	<a style="font-size: 14px; color: #999999; text-decoration: none;" href="<?= base_url("/"); ?>">Powered by nSmarTrac.com</a>
</div>