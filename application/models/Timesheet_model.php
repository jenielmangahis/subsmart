<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Timesheet_model extends MY_Model
{
    public $table = 'time_record';
    private $db_table = 'timesheet_logs';
    private $attn_tbl = 'timesheet_attendance';
    private $tbl_ts_settings = 'timesheet_schedule';

    public function getNotifyCount()
    {

        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('user_notification', array('user_id' => $user_id, 'status' => 1))->num_rows();
        return $qry;
    }
    public function getNewForyouNotifications()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $company_id = logged('company_id');
        // $this->db->select('n.*,u.FName,u.LName');
        // $this->db->from('user_notification n');
        // $this->db->join('users u', 'n.user_id = u.id', 'left');
        // $this->db->where('n.status =', 1);
        // $this->db->order_by('n.id',"desc");
        // $query = $this->db->get();
        // $qry = $query->result();
        // var_dump($company_id);

        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        $date_2days_ago = date_format($date, "Y-m-d H:i:s");

        $this->db->reset_query();
        $query = $this->db->query("SELECT * from user_seen_notif JOIN user_notification on user_notification.id=user_seen_notif.notif_id where user_notification.date_created > '" . $date_2days_ago . "' and user_seen_notif.user_id = " . $user_id);
        $and_query = "";
        foreach ($query->result() as $row) {
            $and_query = $and_query . " and user_notification.id !=" . $row->notif_id;
        }
        $query = $this->db->query("SELECT user_notification.id, user_notification.user_id, user_notification.title, user_notification.content, user_notification.date_created , users.FName, users.LName, users.profile_img  FROM user_notification JOIN users ON user_notification.user_id=users.id where user_notification.date_created > '" . $date_2days_ago . "' and user_notification.company_id=" . $company_id . $and_query . " order by user_notification.date_created DESC");


        // $query = $this->db->get();
        // var_dump(query);
        // $qry = $query->result();
        return $query->result();
    }
    public function delete_read_all_notif($action, $user_id)
    {
        $company_id = logged('company_id');
        if ($action === "read-all") {
            $seen_status = 0;
        } elseif ($action === "delete-all") {
            $seen_status = 2;
        }
        $update = array("seen_status" => $seen_status);
        $this->db->where("user_id", $user_id);
        $this->db->where("seen_status", 0);
        $this->db->or_where("seen_status", 1);
        $this->db->update("user_seen_notif", $update);


        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        $date_2days_ago = date_format($date, "Y-m-d H:i:s");

        $query = $this->db->query("SELECT * from user_seen_notif JOIN user_notification on user_notification.id=user_seen_notif.notif_id where user_notification.date_created > '" . $date_2days_ago . "'");
        $and_query = "";
        foreach ($query->result() as $row) {
            $and_query = $and_query . " and user_notification.id !=" . $row->notif_id;
        }
        $query = $this->db->query("SELECT user_notification.id, user_notification.user_id, user_notification.title, user_notification.content, user_notification.date_created , users.FName, users.LName, users.profile_img  FROM user_notification JOIN users ON users.id = user_notification.user_id where user_notification.date_created > '" . $date_2days_ago . "' and user_notification.company_id=" . $company_id . $and_query . " order by user_notification.date_created DESC");
        $seen_notif = array();
        foreach ($query->result() as $row) {
            $seen_notif[] = array(
                "user_id" => $user_id,
                "notif_id" => $row->id,
                "seen_status" => $seen_status
            );
        }
        if (count($seen_notif) > 0) {
            $this->db->insert_batch('user_seen_notif', $seen_notif);
        }
    }
    public function getseennotifications()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $company_id = logged('company_id');
        $query = $this->db->query("SELECT user_notification.id, user_seen_notif.user_id,user_seen_notif.seen_status, user_notification.title, user_notification.content, user_notification.date_created , users.FName, users.LName, users.profile_img FROM user_notification JOIN users on users.id=user_notification.user_id JOIN user_seen_notif on user_notification.id=user_seen_notif.notif_id where user_seen_notif.user_id=" . $user_id . " and user_seen_notif.seen_status != 2 and user_notification.company_id = $company_id order by user_notification.date_created DESC");
        return $query->result();
    }
    public function delete_notification($notif_id, $user_id)
    {
        $this->db->select("*");
        $this->db->from("user_seen_notif");
        $this->db->where("user_id", $user_id);
        $this->db->where("notif_id", $notif_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $update = array("seen_status" => 2, "date_created" => date('Y-m-d H:i:s'));
            $this->db->where('user_id', $user_id);
            $this->db->where('notif_id', $notif_id);
            $this->db->update("user_seen_notif", $update);
        } else {
            $insert = array("seen_status" => 2, "date_created" => date('Y-m-d H:i:s'), 'user_id' => $user_id, 'notif_id' => $notif_id);
            $this->db->insert("user_seen_notif", $insert);
        }
    }
    public function get_unreadNotification($current_notif_count, $action)
    {
        $user_id = $this->session->userdata('logged')['id'];
        $company_id = logged('company_id');
        // $this->db->select('n.*,u.FName,u.LName');
        // $this->db->from('user_notification n');
        // $this->db->join('users u', 'n.user_id = u.id', 'left');
        // $this->db->where('n.status =', 1);
        // $this->db->order_by('n.id',"desc");
        // $query = $this->db->get();
        // $qry = $query->result();
        // var_dump($company_id);
        $this->db->reset_query();
        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        $date_2days_ago = date_format($date, "Y-m-d H:i:s");

        $and_query = "";
        if ($action === "counter") {
            $seened = $this->db->query("SELECT * from user_seen_notif where date_created >= '" . $date_2days_ago . "' and user_id = " . $user_id . "");
            if ($seened->num_rows() > 0) {
                foreach ($seened->result() as $row) {
                    $and_query = $and_query . " and user_notification.id != " . $row->notif_id;
                }
            }
        } else {
            $seened = $this->db->query("SELECT * from user_seen_notif where date_created >= '" . $date_2days_ago . "' and user_id = " . $user_id . " and seen_status = 2");
            if ($seened->num_rows() > 0) {
                foreach ($seened->result() as $row) {
                    $and_query = $and_query . " and user_notification.id != " . $row->notif_id;
                }
            }
        }
        $query = $this->db->query("SELECT * from users as u JOIN user_notification ON u.id = user_notification.user_id where user_notification.company_id = " . $company_id . " and user_notification.date_created >= '" . $date_2days_ago . "' " . $and_query . " order by user_notification.date_created Desc");

        if ($action === "counter") {
            return $query->num_rows();
        } elseif ($action === "notifCount") {
            return $query->num_rows();
        } else {
            return $query->result();
        }


        // $query = $this->db->get();
        // var_dump(query);
        // $qry = $query->result();

    }
    public function notif_user_acknowledge()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $company_id = logged('company_id');

        $this->db->reset_query();
        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        $date_2days_ago = date_format($date, "Y-m-d H:i:s");

        $and_query = "";
        $seened = $this->db->query("SELECT * from user_seen_notif where user_id = " . $user_id);

        foreach ($seened->result() as $row) {
            $and_query = $and_query . " and id != " . $row->notif_id;
        }

        $query = $this->db->query("SELECT * from user_notification where company_id = " . $company_id . " and date_created > '" . $date_2days_ago . "' " . $and_query . " order by date_created Desc");
        $seen_notif = array();
        foreach ($query->result() as $row) {
            $seen_notif[] = array(
                "user_id" => $user_id,
                "notif_id" => $row->id,
                "seen_status" => 1
            );
        }
        $this->db->insert_batch('user_seen_notif', $seen_notif);
    }

    public function get_company_admins($company_id)
    {
        $query = $this->db->query("SELECT * From users join timesheet_team_members where timesheet_team_members.company_id = " . $company_id . " and timesheet_team_members.role = 'Admin' and users.id=timesheet_team_members.user_id");
        return $query->result();
    }

    public function getattendance_logs($attn_id)
    {
        $this->db->select('*');
        $this->db->from('timesheet_logs');
        $this->db->where('attendance_id', $attn_id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }
    public function getClockInSession()
    {
        //        $this->db->or_where('date_in',date('Y-m-d'));
        //        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->query("SELECT * from timesheet_attendance WHERE user_id=" . $user_id . " AND status=1")->result();
        return $qry;
    }
    public function getNotification($user_id)
    {
        $qry = $this->db->get_where('user_notification', array('user_id' => $user_id))->result();
        return $qry;
    }
    public function getNotificationCount($user_id)
    {
        $qry = $this->db->get_where('user_notification', array('user_id' => $user_id, 'status' => 1))->num_rows();
        return $qry;
    }
    public function getEmployeeAttendance()
    {
        $this->db->or_where('DATE(date_created)', date('Y-m-d'));
        $this->db->or_where('DATE(date_created)', date('Y-m-d', strtotime('yesterday')));
        $qry = $this->db->get($this->attn_tbl);
        return $qry->result();
    }
    public function employeeAttendance()
    {
        $qry = $this->db->get($this->attn_tbl)->result();
        return $qry;
    }
    //Employee's End
    public function getUserAttendance()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $this->db->order_by('id', "desc")->limit(1);
        $query = $this->db->get_where($this->attn_tbl, array('user_id' => $user_id));
        return $query->result();
    }
    public function getUserLogs($attendance_id)
    {
        $this->db->where('attendance_id', $attendance_id);
        $query = $this->db->get($this->db_table);
        return $query->result();
    }
    public function convertDecimal_to_Time($dec, $requet)
    {
        // start by converting to seconds
        $seconds = ($dec * 3600);
        // we're given hours, so let's get those the easy way
        $hours = floor($dec);
        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;
        // calculate minutes left
        $minutes = floor($seconds / 60);
        // remove those from seconds as well
        $seconds -= $minutes * 60;
        // return the time formatted HH:MM:SS

        $ws = $this->leading_zero($hours) . ":" . $this->leading_zero($minutes) . "";
        if ($requet == "lunch") {
            $ws .= ":" . $this->leading_zero($seconds);
        }
        return  $ws;
    }

    // lz = leading zero
    public function leading_zero($num)
    {
        return (strlen($num) < 2) ? "0{$num}" : $num;
    }
    public function getLastWeekTotalDuration()
    {
        //        $qry = $this->db->get('ts_weekly_total_shift');
        //        return $qry->result();
        $week_check = array(
            0 => date("Y-m-d", strtotime('monday last week')),
            1 => date("Y-m-d", strtotime('tuesday last week')),
            2 => date("Y-m-d", strtotime('wednesday last week')),
            3 => date("Y-m-d", strtotime('thursday last week')),
            4 => date("Y-m-d", strtotime('friday last week')),
            5 => date("Y-m-d", strtotime('saturday last week')),
            6 => date("Y-m-d", strtotime('sunday last week')),
        );
        for ($x = 0; $x < count($week_check); $x++) {
            $this->db->or_where('DATE(date_created)', $week_check[$x]);
        }
        $qry = $this->db->get('timesheet_attendance');
        return $qry->result();
    }
    public function attendance($user_id, $status, $attn_id, $shift, $break, $overtime)
    {
        $qry = $this->db->get_where('timesheet_attendance', array('user_id' => $user_id, 'shift_duration' => 0));
        if ($qry->num_rows() == 0 && $status == 1) {
            $data = array(
                'user_id' =>  $user_id,
                'status' => 1,
                'date_created' => date('Y-m-d H:i:s')
            );
            $this->db->insert('timesheet_attendance', $data);
            return $this->db->insert_id();
        } else {
            $update = array(
                'status' => 0,
                'shift_duration' => $shift,
                'break_duration' => $break,
                'overtime' => $overtime
            );
            $this->db->where('id', $attn_id);
            $this->db->update('timesheet_attendance', $update);
            return true;
        }
    }

    public function checkInEmployee($user_id, $entry, $approved_by, $company_id)
    {
        $attn_id = $this->attendance($user_id, 1, 0, null, null, null);
        $qry = $this->db->get_where($this->db_table, array('attendance_id' => $attn_id, 'action' => 'Check in'));
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Check in',
            'user_location' => $this->employeeCoordinates(),
            'user_location_address' => $this->employeeAddress(),
            'date_created' => date('Y-m-d H:i:s'),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'company_id' => $company_id
        );
        $this->db->insert($this->db_table, $data);
        return $attn_id;
    }
    public function checkingOutEmployee($user_id, $attn_id, $entry, $approved_by, $company_id)
    {
        $data_return = "not_lunch";
        $qry = $this->db->get_where($this->db_table, array('attendance_id' => $attn_id, 'action' => 'Check in'));
        date_default_timezone_set('UTC');
        $date_created = date('Y-m-d H:i:s');
        $employeeCoordinates = $this->employeeCoordinates();
        $employeeAddress = $this->employeeAddress();
        if ($qry->num_rows() >= 1) {
            $onlunch = $this->db->get_where($this->db_table, array('attendance_id' => $attn_id));
            $breakin = false;
            $breakout = true;
            foreach ($onlunch->result() as $log) {
                if ($log->action == "Break in") {
                    $breakin = true;
                    $breakout = false;
                } elseif ($log->action == "Break out") {
                    $breakout = true;
                }
            }
            if (!$breakout) {
                $data = array(
                    'attendance_id' => $attn_id,
                    'user_id' => $user_id,
                    'action' => 'Break out',
                    'user_location' => $employeeCoordinates,
                    'user_location_address' => $employeeAddress,
                    'entry_type' => $entry,
                    'approved_by' => $approved_by,
                    'company_id' => $company_id
                );
                $this->db->insert($this->db_table, $data);
                $data_return = "on_lunch";
            }


            $data = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'user_location' =>  $employeeCoordinates,
                'user_location_address' => $employeeAddress,
                'entry_type' => $entry,
                'approved_by' => $approved_by,
                'company_id' => $company_id
            );
            $this->db->insert($this->db_table, $data);
            $break = $this->calculateBreakDuration($attn_id);
            $update = array(
                'break_duration' => round($break, 2),
                'status' => 0
            );
            $this->db->where('id', $attn_id);
            $this->db->update('timesheet_attendance', $update);


            $ShiftDuration_and_overtime = $this->calculateShiftDuration_and_overtime($attn_id);
            $update = array(
                'shift_duration' => round($ShiftDuration_and_overtime[0], 2),
                //                'break_duration' => $break_duration,
                'overtime' => round($ShiftDuration_and_overtime[1], 2),
                //                'date_out' => date('Y-m-d'),
                'status' => 0
            );
            $this->db->where('id', $attn_id);
            $this->db->update('timesheet_attendance', $update);

            $affected_row = $this->db->affected_rows();

            if ($affected_row > 0) {
                return $data_return;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function calculateShiftDuration_and_overtime($attn_id)
    {

        date_default_timezone_set('UTC');
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('timesheet_attendance', array('id' => $attn_id));
        foreach ($qry->result() as $att) {
            $user_id = $att->user_id;
            break;
        }
        $user_logs = $this->db->get_where('timesheet_logs', array('attendance_id' => $attn_id));
        // var_dump($user_logs);
        $count_of_checkins = 0;
        $check_in = "";
        $total_hours = 0;
        $total_minutes = 0;
        foreach ($user_logs->result() as $row) {
            if ($row->action == "Check in") {
                $count_of_checkins++;
                if ($count_of_checkins == 1) {
                    $check_in = $row->date_created;
                }
            } elseif ($row->action == "Check out" && $count_of_checkins > 1) {
                $start = new DateTime($check_in);
                $end = new DateTime($row->date_created);
                $interval = $start->diff($end);
                $minutes = ($interval->days * 24 * 60) * 60;
                $minutes += ($interval->h * 60) * 60;
                $minutes += ($interval->i) * 60;
                $minutes += $interval->s;
                $minutes = $minutes / 60;
            }
        }

        if ($count_of_checkins % 2 != 0) {
            $start = new DateTime($check_in);
            $end =  new DateTime(date('Y-m-d H:i:s'));
            $interval = $start->diff($end);

            $minutes = ($interval->days * 24 * 60) * 60;
            $minutes += ($interval->h * 60) * 60;
            $minutes += ($interval->i) * 60;
            $minutes += $interval->s;
            $minutes = $minutes / 60;
        }

        $break_duration = 0;
        $qry = $this->db->query("SELECT * FROM timesheet_attendance WHERE id = " . $attn_id);
        $attendance = $qry->result();
        foreach ($attendance as $row) {
            $break_duration = $row->break_duration;
        }

        $total_worked_hours = ($minutes / 60) - $break_duration;

        if ($total_worked_hours > 8) {
            $shift_duration = 8;
            $over_time = $total_worked_hours - 8;
        } else {
            $shift_duration = $total_worked_hours;
            $over_time = 0;
        }

        $data = array($shift_duration, $over_time);
        return $data;
    }
    public function calculateBreakDuration($attn_id)
    {

        date_default_timezone_set('UTC');
        $user_id = $this->session->userdata('logged')['id'];

        $qry = $this->db->query("SELECT * FROM timesheet_logs WHERE attendance_id = " . $attn_id);
        $user_logs = $qry->result();
        // var_dump($user_logs);
        $break_in = "";
        $total_hours = 0;
        $total_minutes = 0;
        $total_seconds = 0;
        foreach ($user_logs as $row) {
            if ($row->action == "Break in") {
                $break_in = $row->date_created;
            } elseif ($row->action == "Break out") {
                $start = new DateTime($break_in);
                $end = new DateTime($row->date_created);
                $interval = $start->diff($end);

                $total_hours = $total_hours + $interval->format("%H");
                $total_minutes = $total_minutes + $interval->format("%i");
                $total_seconds = $total_seconds + $interval->format("%i");
            }
        }

        $result = round((((($total_hours * 60) * 60) + ($total_minutes * 60) + $total_seconds) / 60) / 60, 2);

        return $result;
    }

    public function calculateOvertime($user_id, $attn_id)
    {
        $shift = $this->calculateShiftDuration_and_overtime($attn_id);
        $query = $this->db->get_where('ts_schedule_day', array('user_id' => $user_id, 'start_date' => date('Y-m-d')));
        $hired_type = $this->db->get_where('users', array('id' => $user_id));
        $min_duration = 0;
        $overtime = 0;
        if ($hired_type->row()->status == 1) {
            $min_duration = 8;
        } else {
            $min_duration = 4;
        }
        if ($query->num_rows() == 1) {
            $sched = $query->row()->duration;
            $overtime = $shift[0] - $sched;
        } else {
            $overtime = $shift[0] - $min_duration;
        }
        return round($overtime, 2);
    }

    public function breakIn($user_id, $entry, $approved_by, $company_id)
    {
        //Get timesheet_attendance id
        date_default_timezone_set('UTC');
        $attn_id = $this->db->get_where($this->attn_tbl, array('user_id' => $user_id, 'status' => 1))->row()->id;

        $time = time();
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break in',
            'user_location' => $this->employeeCoordinates(),
            'user_location_address' => $this->employeeAddress(),
            'date_created' => date('Y-m-d H:i:s', $time),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'company_id' => $company_id
        );
        $this->db->insert($this->db_table, $data);
        return $time;
    }

    public function breakOut($user_id, $entry, $approved_by, $company_id)
    {
        $attn_id = $this->db->get_where($this->attn_tbl, array('user_id' => $user_id, 'status' => 1))->row()->id;
        date_default_timezone_set('UTC');
        $time = time();
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break out',
            'user_location' => $this->employeeCoordinates(),
            'user_location_address' => $this->employeeAddress(),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'company_id' => $company_id
        );
        $this->db->insert("timesheet_logs", $data);
        //Update break duration
        $break = $this->updateBreakDuration($attn_id);
        if ($break == true) {
            return $time;
        } else {
            return 0;
        }
    }
    public function gtMyIpGlobal()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        $whitelist = array(
            '127.0.0.1', // IPv4 address
            '::1' // IPv6 address
        );
        if (in_array($ipaddress, $whitelist)) {
            return "";
        } else {
            return $ipaddress;
        }
    }
    public function employeeCoordinates()
    {
        $ipaddress = $this->gtMyIpGlobal();
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/' . $ipaddress));
        return $get_location->lat . "," . $get_location->lon; //to get coordinates
    }

    private function employeeAddress()
    {
        $ipaddress = $this->gtMyIpGlobal();
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/' . $ipaddress));
        $lat = $get_location->lat;
        $lng = $get_location->lon;
        $g_map = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&sensor=true&key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4');
        $output = json_decode($g_map);
        $status = $output->status;
        $address = ($status == "OK") ? $output->results[1]->formatted_address : 'Address not found';
        return $address;
    }

    public function updateBreakDuration($attn_id)
    {
        $query = $this->db->get_where($this->attn_tbl, array('id' => $attn_id));
        $this->db->order_by('date_created', 'DESC')->limit(1);
        $break_in = $this->db->get_where($this->db_table, array('attendance_id' => $attn_id, 'action' => 'Break in'));
        $this->db->order_by('date_created', 'DESC')->limit(1);
        $break_out = $this->db->get_where($this->db_table, array('attendance_id' => $attn_id, 'action' => 'Break out'));
        $total_time = strtotime($break_out->row()->date_created) - strtotime($break_in->row()->date_created);
        $hours      = floor($total_time / 3600);
        $minutes    = intval(($total_time / 60) % 60);
        $seconds    = intval($total_time % 60);
        $break_diff = "$hours" . ":" . $minutes . ":" . $seconds . ":";
        $timeArr = explode(':', $break_diff);
        $decTime = ($timeArr[0] * 60) + ($timeArr[1]) + ($timeArr[2] / 60);
        if ($query->num_rows() == 1) {
            $this->db->set('break_duration', 'break_duration+' . $decTime, FALSE);
            $this->db->where('id', $attn_id)->update($this->attn_tbl);
            return true;
        } else {
            return false;
        }
    }

    public function getTSLogsByUser()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where($this->db_table, array('user_id' => $user_id, 'status' => 1))->result();
        return $qry;
    }
    public function getTimesheetLogs()
    {
        $qry = $this->db->get('timesheet_logs');
        return $qry->result();
    }
    public function getTSByDate($date_this_week)
    {
        //            $this->db->like('date_created',date('Y-m-d',strtotime('yesterday')));
        for ($x = 0; $x < count($date_this_week); $x++) {
            $this->db->or_like('date_created', $date_this_week[$x]);
        }
        $qry = $this->db->get('timesheet_logs');
        return $qry->result();
    }
    public function getUser_current_status($user_id, $date)
    {
        $this->db->select('*');
        $this->db->from('timesheet_logs');
        $this->db->where('user_id', $user_id);
        $this->db->like('date_created', $date);
        $this->db->order_by('id', "DESC")->limit(1);
        $qry = $this->db->get();
        return $qry->result();
    }



    public function getNotLoggedInEmployees($date)
    {

        $total_users = $this->users_model->getTotalUsers();
        date_default_timezone_set('UTC');
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from("users");
        $this->db->join("timesheet_attendance", 'users.id = timesheet_attendance.user_id');
        $this->db->where("users.company_id", $company_id);
        $this->db->where("timesheet_attendance.status", 1);
        $this->db->like("timesheet_attendance.date_created", $date);
        $query = $this->db->get();
        // $this->db->or_where('DATE(date_created)',date('Y-m-d'));
        // $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        // $this->db->where('status',1);
        // $query =  $this->db->get('timesheet_attendance');
        // var_dump( $query->result());
        $logged_in = $query->num_rows();
        return $total_users - $logged_in;
    }
    public function getInNow()
    {
        $this->db->or_where('DATE(date_created)', date('Y-m-d'));
        //        $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        $this->db->where('status', 1);
        $query = $this->db->get('timesheet_attendance');
        return $query->num_rows();
    }
    public function getOutNow()
    {
        // $total_user = $this->users_model->getTotalUsers();
        $this->db->like('date_created', date('Y-m-d'));
        $this->db->where('status', 0);
        $query = $this->db->get('timesheet_attendance');
        $qry = $query->result();
        return count($qry);
    }

    public function getAttendanceByDay($day)
    {
        $this->db->or_where('DATE(date_created)', $day);
        $this->db->or_where('DATE(date_created)', date('Y-m-d', strtotime('yesterday')));
        $query = $this->db->get('timesheet_attendance')->result();
        return $query;
    }
    public function getTimeSettingsByUser()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('timesheet_schedule', array('user_id' => $user_id));
        return $qry->result();
    }
    public function getTimesheetDayByUser()
    {
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('ts_schedule_day', array('user_id' => $user_id));
        return $qry->result();
    }

    public function getTimeSheetSettings()
    {
        $qry = $this->db->get('timesheet_schedule');
        return $qry->result();
    }
    public function getTimeSheetDay()
    {
        $qry = $this->db->get('ts_schedule_day');
        return $qry->result();
    }
    public function getTimeSheetByWeek($week)
    {
        for ($x = 0; $x < count($week); $x++) {
            $this->db->or_where('date_created', $week[$x]);
        }
        $qry = $this->db->get('timesheet_schedule');
        return $qry->result();
    }
    public function getTimeSheetByUser($users_id)
    {
        $this->db->where('user_id', $users_id);
        $qry = $this->db->get('timesheet_schedule');
        return $qry->result();
    }
    public function getTimeSheetDayById($timesheet_id)
    {
        $qry = $this->db->get_where('ts_schedule_day', array('schedule_id' => $timesheet_id));
        return $qry->result();
    }
    public function get_on_lunch($date, $company_id)
    {
        // $qry = $this->db->query("SELECT * from timesheet_attendance JOIN timesheet_logs ON timesheet_attendance.id = timesheet_logs.attendance_id where timesheet_attendance.status = 1 and timesheet_logs.action = 'Break in' and and timesheet_logs.action = 'Break out'");
        $qry = $this->db->query("SELECT * FROM timesheet_attendance WHERE status = 1");
        $on_lunch_ctr = 0;
        foreach ($qry->result() as $row) {
            $break_in_ctr = 0;
            $break_out_ctr = 0;
            $action_breaks = $this->db->query("SELECT * FROM timesheet_logs WHERE attendance_id = $row->id");
            if (count($action_breaks->result()) > 0) {
                foreach ($action_breaks->result() as $logs) {
                    if ($logs->action == "Break in") {
                        $break_in_ctr++;
                    }
                    if ($logs->action == "Break out") {
                        $break_out_ctr++;
                    }
                }
                if ($break_in_ctr > $break_out_ctr) {
                    $on_lunch_ctr++;
                }
            }
        }

        return  $on_lunch_ctr;
    }
    public function get_manual_checkins($date, $company_id)
    {
        $qry = $this->db->query("SELECT * from timesheet_logs JOIN users as u ON u.id = timesheet_logs.user_id where u.company_id = " . $company_id . " AND timesheet_logs.action = 'Check in' AND timesheet_logs.date_created LIKE '" . $date . "%' AND timesheet_logs.entry_type = 'Manual'");
        return $qry->num_rows();
    }

    public function addingProjects($data)
    {
        $week_convert = date('Y-m-d', strtotime($data['week']));
        $qry = $this->db->get_where($this->tbl_ts_settings, array('project_name' => $data['project'], 'user_id' => $data['user_id']));
        if ($qry->num_rows() == 0) {
            $insert = array(
                'user_id' => $data['user_id'],
                'project_name' => $data['project'],
                'timezone' => $data['timezone'],
                'notes' => $data['notes'],
                'total_duration_w' => intval($data['duration']),
                'date_created' => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
                'status' => 1
            );
            $this->db->insert($this->tbl_ts_settings, $insert);
            $ts_id = $this->db->insert_id();
            $this->perDaySchedule($ts_id, $data);
            return true;
        } else {
            return false;
        }
    }
    //Updating timesheet settings total duration
    public function recalculateWeekDuration($ts_id)
    {
        $total = 0;
        $query = $this->db->get_where('ts_schedule_day', array('schedule_id' => $ts_id))->result();
        foreach ($query as $durations) {
            $total += $durations->duration;
        }
        $ts_settings = array('total_duration_w' => $total);
        $this->db->where('id', $ts_id);
        $this->db->update('timesheet_schedule', $ts_settings);
    }
    public function perDaySchedule($ts_id, $data)
    {
        $qry = $this->db->get_where('ts_schedule_day', array('schedule_id' => $ts_id, 'start_date' => $data['start_date']));
        if ($qry->num_rows() == 0) {
            $insert = array(
                'user_id' => $data['user_id'],
                'schedule_id' => $ts_id,
                'start_date' => $data['start_date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'day' => $data['day'],
                'duration' => intval($data['duration'])
            );
            $this->db->insert('ts_schedule_day', $insert);
            $this->recalculateWeekDuration($ts_id);
        } else {
            $update = array(
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'duration' => $data['duration']
            );
            $array_check = array('schedule_id' => $ts_id, 'start_date' => $data['start_date']);
            $this->db->where($array_check);
            $this->db->update('ts_schedule_day', $update);
            $this->recalculateWeekDuration($ts_id);
        }
        return true;
    }
    public function updateTSProject($id, $update)
    {
        $qry = $this->db->get_where('timesheet_schedule', array('id' => $id));
        if ($qry->num_rows() == 1) {
            $this->db->where('id', $id);
            $this->db->update('timesheet_schedule', $update);
            return true;
        } else {
            return false;
        }
    }
    public function updateTotalWeekDuration($update)
    {
        $qry = $this->db->get_where('timesheet_schedule', array('id' => $update['project_id']));
        if ($qry->num_rows() == 1) {
            $data = array(
                'total_duration_w' => $update['total']
            );
            $this->db->where('id', $update['project_id']);
            $this->db->update('timesheet_schedule', $data);
            return true;
        } else {
            return false;
        }
    }
    //Get PTO Type
    public function getPTO()
    {
        $qry = $this->db->get('timesheet_pto');
        return $qry->result();
    }
    public function getPTOByName($name)
    {
        $this->db->like('name', $name);
        $query = $this->db->get('timesheet_pto');
        return $query->result();
    }

    //Adding PTO type
    public function savedPTO($id, $type)
    {
        for ($x = 0; $x < count($type); $x++) {
            if ($type[$x] != null) {
                $update = array(
                    'name' => $type[$x]
                );
                $find = array('id' => $id[$x]);
                $check = $this->db->where($find);
                if ($check == true && $id[$x] > 0) {
                    $this->db->update('timesheet_pto', $update);
                } else {
                    $qry = $this->db->get_where('timesheet_pto', array('name' => $type[$x]));
                    if ($qry->num_rows() == 0) {
                        $insert = array(
                            'name' => $type[$x],
                            'company_id' => getLoggedCompanyID()
                        );
                        $this->db->insert('timesheet_pto', $insert);
                    }
                }
            }
        }
    }
    //Employee requesting leave
    public function employeeRequestLeave($pto, $date)
    {
        $user_id = $this->session->userdata('logged')['id'];
        $query = $this->db->get_where('timesheet_leave', array('user_id' => $user_id));
        if ($query->num_rows() == 0) {
            $insert = array(
                'pto_id' => $pto,
                'user_id' => $user_id,
                'status' => 0
            );
            $this->db->insert('timesheet_leave', $insert);
            $leave_id = $this->db->insert_id();
            //Inserting the dates
            for ($x = 0; $x < count($date); $x++) {
                $data[] = array(
                    'leave_id' => $leave_id,
                    'date' => date('Y-m-d', strtotime($date[$x]))
                );
            }
            $this->db->insert_batch('timesheet_leave_date', $data);
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }

    //Get leave request
    public function getLeaveRequest()
    {
        $this->db->order_by("date_created", "desc");
        $qry = $this->db->get('timesheet_leave');
        return $qry->result();
    }
    //Get leave date
    public function getLeaveDate()
    {
        $this->db->order_by("date", "desc");
        $qry = $this->db->get('timesheet_leave_date');
        return $qry->result();
    }

    //Invite link
    public function inviteLinkEntry($email, $name, $role)
    {
        $user_id = $this->session->userdata('logged')['id'];
        $query = $this->db->get_where('timesheet_team_members', array('email' => $email));
        if ($query->num_rows() == 0) {
            $data = array(
                'user_id' => $user_id,
                'role' => $role,
                'name' => $name,
                'email' => $email,
                'status' => 0
            );
            $this->db->insert('timesheet_team_members', $data);
        }
        //Inserting invitation code.
        $random = sha1(rand());
        $insert = array(
            'email' => $email,
            'invitation_code' => $random,
            'status' => 1,
            'date_created' => date('Y-m-d h:i:s')
        );
        $this->db->insert('timesheet_invite_link', $insert);
        return $random;
    }
    //Department
    public function getDepartment()
    {
        $qry = $this->db->get('timesheet_departments');
        return $qry->result();
    }
    public function getDepartmentById($id)
    {
        $return = null;
        if ($id != 0 || $id != null) {
            $qry = $this->db->get_where('timesheet_departments', array('id' => $id));
            if ($qry->num_rows() == 1) {
                $return = $qry->result();
            } else {
                $return = 0;
            }
        } else {
            $return = 0;
        }
        return $return;
    }
    //Adding department
    public function addDepartment($dept)
    {
        $user_id = $this->session->userdata('logged')['id'];
        $return = 1;
        for ($x = 0; $x < count($dept); $x++) {
            $query = $this->db->get_where('timesheet_departments', array('name' => $dept[$x]));
            if ($query->num_rows() == 0) {
                $insert = array(
                    'name' => $dept[$x],
                    'user_id' => $user_id
                );
                $this->db->insert('timesheet_departments', $insert);
                $return = 1;
            } else {
                $return = 0;
            }
        }
        return $return;
    }
    //Workweek and Overtime settings
    public function workweekOvertimeSettings($data)
    {
        $qry = $this->db->get_where('timesheet_settings', array('company_id' => getLoggedCompanyID()));
        if ($qry->num_rows() == 0) {
            $insert = array(
                'company_id' => getLoggedCompanyID(),
                'workweek_start_day' => $data['start_day'],
                'regular_hours_per_week' => $data['hours_week'],
                'regular_hours_per_day' => $data['hours_day'],
                'overtime' => $data['overtime']
            );
            $this->db->insert('timesheet_settings', $insert);
            return true;
        } elseif ($qry->num_rows() == 1) {
            $update = array(
                'workweek_start_day' => $data['start_day'],
                'regular_hours_per_week' => $data['hours_week'],
                'regular_hours_per_day' => $data['hours_day'],
                'overtime' => $data['overtime']
            );
            $this->db->where('company_id', getLoggedCompanyID());
            $this->db->update('timesheet_settings', $update);
            return true;
        } else {
            return false;
        }
    }
    //Break Preference
    public function breakPreference($data)
    {
        $qry = $this->db->get_where('timesheet_settings', array('company_id' => getLoggedCompanyID()));
        if ($qry->num_rows() == 0) {
            $insert = array(
                'company_id' => getLoggedCompanyID(),
                'break_rule' => $data['break_rule'],
                'break_length' => $data['length'],
                'break_type' => $data['type']
            );
            $this->db->insert('timesheet_settings', $insert);
            return true;
        } elseif ($qry->num_rows() == 1) {
            $update = array(
                'break_rule' => $data['break_rule'],
                'break_length' => $data['length'],
                'break_type' => $data['type']
            );
            $this->db->where('company_id', getLoggedCompanyID());
            $this->db->update('timesheet_settings', $update);
            return true;
        } else {
            return false;
        }
    }
    public function get_attendance($user_id, $date)
    {
        $this->db->select('*');
        $this->db->from('timesheet_attendance');
        $this->db->where("user_id", $user_id);
        $this->db->like('date_created', $date);
        $query = $this->db->get();
        return  $query;
    }

    public function getLeaveList($date, $status_request)
    {
        if ($status_request === "pending") {
            $status = 0;
        } elseif ($status_request === "approved") {
            $status = 1;
        } else {
            $status = 2; //unapproved
        }
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('timesheet_leave');
        $this->db->join('timesheet_leave_date', 'timesheet_leave_date.leave_id = timesheet_leave.id');
        $this->db->join('users', 'users.id = timesheet_leave.user_id');
        $this->db->where("timesheet_leave_date.date", $date);
        $this->db->where("timesheet_leave.status", $status);
        $this->db->where("users.company_id", $company_id);
        $query = $this->db->get();
        return $query->result();
    }
    ////Lou pinton's code starts here
    public function gethis_leaveType($user_id, $date, $status_request)
    {
        if ($status_request === "pending") {
            $status = 0;
        } elseif ($status_request === "approved") {
            $status = 1;
        } else {
            $status = 2; //unapproved
        }
        $this->db->select('*');
        $this->db->from('timesheet_leave');
        $this->db->join('timesheet_leave_date', 'timesheet_leave_date.leave_id = timesheet_leave.id');
        $this->db->join('timesheet_pto', 'timesheet_pto.id = timesheet_leave.pto_id');
        $this->db->where("timesheet_leave.user_id", $user_id);
        $this->db->where("timesheet_leave_date.date", $date);
        $this->db->where("timesheet_leave.status", $status);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllLogsToday($user_id, $date)
    {
        $this->db->select('*');
        $this->db->from('timesheet_logs');
        $this->db->where("user_id", $user_id);
        $this->db->like("date_created", $date);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_employees($user_id, $company_id)
    {
    }
    public function get_employee_shift_schedule($user_id, $week)
    {
        $or_query = "";
        for ($x = 0; $x < count($week); $x++) {
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $the_date = strtotime($week[$x] . " 00:00:00");
            date_default_timezone_set("UTC");
            $shift_date = date('Y-m-d', $the_date);
            if ($or_query != "") {
                $or_query .= ' or shift_date = "' . $shift_date . '"';
            } else {
                $or_query .= ' shift_date = "' . $shift_date . '"';
            }
        }
        $qry = $this->db->query('SELECT * FROM timesheet_shift_schedule WHERE (' . $or_query . ') and user_id = ' . $user_id . ' order by shift_date DESC');
        return $qry->result();
    }
    public function get_all_employee_shift_schedule($week)
    {
        for ($x = 0; $x < count($week); $x++) {
            $this->db->or_where('shift_date', $week[$x]);
        }
        $qry = $this->db->get('timesheet_shift_schedule');
        return $qry->result();
    }
    public function is_schedule_exist($user_id, $shift_date)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('shift_date', $shift_date);
        $qry = $this->db->get('timesheet_shift_schedule');
    }
    public function update_existing_schedule($data, $shift_date, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('shift_date', $shift_date);
        $this->db->update('timesheet_shift_schedule', $data);
    }
    public function add_new_shift_shedules($data)
    {
        $this->db->insert_batch('timesheet_shift_schedule', $data);
    }
    public function delete_shift_schedule($queries)
    {
        $this->db->query('DELETE FROM timesheet_shift_schedule WHERE ' . $queries);
    }
    public function get_all_attendance($date_from, $date_to, $company_id)
    {
        $qry = $this->db->query("SELECT 
        timesheet_attendance.id,timesheet_attendance.user_id,timesheet_attendance.date_created,timesheet_attendance.shift_duration, timesheet_attendance.break_duration, timesheet_attendance.overtime, timesheet_attendance.overtime_status,
        users.FName, users.LName, roles.title
            FROM timesheet_attendance JOIN users ON timesheet_attendance.user_id = users.id JOIN roles ON users.role = roles.id WHERE timesheet_attendance.date_created >='" . $date_from . "' AND timesheet_attendance.date_created <='" . $date_to . "' AND users.company_id = " . $company_id . " order by timesheet_attendance.date_created DESC");
        return $qry->result();
    }
    public function get_logs_of_attendance($att_id)
    {
        $this->db->where('attendance_id', $att_id);
        $qry = $this->db->get('timesheet_logs');
        return $qry->result();
    }
    public function get_schedule_in_shift_date($shift_date, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('shift_date', $shift_date);
        $qry = $this->db->get('timesheet_shift_schedule');
        return $qry->result();
    }
    public function get_especitif_attendance($att_id)
    {
        $this->db->where('id', $att_id);
        $qry = $this->db->get('timesheet_attendance');
        return $qry->result();
    }
}



/* End of file Timesheet_model.php */

/* Location: ./application/models/Timesheet_model.php */
