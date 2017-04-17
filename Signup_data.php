<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_data extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	public function insert_data()
	{
			$data=array("name"=>$this->input->post('name'),
			"mobile"=>$this->input->post("mobile"),
			"email"=>$this->input->post("email")
			);
		$query=$this->db->insert("tbl",$data);
		return $query;

	}
}

?>