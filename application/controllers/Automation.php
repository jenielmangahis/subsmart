<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Automation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Automation';
        $this->page_data['page']->parent = 'Automation';

        add_css(array(
            "assets/css/automation/automation.css",

        ));

        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Automation_model', 'automation_model');
        $this->load->model('Jobs_model', 'jobs_model');
    }

    public function index()
    {
        $this->load->helper('automation_helper');
        $this->page_data['lead_status'] = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status'] = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->page_data['automations']  = $this->automation_model->getAutomationsByParams([
            'user_id' => logged('id'),
            'status' => 'active',
        ]);

        $this->load->view('v2/pages/automation/list', $this->page_data);
    }

    public function reminders()
    {
        $this->load->helper('automation_helper');

        $this->page_data['page']->title = 'Automation Reminders';
        $this->page_data['page']->parent = 'Automation';
        $this->page_data['lead_status'] = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status'] = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->load->view('v2/pages/automation/reminders', $this->page_data);
    }

    public function marketing()
    {
        $this->page_data['page']->title = 'Automation Marketing';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/marketing', $this->page_data);
    }

    public function followUps()
    {
        $this->page_data['page']->title = 'Automation Follow-ups';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/follow_ups', $this->page_data);
    }

    public function phone()
    {
        $this->page_data['page']->title = 'Automation Phone';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/phone', $this->page_data);
    }

    public function actions()
    {
        $this->page_data['page']->title = 'Automation Actions';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/actions', $this->page_data);
    }

    public function saveAutomation()
    {
        $data = $this->input->post();

        $automationData = [
            'user_id'         => logged('id'),
            'entity'          => $data['entity'],
            'title'          => $data['title'],
            'trigger_event'   => $data['trigger_event'],
            'trigger_status'  => isset($data['trigger_status']) ? $data['trigger_status'] : null,
            'trigger_time'    => isset($data['trigger_time']) ? $data['trigger_time'] : null,
            'trigger_action'   => $data['trigger_action'],
            'target'          => $data['target'],
            'date_reference'  => $data['date_reference'],
            'timing_reference' => $data['timing_reference'],
            'template'        => $data['template'],
            'status'          => isset($data['status']) ? $data['status'] : 'active',
        ];

        $automations = $this->automation_model->saveAutomation($automationData);

        // Check if insertion is successful
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Automation saved successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save automation.']);
        }
    }

    public function addAutomation()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $automationData = $this->input->post();

        $automationData = [
            'company_id' => $company_id,
            'user_id' => $user_id,
            'subject' => $automationData['subject'],
            'sender' => $automationData['sender'],
            'recepient' => 'leahcreer111@gmail.com',
            'message' => $automationData['message'],
        ];

        $send = $this->sendEmail(
            $automationData['recepient'],
            '',
            $automationData['subject'],
            $automationData['message']
        );

        // $send = false;

        echo json_encode([
            'success' => $send ? 'true' : 'false',
            'data' => $automationData,
        ]);
    }

    function log_debug_message($message, $file = 'debug_log.txt')
    {
        // Ensure the file path is correct
        $log_file = APPPATH . 'logs/' . $file;

        // Log the message with a timestamp
        $timestamp = date('Y-m-d H:i:s');
        $full_message = "[$timestamp] $message" . PHP_EOL;

        // Append the message to the log file
        file_put_contents($log_file, $full_message, FILE_APPEND);
    }


    private function get_event_data($entity, $user_id, $trigger_status, $trigger_event)
    {
        if ($trigger_event == 'has_status' && $entity == 'job') {
            return $this->jobs_model->get_all_jobs_by_status($trigger_status, $user_id);
        }

        return [];
    }

    public function trigger_automations()
    {
        try {
            // Get all active automations
            $automations = $this->automation_model->getAutomationsByParams([
                'user_id' => logged('id'),
                'status' => 'active',
            ]);


            $debug = [];

            foreach ($automations as $automation) {
                $event_data = $this->get_event_data(
                    $automation['entity'], //entity type (job, lead, invoice, estimate)
                    $automation['user_id'],
                    $automation['trigger_status'],
                    $automation['trigger_event'] //has_status, created
                );

                foreach ($event_data as $data) {
                    // Calculate the time difference
                    $start_datetime = $data->start_date . ' ' . $data->start_time;  // Combine date and time //2024-11-28 5:30 am
                    $event_time = strtotime($start_datetime); // Convert combined datetime string to timestamp
                    date_default_timezone_set('Asia/Manila');
                    $current_time = time();

                    $trigger_time_ahead = $event_time - ($automation['trigger_time'] * 60); // Offset by trigger_time //2024-11-28 03:30:00
                    $trigger_time_after = $event_time + ($automation['trigger_time'] * 60); // Offset by trigger_time //2024-11-28 07:30:00

                    if ($event_time <= $current_time) continue;

                    // If the current time is the correct trigger time (ahead or after)
                    if (($automation['timing_reference'] == 'ahead_of' && time() >= $trigger_time_ahead) ||
                        ($automation['timing_reference'] == 'after' && time() >= $trigger_time_after)
                    ) {

                        $debug[$automation['id']][] = [
                            'event' => $data,
                            'body' => $this->prepareEmailBody($data)
                        ];

                        $subject = $automation['title'] ? $automation['title'] : 'na';
                        $send = $this->sendEmail(
                            $data->email,
                            '',
                            $subject,
                            $this->prepareEmailBody($data)
                        );
                    }
                }
            }

            echo json_encode(['status' => 'success', 'debug' => $debug]);
        } catch (Exception $error) {
            $this->log_debug_message('Error:' . $error->getMessage());
        }
    }




    private function prepareEmailBody($data)
    {

        return "
            <p>Hi, {$data->first_name}</p>
            <p>This is a friendly reminder about your upcoming service appointment with us at NSMART LLC. Here are the details:</p>
            <ul>
                <li><strong>Appointment details</strong></li>
                <li><strong>Date: </strong>$data->start_date at $data->start_time</li>
                <li><strong>Address: $data->job_location</strong></li>
                <li><strong>Techs: </strong></li>
            </ul>
            <p>Feel free to reply to this email or give us a call at {account_business_number} if you have any updates or questions</p>
            <p>Thank you!</p>
        ";
    }

    private function sendEmail($emailTo, $emailCC, $emailSubject, $emailBody)
    {
        try {
            $this->log_debug_message('sendEmail:' . $emailTo . $emailCC . $emailSubject .  $emailBody);

            $emailer = email__getInstance(['subject' => $emailSubject]);
            // Reset recipients and other data before sending the next email
            $emailer->clearAddresses();
            $emailer->addAddress($emailTo, $emailTo);
            $emailer->addAddress($emailTo, $emailTo);
            $emailer->isHTML(true);
            $emailer->Body = $emailBody;


            if (!empty($emailCC)) {
                $emailer->addCC($emailCC);
            }

            $s = $emailer->send();
            if (!$s) {
                $this->log_debug_message('Mailer Error:' . $emailer->ErrorInfo);

                return false;
            }


            return $s;
        } catch (Exception $e) {
            $this->log_debug_message('PHPMailer Exception: ' . $e->getMessage());
            return false;
        }
    }
}
