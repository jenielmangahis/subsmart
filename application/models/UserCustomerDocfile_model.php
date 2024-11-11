
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserCustomerDocfile_model extends MY_Model
{
    public $table = 'user_customer_docfile';
    public $table_generated_pdf = 'user_docfile_generated_pdfs';

    public function getAll($filters=array(), $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerId($customer_id, $search = '', $limit = 0)
    {
        $this->db->select('user_customer_docfile.*,user_docfile.name AS docfile_name,jobs.job_number');
        $this->db->from($this->table);  
        $this->db->join('user_docfile', 'user_customer_docfile.docfile_id = user_docfile.id', 'right');
        $this->db->join('jobs', 'user_docfile.job_id = jobs.id', 'left');
        $this->db->where('user_customer_docfile.customer_id', $customer_id);      

        if ( $search != '' ){
            $this->db->group_start();
            $this->db->or_like('docusign_envelope_id', $search);   
            $this->db->group_end();
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotCompletedByCustomerId($customer_id, $search = '', $limit = 0)
    {
        $this->db->select('user_customer_docfile.*,user_docfile.name AS docfile_name,jobs.job_number');
        $this->db->from($this->table);  
        $this->db->join('user_docfile', 'user_customer_docfile.docfile_id = user_docfile.id', 'right');
        $this->db->join('jobs', 'user_docfile.job_id = jobs.id', 'left');
        $this->db->where('user_customer_docfile.customer_id', $customer_id);      
        $this->db->where('user_docfile_generated_pdfs_id', 0);

        if ( $search != '' ){
            $this->db->group_start();
            $this->db->or_like('docusign_envelope_id', $search);   
            $this->db->group_end();
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByUserDocfileGeneratedPdfId($pdf_id, $search = '')
    {        
        $this->db->select('user_customer_docfile.*,acs_profile.company_id,user_docfile_generated_pdfs.path');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'user_customer_docfile.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('user_docfile_generated_pdfs', 'user_customer_docfile.user_docfile_generated_pdfs_id = user_docfile_generated_pdfs.id', 'left');
        $this->db->where('user_customer_docfile.user_docfile_generated_pdfs_id', $pdf_id);
        $this->db->order_by('user_customer_docfile.id', 'DESC');
        $query = $this->db->get()->row();
        return $query;
    }

    public function getEsignPdfById($id)
    {
        $this->db->select('id,path');
        $this->db->from($this->table_generated_pdf);
        $this->db->where('id', $id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);  
        $this->db->where('id', $id);
        
        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file UserCustomerDocfile_model.php */
/* Location: ./application/models/UserCustomerDocfile_model.php */
