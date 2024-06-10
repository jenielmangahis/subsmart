<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Comments_model extends MY_Model {



	public $table = 'comments';	
	public function __construct()
	{
		parent::__construct();

		$this->table_key = 'comment_id';
	}

    public function deleteByCommentId($comment_id){
        $this->db->delete($this->table, array('comment_id' => $comment_id));
    }	

	
}