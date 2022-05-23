<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('wizard_model');
        $this->load->model('wizard_apps_model');
        $user_id = getLoggedUserID();

        add_css(array(
            'assets/wizard/css/style.css',
            'assets/wizard/css/responsive.css',
            'assets/wizard/css/slick-theme.min.css',
            'assets/wizard/css/slick.min.css',
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/invoice/add.js',
            'assets/js/invoice.js'
        ));
    }

    public function index() {
        $this->page_data['wizards_workspace'] = $this->wizard_model->getAllIndustries();
        //$this->page_data['wizards'] = $this->wizard_model->getAllCompanies();
        //$this->load->view('wizard/list', $this->page_data);
        $this->load->view('wizard/index', $this->page_data);
    }
    
    
    public function savepaymethod(){
        
        
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $new_data = array(
            'payment_method' => 'CASH',
            'quick_name' => 'CASH',
            'user_id' => $user_id,
            'company_id' => $company_id,
        );

        $this->db->insert('payment_method', $new_data);
        
        
        //fetch latest update

        $this->load->library('wizardlib');
        $details = $this->paymethodDetails($company_id);
        $this->wizardlib->trigWiz('savepaymethod', $company_id, $details);
        
    }
    
    private function paymethodDetails($company_id)
    {
        $this->db->where('company_id', $company_id);
        $q = $this->db->get('payment_method')->result();
        
        $details = '<table><tr><th>#</th><th>Payment Method</th></tr>';
        $i = 0;
        foreach ($q as $result):
            $i++;
            $details .= "<tr><td>$i</td><td>$result->quick_name</td></tr>";
        endforeach;
        $details .= '</table>';
        
        return $details;
    }
    
    
    public function myWiz() {
        $this->load->library('wizardlib');
        $company_id  = getLoggedCompanyID();
        $this->page_data['wiz'] = $this->wizard_apps_model->getAppsByCompanyId($company_id);
        $this->load->view('wizard/myWiz', $this->page_data);
    }
    
    public function sendEmail() {
        $this->load->library('wizardlib');
        
        $this->db->where('id', 3);
        $q = $this->db->get('wizard_gmail_config')->row();
        
        $userId = getLoggedUserID();
        $template = $q->wgc_body;
        $map = array(
            'username' => getLoggedFullName($userId),
            'details'  => 'Added Cash as new method'
        );
        
        echo $this->wizardlib->replace_tags($template, $map);
        
    }

    public function saveCreatedWiz() {
        $user_id = getLoggedUserID();
        $company_id = getLoggedCompanyID();
        $details = array(
            'wa_user_id' => $user_id,
            'wa_company_id' => $company_id,
            'wa_name' => post('wizName'),
            'wa_trigger_app_id' => post('wizTrigger'),
            'wa_action_app_id' => post('wizAction'),
            'wa_is_enabled' => post('wizEnabled'),
            'wa_date_created' => date('Y-m-d g:i:s'),
            'wa_date_enabled' => (post('wizEnabled') == 1 ? date('Y-m-d g:i:s') : '0000-00-00 00:00:00'),
            'wa_config_data' => post('wizConfig')
        );

        $result = $this->wizard_model->saveCreatedWiz($details, $company_id, post('wizTrigger'), post('wizAction'));
        if (json_decode($result)->status):
            if (post('wizConfig') != 0):
                $configName = post('configName');
                $this->wizard_apps_model->updateConfigData(post('wizConfig'), json_decode($result)->id, $configName);
            endif;
        endif;

        echo $result;
    }

    public function setupGmailSend() {
        $this->page_data['img'] = $this->input->post('img');
        $this->load->view('wizard/app_config/wiz_gmail', $this->page_data);
    }

    public function deleteApp() {
        $id = $this->input->post('app_id');
        if ($this->wizard_model->deleteApp($id)):
            echo json_encode(array('success' => TRUE, 'msg' => 'Successfully Deleted'));
        else:
            echo json_encode(array('success' => FALSE, 'msg' => 'Sorry something went wrong'));
        endif;
    }

    public function deleteAppFunc() {
        $id = $this->input->post('fn_id');
        if ($this->wizard_model->deleteAppFunc($id)):
            echo json_encode(array('success' => TRUE, 'msg' => 'Successfully Deleted'));
        else:
            echo json_encode(array('success' => FALSE, 'msg' => 'Sorry something went wrong'));
        endif;
    }

    public function getActionAppFuncById($fnId) {
        $func = $this->wizard_model->fetchAppFunc($fnId);

        foreach ($func as $fn):
            $appConfig = $fn->config_fn;
            ?>
            <a onclick="$('#action_id').val('<?= $fn->wiz_app_func_id ?>'),
                            $('#action_name').val('<?= $fn->wiz_app_nice_name ?>'),
                            $('.trigFunc').removeClass('active'),
                            $('#has_config').val('<?= $fn->has_config ?>'),
                            $('#action_config').val('<?= $appConfig ?>'),
                            $('#img_config').val('<?= $fn->app_img ?>'),
                            $(this).addClass('active'), $('#actionNext').removeClass('disabled')" 

               href="#" class="list-group-item list-group-item-action flex-column align-items-start trigFunc">

                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?= $fn->wiz_app_nice_name ?></h5>
                </div>
                <p class="mb-1"><?= $fn->wiz_func_desc ?></p>
            </a>
            <?php
        endforeach;
    }

    public function getTrigAppFuncById($fnId) {
        $func = $this->wizard_model->fetchAppFunc($fnId);

        foreach ($func as $fn):
            ?>
            <a onclick="$('#trig_id').val('<?= $fn->wiz_app_func_id ?>'), $('#trig_name').val('<?= $fn->wiz_app_nice_name ?>'), $('.trigFunc').removeClass('active'), $(this).addClass('active'), $('#triggerNext').removeClass('disabled')" href="#" class="list-group-item list-group-item-action flex-column align-items-start trigFunc">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?= $fn->wiz_app_nice_name ?></h5>
                </div>
                <p class="mb-1"><?= $fn->wiz_func_desc ?></p>
            </a>
            <?php
        endforeach;
    }

    public function fetchTriggerApp($details) {
        $this->load->model('wizard_apps_model');
        echo $this->wizard_apps_model->fetch_data($details);
    }

    public function fetchAppFunc() {
        $fnId = $this->input->post('fn_id');
        $func = $this->wizard_model->fetchAppFunc($fnId);

        foreach ($func as $fn):
            ?>
            <tr id="appList_<?= $fn->wiz_app_func_id ?>">
                <td></td>
                <td><?= $fn->wiz_app_nice_name ?></td>
                <td><?= $fn->wiz_app_function ?></td>
                <td><?= $fn->wiz_func_desc ?></td>
                <td title="Delete" class="text-center"><a onmouseover="$('#deleteAppFuncID').val('<?= $fn->wiz_app_func_id ?>')" href="#deleteAppFunc" data-toggle="modal" class="text-danger"><i class="fa fa-trash-o"></i></a></td>
            </tr>
            <?php
        endforeach;
    }

    public function addAppFunc() {
        $fn_nice = $this->input->post('fn_nice');
        $fn_name = $this->input->post('fn_name');
        $fn_desc = $this->input->post('fn_desc');
        $fn_id = $this->input->post('fn_id');

        $result = $this->wizard_model->addAppFunc($fn_nice, $fn_name, $fn_desc, $fn_id);
        if ($result == 1):
            echo 'Successfully Added';
        elseif ($result == 2):
            echo 'App Already Exist';
        else:
            echo 'Something went wrong, Please try again later';
        endif;
    }

    public function addApp() {
        $app_name = $this->input->post('app_name');
        $app_icon = $this->input->post('app_icon');
        $result = $this->wizard_model->addApp($app_name, $app_icon);
        if ($result == 1):
            echo 'Successfully Added';
        elseif ($result == 2):
            echo 'App Already Exist';
        else:
            echo 'Something went wrong, Please try again later';
        endif;
    }

    public function addWizardApp() {
        $apps = $this->wizard_model->getWizApps();
        $this->page_data['wiz_apps'] = $apps;

        $this->load->view('wizard/add_wizard_app_function', $this->page_data);
    }

    public function add() {
        $this->load->view('wizard/add', $this->page_data);
    }

    public function save($id = '') {
        if ($id != '' && $id > 0) {
            $this->db->where('id', $id);
            $this->db->update($this->wizard_model->table, ['title' => $this->input->post('title'),
                'description' => $this->input->post('description')]);
        } else {
            $this->db->insert($this->wizard_model->table, ['title' => $this->input->post('title'),
                'description' => $this->input->post('description')]);
        }

        redirect('wizard');
    }

    public function view($id) {

        $this->page_data['User'] = $this->company_model->getById($id);

        $this->page_data['User']->role = $this->roles_model->getByWhere([
                    'id' => $this->page_data['User']->role
                ])[0];

        $this->page_data['User']->activity = $this->activity_model->getByWhere([
            'user' => $id
                ], ['order' => ['id', 'desc']]);

        $this->load->view('company/view', $this->page_data);
    }

    public function edit($id) {



        $this->page_data['User'] = $this->company_model->getById($id);

        $this->load->view('company/edit', $this->page_data);
    }

    public function update($id) {

        postAllowed();


        $data = [
            'role' => post('role'),
            'name' => post('name'),
            'username' => post('username'),
            'email' => post('email'),
            'phone' => post('phone'),
            'address' => post('address'),
        ];



        $password = post('password');



        if (logged('id') != $id)
            $data['status'] = post('status') == 1;



        if (!empty($password))
            $data['password'] = hash("sha256", $password);



        $id = $this->company_model->update($id, $data);



        if (!empty($_FILES['image']['name'])) {



            $path = $_FILES['image']['name'];

            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $this->uploadlib->initialize([
                'file_name' => $id . '.' . $ext
            ]);

            $image = $this->uploadlib->uploadImage('image', '/users');



            if ($image['status']) {

                $this->company_model->update($id, ['img_type' => $ext]);
            }
        }



        $this->activity_model->add("User #$id Updated by User:" . logged('name'));



        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Client Profile has been Updated Successfully');



        redirect('company');
    }

    public function check() {

        $email = !empty(get('email')) ? get('email') : false;

        $username = !empty(get('username')) ? get('username') : false;

        $notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;



        if ($email)
            $exists = count($this->company_model->getByWhere([
                                'email' => $email,
                                'id !=' => $notId,
                    ])) > 0 ? true : false;



        if ($username)
            $exists = count($this->company_model->getByWhere([
                                'username' => $username,
                                'id !=' => $notId,
                    ])) > 0 ? true : false;



        echo $exists ? 'false' : 'true';
    }

    public function delete($id) {

        if ($id !== 1 && $id != logged($id)) {
            
        } else {

            redirect('/', 'refresh');

            return;
        }



        $id = $this->company_model->delete($id);



        $this->activity_model->add("User #$id Deleted by User:" . logged('name'));



        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'User has been Deleted Successfully');



        redirect('company');
    }

    public function change_status($id) {

        $this->company_model->update($id, ['status' => get('status') == 'true' ? 1 : 0]);

        echo 'done';
    }

    public function add_wizard() {
        $this->load->view('wizard/add_wizard', $this->page_data);
    }

    public function listing_wizard() {
        $this->page_data['wizards_workspace'] = $this->wizard_model->getAllIndustries();
        $this->load->view('wizard/listing', $this->page_data);
    }

    public function save_listing_wizard($id = '') {
        if ($this->input->post('id') != '' && $this->input->post('id') > 0) {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update($this->wizard_model->tableWorkspaces, ['name' => $this->input->post('name')]);
        } else {
            $this->db->insert($this->wizard_model->tableWorkspaces, ['name' => $this->input->post('name')]);
        }

        redirect('wizard/listing_wizard');
    }

    public function delete_listing_wizard($id) {



        $this->db->where('id', $id);
        $this->db->delete($this->wizard_model->tableWorkspaces);

        redirect('wizard/listing_wizard');
    }

    public function build_wizard() {
        $this->load->view('wizard/build_wizard', $this->page_data);
    }

    public function mailchimp() {
        $this->load->view('wizard/mailchimp', $this->page_data);
    }

    public function fetch() {
        $this->load->model('wizard_apps_model');
        echo $this->wizard_apps_model->fetch_data($this->uri->segment(3));
    }

    public function show_app() {
        $id = $this->input->post('app_id');
        $this->wizard_apps_model->show_app($id);
    }

    public function del_app() {
        $id = $this->input->post('app_id');
        $this->wizard_apps_model->del_app($id);
    }

    public function getSubOptions() {
        $id = $this->input->post('id');
        echo $this->wizard_suboptions_model->getSubOptions($id);
    }

}

/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */