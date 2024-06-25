<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nSmarTrac : Broadcast Email</title>
</head>
<body style="font-family: 'Poppins', Arial, sans-serif">
    <?= $post['preview_text']; ?>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="body" style="padding: 40px; text-align: left; font-size: 16px; line-height: 1.6;">
                            <?= $data['broadcast_content']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer" style="background-color: #6a4a86; padding: 40px; text-align: center; color: white; font-size: 14px;">
                        Copyright &copy; <?= date("Y"); ?> | nSmarTrac. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>