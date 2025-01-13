<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	
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
     $this->load->model('payment_model');   
     $this->load->model('listing_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		$data['Payments'] =  $this->payment_model->getALLPayment();
		$this->load->view('admin/payment/index',$data);
	}
	
	public function view($id)
	{
		$data['id'] =  $id;
		$data['Payments'] =  $this->payment_model->getALLPaymentById($id);
		$this->load->view('admin/payment/view',$data);
	}
	
	public function add_payment($need_id)
	{
		
		
		$data['need_id'] =  $need_id;
		$data['listing'] =  $this->listing_model->GetNeedListingById($need_id);
		
		
			 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'amount','label' => 'Amount','rules' => 'trim|required|xss_clean'),
			array('field' => 'user_id','label' => 'Payment By','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/payment/add_payment',$data);
			
			}
			else{
				$bhalaai_points = $this->commonmod_model->GetBhalaaiPointByCateId($this->input->post('category_id'));
			// Add new User Details
				$updata = array(
				'need_id' => $this->input->post('need_id'),
				'category_id' => $this->input->post('category_id'),
				'transaction_through' => $this->input->post('transaction_through'),
				'transaction_id' => $this->input->post('transaction_id'),
				'user_id' => $this->input->post('user_id'),
				'amount' => $this->input->post('amount'),
				'payment_to' => 'Needy',
				'bhalaai_points' => $bhalaai_points,
				"add_date"=>date("Y-m-d h:i:s")

				); 
			 		
               
		       $this->db->insert('bh_payments', $updata);
			
			
			
			
			$this->session->set_flashdata('success',"Payment is added");
			redirect(BASE_URL.'admin/listing/need');
			}
		 }else{
		$this->load->view('admin/payment/add-payment',$data);
		 }	
	}
	public function edit_payment($id)
	{
		
		//$data['Content'] =  $this->content_model->GetContentByID(15);
		$payments =  $this->payment_model->getALLPaymentById($id);
		$data['listing'] =  $this->listing_model->GetNeedListingById($payments[0]['need_id']);
		$data['Payments'] = $payments;
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		
		
			 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	     $config = array( 	           
			array('field' => 'amount','label' => 'Amount','rules' => 'trim|required|xss_clean'),
			array('field' => 'user_id','label' => 'Payment By','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/payment/edit-payment',$data);
			
			}
			else{
			// Add new User Details
			$updata = array(
				'need_id' => $this->input->post('need_id'),
				'category_id' => $this->input->post('category_id'),
				'transaction_through' => $this->input->post('transaction_through'),
				'transaction_id' => $this->input->post('transaction_id'),
				'user_id' => $this->input->post('user_id'),
				'amount' => $this->input->post('amount'),
				'payment_to' => 'Needy',
				'bhalaai_points' => $bhalaai_points
				

				); 
			 		
               $this->db->where("id",$id);
		       $this->db->update('bh_payments', $updata);
			
			
			$this->session->set_flashdata('success',"Payment updated");
			redirect(BASE_URL.'admin/payment');
			}
		 }else{
		$this->load->view('admin/payment/edit-payment',$data);
		 }	
	}
	
	
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_payments");
		$this->session->set_flashdata('success',"Payment Deleted");
			
		
		}
		redirect(BASE_URL.'admin/payment');
	}
	
	

	
}
