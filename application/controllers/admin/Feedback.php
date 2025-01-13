<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {
	
	
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
     $this->load->model('feedback_model');  
	 $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		$data['Feedback'] =  $this->feedback_model->getFeedback();
		$this->load->view('admin/feedback/index',$data);
	}

	public function edit($id)
	{
		$data['FeedbackData'] =  $this->feedback_model->GetFeedbackByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/feedback'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	      $config = array( 	           
			array('field' => 'star','label' => 'star','rules' => 'trim|required|xss_clean'),
			array('field' => 'subject','label' => 'subject','rules' => 'trim|required|xss_clean'),
			array('field' => 'message','label' => 'message','rules' => 'trim|required|xss_clean')
			
		     );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/feedback/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'star' => $this->input->post('star'),
			'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			
			'status' => $this->input->post('status')
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('bh_feedbacks', $upd_data);
			
			//$this->session->set_flashdata('error',"Image Updated");
			redirect(BASE_URL.'admin/feedback');
			}
		 }
		else{
		$this->load->view('admin/feedback/edit',$data);
		
		}
	}
	
public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_feedbacks");
		$this->session->set_flashdata('success',"Image Deleted");
			
		
		}
		redirect(BASE_URL.'admin/feedback');
	}		
}
