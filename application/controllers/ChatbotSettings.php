<?php
class ChatbotSettings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('Chatbot_model');
        $this->load->model('Serversidetable_model', 'serverside_table');
    }

    public function settings() 
    {
        $company_id = logged('company_id');
        $preference = $this->Chatbot_model->fetchPreference($company_id);
        $this->page_data['preference'] = $preference;
        $this->page_data['page']->title = 'Chatbot';
        $this->load->view('v2/pages/chatbot/chatbot_settings', $this->page_data);
    }

    public function savePreference()
    {
        $company_id = logged('company_id');
        $savePreferenceData = $this->input->post();
        $savePreferenceData['company_id'] = $company_id;
        // ======
        $query = $this->Chatbot_model->setPreference($savePreferenceData);
        echo json_encode($query);
    }

    public function viewPreset() 
    {
        $company_id = logged('company_id');

         // Initialize Table Information
         $initializeTable = $this->serverside_table->initializeTable(
            "chatbot_preset_view", 
            array('title', 'response'),
            array('title', 'response'),
            null,  
            array(
                'company_id' => $company_id,
            ),
        );

        // Define the where condition
        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');
        
        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                
                $data[] = array(
                    $getDatas->title,
                    $getDatas->response,
                    "<div class='btn-group' role='group'><button class='nsm-button small editPresetButton' data-id='$getDatas->id' data-bs-toggle='modal' data-bs-target='.editPresetModal'>Edit</button><button class='nsm-button small removePresetButton' data-id='$getDatas->id' data-title='$getDatas->title'>Remove</button></div>",
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
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function getPreset()
    {
        $company_id = logged('company_id');
        $getPresetData = $this->input->post();
        $getPresetData['company_id'] = $company_id;
        // ======
        $query = $this->Chatbot_model->fetchPreset($getPresetData);
        echo json_encode($query);
    }

    public function addPreset() 
    {
        $company_id = logged('company_id');
        $addPresetData = $this->input->post();
        $addPresetData['company_id'] = $company_id;
        // ======
        $query = $this->Chatbot_model->createPreset($addPresetData);
        echo json_encode($query);
    }

    public function editPreset() 
    {
        $company_id = logged('company_id');
        $editPresetData = $this->input->post();
        $updateData = array(
            'title' => $editPresetData['title'],
            'response' => $editPresetData['response'],
        );
        // ======
        $query = $this->Chatbot_model->updatePreset($updateData, $editPresetData['id'], $company_id);
        echo json_encode($query);
    }

    public function removePreset() 
    {
        $company_id = logged('company_id');
        $removePresetData = $this->input->post();
        $query = $this->Chatbot_model->deletePreset($removePresetData['id']);
        echo json_encode($query);
    }
}