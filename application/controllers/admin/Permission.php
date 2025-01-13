<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	
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
   $this->load->model('admin_model');   
   $this->load->model('commonmod_model');   
   $this->load->database();   
	}

	
	public function index()
	{
		$this->login->check_login();
		$this->load->view('admin/admin/index');
	}
	
	public function login()
	{
		
		$config = array(

			array(
			'field' => 'email_id',
			'label' => 'Email Id',
			'rules' => 'trim|required|min_length[5]|xss_clean'
			),
			array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|min_length[5]|md5|xss_clean'
			)
		); 

	    $this->form_validation->set_rules($config);
        
		if ($this->form_validation->run() === FALSE)
		{

		$this->load->view('admin/admin/login');
		}
        else
        {
            $email = set_value('email_id');
            $password = set_value('password');
					

            $this->db->select("*");			
			$this->db->from('bh_admin');	
			$this->db->where(array("email_id"=>$email));
			$query=$this->db->get();
			$datachk=$query->row_array();             			
				
			
            /* check login */
            $this->login->process_login($email, $password);
            /* ------ */			
            if ($this->session->userdata('logged_in') == '')
				{ 
                // display login error
				 $this->session->set_flashdata('error','Either your email address or password is incorrect'); 
				
                  $this->load->view('admin/admin/login');
                //return redirect(SITEURL."register/signin");				
            }
            else
            {	
              	
                if($this->session->userdata('bh_admin_role')=='Admin')
					return redirect(BASE_URL."admin/dashboard");
				
                else return redirect(BASE_URL);
            }
			
			 // else password is not blanck 

        }
		
	}
	
	public function logout(){
		$this->session->unset_userdata('logged_in');			
		$this->session->unset_userdata('bh_admin_role');			
		$this->session->unset_userdata('bh_admin_id');
		$this->session->unset_userdata('bh_admin_email_id');	
		redirect(BASE_URL.'admin/login?msg=login');

	}
	
	public function view_all()
	{
		$data['ALL_ADMIN_DATA'] =  $this->admin_model->getALLAdmin();
		$this->load->view('admin/admin/view-all',$data);
	}
	
	
	public function add_admin()
	{
		 
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
		  array('field' => 'username','label' => 'User Name','rules' => 'is_unique[bh_admin.username]|required|xss_clean'),
		  array('field' => 'email_id','label' => 'Email Id','rules' => 'trim|required|xss_clean|is_unique[bh_admin.email_id]'),
		  array('field' => 'password','label' => 'Password','rules' => 'trim|required|xss_clean'),
	
		  array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean'),
		  array('field' => 'roles','label' => 'Admin Roles','rules' => 'trim|required|xss_clean')
		  );
		  
		  
		  
		        $emailcheck= '';
				$usernamecheck='';
				if($this->input->post('email_id')!=''){
				$emailcheck = $this->commonmod_model->checkField($this->input->post('email_id'),'email_id','bh_admin');
				}

				if($this->input->post('username')!=''){
				 $usernamecheck = $this->commonmod_model->checkField($this->input->post('username'),'username','bh_admin');
				}   

				$error ='';
				if($emailcheck){ $error = "Email Id already exists.<br>";  }
				if($usernamecheck){ $error .= "Username already exists.<br>"; }

				if($emailcheck || $usernamecheck){
				  $this->session->set_flashdata('error',$error);
				  $this->load->view('admin/admin/add-admin'); 
				}else{

                $this->form_validation->set_rules($config);		
				if ($this->form_validation->run() === FALSE)
				{	

				$this->load->view('admin/admin/add-admin'); 

				}
				else{
				// Add new User Details
				$data = array(
				'username' => $this->input->post('username'),
				'email_id' => $this->input->post('email_id'),
				'password' => md5($this->input->post('password')),

				'roles' => $this->input->post('roles'),
				'status' => $this->input->post('status')


				);  		

				$this->db->insert('bh_admin', $data);

				$this->session->set_flashdata('success',"Admin added");
				redirect(BASE_URL.'admin/manage-admin');
				}
				}
		 }
		   else{
		    $this->load->view('admin/admin/add-admin');
		   }
		
		
	}
	
	public function edit_admin($User_ID)
	{
		$data['USER_DATA'] =  $this->admin_model->AdminByID($User_ID);
		   if($User_ID==""){  
		    $this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/manage-admin'); 
			}
	
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
				$emailcheck= '';
				$usernamecheck='';
				if($this->input->post('email_id')!='' && $this->input->post('email_id')!=$data['USER_DATA'][0]['email_id']){
				$emailcheck = $this->commonmod_model->checkField($this->input->post('email_id'),'email_id','bh_admin');
				}

				if($this->input->post('username')!='' && $this->input->post('username')!=$data['USER_DATA'][0]['username']){
				$usernamecheck = $this->commonmod_model->checkField($this->input->post('username'),'username','bh_admin');
				}   

				$error ='';
				if($emailcheck){ $error = "Email Id already exists.<br>";  }
				if($usernamecheck){ $error .= "Username already exists.<br>"; }

				if($emailcheck || $usernamecheck){
				$this->session->set_flashdata('error',$error);
				$this->load->view('admin/admin/edit-admin',$data); 
				}  else{
	
						$config = array( 	           
						array('field' => 'username','label' => 'User Name','rules' => 'trim|required|xss_clean'),
						array('field' => 'email_id','label' => 'Email Id','rules' => 'trim|required|xss_clean'),


						array('field' => 'status','label' => 'Status','rules' => 'trim|required|xss_clean'),
						array('field' => 'roles','label' => 'Roles','rules' => 'trim|required|xss_clean')
						);

						$this->form_validation->set_rules($config);		
						if ($this->form_validation->run() === FALSE)
						{	

						$this->load->view('admin/admin/edit-admin',$data); 

						}
						else{
						$admin_id = $this->input->post('admin_id');
						// Edit new User Details
						$upd_data = array(
						'username' => $this->input->post('username'),
						'email_id' => $this->input->post('email_id'),
						'roles' => $this->input->post('roles'),
						'status' => $this->input->post('status')
						);  		

						if($admin_id!=""){
						$this->db->where('admin_id', $admin_id); 
						$this->db->update('bh_admin', $upd_data);

						//update pass data
						if($this->input->post('password')!=''){
						$pass_data =  array('password'=>md5($this->input->post('password')));
						$this->db->where('admin_id', $admin_id); 
						$this->db->update('bh_admin', $pass_data);
						}

						$this->session->set_flashdata('success',"Admin updated");
						}
						redirect(BASE_URL.'admin/manage-admin');
						}
		 }
		 }
		 
		 else{
		    $this->load->view('admin/admin/edit-admin',$data);
		 }
		
		
	}
	
}
