<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller {
	
	
	function __construct(){
		
	 parent::__construct();
	$this->load->library('form_validation');	
   $this->load->helper(array('form', 'url')); 	 
   $this->load->helper('cookie');
   //
  
    $this->load->library('session'); 
    $this->load->helper('security');
    $this->load->library('email'); 
    $this->load->library('encrypt');
  // Custom Ours
  
     $this->load->library('login');  
 $this->load->library('image');   		 
     $this->login->check_login();	 
     $this->load->model('enquiry_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index(){
		$data['Gallery'] =  $this->enquiry_model->getALLEnquiry("ContactUs");
		$this->load->view('admin/enquiry/index',$data);
	}
	
	public function enquiries(){
		$data['Gallery'] =  $this->enquiry_model->getALLEnquiry("Enquiries");
		$this->load->view('admin/enquiry/enquiries',$data);
	}
	
	public function career(){
		$data['Gallery'] =  $this->enquiry_model->getALLCareer();
		$this->load->view('admin/enquiry/career',$data);
	}
	
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->where("etype","ContactUs");
		$this->db->delete("bh_enquiry");
		$this->session->set_flashdata('success',"Contact Data Deleted.");
		}
		redirect(BASE_URL.'admin/enquiry/index');
	}

	public function Edelete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->where("etype","Enquiries");
		$this->db->delete("bh_enquiry");
		$this->session->set_flashdata('success',"Enquiry Data Deleted.");
		}
		redirect(BASE_URL.'admin/enquiry/enquiries');
	}
	
		
	public function pdelete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_enquiry");
		$this->session->set_flashdata('success',"Enquiries Deleted.");
		}
		redirect(BASE_URL.'admin/enquiry/index/Enquiries');
	}
	
	public function cdelete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_career");
		$this->session->set_flashdata('success',"Career Record Deleted.");
		}
		redirect(BASE_URL.'admin/enquiry/career');
	}

	
	

	
}
