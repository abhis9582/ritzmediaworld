<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	
	function __construct(){
		
	 parent::__construct();
	$this->load->library('form_validation');	
    $this->load->helper(array('form', 'url')); 	 
    $this->load->helper('cookie');
    $this->load->helper('common');
   //
  
    $this->load->library('session'); 
    $this->load->helper('security');
    $this->load->library('email');
	$this->load->library('encryption');
  // Custom Ours
  
     $this->load->library('login');   
    // $this->login->check_login();	 
     $this->load->model('content_model');   
     $this->load->model('listing_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');
	 $this->load->model('address_model');
	 $this->load->model('order_model');   
     $this->load->database();   
	}

	
	public function index(){
		$data['ALL_USER_DATA'] =  $this->user_model->getALLUser();
		$this->load->view('admin/user/users',$data);
	}
	
	public function login(){
		//$data['ALL_USER_DATA'] =  $this->user_model->getALLUser();
		$data = array();
		$data['Content'] =  $this->content_model->GetContentByID(13);
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
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

		$this->load->view('front/user/login',$data);
		}
        else
        {
            $email = set_value('email_id');
            $password = set_value('password');
			 $email = $this->security->xss_clean($email);
			 $password = $this->security->xss_clean($password);

            $this->db->select("*");			
			$this->db->from('bh_users');	
			$this->db->where(array("email_id"=>$email));
			$query=$this->db->get();
			$datachk=$query->row_array();             			
				
			
            /* check login */
            $this->login->process_front_login($email, $password);
            /* ------ */			
            if ($this->session->userdata('front_logged_in') == '')
				{ 
                // display login error
				 $this->session->set_flashdata('error','Either your email address or password is incorrect. It May be your account is not approved'); 
				
                  $this->load->view('front/user/login',$data);
                //return redirect(SITEURL."register/signin");				
            }
            else
            {	
              	
               if($this->input->post('return_url')!="")
					return redirect($this->input->post('return_url'));
				 else if($this->session->userdata('checkout_cart')=="YES")
					return redirect(BASE_URL."checkout");
				else
					return redirect(BASE_URL."myaccount");
              
            }
			
			 // else password is not blanck 

        }
	 }else{
		$this->load->view('front/user/login',$data);
	 }
	}
	
	public function allrequest(){
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$data['Allrequest'] =  $this->user_model->GetAllRequest($this->session->userdata('bh_front_user_id'));
		$this->load->view('front/user/allrequest',$data);	
	}
	
	public function add_request($id){
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['UserData'] = $UserData =   $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$id = ($this->session->userdata('bh_front_user_id')!="")?$this->session->userdata('bh_front_user_id'):'0';
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){	
	  
        $config = array( 	           
			array('field' => 'first_name','label' => 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'department','label' => 'Department','rules' => 'trim|required|xss_clean'),
			array('field' => 'empid','label' => 'EMP ID','rules' => 'trim|required|xss_clean'),
			array('field' => 'total_rooms','label' => 'Total Rooms','rules' => 'trim|required|xss_clean'),
			array('field' => 'total_peaple','label' => 'Total Peaple','rules' => 'trim|required|xss_clean'),
			array('field' => 'room_type','label' => 'Room Type','rules' => 'trim|required|xss_clean'),
			array('field' => 'start_date','label' => 'Start Date','rules' => 'trim|required|xss_clean'),
			array('field' => 'end_date','label' => 'End Date','rules' => 'trim|required|xss_clean'),
		    array('field' => 'message','label' => 'Message','rules' => 'trim|required|xss_clean')
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/add_request',$data);
			
			}
			else{
			// Add new User Details
			$upddata = array(
			'user_id' => $id,
			'name' => $this->input->post('first_name'),
			'department' => $this->input->post('department'),
			'empid' => $this->input->post('empid'),
			'total_peaple' => $this->input->post('total_peaple'),
			'total_rooms' => $this->input->post('total_rooms'),
			'city' => $this->input->post('city'),
			'hotel_id' => $this->input->post('listing_id'),
			'room_type' => $this->input->post('room_type'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'message' => $this->input->post('message'),
			'status' => 0,
			'add_date' => date("Y-m-d")
			
			
      );  		

			
			$this->db->insert('bh_request', $upddata);
			
			
			$config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);


				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				//$this->email->cc(CC_EMAIL_ID);
				$this->email->bcc($UserData[0]['email_id']);

				$this->email->subject('Corporate Request');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$UserData[0]['first_name'].''.$UserData[0]['last_name'].' have send corporate request.</p>';
				$message .= '<p>Name: '.$this->input->post('first_name').'</p>';
				$message .= '<p>Department: '.$this->input->post('department').'</p>';
				$message .= '<p>EMP ID: '.trim($this->input->post('empid')).'</p>';
				$message .= '<p>Total People: '.trim($this->input->post('total_peaple')).'</p>';
				$message .= '<p>Total Rooms: '.trim($this->input->post('total_rooms')).'</p>';
				$message .= '<p>City: '.get_city_name($this->input->post('city')).'</p>';
				$message .= '<p>Hotel: '.get_hotel_name($this->input->post('listing_id')).'</p>';
				$message .= '<p>Room Type: '.get_hotel_room_category($this->input->post('room_type')).'</p>';
				$message .= '<p>Start Date: '.date("d M, Y",strtotime($this->input->post('start_date'))).'</p>';
				$message .= '<p>End Date: '.date("d M, Y",strtotime($this->input->post('end_date'))).'</p>';
				$message .= '<p>Message: '.trim($this->input->post('message')).'</p>';

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
				
			
				
			$this->session->set_flashdata('error',"Request added");
			redirect(BASE_URL.'user/allrequest');
			}
		 }else{
		$this->load->view('front/user/add_request',$data);
		 }
		
		
	}
	
	public function forgotpassword(){
		//$data['ALL_USER_DATA'] =  $this->user_model->getALLUser();
		$data = array();
		$data['Content'] =  $this->content_model->GetContentByID(18);
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {		
		$config = array(

			array(
			'field' => 'email_id',
			'label' => 'Email Id',
			'rules' => 'trim|required|min_length[5]|xss_clean'
			)
		); 

	    $this->form_validation->set_rules($config);
        
		if ($this->form_validation->run() === FALSE)
		{

		$this->load->view('front/user/forgotpassword',$data);
		}
        else
        {
            $email = $this->security->xss_clean($this->input->post('email_id'));
         
					

            $this->db->select("*");			
			$this->db->from('bh_users');	
			$this->db->where(array("email_id"=>$email));
			$query=$this->db->get();
			$user_data = $query->row_array();             			
			
			if(count($user_data) > 0){
				$reset_pass_key =  mt_rand(100000, 999999);
				$upd_data = array("reset_pass_key"=>$reset_pass_key);
				  $this->db->where('email_id', $email);
			      $this->db->update('bh_users', $upd_data);
				  
				    $User_EmailId = $email;
		  
		        $config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;

				$this->email->initialize($config);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Reset Password |'.WEBSITE_EMAIL_TITLE);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($user_data['first_name']).'  <br> Please <a href="'.BASE_URL.'user/resetpassword/'.$user_data['user_id'].'/'.$reset_pass_key.'">Click here</a> to reset your password <br> '.BASE_URL.'user/resetpassword/'.$user_data['user_id'].'/'.$reset_pass_key.'</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
			
			$this->session->set_flashdata('error',"A reset password email have sent to you, Please check inbox/spam jumk folders.");
			
			redirect(BASE_URL.'login');
			
			
			
			
			}else{
				
			}
            

        }
	 }else{
		$this->load->view('front/user/forgotpassword',$data);
	 }
	}
	
	public function myaccount(){
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$this->load->view('front/user/myaccount',$data);	
	}
	
	public function changepassword(){
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
			$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){	
	 	$config = array( 	           
			array('field' => 'password','label' => 'Password','rules' => 'trim|required|xss_clean|matches[password2]'),
			array('field' => 'password2','label' => 'Confirm Password','rules' => 'trim|required|xss_clean'),
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/change-password',$data);
			
			}
			else{

		
			// Add new User Details
			$updata = array(
			'password' => md5($this->security->xss_clean($this->input->post('password')))
			); 
			 		

			$this->db->where('user_id', $this->session->userdata('bh_front_user_id'));
			$this->db->update('bh_users', $updata);
			$this->session->set_flashdata('error',"Password Changed");
			redirect(BASE_URL.'myaccount');
			}
			
				
			
			}
		 
		 else{
		$this->load->view('front/user/change-password',$data);
		 }
	}

	public function address(){
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$data['AddressListing'] =  $this->address_model->GetUserSupportListing();
		$this->load->view('front/user/address',$data);	
	}

	public function order(){
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$data['AllorderList'] =  $this->order_model->GetsAllorder($this->session->userdata('bh_front_user_id'));
		//$data['AddressListing'] =  $this->order_model->GetOrderListing();
		$this->load->view('front/user/order',$data);	
	}

	public function orderdetail($order_id){
		$this->login->check_front_login();
			
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['AllOrderlist'] = $this->order_model->ShoworderHistory($order_id);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$data['AllorderproductList'] = $this->order_model->GetOrderListing($order_id);
		$data['Oneorder'] =  $this->order_model->GetOneorder($order_id);
		//$data['AddressListing'] =  $this->order_model->GetOrderListing();
		$this->load->view('front/user/orderdetail',$data);	
	}
	
	public function add_address()
	{
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
			$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
			
			 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'firstname','label' => 'First Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'lastname','label' => 'Last Name','rules' => 'trim|required|xss_clean'),
			//array('field' => 'address_1','label' => 'Address1','rules' => 'trim|required|xss_clean'),
			array('field' => 'country_id','label' => 'Country','rules' => 'trim|required|xss_clean'),
			array('field' => 'state_id','label' => 'State','rules' => 'trim|required|xss_clean'),
			array('field' => 'city','label' => 'City','rules' => 'trim|required|xss_clean'),
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/add-address',$data);
			
			}
			else{
			// Add new User Details
			$data = array(
			'firstname' => $this->security->xss_clean($this->input->post('firstname')),
			'lastname' => $this->security->xss_clean($this->input->post('lastname')),
			'country_id' => $this->security->xss_clean($this->input->post('country_id')),
			'state_id' => $this->security->xss_clean($this->input->post('state_id')),
			'city' => $this->security->xss_clean($this->input->post('city')),
			'address_1' => $this->security->xss_clean($this->input->post('address_1')),
			'address_2' => $this->security->xss_clean($this->input->post('address_2')),
			'postcode' => $this->security->xss_clean($this->input->post('postcode')),
			
			'user_id' => $this->session->userdata('bh_front_user_id'),
			
			); 
			 		

			$this->db->insert('bh_address', $data);
			$id = $this->db->insert_id();
			
			
			$this->session->set_flashdata('error',"Address Listing added");
			redirect(BASE_URL.'user/address');
			}
		 }else{
		$this->load->view('front/user/add-address',$data);
		 }
	
	}
	
	public function edit_address($id)
	{
		
		
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['listing'] =  $this->address_model->GetSupportListingById($id);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
			
			 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			//array('field' => 'firstname','label' => 'First Name','rules' => 'trim|required|xss_clean'),
			//array('field' => 'lastname','label' => 'Last Name','rules' => 'trim|required|xss_clean'),
			//array('field' => 'address_1','label' => 'Address1','rules' => 'trim|required|xss_clean'),
			array('field' => 'country_id','label' => 'Country','rules' => 'trim|required|xss_clean'),
			array('field' => 'state_id','label' => 'State','rules' => 'trim|required|xss_clean'),
			array('field' => 'city','label' => 'City','rules' => 'trim|required|xss_clean'),
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/edit-address',$data);
			
			}
			else{
			// Add new User Details
			
			$data = array(
			'firstname' => $this->security->xss_clean($this->input->post('firstname')),
			'lastname' => $this->security->xss_clean($this->input->post('lastname')),
			'country_id' => $this->security->xss_clean($this->input->post('country_id')),
			'state_id' => $this->security->xss_clean($this->input->post('state_id')),
			'city' => $this->security->xss_clean($this->input->post('city')),
			'address_1' => $this->security->xss_clean($this->input->post('address_1')),
			'address_2' => $this->security->xss_clean($this->input->post('address_2')),
			'postcode' => $this->security->xss_clean($this->input->post('postcode')),
			'user_id' => $this->session->userdata('bh_front_user_id'),
			
			
			
			); 
			 		
               $this->db->where("address_id",$id);
		       $this->db->update('bh_address', $data);
			
			$this->session->set_flashdata('error',"Address Listing updated");
			redirect(BASE_URL.'user/address');
			}
		 }else{
		$this->load->view('front/user/edit-address',$data);
		 }
	
	}
	
	public function delete_address($id)
	{
		if($id!=''){
		$this->db->where("address_id",$id);
		$this->db->delete("bh_address");
		$this->session->set_flashdata('error',"Address Deleted");
			
		
		}
		redirect(BASE_URL.'user/address');	
	}
	
	
	
	
	
	
	public function edit_profile($id)
	{
		$this->login->check_front_login();	
		$data['Content'] =  $this->content_model->GetContentByID(15);
			$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
			
		 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	  
        $config = array( 	           
			array('field' => 'first_name','label' => 'First Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'last_name','label' => 'Last Name','rules' => 'trim|required|xss_clean'),
		
		
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/edit-profile',$data);
			
			}
			else{
			// Add new User Details
			$upddata = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
		
			'phone' => $this->input->post('phone'),
			'mobile' => $this->input->post('mobile'),
			
			
      );  		

			$this->db->where('user_id', $id);
			$this->db->update('bh_users', $upddata);
			
			if($this->input->post('password')!=""){
			$updata = array("password"=>md5($this->input->post('password')));
			$this->db->where('user_id', $user_id); 
			$this->db->update('bh_users', $updata);
			}
			
				if ($_FILES['user_image1']['name'])
				{	
						$error_view_url = 'admin/user/edit';			
						$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/users/','2048','400','*','user_image1',$error_view_url);
						if($FileName!=''){
						$upd_data = array("user_image1"=>$FileName);
						$this->db->where('user_id', $id);
						$this->db->update('bh_users', $upd_data);
						}
				}
				
				
				
			
			$this->session->set_flashdata('error',"User Profile updated");
			redirect(BASE_URL.'myaccount');
			}
		 }else{
		$this->load->view('front/user/edit-profile',$data);
		 }
	}
	
	
	public function create_account()
	{
		 
	$data['Content'] =  $this->content_model->GetContentByID(14);
		
		
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

			$this->load->view('front/user/register',$data);
			
			}
			
			$email = $this->input->post('email_id');
			$query = $this->db->get_where('bh_users', array('email_id' => $email));
			if ($query->num_rows() > 0) {
 		    
			   $this->session->set_flashdata('error',"Email already exists");
	           $this->load->view('front/user/register',$data);
			} 
			
			else{
				$verify_key = mt_rand(100000, 999999);
			// Add new User Details
			$data = array(
			'first_name' => $this->security->xss_clean($this->input->post('first_name')),
			'last_name' => $this->security->xss_clean($this->input->post('last_name')),
			'email_id' => $this->security->xss_clean($this->input->post('email_id')),
			'password' => md5($this->input->post('password')),
			'phone' => $this->security->xss_clean($this->input->post('phone')),
			'mobile' => $this->security->xss_clean($this->input->post('mobile')),
			
			'user_type' => 2,
			'verify_key' => $verify_key,
			
			'status' => '2'

			
			);  		

			$this->db->insert('bh_users', $data);
			$User_id = $this->db->insert_id();
			
			
			/*  Send Admin Email  */ 
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;

				$this->email->initialize($config);


				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('New Account Created | '.WEBSITE_EMAIL_TITLE);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$this->security->xss_clean($this->input->post('first_name')).' have registered with Us.</p>';
				$message .= '<p>Name: '.trim($this->security->xss_clean($this->input->post('first_name'))).' '.trim($this->security->xss_clean($this->input->post('last_name'))).'</p>';
				$message .= '<p>Email: '.trim($this->security->xss_clean($this->input->post('email_id'))).'</p>';
				$message .= '<p>Phone: '.trim($this->security->xss_clean($this->input->post('phone'))).'</p>';
				$message .= '<p>Mobile: '.trim($this->security->xss_clean($this->input->post('mobile'))).'</p>';
				$message .= '<p>Address: '.trim($this->security->xss_clean($this->input->post('address'))).'</p>';
				$message .= '<p>Country: '.trim($this->commonmod_model->GetCountryName($this->input->post('country'))).'</p>';
				$message .= '<p>State: '.trim($this->commonmod_model->GetStateName($this->input->post('state'))).'</p>';
				$message .= '<p>City: '.trim($this->commonmod_model->GetCityName($this->input->post('city'))).'</p>';

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email_id');
		  
		        $config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;

				$this->email->initialize($config);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Account is created |'.WEBSITE_EMAIL_TITLE);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->security->xss_clean($this->input->post('name'))).' you have successfully created your account, <br> Please <a href="'.BASE_URL.'user/verify/'.$User_id.'/'.$verify_key.'">Click here</a> to activate your account <br> '.BASE_URL.'user/verify/'.$User_id.'/'.$verify_key.'</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
			
			$this->session->set_flashdata('error',"Your Account is created, Please check your email inbox,spam and approve your account");
			if($this->input->post('return_url')!=""){
					$this->session->set_userdata('front_logged_in', '1');			

					$this->session->set_userdata('bh_front_user_id', $User_id);
					$this->session->set_userdata('bh_front_email_id', $this->input->post('email_id'));
					$this->session->set_userdata('bh_front_username', $this->input->post('first_name'));
					$this->session->set_userdata('bh_front_usertype', "User");
					return redirect($this->input->post('return_url'));
			}
				else
					redirect(BASE_URL.'login');
				
			}
		 }else{
		$this->load->view('front/user/register',$data);
		 }
		
		
	}
	
	
	public function resetpassword($user_id,$reset_pass_key){
		 $data['Content'] =  $this->content_model->GetContentByID(19);
		 $data['user_id'] =  $user_id;
		 $data['reset_pass_key'] =  $reset_pass_key;
		 
		if($user_id!="" && $reset_pass_key!=""){
		  $query = $this->db->query("SELECT * FROM `bh_users` WHERE `user_id` = '".$user_id."' AND `reset_pass_key` = '".$reset_pass_key."'");
 
			$data['UserData'] =  $this->user_model->UserByID($user_id);
    if ($query->num_rows() > 0) {
    
		
		
    } else {
       redirect(BASE_URL);
    } 	
			
		}else{
			redirect(BASE_URL);
			
		}
		
		if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	 $config = array( 	           
			array('field' => 'password','label' => 'Password','rules' => 'trim|required|xss_clean|matches[password2]'),
			array('field' => 'password2','label' => 'Confirm Password','rules' => 'trim|required|xss_clean'),
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/reset-password',$data);
			
			}
			else{

		
			// Add new User Details
			$updata = array('password' => md5($this->input->post('password')),'reset_pass_key' => ''); 
			 		

	   
	   
			$this->db->where('user_id', $user_id);
			$this->db->update('bh_users', $updata);
			$this->session->set_flashdata('error',"Password is Changed Successfully");
			redirect(BASE_URL.'login');
			}
			
				
			
			}
		 
		 else{
		$this->load->view('front/user/reset-password',$data);
		 }
		
	}
	
	
	public function verify($user_id,$verify_key){
		if($user_id!="" && $verify_key!=""){
		
		  $query = $this->db->query("SELECT * FROM `bh_users` WHERE `user_id` = '".$user_id."' AND `verify_key` = '".$verify_key."'");

    if ($query->num_rows() > 0) {
       $data = array("status"=>'1',"verify_key"=>"");
	   $this->db->where("user_id",$user_id);
	   $this->db->update("bh_users",$data);
	   $this->session->set_flashdata('error',"You have successfully approved your account.");
	   redirect(BASE_URL.'login');
    } else {
       redirect(BASE_URL);
    } 	
			
		}else{
			redirect(BASE_URL);
			
		}
		
	}
	
	
	
	public function show_hotel_category(){
		
	$html = "";
		$hotel_id = $this->input->post('hotel_id');
		
		$this->db->select("*");
		$this->db->from('bh_hotel_rooms');	
		$this->db->where("listing_id",$hotel_id);		
		$this->db->order_by("image_title","asc");

		$query=$this->db->get();
		$all_data =  $query->result_array(); 

		if(count($all_data) > 0){
		$html = '<option value="">Select Category</option>';			
		foreach($all_data as $singleData){
		//$url = $this->create_url($singleData['Title']);
		if($hotel_id==$singleData['id']){ $class= 'selected'; } else{  $class= '';  }
		$html .='<option value="'.$singleData['id'].'" '.$class.'>'.$singleData['image_title'].'</option>';


		}
		}

		echo $html;
		
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
		$this->session->set_flashdata('error',"User Deleted");
			
		
		}
		redirect(BASE_URL.'admin/manage-users');
	}
	
	public function logout(){
		$this->session->unset_userdata('front_logged_in');			
		$this->session->unset_userdata('bh_front_user_id');			
		$this->session->unset_userdata('bh_front_email_id');
		$this->session->unset_userdata('bh_front_username');	
		redirect(BASE_URL);

	}
	
	public function addnewsletter(){
	
	$email = $this->security->xss_clean($this->input->post('email'));
	if($email==""){
			echo  '<font style="color:white;">Please Enter Your Email Id.</font>';
			exit();
	}
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // valid address
    }
    else {
        echo  '<font style="color:white;">Please Enter Correct Email Id.</font>';
		exit();
    }
		// check email
		$this->db->select("*");
		$this->db->from('bh_newsletter');	
		$this->db->where("email",$email);		
		$this->db->order_by("id","asc");
		$query=$this->db->get();
		$all_email =  $query->result_array(); 
		if(count($all_email) > 0){
			
			echo  '<font style="color:white;">Email Id Already subscribed.</font>';
			
			
		}else{
			if($email!=""){
			$data = array("email"=>$email);
			$this->db->insert("bh_newsletter",$data);
			
			
		        $config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;

				$this->email->initialize($config);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				//$this->email->cc(CC_EMAIL_ID);
				$this->email->bcc($email);

				$this->email->subject('Newsletter Email |'.WEBSITE_EMAIL_TITLE);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>  A new email id is subscribed as newsletter in website CT Hotel.
				<br>
				Email ID: '.$email.'
				</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
			
			echo  '<font style="color:white;">Email Id is subscribed successfully.</font>';
			}
			
			
		}
		
		
		
	}
	
	

	
}
