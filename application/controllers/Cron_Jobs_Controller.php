<?php
defined('BASEPATH') or exit('No direct script access allowed');
// define("FIREBASE_API_KEY", "AAAA0yE6SAE:APA91bFQOOZnqWcMbdBY9ZfJfc0TWanlN1l6f95QfjpfMhVLWNfHVd63nlfxP69I_snCkaqaY9yuezx65GLyevUmkflRADYdYAZKPY8e8SS5Q_dyPDqQaxxlstamhhUG1BiFr4bC4ABo"); // New firebase API key

define("FIREBASE_API_KEY", "AAAAiHsFn_g:APA91bHXjuIQDyf_yEGQbqN8H2JofS5Mn38i1-5smTWRqVqkb33lUYNM5VGV__cXCPHqnf-HQxaFtim5fR6mpU3LWhOHxtyM_bzTvZk72ttxkZHxktLzAQpe5AmZBYVlJ_5LzqiOAYOn"); // Old firebase API key

class Cron_Jobs_Controller extends CI_Controller
{
    private $timesheet_report_timezone = "UTC";
    private $timesheet_report_timezone_id = 0;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('timesheet_model');
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
        $subject = $company_name.': Time logs for Week ' . date("M d", strtotime($date_from)).' to '. $subj_date_to;

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
        $filePath = base_url() . '/uploads/users/business_profile/'.$logo_folder.'/'.$company_logo;
        if (@getimagesize($filePath)) {
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/'.$logo_folder.'/'.$company_logo, 'company_logo', $company_logo);
            $this->page_data['has_logo'] = true;
        }
        $mail->Body =  'Timesheet Report.';
        $content = $this->load->view('users/timesheet/emails/weekly_timelogs_report', $this->page_data, true);
        $mail->MsgHTML($content);
        $mail->addAddress('webtestcustomer@nsmartrac.com');
        // echo "pasok";
        $mail->addAddress($receiver);
        if (!$mail->Send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        }
    }
    
    public function get_admin_for_reports()
    {
        date_default_timezone_set('UTC');
        $hour_now = date("H").":00:00";
        if (date("Y-m-d", strtotime('sunday this week', strtotime(date('Y-m-d')))) == date("Y-m-d")) {
            $all_admin_report_settings = $this->timesheet_model->get_all_admin_report_settings();
            $and_query ="";
            foreach ($all_admin_report_settings as $setting) {
                if ($and_query=="") {
                    $and_query = " id != ".$setting->user_id;
                } else {
                    $and_query .= " and id !=".$setting->user_id;
                }
            }
            $all_admin_for_default_report = $this->timesheet_model->get_all_admin_for_default_report($and_query);
            foreach ($all_admin_for_default_report as $admin) {
                $this->timesheet_model->save_timezone_changes("36", $admin->id, 1, 3, "Sun", "00:00:00", $admin->email);
            }
        }
        $admins_subject_for_report = $this->timesheet_model->get_admins_subject_for_report($hour_now);
        $date_hour_now_pst = date('Y-m-d')." ".$hour_now;
        $admins_for_reports=array();
        // var_dump($admins_subject_for_report);
        foreach ($admins_subject_for_report as $admin) {
            $date_hour_now_selected_tz = $this->datetime_zone_converter($date_hour_now_pst, 'UTC', $admin->id_of_timezone);
            $week_day = date("D", strtotime($date_hour_now_selected_tz));
            $schedules = explode(",", $admin->schedule_day);
            $found= false;
            for ($i = 0; $i<count($schedules); $i++) {
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
                    $subscribed=true;
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
        $body ="Timesheet report for week ".date("M d", strtotime($date_from))." to ".date("M d", strtotime($date_to))." has been sent to your email. If you don't see it in your inbox, kindly check your spam.";
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
                    $worked_duration =$worked_duration-$employee_attendance->break_duration;
                }
                echo "<br><br>";
                
                if ($worked_duration > 8 && $worked_duration < 9) {
                    //set for app
                    if ($employee_attendance->device_type == "iOS") {
                        $ios_tokens_less_9[]=$employee_attendance->device_token;
                    } elseif ($employee_attendance->device_type == "Android") {
                        $android_tokens_less_9[]=$employee_attendance->device_token;
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
                        $ios_tokens_over_9[]=$employee_attendance->device_token;
                    } elseif ($employee_attendance->device_type == "Android") {
                        $android_tokens_over_9[]=$employee_attendance->device_token;
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
            $content_notification = "Has been auto clocked out ".date("M d, Y")." GMT+0";
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
            $data->body = $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " ".$content_notification;
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
}
