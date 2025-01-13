<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	
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
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		
		$data['ALL_USER_DATA'] =  $this->user_model->getALLUser();
		$this->load->view('admin/user/users',$data);
	}
	
	public function search($user_type)
	{
		$data['user_type'] =  $user_type;
		$data['ALL_USER_DATA'] =  $this->user_model->getALLUserByType($user_type);
		$this->load->view('admin/user/users',$data);
	}
	
	
	public function add_user()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'first_name','label' => 'First Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'last_name','label' => 'Last Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email_id','label' => 'Email Id','rules' => 'trim|required|xss_clean'),
			array('field' => 'password','label' => 'Password','rules' => 'trim|required|xss_clean')
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/user/add-user'); 
			
			}
			else{
				
				$email = $this->input->post('email_id');
			$query = $this->db->get_where('bh_users', array('email_id' => $email));
			if ($query->num_rows() > 0) {
 		    
			   $this->session->set_flashdata('error',"Email already exists");
	          $this->load->view('admin/user/add-user');
			} 
			
			else{
				
				
			// Add new User Details
			$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_id' => $this->input->post('email_id'),
			'password' => md5($this->input->post('password')),
			'phone' => $this->input->post('phone'),
			'mobile' => $this->input->post('mobile'),
			'address' => $this->input->post('address'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'user_type' => $this->input->post('user_type'),
			'status' => $this->input->post('status')

			
			);  		

			$this->db->insert('bh_users', $data);
			$User_id = $this->db->insert_id();
			
			// Add new Page Image
			if ($_FILES['user_image1']['name'])
				{	
                	
				$config="";	
				$config['upload_path'] = './webroot/images/original/';
				$config['allowed_types'] = '*';
				$config['max_size']	= '2048';
				$config['max_width']  = '300';
				$config['max_height']  = '300';
				$config['encrypt_name'] = true;
				$this->load->library('upload', $config);		
				$this->upload->initialize($config);	
				$error=''; 		
				if ( ! $this->upload->do_upload('user_image1'))
				{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin/user/add-user',$data); 
				
				$image="";
				$ImageID="";
				}
				else
				{
				$data_upload_files = $this->upload->data();				
				 $image = $data_upload_files["file_name"]; 
				 $OriginalImageName=$data_upload_files["orig_name"];				
				$ImageWidth=$data_upload_files["image_width"];
				$ImageHeight=$data_upload_files["image_height"];

				////////////Getting New Image Name//////////////////////				
				 $GUID=$this->image->getGUID();				
				 $NewImageName=$this->image->CreateImageFilename($GUID,$ImageWidth,$ImageHeight);

				
				
				$destinationimgae='./webroot/images/users/'.$NewImageName.$data_upload_files["file_ext"];

				/////////copy image at original desitnation/////////////////////
				$this->image->CreateImage('./webroot/images/original/'.$image,$destinationimgae);			
				$FileName=$NewImageName.$data_upload_files["file_ext"];
				
				$upd_data = array("user_image1"=>$FileName);
				  $this->db->where('user_id', $User_id);
			      $this->db->update('bh_users', $upd_data);
				}
				
			}
			
			
			$this->session->set_flashdata('success',"User is created successfully");
			redirect(BASE_URL.'admin/manage-users');
			}
			}
		 }else{
		$this->load->view('admin/user/add-user');
		 }
		
		
	}
		public function changeIdproofstatus($user_id,$val)
	{
		$val =1;
		$data = array('idproof_check' => $val);
			$this->db->where('user_id',$user_id);      
			$this->db->update('bh_users',$data);
			redirect(BASE_URL.'admin/view-user/'.$user_id);
			
	}
	

	public function edit_user($User_ID)
	{
		$data['USER_DATA'] =  $this->user_model->UserByID($User_ID);
		   if($User_ID==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/manage-users'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'first_name','label' => 'First Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'last_name','label' => 'Last Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email_id','label' => 'Email Id','rules' => 'trim|required|xss_clean')
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/user/edit-user',$data); 
			
			}
			else{
				$user_id = $this->input->post('user_id');
			// Edit new User Details
			$upd_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_id' => $this->input->post('email_id'),
			
			'phone' => $this->input->post('phone'),
			'mobile' => $this->input->post('mobile'),
			'address' => $this->input->post('address'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'user_type' => $this->input->post('user_type'),
			'status' => $this->input->post('status'),
			'set_home' => $this->input->post('set_home')

			);  		
          if($user_id!=""){
			$this->db->where('user_id', $user_id); 
			$this->db->update('bh_users', $upd_data);
		  }
		  if($this->input->post('password')!=""){
		  $updata2= array('password' => md5($this->input->post('password')));
		  $this->db->where('user_id', $user_id); 
			$this->db->update('bh_users', $updata2);
		  }
			
			$this->session->set_flashdata('success',"User updated");
		  
		  
		  // edit blog Image
			
			if ($_FILES['user_image1']['name'])
				{	
                	
				$config="";	
				$config['upload_path'] = './webroot/images/original/';
				$config['allowed_types'] = '*';
				$config['max_size']	= '2048';
				$config['max_width']  = '300';
				$config['max_height']  = '300';
				$config['encrypt_name'] = true;
				$this->load->library('upload', $config);		
				$this->upload->initialize($config);	
				$error=''; 		
				if ( ! $this->upload->do_upload('user_image1'))
				{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin/user/edit-user',$data); 
				
				$image="";
				$ImageID="";
				}
				else
				{
				$data_upload_files = $this->upload->data();				
				 $image = $data_upload_files["file_name"]; 
				 $OriginalImageName=$data_upload_files["orig_name"];				
				$ImageWidth=$data_upload_files["image_width"];
				$ImageHeight=$data_upload_files["image_height"];

				////////////Getting New Image Name//////////////////////				
				 $GUID=$this->image->getGUID();				
				 $NewImageName=$this->image->CreateImageFilename($GUID,$ImageWidth,$ImageHeight);

				// delete image from folder
				$editdata  =  $this->user_model->UserByID($User_ID);
				$old_image_path = $this->image->GetImageDirectory('users',$editdata[0]['user_image1']);
				@unlink($old_image_path.'/'.$editdata[0]['user_image1']);
				// end

				
				
				$destinationimgae='./webroot/images/users/'.$NewImageName.$data_upload_files["file_ext"];

				/////////copy image at original desitnation/////////////////////
				$this->image->CreateImage('./webroot/images/original/'.$image,$destinationimgae);			
				$FileName=$NewImageName.$data_upload_files["file_ext"];
				
				$upd_data = array("user_image1" =>$FileName);
				  $this->db->where('user_id', $user_id);
			      $this->db->update('bh_users', $upd_data);
				}
				 
			}
			
			
			redirect(BASE_URL.'admin/manage-users');
			}
		 }else{
		$this->load->view('admin/user/edit-user',$data);
		 }
		
		
	}
	
	public function view_user($User_ID)
	{
		$data['USER_DATA'] =  $this->user_model->UserByID($User_ID);
		   if($User_ID==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/manage-users'); 
			}
	
		
			$this->load->view('admin/user/view-user',$data); 
		
		
	}
	
	public function show_state()
	{
	 $html = "";
	  $Country_id = $this->input->post('countryval');
	  $current_id = $this->input->post('current_id');
		$this->db->select("*");
		$this->db->from('states');	
        $this->db->where("country_id",$Country_id);		
		$this->db->order_by("name","asc");
		
		$query=$this->db->get();
		$all_data =  $query->result_array(); 
       
		if(count($all_data) > 0){
$html = '<option>Select State</option>';			
       foreach($all_data as $singleData){
				//$url = $this->create_url($singleData['Title']);
				if($current_id==$singleData['id']){ $class= 'selected'; } else{  $class= '';  }
			$html .='<option value="'.$singleData['id'].'" '.$class.'>'.$singleData['name'].'</option>';
	
		
		}
		}
		
		

	
	echo json_encode($html);
	}
	
	
	public function show_city()
	{
		$html = "";
		$state_id = $this->input->post('state');
		 $current_id = $this->input->post('current_id');
		$this->db->select("*");
		$this->db->from('cities');	
		$this->db->where("state_id",$state_id);		
		$this->db->order_by("name","asc");

		$query=$this->db->get();
		$all_data =  $query->result_array(); 

		if(count($all_data) > 0){
		$html = '<option>Select City</option>';			
		foreach($all_data as $singleData){
		//$url = $this->create_url($singleData['Title']);
		if($current_id==$singleData['id']){ $class= 'selected'; } else{  $class= '';  }
		$html .='<option value="'.$singleData['id'].'" '.$class.'>'.$singleData['name'].'</option>';


		}
		}

		echo json_encode($html);
	
	}
	
	public function delete_user($user_id){
		if($user_id!=''){
		$this->db->where("user_id",$user_id);
		$this->db->delete("bh_users");
		$this->session->set_flashdata('success',"User Deleted");
			
		
		}
		redirect(BASE_URL.'admin/manage-users');
	}
	
	public function sethomepage($id){ 
		if($id!=""){
		
		 $this->user_model->setHomePage("set",$id);
		}
		 $this->session->set_flashdata('success',"User Id:".$id." is set as Volyunteer Page.");
		 redirect(BASE_URL.'admin/manage-users');
	}

	
}
