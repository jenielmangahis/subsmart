<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Summary</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px;">
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <h2 class="mt-3 text-center w-100" style="text-align: center; margin-top: 1rem; width: 100%;">Deposit Summary</h2><br>
                <p>Summary of Deposits to Cash on hand on <?= date('m/d/Y') ?></p>
                <br>
            </div>
            <div>
                <table class="table table-bordered table-hover clickable" style="border: 1px solid #dee2e6;width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 200px;">
                    <thead>
                        <tr>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">CHECK NO.</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">PMT METHOD</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">RECEIVED FROM</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">MEMO</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"></th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0.00; foreach($data->received_from as $key => $val): ?>
                            <?php $total = $total + floatval($data->amount[$key]); ?>
                            <tr>
                                <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= $data->reference_no[$key] ?></td>
                                <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= $data->payment_method[$key] ?></td>
                                <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= $val ?></td>
                                <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= $data->description[$key] ?></td>
                                <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"></td>
                                <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= $data->amount[$key] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;" colspan="4"></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">DEPOSIT SUBTOTAL</td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= $data->total ?></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;" colspan="4"></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;">DEPOSIT TOTAL</td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;"><?= number_format($total, 2, '.', ',') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
