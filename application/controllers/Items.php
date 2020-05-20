<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'items Management';
        $this->page_data['page']->menu = 'items';
    }

    public function getitems()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $comp_id = logged('comp_id');
        $res = $this->db->where('comp_id', $comp_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            $gh = "'" . $row->title . "'," . $row->price . "," . $row->discount;

            echo '<li onClick="setitem(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function index()
    {

        ifPermissions('items_list');

        $get = $this->input->get();

        // print_r($get); die;

        // $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('comp_id');

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['items'] = $this->items_model->filterBy(['search' => $get['search']], $comp_id);
        } else {
            $this->page_data['items'] = $this->items_model->getByWhere(['comp_id' => $comp_id]);
        }

        $this->load->view('items/list', $this->page_data);
    }

    public function add()
    {
        ifPermissions('items_add');
        $this->load->view('items/add', $this->page_data);
    }

    public function edit($id)
    {

        ifPermissions('items_edit');
        $this->page_data['items'] = $this->items_model->getById($id);
        $this->load->view('items/edit', $this->page_data);
    }


    public function save()
    {

        postAllowed();

        ifPermissions('items_add');
        $comp_id = logged('comp_id');
        $permission = $this->items_model->create([
            'comp_id' => $comp_id,
            'title' => $this->input->post('title'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'cost' => $this->input->post('cost'),
            'url' => $this->input->post('url'),
            'model' => $this->input->post('model'),
            'price1' => $this->input->post('price1'),
            'price2' => $this->input->post('price2'),
            'price3' => $this->input->post('price3'),
            'price4' => $this->input->post('price4'),
            'notes' => $this->input->post('notes')

        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');

        redirect('items');
    }


    public function update($id)
    {

        postAllowed();

        ifPermissions('items_edit');
        $comp_id = logged('comp_id');
        $data = [
            'comp_id' => $comp_id,
            'title' => $this->input->post('title'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'cost' => $this->input->post('cost'),
            'url' => $this->input->post('url'),
            'model' => $this->input->post('model'),
            'price1' => $this->input->post('price1'),
            'price2' => $this->input->post('price2'),
            'price3' => $this->input->post('price3'),
            'price4' => $this->input->post('price4'),
            'notes' => $this->input->post('notes')

        ];


        $permission = $this->items_model->update($id, $data);
        $this->activity_model->add("item #$id Updated by User: #" . logged('id'));

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'item has been Updated Successfully');

        redirect('items');
    }

    public function delete($id)
    {

        ifPermissions('items_delete');

        $this->items_model->delete($id);
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'item has been Deleted Successfully');
        $this->activity_model->add("Item #$permission Deleted by User: #" . logged('id'));
        redirect('items');
    }


    public function checkIfUnique()
    {

        $code = get('code');
        if (!$code)
            die('Invalid Request');

        $arg = ['code' => $code];

        if (!empty(get('notId')))
            $arg['id !='] = get('notId');


        $query = $this->items_model->getByWhere($arg);

        if (!empty($query))
            die('false');
        else
            die('true');
    }

    public function print()
    {

        ifPermissions('items_list');

        $get = $this->input->get();

        // print_r($get); die;

        // $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('comp_id');

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['items'] = $this->items_model->filterBy(['search' => $get['search']], $comp_id);
        } else {
            $this->page_data['items'] = $this->items_model->getByWhere(['comp_id' => $comp_id]);
        }

        $this->load->view('items/print/list', $this->page_data);
    }
}



/* End of file items.php */

/* Location: ./application/controllers/items.php */