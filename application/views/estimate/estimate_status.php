<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>nSmarTrac Estimate</title>

    <style>
        body {
            margin: 0;
            background-color: #e7e7e7;
        }

        .container {
            display: grid;
            height: 100vh;
            place-items: center;
        }

        .main {
            --color-primary: #29da75;

            display: flex;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
            color: #333;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            width: 100%;
            max-width: 300px;
            border-radius: 16px;
            position: relative;
            background-color: #fff;
        }

        .main.main--error {
            --color-primary: #e33e40;
        }

        .main__inner {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 300px;
        }

        .main__title {
            font-size: 20px;
            font-weight: 600;
        }

        .main__body {
            font-size: 15px;
        }

        .main__icon {
            --size: 70px;
            width: var(--size);
            height: var(--size);
            background-color: var(--color-primary);
            border-radius: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .main__icon box-icon {
            --size: 60px;
            width: var(--size);
            height: var(--size);
            fill: #fff;
        }


        .main__header {
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .main__number {
            font-size: 13px;
            background-color: #dad1e0;
            color: #6a4a86;
            font-weight: 600;
            padding: 0 10px;
            height: 30px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main__footer {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main <?= $is_success ? "main--success" : "main--error"; ?>">
            <div class="main__header">
                <div class="main__number"><?= $estimate->estimate_number; ?></div>
            </div>

            <div class="main__inner">
                <div class="main__icon">
                    <box-icon name='<?= $is_success ? "check" : "x"; ?>'></box-icon>

                </div>
                <div class="main__title">
                    <?= $is_success ? "Success!" : "Oops!"; ?>
                </div>
                <div class="main__body"><?= $message; ?></div>
            </div>

            <div class="main__footer">
                <div><?= $company->business_name; ?></div>
                <div><?= "$company->address, $company->city $company->postal_code"; ?></div>
                <a href="mailto:<?= $company->business_email; ?>"><?= $company->business_email; ?></a>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>