<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {

	

	public function __construct()
	{
		parent::__construct();

		$this->load->model("FetchTable");
		
	}
	public function index()
	{
		$inf["data"]=$this->FetchTable->fetch_Data();
		$inf["menu_main"]=$this->FetchTable->fetch_Menu();
		$inf["sub_menu"]=$this->FetchTable->fetch_submenu();
		$this->load->view('header',$inf);
		$this->load->view("body");
		$this->load->view('footer');
		
	}
	public function check_data()
	{

		$this->form_validation->set_rules("name","Full Name","required");
		$this->form_validation->set_rules("mobile","Contact Number","trim|numeric|required");
		$this->form_validation->set_rules("email","Email Address","trim|required|valid_email");

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view("header");
			$this->load->view("body");
			$this->load->view("footer");
		}
		else
		{	
			$this->load->model("Signup_data");
		
			if($this->Signup_data->insert_data())
			{
				$param["msg"]="Data Added Successfully!";
				redirect("Hello/index");
			}
			
			
	}
	}
	public function edit()
	{
		$id=$this->uri->segment(3);
		$data["inf"]=$this->FetchTable->get_Data($id);
		$this->load->view("header");
		$this->load->view("edit_data",$data);

	}
	public function update_Data()
	{
		
		$this->form_validation->set_rules("name","Full Name","required");
		$this->form_validation->set_rules("mobile","Contact Number","trim|numeric|required");
		$this->form_validation->set_rules("email","Email Address","trim|required|valid_email");

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view("header");
			$this->load->view("body");
			$this->load->view("footer");
		}
		else
		{			
			if($this->FetchTable->update_Data())
			{
				$this->load->view("header");
				$param["msg"]="Data Updated Successfully!";
			}
		}

	}
	public function delete()
	{
		$id=$this->uri->segment(3);
		if($this->FetchTable->delete_Data($id))
		{
			redirect("Hello/index");
		}
	}
	public function upload_image()
	{
		$id=$this->input->post("id");
		$config["upload_path"]="./uploads/";
		$config["allowed_types"]="jpg";
		//$config["max_size"]=100;
		// $config["max_height"]=1042;
		// $config["max_width"]=768;
		$path_parts = pathinfo($_FILES["file"]["name"]);
		$extension = $path_parts['extension'];
		$config["file_name"]=mt_rand(10000,999999)."_".$id."_image";
		
		$this->load->library("upload",$config);
			
		$file="file";

			if(!$this->upload->do_upload($file))
			{

				$error["msg"]=$this->upload->display_errors();
				$this->load->view("header",$error);
				$this->load->view("upload_failed");
				$this->load->view("footer");
			}
			else
			{
				if($this->FetchTable->insert_image_data($config["file_name"],$id,$extension))
				{
					$msg=$this->upload->data();
					$this->upload_success($msg);
				}
				
			}
		
	}
	public function upload_success($msg)
	{
		
		$data["msg"]=$msg["file_name"]." Uploaded Image Success";
		$this->load->view("header",$data);
		$this->load->view("upload_success");
		$this->load->view("footer");
	}
	public function view_Detail()
	{
		$id=$this->uri->segment(3);
		$data["inf"]=$this->FetchTable->get_User_Detail($id);
		$data["img"]=$this->FetchTable->get_User_Image($id);
		$this->load->view("header");
		$this->load->view("detail_body",$data);
		$this->load->view("footer");
	}
	public function pages($page_name)
	{
		echo $page_name;
	}


}