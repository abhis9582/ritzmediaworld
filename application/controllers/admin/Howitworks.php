<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Howitworks extends CI_Controller {
	
	
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
     $this->load->model('howitworks_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		$data['Blogs'] =  $this->howitworks_model->getALLHowItworks();
		$this->load->view('admin/howitworks/index',$data);
	}
	
	public function category($id)
	{
		$data['category_id'] =  $id;
		$data['Blogs'] =  $this->howitworks_model->getALLHowItworksBycategoryId($id);
		$this->load->view('admin/howitworks/index',$data);
	}
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
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
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/blogs/','2048','300','300','howitworks_image1',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("howitworks_image1"=>$FileName);
				  $this->db->where('id', $insert_id);
			      $this->db->update('bh_howitworks', $upd_data);
				}
				} 
			}
			
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"FAQ Added");
			redirect(BASE_URL.'admin/howitworks');
			}
		 }else{
		$this->load->view('admin/howitworks/add');
		 }
		
		
	}
	
	public function edit($id)
	{
		$data['BlogsData'] =  $this->howitworks_model->GetHowitworksByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/howitworks'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
			array('field' => 'title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
		    );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/howitworks/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'category_id' => $this->input->post('category_id'),
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'youtube_video' => $this->input->post('youtube_video'),
			
			'updated_date' => date("Y-m-d h:i:s"),
			
			'status' => $this->input->post('status')
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('bh_howitworks', $upd_data);
			
			// edit blog Image
			for($k=1;$k<=1;$k++){
			if ($_FILES['howitworks_image'.$k]['name'])
				{	
                	
				   $error_view_url = 'admin/user/edit';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/blogs/','2048','300','300','howitworks_image1',$error_view_url);
				if($FileName!=''){
					// delete image from folder
$editdata  = $this->howitworks_model->GetHowitworksByID($id);
$old_image_path = $this->image->GetImageDirectory('blogs',$editdata[0]['howitworks_image1']);
@unlink($old_image_path.'/'.$editdata[0]['howitworks_image1']);
// end

				$upd_data = array("howitworks_image".$k=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_howitworks', $upd_data);
				
				
				}
				} 
			}
			
			
			$this->session->set_flashdata('success',"FAQ Updated");
			redirect(BASE_URL.'admin/howitworks');
			}
		 }else{
		$this->load->view('admin/howitworks/edit',$data);
		 }
		
		
	}
	
	
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_howitworks");
		$this->session->set_flashdata('success',"How It Works Deleted");
			
		
		}
		redirect(BASE_URL.'admin/howitworks');
	}
	
	

	
}
