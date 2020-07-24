<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingScheduleAssignedUser_model extends MY_Model
{
    public $table = 'booking_schedule_assigned_users';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function findAllByBookingSettingId($booking_setting_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("booking_setting_id", $booking_setting_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function countTotalByBookingSettingId($booking_setting_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('booking_setting_id', $booking_setting_id);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }    

    public function batchInsert($data){
        $this->db->insert_batch($this->table, $data); 
    }    

    public function deleteAllBySettingId($booking_setting_id){
        $this->db->delete($this->table, array('booking_setting_id' => $booking_setting_id));
    } 

}

/* End of file BookingCoupon_modal.php */
/* Location: ./application/models/BookingCoupon_modal.php */
