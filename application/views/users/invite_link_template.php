<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invite link</title>
    <style>
        @media (max-width: 550px) {
            a{
                min-width: 80% !important;
            }
        }
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 16px;" >
<div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto;">
    <div>
        <div>
            <div>
                <div style="padding: 20px;">
                    <div style="padding: 10px;">
                        <div>
                            <h2>Invite to join nSmartrac</h2>
                        </div>
                        <div>
                            <div style="margin-top: 50px;">
                                <div style="margin-top: 20px;">
                                    <span>Hi,</span>
                                </div>
                                <div>
                                    <p>
                                        <strong><?php echo $name?></strong> has invited You to join ADI's account in nSmartrac.
                                    </p>
                                    <p>nSmartrac is a simple time tracking app.</p>
                                    <p>Tap a button to clock in and start tracking your time. Your work hours turn into simeple,
                                        accutrate tiemsheet reports automatically.
                                    </p>
                                    <p>Join the rest of the team today!</p>
                                </div>
                                <div>
                                    <a href="<?php echo site_url()?>invite/confirmation?t=<?php echo $link?>" style="
                                    text-decoration: none;
                                    display: block;
                                    margin-bottom: 10px;
                                    border-radius: 0;
                                    color: #fff;
                                    text-align: center;
                                    vertical-align: middle;
                                    user-select: none;
                                    background-color: #28a745;
                                    font-weight: bold;
                                    border: 1px solid transparent;
                                    padding: 8px;
                                    line-height: 1.5;
                                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                                    font-size: 15px;
                                    text-transform:uppercase;
                                    width: 20%;
                                    ">
                                        create account</a>
                                </div>
                                <div>
                                    <p>If you still have questions or need any help, simply reply to this email.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
