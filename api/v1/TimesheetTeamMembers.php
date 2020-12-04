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

        case 'DELETE':
			$flag	= trim($_GET["flag"]); // ALL

			if ($flag == "ALL") {
				DELETE_ALL();
			} else {
                DELETE(trim($_GET["id"]));
            }
            break;
        case 'GET':
            if (isset($_GET['id']) == true) {
                GET(trim($_GET["id"]), "ONE", trim($_GET["status"]));
            } else {
                GET(trim($_GET["company_id"]), "ALL", trim($_GET["status"]));
            }
            break;
        case 'POST':
            INSERT();
            break;
        case 'PUT':
            UPDATE(trim($_GET["id"]));
            break;
        default:
            // Unauthorized Request
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode($response);
            break;
    }
//}


/***** FUNCTIONS *****/
function DELETE_ALL() {

    $db = new database_handler();
    $delete = $db->executeQuery("delete from timesheet_team_members");

    if($delete) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Deleting all data successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Deleting all data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function DELETE($id) {

    $db = new database_handler();
    $delete = $db->executeQuery("delete from timesheet_team_members where id = $id");

    if($delete) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Deleting data successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Deleting data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function GET($id, $flag = "ALL", $status = "") {
    // create query
    $query = "select * from timesheet_team_members where company_id = $id";

    if ($flag == "ONE") {
        $query = "select * from timesheet_team_members where id = $id";
    }

    // check
    if ($status != "") {
        $query .= " and status = $status";
    }

    $db = new database_handler();
    $rows = $db->fetchAll($query);

    // init array
    $team = array();

    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // init array
        $data = array();

        // get active attendance
        $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id order by date_created desc");

        // init vars
        $total_hours = 0.0;
        $total_break = 0.0;
        $total_overtime = 0.0;
        $total_pto = 0.0;

        // iterate rows
        foreach ($attendance as $item) {
            // get id
            $attendance_id = $item['id'];

            $total_hours += doubleval($item['shift_duration']);
            $total_break += doubleval($item['break_duration']);
            $total_overtime += doubleval($item['overtime']);

            // init logs array
            $mLogs = array();

            // get logs
            $logs = $db->fetchAll("select * from timesheet_logs where attendance_id = $attendance_id order by id asc");
            // iterate logs
            foreach ($logs as $log) {
                // get approved_by
                $approved_by = $log['approved_by'];

                // check
                if ($approved_by != 0) {
                    $user = $db->fetchRow("select *, concat(FName, ' ', LName) as full_name from users where id = $approved_by");
                    $log['approved_by_name'] = $user['full_name'];
                }

                array_push($mLogs, $log);
            }

            $item['logs'] = $mLogs;

            array_push($data, $item);
        }
        // attendance
        $row['attendance'] = $data;

        // get pto
        $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and date(tld.date) = curdate()");
        // iterate rows
        foreach ($leave as $item) {
            // get total hours
            $total_pto += doubleval($item['total_hours']);
        }
        $row['leave'] = $leave;

        $row['total_hours']     = $total_hours;
        $row['total_break']     = $total_break;
        $row['total_overtime']  = $total_overtime;
        $row['total_pto']       = $total_pto;

        array_push($team, $row);
    }

    $response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $team);
    header("HTTP/1.0 200 OK");

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function INSERT() {

    $params = json_decode(file_get_contents('php://input'),true);
    $email  = $params['email'];
    $sender = $params['sender'];
    $company_name   = $params['company_name'];

    unset($params['sender']);
    unset($params['company_name']);

    $db = new database_handler();
    $insert = $db->insertQuery($params, "timesheet_team_members");

    if($insert) {
        // check if email exist on the system
        $exist = $db->fetchRow("select *, count(*) as count from users where email = '$email'");
        // check
        if ($exist['count'] == 1) {
            // send email
            sendEmail($email, $sender, $company_name);
        } else {
            // send invite email
            sendInviteEmail($email, $sender, $company_name);
        }

        $response = array("Status" => "success", "Code" => 200, "Message" => "Adding data successful.", "Data" => $insert['inserted_id']);
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => 400, "Message" => "Adding data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}

function UPDATE($id) {

    $params = json_decode(file_get_contents('php://input'),true);

    $db = new database_handler();
    $update = $db->updateQuery($params,'timesheet_team_members', $id,'id');

    if($update) {
        $response = array("Status" => "success", "Code" => "200", "Message" => "Updating data successful.");
        header("HTTP/1.0 200 OK");
    } else {
        $response = array("Status" => "error", "Code" => "400", "Message" => "Updating data failed!");
        header("HTTP/1.0 400 Bad Request");
    }

    // return the header
    header('Content-Type: application/json');
    echo json_encode($response);
}



//////////

function sendEmail($email, $sender, $company_name) {
    // send email
    $mail = new PHPMailer();
    $mail->isSendmail();
    $mail->setFrom('no-reply@nsmartrac.com', 'nSmarTrac.com');
    $mail->addReplyTo('rno-reply@nsmartrac.com', 'nSmarTrac.com');
    $mail->addAddress($email, $requester);
    $mail->addAddress("nsmartllc@gmail.com");

    $mail->Subject = $sender. " Has Added You to nSmarTrac Time Clock";

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
												<h3>Added to nSmarTrac Time Clock</h3>
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
                                                <p>Hi,</p>
                                                <div class="textdark">
                                                    <p>' . $sender . ' has added You to ' . $company_name . '\'s account in nSmarTrac Time Clock.</p><br>
                                                    <p>Tap a button to clock in and start tracking your time. Your work hours turn into simple, accurate timesheet reports automatically.</p><br>
                                                    <p>Use nSmarTrac Time Clock today!</p><br>
                                                    <p><a href="https://nsmartrac.com/dashboard" style="background-color: #4CB052; color: #ffffff; width: 150px;">VISIT MY ACCOUNT</a></p><br>
                                                    <p>If you still have questions or need any help, simply reply this email.</p><br><br>
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
        // successful
    }
}

function sendInviteEmail($email, $sender, $company_name) {
    // send email
    $mail = new PHPMailer();
    $mail->isSendmail();
    $mail->setFrom('no-reply@nsmartrac.com', 'nSmarTrac.com');
    $mail->addReplyTo('rno-reply@nsmartrac.com', 'nSmarTrac.com');
    $mail->addAddress($email, $requester);
    $mail->addAddress("nsmartllc@gmail.com");

    $mail->Subject = $sender. " Has Invited You to nSmarTrac";

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
												<h3>Invite to Join nSmarTrac</h3>
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
                                                <p>Hi,</p>
                                                <div class="textdark">
                                                    <p>' . $sender . ' has invited You to join ' . $company_name . '\'s account in nSmarTrac.</p><br>
                                                    <p>nSmarTrac is a CRM built to meet the needs of your service business. With customizable solutions for just about any industry, we can provide just what your business needs to succeed.</p><br>
                                                    <p>For nSmarTrac Time Clock, tap a button to clock in and start tracking your time. Your work hours turn into simple, accurate timesheet reports automatically.</p><br>
                                                    <p>Join the rest of the team today!</p><br>
                                                    <p><a href="#" style="background-color: #4CB052; color: #ffffff; width: 150px;">CREATE ACCOUNT</a></p><br>
                                                    <p>If you still have questions or need any help, simply reply this email.</p><br><br>
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
        // successful
    }
}
?>
