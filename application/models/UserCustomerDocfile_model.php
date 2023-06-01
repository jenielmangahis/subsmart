
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserCustomerDocfile_model extends MY_Model
{
    public $table = 'user_customer_docfile';

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

    public function getAllByCustomerId($customer_id, $filters=array(), $limit = 0)
    {
        $this->db->select('user_customer_docfile.*,user_docfile.name AS docfile_name,jobs.job_number');
        $this->db->from($this->table);  
        $this->db->join('user_docfile', 'user_customer_docfile.docfile_id = user_docfile.id', 'left');
        $this->db->join('jobs', 'user_docfile.job_id = jobs.id', 'left');
        $this->db->where('user_customer_docfile.customer_id', $customer_id);      

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

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByUserDocfileGeneratedPdfId($pdf_id)
    {        
        $this->db->select('user_customer_docfile.*,acs_profile.company_id,user_docfile_generated_pdfs.path');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'user_customer_docfile.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('user_docfile_generated_pdfs', 'user_customer_docfile.user_docfile_generated_pdfs_id = user_docfile_generated_pdfs.id', 'left');
        $this->db->where('user_customer_docfile.user_docfile_generated_pdfs_id', $pdf_id);
        
        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file UserCustomerDocfile_model.php */
/* Location: ./application/models/UserCustomerDocfile_model.php */
