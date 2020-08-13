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

	public function notifications()
	{
		$this->page_data['page']->menu = 'notifications';
		$this->load->view('settings/notifications', $this->page_data);
	}	

	/*public function notifications()
	{
		//ifPermissions('notifications');
		$this->page_data['page']->menu = 'notifications';
		$this->load->view('settings/notifications', $this->page_data);
	}*/
	
}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */