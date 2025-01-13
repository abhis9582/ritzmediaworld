<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {
	
	
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
    $this->load->model('testimonial_model');   
    $this->load->model('commonmod_model');   
    $this->load->database();   
	}

	
	public function index()
	{
		$data['Gallery'] =  $this->testimonial_model->getALLTestimonial();
		$this->load->view('admin/testimonial/index',$data);
	}
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
			array('field' => 'member_name','label' => 'Member Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'status','label' => 'Meta Keywords','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/ourteam/add'); 
			
			}
			else{
			
			// Add new User Details
			$data = array(
			'id' => $this->input->post('id'),
			'member_name' => $this->security->xss_clean($this->input->post('member_name')),
			'description' => $this->security->xss_clean($this->input->post('description')),
			'position' => $this->security->xss_clean($this->input->post('position')),
			
			'status' => $this->security->xss_clean($this->input->post('status'))
             );  		

			$this->db->insert('bh_testimonial', $data);
			$insert_id = $this->db->insert_id();
			// Add new Page Image
			if ($_FILES['image_name']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/gallery/','2048','1000','900','image_name',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("image_name"=>$FileName);
				  $this->db->where('id', $insert_id);
			      $this->db->update('bh_testimonial', $upd_data);
				}
				}
			
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Testimonial Added");
			redirect(BASE_URL.'admin/testimonial');
			}
		 }else{
		$this->load->view('admin/testimonial/add');
		 }
		
		
	}
	
	public function edit($id)
	{
		$data['GalleryData'] =  $this->testimonial_model->GetTestimonialByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/testimonial'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	      $config = array( 	           
			array('field' => 'member_name','label' => 'Member Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'status','label' => 'Meta Keywords','rules' => 'trim|required|xss_clean')
		     );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/testimonial/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'description' => $this->security->xss_clean($this->input->post('description')),
			'member_name' => $this->security->xss_clean($this->input->post('member_name')),
			'position' => $this->security->xss_clean($this->input->post('position')),
			
			'status' => $this->security->xss_clean($this->input->post('status'))
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('bh_testimonial', $upd_data);
			
			// edit blog Image
			if ($_FILES['image_name']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
			    $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/gallery/','5048','1000','900','image_name',$error_view_url);
				if($FileName!=''){
					// delete image from folder
$editdata  = $this->testimonial_model->GetTestimonialByID($id);
$old_image_path = $this->image->GetImageDirectory('gallery',$editdata[0]['image_name']);
@unlink($old_image_path.'/'.$editdata[0]['image_name']);
// end

					
				  $upd_data = array("image_name"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_testimonial', $upd_data);
				}
				}
			
			
			$this->session->set_flashdata('success',"Testimonial Updated");
			 redirect(BASE_URL.'admin/testimonial');
			}
		 }else{
		$this->load->view('admin/testimonial/edit',$data);
		 }
		
		
	}
	
public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_testimonial");
		$this->session->set_flashdata('success',"Testimonial Deleted");
			
		
		}
		redirect(BASE_URL.'admin/testimonial');
	}	

	
}
