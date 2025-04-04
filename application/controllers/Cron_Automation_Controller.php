<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_Automation_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Automation_model', 'automation_model');
        $this->load->model('Automation_queue_model', 'automation_queue_model');

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
    }

    public function cronMailAutomation()
    {
        $auto_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_email',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'created',
            //'trigger_time' => 0,
            'target' => 'user'
        ];
        $automationData = $this->automation_model->getAutomationByParams($auto_params);  

        echo '<pre>';
        print_r($automationData);
        echo '</pre>';

        $data_queue = [
            'automation_id' => 1,
            'target_id' => 0,
            'entity_type' => 'invoice',
            'status' => 'new',
            'entity_id' => 2121,
            'trigger_time' => null,
            'is_triggered' => 0
        ];

        $automation_queue = $this->automation_queue_model->saveAutomationQueue($data_queue);
    }

    public function cronSmsAutomation()
    {
        
    }
}
