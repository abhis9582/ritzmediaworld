<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Othercategory extends CI_Controller {
	
	
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
     $this->login->check_login();	 
     $this->load->model('other_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
        
      
		$data['Blog_Categories'] =  $this->other_model->getALLOthersCategories();
       
		$this->load->view('admin/othercategory/index',$data);
	}
	
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'category_name','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'category_description','label' => 'Category Description','rules' => 'trim|required|xss_clean')
			
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/othercategory/add'); 
			
			}
			else{
			// Add new User Details
			$data = array(
			'category_name' => $this->input->post('category_name'),
			'category_description' => $this->input->post('category_description'),
			'total_rooms' => $this->input->post('total_rooms'),
			
			
			'status' => $this->input->post('status')
            );  		

			$this->db->insert('bh_others_categories', $data);
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Property Type Added");
			redirect(BASE_URL.'admin/othercategories');
			}
		 }
		 else{
			 
			$this->load->view('admin/othercategory/add'); 
		 }
		//$this->load->view('admin/othercategory/add');
		
		
	}
	
	public function edit($id)
	{
		$data['BlogCatData'] =  $this->other_model->GetOthersCategoryByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/othercategories'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	
            $config = array( 	           
			array('field' => 'category_name','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'category_description','label' => 'Category Description','rules' => 'trim|required|xss_clean')
			 );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/othercategory/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'category_name' => $this->input->post('category_name'),
			'category_description' => $this->input->post('category_description'),
			'total_rooms' => $this->input->post('total_rooms'),
			
			'sort_order' => $this->input->post('sort_order'),
			'status' => $this->input->post('status')
            ); 
			
            $this->db->where('id', $id);
			$this->db->update('bh_others_categories', $upd_data);
			
			
			$this->session->set_flashdata('success',"Property Type Updated");
			redirect(BASE_URL.'admin/othercategories');
			}
		 }
		$this->load->view('admin/othercategory/edit',$data);
		
		
	}
	
	
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_others_categories");
		$this->session->set_flashdata('success',"Property Type Deleted");
		
		}
		redirect(BASE_URL.'admin/othercategories');
	}
	
	

	
}
