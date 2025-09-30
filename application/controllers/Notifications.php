<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Notifications Management';
        $this->page_data['page']->menu = 'users';

        $this->load->model('User_notification_model', 'User_notification_model');
    }

    public function index()
    {
        $this->load->model('Activity_model');

        $uid = logged('id');
        $cid = logged('company_id');
        $user_type = logged('user_type');

        if ($user_type == 7) {
            $activityLogs = $this->Activity_model->getActivityLogs($cid);
        } else {
            $activityLogs = $this->Activity_model->getActivityLogsByUserId($user_id);
        }

        $this->page_data['page']->title  = 'Notification';
        $this->page_data['page']->parent = 'timesheet';
        $this->page_data['activityLogs'] = $activityLogs;
        $this->load->view('v2/pages/users/timesheet_notification_list', $this->page_data);
    }

    public function ajax_get_notifications()
    {
        date_default_timezone_set($this->session->userdata('usertimezone'));

        $post         = $this->input->post();
        $user_id      = logged('id');
        $company_id   = logged('company_id');
        $notif_status = 1; //1=unread,0=read

        $notification = $this->User_notification_model->get_notifications($company_id, $user_id, $notif_status);

        $html = '';
        
        if ($notification != null) {
            $notifyCount = count($notification);
            foreach ($notification as $notify) {

                $seen = '';
                if ($notify->status == 0) {
                    $seen = 'read';
                }

                $image        = userProfilePicture($notify->user_id);
                $date_created = date('m-d-Y h:i A', strtotime($notify->date_created));

                if ($notify->title == 'New Work Order') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("workorder") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                } elseif ($notify->title == 'New Estimates') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("estimates") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                } elseif ($notify->title == 'Clock In' || $notify->title == 'Clock Out') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("timesheet/attendance") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                } elseif ($notify->title == 'Invoice Overdue') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("invoice/tab/overdue") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                } elseif ($notify->title == 'Invoice Late Fee') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("invoice") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">Hi ' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                }
            }
        }

        $notificationListArray = array(
            'notifyCount' => $notifyCount,
            'autoNotifications' => $html,
        );

        echo json_encode($notificationListArray);
    }
    
}



/* End of file Notifications.php */

/* Location: ./application/controllers/Notifications.php */
