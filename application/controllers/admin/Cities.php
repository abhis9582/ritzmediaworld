<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller {
	
	
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
     $this->load->model('cities_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		$state_id = ($_REQUEST['state_id']=='')?'1':$_REQUEST['state_id'];
		$_REQUEST['state_id'] = $state_id;
		$data['state_id'] =  $state_id;
		$data['City'] =  $this->cities_model->getALLCity();
		$this->load->view('admin/city/index',$data);
	}
	
	public function add()
	{
	


	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
			array('field' => 'name','label' => 'City Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/city/add'); 
			
			}
			else{
			
			// Add new User Details
			
		$name = $_POST['name'];
$state_id = $this->input->post('state_id');
			$upd_data = array(
			'name' => $name,
			'state_id' => $this->input->post('state_id'),
			
			'status' => $this->input->post('status')
             );  
		
				$this->db->insert('cities', $upd_data);
			 


			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"City Added");
			redirect(BASE_URL.'admin/cities?state_id='.$state_id);
			}
		 }else{
		$this->load->view('admin/city/add');
		 }
		
		
	}
	
	public function edit($id)
	{
		$data['GalleryData'] =  $this->cities_model->GetCityByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/cities'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	      $config = array( 	           
			array('field' => 'name','label' => 'City Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'state_id','label' => 'State Name','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
		     );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/city/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'name' => $this->security->xss_clean($this->input->post('name')),
			'state_id' => $this->security->xss_clean($this->input->post('state_id')),
			
			'status' => $this->input->post('status')
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('cities', $upd_data);
			
			$this->session->set_flashdata('success',"City Updated");
			redirect(BASE_URL.'admin/cities');
			}
		 }
		$this->load->view('admin/city/edit',$data);
		
		
	}
	
public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("cities");
		$this->session->set_flashdata('success',"City Deleted");
			
		
		}
		redirect(BASE_URL.'admin/cities');
	}	

	
}
