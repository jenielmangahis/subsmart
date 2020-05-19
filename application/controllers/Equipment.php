<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();

        $this->page_data['page']->title = 'Equipment';
        $this->page_data['page']->menu = 'equipment';

        $this->load->model('Equipment_model', 'equipment_model');
    }

    public function index()
    {
        $this->page_data['equipments'] = $this->equipment_model->getByWhere(['user_id' => logged('id')]);
        $this->load->view('equipment/list', $this->page_data);
    }

    public function json_list()
    {
        // ifPermissions('roles_list');
        $get = $this->input->get();
        $equipments = $this->equipment_model->getAll($get);

        echo json_encode($equipments);
    }

    public function add()
    {
        // ifPermissions('roles_add');
        $this->load->view('equipment/add', $this->page_data);
    }

    public function save()
    {
        postAllowed();

        $post = $this->input->post();

        // add the equipment to DB
        $equipment_id = $this->equipment_model->create(
            array(
                'user_id' => logged('id'),
                'title' => post('title')
            )
        );

        // add the items related to the equipment on DB
        if (!empty($equipment_id)) {

            if (!empty(post('items'))) {

                $this->load->model('EquipmentItem_model', 'equipmentItem_model');

                foreach (post('items') as $item) {

                    $equipment_item_id = $this->equipmentItem_model->create(
                        array(
                            'equipment_id' => $equipment_id,
                            'title' => $item['title'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                        )
                    );
                }
            }
        }

        if (!empty($equipment_id)) {

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Equipment has been created Successfully');
        } else {

            $this->session->set_flashdata('alert-type', 'error');
            $this->session->set_flashdata('alert', 'Equipment does not created. Try again later');
        }

        redirect('equipments');
    }


    /**
     * @param $id
     */
    public function edit($id)
    {
        $this->page_data['equipment'] = $this->equipment_model->getById($id);
        $this->load->view('equipment/edit', $this->page_data);
    }


    public function update($id)
    {

        postAllowed();

        $post = $this->input->post();

        // add the equipment to DB
        $equipment_id = $this->equipment_model->update($id,
            array(
                'user_id' => logged('id'),
                'title' => post('title')
            )
        );

        // add the items related to the equipment on DB
        if (!empty($equipment_id)) {

            if (!empty(post('items'))) {

                $this->load->model('EquipmentItem_model', 'equipmentItem_model');

                // remove old
                $items = get_equipment_items($equipment_id);
                foreach ($items as $item) {
                    $this->equipmentItem_model->delete($item->id);
                }

                // add new ones
                foreach (post('items') as $item) {

                    $equipment_item_id = $this->equipmentItem_model->create(
                        array(
                            'equipment_id' => $equipment_id,
                            'title' => $item['title'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                        )
                    );
                }
            }
        }

        if (!empty($equipment_id)) {

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Equipment has been created Successfully');
        } else {

            $this->session->set_flashdata('alert-type', 'error');
            $this->session->set_flashdata('alert', 'Equipment does not created. Try again later');
        }

        redirect('equipments');

    }



    public function item()
    {
        $this->load->model('EquipmentItem_model', 'equipmentItem_model');

        $itemDetails = $this->equipmentItem_model->getById(get('item_id'));

        if (empty(get('type'))) {

            die(
                json_encode($itemDetails)
            );
        }
    }

}

/* End of file Equipment.php */
/* Location: ./application/controllers/Equipment.php */