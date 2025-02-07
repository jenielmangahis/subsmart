<?php
class TechSupportSidebar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Serversidetable_model', 'serverside_table');
        $this->load->model('Techsupport_model', 'techsupport_model');
    }
   
    public function viewSchedule()
    {
        $company_id = logged('company_id');
        $initializeTable = $this->serverside_table->initializeTable(
            "techsupport_schedule_view", 
            array('user', 'schedule_date', 'schedule_time', 'schedule_cc', 'schedule_notes', 'schedule_status'),
            array('user', 'schedule_date', 'schedule_time', 'schedule_cc', 'schedule_notes', 'schedule_status'),
            null,  
            array('company_id' => $company_id,),
        );

        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');
        
        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                $data[] = array(
                    utf8_decode($getDatas->user),
                    date("m/d/Y", strtotime($getDatas->schedule_date)),
                    date("g:i A", strtotime($getDatas->schedule_time)),
                    $getDatas->schedule_cc,
                    $getDatas->phone_number,
                    $getDatas->schedule_notes,
                    ($getDatas->schedule_status == "pending") ? "<span class='nsm-badge secondary'>PENDING</span>" : "<span class='nsm-badge success'>COMPLETED</span",
                    "<div class='noWidth dropdown table-management'>
                        <a href='#' name='dropdown_link' class='dropdown-toggle dotsOption' data-bs-toggle='dropdown'><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                        <ul class='dropdown-menu dropdown-menu-end'>
                            <li><a href='#' class='dropdown-item contact_customer' name='dropdown_call' data-id='$getDatas->user_id' data-phone='$getDatas->phone_number' data-action='call'>Call</a></li>
                            <li><a href='#' class='dropdown-item contact_customer' name='dropdown_call' data-id='$getDatas->user_id' data-phone='$getDatas->phone_number' data-action='sms'>Send a message</a></li>
                        </ul>
                    </div>",
                );
                $i++;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        echo json_encode($output);
    }

    public function addSchedule()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $scheduleData = $this->input->post();
        $schedule_time = date("H:i:s", strtotime("$scheduleData[schedule_time_hrs]:$scheduleData[schedule_time_mins] $scheduleData[schedule_time_notation]"));
    
        $scheduleData = [
            'company_id' => $company_id,
            'user_id' => $user_id,
            'schedule_date' => $scheduleData['schedule_date'],
            'schedule_time' => $schedule_time,
            'schedule_cc' => $scheduleData['schedule_cc'],
            'schedule_notes' => $scheduleData['schedule_notes'],
        ];
    
        $result = $this->techsupport_model->addSchedule($scheduleData);
    
        if ($result && !empty($scheduleData['schedule_cc']) && filter_var($scheduleData['schedule_cc'], FILTER_VALIDATE_EMAIL)) {
            $this->sendEmail(
                $scheduleData['schedule_cc'],
                '',
                'Schedule Confirmation',
                $this->prepareEmailBody($scheduleData)
            );
        }
    
        echo json_encode([
            'success' => $result ? 'true' : 'false'
        ]);
    }
    
    private function prepareEmailBody($scheduleData)
    {
        return "
            <p>Hello,</p>
            <p>Your schedule has been confirmed. Here are the details:</p>
            <ul>
                <li>Date: " . date("m/d/Y", strtotime($scheduleData['schedule_date'])) . "</li>
                <li>Time: " . date("g:i A", strtotime($scheduleData['schedule_time'])) . "</li>
                <li>Notes: {$scheduleData['schedule_notes']}</li>
            </ul>
            <p>You will be contacted as soon as possible.</p>
            <p>Thank you!</p>
        ";
    }
    
    private function sendEmail($emailTo, $emailCC, $emailSubject, $emailBody)
    {
        $emailer = email__getInstance(['subject' => $emailSubject]);
        $emailer->addAddress($emailTo, $emailTo);
        $emailer->isHTML(true);
        $emailer->Body = $emailBody;
    
        if (!empty($emailCC)) {
            $emailer->addCC($emailCC);
        }
    
        return $emailer->Send();
    }

    public function chatRequestProcess($requestData)
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $data = $this->input->post();
        $data['company_id'] = $company_id;
        

        $isTyping = $data['isTyping'];

        // PusherJS access tokens
        $app_id = "1933160";
        $key = "33cfc0c407521da10fe6";
        $secret = "9faa8dc5b4e87bdd0128";
        $cluster = "ap1";

         // Initialize PusherJS with its access tokens and config
        $options = array('cluster' => $cluster, 'useTLS' => true);
        $pusher = new Pusher\Pusher($key, $secret, $app_id, $options);

        if ($requestData == "send_message") {
            switch ($data['sender_type']) {
                case 'client':
                    $channel = "realtime_chat_channel";
                    $event = "chat_".$user_id."_event";
                    $data['channel'] = $channel;
                    $data['event'] = $event;
                    $data['client_company_id'] = $company_id;
                    $data['client_id'] = $user_id;
                    $data['tech_id'] = 0;  // it don't need a specific id for specific tech, it will send to all tech instead.
                    break;
                case 'tech':
                    $data['tech_company_id'] = $company_id;
                    $data['tech_id'] = $user_id;
                    break;
            }
            $addMessageProcess = $this->techsupport_model->addMessage($data);
            
            if ($addMessageProcess) {
                $pusher->trigger($data['channel'], $data['event'], $data);
                $pusher->trigger("realtime_chatlist_channel", "chatlist_event", ["status" => "chatlist_updated"]);
            }
        } 
       
        if ($requestData == "client_typing") {
            $channel = "realtime_chat_channel";
            $event = "chat_".$user_id."_event";
            $data['channel'] = $channel;
            $data['event'] = $event;
            $status = $isTyping ? "client_isTyping" : "client_isNotTyping";
            $pusher->trigger($data['channel'], $data['event'], ["status" => $status]);
        }

        if ($requestData == "tech_typing") {
            $status = $isTyping ? "tech_isTyping" : "tech_isNotTyping";
            $pusher->trigger($data['channel'], $data['event'], ["status" => $status]);
        }
        

    }

    public function fetchChatList()
    {
        $messages = $this->techsupport_model->getChatList();
        echo json_encode($messages);
    }
    
    public function fetchMessages()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $data = $this->input->post();
        $messages = $this->techsupport_model->getMessages($data['client_id']);
        echo json_encode($messages);
    }

}