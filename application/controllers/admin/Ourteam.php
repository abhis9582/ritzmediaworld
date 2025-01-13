<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ourteam extends CI_Controller {
	
	
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
     $this->load->database();   
	}

	
	public function index()
	{
		$data['OurTeam'] =  $this->gallery_model->getALLourTeam();
		$this->load->view('admin/ourteam/index',$data);
	}
	
	public function add()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
			array('field' => 'category_id','label' => 'Category','rules' => 'trim|required|xss_clean'),
			array('field' => 'image_tittle','label' => 'image Tittle','rules' => 'trim|required|xss_clean'),
			array('field' => 'banner_description','label' => 'Banner Description','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
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
			'category_id' => $this->input->post('category_id'),
			'image_tittle' => $this->security->xss_clean($this->input->post('image_tittle')),
			
			'banner_description' => $this->security->xss_clean($this->input->post('banner_description')),
			
			'status' => $this->security->xss_clean($this->input->post('status'))
             );  		

			$this->db->insert('bh_ourteam', $data);
			$insert_id = $this->db->insert_id();
			// Add new Page Image
			if ($_FILES['image_name']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
		$FileName =  $this->commonmod_model->uploadCommonFile
		('./webroot/images/original/','./webroot/images/gallery/','3048','1800','800','image_name',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("image_name"=>$FileName);
				  $this->db->where('id', $insert_id);
			      $this->db->update('bh_ourteam', $upd_data);
				}
				}
			
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Image Added");
			redirect(BASE_URL.'admin/ourteam');
			}
		 }
		$this->load->view('admin/ourteam/add');
		
		
	}
	
	public function edit($id)
	{
		$data['ClientsData'] =  $this->gallery_model->getALLourTeamID($id);
		   if($id==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/ourteam'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	      $config = array( 	

array('field' => 'category_id','label' => 'Category','rules' => 'trim|required|xss_clean'),		  
			array('field' => 'image_tittle','label' => 'image Tittle','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'banner_description','label' => 'Banner Description','rules' => 'trim|required|xss_clean'),
			
			array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean')
		     );
			
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/ourteam/edit',$data); 
			
			}
			else{
			// Edit new User Details
			$upd_data = array(
			'category_id' => $this->security->xss_clean($this->input->post('category_id')),
			'image_tittle' => $this->security->xss_clean($this->input->post('image_tittle')),
			'banner_description' => $this->security->xss_clean($this->input->post('banner_description')),
			'status' => $this->security->xss_clean($this->input->post('status'))
             );  	
			
            $this->db->where('id', $id);
			$this->db->update('bh_ourteam', $upd_data);
			
			// edit blog Image
			if ($_FILES['image_name']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
			    $FileName =  $this->commonmod_model->uploadCommonFile
				('./webroot/images/original/','./webroot/images/gallery/','3048','1800','800','image_name',$error_view_url);
				if($FileName!=''){
					// delete image from folder
$editdata  = $this->gallery_model->GetImageByID($id);
$old_image_path = $this->image->GetImageDirectory('gallery',$editdata[0]['image_name']);
@unlink($old_image_path.'/'.$editdata[0]['image_name']);
// end

					
				  $upd_data = array("image_name"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_ourteam', $upd_data);
				}
				}
			
			
			$this->session->set_flashdata('success',"Image Updated");
			redirect(BASE_URL.'admin/ourteam');
			}
		 }
		$this->load->view('admin/ourteam/edit',$data);
		
		
	}
	
public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_ourteam");
		$this->session->set_flashdata('success',"Image Deleted");
			
		
		}
		redirect(BASE_URL.'admin/ourteam');
	}	

	
}
