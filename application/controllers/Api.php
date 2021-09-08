<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MYF_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function stripe_response()
    {
        echo $_GET['code'];
    }
}