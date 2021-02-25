<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ringcentral_model
 *
 * @author genesisrufino
 */
class Ringcentral_model extends MY_Model {
    //put your code here
    
    function getNameByPhone($num)
    {
        $this->db->where('phone_m', $num);
        return $this->db->get('acs_profile')->row();
    }
}
