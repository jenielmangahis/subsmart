<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_connectors_model  extends MY_Model {

    function getApiSidebars()
    {
        return $this->db->get('api_menu')->result();
    }

}
