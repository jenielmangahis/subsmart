<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Invitation</title>

    <link href="/assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.min.css">
</head>
<style>
    @font-face {
        font-family: fontStyle;
        src: url("/assets/css/accounting/fonts/Depot-Regular.otf");
    }

    body {
        font-family: fontStyle;
    }

    .tile-container {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
        background-color: #fff;
        background-image: none;
        border: 1px solid #d4d7dc;
        -webkit-transition: all .3s ease;
        position: relative;
        top: 20px;
        width: 90%;
        height: 90%;
        padding: 0;
        margin: 0 auto;
    }

    .inner-content {
        padding: 20px;
    }

    .inner-content .card-title {
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .inner-content .card-title span {
        font-weight: bold;
        font-size: 30px;
    }

    .inner-content .card-data {
        width: 10%;
        display: inline-block;
        vertical-align: middle;
    }

    .inner-content .card-data span {
        font-weight: bold;
        font-size: 20px;
    }

    .card-body {
        margin: 0 auto;
        width: 35%;
    }

    .button-confirmation {
        margin: 0 auto;
        width: 40%;
    }
</style>

<body>
    <div class="tile-container">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="card-title">
                            <span>You are invited to join a team in nSmartrac</span>
                        </div>
                        <div class="card-body">
                            <div class="question-msg">
                                <h5>Do you want to accept this invitation?</h5>
                            </div>
                            <div class="button-confirmation">
                                <a href="<?php echo site_url() ?>invite/" class="btn btn-success">Yes</a>
                                <a href="" class="btn btn-danger">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="/assets/dashboard/js/jquery.min.js"></script>
<script src="/assets/dashboard/js/bootstrap.bundle.min.js"></script>