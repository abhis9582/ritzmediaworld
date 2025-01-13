<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	
	
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
     $this->load->model('gallery_model');   
     $this->load->model('commonmod_model');   
	  $this->load->model('clients_model');  
     $this->load->database();   
	}

	
	public function index()
	{
		$data['Client'] =  $this->clients_model->getALLImage();
		$this->load->view('admin/client/index',$data);
	}
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
			
		
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/client/add'); 
			
			}
			else{
			
			// Add new User Details
			$data = array(
			'id' => $this->input->post('id'),
			'img_type_id' => $this->input->post('img_type_id'),
			'image_tittle' => $this->security->xss_clean($this->input->post('image_tittle')),
			'status' => $this->security->xss_clean($this->input->post('status'))
             );  		

			$this->db->insert('bh_mediabanner', $data);
			$insert_id = $this->db->insert_id();
			// Add new Page Image
			if ($_FILES['image_name']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
		$FileName =  $this->commonmod_model->uploadCommonFile
		('./webroot/images/original/','./webroot/images/gallery/','3048','1800','1000','image_name',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("image_name"=>$FileName);
				  $this->db->where('id', $insert_id);
			      $this->db->update('bh_mediabanner', $upd_data);
				}
				}
			
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Image Added");
			redirect(BASE_URL.'admin/client');
			}
		 }
		$this->load->view('admin/client/add');
		
		
	}
	
	public function edit($id)
	{
		$data['GalleryData'] =  $this->clients_model->GetImageByID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/client'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	      $config = array( 	           
		
		
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
		     );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/client/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'image_tittle' => $this->input->post('image_tittle'),
			
			'banner_description' => $this->input->post('banner_description'),
			'read_more_text' => $this->input->post('read_more_text'),
			'read_more_link' => $this->input->post('read_more_link'),
			'status' => $this->input->post('status')
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('bh_mediabanner', $upd_data);
			
			// edit blog Image
			if ($_FILES['image_name']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
			    $FileName =  $this->commonmod_model->uploadCommonFile
				('./webroot/images/original/','./webroot/images/gallery/','3048','1800','1000','image_name',$error_view_url);
				if($FileName!=''){
					// delete image from folder
$editdata  = $this->clients_model->GetImageByID($id);
$old_image_path = $this->image->GetImageDirectory('gallery',$editdata[0]['image_name']);
@unlink($old_image_path.'/'.$editdata[0]['image_name']);
// end

					
				  $upd_data = array("image_name"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_mediabanner', $upd_data);
				}
				}
			
			
			$this->session->set_flashdata('success',"Image Updated");
			redirect(BASE_URL.'admin/client');
			}
		 }
		$this->load->view('admin/client/edit',$data);
		
		
	}
	
public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_mediabanner");
		$this->session->set_flashdata('success',"Image Deleted");
			
		
		}
		redirect(BASE_URL.'admin/client');
	}	

	
}
