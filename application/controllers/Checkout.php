<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	
	function __construct(){
		
	 parent::__construct();
	$this->load->library('form_validation');	
   $this->load->helper(array('form', 'url')); 	 
   $this->load->helper('cookie');
   //
  
    $this->load->library('session'); 
    $this->load->helper('common');
    $this->load->helper('security');
    $this->load->library('email'); 
	$this->load->library('encryption');
  // Custom Ours
   $this->load->library('cart');
     $this->load->library('login');   
    // $this->login->check_login();	 
     $this->load->model('blog_model');   
     $this->load->model('gallery_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->model('order_model');   
     $this->load->model('listing_model');   
     $this->load->model('content_model');   
     $this->load->model('checkout_model');   
     $this->load->database();   
	}

	
	public function test($number){
		$first = 0;
		$second = 1;
		echo $first." ".$second ." ";
		for($i=2;$i< $number;$i++){
		$third = $first + $second;
		echo $third ." ";
		$first = $second;
		$second = $third;
		
		}
	
	}
	
	public function test2($a,$b){
		$a = $a+$b;
		$b= $a-$b;
		$a = $a-$b;
		echo $a ." ".$b;
		}
		
	public function reverse($num){	

		$revnum = 0;
		while ($num != 0)
		{
		$revnum = $revnum * 10 + $num % 10;
		//below cast is essential to round remainder towards zero
		$num = (int)($num / 10); 
		}

		echo "Reverse Number: $revnum";
	}
	
	public function showalltrinagle(){
		for($i=0;$i<=5;$i++){
			for($j=0;$j<=$i;$j++){
				echo '* ';
			}
			echo '<br>';
		}
		
		for($i=0;$i<=5;$i++){
			for($j= 5-$i;$j>=1;$j--){
				echo '* ';
			}
			echo '<br>';
		}
	}



	
	public function index()
	{	
		
		  	if (count($this->cart->contents()) == 0){
			
				redirect(BASE_URL.'cart');
			}
			
		if(@$_GET['checkout']=='guest' || $this->input->post('checkout') == 'YES'){
			$this->session->unset_userdata('checkout_cart');
			$this->session->set_userdata('guest_login','YES');
			}	
		else if($this->session->userdata('bh_front_user_id')==""){
			$this->session->set_userdata('checkout_cart','YES');
		    redirect(BASE_URL.'login');
		}else {
		$this->session->unset_userdata('checkout_cart');
		}
		
		
		
		$data['title'] = 'Checkout';
		$data['BillingAddress']  =  $this->checkout_model->GetUserAddress('Billing');
		$data['ShippingAddress']  =  $this->checkout_model->GetUserAddress('Shipping');
		
		

		if (!$this->cart->contents()){
			$data['message'] = '<p>Your cart is empty!</p>';
		}else{
			$data['message'] = $this->session->flashdata('message');
		}
 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'b_firstname','label' => 'Billing First Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_lastname','label' => 'Billing Last Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_country_id','label' => 'Billing Country','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_state_id','label' => 'Billing State','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_city','label' => 'Billing City','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_address_1','label' => 'Billing Address 1','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_address_2','label' => 'Billing Address 2','rules' => 'trim|required|xss_clean'),
			array('field' => 'b_postcode','label' => 'Billing Postcode','rules' => 'trim|required|xss_clean'),
			
			array('field' => 's_firstname','label' => 'Shipping First Name','rules' => 'trim|required|xss_clean'),
			array('field' => 's_lastname','label' => 'Shipping Last Name','rules' => 'trim|required|xss_clean'),
			array('field' => 's_country_id','label' => 'Shipping Country','rules' => 'trim|required|xss_clean'),
			array('field' => 's_state_id','label' => 'Shipping State','rules' => 'trim|required|xss_clean'),
			array('field' => 's_city','label' => 'Shipping City','rules' => 'trim|required|xss_clean'),
			array('field' => 's_address_1','label' => 'Shipping Address 1','rules' => 'trim|required|xss_clean'),
			array('field' => 's_address_2','label' => 'Shipping Address 2','rules' => 'trim|required|xss_clean'),
			array('field' => 's_postcode','label' => 'Shipping Postcode','rules' => 'trim|required|xss_clean'),
			array('field' => 'payment_method','label' => 'Payment Method','rules' => 'trim|required|xss_clean')
			
			
			);
			
			if($this->input->post('checkout') == 'YES'){
			$this->form_validation->set_rules('email_id1', 'Email Id', 'required|trim|xss_clean|is_unique[bh_users.email_id]');
			}
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/checkout/index',$data);
			
			}
			else{
			// Add new User Details
			 if($this->input->post('payment_method')=='payumoney'){
				 if($this->session->userdata('guest_login')=='YES'){
				   $this->GuestLogin();
				 }
			        redirect(BASE_URL.'payumoney/confirm_payment');
				 
			 } else if($this->input->post('payment_method')=='cod'){
				 if($this->session->userdata('guest_login')=='YES'){
				   $this->GuestLogin();
				 }
					$this->checkout_model->SubmitOrder();
					$this->session->set_flashdata('error',"Your order has been placed successfully.");
					$this->cart->destroy();
					redirect(BASE_URL.'checkout/success');
			 }
			
			
			 		

			
			
					
			
			}
		 
		 }else{
		$this->load->view('front/checkout/index', $data);
		 }
	}

	function GuestLogin(){
	$data['Content'] =  array();
		
		
		  if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	     
			$email = $this->input->post('email_id1');
			$query = $this->db->get_where('bh_users', array('email_id' => $email));
			if ($query->num_rows() > 0) {
 		    
			   $this->session->set_flashdata('error',"Email ID already exists");
	           redirect(BASE_URL.'checkout?checkout=guest');
			} 
			
			else{
				$verify_key = mt_rand(100000, 999999);
				$pass = mt_rand(100000, 999999);
			// Add new User Details
			$data = array(
		     'first_name' 	=> $this->security->xss_clean($this->input->post('b_firstname')),
			'last_name' 	=> $this->security->xss_clean($this->input->post('b_lastname')),
			'email_id' 	=> $this->security->xss_clean($this->input->post('email_id1')),
			'password' => md5($pass),
			'verify_key' => $verify_key,
			'status' => '2'

			
			);  		

			$this->db->insert('bh_users', $data);
			$User_id = $this->db->insert_id();
			
			$data1 = array(
			'firstname' => $this->security->xss_clean($this->input->post('b_firstname')),
			'lastname' => $this->security->xss_clean($this->input->post('b_lastname')),
			'address_1' => $this->security->xss_clean($this->input->post('b_address_1')),
			'address_2' => $this->security->xss_clean($this->input->post('b_address_2')),
			'postcode' => $this->security->xss_clean($this->input->post('b_postcode')),
			'country_id' => $this->security->xss_clean($this->input->post('b_country_id')),
			'state_id' => $this->security->xss_clean($this->input->post('b_state_id')),
			'city' => $this->security->xss_clean($this->input->post('b_city')),
			'address_type' => 'Billing',
			
			'user_id' => $User_id,
			

			
			);  		

			$this->db->insert('bh_address', $data1);
			$data2 = array(
			'firstname' => $this->security->xss_clean($this->input->post('b_firstname')),
			'lastname' => $this->security->xss_clean($this->input->post('b_lastname')),
			'address_1' => $this->security->xss_clean($this->input->post('b_address_1')),
			'address_2' => $this->security->xss_clean($this->input->post('b_address_2')),
			'postcode' => $this->security->xss_clean($this->input->post('b_postcode')),
			'country_id' => $this->security->xss_clean($this->input->post('b_country_id')),
			'state_id' => $this->security->xss_clean($this->input->post('b_state_id')),
			'city' => $this->security->xss_clean($this->input->post('b_city')),
			'address_type' => 'Shipping',
			
			'user_id' => $User_id,
			);  		

			$this->db->insert('bh_address', $data2);
			$address_id = $this->db->insert_id();
			
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
				$message .= '<p>'.$this->security->xss_clean($this->input->post('b_firstname')).' have registered with Us.</p>';
				$message .= '<p>Name: '.trim($this->security->xss_clean($this->input->post('b_firstname'))).' '.trim($this->security->xss_clean($this->input->post('b_last_name'))).'</p>';
				$message .= '<p>Email: '.trim($this->security->xss_clean($this->input->post('email_id1'))).'</p>';
				$message .= '<p>Address: '.trim($this->security->xss_clean($this->input->post('b_address'))).'</p>';
				$message .= '<p>Country: '.trim($this->commonmod_model->GetCountryName($this->input->post('b_country'))).'</p>';
				$message .= '<p>State: '.trim($this->commonmod_model->GetStateName($this->input->post('b_state'))).'</p>';
				$message .= '<p>City: '.trim($this->commonmod_model->GetCityName($this->input->post('b_city'))).'</p>';

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email_id1');
		  
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
				$message .= '<p>Hi '.trim($this->security->xss_clean($this->input->post('b_first_name'))).' you have successfully created your account, <br> Please <a href="'.BASE_URL.'user/verify/'.$User_id.'/'.$verify_key.'">Click here</a> to activate your account <br> '.BASE_URL.'user/verify/'.$User_id.'/'.$verify_key.'</p>';
				
				$message .= '<p>Web URL:  <a href="'.BASE_URL.'login">'.BASE_URL.'login</a></p>';
				$message .= '<p>Email ID:  '.$this->input->post('email_id1').'</p>';
				$message .= '<p>Password:  '.$pass.'</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
			   
			    $this->login->process_front_guest_login($this->input->post('email_id1'), $pass);
				
			}
		 }else{
		$this->load->view('front/checkout/index', $data);
		 }
		
		
	
			
	}

	function success_payathotel(){
		$data['Content'] =  $this->content_model->GetContentByID(15);
 		$data['mobileno'] =  $this->commonmod_model->getSystemValue('mobile_number');
		$this->load->view('front/checkout/success_payathotel',$data);
	}
	function success(){
		$data['Content'] =  $this->content_model->GetContentByID(15);
 		$data['mobileno'] =  $this->commonmod_model->getSystemValue('mobile_number');
		$this->load->view('front/checkout/success',$data);
	}	
	function fail(){
 		$data['Content'] =  $this->content_model->GetContentByID(15);
		$this->load->view('front/checkout/fail',$data);
	}	
}