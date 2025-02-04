<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Automation extends MY_Controller
{
    private $technicians = [];

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title  = 'Automation';
        $this->page_data['page']->parent = 'Automation';

        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Automation_model', 'automation_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('JobTags_model', 'jobtags_model');
        $this->load->model('JobType_model', 'jobtype_model');

        $company_id = logged('company_id');
    }

    public function index()
    {
        $this->load->helper('automation_helper');
        $this->page_data['lead_status'] = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status']  = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->page_data['automations'] = $this->automation_model->getAutomations();
        // print_r($this->page_data['automations']);

        $this->page_data['automation_status'] = $this->automation_model->countAutomationsByStatus(logged('id'));

        $this->load->view('v2/pages/automation/list', $this->page_data);
    }

    public function reminders()
    {
        $this->load->helper('automation_helper');

        $this->page_data['page']->title  = 'Automation Reminders';
        $this->page_data['page']->parent = 'Automation';
        $this->page_data['lead_status']  = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status']   = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->load->view('v2/pages/automation/reminders', $this->page_data);
    }

    public function marketing()
    {
        $this->load->helper('automation_helper');
        $this->page_data['page']->title  = 'Automation Marketing';
        $this->page_data['page']->parent = 'Automation';
        $this->page_data['lead_status']  = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status']   = $this->customer_ad_model->get_select_options('jobs', 'status');

        $this->load->view('v2/pages/automation/marketing', $this->page_data);
    }

    public function followups()
    {
        $this->load->helper('automation_helper');
        $this->page_data['page']->title  = 'Automation Follow-ups';
        $this->page_data['page']->parent = 'Automation';
        $this->page_data['lead_status']  = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status']   = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->load->view('v2/pages/automation/follow_ups', $this->page_data);
    }

    public function phone()
    {
        $this->page_data['page']->title  = 'Automation Phone';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/phone', $this->page_data);
    }

    public function actions()
    {
        $this->load->helper('automation_helper');
        $this->page_data['page']->title  = 'Automation Actions';
        $this->page_data['page']->parent = 'Automation';
        $this->page_data['lead_status']  = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status']   = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->load->view('v2/pages/automation/actions', $this->page_data);
    }

    public function getAutomation()
    {
        $id = $this->input->post('id');

        if (! $id) {
            echo json_encode(['success' => false, 'message' => 'Invalid Automation ID']);
            return;
        }

        $data = [
            'id' => $id,
        ];
        $automation = $this->automation_model->getAutomationsByParams($data);
        if ($automation) {
            echo json_encode(['success' => true, 'data' => $automation]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Automation not found']);
        }
    }

    public function saveAutomation()
    {

        $data = $this->input->post();

        $automationData = [
            'user_id'          => logged('id'),
            'entity'           => $data['entity'],
            'title'            => $data['title'],
            'trigger_event'    => $data['trigger_event'],
            'trigger_status'   => isset($data['trigger_status']) ? $data['trigger_status'] : null,
            'trigger_time'     => isset($data['trigger_time']) ? $data['trigger_time'] : null,
            'trigger_action'   => $data['trigger_action'],
            'target'           => $data['target'],
            'date_reference'   => $data['date_reference'],
            'timing_reference' => $data['timing_reference'],
            'email_subject'    => $data['email_subject'],
            'email_body'       => $data['email_body'],
            'sms_body'       => $data['sms_body'],
            'conditions'       => $data['conditions'],
            'operation'       => $data['operation'],
            'status'           => isset($data['status']) ? $data['status'] : 'active',
        ];

        $result = $this->automation_model->saveAutomations($automationData);

        if (isset($result['error']) && $result['error']) {
            echo json_encode([
                'status' => 'error',
                'message' => $result['message'],
                'code' => $result['code'],

            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Automation saved successfully.',
                'insert_id' => $result
            ]);
        }

    }

    public function deleteAutomation()
    {
        $id = $this->input->post('id');

        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'Invalid automation ID']);
            return;
        }

        $deleted = $this->automation_model->delete_automation($id);

        if ($deleted) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete automation']);
        }
    }

    public function updateAutomation()
    {
        $id = $this->input->post('id');
        $updatedData = $this->input->post();

        if (empty($updatedData)) {
            echo json_encode(['success' => false, 'message' => 'Invalid automation ID or data']);
            return;
        }

        unset($updatedData['id']);

        $res = $this->automation_model->updateAutomationsByParams($updatedData, $id);

        if ($res) {
            echo json_encode(['success' => true, 'response' => $res]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete automation']);
        }

    }

    public function toggleAutomationStatus()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');

        if (empty($id) && empty($status)) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }

        $data = [
            'status' => $status,
        ];

        $res = $this->automation_model->updateAutomationsByParams($data, $id);
        echo json_encode(['success' => true, 'response' => $res]);
    }

    public function searchAutomation()
    {
        $this->load->helper('automation_helper');
        $query = $this->input->get('query');
        $automations = $this->automation_model->searchAutomations($query);
        if (empty($data['automations'])) {
            $data['message'] = "No automations found.";
        }

        foreach ($automations as &$automation) {
            $automation->description = generateAutomationDescription($automation); // Call the PHP function
        }
        echo json_encode(['automations' => $automations]);
    }

    public function loadAllAutomations()
    {
        $data['automations'] = $this->automation_model->getAutomations();
        $this->load->view('v2/pages/automation/search_results', $data);
    }

    public function getJobTags()
    {
        $company_id = logged('company_id');
        $tags = $this->jobtags_model->getSpecificColumn("id, name", $company_id);

        $this->returnResponse($tags, "Success", true, 200);
    }

    public function getJobTypes()
    {
        $company_id = logged('company_id');
        $types = $this->jobtype_model->getSpecificColumnJobTypes("id, title", $company_id);

        if ($types) {
            foreach ($types as &$type) {
                if (isset($type->title)) {
                    $type->name = $type->title;  // Copy 'title' to 'name'
                    unset($type->title);  // Remove 'title'
                }
            }

            $this->returnResponse($types, "Success", true, 200);
        } else {
            $this->returnResponse([], "Failed", false, 500);
        }
    }

    public function returnResponse($data, $message, $status, $code)
    {
        echo json_encode([
           'data' => $data,
           'message' => $message,
           'status' => $status,
           'code' => $code,
        ]);
    }

    public function log_debug_message($message, $file = 'debug_log.txt')
    {
        // Ensure the file path is correct
        $log_file = APPPATH . 'logs/' . $file;

        // Log the message with a timestamp
        $timestamp    = date('Y-m-d H:i:s');
        $full_message = "[$timestamp] $message" . PHP_EOL;

        // Append the message to the log file
        file_put_contents($log_file, $full_message, FILE_APPEND);
    }


    // public function triggerAutomations()
    // {
    //     $current_time = time();

    //     try {
    //         // Get all active automations
    //         $automations = $this->automation_model->getAutomationsByParams([
    //             'user_id' => logged('id'),
    //             'status'  => 'active',
    //         ]);

    //         $debug = [];

    //         foreach ($automations as $automation) {
    //             $event_data = $this->getEventData(
    //                 $automation['entity'], //entity type (job, lead, invoice, estimate)
    //                 $automation['user_id'],
    //                 $automation['trigger_event'],  //has_status, created
    //                 $automation['trigger_status'], //scheduled approved
    //             );

    //             foreach ($event_data as $data) {
    //                 $triggerTime = $this->calculateTriggerTime($data, $automation);

    //                 if ($this->isEventAlreadyQueued($automation['id'], $data->id)) {
    //                     continue; // Skip if already queued
    //                 }

    //                 $queueToInsert = [
    //                     'automation_id' => $automation['id'],
    //                     'target_id'     => $data->id,
    //                     'entity_type'   => $automation['entity'],
    //                     'is_triggered'  => 0,
    //                 ];
    //                 if ($automation['trigger_time'] == 0) {
    //                     // Trigger immediately, no need to compare time
    //                     $queueToInsert['trigger_time'] = date('Y-m-d H:i:s', time());
    //                     $this->automation_model->insertQueue($queueToInsert);
    //                     $this->processQueuedAutomations();
    //                 } elseif ($triggerTime > time()) {
    //                     $queueToInsert['trigger_time'] = date('Y-m-d H:i:s', $triggerTime);
    //                     $this->automation_model->insertQueue($queueToInsert);
    //                 } else {
    //                     $this->triggerAction($data, $automation);
    //                 }
    //             }
    //         }

    //         echo json_encode(['status' => 'success']);
    //     } catch (Exception $error) {
    //         echo json_encode(['status' => 'false', 'error' => $error->getMessage()]);
    //     }
    // }

    // public function processQueuedAutomations()
    // {

    //     $pendingItem = $this->automation_model->getPendingActions();

    //     foreach ($pendingItem as $item) {
    //         $data       = ["id" => $item['automation_id']];
    //         $automation = $this->automation_model->getAutomationsByParams($data);
    //         $data       = $this->getEventDataById($automation['entity'], $item['target_id']);

    //         $this->triggerAction($data, $automation);
    //         $this->automation_model->markEventTriggered($item['id']);
    //     }

    //     //TODO: REMOVE PENDING ITEM
    //     echo json_encode(['status' => 'success', 'pendingItem' => $pendingItem]);
    // }

    // private function triggerAction($data, $automation)
    // {
    //     $body      = $this->prepareEmailBody($data, $automation);
    //     $recipient = $this->getRecepient($automation['target'], $data);
    //     $subject   = $automation['email_subject'] ? $automation['email_subject'] : 'na';

    //     switch ($automation['action']) {
    //         case 'send_email':
    //             $this->sendEmail(['leahcreer111@gmail.com', 'janinecreer111@gmail.com'], '', $subject, $body);
    //             break;
    //         case 'send_sms':
    //             break;
    //         default:
    //             log_message('error', 'Unknown action type');
    //             break;
    //     }
    // }

    // private function calculateTriggerTime($data, $automation)
    // {
    //     $eventTime = strtotime($data->start_date . ' ' . $data->start_time); // e.g., scheduled date
    //     if ($automation['trigger_event'] === 'created') {
    //         $eventTime = strtotime($data->created_at); // e.g., creation date
    //     }

    //     return ($automation['timing_reference'] === 'ahead_of')
    //     ? $eventTime - ($automation['trigger_time'] * 60)
    //     : $eventTime + ($automation['trigger_time'] * 60);
    // }

    // private function getEventData($entity, $user_id, $trigger_event, $trigger_status = null)
    // {

    //     $filters = [];

    //     switch ($entity) {
    //         case 'job':
    //             if ($trigger_event === 'has_status') {
    //                 $filters['jobs.status'] = $trigger_status;
    //             }

    //             if ($trigger_event === 'created') {
    //                 $filters['jobs.date_created >='] = date('Y-m-d H:i:s', strtotime('-1 day')); // Example: Get records created in the last 24 hours
    //             }

    //             return $this->jobs_model->get_all_jobs_by_params($filters, $user_id);

    //             break;
    //         case 'lead':
    //             if ($trigger_event == 'has_status') {
    //                 return null;
    //             }
    //             break;
    //     }

    //     return [];
    // }

    // private function getEventDataById($entity, $target_id)
    // {
    //     switch ($entity) {
    //         case 'job':
    //             return $this->jobs_model->get_specific_job($target_id);

    //             break;
    //         case 'lead':

    //             break;
    //     }

    //     return [];
    // }

    // private function sendEmail($emailTo, $emailCC, $emailSubject, $emailBody)
    // {
    //     try {

    //         $emailer = email__getInstance(['subject' => $emailSubject]);
    //         $emailer->clearAddresses();

    //         if (is_array($emailTo)) {
    //             foreach ($emailTo as $recipient) {
    //                 $emailer->addAddress($recipient, $recipient);
    //             }
    //         } else {
    //             $emailer->addAddress($emailTo, $emailTo);
    //         }

    //         $emailer->isHTML(true);
    //         $emailer->Body = $emailBody;

    //         if (! empty($emailCC)) {
    //             $emailer->addCC($emailCC);
    //         }

    //         $s = $emailer->send();
    //         if (! $s) {
    //             return false;
    //         }

    //         return $s;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    // private function prepareEmailBody($data, $automationData)
    // {
    //     $template = $automationData['email_body'];

    //     //replace key
    //     foreach ($data as $key => $value) {
    //         $template = str_replace('{' . $key . '}', $value, $template);
    //     }

    //     //check for techs and replace
    //     if (stripos($template, '{tech_names}') !== false) {
    //         $tech     = $this->getAssignedTechNames($data);
    //         $tech     = implode(', ', $tech);
    //         $template = str_replace('{tech_names}', $tech, $template);
    //     }

    //     return $template;
    // }

    // private function getRecepient($target, $data)
    // {
    //     switch ($target) {
    //         case 'client':
    //             $email = $data->email ? $data->email : $data->cust_email;
    //             return $email;
    //         case 'technician':
    //             $technicians = $this->getTechnician($data);
    //             $emails      = array_map(fn ($user) => $user->email, $technicians);

    //             return $emails;
    //         case 'admin':
    //             return 'admin@example.com';
    //         case 'user':
    //             return $data->user_email;
    //     }
    // }

    // private function getAssignedTechNames($data)
    // {
    //     $technicians = $this->getTechnician($data);

    //     $tech = array_map(function ($user) {
    //         $firstName = $user->FName;
    //         $lastName  = $user->LName;
    //         $fullName  = $this->nameCleanup($firstName, $lastName);

    //         return $fullName;
    //     }, $technicians);

    //     return $tech;
    // }

    // private function getTechnician($data)
    // {
    //     $employeeIds = [
    //         $data->employee2_id ?? null,
    //         $data->employee3_id ?? null,
    //         $data->employee4_id ?? null,
    //         $data->employee5_id ?? null,
    //         $data->employee6_id ?? null,
    //     ];

    //     $technicians = [];
    //     foreach ($employeeIds as $employeeId) {
    //         $user = $this->users_model->getCompanyUsersById($employeeId);
    //         if ($user) {
    //             $technicians[] = $user[0];
    //         }
    //     }

    //     return $technicians;
    // }

    // private function isEventAlreadyQueued($automationId, $targetId)
    // {
    //     return $this->automation_model->getExistingQueue($automationId, $targetId) !== null;
    // }

    // public function log_debug_message($message, $file = 'debug_log.txt')
    // {
    //     // Ensure the file path is correct
    //     $log_file = APPPATH . 'logs/' . $file;

    //     // Log the message with a timestamp
    //     $timestamp    = date('Y-m-d H:i:s');
    //     $full_message = "[$timestamp] $message" . PHP_EOL;

    //     // Append the message to the log file
    //     file_put_contents($log_file, $full_message, FILE_APPEND);
    // }

    // private function nameCleanup($firstName, $lastName)
    // {
    //     $fullName = '';

    //     if (empty($firstName) && empty($lastName)) {
    //         $fullName = $firstName . ' ' . $lastName;
    //     } elseif (! empty($firstName)) {
    //         $fullName = $firstName;
    //     } elseif (! empty($lastName)) {
    //         $fullName = $lastName;
    //     } else {
    //         $fullName = '';
    //     }

    //     return $fullName;
    // }
}
