<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	
	
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
     $this->load->model('booking_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		$data['status'] =  1;
		$data['Bookings'] =  $this->booking_model->getALLBooking("Booked");
		$this->load->view('admin/booking/index',$data);
	}
	
	public function category($id)
	{
		$data['category_id'] =  $id;
		$data['Bookings'] =  $this->booking_model->getALLBookingsBycategoryId($id);
		$this->load->view('admin/booking/index',$data);
	}
	public function status($status)
	{
		$statusval = $this->commonmod_model->getBookingStatus($status);
		$data['status'] =  $status;
		$data['Bookings'] =  $this->booking_model->getALLBooking($statusval);
		$this->load->view('admin/booking/index',$data);
	}
	
	public function add2()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'category_id','label' => 'Blog Category','rules' => 'trim|required|xss_clean'),
			array('field' => 'title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
		   array('field' => 'status','label' => 'Meta Keywords','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/howitworks/add'); 
			
			}
			else{
			
			// Add new User Details
			$data = array(
			'category_id' => $this->input->post('category_id'),
			'title' => $this->input->post('title'),
			'youtube_video' => $this->input->post('youtube_video'),
			'description' => $this->input->post('description'),
		
			'add_date' => date("Y-m-d h:i:s"),
			
			'status' => $this->input->post('status')
             );  		

			$this->db->insert('bh_howitworks', $data);
			$insert_id = $this->db->insert_id();
			// Add new Page Image
			for($k=1;$k<=1;$k++){
			if ($_FILES['howitworks_image'.$k]['name'])
				{	
                 $error_view_url = 'admin/howitworks/edit';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/blogs/','2048','189','130','howitworks_image1',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("howitworks_image1"=>$FileName);
				  $this->db->where('id', $insert_id);
			      $this->db->update('bh_howitworks', $upd_data);
				}
				} 
			}
			
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"How It Works Added");
			redirect(BASE_URL.'admin/howitworks');
			}
		 }
		$this->load->view('admin/howitworks/add');
		
		
	}
	
	public function edit($id)
	{
		$data['Bookingdata'] =  $this->booking_model->GetBookingsByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/booking'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'category_id','label' => 'Blog Category','rules' => 'trim|required|xss_clean'),
			array('field' => 'email_id','label' => 'Email Id','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile_number','label' => 'Contact Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'booking_date_from','label' => 'Booking Date From','rules' => 'trim|required|xss_clean'),
			array('field' => 'booking_date_to','label' => 'Booking Date To','rules' => 'trim|required|xss_clean')
		    );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/booking/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'category_id' => $this->input->post('category_id'),
			'email_id' => $this->input->post('email_id'),
		    'mobile_number' => $this->input->post('mobile_number'),
			'comment' => $this->input->post('comment'),
			'status' => $this->input->post('status')
			); 
			
            $this->db->where('id', $id);
			$this->db->update('bh_bookings', $upd_data);
			
			// Booking Date Update and conditions
			
			 $booking_Data =  $this->booking_model->GetBookingsByID($id);
			 
			  $start_date = date("Y-m-d",strtotime($booking_Data[0]["booking_date_from"]));
			  $end_date = date("Y-m-d",strtotime($booking_Data[0]["booking_date_to"]));
			 
			  $booking_date_from = date("Y-m-d",strtotime($this->input->post('booking_date_from')));
			  $booking_date_to = date("Y-m-d",strtotime($this->input->post('booking_date_to')));
			
			if($start_date!=$booking_date_from || $end_date!=$booking_date_to){
			 
				$dates_available = $this->commonmod_model->checkBookingDatesIsAvailable($booking_Data[0]['listing_id'],$booking_Data[0]['category_id'], $booking_date_from,$booking_date_to,$id);
               
			
              if(strtotime($enddate) < strtotime($startdate)){
			  $this->session->set_flashdata('error',"Booking Date From can be greater than Boking Date To");
			 redirect(BASE_URL.'admin/booking/edit/'.$id);
			 exit();
			 
			 }else if(count($dates_available) > 0){
			 $this->session->set_flashdata('error',"Booking Date ".$booking_date_from." to ".$booking_date_to." is not available.");
			 redirect(BASE_URL.'admin/booking/edit/'.$id);
			 exit();
			 
			 } else{
			 $booking_data = array(
		     'booking_date_from' =>  $booking_date_from ,
			 'booking_date_to' => $booking_date_to
			); 
			
            $this->db->where('id', $id);
			$this->db->update('bh_bookings', $booking_data);
			 }
			
			}
			
			
			
			
			
			$this->session->set_flashdata('success',"Booking Updated");
			redirect(BASE_URL.'admin/booking');
			}
		 }else{
		$this->load->view('admin/booking/edit',$data);
		 }
		
		
	}
	
	
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_bookings");
		$this->session->set_flashdata('success',"Booking is Deleted");
			
		
		}
		redirect(BASE_URL.'admin/booking');
	}
	
	

	
}
