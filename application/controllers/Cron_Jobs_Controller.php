<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_Jobs_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('timesheet_model');
    }


    public function timelogs_csv_file_setter($company_id)
    {
        $date_from = date("Y-m-d", strtotime('monday this week', strtotime(date('Y-m-d'))));
        $date_to = date('Y-m-d');
        $filename = $date_from . " to " . $date_to . ' ' . $company_id . '.csv';
        $this->generate_timelogs_csv($date_from, $date_to, $filename, $company_id);
        return array($filename, $date_from);
    }
    public function timelogs_csv_email_sender($receiver, $company_name, $filename, $date_from)
    {
        $date_from = date('m-d-Y', strtotime($date_from));
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Time logs for Week ' . $date_from;

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
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

        //get job data

        $this->page_data['company_name'] = $company_name;
        $this->page_data['from'] = $date_from;
        $this->page_data['file_link'] = base_url() . '/timesheet/timelogs/' . $filename;
        $content = $this->load->view('users/timesheet/emails/weekly_timelogs_report', $this->page_data, TRUE);
        $mail->Body = 'Lez go';
        $mail->MsgHTML($content);
        $mail->AddAttachment(base_url() . '/timesheet/timelogs/' . $filename);
        $mail->addAddress($receiver);
        $mail->Send();
    }
    public function send_timesheet_logs_email_action()
    {
        $busnesses = $this->timesheet_model->get_all_businesses();
        $email_sent_to = array();
        foreach ($busnesses as $business) {
            $file_info = $this->timelogs_csv_file_setter($business->company_id);
            $this->timelogs_csv_email_sender($business->business_email, $business->business_name, $file_info[0], $file_info[1]);

            $email_sent_to[] = array($business->business_email, $business->business_name);
            $busness_admins = $this->timesheet_model->get_all_business_admins($business->company_id);
            foreach ($busness_admins as $admin) {
                $received = false;
                for ($i = 0; $i < count($email_sent_to); $i++) {
                    if ($email_sent_to[$i][0] == $admin->email) {
                        $received = true;
                        break;
                    }
                }
                if (!$received) {
                    $this->timelogs_csv_email_sender($admin->email, $business->business_name, $file_info[0], $file_info[1]);
                    $email_sent_to[] = array($admin->email, $business->business_name);
                }
            }
        }
    }
    public function cronjob_tester()
    {
        $busnesses = $this->timesheet_model->get_all_businesses();
        $email_sent_to = array();
        foreach ($busnesses as $business) {
            $file_info = $this->timelogs_csv_file_setter($business->company_id);
            // $this->timelogs_csv_email_sender($business->business_email, $business->business_name, $file_info[0], $file_info[1]);

            $email_sent_to[] = array($business->business_email, $business->business_name);
            $busness_admins = $this->timesheet_model->get_all_business_admins($business->company_id);
            foreach ($busness_admins as $admin) {
                $received = false;
                for ($i = 0; $i < count($email_sent_to); $i++) {
                    if ($email_sent_to[$i][0] == $admin->email) {
                        $received = true;
                        break;
                    }
                }
                if (!$received) {
                    if ($admin->email == "pintonlou@gmail.com") {
                        $this->timelogs_csv_email_sender($admin->email, $business->business_name . " This is a Tester", $file_info[0], $file_info[1]);
                    }
                    // $this->timelogs_csv_email_sender($admin->email, $business->business_name, $file_info[0], $file_info[1]);
                    $email_sent_to[] = array($admin->email, $business->business_name);
                }
            }
        }
    }
    public function generate_timelogs_csv($date_from, $date_to, $filename, $company_id)
    {


        // file name 
        $file = fopen(APPPATH . '../timesheet/timelogs/' . $filename, 'wb');

        $date_from = $this->datetime_zone_converter($date_from . " 00:00:00", "UTC", "UTC");
        $date_to = $this->datetime_zone_converter($date_to . " 24:59:00", "UTC", "UTC");

        $attendances = $this->timesheet_model->get_all_attendance($date_from, $date_to, $company_id);

        // $file = fopen('php://output', 'w');
        $header = array(
            "Employee",
            "Title",
            "Shift Date in UTC",
            "Shift Start in UTC",
            "Shift End in UTC",
            "Clock In in UTC",
            "Clock Out in UTC",
            "Break in in UTC",
            "Break out in UTC",
            "Expected Shift Duration",
            "Expected Break Duration",
            "Expected Work Hours",
            "Worked Hours",
            "Break Duration",
            "Late in minutes",
            "Overtime",
            "OT Status",
            "Payable Hours",
            "Notes"
        );
        fputcsv($file, $header);
        foreach ($attendances as $attendance) {
            $data = array();
            $shift_date = $attendance->date_created;
            date_default_timezone_set("UTC");
            $the_date = strtotime($shift_date);
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $shift_date = date("m/d/Y", $the_date);

            $data[] = $attendance->FName . ' ' .   $attendance->LName;
            $data[] = $attendance->title;
            $data[] = $shift_date;

            date_default_timezone_set("UTC");
            $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date(date("Y-m-d", strtotime($attendance->date_created)), $attendance->user_id);
            $shift_start = '';
            $shift_end = '';
            $expected_hours = '';
            $expected_break = '';
            $expected_work_hours = '';
            foreach ($shift_schedules as $sched) {
                $olddate_start = $sched->shift_start;
                $olddate_end = $sched->shift_end;
                date_default_timezone_set("UTC");
                $the_date1 = strtotime($olddate_start);
                $the_date2 = strtotime($olddate_end);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate_start = date("m/d/Y h:i A", $the_date1);
                $newdate_end = date("m/d/Y h:i A", $the_date2);
                $shift_start = $newdate_start;
                $shift_end = $newdate_end;
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

            $data[] = $shift_start;
            $data[] = $shift_end;



            $auxes = $this->timesheet_model->get_logs_of_attendance($attendance->id);
            $checkin = '';
            $checkout = '';
            $breakin = '';
            $breakout = '';

            foreach ($auxes as $aux) {
                $olddate = $aux->date_created;
                date_default_timezone_set("UTC");
                $the_date = strtotime($olddate);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate = date("m/d/Y h:i A", $the_date);
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
            $data[] = $checkin;
            $data[] = $checkout;
            $data[] = $breakin;
            $data[] = $breakout;
            $data[] = $expected_hours;
            $data[] = $expected_break;
            $data[] = $expected_work_hours;
            $data[] =  ($attendance->shift_duration + $attendance->overtime);

            $data[] = $attendance->break_duration;

            $minutes_late = "";
            if ($shift_start != '') {
                $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin) * 60;
            }
            $data[] = round($minutes_late, 2);
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
            $data[] = $overtime;
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
            } else {
                $ot_status = "Approved";
            }
            $data[] = $ot_status;
            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status === "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }

            $data[] = $payable_hours;
            $data[] = $attendance->notes;
            fputcsv($file, $data);
        }
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
        return ($difference / 60) / 60;
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
}
