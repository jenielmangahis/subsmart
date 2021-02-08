<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Summary</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <?php for($i = 0; $i < 3; $i++): ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always;">
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <!-- <h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Statement</h2><br>
                <strong>TO <br> <span style="font-weight: 400;">Betty Fuller</span></strong><br>
                <div style="float:right;padding-bottom:500px;">
                    <p><strong>STATEMENT NO.</strong>1050</p>
                    <p><strong>DATE</strong>02/06/2021</p>
                    <p><strong>TOTAL DUE</strong>$3.00</p>
                </div> -->
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td><h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Statement</h2></td>
                        </tr>
                        <tr>
                            <td><strong>TO <br> <span style="font-weight: 400;">Betty Fuller</span></strong></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="float:right;">
                                    <p><strong>STATEMENT NO.</strong>1050</p>
                                    <p><strong>DATE</strong>02/06/2021</p>
                                    <p><strong>TOTAL DUE</strong>$3.00</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 300px;">
                    <thead>
                        <tr>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">DATE</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">ACTIVITY</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">AMOUNT</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">BALANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem;">01/05/2021 </td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem;">Balance Forward</td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">1.00</td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">2.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endfor; ?>
</body>
</html>