<?php $this->load->helper('url'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSMARTRAC</title>
    <link href="<?= base_url(); ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/dashboard/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fb/css/main.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fb/css/view.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fb/css/datepicker.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fb/css/custom-themes/styles.css" type="text/css" />
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div id="formContainer" class="row bg-white"></div>
            <div class="w-100 text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script src="<?= base_url(); ?>assets/dashboard/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/fb/js/view.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/fb/js/main.js"></script>
    <script>
        $(() => {
            handleOnLoad(<?= $form_id ?>);
        });
    </script>
</body>
</html>