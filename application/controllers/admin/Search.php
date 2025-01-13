<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	
	
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
    // $this->login->check_login();	 
     $this->load->model('blog_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->model('listing_model');   
     $this->load->model('content_model');   
     $this->load->database();   
	}

	
	public function index()
	{
		
		$this->load->view('front/blogs/index',$data);
	}
	
	public function search_properties($state_id="",$city_id="",$category_id="")
	{
		
		
		$data['state_id'] =  $state_id;
		$data['city_id'] =  $city_id;
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['SupportData'] =  $this->commonmod_model->GetSupportListing($state_id,$city_id,$category_id);
		
		$this->load->view('front/user/search-properties',$data);
	}
	
	
	
	

	
	public function support_detail($id="",$category_id="")
	{
		$data['id'] =  $id;
		$data['category_id'] = $category_id;
			$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['SupportSingleData'] =  $this->commonmod_model->GetSupportListingDetails($id);
		$data['Listing_Images'] =  $this->listing_model->GetSupportListingImagesDetails($id);
		
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		
		$this->load->view('front/user/listing-detail',$data);
		
		
	}
	public function listing_booking($id="",$category_id)
	{
		$data['id'] =  $id;
		$data['category_id'] = $category_id;
			$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['SupportSingleData'] =  $this->commonmod_model->GetSupportListingDetails($id);
		$data['Listing_Images'] =  $this->listing_model->GetSupportListingImagesDetails($id);
		 $data['BookedDate'] =  $this->listing_model->GetBookedDates($id,$category_id);
		
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		
		
		 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'email_id','label' => 'Email Id','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile_number','label' => 'Contact Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'booking_date_from','label' => 'Booking Date From','rules' => 'trim|required|xss_clean'),
			array('field' => 'booking_date_to','label' => 'Booking Date To','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/user/listing-booking',$data);
			
			}
			else{
				$startdate = $this->input->post('booking_date_from');
				$enddate = $this->input->post('booking_date_to');
				$dates_available = $this->commonmod_model->checkBookingDatesIsAvailable($id,$category_id,$startdate,$enddate);

			 if(strtotime($enddate) < strtotime($startdate)){
			  $this->session->set_flashdata('error',"Booking Date From can be greater than Boking Date To");
			 redirect(BASE_URL.'listing-booking/'.$id.'/'.$category_id);
			 exit();
			 
			 }
             if(count($dates_available) > 0){
			 $this->session->set_flashdata('error',"Booking Date ".$startdate." to ".$enddate." is not available.");
			 redirect(BASE_URL.'listing-booking/'.$id.'/'.$category_id);
			 exit();
			 
			 }
			

			// Add new User Details
			$listing_data = $this->commonmod_model->GetSupportListingDetails($id);
			$insertdata = array(
			
			'booked_by' => $this->session->userdata("bh_front_user_id"),
			'listing_id' => $id,
			'category_id' => $category_id,
			'booking_date_from' => $this->input->post('booking_date_from'),
			'booking_date_to' => $this->input->post('booking_date_to'),
			'listing_owner_id' => $listing_data[0]['user_id'],
			'email_id' => $this->input->post('email_id'),
		
			'mobile_number' => $this->input->post('mobile_number'),
			'comment' => $this->input->post('comment'),
			'status' => 'Pending'
			); 
			 		

			
			$this->db->insert('bh_bookings', $insertdata);
			
			$BookedData = $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
			$OwnerData = $this->user_model->UserByID($listing_data[0]['user_id']);
			$propertyTypeData = $this->commonmod_model->GetListingCategoryByID($category_id);
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
				//$this->email->bcc($OwnerData[0]['email_id']);

				$this->email->subject('Book Property Request '.date("d M, Y").' | '.WEBSITE_NAME);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$BookedData[0]['first_name'].' have send request of booking below property as mentioned.</p>';
				$message .= '<p><b>Book Customer Detail:</b></p>';
				$message .= '<p>Name: '.$BookedData[0]['first_name'].' '.$BookedData[0]['last_name'].'</p>';
				$message .= '<p>Booking Email: '.trim($this->input->post('email_id')).'</p>';
				$message .= '<p>Contact No: '.trim($this->input->post('mobile_number')).'</p>';
				$message .= '<p>Message: '.nl2br($this->input->post('comment')).'</p>';
				$message .= '<p>Booking Date(From): '.date("d M,Y",strtotime($this->input->post('booking_date_from'))).'</p>';
				$message .= '<p>Booking Date(To): '.date("d M,Y",strtotime($this->input->post('booking_date_to'))).'</p>';
				
				$message .= '<p><b>Property Owner(Agent)Detail:</b></p>';
				$message .= '<p>Name: '.$OwnerData[0]['first_name'].' '.$OwnerData[0]['last_name'].'</p>';
				$message .= '<p>Listing: '.trim($listing_data[0]['listing_title']).'</p>';
				$message .= '<p>Property Type: '.trim($propertyTypeData[0]['category_name']).'</p>';
				$message .= '<p>Owner Email Id: '.trim($OwnerData[0]['email_id']).'</p>';
				$message .= '<p>Owner Mobile No: '.trim($OwnerData[0]['mobile']).'</p>';

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

				$this->email->subject('Book Property  '.date("d M, Y").' | '.WEBSITE_NAME);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully submitted your request, We are in process to check your request within 24 Hours.</p>';
				

				
				$message .= '<p><b>Property Detail:</b></p>';
				
				$message .= '<p>Property Name: '.trim($listing_data[0]['listing_title']).'</p>';
				$message .= '<p>Property Type: '.trim($propertyTypeData[0]['category_name']).'</p>';
				$message .= '<p>Booking Date(From): '.date("d M,Y",strtotime($this->input->post('booking_date_from'))).'</p>';
				$message .= '<p>Booking Date(To): '.date("d M,Y",strtotime($this->input->post('booking_date_to'))).'</p>';
				
			
				
				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
			
			$this->session->set_flashdata('success',"Your Account is created, Please check your email inbox,spam and approve your account");
			
			
					$this->session->set_flashdata('success',"Your Booking Enquiry is submitted successfully.");
					  redirect(BASE_URL.'listing-booking/'.$id.'/'.$category_id);
			
			}
		 
		 }
		  
		 else{
		$this->load->view('front/user/listing-booking',$data);
		 }
		
	}
	
	
	public function checkListingUserAdd($listing_id,$listing_type)
 {
    $today = date('Y-m-d');
    $this->load->database();
    $query = $this->db->query("SELECT * FROM `bh_listing_view_history` WHERE `listing_id` = '$listing_id' AND `listing_type` = '$listing_type'  AND DATE(`add_date`) = '$today'");

    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    } 
 }
	public function show_contact_details()
	{
	  $html = "";
	 $UserData =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
	 
	  if(!$this->checkListingUserAdd($this->input->post('listing_id'),$this->input->post('listing_type'))){
	 $data = array("listing_id"=>$this->input->post('listing_id'),"listing_type"=>$this->input->post('listing_type'),"user_id"=>$this->session->userdata('bh_front_user_id'));
	 $this->db->insert("bh_listing_view_history",$data);
	  }else{
		  
		  $data = array("last_seen_date"=>date("Y-m-d h:i:s"));
	 $this->db->where("listing_id",$this->input->post('listing_id')); 
	 $this->db->where("listing_type",$this->input->post('listing_type')); 
	 $this->db->update("bh_listing_view_history",$data); 
	  }
	  
	 $html = "<div>";
	 if($UserData[0]["email_id"]!=""){  $html .=  "<p><b>Email id:</b> ".$UserData[0]["email_id"]."</p>"; } 
	 if($UserData[0]["phone"]!=""){ $html .= "<p><b>Phone No:</b> ".$UserData[0]["phone"]."</p>"; } 
	 if($UserData[0]["mobile"]!=""){ $html .= "<p><b>Mobile:</b> ".$UserData[0]["mobile"]."</p>"; } 
	 if($UserData[0]["address"]!=""){ $html .= "<p><b>Address:</b> ".nl2br($UserData[0]["address"])."</p>"; } 
		$html .= "</div>";
		echo $html;
		
	}
	
	
	

	
}
