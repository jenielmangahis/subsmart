<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0; font-size: 13px; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji'; font-weight: 400;line-height: 1.5; color: #212529; text-align: left; background-color: #fff;">
    <?php $count = 1; ?>
    <?php foreach($data['checks'] as $checkGroup) : ?>
    <?php if($count < count($data['checks'])) : ?>
    <div class="container" style="width: 100%;padding-right: <?=$data['right-padding']?>px;padding-left: <?=$data['left-padding']?>px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always; height: 100%;">
    <?php else : ?>
    <div class="container" style="width: 100%;padding-right: <?=$data['right-padding']?>px;padding-left: <?=$data['left-padding']?>px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid; height: 100%;">
    <?php endif; ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div style="width: 100%">
                <?php foreach($checkGroup as $index => $check) : ?>
                    <?php
                    if($index < 1) {
                        $topMargin = $data['top-margin'];
                        $amountMarginRight = -20;
                    } else {
                        if($index === 1) {
                            $topMargin = 337;
                        } else {
                            $topMargin = 674;
                        }
                        $amountMarginRight = -123;
                    }
                    ?>
                <div style="position: absolute; width: 100%; margin-top: <?=$topMargin?>px;">
                    <table style="width: 100%; color: #212529; border-collapse: collapse; position: absolute; margin-top: 32px; z-index: 2">
                        <tr>
                            <td style="padding-left: 25px;">
                                <p style="margin-top: 24px; margin-bottom: 8px;"><?=$check['name']?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><?=$check['total_in_words']?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px;"><p style="margin: 0"><?=str_replace("<br />", "<br>", $check['mailing_address'])?></p></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                    <div style="position: absolute; width: 123px; float: right; margin-right: <?=$amountMarginRight?>px; margin-top: 8px z-index: 1;">
                        <p style="margin: 0"><?=$check['date']?></p>
                        <div style="width: 100%; height: 70px;">
                            <p style="margin-bottom: 0; margin-top: 28px; text-align: left;">**<?=$check['total']?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</body>
</html>