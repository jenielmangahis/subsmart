<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clock Reminder</title>
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
                            <h2>Daily CLock Reminder</h2>
                        </div>
                        <div>
                            <div style="margin-top: 50px;">
                                <div style="margin-top: 20px;">
                                    <span>Hi Admin,</span>
                                </div>
                                <div>
                                    <p>
                                        Latest time entry has been running for 8 hours by now of <strong><?php echo $name?></strong>. Please check
                                    </p> 
                                     
                                </div>
                                <div>
                                    Thank you.
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
