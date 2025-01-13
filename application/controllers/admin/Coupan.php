<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupan extends CI_Controller {
	
	
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
     $this->load->model('coupan_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		$data['Coupans'] =  $this->coupan_model->getALLCopuan();
		$this->load->view('admin/coupan/index',$data);
	}
	
	
	
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'coupon_code','label' => 'Coupan Code','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/coupan/add'); 
			
			}
			else{
			
			$coupon_code = $this->input->post('coupon_code',TRUE);

			$minimum_order_amount = ($this->input->post('minimum_order_amount',TRUE)!='' ) ? $this->input->post('minimum_order_amount',TRUE) : "0.0000";

			$posted_data = array(

			'coupon_code'=>$coupon_code,

			'coupon_type'=>$this->input->post('coupon_type',TRUE),

		

			'coupon_discount'=>$this->input->post('coupon_discount',TRUE),

			'minimum_order_amount'=>$minimum_order_amount,

			'start_date'=>date("Y-m-d",strtotime($this->input->post('start_date',TRUE))),

			'end_date'=>date("Y-m-d",strtotime($this->input->post('end_date',TRUE))),

			'date_added'=>date("Y-m-d")

			);

			$this->db->insert('wp_coupons', $posted_data);
			$insert_id = $this->db->insert_id();
			
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Coupan Added");
			redirect(BASE_URL.'admin/coupan');
			}
		 }else{
		$this->load->view('admin/coupan/add');
		 }
		
		
	}
	
	public function edit($id)
	{
		$data['GalleryData'] =  $this->coupan_model->GetCoupanByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/coupan'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	      $config = array( 	           
				array('field' => 'coupon_code','label' => 'Coupan Code','rules' => 'trim|required|xss_clean')
			
		     );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/coupan/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$posted_data = array(

				'coupon_code'=>$this->input->post('coupon_code',TRUE),
				
				'coupon_type'=>$this->input->post('coupon_type',TRUE),

			

				'coupon_discount'=>$this->input->post('coupon_discount',TRUE),

				'minimum_order_amount'=>$this->input->post('minimum_order_amount',TRUE),

				'start_date'=>$this->input->post('start_date',TRUE),

				'end_date'=>$this->input->post('end_date',TRUE)

				);	
			
            $this->db->where('coupon_id', $id);
			$this->db->update('wp_coupons', $posted_data);
			
			
			
			
			$this->session->set_flashdata('success',"Coupan Updated");
			redirect(BASE_URL.'admin/coupan');
			}
		 }else{
		$this->load->view('admin/coupan/edit',$data);
		 }
		
		
	}
	
public function delete($id){
	
		if($id!=''){
		$this->db->where("coupon_id",$id);
		$this->db->delete("wp_coupons");
		$this->session->set_flashdata('success',"Coupan Deleted");
			
		
		}
		redirect(BASE_URL.'admin/coupan');
	}	

	
}
