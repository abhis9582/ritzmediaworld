<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payu extends CI_Controller {
	
	
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
    // $this->login->check_login();	 
     $this->load->model('content_model');   
     $this->load->model('listing_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function success()
{
    //print_r($_REQUEST);

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
		
		
        $need_id = ($this->input->post('need_id'))?$this->input->post('need_id'):'';
		 $query = $this->db->query("SELECT * FROM `bh_users` WHERE `email_id` = '".$email."'");
		 $userdata = $query->row_array();
		 
		if($this->session->userdata('bh_front_user_id')!=""){
		 $user_id = $this->session->userdata('bh_front_user_id');
		}else if($userdata["user_id"]!=""){
			$user_id = $userdata["user_id"];
		}else{
			
			$user_id = 0;
		}

   

		if($need_id!=""){

		$payment_to = 'Needy';

		}else{
		$payment_to = 'Admin';	
		}

       // Add data payment table
	   
	  
	   $bhalaai_points = $this->commonmod_model->GetBhalaaiPointByCateId($this->input->post('category_id'));
	   
	   if($payment_to=='Admin'){ $bhalaai_points = ""; } 
	   
		$insertdata = array("user_id"=>$user_id,"need_id"=>$need_id,"amount"=>$amount,"email_id"=>$email,"transaction_id"=>$txnid,"payment_to"=>$payment_to,"bhalaai_points"=> $bhalaai_points,"add_date"=>date("Y-m-d h:i:s"));
		
		$this->db->insert("bh_payments",$insertdata);

        $SALT ="Your salt";


        If (isset($_POST["additionalCharges"])) 
        {
            $additionalCharges=$_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }else{
            $retHashSeq = $SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }

        $rethash = hash("sha512", $retHashSeq);


        if ($rethash != $hash)
        {
            $this->session->set_flashdata('error',"You have done successfully payments");
			$this->load->view('front/payu/success',$data);
        }

       // now begin your custome code if a transaction is success 

    }
}

public function fail()
{
    //print_r($_REQUEST);

    $status= $this->input->post('status');

    if($status =='cancel')
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



        $SALT ="Your salt";


        If (isset($_POST["additionalCharges"])) 
        {
            $additionalCharges=$_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }else{
            $retHashSeq = $SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }

        $rethash = hash("sha512", $retHashSeq);


        if ($rethash != $hash)
        {
            
             $this->session->set_flashdata('error',"Invalid Transaction . Error Occured");
			$this->load->view('front/payu/fail',$data);
        }

       // now begin your custome code if a transaction is success 

    }
}

public function cancel()
{
    //print_r($_REQUEST);

    $status= $this->input->post('status');

    if($status =='cancel')
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



        $SALT ="Your salt";


        If (isset($_POST["additionalCharges"])) 
        {
            $additionalCharges=$_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }else{
            $retHashSeq = $SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }

        $rethash = hash("sha512", $retHashSeq);


        if ($rethash != $hash)
        {
            $this->session->set_flashdata('error',"You have cancel payments");
			$this->load->view('front/payu/cancel',$data);
        }

       // now begin your custome code if a transaction is success 

    }
}

	
}
