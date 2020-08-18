<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Settings';
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session'); 
	}

    public function schedule()
    {
        $this->page_data['module'] = 'calendar';
        $post = $this->input->post();

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/frontend/js/settings/main.js',
        ));        

        if (!empty($post)) {

            $this->load->model('Settings_model', 'setting_model');
            if (!empty($settings)) {
                $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE]);

                if (!empty($settings)) {

                    // as where return multiple result as an array
                    // we need only first result
                    $setting = current($settings);

                    $this->setting_model->update($setting->id, [
                        'key' => DB_SETTINGS_TABLE_KEY_SCHEDULE,
                        'value' => serialize($post)
                    ]);
                }

                $this->session->set_flashdata('alert', 'Schedule Settings Updated Successfully');
            } else {
                $this->setting_model->create([
                    'key'   => DB_SETTINGS_TABLE_KEY_SCHEDULE,
                    'value' => serialize($post)
                ]);

                $this->session->set_flashdata('alert', 'Schedule Settings Created Successfully');
            }

            $this->session->set_flashdata('alert-type', 'success');

            redirect('workcalender');
            exit();

        } else {
            $this->page_data['page']->menu = 'settings';
            $this->load->view('settings/schedule', $this->page_data);
        }
    }    

    public function email_templates() 
    {
        $this->page_data['page']->menu = 'email_templates';
        $this->load->view('settings/email_templates', $this->page_data);
    }

    public function sms_templates()
    {
        $this->page_data['page']->menu = 'sms_templates';
        $this->load->view('settings/sms_templates', $this->page_data);
    }

    public function email_branding()
    {
        $this->page_data['page']->menu = 'email_branding';
        $this->load->view('settings/email_branding', $this->page_data);
    }    

	public function notifications()
	{
		$this->page_data['page']->menu = 'notifications';
		$this->load->view('settings/notifications', $this->page_data);
	}

    public function online_payments()
    {
        $this->page_data['page']->menu = 'online_payments';
        $this->load->view('settings/online_payments', $this->page_data);
    }      	

	/*public function notifications()
	{
		//ifPermissions('notifications');
		$this->page_data['page']->menu = 'notifications';
		$this->load->view('settings/notifications', $this->page_data);
	}*/

    public function tax_rates()
    {
        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $user = $this->session->userdata('logged');
        $user = $this->Users_model->getUser($user['id']);

        $taxRates = $this->TaxRates_model->getAllByCompanyId($user->company_id);

        $this->page_data['taxRates'] = $taxRates;
        $this->load->view('settings/tax_rates', $this->page_data);
    }

    public function create_tax_rate()
    {
        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $user = $this->session->userdata('logged');
        $user = $this->Users_model->getUser($user['id']);
        $post = $this->input->post();

        if( !empty($post) ){
            if( $user ){
                $is_default = 0;
                if( $post['is_default'] ){
                    $is_default = 1;
                }
                $data = [
                    'name' => $post['tax_name'],
                    'rate' => $post['tax_rate'],
                    'is_default' => $is_default,
                    'company_id' => $user->company_id
                ];

                $taxRates = $this->TaxRates_model->create($data);

                $this->session->set_flashdata('message', 'Add tax rate was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');

            }else{
                $this->session->set_flashdata('message', 'Cannot find user');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }
            
        }else{
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('settings/tax_rates');
    }

    public function ajax_edit_tax_rate()
    {
        $this->load->model('TaxRates_model');

        $post = $this->input->post();

        $taxRate = $this->TaxRates_model->getById($post['tid']);

        $this->page_data['taxRate'] = $taxRate;
        $this->load->view('settings/ajax_edit_tax_rate', $this->page_data);
    }

    public function update_tax_rate()
    {
        $this->load->model('TaxRates_model');
        $post = $this->input->post();
        $id   = $post['tid'];

        if( !empty($post) ){
            $is_default = 0;
            if( $post['is_default'] ){
                $is_default = 1;
            }
            $data = [
                'name' => $post['tax_name'],
                'rate' => $post['tax_rate'],
                'is_default' => $is_default
            ];

            $taxRates = $this->TaxRates_model->update($id, $data);

            $this->session->set_flashdata('message', 'Update tax rate was successful');
            $this->session->set_flashdata('alert_class', 'alert-success');
            
        }else{
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('settings/tax_rates');
    }

    public function delete_tax_rate()
    {
        $this->load->model('TaxRates_model');
        $this->TaxRates_model->delete(post('tid'));

        $this->session->set_flashdata('message', 'Tax rate has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('settings/tax_rates');
    }

    public function files_vault()
    {
        $this->load->view('settings/files_vault', $this->page_data);
    }

    public function quick_books()
    {
        $this->load->view('settings/quick_books', $this->page_data);
    }
	
}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */