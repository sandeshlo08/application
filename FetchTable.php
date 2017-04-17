<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FetchTable extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	public function fetch_Data()
	{
		$query=$this->db->get("tbl");
		return $query->result();
	}
	public function fetch_Menu()
	{
		$query=$this->db->get("menu");
		return $query->result_array();
	}
	public function fetch_submenu()
	{
		$query=$this->db->get("submenu");
		return $query->result_array();

	}
	public function get_Data($id)
	{
		$query=$this->db->get_where("tbl",array("id"=>$id));
		return $query->result_array();

	}
	public function update_Data()
	{
		$id=$this->input->post("id");
		$data=array("name"=>$this->input->post('name'),
			"mobile"=>$this->input->post("mobile"),
			"email"=>$this->input->post("email")
			);
		$this->db->where("id",$id);
		$this->db->update("tbl",$data);
		redirect("Hello/index");
	}
	public function delete_Data($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("tbl");
		redirect("Hello/index");
	}
	public function insert_image_data($name,$id,$ext)
	{
		$data=array("location"=>$name.".".$ext,"user"=>$id);
		$query=$this->db->insert("images",$data);
		if($query)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_User_Detail($id)
	{
		$query=$this->db->get_where("tbl",array("id"=>$id));
		return $query->result_array();

	}
	public function get_User_Image($id)
	{
		$query=$this->db->get_where("images",array('user' => $id));
		return $query->result_array();
	}
}