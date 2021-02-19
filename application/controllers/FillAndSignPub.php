<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FillAndSignPub extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        add_css([
            'assets/esign/css/bootstrap.min.css',
            'assets/css/esign/fill-and-sign/fill-and-sign.css'
        ]);

        add_footer_js([
            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'assets/js/esign/fill-and-sign/pub.js',
        ]);

        $this->load->view('esign/fill-and-sign/public', $this->page_data);
    }

    public function getDocument($hash)
    {
        $query = '
            SELECT fill_and_sign_documents.* FROM fill_and_sign_documents_links
            LEFT JOIN fill_and_sign_documents ON fill_and_sign_documents_links.document_id = fill_and_sign_documents.id
            WHERE fill_and_sign_documents_links.hash = ?;
        ';

        $result = $this->db->query($query, [$hash])->row();

        header('content-type: application/json');
        echo json_encode(['document' => $result]);
    }
}
