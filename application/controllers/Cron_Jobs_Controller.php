<?php
defined('BASEPATH') or exit('No direct script access allowed');

define("FIREBASE_API_KEY", "AAAAGdnNhSA:APA91bERYT0vPfk5mH7M_UYgIDTdLDLgEsTUDue9WJRbsqhpTXOPwsamzXoUB0BmaFJxoXX5p2RzSy_cvI96uolp0_iZV2FuQgUjusGbVDVtshbBzGLTZYhIiSqt5lbsuXV9lNsnaLOk");

class Cron_Jobs_Controller extends CI_Controller
{
    private $timesheet_report_timezone = "UTC";
    private $timesheet_report_timezone_id = 0;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('timesheet_model');
        $this->load->model('invoice_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('tags_model');
        $this->load->model('chart_of_accounts_model');

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
    }
    public function get_time_sheet_storage($company_id, $timezone, $timesheet_report_timezone_id)
    {
        $this->timesheet_report_timezone = $timezone;
        $this->timesheet_report_timezone_id = $timesheet_report_timezone_id;
        $date_from = date("Y-m-d", strtotime('sunday last week', strtotime(date('Y-m-d'))));
        $date_to = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
        $filename = $date_from . " to " . $date_to . ' ' . $company_id . ' ' . $timesheet_report_timezone_id . '.csv';
        $filename_pdf = $date_from . " to " . $date_to . ' ' . $company_id . ' ' . $timesheet_report_timezone_id . '.pdf';
        $time_sheet_storage = $this->generate_timelogs($date_from, $date_to, $filename, $company_id);
        return array($filename, $date_from, $time_sheet_storage, $filename_pdf);
    }
    public function timelogs_csv_email_sender(
        $receiver,
        $company_name,
        $filename,
        $date_from,
        $FName,
        $business_name,
        $file_info,
        $logo_folder,
        $company_logo,
        $est_wage_privacy
    ) {
        $date_to = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
        $subj_date_to = date("d", strtotime($date_to));
        if (date("d", strtotime($date_from)) > date("d", strtotime($date_to))) {
            $subj_date_to = date("M d", strtotime($date_to));
        }
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = $company_name . ': Time logs for Week ' . date("M d", strtotime($date_from)) . ' to ' . $subj_date_to;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['company_name'] = $company_name;
        $this->page_data['date_from'] = $date_from;
        $this->page_data['date_to'] = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
        $this->page_data['business_name'] = $business_name;
        $this->page_data['FName'] = $FName;
        $this->page_data['file_info'] = $file_info;
        $this->page_data['file_link'] = base_url() . '/timesheet/timelogs/' . $filename;
        $this->page_data['has_logo'] = false;
        $this->page_data['est_wage_privacy'] = $est_wage_privacy;
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        $filePath = base_url() . '/uploads/users/business_profile/' . $logo_folder . '/' . $company_logo;
        if (@getimagesize($filePath)) {
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $logo_folder . '/' . $company_logo, 'company_logo', $company_logo);
            $this->page_data['has_logo'] = true;
        }
        $mail->Body =  'Timesheet Report.';
        $content = $this->load->view('users/timesheet/emails/weekly_timelogs_report', $this->page_data, true);
        $mail->MsgHTML($content);
        $mail->addAddress('webtestcustomer@nsmartrac.com');
        // echo "pasok";
        // $mail->addAddress($receiver);
        if (!$mail->Send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        }
    }

    public function get_admin_for_reports()
    {
        date_default_timezone_set('UTC');
        $hour_now = date("H") . ":00:00";
        if (date("Y-m-d", strtotime('sunday this week', strtotime(date('Y-m-d')))) == date("Y-m-d")) {
            $all_admin_report_settings = $this->timesheet_model->get_all_admin_report_settings();
            $and_query = "";
            foreach ($all_admin_report_settings as $setting) {
                if ($and_query == "") {
                    $and_query = " id != " . $setting->user_id;
                } else {
                    $and_query .= " and id !=" . $setting->user_id;
                }
            }
            $all_admin_for_default_report = $this->timesheet_model->get_all_admin_for_default_report($and_query);
            foreach ($all_admin_for_default_report as $admin) {
                $this->timesheet_model->save_timezone_changes("36", $admin->id, 1, 3, "Sun", "00:00:00", $admin->email);
            }
        }
        $admins_subject_for_report = $this->timesheet_model->get_admins_subject_for_report($hour_now);
        $date_hour_now_pst = date('Y-m-d') . " " . $hour_now;
        $admins_for_reports = array();
        // var_dump($admins_subject_for_report);
        foreach ($admins_subject_for_report as $admin) {
            $date_hour_now_selected_tz = $this->datetime_zone_converter($date_hour_now_pst, 'UTC', $admin->id_of_timezone);
            $week_day = date("D", strtotime($date_hour_now_selected_tz));
            $schedules = explode(",", $admin->schedule_day);
            $found = false;
            for ($i = 0; $i < count($schedules); $i++) {
                if ($schedules[$i] == $week_day) {
                    $found = true;
                    break;
                }
            }
            if ($found) {
                $admins_for_reports[] = array($admin->user_id, $admin->company_id);
            }
        }
        return $admins_for_reports;
    }
    public function timesheet_report_sender()
    {
        $this->auto_clockout();
        $this->delete_old_timesheet_reports_and_notifications();
        $admins_for_reports = $this->get_admin_for_reports();
        var_dump($admins_for_reports);
        $android_tokens = array();
        $ios_tokens = array();
        for ($i = 0; $i < count($admins_for_reports); $i++) {
            $admin = $this->timesheet_model->get_user_and_company_details($admins_for_reports[$i][0]);
            if ($admin != null) {
                $file_info = $this->get_time_sheet_storage($admin->company_id, $admin->id_of_timezone, $admin->timezone_id);
                $est_wage_privacy = $this->timesheet_model->get_timesheet_report_privacy($admin->company_id)->est_wage_private;
                $date_from = date("Y-m-d", strtotime('sunday last week', strtotime(date('Y-m-d'))));
                $date_to = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
                $subscribed = false;
                if ($admin->subscribed == 1) {
                    $subscribed = true;
                }
                if ($subscribed) {
                    $this->generate_timelogs_csv($file_info[2], $file_info[0], $est_wage_privacy);
                    $this->generate_weekly_timesheet_pdf_report($file_info, $admin->business_name, $est_wage_privacy);
                    // var_dump($admins_for_reports);
                    echo "<br><br>";
                    $this->timelogs_csv_email_sender(
                        $admin->email_report,
                        $admin->business_name . "",
                        $file_info[0],
                        $date_from,
                        $admin->FName,
                        $admin->business_name,
                        $file_info,
                        $admin->logo_folder_id,
                        $admin->business_image,
                        $est_wage_privacy
                    );
                    $this->timesheet_model->save_timesheet_report_file_names($admin->user_id, $file_info[0]);
                    $this->timesheet_model->save_timesheet_report_file_names($admin->user_id, $file_info[3]);
                    if ($admin->device_type == "Android") {
                        $android_tokens[] = $admin->device_token;
                    } elseif ($admin->device_type == "iOS") {
                        $ios_tokens[] = $admin->device_token;
                    }
                }
            }
        }
        $title = "Timesheet Report";
        $body = "Timesheet report for week " . date("M d", strtotime($date_from)) . " to " . date("M d", strtotime($date_to)) . " has been sent to your email. If you don't see it in your inbox, kindly check your spam.";
        if (count($android_tokens) > 0) {
            $this->send_android_push($android_tokens, $title, $body);
        }
        if (count($ios_tokens) > 0) {
            $this->send_ios_push($ios_tokens, $title, $body);
        }
    }
    public function delete_old_timesheet_reports_and_notifications()
    {
        $date_lastweek = date("Y-m-d", strtotime("monday last week"));
        //deleting all report from previous month
        $old_timesheet_reports = $this->timesheet_model->get_old_timesheet_reports($date_lastweek);
        foreach ($old_timesheet_reports as $reports) {
            $file_pointer = dirname(__DIR__, 2) . '/timesheet/timelogs/' . $reports->file_name;
            if (file_exists($file_pointer)) {
                // Use unlink() function to delete a file
                unlink($file_pointer);
            }
        }
        $this->timesheet_model->delete_old_timesheet_reports($date_lastweek);
        $this->timesheet_model->delete_old_notifications($date_lastweek);
    }
    public function generate_weekly_timesheet_pdf_report($file_info, $business_name, $est_wage_privacy)
    {
        $date_from = date("Y-m-d", strtotime('sunday last week', strtotime(date('Y-m-d'))));
        $date_to = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
        $this->page_data['file_info'] = $file_info;
        $this->page_data['date_from'] = $date_from;
        $this->page_data['date_to'] = $date_to;
        $this->page_data['business_name'] = $business_name;
        $this->page_data['timesheet_report_timezone'] = $this->timesheet_report_timezone;
        $this->page_data['est_wage_privacy'] = $est_wage_privacy;
        $content = $this->load->view('users/timesheet/emails/html_to_pdf_weekly_report', $this->page_data, true);
        $this->load->library('Reportpdf');
        $title = 'Timesheet Weekly Report for Pay Period ' . date('M d', strtotime($date_from)) . ' - ' . date('d');
        $obj_pdf = new Reportpdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        $res = copy(dirname(__DIR__, 2) . '/assets/img/timesheet/logojpg.jpg', dirname(__DIR__, 2) . '/assets/img/timesheet/' . 'logojpg2' . ".jpg");
        // echo 'image' . ($res ? '' : ' not') . ' created';

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('L');
        $html = '<div style="text-align:center">
        <img src="' . dirname(__DIR__, 2) . '/assets/img/timesheet/logojpg2.jpg' . '" alt="test alt attribute" width="300" height="60" border="0" /></div>';
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $obj_pdf->Output(dirname(__DIR__, 2) . '/timesheet/timelogs/' . $file_info[3], 'F');
        $obj_pdf->Close();
    }
    public function generate_timelogs_csv($timehseet_storage, $filename, $est_wage_privacy)
    { // file name
        $file = fopen(APPPATH . '../timesheet/timelogs/' . $filename, 'wb');
        if ($est_wage_privacy == 1) {
            $header = array(
                "Employee",
                "Date (" . $this->timesheet_report_timezone . ")",
                "Role",
                "Wage",
                "Time Card (" . $this->timesheet_report_timezone . ")",
                "Act.& Sched Diff.",
                "Total Paid",
                "Regular",
                "Overtime",
                "Est. Wages",
                "Notes",
            );
        } else {
            $header = array(
                "Employee",
                "Date (" . $this->timesheet_report_timezone . ")",
                "Role",
                "Wage",
                "Time Card (" . $this->timesheet_report_timezone . ")",
                "Act.& Sched Diff.",
                "Total Paid",
                "Regular",
                "Overtime",
                "Notes",
            );
        }
        // $file = fopen('php://output', 'w');
        fputcsv($file, $header);

        $id_running = -1;
        $started = false;
        $table = '';
        $time_card_ctr = 0;
        $act_dif_total = 0;
        $total_paid = 0;
        $total_regular = 0;
        $total_overtime = 0;
        $total_wage = 0;
        $total_est_wage = 0;
        $overall_act_dif_total = 0;
        $overall_total_paid = 0;
        $overall_total_regular = 0;
        $overall_total_overtime = 0;
        $overall_total_wage = 0;
        $overall_total_est_wage = 0;
        $overall_time_card_ctr = 0;
        $name = '';
        for ($i = 0; $i < count($timehseet_storage); $i++) {
            $data = array();
            if ($id_running != $timehseet_storage[$i][0]) {
                if (!$started) {
                    $started = true;
                    $name =  $timehseet_storage[$i][1];
                } else {
                    $data[] = 'Total for ' . $timehseet_storage[$i - 1][1];
                    $data[] = '';
                    $data[] = '';
                    $data[] = $total_wage;
                    $data[] = $time_card_ctr . ($time_card_ctr > 1 ? ' Time cards' : ' Time card');
                    $data[] = $act_dif_total;
                    $data[] = $total_paid;
                    $data[] = $total_regular;
                    $data[] = $total_overtime;
                    if ($est_wage_privacy == 1) {
                        $data[] = $total_est_wage;
                    }
                    $data[] = '';
                    fputcsv($file, $data);
                    $data = array();
                }
                $time_card_ctr = 0;
                $act_dif_total = 0;
                $total_paid = 0;
                $total_regular = 0;
                $total_overtime = 0;
                $total_wage = 0;
                $total_est_wage = 0;
                $id_running = $timehseet_storage[$i][0];
            }
            $clockout = ($timehseet_storage[$i][7] == '' ? '' : date("M d h:i A", strtotime($timehseet_storage[$i][7])));
            if ($timehseet_storage[$i][7] == '') {
                $actual_vs_expected = '-';
                $expected = 8;
            } else {
                $actual_vs_expected = $timehseet_storage[$i][10] == '' ?  8 - round($timehseet_storage[$i][18], 2) . "" : "0.00";
            }
            $regular_hours = ($timehseet_storage[$i][12] == '' ? 8 : $timehseet_storage[$i][12]);
            $paid_hours = ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][18] : round($timehseet_storage[$i][18], 2));

            $est_wage = 0;
            if ($timehseet_storage[$i][21] == "hourly") {
                $est_wage = round($paid_hours * $timehseet_storage[$i][20], 2);
            } else {
                $est_wage = round(($timehseet_storage[$i][20] / $regular_hours) * $paid_hours, 2);
            }
            $data[] = $timehseet_storage[$i][1];
            $data[] = date("D M d", strtotime($timehseet_storage[$i][3]));
            $data[] = $timehseet_storage[$i][2];
            $data[] = $timehseet_storage[$i][20];
            $data[] = date("h:i A", strtotime($timehseet_storage[$i][6])) . ' - ' . ($timehseet_storage[$i][7] == '' ? 'No clockout' : date("h:i A", strtotime($timehseet_storage[$i][7])));
            $data[] = $actual_vs_expected;
            $data[] = $paid_hours;
            $data[] = $regular_hours;
            $data[] = ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][16] : 0.00);
            if ($est_wage_privacy == 1) {
                $data[] = $est_wage;
            }

            $data[] = $timehseet_storage[$i][19];
            fputcsv($file, $data);
            $data = array();
            $time_card_ctr++;
            $act_dif_total += $timehseet_storage[$i][7] == '' ? 0 : $actual_vs_expected;
            $total_regular += ($timehseet_storage[$i][12] == '' ? 8 : $timehseet_storage[$i][12]);
            $total_paid += $paid_hours;
            $total_overtime += ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][16] : 0.00);
            $total_wage += $timehseet_storage[$i][20];
            $total_est_wage += $est_wage;
            $overall_act_dif_total += $timehseet_storage[$i][7] == '' ? 0 : $actual_vs_expected;
            $overall_total_regular += ($timehseet_storage[$i][12] == '' ? 8 : $timehseet_storage[$i][12]);
            $overall_total_paid += $paid_hours;
            $overall_total_overtime += ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][16] : 0.00);
            $overall_total_wage += $timehseet_storage[$i][20];
            $overall_total_est_wage += $est_wage;
            $overall_time_card_ctr++;
            if ($i == count($timehseet_storage) - 1) {
                $data[] = 'Total for ' . $timehseet_storage[$i][1];
                $data[] = '';
                $data[] = '';
                $data[] = $total_wage;
                $data[] = $time_card_ctr . ($time_card_ctr > 1 ? ' Time cards' : ' Time card');
                $data[] = $act_dif_total;
                $data[] = $total_paid;
                $data[] = $total_regular;
                $data[] = $total_overtime;
                if ($est_wage_privacy == 1) {
                    $data[] = $total_est_wage;
                }
                $data[] = '';
                fputcsv($file, $data);
                $data = array();
            }
        }
        $data = array();
        $data[] = 'Total for this Pay Period';
        $data[] = '';
        $data[] = '';
        $data[] =  $overall_total_wage;
        $data[] = $overall_time_card_ctr . ($overall_time_card_ctr > 1 ? ' Time cards' : ' Time card');
        $data[] = $overall_act_dif_total;
        $data[] = $overall_total_paid;
        $data[] = $overall_total_regular;
        $data[] = $overall_total_overtime;
        if ($est_wage_privacy == 1) {
            $data[] = $overall_total_est_wage;
        }
        $data[] = '';
        fputcsv($file, $data);
    }
    public function generate_timelogs($date_from, $date_to, $filename, $company_id)
    {
        $date_from = $this->datetime_zone_converter($date_from . " 00:00:00", $this->timesheet_report_timezone, "UTC");
        $date_to = $this->datetime_zone_converter($date_to . " 24:59:00", $this->timesheet_report_timezone, "UTC");

        $attendances = $this->timesheet_model->get_all_attendance($date_from, $date_to, $company_id);



        $time_sheet_storage = array();
        foreach ($attendances as $attendance) {
            $data = array();
            $shift_date = $this->datetime_zone_converter($attendance->date_created, "UTC", $this->timesheet_report_timezone);
            $data[] = $attendance->user_id; //0
            $data[] = $attendance->FName . ' ' .   $attendance->LName; //1
            $data[] = $attendance->title; //2
            $data[] = $shift_date; //3

            date_default_timezone_set("UTC");
            $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date(date("Y-m-d", strtotime($attendance->date_created)), $attendance->user_id);
            $shift_start = '';
            $shift_end = '';
            $expected_hours = '';
            $expected_break = '';
            $expected_work_hours = '';
            foreach ($shift_schedules as $sched) {
                $shift_start = $this->datetime_zone_converter($sched->shift_start, "UTC", $this->timesheet_report_timezone);
                $shift_end = $this->datetime_zone_converter($sched->shift_end, "UTC", $this->timesheet_report_timezone);
                $expected_hours = $sched->duration;
                $expected_break = 0;
                if ($expected_hours > 4) {
                    $expected_break = 30;
                }
                if ($expected_hours > 6) {
                    $expected_break += 15;
                }
                if ($expected_hours >= 8) {
                    $expected_break = 60;
                }
                $expected_work_hours = round((($expected_hours * 60) - $expected_break) / 60, 2);
            }

            $data[] = $shift_start; //4
            $data[] = $shift_end; //5



            $auxes = $this->timesheet_model->get_logs_of_attendance($attendance->id);
            $checkin = '';
            $checkout = '';
            $breakin = '';
            $breakout = '';

            foreach ($auxes as $aux) {
                $newdate = $this->datetime_zone_converter($aux->date_created, "UTC", $this->timesheet_report_timezone);
                if ($aux->action == "Check in") {
                    $checkin = $newdate;
                } elseif ($aux->action == "Check out") {
                    $checkout = $newdate;
                } elseif ($aux->action == "Break in") {
                    $breakin = $newdate;
                } elseif ($aux->action == "Break out") {
                    $breakout = $newdate;
                }
            }
            $pay_rate = 0;
            $pay_type = '';
            $employee_pay_details = $this->timesheet_model->get_employee_pay_details($attendance->user_id);
            foreach ($employee_pay_details as $pay_detail) {
                if ($expected_work_hours == '') {
                    $expected_work_hours = $pay_detail->hours_per_day;
                }
                $pay_rate = $pay_detail->pay_rate;
                $pay_type = $pay_detail->pay_type;
            }
            $data[] = $checkin; //6
            $data[] = $checkout; //7
            $data[] = $breakin; //8
            $data[] = $breakout; //9
            $data[] = $expected_hours; //10
            $data[] = $expected_break; //11
            $data[] = $expected_work_hours; //12
            $data[] =  ($attendance->shift_duration + $attendance->overtime); //13

            $data[] = $attendance->break_duration; //14

            $minutes_late = "";
            if ($shift_start != '') {
                $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin) * 60;
            }
            $data[] = round($minutes_late, 2); //15
            $overtime = 0;
            if ($expected_hours != '') {
                if ($expected_work_hours < ($attendance->shift_duration + $attendance->overtime)) {
                    $overtime = round(($attendance->shift_duration + $attendance->overtime) - $expected_work_hours, 2);
                } elseif ($attendance->shift_duration == 0) {
                    $overtime = 0;
                } else {
                    $overtime = $expected_work_hours;
                }
            } else {
                $overtime = $attendance->overtime;
            }
            $data[] = $overtime; //16
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
            } else {
                $ot_status = "Approved";
            }
            $data[] = $ot_status; //17
            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status == "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }

            $data[] = $payable_hours; //18
            $data[] = $attendance->notes; //19
            $data[] = $pay_rate; //20
            $data[] = $pay_type; //21
            $time_sheet_storage[] = $data;
        }
        return $time_sheet_storage;
    }

    public function get_differenct_of_dates($date_start, $date_end)
    {
        $start = new DateTime($date_start);
        $end =  new DateTime($date_end);
        $interval = $start->diff($end);

        $difference = ($interval->days * 24 * 60) * 60;
        $difference += ($interval->h * 60) * 60;
        $difference += ($interval->i) * 60;
        $difference += $interval->s;
        return ($difference / 60) / 60; //in hours
    }
    public function datetime_zone_converter($olddate, $from_timezone, $to_timezone)
    {
        date_default_timezone_set($from_timezone);
        $the_date = strtotime($olddate);
        date_default_timezone_set($to_timezone);
        $newdate = date("Y-m-d H:i:s", $the_date);
        return $newdate;
    }
    public function index()
    {
        add_css(array(
            "assets/css/trac360/people.css"
        ));
        $company_id = logged('company_id');
        $user_id = logged('id');

        $user_locations = $this->trac360_model->get_current_user_location($company_id);
        $locations = array();
        foreach ($user_locations as $user) {
            $found = false;
            $found_ctr = 0;
            $current_user_location = "";
            if ($user->last_tracked_location != "") {
                for ($i = 0; $i < count($locations); $i++) {
                    if ($locations[$i][0] == $user->last_tracked_location) {
                        $found = true;
                        $found_ctr = $i;
                        break;
                    }
                }
                if (!$found) {
                    $locations[] = array($user->last_tracked_location, array($user->name), $user->profile_img);
                } else {
                    $names = $locations[$found_ctr][1];
                    $names[] =  $user->name;
                    $locations[$found_ctr][1] = $names;
                }
                $current_user_location = $user->last_tracked_location;
                if ($user->user_id == $user_id) {
                    $current_user_location = $user->user_location;
                }
            } else {
                $last_loc = $this->trac360_model->get_last_location_from_timesheet_logs($user->user_id);
                for ($i = 0; $i < count($locations); $i++) {
                    if ($locations[$i][0] == $last_loc->user_location) {
                        $found = true;
                        $found_ctr = $i;
                        break;
                    }
                }
                if (!$found) {
                    $locations[] = array($last_loc->user_location, array($user->name), $user->profile_img,);
                } else {
                    $names = $locations[$found_ctr][1];
                    $names[] =  $user->name;
                    $locations[$found_ctr][1] = $names;
                }
                if ($user->user_id == $user_id) {
                    $current_user_location = $last_loc->user_location;
                }
            }
        }
    }
    public function send_android_push($registrationIds, $body, $title)
    {
        $notification = array(
            'body'     => $body,
            'title'    => $title,
            'sound'     => 'default'
        );

        $fields = array(
            'registration_ids'    => $registrationIds,
            'data'                => $notification
        );


        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );


        //send curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $response = curl_exec($ch);
        curl_close($ch);
    }


    public function send_ios_push($registrationIds, $title, $body)
    {
        $notification = array(
            'title'     => $title,
            'body'      => $body,
            'sound'     => 'default',
            'badge'     => '1'
        );

        // registration_ids for multipale tokens array
        $payload = array(
            'registration_ids' => $registrationIds,
            'notification'     => $notification,
            'priority'            => 'high'
        );
        $json = json_encode($payload);


        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    public function auto_clockout()
    {
        $all_timedin = $this->timesheet_model->get_all_timedin();
        $android_tokens_less_9 = array();
        $ios_tokens_less_9 = array();
        $android_tokens_over_9 = array();
        $ios_tokens_over_9 = array();

        foreach ($all_timedin as $employee_attendance) {
            $last_aux = $this->timesheet_model->get_latest_aux($employee_attendance->id, "DESC");

            if ($last_aux->action != "Break in") {
                $date_start = $employee_attendance->date_created;
                $date_end = date("Y-m-d H:i:s");
                $worked_duration = $this->get_differenct_of_dates($date_start, $date_end);
                if ($last_aux->action == "Break out") {
                    $worked_duration = $worked_duration - $employee_attendance->break_duration;
                }
                echo "<br><br>";

                if ($worked_duration > 8 && $worked_duration < 9) {
                    //set for app
                    if ($employee_attendance->device_type == "iOS") {
                        $ios_tokens_less_9[] = $employee_attendance->device_token;
                    } elseif ($employee_attendance->device_type == "Android") {
                        $android_tokens_less_9[] = $employee_attendance->device_token;
                    }
                    $data = new stdClass();
                    $data->notif_action_made = "over8less9";
                    $data->FName = $employee_attendance->FName;
                    $data->user_id = $employee_attendance->user_id;
                    $image = base_url() . '/uploads/users/user-profile/' . $employee_attendance->profile_img;
                    if (!@getimagesize($image)) {
                        $image = base_url('uploads/users/default.png');
                    }
                    $data->profile_img = $image;
                    $this->pusher_notification($data);
                } elseif ($worked_duration > 12) {
                    //auto clockout
                    if ($employee_attendance->device_type == "iOS") {
                        $ios_tokens_over_9[] = $employee_attendance->device_token;
                    } elseif ($employee_attendance->device_type == "Android") {
                        $android_tokens_over_9[] = $employee_attendance->device_token;
                    }
                    $this->auto_clockOutEmployee($employee_attendance->user_id, $employee_attendance->id, $employee_attendance->company_id, $last_aux->user_location, $last_aux->user_location_address);
                }
            }
        }
        if (count($android_tokens_less_9) > 0) {
            $this->send_android_push($android_tokens_less_9, "Time Clock Alert", "Hi! It's time for you to clock out. Do you still need more time?");
        }
        if (count($ios_tokens_less_9) > 0) {
            $this->send_ios_push($ios_tokens_less_9, "Time Clock Alert", "Hi! It's time for you to clock out. Do you still need more time?");
        }

        if (count($android_tokens_over_9) > 0) {
            $this->send_android_push($android_tokens_over_9, "Autoclock Out Alert", "Hey! we haven't heard from you since the last time clock notification. Please note that you have been auto clocked out.");
        }
        if (count($ios_tokens_over_9) > 0) {
            $this->send_ios_push($ios_tokens_over_9, "Autoclock Out Alert", "Hey! we haven't heard from you since the last time clock notification. Please note that you have been auto clocked out.");
        }
    }

    public function auto_clockOutEmployee($user_id, $attn_id, $company_id, $latlng, $address)
    {
        $_SESSION['autoclockout_timer_closed'] = false;
        date_default_timezone_set('UTC');
        $clock_out = date('Y-m-d H:i:s');

        $employeeLongnameAddress = $address;
        $check_attn = $this->db->get_where('timesheet_attendance', array('id' => $attn_id, 'user_id' => $user_id));

        if ($check_attn->num_rows() == 1) {
            $content_notification = "Has been auto clocked out " . date("M d, Y") . " GMT+0";
            $clock_out_notify = array(
                'user_id' => $user_id,
                'title' => 'Clock Out',
                'content' => $content_notification,
                'date_created' => $clock_out,
                'status' => 1,
                'company_id' => $company_id
            );
            $this->db->insert('user_notification', $clock_out_notify);
            $employee_address = $address;
            $out = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'user_location' => $latlng,
                'user_location_address' => $address,
                'entry_type' => 'Auto',
                'company_id' => $company_id
            );
            $this->db->insert('timesheet_logs', $out);
            $timesheet_logs_id = $this->db->insert_id();

            $hours_worked = $this->timesheet_model->calculateShiftDuration_and_overtime($attn_id);
            $shift_duration = round($hours_worked[0], 2);
            $update = array(
                'shift_duration' => $shift_duration,
                //                'break_duration' => $break_duration,
                'overtime' => round($hours_worked[1], 2),
                //                'date_out' => date('Y-m-d'),
                'status' => 0
            );
            $this->db->where('id', $attn_id);
            $this->db->update('timesheet_attendance', $update);

            $update = array(
                'status' => 0
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('timesheet_attendance', $update);



            $affected_row = $this->db->affected_rows();

            $this->db->select('FName,LName,profile_img,device_type,device_token');
            $this->db->from('users');
            $this->db->where('id', $user_id);
            $query = $this->db->get();
            $getUserDetail = $query->row();

            date_default_timezone_set($this->session->userdata('usertimezone'));

            $data = new stdClass();
            $data->clock_out_time = date('h:i A');
            $data->attendance_id = $attn_id;
            $data->shift_duration = gmdate('H:i', floor(($shift_duration + $hours_worked[1]) * 3600));
            $data->FName = $getUserDetail->FName;
            $data->LName = $getUserDetail->LName;
            $data->profile_img = $getUserDetail->profile_img;
            $data->body = $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " " . $content_notification;
            $data->device_type =  $getUserDetail->device_type;
            $data->company_id = $company_id;
            $data->token = $getUserDetail->device_token;
            $data->title = "Time Clock Alert";
            $data->timesheet_logs_id = $timesheet_logs_id;

            $this->db->select('id');
            $this->db->from('user_notification');
            $this->db->where('user_id', $user_id);
            $this->db->where('date_created', $clock_out);
            $query = $this->db->get();
            $notify = $query->row();

            $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
            if (!@getimagesize($image)) {
                $image = base_url('uploads/users/default.png');
            }

            $html = '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
            data-id="' . $notify->id . '" class="dropdown-item notify-item active"
            style="background-color:#e6e3e3">
            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
            <p class="notify-details" style="margin-left: 50px;">' . $data->FName . " " . $data->LName . '<span class="text-muted">' . $content_notification . '</span></p>
            </a>';
            $data->user_id = $user_id;
            $data->html = $html;
            $data->content_notification = $content_notification;
            $data->profile_img = $image;
            $data->device_type = "";
            $data->token = "";
            $data->notif_action_made = "autoclockout";
            $this->autoclockout_app_notification($data->body, $data->title, $data->device_type, $data->company_id);
            $this->pusher_notification($data);
        }
    }
    public function autoclockout_app_notification($body, $title, $device_type, $under_company_id)
    {
        //User App notification

        $ios_tokens = array();
        $android_tokens = array();
        $ios_token_ctr = 0;
        $android_token_ctr = 0;

        // ////Admin App notification

        // $data=$under_company_id;
        $company_admins = $this->timesheet_model->get_company_users($under_company_id);
        foreach ($company_admins as $admin) {
            $device_type = $admin->device_type;
            if ($device_type == "Android") {
                $android_tokens[] = $admin->device_token;
                $android_token_ctr++;
            } elseif ($device_type == "iOS") {
                $ios_tokens[] = $admin->device_token;
                $ios_token_ctr++;
            }
        }

        if ($android_token_ctr > 0) {
            $this->send_android_push($android_tokens, $title, $body);
        }
        if ($ios_token_ctr > 0) {
            $this->send_ios_push($ios_tokens, $title, $body);
        }
    }
    public function pusher_notification($data)
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f3c73bc6ff54c5404cc8',
            '20b5e1eb05dc73068e61',
            '1168724',
            $options
        );
        $pusher->trigger('nsmarttrac', 'my-event', $data);
    }

    ### ===>> Daily Cron Jobs
    public function cron_job_daily()
    {
        $this->invoice_due_status_checker();
        $this->cron_recurring_transactions();
        $this->cron_cashflow_planned();
    }
    public function invoice_due_status_checker()
    {
        $date_now = date("Y-m-d");
        $this->invoice_model->change_due_invoice_status($date_now, "Due");
        $this->invoice_model->change_due_invoice_status($date_now, "Overdue");
    }

    private function cron_recurring_transactions()
    {
        $this->load->model('accounting_recurring_transactions_model');
        $transactions = $this->accounting_recurring_transactions_model->get_by_next_date(date('Y-m-d'));

        foreach ($transactions as $transaction) {
            switch ($transaction->txn_type) {
                case 'deposit':
                    $success = $this->occur_deposit($transaction->txn_id);
                    break;
                case 'transfer':
                    $success = $this->occur_transfer($transaction->txn_id);
                    break;
                case 'journal entry':
                    $success = $this->occur_journal_entry($transaction->txn_id);
                    break;
                case 'expense':
                    $success = $this->occur_expense($transaction->txn_id);
                    break;
                case 'check':
                    $success = $this->occur_check($transaction->txn_id);
                    break;
                case 'bill':
                    $success = $this->occur_bill($transaction->txn_id);
                    break;
                case 'purchase order':
                    $success = $this->occur_purchase_order($transaction->txn_id);
                    break;
                case 'vendor credit':
                    $success = $this->occur_vendor_credit($transaction->txn_id);
                    break;
                case 'credit card credit':
                    $success = $this->occur_credit_card_credit($transaction->txn_id);
                    break;
                case 'invoice' :
                    $success = $this->occur_invoice($transaction->txn_id);
                    break;
                case 'credit memo' :
                    $success = $this->occur_credit_memo($transaction->txn_id);
                    break;
                case 'sales receipt' :
                    $success = $this->occur_sales_receipt($transaction->txn_id);
                    break;
                case 'refund' :
                    $success = $this->occur_refund_receipt($transaction->txn_id);
                    break;
                case 'npcredit' :
                    $success = $this->occur_delayed_credit($transaction->txn_id);
                    break;
                case 'npcharge' :
                    $success = $this->occur_delayed_charge($transaction->txn_id);
                    break;
            }

            $currentOccurrence = intval($transaction->current_occurrence) + 1;
            $every = $transaction->recurr_every;
            $nextDate = date("m/d/Y", strtotime($transaction->next_date));
            switch ($transaction->recurring_interval) {
                case 'daily':
                    $nextDate = date("Y-m-d", strtotime("$nextDate +$every days"));
                    break;
                case 'weekly':
                    $nextDate = date("Y-m-d", strtotime("$nextDate +$every weeks"));
                    break;
                case 'monthly':
                    if ($transaction->recurring_week === 'day') {
                        $day = $transaction->recurring_day === 'last' ? 't' : $transaction->recurring_day;
                        $nextDate = date("Y-m-$day", strtotime("$nextDate +$every months"));
                    } else {
                        $week = $transaction->recurring_week;
                        $day = $transaction->recurring_day;
                        $nextDate = date("Y-m-d", strtotime("$week $day " . date("Y-m", strtotime("$nextDate +$every months"))));
                    }
                    break;
                case 'yearly':
                    $month = $transaction->recurring_month;
                    $day = $transaction->recurring_day;

                    $nextDate = date("Y-$month-$day", strtotime("$nextDate +1 year"));
                    break;
            }

            if ($transaction->end_type === 'after') {
                if ($currentOccurrence === intval($transaction->max_occurrences)) {
                    $nextDate = null;
                }
            } else {
                if ($transaction->end_type !== 'none') {
                    if (strtotime($nextDate) > strtotime($transaction->end_date)) {
                        $nextDate = null;
                    }
                }
            }

            $recurringData = [
                'previous_date' => $transaction->next_date,
                'next_date' => $nextDate,
                'current_occurrence' => $currentOccurrence
            ];

            $update = $this->accounting_recurring_transactions_model->updateRecurringTransaction($transaction->id, $recurringData);
        }
    }

    private function occur_deposit($depositId)
    {
        $this->load->model('accounting_bank_deposit_model');
        $deposit = $this->accounting_bank_deposit_model->getById($depositId);
        $attachments = $this->accounting_attachments_model->get_attachments('Deposit', $depositId);
        $tags = $this->tags_model->get_transaction_tags('Deposit', $depositId);
        $funds = $this->accounting_bank_deposit_model->getFunds($depositId);

        $insertData = [
            'company_id' => $deposit->company_id,
            'account_id' => $deposit->account_id,
            'date' => date("Y-m-d"),
            'total_amount' => $deposit->total_amount,
            'cash_back_account_id' => $deposit->cash_back_account_id,
            'cash_back_memo' => $deposit->cash_back_memo,
            'cash_back_amount' => $deposit->cash_back_amount,
            'memo' => $deposit->memo,
            'status' => 1
        ];

        $newDeposit = $this->accounting_bank_deposit_model->create($insertData);

        if ($newDeposit) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Deposit',
                        'transaction_id' => $newDeposit,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Deposit',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newDeposit,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $depositToAcc = $this->chart_of_accounts_model->getById($deposit->account_id);
            $depositData = [
                'id' => $depositToAcc->id,
                'company_id' => $depositToAcc->company_id,
                'balance' => floatval($depositToAcc->balance) + floatval($deposit->total_amount)
            ];
            $this->chart_of_accounts_model->updateBalance($depositData);

            if ($deposit->cash_back_amount !== "") {
                $cashBackAccount = $this->chart_of_accounts_model->getById($deposit->cash_back_account_id);
                $cashBackData = [
                    'id' => $cashBackAccount->id,
                    'company_id' => $cashBackAccount->company_id,
                    'balance' => $cashBackAccount->account_id !== "7" ? floatval($cashBackAccount->balance) + floatval($deposit->cash_back_amount) : floatval($cashBackAccount->balance) - floatval($deposit->cash_back_amount)
                ];

                $this->chart_of_accounts_model->updateBalance($cashBackData);
            }

            $fundsData = [];
            foreach ($funds as $fund) {
                $fundsData[] = [
                    'bank_deposit_id' => $newDeposit,
                    'received_from_key' => $fund->received_from_key,
                    'received_from_id' => $fund->received_from_id,
                    'received_from_account_id' => $fund->received_from_account_id,
                    'description' => $fund->description,
                    'payment_method' => $fund->payment_method,
                    'ref_no' => $fund->ref_no,
                    'amount' => $fund->amount
                ];

                $account = $this->chart_of_accounts_model->getById($fund->received_from_account_id);

                $accountBalance = $account->account_id !== "7" ? floatval($account->balance) - floatval($fund->amount) : floatval($account->balance) + floatval($fund->amount);
                $accountBalance = number_format($accountBalance, 2, '.', ',');
                $accountData = [
                    'id' => $fund->received_from_account_id,
                    'company_id' => $account->company_id,
                    'balance' => $accountBalance
                ];
                $withdraw = $this->chart_of_accounts_model->updateBalance($accountData);
            }

            $fundsId = $this->accounting_bank_deposit_model->insertFunds($fundsData);
        }

        return $newDeposit;
    }

    private function occur_transfer($transferId)
    {
        $this->load->model('accounting_transfer_funds_model');
        $transfer = $this->accounting_transfer_funds_model->getById($transferId);
        $attachments = $this->accounting_attachments_model->get_attachments('Transfer', $transferId);

        $insertData = [
            'company_id' => $transfer->company_id,
            'transfer_from_account_id' => $transfer->transfer_from_account_id,
            'transfer_to_account_id' => $transfer->transfer_to_account_id,
            'transfer_amount' => $transfer->transfer_amount,
            'transfer_date' => date("Y-m-d"),
            'transfer_memo' => $transfer->memo,
            'status' => 1
        ];

        $newTransfer = $this->accounting_transfer_funds_model->create($insertData);

        if ($newTransfer) {
            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Transfer',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newTransfer,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $transferFromAcc = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);
            $transferToAcc = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);

            $transferFromBal = $transferFromAcc->account_id !== "7" ? floatval($transferFromAcc->balance) - floatval($transfer->transfer_amount) : floatval($transferFromAcc->balance) + floatval($transfer->transfer_amount);
            $transferToBal = $transferToAcc->account_id !== "7" ? floatval($transferToAcc->balance) + floatval($transfer->transfer_amount) : floatval($transferToAcc->balance) - floatval($transfer->transfer_amount);

            $transferFromBal = number_format($transferFromBal, 2, '.', ',');
            $transferToBal = number_format($transferToBal, 2, '.', ',');

            $transferFromAccData = [
                'id' => $transferFromAcc->id,
                'company_id' => $transferFromAcc->company_id,
                'balance' => $transferFromBal
            ];
            $transferToAccData = [
                'id' => $transferToAcc->id,
                'company_id' => $transferToAcc->company_id,
                'balance' => $transferToBal
            ];

            $this->chart_of_accounts_model->updateBalance($transferFromAccData);
            $this->chart_of_accounts_model->updateBalance($transferToAccData);
        }

        return $newTransfer;
    }

    private function occur_journal_entry($journalId)
    {
        $this->load->model('accounting_journal_entries_model');
        $journal = $this->accounting_journal_entries_model->getById($journalId);
        $attachments = $this->accounting_attachments_model->get_attachments('Journal', $journalId);
        $entries = $this->accounting_journal_entries_model->getEntries($journalId);

        $insertData = [
            'company_id' => $journal->company_id,
            'journal_no' => $journal->journal_no,
            'journal_date' => date("Y-m-d"),
            'memo' => $journal->memo,
            'status' => 1
        ];

        $newJournal = $this->accounting_journal_entries_model->create($insertData);

        if ($newJournal) {
            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Journal',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newJournal,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $entryItems = [];
            foreach ($entries as $entry) {
                $entryItems[] = [
                    'journal_entry_id' => $newJournal,
                    'account_id' => $entry->account_id,
                    'debit' => $entry->debit,
                    'credit' => $entry->credit,
                    'description' => $entry->decription,
                    'name_key' => $entry->name_key,
                    'name_id' => $entry->name_id
                ];

                $account = $this->chart_of_accounts_model->getById($entry->account_id);
                if ($account->account_id !== "7") {
                    $newBalance = floatval($account->balance) - floatval($entry->credit);
                    $newBalance = $newBalance + floatval($entry->debit);
                } else {
                    $newBalance = floatval($account->balance) + floatval($entry->credit);
                    $newBalance = $newBalance - floatval($entry->debit);
                }

                $newBalance = number_format($newBalance, 2, '.', ',');

                $accountData = [
                    'id' => $account->id,
                    'company_id' => $account->company_id,
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($accountData);
            }

            $entryItemsId = $this->accounting_journal_entries_model->insertEntryItems($entryItems);
        }

        return $newJournal;
    }

    private function occur_expense($expenseId)
    {
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $expense = $this->vendors_model->get_expense_by_id($expenseId);
        $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expenseId);
        $tags = $this->tags_model->get_transaction_tags('Expense', $expenseId);
        $categories = $this->expenses_model->get_transaction_categories($expenseId, 'Expense');
        $items = $this->expenses_model->get_transaction_items($expenseId, 'Expense');

        $expenseData = [
            'company_id' => $expense->company_id,
            'payee_type' => $expense->payee_type,
            'payee_id' => $expense->payee_id,
            'payment_account_id' => $expense->payment_account_id,
            'payment_date' => date("Y-m-d"),
            'payment_method_id' => $expense->payment_method_id,
            'ref_no' => $expense->ref_no,
            'permit_no' => $expense->permit_no,
            'memo' => $expense->memo,
            'total_amount' => $expense->total_amount,
            'linked_purchase_order_id' => $expense->linked_purchase_order_id,
            'status' => 1
        ];

        $newExpense = $this->expenses_model->addExpense($expenseData);

        if ($newExpense) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Expense',
                        'transaction_id' => $newExpense,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Expense',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newExpense,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            // payment account
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

            if ($paymentAccType->account_name === 'Credit Card') {
                $newBalance = floatval($paymentAcc->balance) + floatval($expense->total_amount);
            } else {
                $newBalance = floatval($paymentAcc->balance) - floatval($expense->total_amount);
            }

            $newBalance = number_format($newBalance, 2, '.', ',');

            $paymentAccData = [
                'id' => $paymentAcc->id,
                'company_id' => $paymentAcc->company_id,
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($paymentAccData);

            if (count($categories) > 0) {
                $this->insert_categories($newExpense, $categories);
            }

            if (count($items) > 0) {
                $this->insert_items($newExpense, $items);
            }
        }

        return $newExpense;
    }

    private function occur_check($checkId)
    {
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $this->load->model('accounting_assigned_checks_model');
        $check = $this->vendors_model->get_check_by_id($checkId);
        $attachments = $this->accounting_attachments_model->get_attachments('Check', $checkId);
        $tags = $this->tags_model->get_transaction_tags('Check', $checkId);
        $categories = $this->expenses_model->get_transaction_categories($checkId, 'Check');
        $items = $this->expenses_model->get_transaction_items($checkId, 'Check');

        $lastCheck = $this->vendors_model->get_company_last_check($check->company_id);

        $checkData = [
            'company_id' => $check->company_id,
            'payee_type' => $check->payee_type,
            'payee_id' => $check->payee_id,
            'bank_account_id' => $check->bank_account_id,
            'mailing_address' => $check->mailing_address,
            'payment_date' => date("Y-m-d"),
            'check_no' => $check->check_no !== "" && !is_null($check->check_no) ? intval($lastCheck->check_no) + 1 : $check->check_no,
            'to_print' => $check->to_print,
            'permit_no' => $check->permit_no,
            'tags' => $check->tags,
            'memo' => $check->memo,
            'total_amount' => $check->total_amount,
            'status' => 1
        ];

        $newCheck = $this->expenses_model->addCheck($checkData);

        if ($newCheck) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Check',
                        'transaction_id' => $newCheck,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Check',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newCheck,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $bankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);
            $newBalance = floatval($bankAcc->balance) - floatval($check->total_amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $bankAccData = [
                'id' => $bankAcc->id,
                'company_id' => $bankAcc->company_id,
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($bankAccData);

            if (is_null($check->to_print)) {
                $assignCheck = [
                    'check_no' => $checkData['check_no'],
                    'transaction_type' => 'check',
                    'transaction_id' => $newCheck,
                    'payment_account_id' => $checkData['bank_account_id']
                ];

                $this->accounting_assigned_checks_model->assign_check_no($assignCheck);
            }

            if (count($categories) > 0) {
                $this->insert_categories($newCheck, $categories);
            }

            if (count($items) > 0) {
                $this->insert_items($newCheck, $items);
            }
        }

        return $newCheck;
    }

    private function occur_bill($billId)
    {
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $bill = $this->vendors_model->get_bill_by_id($billId);
        $lastBill = $this->vendors_model->get_company_last_bill($bill->company_id);
        $attachments = $this->accounting_attachments_model->get_attachments('Bill', $billId);
        $tags = $this->tags_model->get_transaction_tags('Bill', $billId);
        $categories = $this->expenses_model->get_transaction_categories($billId, 'Bill');
        $items = $this->expenses_model->get_transaction_items($billId, 'Bill');

        $billData = [
            'company_id' => $bill->company_id,
            'vendor_id' => $bill->vendor_id,
            'mailing_address' => $bill->mailing_address,
            'term_id' => $bill->term_id,
            'bill_date' => date("Y-m-d"),
            'due_date' => date("Y-m-d"),
            'bill_no' => is_null($bill->bill_no) || $bill->bill_no === '' ? null : intval($lastBill->bill_no) + 1,
            'permit_no' => $bill->permit_no,
            'tags' => $bill->tags,
            'memo' => $bill->memo,
            'remaining_balance' => $bill->remaining_balance,
            'total_amount' => $bill->total_amount,
            'status' => 1
        ];

        $newBill = $this->expenses_model->addBill($billData);

        if ($newBill) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Bill',
                        'transaction_id' => $newBill,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Bill',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newBill,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if (count($categories) > 0) {
                $this->insert_categories($newBill, $categories);
            }

            if (count($items) > 0) {
                $this->insert_items($newBill, $items);
            }
        }

        return $newBill;
    }

    private function occur_purchase_order($purchaseOrderId)
    {
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($purchaseOrderId);
        $attachments = $this->accounting_attachments_model->get_attachments('Purchase Order', $purchaseOrderId);
        $tags = $this->tags_model->get_transaction_tags('Purchase Order', $purchaseOrderId);
        $categories = $this->expenses_model->get_transaction_categories($purchaseOrderId, 'Purchase Order');
        $items = $this->expenses_model->get_transaction_items($purchaseOrderId, 'Purchase Order');

        $lastPO = $this->expenses_model->get_last_purchase_order($purchaseOrder->company_id);

        $purchaseOrderData = [
            'company_id' => $purchaseOrder->company_id,
            'vendor_id' => $purchaseOrder->vendor_id,
            'purchase_order_no' => $lastPO === null ? 1 : intval($lastPO->purchase_order_no) + 1,
            'permit_no' => $purchaseOrder->permit_no,
            'email' => $purchaseOrder->email,
            'mailing_address' => $purchaseOrder->mailing_address,
            'customer_id' => $purchaseOrder->customer_id,
            'shipping_address' => $purchaseOrder->shipping_address,
            'purchase_order_date' => date("Y-m-d"),
            'ship_via' => $purchaseOrder->ship_via,
            'tags' => $purchaseOrder->tags,
            'message_to_vendor' => $purchaseOrder->message_to_vendor,
            'memo' => $purchaseOrder->memo,
            'total_amount' => $purchaseOrder->total_amount,
            'remaining_balance' => $purchaseOrder->total_amount,
            'status' => 1
        ];

        $newPurchaseOrder = $this->expenses_model->add_purchase_order($purchaseOrderData);

        if ($newPurchaseOrder) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Purchase Order',
                        'transaction_id' => $newPurchaseOrder,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Purchase Order',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newPurchaseOrder,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if (count($categories) > 0) {
                $this->insert_categories($newPurchaseOrder, $categories);
            }

            if (count($items) > 0) {
                $this->insert_items($newPurchaseOrder, $items);
            }
        }

        return $newPurchaseOrder;
    }

    private function occur_vendor_credit($vCreditId)
    {
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $vCredit = $this->vendors_model->get_vendor_credit_by_id($vCreditId);
        $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vCreditId);
        $tags = $this->tags_model->get_transaction_tags('Vendor Credit', $vCreditId);
        $categories = $this->expenses_model->get_transaction_categories($vCreditId, 'Vendor Credit');
        $items = $this->expenses_model->get_transaction_items($vCreditId, 'Vendor Credit');

        $vCreditData = [
            'company_id' => $vCredit->company_id,
            'vendor_id' => $vCredit->vendor_id,
            'mailing_address' => $vCredit->mailing_address,
            'payment_date' => date("Y-m-d"),
            'ref_no' => $vCredit->ref_no,
            'permit_no' => $vCredit->permit_no,
            'tags' => $vCredit->tags,
            'memo' => $vCredit->memo,
            'total_amount' => $vCredit->total_amount,
            'remaining_balance' => $vCredit->total_amount,
            'status' => 1
        ];

        $newvCredit = $this->expenses_model->add_vendor_credit($vCreditData);

        if ($newvCredit) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Vendor Credit',
                        'transaction_id' => $newvCredit,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Vendor Credit',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newvCredit,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $vendor = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);

            if ($vendor->vendor_credits === null & $vendor->vendor_credits === "") {
                $vendorCredits = floatval($vCredit->total_amount);
            } else {
                $vendorCredits = floatval($vCredit->total_amount) + floatval($vendor->vendor_credits);
            }

            $vendorData = [
                'vendor_credits' => number_format($vendorCredits, 2, '.', ',')
            ];

            $this->vendors_model->updateVendor($vendor->id, $vendorData);

            if (count($categories) > 0) {
                $this->insert_items($newvCredit, $categories);
            }

            if (count($items) > 0) {
                $this->insert_items($newvCredit, $items);
            }
        }

        return $newvCredit;
    }

    private function occur_credit_card_credit($ccCreditId)
    {
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditId);
        $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $ccCreditId);
        $tags = $this->tags_model->get_transaction_tags('CC Credit', $ccCreditId);
        $categories = $this->expenses_model->get_transaction_categories($ccCreditId, 'Credit Card Credit');
        $items = $this->expenses_model->get_transaction_items($ccCreditId, 'Credit Card Credit');

        $creditData = [
            'company_id' => $ccCredit->company_id,
            'payee_type' => $ccCredit->payee_type,
            'payee_id' => $ccCredit->payee_id,
            'bank_credit_account_id' => $ccCredit->bank_credit_account_id,
            'payment_date' => date("Y-m-d"),
            'ref_no' => $ccCredit->ref_no,
            'permit_no' => $ccCredit->permit_no,
            'tags' => $ccCredit->tags,
            'memo' => $ccCredit->memo,
            'total_amount' => $ccCredit->total_amount,
            'status' => 1
        ];

        $newCredit = $this->expenses_model->add_credit_card_credit($creditData);

        if ($newCredit) {
            $creditAcc = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);

            $newBalance = floatval($creditAcc->balance) - floatval($ccCredit->total_amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => $creditAcc->company_id, 'balance' => $newBalance]);

            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'CC Credit',
                        'transaction_id' => $newCredit,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'CC Credit',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newCredit,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if (count($categories) > 0) {
                $this->insert_categories($newCredit, $categories);
            }

            if (count($items) > 0) {
                $this->insert_items($newCredit, $items);
            }
        }

        return $newCredit;
    }

    private function insert_categories($transactionId, $categories)
    {
        $this->load->model('account_model');
        $this->load->model('expenses_model');
        $categoryDetails = [];
        foreach ($categories as $category) {
            $categoryDetails[] = [
                'transaction_type' => $category->transaction_type,
                'transaction_id' => $transactionId,
                'expense_account_id' => $category->expense_account_id,
                'category' => $category->category,
                'description' => $category->description,
                'amount' => $category->amount,
                'billable' => $category->billable,
                'markup_percentage' => $category->markup_percentage,
                'tax' => $category->tax,
                'customer_id' => $category->customer_id
            ];

            $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
            $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

            switch ($category->transaction_type) {
                case 'Expense':
                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    }
                    break;
                case 'Check':
                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    }
                    break;
                case 'Bill':
                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    }
                    break;
                case 'Vendor Credit':
                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    }
                    break;
                case 'Credit Card Credit':
                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    }
                    break;
            }

            if ($category->transaction_type !== 'Purchase Order') {
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => $expenseAcc->company_id,
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);
            }
        }

        $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
    }

    private function insert_items($transactionId, $categories)
    {
        $this->load->model('items_model');
        $this->load->model('expenses_model');
        $itemDetails = [];
        foreach ($items as $item) {
            $itemDetails[] = [
                'transaction_type' => $item->transaction_type,
                'transaction_id' => $transactionId,
                'item_id' => $item->item_id,
                'location_id' => $item->location_id,
                'quantity' => $item->quantity,
                'rate' => $item->rate,
                'discount' => $item->discount,
                'tax' => $item->tax,
                'total' => $item->total
            ];

            $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);

            switch ($item->transaction_type) {
                case 'Expense':
                    $newQty = intval($location->qty) + intval($item->quantity);
                    break;
                case 'Check':
                    $newQty = intval($location->qty) + intval($item->quantity);
                    break;
                case 'Bill':
                    $newQty = intval($location->qty) + intval($item->quantity);
                    break;
                case 'Vendor Credit':
                    $newQty = intval($location->qty) - intval($item->quantity);
                    break;
                case 'Credit Card Credit':
                    $newQty = intval($location->qty) - intval($item->quantity);
                    break;
            }

            if ($item->transaction_type !== 'Purchase Order') {
                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);

                $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);
            }

            if ($itemAccDetails) {
                $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                switch ($item->transaction_type) {
                    case 'Expense':
                        $newBalance = floatval($invAssetAcc->balance) + floatval($item->amount);
                        break;
                    case 'Check':
                        $newBalance = floatval($invAssetAcc->balance) + floatval($item->amount);
                        break;
                    case 'Bill':
                        $newBalance = floatval($invAssetAcc->balance) + floatval($item->amount);
                        break;
                    case 'Purchase Order':
                        $newQtyPO = intval($itemAccDetails->qty_po) + intval($item->quantity);

                        $this->items_model->updateItemAccountingDetails(['qty_po' => $newQtyPO], $item->item_id);
                        break;
                    case 'Vendor Credit':
                        $newBalance = floatval($item->total) - floatval($item->quantity);
                        $newBalance = floatval($invAssetAcc->balance) + $newBalance;
                        $newBalance = $newBalance - floatval($item->total);
                        break;
                    case 'Credit Card Credit':
                        $newBalance = floatval($item->total) - floatval($item->quantity);
                        $newBalance = floatval($invAssetAcc->balance) + $newBalance;
                        $newBalance = $newBalance - floatval($item->total);
                        break;
                }

                if ($item->transaction_type !== 'Purchase Order') {
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => $invAssetAcc->company_id,
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                }
            }
        }

        $this->expenses_model->insert_vendor_transaction_items($itemDetails);
    }

    private function occur_invoice($invoiceId)
    {
        $this->load->model('invoice_settings_model');
        $invoice = $this->invoice_model->getinvoice($invoiceId);
        $attachments = $this->accounting_attachments_model->get_attachments('Invoice', $invoiceId);
        $tags = $this->tags_model->get_transaction_tags('Invoice', $invoiceId);
        $invoiceItems = $this->invoice_model->get_invoice_items($invoice->id);
        $invoiceSettings = $this->invoice_settings_model->getAllByCompany($invoice->company_id);

        $lastNumber = $this->invoice_model->get_last_invoice_number($invoice->company_id, $invoiceSettings->invoice_num_prefix);
        $invoiceNo = "$invoiceSettings->invoice_num_prefix".str_pad(intval($lastNumber) + 1, 9, "0", STR_PAD_LEFT);

        $invoiceData = [
            'customer_id' => $invoice->customer_id,
            'job_location' => $invoice->job_location,
            'job_name' => $invoice->job_name,
            'work_order_number' => $invoice->work_order_number,
            'po_number' => $invoice->po_number,
            'invoice_number' => $invoiceNo,
            'date_issued' => date("Y-m-d"),
            'due_date' => date("Y-m-d", strtotime($invoice->due_date)),
            'status' => 'Schedule',
            'customer_email' => $invoice->customer_email,
            'billing_address' => nl2br($invoice->billing_address),
            'shipping_to_address' => nl2br($invoice->shipping_to_address),
            'ship_via' => $invoice->ship_via,
            'shipping_date' => date("Y-m-d", strtotime($invoice->shipping_date)),
            'tracking_number' => $invoice->tracking_number,
            'terms' => $invoice->terms,
            'location_scale' => $invoice->location_scale,
            'attachments' => $invoice->attachments,
            'tags' => $invoice->tags,
            'total_due' => $invoice->total_due,
            'balance' => $invoice->balance,
            'deposit_request' => $invoice->deposit_request,
            'deposit_request_type' => $invoice->deposit_request_type,
            'payment_methods' => $invoice->payment_methods,
            'message_to_customer' => $invoice->message_to_customer,
            'terms_and_conditions' => $invoice->terms_and_conditions,
            'company_id' => $invoice->company_id,
            'is_recurring' => 0,
            'user_id' => $invoice->user_id,
            'sub_total' => $invoice->sub_total,
            'taxes' => $invoice->taxes,
            'adjustment_name' => $invoice->adjustment_name,
            'adjustment_value' => $invoice->adjustment_value,
            'grand_total' => $invoice->grand_total
        ];

        $newInvoiceId = $this->invoice_model->createInvoice($invoiceData);

        if($newInvoiceId) {
            $new_status_data = array(
                "invoice_id" => $newInvoiceId,
                "status" => 'Schedule',
                "note" => "First status"
            );
            $this->invoice_model->new_invoice_status($new_status_data);

            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Invoice',
                        'transaction_id' => $newInvoiceId,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Invoice',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newInvoiceId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            foreach($invoiceItems as $key => $invoiceItem) {
                $invoiceItemData = [
                    'invoice_id' => $newInvoiceId,
                    'items_id' => $invoiceItem->items_id,
                    'location_id' => $invoiceItem->location_id,
                    'qty' => $invoiceItem->qty,
                    'package_id' => $invoiceItem->package_id,
                    'package_item_details' => $invoiceItem->package_item_details,
                    'cost' => $invoiceItem->cost,
                    'tax' => $invoiceItem->tax,
                    'discount' => $invoiceItem->discount,
                    'total' => $invoiceItem->total,
                    'tax_rate_used' => $invoiceItem->tax_rate_used
                ];

                $addInvoiceItem = $this->invoice_model->add_invoice_items($invoiceItemData);

                if(!in_array($invoiceItem->items_id, ['0', null, '']) && in_array($invoiceItem->package_id, ['0', null, ''])) {
                    $item = $this->items_model->getItemById($invoiceItem->items_id)[0];
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($invoiceItem->items_id);

                    if ($itemAccDetails) {
                        if(strtolower($item->type) === 'product' || strtolower($item->type) === 'inventory') {
                            $location = $this->items_model->getItemLocation($invoiceItem->location_id, $invoiceItem->items_id);
                            $newQty = intval($location->qty) - intval($invoiceItem->qty);
                            $this->items_model->updateLocationQty($invoiceItem->location_id, $invoiceItem->items_id, $newQty);

                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($invAssetAcc->balance) - floatval($item->cost);
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];

                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        } else {
                            $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                            $incomeAccType = $this->account_model->getById($incomeAcc->account_id);

                            if ($incomeAccType->account_name === 'Credit Card') {
                                $newBalance = floatval($incomeAcc->balance) + floatval($invoiceItem->total);
                            } else {
                                $newBalance = floatval($incomeAcc->balance) - floatval($invoiceItem->total);
                            }
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $incomeAccData = [
                                'id' => $incomeAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];

                            $this->chart_of_accounts_model->updateBalance($incomeAccData);
                        }
                    }
                } else {
                    $package = $this->items_model->get_package_by_id($invoiceItem->package_id);
                    $packageItems = $this->items_model->get_package_items($invoiceItem->package_id);

                    foreach($packageItems as $packageItem) {
                        $item = $this->items_model->getItemById($packageItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($packageItem->item_id);
                        $totalQty = intval($packageItem->quantity) * intval($invoiceItem->qty);

                        if ($itemAccDetails) {
                            if(strtolower($item->type) === 'product' || strtolower($item->type) === 'inventory') {
                                $location = $this->items_model->get_first_location($packageItem->item_id);
                                $newQty = intval($location->qty) - intval($totalQty);
                                $this->items_model->updateLocationQty($location->id, $packageItem->item_id, $newQty);

                                $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                                $totalAmount = floatval($item->cost) * floatval($totalQty);
                                $newBalance = floatval($invAssetAcc->balance) - floatval($totalAmount);
                                $newBalance = number_format($newBalance, 2, '.', ',');

                                $invAssetAccData = [
                                    'id' => $invAssetAcc->id,
                                    'company_id' => logged('company_id'),
                                    'balance' => $newBalance
                                ];

                                $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                            } else {
                                $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                $incomeAccType = $this->account_model->getById($incomeAcc->account_id);
                                $totalAmount = floatval($item->price) * floatval($totalQty);

                                if ($incomeAccType->account_name === 'Credit Card') {
                                    $newBalance = floatval($incomeAcc->balance) + floatval($totalAmount);
                                } else {
                                    $newBalance = floatval($incomeAcc->balance) - floatval($totalAmount);
                                }
                                $newBalance = number_format($newBalance, 2, '.', ',');

                                $incomeAccData = [
                                    'id' => $incomeAcc->id,
                                    'company_id' => logged('company_id'),
                                    'balance' => $newBalance
                                ];

                                $this->chart_of_accounts_model->updateBalance($incomeAccData);
                            }
                        }
                    }
                }
            }
        }
    }

    private function occur_credit_memo($creditMemoId)
    {
        $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($creditMemoId);
        $attachments = $this->accounting_attachments_model->get_attachments('Credit Memo', $creditMemoId);
        $tags = $this->tags_model->get_transaction_tags('Credit Memo', $creditMemoId);

        $creditMemoData = [
            'company_id' => $creditMemo->company_id,
            'customer_id' => $creditMemo->customer_id,
            'email' => $creditMemo->email,
            'send_later' => $creditMemo->send_later,
            'credit_memo_date' => date("Y-m-d"),
            'billing_address' => nl2br($creditMemo->billing_address),
            'location_of_sale' => $creditMemo->location_of_sale,
            'po_number' => $creditMemo->po_number,
            'sales_rep' => $creditMemo->sales_rep,
            'message_credit_memo' => $creditMemo->message_credit_memo,
            'message_on_statement' => $creditMemo->message_on_statement,
            'adjustment_name' => $creditMemo->adjustment_name,
            'adjustment_value' => $creditMemo->adjustment_value,
            'balance' => $creditMemo->balance,
            'total_amount' => $creditMemo->total_amount,
            'subtotal' => $creditMemo->subtotal,
            'tax_total' => $creditMemo->tax_total,
            'discount_total' => $creditMemo->discount_total,
            'recurring' => 0,
            'status' => 1
        ];

        $newCreditMemoId = $this->accounting_credit_memo_model->createCreditMemo($creditMemoData);

        if($newCreditMemoId) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Credit Memo',
                        'transaction_id' => $newCreditMemoId,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Credit Memo',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newCreditMemoId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $this->insert_customer_transaction_items('Credit Memo', $creditMemoId, $newCreditMemoId);
        }
    }

    private function occur_sales_receipt($salesReceiptId)
    {
        $this->load->model('accounting_sales_receipt_model');
        $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($salesReceiptId);
        $attachments = $this->accounting_attachments_model->get_attachments('Sales Receipt', $salesReceiptId);
        $tags = $this->tags_model->get_transaction_tags('Sales Receipt', $salesReceiptId);

        $salesReceiptData = [
            'company_id' => $salesReceipt->company_id,
            'customer_id' => $salesReceipt->customer_id,
            'email' => $salesReceipt->email,
            'send_later' => $salesReceipt->send_later,
            'billing_address' => nl2br($salesReceipt->billing_address),
            'sales_receipt_date' => date("Y-m-d"),
            'location_of_sale' => $salesReceipt->location_of_sale,
            'po_number' => $salesReceipt->po_number,
            'sales_rep' => $salesReceipt->sales_rep,
            'payment_method' => $salesReceipt->payment_method,
            'ref_no' => $salesReceipt->ref_no,
            'deposit_to_account' => $salesReceipt->deposit_to_account,
            'message_sales_receipt' => $salesReceipt->message_sales_receipt,
            'message_on_statement' => $salesReceipt->message_on_statement,
            'adjustment_name' => $salesReceipt->adjustment_name,
            'adjustment_value' => $salesReceipt->adjustment_value,
            'total_amount' => $salesReceipt->total_amount,
            'subtotal' => $salesReceipt->subtotal,
            'tax_total' => $salesReceipt->tax_total,
            'discount_total' => $salesReceipt->discount_total,
            'recurring' => 0,
            'status' => 1
        ];

        $newSalesReceiptId = $this->accounting_sales_receipt_model->createSalesReceipts($salesReceiptData);

        if($newSalesReceiptId) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Sales Receipt',
                        'transaction_id' => $newSalesReceiptId,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Sales Receipt',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newSalesReceiptId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $depositAcc = $this->chart_of_accounts_model->getById($salesReceipt->deposit_to_account);
            $depositAccType = $this->account_model->getById($depositAcc->account_id);

            if ($depositAccType->account_name === 'Credit Card') {
                $newBalance = floatval($depositAcc->balance) - floatval($salesReceipt->total_amount);
            } else {
                $newBalance = floatval($depositAcc->balance) + floatval($salesReceipt->total_amount);
            }

            $newBalance = number_format($newBalance, 2, '.', ',');

            $depositAccData = [
                'id' => $depositAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($depositAccData);

            $this->insert_customer_transaction_items('Sales Receipt', $salesReceiptId, $newSalesReceiptId);
        }
    }
    
    private function occur_refund_receipt($refundReceiptId)
    {
        $this->load->model('accounting_refund_receipt_model');
        $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($refundReceiptId);
        $attachments = $this->accounting_attachments_model->get_attachments('Refund Receipt', $refundReceiptId);
        $tags = $this->tags_model->get_transaction_tags('Refund Receipt', $refundReceiptId);

        $refundReceiptData = [
            'company_id' => $refundReceipt->company_id,
            'customer_id' => $refundReceipt->customer_id,
            'email' => $refundReceipt->email,
            'billing_address' => nl2br($refundReceipt->billing_address),
            'refund_receipt_date' => date("Y-m-d"),
            'location_of_sale' => $refundReceipt->location_of_sale,
            'po_number' => $refundReceipt->po_number,
            'sales_rep' => $refundReceipt->sales_rep,
            'payment_method' => $refundReceipt->payment_method,
            'refund_from_account' => $refundReceipt->refund_from_account,
            'check_no' => $refundReceipt->check_no,
            'print_later' => $refundReceipt->print_later,
            'message_refund_receipt' => $refundReceipt->message_refund_receipt,
            'message_on_statement' => $refundReceipt->message_on_statement,
            'adjustment_name' => $refundReceipt->adjustment_name,
            'adjustment_value' => $refundReceipt->adjustment_value,
            'total_amount' => $refundReceipt->total_amount,
            'subtotal' => $refundReceipt->subtotal,
            'tax_total' => $refundReceipt->tax_total,
            'discount_total' => $refundReceipt->discount_total,
            'recurring' => 0,
            'status' => 1
        ];

        $newRefundReceiptId = $this->accounting_refund_receipt_model->createRefundReceipts($refundReceiptData);

        if ($newRefundReceiptId) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Refund Receipt',
                        'transaction_id' => $newRefundReceiptId,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Refund Receipt',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newRefundReceiptId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $refundAcc = $this->chart_of_accounts_model->getById($refundReceipt->refund_from_account);
            $refundAccType = $this->account_model->getById($refundAcc->account_id);

            if ($refundAccType->account_name === 'Credit Card') {
                $newBalance = floatval($refundAcc->balance) + floatval($refundReceipt->total_amount);
            } else {
                $newBalance = floatval($refundAcc->balance) - floatval($refundReceipt->total_amount);
            }

            $newBalance = number_format($newBalance, 2, '.', ',');

            $refundAccData = [
                'id' => $refundAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($refundAccData);

            $this->insert_customer_transaction_items('Refund Receipt', $refundReceiptId, $newRefundReceiptId);
        }
    }

    private function occur_delayed_credit($delayedCreditId)
    {
        $this->load->model('accounting_delayed_credit_model');
        $delayedCredit = $this->accounting_delayed_credit_model->getDelayedCreditDetails($delayedCreditId);
        $attachments = $this->accounting_attachments_model->get_attachments('Delayed Credit', $delayedCreditId);
        $tags = $this->tags_model->get_transaction_tags('Delayed Credit', $delayedCreditId);

        $delayedCreditData = [
            'company_id' => $delayedCredit->company_id,
            'customer_id' => $delayedCredit->customer_id,
            'delayed_credit_date' => date("Y-m-d"),
            'memo' => $delayedCredit->memo,
            'adjustment_name' => $delayedCredit->adjustment_name,
            'adjustment_value' => $delayedCredit->adjustment_value,
            'total_amount' => $delayedCredit->total_amount,
            'subtotal' => $delayedCredit->subtotal,
            'tax_total' => $delayedCredit->tax_total,
            'discount_total' => $delayedCredit->discount_total,
            'recurring' => 0,
            'status' => 1
        ];

        $newDelayedCreditId = $this->accounting_delayed_credit_model->createDelayedCredit($delayedCreditData);

        if($newDelayedCreditId) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Delayed Credit',
                        'transaction_id' => $newDelayedCreditId,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Delayed Credit',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newDelayedCreditId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $this->insert_customer_transaction_items('Delayed Credit', $delayedCreditId, $newDelayedCreditId);
        }
    }

    private function occur_delayed_charge($delayedChargeId)
    {
        $this->load->model('accounting_delayed_charge_model');
        $delayedCharge = $this->accounting_delayed_charge_model->getDelayedChargeDetails($delayedChargeId);
        $attachments = $this->accounting_attachments_model->get_attachments('Delayed Charge', $delayedChargeId);
        $tags = $this->tags_model->get_transaction_tags('Delayed Charge', $delayedChargeId);

        $delayedChargeData = [
            'company_id' => $delayedCharge->company_id,
            'customer_id' => $delayedCharge->customer_id,
            'delayed_charge_date' => date("Y-m-d"),
            'memo' => $delayedCharge->memo,
            'adjustment_name' => $delayedCharge->adjustment_name,
            'adjustment_value' => $delayedCharge->adjustment_value,
            'total_amount' => $delayedCharge->total_amount,
            'subtotal' => $delayedCharge->subtotal,
            'tax_total' => $delayedCharge->tax_total,
            'discount_total' => $delayedCharge->discount_total,
            'recurring' => 0,
            'status' => 1
        ];

        $newDelayedChargeId = $this->accounting_delayed_charge_model->createDelayedCharge($delayedChargeData);

        if($newDelayedChargeId) {
            if (count($tags) > 0) {
                $order = 1;
                foreach ($tags as $tag) {
                    $linkTagData = [
                        'transaction_type' => 'Delayed Charge',
                        'transaction_id' => $newDelayedChargeId,
                        'tag_id' => $tag->id,
                        'order_no' => $order
                    ];

                    $linkTagId = $this->tags_model->link_tag($linkTagData);

                    $order++;
                }
            }

            if (count($attachments) > 0) {
                $order = 1;
                foreach ($attachments as $attachment) {
                    $linkAttachmentData = [
                        'type' => 'Delayed Charge',
                        'attachment_id' => $attachment->id,
                        'linked_id' => $newDelayedChargeId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $this->insert_customer_transaction_items('Delayed Charge', $delayedChargeId, $newDelayedChargeId);
        }
    }

    private function insert_customer_transaction_items($transactionType, $transactionId, $newTransactionId)
    {
        $transacItems = $this->accounting_credit_memo_model->get_customer_transaction_items($transactionType, $transactionId);

        $newItems = [];
        foreach($transacItems as $transacItem) {
            $newItems[] = [
                'transaction_type' => $transactionType,
                'transaction_id' => $newTransactionId,
                'item_id' => $transacItem->item_id,
                'package_id' => $transacItem->package_id,
                'package_item_details' => $transacItem->package_item_details,
                'location_id' => $transacItem->location_id,
                'quantity' => $transacItem->quantity,
                'price' => $transacItem->price,
                'discount' => $transacItem->discount,
                'tax' => $transacItem->tax,
                'total' => $transacItem->total
            ];

            if($transactionType !== 'Delayed Credit' && $transactionType !== 'Delayed Charge') {
                if(!in_array($transacItem->item_id, ['0', null, '']) && in_array($transacItem->package_id, ['0', null, ''])) {
                    $item = $this->items_model->getItemById($transacItem->item_id)[0];
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($transacItem->item_id);

                    if ($itemAccDetails) {
                        if(strtolower($item->type) === 'product' || strtolower($item->type) === 'inventory') {
                            $location = $this->items_model->getItemLocation($transacItem->location_id, $transacItem->item_id);
                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                            switch($transactionType) {
                                case 'Credit Memo' :
                                    $newQty = intval($location->qty) + intval($transacItem->quantity);
                                    $newBalance = floatval($invAssetAcc->balance) + floatval($item->cost);
                                break;
                                case 'Sales Receipt' :
                                    $newQty = intval($location->qty) - intval($transacItem->quantity);
                                    $newBalance = floatval($invAssetAcc->balance) - floatval($item->cost);
                                break;
                                case 'Refund Receipt' :
                                    $newQty = intval($location->qty) + intval($transacItem->quantity);
                                    $newBalance = floatval($invAssetAcc->balance) + floatval($item->cost);
                                break;
                            }
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => $invAssetAcc->company_id,
                                'balance' => $newBalance
                            ];

                            $this->items_model->updateLocationQty($transacItem->location_id, $transacItem->item_id, $newQty);
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        } else {
                            $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                            $incomeAccType = $this->account_model->getById($incomeAcc->account_id);

                            switch($transactionType) {
                                case 'Credit Memo' :
                                    if ($incomeAccType->account_name === 'Credit Card') {
                                        $newBalance = floatval($incomeAcc->balance) + floatval($transacItem->total);
                                    } else {
                                        $newBalance = floatval($incomeAcc->balance) - floatval($transacItem->total);
                                    }
                                break;
                                case 'Sales Receipt' :
                                    if ($incomeAccType->account_name === 'Credit Card') {
                                        $newBalance = floatval($incomeAcc->balance) + floatval($transacItem->total);
                                    } else {
                                        $newBalance = floatval($incomeAcc->balance) - floatval($transacItem->total);
                                    }
                                break;
                                case 'Refund Receipt' :
                                    if ($incomeAccType->account_name === 'Credit Card') {
                                        $newBalance = floatval($incomeAcc->balance) - floatval($transacItem->total);
                                    } else {
                                        $newBalance = floatval($incomeAcc->balance) + floatval($transacItem->total);
                                    }
                                break;
                            }
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $incomeAccData = [
                                'id' => $incomeAcc->id,
                                'company_id' => $incomeAcc->company_id,
                                'balance' => $newBalance
                            ];

                            $this->chart_of_accounts_model->updateBalance($incomeAccData);
                        }
                    }
                } else {
                    $package = $this->items_model->get_package_by_id($transacItem->package_id);
                    $packageItems = $this->items_model->get_package_items($transacItem->package_id);

                    foreach($packageItems as $packageItem) {
                        $item = $this->items_model->getItemById($packageItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($packageItem->item_id);
                        $totalQty = intval($packageItem->quantity) * intval($transacItem->quantity);

                        if ($itemAccDetails) {
                            if(strtolower($item->type) === 'product' || strtolower($item->type) === 'inventory') {
                                $location = $this->items_model->get_first_location($packageItem->item_id);

                                $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                                $totalAmount = floatval($item->cost) * floatval($totalQty);

                                switch($transactionType) {
                                    case 'Credit Memo' :
                                        $newQty = intval($location->qty) + intval($totalQty);
                                        $newBalance = floatval($invAssetAcc->balance) + floatval($totalAmount);
                                    break;
                                    case 'Sales Receipt' :
                                        $newQty = intval($location->qty) - intval($totalQty);
                                        $newBalance = floatval($invAssetAcc->balance) - floatval($totalAmount);
                                    break;
                                    case 'Refund Receipt' :
                                        $newQty = intval($location->qty) + intval($totalQty);
                                        $newBalance = floatval($invAssetAcc->balance) + floatval($totalAmount);
                                    break;
                                }
                                $newBalance = number_format($newBalance, 2, '.', ',');

                                $invAssetAccData = [
                                    'id' => $invAssetAcc->id,
                                    'company_id' => $invAssetAcc->company_id,
                                    'balance' => $newBalance
                                ];

                                $this->items_model->updateLocationQty($location->id, $packageItem->item_id, $newQty);
                                $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                            } else {
                                $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                $incomeAccType = $this->account_model->getById($incomeAcc->account_id);
                                $totalAmount = floatval($item->price) * floatval($totalQty);

                                switch($transactionType) {
                                    case 'Credit Memo' :
                                        if ($incomeAccType->account_name === 'Credit Card') {
                                            $newBalance = floatval($incomeAcc->balance) + floatval($totalAmount);
                                        } else {
                                            $newBalance = floatval($incomeAcc->balance) - floatval($totalAmount);
                                        }
                                    break;
                                    case 'Sales Receipt' :
                                        if ($incomeAccType->account_name === 'Credit Card') {
                                            $newBalance = floatval($incomeAcc->balance) + floatval($totalAmount);
                                        } else {
                                            $newBalance = floatval($incomeAcc->balance) - floatval($totalAmount);
                                        }
                                    break;
                                    case 'Refund Receipt' :
                                        if ($incomeAccType->account_name === 'Credit Card') {
                                            $newBalance = floatval($incomeAcc->balance) - floatval($totalAmount);
                                        } else {
                                            $newBalance = floatval($incomeAcc->balance) + floatval($totalAmount);
                                        }
                                    break;
                                }
                                $newBalance = number_format($newBalance, 2, '.', ',');

                                $incomeAccData = [
                                    'id' => $incomeAcc->id,
                                    'company_id' => $incomeAcc->company_id,
                                    'balance' => $newBalance
                                ];

                                $this->chart_of_accounts_model->updateBalance($incomeAccData);
                            }
                        }
                    }
                }
            }
        }

        $this->accounting_credit_memo_model->insert_transaction_items($newItems);
    }

    public function get_data_from_cashflow_planned($company_id)
    {
        $query = $this->db->get('cashflow_planned');
        return $query->result();
    }

    public function addcashflowplanRecurrinbg($new_data)
    {

        $vendor = $this->db->insert('cashflow_planned_recurring', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function update_cashflow_date_amount($id, $data)
    {
        $updateCashFlow = $this->db->update('cashflow_planned', $data, array('id' => $id));
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function weekOfMonth($when = null) {
        if ($when === null) $when = time();
        
        $week = date('W', strtotime($when)); // note that ISO weeks start on Monday
        $firstWeekOfMonth = date('W', strtotime(date('Y-m-01', strtotime($when))));
        
        return 1 + ($week < $firstWeekOfMonth ? $week : $week - $firstWeekOfMonth);
    }
    public function cron_cashflow_planned()
    {
        $container = $this->get_data_from_cashflow_planned(logged('company_id'));


        for ($index = 0; $index < count($container); $index++) {
            if ($container[$index]->end_indic == "on_going") {
                if (date("Y-m-d") == $container[$index]->date_plan) {
                    if ($container[$index]->repeating == '0') {
                    } else {
                        if ($container[$index]->schedule == "daily") {

                            if ($container[$index]->d_sched == "everyday") {
                                $new_data = array(
                                    'created_at'        => date("Y-m-d"),
                                    'repeating'        => "0",
                                    'merchant_name'     => $container[$index]->merchant_name,
                                    'amount'            => $container[$index]->amount,
                                    'type'              => $container[$index]->type,
                                );
                                $this->addcashflowplanRecurrinbg($new_data);

                                if ($container[$index]->end_type == "not") {
                                    $occur = $container[$index]->end_occurence;
                                    $occur--;

                                    if ($occur != 0) {
                                        $new_data2 = array(
                                            'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                            'end_indic'     => "on_going",
                                            'end_occurence' => $occur
                                        );
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    } else {
                                        $new_data2 = array(
                                            'end_occurence' => $occur,
                                            'end_indic'     => "end"
                                        );
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                } else if ($container[$index]->end_type == "date") {
                                    if (date("Y-m-d") != $container[$index]->end_date) {
                                        $new_data2 = array(
                                            'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                            'end_indic'     => "on_going"
                                        );
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    } else {
                                        $new_data2 = array(
                                            'end_indic'     => "end"
                                        );
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                }
                                // $this->addcashflowplan($new_data);
                                print_r($new_data);
                            } else {
                                if (date("l") == "Monday" || date("l") == "Tuesday" || date("l") == "Wednesday" || date("l") == "Thursday" || date("l") == "Friday") {
                                    $new_data = array(
                                        'created_at'        => date("Y-m-d"),
                                        'repeating'        => "0",
                                        'merchant_name'     => $container[$index]->merchant_name,
                                        'amount'            => $container[$index]->amount,
                                        'type'              => $container[$index]->type,
                                    );
                                    $this->addcashflowplanRecurrinbg($new_data);

                                    if ($container[$index]->end_type == "not") {
                                        $occur = $container[$index]->end_occurence;
                                        $occur--;

                                        if ($occur != 0) {
                                            if (date("l") == "Friday") {
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+3 day")),
                                                    'end_indic'     => "on_going",
                                                    'end_occurence' => $occur
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            } else {
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                                    'end_indic'     => "on_going",
                                                    'end_occurence' => $occur
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            }
                                        } else {
                                            $new_data2 = array(
                                                'end_occurence' => $occur,
                                                'end_indic'     => "end"
                                            );
                                            $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                        }
                                    } else if ($container[$index]->end_type == "date") {
                                        if (date("Y-m-d") != $container[$index]->end_date) {
                                            if (date("l") == "Friday") {
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+3 day")),
                                                    'end_indic'     => "on_going"
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            } else {
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                                    'end_indic'     => "on_going"
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            }
                                        } else {
                                            $new_data2 = array(
                                                'end_indic'     => "end"
                                            );
                                            $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                        }
                                    }
                                    print_r($new_data);
                                    // $this->addcashflowplan($new_data);
                                }
                            }
                        }  // var_dump($new_data);
                        else if ($container[$index]->schedule == "weekly") {
                            $exploded_weeks = explode(" ", $container[$index]->weekly_days);
                            print_r($exploded_weeks);
                            $findings = "";
                            $place = 0;
                            for($i = 0; $i < count($exploded_weeks);$i++){
                                if(date("l") == $exploded_weeks[$i]){
                                    echo $exploded_weeks[$i];
                                    $place = $i;
                                    echo $place;
                                    
                                    $new_data = array(
                                        'created_at'        => date("Y-m-d"),
                                        'repeating'        => "0",
                                        'merchant_name'     => $container[$index]->merchant_name,
                                        'amount'            => $container[$index]->amount,
                                        'type'              => $container[$index]->type,
                                    );
                                    $this->addcashflowplanRecurrinbg($new_data);

                                    if ($container[$index]->end_type == "not") {
                                        $occur = $container[$index]->end_occurence;
                                        $occur--;
    
                                        if ($occur != 0) {
                                            if($place == count($exploded_weeks)-1){
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+". $container[$index]->weekly_weeks ." weeks")),
                                                    'end_indic'     => "on_going",
                                                    'end_occurence' => $occur
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            }else{
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                                    'end_indic'     => "on_going",
                                                    'end_occurence' => $occur
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            }
                                            
                                        } else {
                                            $new_data2 = array(
                                                'end_occurence' => $occur,
                                                'end_indic'     => "end"
                                            );
                                            $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                        }
                                    } else if ($container[$index]->end_type == "date") {
                                        if (date("Y-m-d") != $container[$index]->end_date) {
                                            if($place == count($exploded_weeks)-1){
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+". $container[$index]->weekly_weeks ." weeks")),
                                                    'end_indic'     => "on_going",
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            }else{
                                                $new_data2 = array(
                                                    'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                                    'end_indic'     => "on_going",
                                                );
                                                $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                            }
                                        } else {
                                            $new_data2 = array(
                                                'end_indic'     => "end"
                                            );
                                            $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                        }
                                    }{
                                        if($place == count($exploded_weeks)-1){
                                            $new_data2 = array(
                                                'date_plan'     => date("Y-m-d", strtotime("+". $container[$index]->weekly_weeks ." weeks")),
                                                'end_indic'     => "on_going",
                                            );
                                            $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                        }else{
                                            $new_data2 = array(
                                                'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                                'end_indic'     => "on_going",
                                            );
                                            $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                        }
                                    }
                                }else{
                                    if(date("l")=="Saturday"){
                                        $new_data2 = array(
                                            'date_plan'     => date("Y-m-d", strtotime("+". $container[$index]->weekly_weeks ." weeks")),
                                            'end_indic'     => "on_going",
                                        );
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }else{
                                        $new_data2 = array(
                                            'date_plan'     => date("Y-m-d", strtotime("+1 day")),
                                            'end_indic'     => "on_going",
                                        );
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                }
                            }
                        }
                        //end week
                        else if ($container[$index]->schedule == "monthly") {
                            if ($container[$index]->m_indic == "spec_day") {
                                $new_data = array(
                                    'created_at'        => date("Y-m-d"),
                                    'repeating'        => "0",
                                    'merchant_name'     => $container[$index]->merchant_name,
                                    'amount'            => $container[$index]->amount,
                                    'type'              => $container[$index]->type,
                                );
                                $this->addcashflowplanRecurrinbg($new_data);


                                $addDate = date("Y-m-01", strtotime(" +5 months"));
                                $monthly_rank=0;
                                if($container[$index]->monthly_rank == "first"){
                                    $monthly_rank=1;
                                }elseif($container[$index]->monthly_rank == "Second"){
                                    $monthly_rank=2;
                                }elseif($container[$index]->monthly_rank == "third"){
                                    $monthly_rank=3;
                                }elseif($container[$index]->monthly_rank == "fourth"){
                                    $monthly_rank=4;
                                }
                                $the_next_date="";
                                for($i=7;$i<31;){
                                    if($this->weekOfMonth($addDate) == $monthly_rank){
                                        $the_next_date=date("Y-m-d",strtotime($addDate.' '.$container[$index]->monthly_week_day.' this week'));
                                        $i+=31;
                                    }else{
                                        $addDate = date("Y-m-d", strtotime($addDate." + 7 days"));
                                        $i+=7;
                                    }

                                }
                                
                                if ($container[$index]->end_type == "not") {
                                    $occur = $container[$index]->end_occurence;
                                    $occur--;

                                    if ($occur != 0) {
                                        $new_data2 = array(
                                            'date_plan'     => $the_next_date,
                                            'end_indic'     => "on_going",
                                            'end_occurence' => $occur
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    } else {
                                        $new_data2 = array(
                                            'end_occurence' => $occur,
                                            'end_indic'     => "end"
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                } else if ($container[$index]->end_type == "date") {
                                    if (date("Y-m-d") != $container[$index]->end_date) {
                                        $new_data2 = array(
                                            'date_plan'     => $the_next_date,
                                            'end_indic'     => "on_going"
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    } else {
                                        $new_data2 = array(
                                            'end_indic'     => "end"
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                }else{
                                    $new_data2 = array(
                                        'date_plan'     => $the_next_date,
                                        'end_indic'     => "on_going"
                                    );
                                    echo "pasok";
                                    $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                }

                                echo `</br>` . $the_next_date;
                            }else{
                                $new_data = array(
                                    'created_at'        => date("Y-m-d"),
                                    'repeating'        => "0",
                                    'merchant_name'     => $container[$index]->merchant_name,
                                    'amount'            => $container[$index]->amount,
                                    'type'              => $container[$index]->type,
                                );
                                $this->addcashflowplanRecurrinbg($new_data);

                                $addDate = date("Y-m-0".$container[$index]->monthly_day."", strtotime("+".$container[$index]->monthly_months." months"));
                                echo $addDate;

                                if ($container[$index]->end_type == "not") {
                                    $occur = $container[$index]->end_occurence;
                                    $occur--;

                                    if ($occur != 0) {
                                        $new_data2 = array(
                                            'date_plan'     => $addDate,
                                            'end_indic'     => "on_going",
                                            'end_occurence' => $occur
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    } else {
                                        $new_data2 = array(
                                            'end_occurence' => $occur,
                                            'end_indic'     => "end"
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                } else if ($container[$index]->end_type == "date") {
                                    if (date("Y-m-d") != $container[$index]->end_date) {
                                        $new_data2 = array(
                                            'date_plan'     => $addDate,
                                            'end_indic'     => "on_going"
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    } else {
                                        $new_data2 = array(
                                            'end_indic'     => "end"
                                        );
                                        echo "pasok";
                                        $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                    }
                                }else{
                                    $new_data2 = array(
                                        'date_plan'     => $addDate,
                                        'end_indic'     => "on_going"
                                    );
                                    echo "pasok";
                                    $this->update_cashflow_date_amount($container[$index]->id, $new_data2);
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }
}
