<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tcpdf_lib
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        require_once(dirname(__FILE__)."/tcpdf/tcpdf.php");
    }

    

}

/* End of file tcpdf_lib.php */
/* Location: ./application/libraries/tcpdf_lib.php */
