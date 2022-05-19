<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Widgets
 *
 * @author genesisrufino
 */
class Widgets extends MY_Controller {

    //put your code here
    
    public function loadTechLeaderboard()
    {
        $comp_id = getLoggedCompanyID();
        $this->load->model('widgets_model');
        $data['tech_leaderboard'] = $this->widgets_model->loadTechLeaderboard($comp_id);
        $this->load->view('widgets/tech_leaderboard_details', $data);
    }
    
    public function getOverdueInvoices()
    {
        $this->load->model('widgets_model');
        $comp_id = getLoggedCompanyID();
        
        $data['invoices'] = $this->widgets_model->getOverdueInvoices($comp_id);
        $this->load->view('widgets/accounting/overdue_invoices_details', $data);
    }
    
    public function getJobTags()
    {
        $this->load->model('widgets_model');
        $data['tags'] = $this->widgets_model->getTags();
        $this->load->view('widgets/tags_details', $data);
        
    }

    public function getLeadSource()
    {
        $this->load->model('widgets_model');
        $comp_id = logged('company_id');
        
        $leadSource = $this->widgets_model->getLeadSource($comp_id);
       
        
        
        foreach($leadSource as $ld):
            $leadNames[] = $ld->lead_name;
            $leadSrc[] = $ld->leadSource;
        endforeach;
        
        
        echo json_encode(array('leadNames' => $leadNames,'leadSource' => $leadSrc));
    }
    
    public function removeWidget()
    {
        $this->load->model('widgets_model');
        $id = post('id');
        $user_id = logged('id');
        echo $this->widgets_model->removeWidget($id, $user_id);
        
    }
    
    public function changeOrder()
    {
        $this->load->model('widgets_model');
        $order = explode(',', post('ids'));
        $isMain = post('isMain');
        $user_id = logged('id');
        
        $orderCount = 0;
        foreach($order as $wids):
            $orderCount++;
            $details = array('wu_order' => $orderCount);
            //print_r($details);
            $this->widgets_model->changeOrder($wids, $user_id, $isMain, $details);
        endforeach;
    }
    
    public function addToMain()
    {
        
        $this->load->library('wizardlib');
        $this->load->model('widgets_model');
        $id = post('id');
        $user_id = logged('id');
        
        if(!$this->wizardlib->isWidgetGlobal($id)):
            if ($this->widgets_model->addToMain($user_id, $id)):
                $widget = $this->widgets_model->getWidgetByID($id);
                $data['id'] = $id;
                $data['class'] = 'col-lg-3 col-md-6 col-sm-12';
                $data['height'] = 'height: 310px;';
                $view = $this->load->view($widget->w_view_link,$data);

                return $view;
            endif;
        endif;
    }
    
    public function addWidget() {
        
        $this->load->library('wizardlib');
        $this->load->model('widgets_model');

        $id = post('id');
        $isGlobal = post('isGlobal');
        $isMain = post('isMain');
        $user_id = logged('id');

        $idCount = count($this->widgets_model->getWidgetListPerUser($user_id));


        $details = array(
            'wu_user_id' => $user_id,
            'wu_widget_id' => $id,
            'wu_company_id' => $isGlobal,
            'wu_order' => $idCount + 1,
            'wu_is_main' => $isMain
        );
        if (!$this->wizardlib->isWidgetUsed($id)):
            if(!$this->wizardlib->isWidgetGlobal($id)):
                if ($this->widgets_model->addWidgets($details, $user_id, $id)):
                    $widget = $this->widgets_model->getWidgetByID($id);
                    $data['id'] = $id;
                    $data['class'] = 'col-lg-3 col-md-6 col-sm-12';
                    $data['height'] = 'height: 310px;';
                    $view = $this->load->view($widget->w_view_link,$data);

                    return $view;
                endif;
            endif;
        endif;
    }

    public function loadTimesheet() {
        $this->load->model('Users_model', 'user_model');
        $this->load->model('timesheet_model');

        $attendance = $this->timesheet_model->getEmployeeAttendance();
        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();
        $logs = $this->timesheet_model->getTimesheetLogs();

        $u_role = null;
        $status = 'fa-times-circle';
        $tooltip_status = 'Not logged in';
        $time_in = null;
        $time_out = null;
        $btn_action = 'employeeCheckIn';
        $disabled = null;
        $break = 'disabled="disabled"';
        $break_id = null;
        $break_in = null;
        $break_out = null;
        $indicator_in = 'display:none';
        $indicator_out = 'display:none';
        $indicator_in_break = 'display:none';
        $indicator_out_break = 'display:none';
        $week_id = null;
        $attn_id = null;
        $yesterday_in = null;
        $yesterday_out = null;
        $clock_in_2nd = 0;
        $out_count = 0;
        $in_count = 0;
        $company_id = 0;
        $counter = 0;
        foreach ($users as $cnt => $user):
            $counter += 1;

            $user_photo = userProfileImage($user->id);
            $company_id = $user->company_id;
            foreach ($user_roles as $role) {
                if ($role->id == $user->role) {
                    $u_role = $role->title;
                }
            }
            foreach ($attendance as $attn) {
                foreach ($logs as $log) {
                    if ($user->id == $attn->user_id) {
                        $attn_id = $attn->id;
                        if ($attn_id == $log->attendance_id) {
                            if ($log->action == 'Check in') {
                                if (date('Y-m-d', strtotime($log->date_created)) == date('Y-m-d', strtotime('yesterday'))) {
                                    $yesterday_in = "(Yesterday)";
                                } else {
                                    $yesterday_in = null;
                                }
                                $time_in = date('h:i A', strtotime($log->date_created));
                                $time_out = null;
                                $break_in = null;
                                $break_out = null;
                                $btn_action = 'employeeCheckOut';
                                $status = 'fa-check';
                                $break = null;
                                $disabled = null;
                                $break_id = 'employeeBreakIn';
                                $indicator_in = 'display:block';
                                $indicator_out = 'display:none';
                                $indicator_in_break = 'display:none';
                                $indicator_out_break = 'display:none';
                                $tooltip_status = 'Logged in';
                            }
                            if ($log->action == 'Break in') {
                                $break_id = 'employeeBreakOut';
                                $status = 'fa-mug-hot';
                                $break_in = date('h:i A', strtotime($log->date_created));
                                $indicator_in = 'display:none';
                                $indicator_out = 'display:none';
                                $indicator_in_break = 'display:block';
                                $indicator_out_break = 'display:none';
                                $tooltip_status = 'On break';
                                $break_out = null;
                            }
                            if ($log->action == 'Break out') {
                                $status = 'fa-check';
                                $break_out = date('h:i A', strtotime($log->date_created));
//                                                                    $break = 'disabled="disabled"';
                                $break_id = 'employeeBreakIn';
                                $indicator_in = 'display:none';
                                $indicator_out = 'display:none';
                                $indicator_in_break = 'display:none';
                                $indicator_out_break = 'display:block';
                                $tooltip_status = 'Back to work';
                            }
                            if ($log->action == 'Check out') {
                                $status = 'fa-times-circle';
                                $btn_action = 'employeeCheckIn';
                                $time_out = date('h:i A', strtotime($log->date_created));
                                $disabled = null;
                                $break = 'disabled="disabled"';
                                $break_id = null;
                                $indicator_in = 'display:none';
                                $indicator_out = 'display:block';
                                $indicator_in_break = 'display:none';
                                $indicator_out_break = 'display:none';
                                $tooltip_status = 'Logged out';
                            }
                        }
                    }
                }
            }
            if ($indicator_in == 'display:block' || $indicator_in_break == 'display:block' || $indicator_out_break == 'display:block') {
                $in_count++;
            }
            if ($indicator_out == 'display:block') {
                $out_count++;
            }
            ?>
            <tr>
                <td>
                    <span class="tbl-employee-name"><?php echo $user->FName; ?></span> <span class="tbl-employee-name"><?php echo $user->LName; ?></span>
                    <span class="tbl-emp-role"><?php echo $u_role; ?></span>
                </td>
                <td class="tbl-chk-in" data-count="<?php echo $in_count ?>"><div class="red-indicator" style="<?php echo $indicator_in ?>"></div> <span class="clock-in-time"><?php echo $time_in ?></span> <span class="clock-in-yesterday" style="display: block;"><?php echo $yesterday_in; ?></span></td>
                <td class="tbl-chk-out" data-count="<?php echo $time_out ?>"><div class="red-indicator" style="<?php echo $indicator_out ?>"></div> <span class="clock-out-time"><?php echo $time_out ?></span></td>
                <td class="tbl-lunch-in"><div class="red-indicator" style="<?php echo $indicator_in_break ?>"></div> <span class="break-in-time"><?php echo $break_in; ?></span></td>
                <td class="tbl-lunch-out"><div class="red-indicator" style="<?php echo $indicator_out_break ?>"></div> <span class="break-out-time"><?php echo $break_out; ?></span></td>
                <!-- <td class="tbl-emp-action">
                    <a href="javascript:void(0)" title="Lunch in/out" data-toggle="tooltip" class="employee-break" id="<?php echo $break_id ?>" <?php echo $break; ?> data-id="<?php echo $user->id ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>"><i class="fa fa-coffee fa-lg"></i></a>
                    <a href="javascript:void(0)" title="Clock in/out" data-toggle="tooltip" class="employee-in-out" <?php echo $disabled ?> id="<?php echo $btn_action; ?>" data-attn="<?php echo $attn_id; ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>"><i class="fa fa-user-clock fa-lg"></i></a>
                    <i class="fa <?php echo $status; ?> status" title="<?php echo $tooltip_status; ?>" data-toggle="tooltip"></i>
                </td>
                <td></td> -->
            </tr>
            <?php
            $u_role = null;
            $status = 'fa-times-circle';
            $tooltip_status = 'Not logged in';
            $time_in = null;
            $time_out = null;
            $btn_action = 'employeeCheckIn';
            $disabled = null;
            $break = 'disabled="disabled"';
            $break_id = null;
            $break_in = null;
            $break_out = null;
            $indicator_in = 'display:none';
            $indicator_out = 'display:none';
            $indicator_in_break = 'display:none';
            $indicator_out_break = 'display:none';
            $week_id = null;
            $attn_id = null;
            $yesterday_in = null;
            $yesterday_out = null;
            ?>
            <?php
        endforeach;
    }

    public function quick_start_data() {
        $this->page_data['hey'] = 'Test';
        return $this->page_data;
    }

}
