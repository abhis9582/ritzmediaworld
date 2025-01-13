<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payumoney extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
            
       $this->load->library('form_validation');	
		$this->load->helper(array('form', 'url')); 	 
		$this->load->helper('cookie');
		//

		$this->load->library('session'); 
		$this->load->helper('security');
		$this->load->library('email');
		$this->load->library('encryption');
		$this->load->library('payumoney');
		// Custom Ours

		$this->load->library('login');   
		//$this->login->check_login();	
	   $this->load->model('content_model');   
     $this->load->model('listing_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');    
     $this->load->model('checkout_model');    
		$this->load->database();   

    }
    //==========================================================

	public function payment()
	{
		$this->load->library('payumoney');

		$txnid			= $this->payumoney->get_transaction_id();
		$key 			= $this->payumoney->get_key();
		$action_url 	= $this->payumoney->get_action_url();
		$transaction_id = $this->payumoney->get_transaction_id();
		$hash 			= '';

		if( count($_POST) > 0 ){
			
			$firstname	= $this->security->xss_clean($this->input->post('firstname'));
			$email		= $this->security->xss_clean($this->input->post('email'));
			$phone		= $this->security->xss_clean($this->input->post('phone'));
			$amount		= $this->security->xss_clean($this->input->post('amount'));

			$key	= $this->input->post('key');
			$txnid	= $this->input->post('txnid');
			$surl	= $this->input->post('surl');
			$furl	= $this->input->post('furl');
			
			$productinfo = $this->input->post('productinfo');

			$hash 	= $this->payumoney->get_hash($_POST);
	        $action_url 	= $this->payumoney->get_action_url();
			
			$this->session->set_userdata('firstname', $firstname);
			$this->session->set_userdata('email', $email);
			$this->session->set_userdata('phone', $phone);
			$this->session->set_userdata('amount', $amount);
			$this->session->set_userdata('key', $key);
			$this->session->set_userdata('txnid', $txnid);
			$this->session->set_userdata('surl', $surl);
			$this->session->set_userdata('furl', $furl);
			$this->session->set_userdata('productinfo', $productinfo);
			$this->session->set_userdata('hash', $hash);
			$this->session->set_userdata('action_url', $action_url);

			redirect("home/send_payment");
		}

		$data['key'] = $key;
		$data['action_url'] = $action_url;
		$data['transaction_id'] = $transaction_id;
		$data['hash'] = $hash;

		$this->load->view('front/includes/header', $data);
		$this->load->view('front/PayUMoney/payment', $data);
		$this->load->view('front/includes/footer', $data);

	}
	//==========================================================

	public function confirm_payment()
	{

		    $this->load->library('payumoney_lib');
			$Userdata = $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		    $firstname	= $Userdata[0]['first_name'];
			$email		= $Userdata[0]['email_id'];
			$phone		= $Userdata[0]['phone'];
			$amount		= $this->checkout_model->getCartTotalAmount();
			$productinfo = 'Medipro';

			$key	= MERCHANT_KEY;
			$txnid	= $this->payumoney_lib->get_transaction_id();
			$surl	= base_url("payumoney/payment_success");
			$furl	= base_url("payumoney/payment_failed");
			
			$hashdata = ($key."|".$txnid."|".$amount."|".$productinfo."|".$firstname."|".$email."|||||||||||".SALT);
            $hash = strtolower(hash("sha512", $hashdata));


		    $this->session->set_userdata('firstname', $firstname);
			$this->session->set_userdata('email', $email);
			$this->session->set_userdata('phone', $phone);
			$this->session->set_userdata('amount', $amount);
			$this->session->set_userdata('key', $key);
			$this->session->set_userdata('txnid2', $txnid);
			$this->session->set_userdata('surl', $surl);
			$this->session->set_userdata('furl', $furl);
			$this->session->set_userdata('productinfo', 'Medipro');
			$this->session->set_userdata('hash', $hash);
			$this->session->set_userdata('action_url', $this->payumoney_lib->get_action_url());
			


	

		$data['firstname'] = $this->session->userdata('firstname');
		$data['email'] = $this->session->userdata('email');
		$data['phone'] = $this->session->userdata('phone');
		$data['amount'] = $this->session->userdata('amount');
		$data['key'] = $this->session->userdata('key');
		$data['txnid'] = $this->session->userdata('txnid2');
		$data['surl'] = $this->session->userdata('surl');
		$data['furl'] = $this->session->userdata('furl');
		$data['productinfo'] = $this->session->userdata('productinfo');
		$data['need_id'] = '';
		$data['hash'] = $this->session->userdata('hash');
		$data['action_url'] = $this->session->userdata('action_url');
		redirect('payumoney/send_payment');
		//$this->load->view('front/payumoney/send_payment', $data);
	}
	
	public function send_payment()
	{
       $data['Content'] =  $this->content_model->GetContentByID(18);
		$this->load->library('payumoney');
		
		$firstname 	= $this->session->userdata('firstname');
		$email 		= $this->session->userdata('email');
		$phone 		= $this->session->userdata('phone');
		$amount 	= $this->session->userdata('amount');
		$key 		= $this->session->userdata('key');
		$txnid 		= $this->session->userdata('txnid2');
		$surl 		= $this->session->userdata('surl');
		$furl 		= $this->session->userdata('furl');
		$productinfo = $this->session->userdata('productinfo');
		$hash 		= $this->session->userdata('hash');
		$need_id 		= $this->session->userdata('need_id');
		
		$action_url 	= $this->session->userdata('action_url');

		$data['firstname'] = $firstname;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['amount'] = $amount;
		$data['key'] = $key;
		$data['txnid'] = $txnid;
		$data['surl'] = $surl;
		$data['furl'] = $furl;
		$data['productinfo'] = $productinfo;
		$data['need_id'] = $need_id;
		$data['hash'] = $hash;
		$data['action_url'] = $action_url;
		
		$this->load->view('front/payumoney/send_payment', $data);
	}
	//==========================================================

	public function payment_success()
	{
		$this->load->library('payumoney');
		
	
		  $status= $this->input->post('status');

    if($status =='success')
    {
        $txnid = $this->input->post('txnid');
        $amount = $this->input->post('amount');
        $productinfo = $this->input->post('productinfo');
        $firstname = $this->input->post('firstname');
        $hash = $this->input->post('hash');
        $email = $this->input->post('email');
        $udf1 = $this->input->post('udf1');
        $udf2 = $this->input->post('udf2');
        $udf3 = $this->input->post('udf3');
        $udf4 = $this->input->post('udf4');
        $udf5 = $this->input->post('udf5');
        $key = $this->input->post('key');
		
		
      
		 $query = $this->db->query("SELECT * FROM `bh_users` WHERE `email_id` = '".$email."'");
		 $userdata = $query->row_array();
		 
		if($this->session->userdata('bh_front_user_id')!=""){
		 $user_id = $this->session->userdata('bh_front_user_id');
		}else if($userdata["user_id"]!=""){
			$user_id = $userdata["user_id"];
		}else{
			
			$user_id = 0;
		}

   

	      $payment_to = 'Admin';
		 $order_id =  $this->checkout_model->SubmitOrder();
		  
		 
		

	   
		$insertdata = array("user_id"=>$user_id,"order_id"=>$order_id,"amount"=>$amount,"email_id"=>$email,"transaction_id"=>$txnid,"payment_to"=>$payment_to,"add_date"=>date("Y-m-d h:i:s"));
		
		$this->db->insert("bh_payments",$insertdata);

       	$this->session->unset_userdata('firstname');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('phone');
		$this->session->unset_userdata('amount');
		$this->session->unset_userdata('key');
		$this->session->unset_userdata('txnid2');
		$this->session->unset_userdata('surl');
		$this->session->unset_userdata('furl');
		$this->session->unset_userdata('productinfo');
		$this->session->unset_userdata('hash');
		$this->session->unset_userdata('need_id');
		
		$this->session->unset_userdata('action_url');
     $this->cart->destroy();
     $this->session->set_flashdata('error',"You have done successfully payments");
	 $this->load->view('front/payu/success',$data);
        

       // now begin your custome code if a transaction is success 
	   

    }

	}
	//==========================================================

	public function payment_failed()
	{
		$data = array();
		$this->load->library('payumoney');
		
		 echo $status= $this->input->post('status');

    if($status =='cancel' or $status =='failure')
    {
        $txnid = $this->input->post('txnid');
        $amount = $this->input->post('amount');
        $productinfo = $this->input->post('productinfo');
        $firstname = $this->input->post('firstname');
        $hash = $this->input->post('hash');
        $email = $this->input->post('email');
        $udf1 = $this->input->post('udf1');
        $udf2 = $this->input->post('udf2');
        $udf3 = $this->input->post('udf3');
        $udf4 = $this->input->post('udf4');
        $udf5 = $this->input->post('udf5');
        $key = $this->input->post('key');

		$this->session->unset_userdata('firstname');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('phone');
		$this->session->unset_userdata('amount');
		$this->session->unset_userdata('key');
		$this->session->unset_userdata('txnid2');
		$this->session->unset_userdata('surl');
		$this->session->unset_userdata('furl');
		$this->session->unset_userdata('productinfo');
		$this->session->unset_userdata('hash');
		$this->session->unset_userdata('need_id');
	
		$this->session->unset_userdata('action_url');

             $this->cart->destroy();
             $this->session->set_flashdata('error',"Invalid Transaction . Error Occured");
			$this->load->view('front/payu/fail',$data);
			
        
    }

	}
	//==========================================================


}
