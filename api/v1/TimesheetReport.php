<?php
use PHPMailer;

include_once("includes.php");
require_once '/home4/admintommy/public_html/vendor/autoload.php';
require_once __DIR__.'/server.php';

// init
$response = "";

// CHECK AUTHORIZATION
/*if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
    $server->getResponse()->send();

    header("HTTP/1.0 403 Authorization Failed!");
    $response = array("Status" => "error", "Code" => "403", "Message" => "Authorization Failed!");
    echo json_encode($response);
} else {*/
    // get request method
    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method) {

        case 'POST':
            SEND_REPORT();
            break;
        default:
            // Unauthorized Request
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode($response);
            break;
    }
//}


/***** FUNCTIONS *****/

function SEND_REPORT() {

    $params = json_decode(file_get_contents('php://input'),true);
    $requester      = $params['requester'];
    $email          = $params['email'];
    $subject        = $params['subject'];
    $message        = $params['message'];
    $date           = $params['date'];
    $link           = $params['link'];
    $total_hours    = $params['total_hours'];
    $total_break    = $params['total_break'];
    $total_overtime = $params['total_overtime'];
    $total_pto      = $params['total_pto'];


    // send email
    $mail = new PHPMailer();
    $mail->isSendmail();
    $mail->setFrom('no-reply@nsmartrac.com', 'nSmarTrac.com');
    $mail->addReplyTo('no-reply@nsmartrac.com', 'nSmarTrac.com');
    $mail->addAddress($email, $requester);
    $mail->addAddress("nsmartllc@gmail.com");

    $mail->Subject = $subject;

    $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <style type="text/css">
                        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
                        body{width:100% !important; margin:0; font-family:Open Sans;}
                        body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */
                        body{margin:0; padding:0;}
                        img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
                        table td{border-collapse:collapse;}
                        #backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}
                        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700); /* Loading Open Sans Google font */
                        body, #backgroundTable{ background-color:#FFF; }
                        .TopbarLogo{
                        padding:10px;
                        text-align:left;
                        vertical-align:middle;
                        }
                        h1, .h1{
                        color:#444444;
                        display:block;
                        font-family:Open Sans;
                        font-size:35px;
                        font-weight: 400;
                        line-height:100%;
                        margin-top:2%;
                        margin-right:0;
                        margin-bottom:1%;
                        margin-left:0;
                        text-align:left;
                        }
                        h2, .h2{
                        color:#444444;
                        display:block;
                        font-family:Open Sans;
                        font-size:30px;
                        font-weight: 400;
                        line-height:100%;
                        margin-top:2%;
                        margin-right:0;
                        margin-bottom:1%;
                        margin-left:0;
                        text-align:left;
                        }
                        h3, .h3{
                        color:#444444;
                        display:block;
                        font-family:Open Sans;
                        font-size:24px;
                        font-weight:400;
                        margin-top:2%;
                        margin-right:0;
                        margin-bottom:1%;
                        margin-left:0;
                        text-align:left;
                        }
                        h4, .h4{
                        color:#444444;
                        display:block;
                        font-family:Open Sans;
                        font-size:18px;
                        font-weight:400;
                        line-height:100%;
                        margin-top:2%;
                        margin-right:0;
                        margin-bottom:1%;
                        margin-left:0;
                        text-align:left;
                        }
                        h5, .h5{
                        color:#444444;
                        display:block;
                        font-family:Open Sans;
                        font-size:14px;
                        font-weight:400;
                        line-height:100%;
                        margin-top:2%;
                        margin-right:0;
                        margin-bottom:1%;
                        margin-left:0;
                        text-align:left;
                        }
                        .textdark {
                        color: #444444;
                        font-family: Open Sans;
                        font-size: 13px;
                        line-height: 150%;
                        text-align: left;
                        }
                        .textwhite {
                        color: #fff;
                        font-family: Open Sans;
                        font-size: 13px;
                        line-height: 150%;
                        text-align: left;
                        }
                        .fontwhite { color:#fff; }
                        .btn {
                        background-color: #e5e5e5;
                        background-image: none;
                        filter: none;
                        border: 0;
                        box-shadow: none;
                        padding: 7px 14px;
                        text-shadow: none;
                        font-family: "Segoe UI", Helvetica, Arial, sans-serif;
                        font-size: 14px;
                        color: #333333;
                        cursor: pointer;
                        outline: none;
                        -webkit-border-radius: 0 !important;
                        -moz-border-radius: 0 !important;
                        border-radius: 0 !important;
                        }
                    </style>
                </head>
                <body style="width:100% !important; margin:0; -webkit-text-size-adjust:none;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ffffff; height:64px;">
                        <tr>
                            <td align="center">
                                <center>
                                    <table border="0" cellpadding="0" cellspacing="0" width="400px" style="height:100%;">
                                        <tr>
                                            <td align="left" valign="middle" style="padding-left:20px;">
                                                <img src="https://nsmartrac.com/assets/frontend/images/logo.png" height="51" alt="nSmarTrac Logo" />
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                        </tr>
                    </table>
					<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ffffff; height:64px;">
						<tr>
							<td align="center">
								<center>
									<table border="0" cellpadding="0" cellspacing="0" width="400px" style="height:100%;">
										<tr>
											<td align="left" valign="middle" style="padding-left:20px;">
												<h3>Timesheet Report</h3>
                                                <p>' . $date . '</p>
											</td>
										</tr>
									</table>
								</center>
							</td>
						</tr>
					</table>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td>
                                <center>
                                    <table border="0" cellpadding="0" cellspacing="0" width="400px" style="height:100%;">
                                        <tr>
                                            <td height="20px"></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="bottom" style="padding-left:20px; padding-bottom:20px">
                                                <p>Hi ' . $requester . ',</p>
                                                <div class="textdark">
                                                    <p>' . $message . '</p><br><br>
                                                    <p><a href="https://nsmartrac.com/api/v1/generate-timesheet-report.php?type=csv&' . $link . '" style="background-color: #4CB052; color: #ffffff; width: 150px;">DOWNLOAD .CSV</a></p><br>
                                                    <p><a href="https://nsmartrac.com/api/v1/generate-timesheet-report.php?type=pdf&' . $link . '" style="background-color: #4CB052; color: #ffffff; width: 150px;">DOWNLOAD .PDF</a></p><br><br><br><hr>
                                                    <h4>Total Work Hours • ' . $total_hours . '</h4><br><br><br>
                                                    <p style="color: #ccc;">----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Regular</p><br>
                                                    <h4>----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $total_hours . '</h4><br>
                                                    <p style="color: #ccc;">----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Overtime</p><br>
                                                    <h4>----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $total_overtime . '</h4><br>
                                                    <p style="color: #ccc;">----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Break</p><br>
                                                    <h4>----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $total_break . '</h4><br>
                                                    <p style="color: #ccc;">----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PTO</p><br>
                                                    <h4>----- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $total_pto . '</h4><br><br><br>
                                                    <p><a href="https://nsmartrac.com/dashboard" style="background-color: #cccccc; color: #000000; width: 300px;">VISIT MY ACCOUNT</a></p><br>
                                                    <p>Thanks, <br><b>nSmarTrac Team<b></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>';


    $mail->msgHTML($body);

    //send the message, check for errors
    if (!$mail->send()) {
        $response = array("Status" => "error", "Code" => "400", "Message" => $mail->ErrorInfo);
        header("HTTP/1.0 400 Bad Request");
    } else {
        $response = array("Status" => "success", "Code" => 200, "Message" => "Sending report successful.");
        header("HTTP/1.0 200 OK");
    }

    /*$header = "From: no-reply@nsmartrac.com \r\n";
    $header .= "Cc: nsmartllc@gmail.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    if (mail ($email, $subject, $body, $header)) {
        $response = array("Status" => "success", "Code" => 200, "Message" => "Sending report successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Sending report failed!");
        header("HTTP/1.0 400 Bad Request");
    }*/

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}



//////////
?>
