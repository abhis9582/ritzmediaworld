<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wedding extends CI_Controller {
	
	
	function __construct(){
		
	 parent::__construct();
		$this->load->library('form_validation');	
		$this->load->helper(array('form', 'url')); 	 
		$this->load->helper('cookie');
		//

		$this->load->library('session'); 
		$this->load->helper('security');
		$this->load->library('email');
		$this->load->library('encryption');
		// Custom Ours

		$this->load->library('login');  
        $this->load->library('image');   		
		$this->login->check_login();	 
		$this->load->model('content_model');   
		$this->load->model('commonmod_model');   
		$this->load->database();   
	}

	
	public function index()
	{
		$data['Wedding'] =  $this->content_model->GetALLWedding();
		$this->load->view('admin/wedding/index',$data);
	}
	
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'page_title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			array('field' => 'page_heading','label' => 'Page Heading','rules' => 'trim|required|xss_clean'),
			array('field' => 'meta_title','label' => 'Meta Title','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'status','label' => 'Meta Keywords','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/wedding/add'); 
			
			}
			else{
			$data = array(
			'page_title' => $this->input->post('page_title'),
			'page_heading' => $this->input->post('page_heading'),
			'page_description' => $this->input->post('page_description'),
			'page_short_description' => $this->input->post('page_short_description'),
			
			'heading_title' => $this->input->post('heading_title'),
			'heading_description' => $this->input->post('heading_description'),
			'read_more_text' => $this->input->post('read_more_text'),
			'read_more_link' => $this->input->post('read_more_link'),
			
			'meta_title' => $this->input->post('meta_title'),
			'meta_description' => $this->input->post('meta_description'),
			'meta_keywords' => $this->input->post('meta_keywords'),
			'add_date' => date("Y-m-d h:i:s"),
			
			'status' => $this->input->post('status')
             );  		

			$this->db->insert('bh_wedding', $data);
			$Page_id = $this->db->insert_id();
			
			// Add new Page Image
			
			if ($_FILES['banner_image']['name'])
				{	
			    $error_view_url = 'admin/user/edit_user';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/pages/','2048','2500','1500','banner_image',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("banner_image"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_wedding', $upd_data);
				}
				}
				
				
			for($k=1;$k<=3;$k++){
			if ($_FILES['page_image'.$k]['name'])
				{	
             $error_view_url = 'admin/user/add_user';			
			 $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/pages/','2048','2500','1500','page_image'.$k,$error_view_url);
				
					if($FileName!=""){
					$upd_data = array("page_image".$k=>$FileName);
					$this->db->where('id', $Page_id);
					$this->db->update('bh_wedding', $upd_data);
					}
				}
				} 
			$this->session->set_flashdata('success',"Page is Added Successfully");
			redirect(BASE_URL.'admin/wedding');
			}
			
			
		
			}
		  else{
		   $this->load->view('admin/wedding/add');
		 }
		
		
	}
	
	public function edit($id)
	{
		$data['WeddingData'] =  $this->content_model->GetWeddingByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/wedding'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	       $config = array( 	           
			array('field' => 'page_title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			array('field' => 'page_heading','label' => 'Page Heading','rules' => 'trim|required|xss_clean'),
			array('field' => 'meta_title','label' => 'Meta Title','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'status','label' => 'Meta Keywords','rules' => 'trim|required|xss_clean')
		    );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/wedding/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'page_title' => $this->input->post('page_title'),
			'page_heading' => $this->input->post('page_heading'),
			'page_short_description' => $this->input->post('page_short_description'),
			'page_description' => $this->input->post('page_description'),
			
			'heading_title' => $this->input->post('heading_title'),
			'heading_description' => $this->input->post('heading_description'),
			'read_more_text' => $this->input->post('read_more_text'),
			'read_more_link' => $this->input->post('read_more_link'),
			
			'meta_title' => $this->input->post('meta_title'),
			'meta_description' => $this->input->post('meta_description'),
			'meta_keywords' => $this->input->post('meta_keywords'),
			'updated_date' => date("Y-m-d h:i:s"),
			
			'status' => $this->input->post('status')
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('bh_wedding', $upd_data);
			
			// edit page image
			if ($_FILES['banner_image']['name'])
				{	
			    $error_view_url = 'admin/user/edit_user';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/pages/','2048','2500','1500','banner_image',$error_view_url);
				if($FileName!=''){
					
				$editdata  =  $this->content_model->GetWeddingByID($id);
				$old_image_path = $this->image->GetImageDirectory('pages',$editdata[0]['banner_image']);
				@unlink($old_image_path.'/'.$editdata[0]['banner_image']);
				
				$upd_data = array("banner_image"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_wedding', $upd_data);
				}
				}
				
			// Add new Page Image
			for($k=1;$k<=3;$k++){
			if ($_FILES['page_image'.$k]['name'])
				{	
                	
				$error_view_url = 'admin/user/add_user';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/pages/','2048','1024','768','page_image'.$k,$error_view_url);

		
				
				
				if($FileName!=''){
					
				$editdata  =  $this->content_model->GetWeddingByID($id);
				$old_image_path = $this->image->GetImageDirectory('pages',$editdata[0]['page_image'.$k]);
				@unlink($old_image_path.'/'.$editdata[0]['page_image'.$k]);
				
				$upd_data = array("page_image".$k=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_wedding', $upd_data);
				}
				}
				} 
			
			
			$this->session->set_flashdata('success',"Wedding is Updated Successfully.");
			redirect(BASE_URL.'admin/wedding');
			}
		 }
		 
		$this->load->view('admin/wedding/edit',$data);
		
		
	}
	
	
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_wedding");
		$this->session->set_flashdata('success',"Wedding is  Deleted Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/wedding');
	}
	
	

	
}
