<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet_report extends MY_Controller
{
    public function timesheetWeeklyReport(){
        $page = array(
            'last_week' => $this->timesheet_model->getLastWeekTotalDuration()
        );
        //Load email library
        $this->load->library('email');
        $config = array(
            'smtp_crypto'   => 'ssl',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.nsmartrac.com',
            'smtp_port' => 465,
            'smtp_user' => 'no-reply@nsmartrac.com',
            'smtp_pass' => 'g0[05_rEa3?%',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@nsmartrac.com','nSmartrac');
//        $this->email->to('support@nsmartrac.com');
        $this->email->to('rarecandy05@gmail.com');
        $this->email->subject('Timesheet Weekly Report');
        $message = $this->load->view('users/email_template',$page,TRUE);
        $this->email->message($message);
        //Send mail
        if($this->email->send()) {
            echo json_encode("Email Send Successfully.");
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function csvTimesheetReport(){
        $start_date = date('M d',strtotime('monday last week'));
        $date = date('M d, Y',strtotime('monday last week'));
        $date = strtotime($date);
        $date = strtotime("+6 day", $date);
        $end_date = date('M d', $date);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=Timesheet Report '.$start_date.' - '.$end_date.'.csv');

        $data = $this->getTimesheetAttn();
        $users = $this->getUsers();
        $fp = fopen('php://output', 'wb');
        $shift = 0;
        $break = 0;
        $overtime = 0;
        $headers = array("NAME","TOTAL SHIFT","TOTAL BREAK","TOTAL OVERTIME");
        fputcsv($fp,$headers);
        foreach ($users as $cnt => $user){
            $name = $user->FName." ".$user->LName;
            foreach ($data as $line) {
                if ($user->id == $line->user_id){
                    $shift = $line->shift_duration;
                    $break = $line->break_duration;
                    $overtime = $line->overtime;
                }
            }
            $report = array($name,$shift,$break,$overtime);
            $shift = 0;
            $break = 0;
            $overtime = 0;
            fputcsv($fp,$report);
        }
        fclose($fp);
    }

    public function pdfTimesheetReport(){
        $start_date = date('M d',strtotime('monday last week'));
        $date = date('M d, Y',strtotime('monday last week'));
        $date = strtotime($date);
        $date = strtotime("+6 day", $date);
        $end_date = date('M d', $date);
        $this->load->library('Reportpdf');
        $title = 'Timesheet Weekly Report('.$start_date."-".$end_date.")";
        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title);
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('helvetica', '', 9);
        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        ob_start();

        $data = $this->getTimesheetAttn();
        $users = $this->getUsers();
        $display = '';
        $display .= '<table>';
        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<th style="font-weight: bold;">Name</th>';
        $display .= '<th style="font-weight: bold;text-align: center">Total Shift</th>';
        $display .= '<th style="font-weight: bold;text-align: center">Total Overtime</th>';
        $display .= '<th style="font-weight: bold;text-align: center">Total Break</th>';
        $display .= '<th style="font-weight: bold;text-align: center">PTO</th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';
        $shift = 0;
        $break = 0;
        $overtime = 0;
        foreach ($users as $cnt => $user){
            $name = $user->FName." ".$user->LName;
            foreach ($data as $line) {
                if ($user->id == $line->user_id){
                    $shift = $line->shift_duration;
                    $break = $line->break_duration;
                    $overtime = $line->overtime;
                }
            }
            $display .= '<tr>';
            $display .= '<td>'.$name.'</td>';
            $display .= '<td style="text-align: center">'.$shift.'hrs</td>';
            $display .= '<td style="text-align: center">'.$break.'hrs</td>';
            $display .= '<td style="text-align: center">'.$overtime.'hrs</td>';
            $display .= '<td style="text-align: center">0hrs</td>';
            $display .= '</tr>';
        }
        $display .= '</tbody>';
        $display .= '</table>';
        echo $display;
        $content = ob_get_contents();
        ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output($title, 'I');
    }

    public function getUsers(){
        $qry = $this->db->get('users');
        return $qry->result();
    }

    public function getTimesheetAttn(){
        $week_check = array(
            0 => date("Y-m-d",strtotime('monday last week')),
            1 => date("Y-m-d",strtotime('tuesday last week')),
            2 => date("Y-m-d",strtotime('wednesday last week')),
            3 => date("Y-m-d",strtotime('thursday last week')),
            4 => date("Y-m-d",strtotime('friday last week')),
            5 => date("Y-m-d",strtotime('saturday last week')),
            6 => date("Y-m-d",strtotime('sunday last week')),
        );
        for ($x = 0;$x < count($week_check);$x++){
            $this->db->or_where('DATE(date_created)',$week_check[$x]);
        }
        $qry = $this->db->get('timesheet_attendance');
        return $qry->result();
    }
}