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

        $user_id    = logged('id');
        $company_id = logged('company_id');
        $user_type  = logged('user_type');

        $notif_status  = null; //note: null means all
        $notifications = $this->User_notification_model->getAllByUserCompanyIdStatus($company_id, $user_id, $notif_status);

        $this->page_data['page']->title  = 'Notification';
        $this->page_data['page']->parent = 'notification';
        $this->page_data['notifications'] = $notifications;
        $this->load->view('v2/pages/users/notifications/list', $this->page_data);
    }

    public function ajax_get_notifications()
    {
        date_default_timezone_set($this->session->userdata('usertimezone'));

        $post         = $this->input->post();
        $user_id      = logged('id');
        $company_id   = logged('company_id');        
        $notif_status = 1; //1=unread,0=read
        $count_listed_notif = 0;

        $notification = $this->User_notification_model->get_notifications($company_id, $user_id, $notif_status);
        $html = '';
        if ($notification != null) {
            $notifyCount = count($notification);
            foreach ($notification as $notify) {

                $seen = '';
                $is_bold = ''; //'fw-bold mb-1';
                if ($notify->status == 0) {
                    $seen = 'read';
                    $is_bold = '';
                }

                $image        = userProfilePicture($notify->user_id);
                $date_created = date('m-d-Y h:i A', strtotime($notify->date_created));

                if ($notify->title == 'New Work Order') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("workorder") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    /*if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;*/

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                    $count_listed_notif++;
                } elseif ($notify->title == 'New Invoice') {
                    $redirect_url = site_url("invoice");
                    if( $notify->entity_id > 0) {
                        $redirect_url = site_url("invoice/genview/") . $notify->entity_id . '?notif_id=' . $notify->id;
                    }
                    $html .= '<div class="list-item" onclick="location.href=\'' . $redirect_url . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                    $count_listed_notif++;
                } elseif ($notify->title == 'New Estimates') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("estimate") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    /*if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;*/

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                    $count_listed_notif++;
                } elseif (strtolower($notify->title) == 'clock in' || strtolower($notify->title) == 'clock out') {

                    $redirect_url = site_url("timesheet/attendance");
                    //if($notify->entity_id != null && $notify->entity_id > 0) {
                        $redirect_url = site_url("timesheet/attendance") . '?notif_id=' . $notify->id;
                    //}                       

                    $html .= '<div class="list-item" onclick="location.href=\'' . $redirect_url . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    /*if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;*/

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle '. $is_bold .'">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                    $count_listed_notif++;
                } elseif ($notify->title == 'Invoice Overdue') {
                    $redirect_url = site_url("invoice/tab/overdue");
                    if($notify->entity_id != null && $notify->entity_id > 0) {
                        $redirect_url = site_url("invoice/genview/") . $notify->entity_id . '?notif_id=' . $notify->id;
                    }                    
                    $html .= '<div class="list-item" onclick="location.href=\'' . $redirect_url . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    /*if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;*/

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title"></span>
                                        <span class="content-subtitle '. $is_bold .'">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                    $count_listed_notif++;
                } elseif ($notify->title == 'Invoice Late Fee') {

                    if($notify->user_id == $user_id || $notify->notify_user_id == $user_id) {
                        $redirect_url = site_url("invoice");
                        if( $notify->entity_id > 0) {
                            $redirect_url = site_url("invoice/genview/") . $notify->entity_id . '?notif_id=' . $notify->id;
                        }
                        $html .= '<div class="list-item notification-item" data-type="late-fee" data-entity-id="'.$notify->entity_id.'" data-id="' . $notify->id . '">
                                    <div class="nsm-notification-item">';

                        /*if (is_null($image)) :
                            $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                        else :
                            $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                        endif;*/

                        $html .= '<div class="nsm-notification-content ' . $seen . '">
                                            <span class="content-subtitle '. $is_bold .'">' . $notify->content . '</span>
                                        </div>
                                    </div>
                                </div>';
                        $count_listed_notif++;
                    }

                } elseif($notify->title == 'Job Status') {
                    $redirect_url = site_url("job");
                    if($notify->entity_id != null && $notify->entity_id > 0) {
                        $redirect_url = site_url("job/edit/") . $notify->entity_id . '?notif_id=' . $notify->id;
                    }
                    $html .= '<div class="list-item" onclick="location.href=\'' . $redirect_url . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';


                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle '. $is_bold .'">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>'; 
                    $count_listed_notif++;                   
                } elseif ($notify->title == 'Job Updated') {
                    $redirect_url = site_url("job");
                    if($notify->entity_id != null && $notify->entity_id > 0) {
                        $redirect_url = site_url("job/edit/") . $notify->entity_id . '?notif_id=' . $notify->id;
                    }
                    $html .= '<div class="list-item" onclick="location.href=\'' . $redirect_url . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';


                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle '. $is_bold .'">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>'; 
                    $count_listed_notif++;  
                } else {

                    $redirect_url = site_url("timesheet/attendance");
                    if($notify->entity_id != null && $notify->entity_id > 0) {
                        $redirect_url = site_url("timesheet/attendance") . '?notif_id=' . $notify->id;
                    }                         

                    $html .= '<div class="list-item" onclick="location.href=\'' . $redirect_url . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    /*if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;*/

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-subtitle '. $is_bold .'">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                    $count_listed_notif++;
                }
            }
        }

        $notificationListArray = array(
            'notifyCount' => $count_listed_notif > 0 ? $count_listed_notif : $notifyCount,
            'autoNotifications' => $html,
        );

        echo json_encode($notificationListArray);
    }

    public function ajax_clear_all_notifications()
    {
        $is_success = 0;
        $cid = logged('company_id');
        $this->User_notification_model->readAllByCompanyId($cid);

        $is_success = 1;
        $msg = 'All notification has been cleared.';

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function clear_all() 
    {
        $cid = logged('company_id');
        $this->User_notification_model->readAllByCompanyId($cid);

        return redirect('notifications')->with('message', 'Clear notification completed!');
    }
    
}



/* End of file Notifications.php */

/* Location: ./application/controllers/Notifications.php */
