<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
	
	
	function __construct(){
		
	 parent::__construct();
		$this->load->library('form_validation');	
		$this->load->helper(array('form', 'url')); 	 
		$this->load->helper('cookie');
		//

		$this->load->library('session'); 
		$this->load->helper('security');
		$this->load->helper('common');
		$this->load->library('email'); 
		$this->load->library('encrypt');
		// Custom Ours

		$this->load->library('login');   
		//$this->login->check_login();	
		$this->load->model('gallery_model'); 
		$this->load->model('listing_model'); 
		$this->load->model('mediabanner_model'); 
		$this->load->model('testimonial_model'); 
		$this->load->model('user_model');   
		$this->load->model('content_model');   
		$this->load->model('commonmod_model'); 
		 $this->load->model('blog_model');  
		$this->load->database();   
	}

	/*  Home Page   */
	public function index()
	{
		$data['Content'] =  $this->content_model->GetContentByID(1);
		$data['Banner'] =  $this->mediabanner_model->getALLImageFront();
		$data['Testimonial'] =  $this->testimonial_model->getALLTestimonialFront();
		$data['Gallery'] =  $this->gallery_model->getALLImageFront();
	  
		$this->load->view('front/content/home',$data);
	}
	
	
	public function about()
	{
		$data['Content'] =  $this->content_model->GetContentByID(2);
		$data['Thought_Content'] =  $this->content_model->GetContentByID(12);
		$this->load->view('front/content/about-us',$data);
	}
	
	
		public function properties()
	{
		$data['Content'] =  $this->content_model->GetContentByID(24);	
		$data['Content'] =  $this->content_model->GetContentByID(32);	
		$this->load->view('front/content/properties',$data);
	}
	
	
	public function offer_detail($offer_url,$offer_id){
		
		$data['offer_id'] =  $offer_id;
		$data['Content'] =  $this->content_model->GetContentByID(25);
		
		$this->load->view('front/content/offer_detail',$data);
		
	}
	
	
	public function offers()
	{
		$data['Content'] =  $this->content_model->GetContentByID(25);
		
		$this->load->view('front/content/offers',$data);
	}
	public function events()
	{
		$data['Content'] =  $this->content_model->GetContentByID(26);
		if($this->input->post('submit_contact') && $this->input->post('submit_contact')!="") 
		 {	
	
         $config = array( 	           
			array('field' => 'name','label' => 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile','label' => 'Mobile Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'message','label' => 'Message','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/content/events',$data);
			
			}
			else{
			
			
			$updata = array(
			'name' => $this->input->post('name'),
			'contact_number' => $this->input->post('mobile_number'),
			'message' => $this->input->post('message'),
			'post_apply' => $this->input->post('post_apply'),
			
			'email' => $this->input->post('email')
			
			
			
			); 
			 		
             
		      // $this->db->insert('bh_career', $updata);
			   //$id = $this->db->insert_id();
			
			
			
		$FileName='';
					if ($_FILES['cv']['name'])
					{	
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/cv/','5048','0','0','cv',$error_view_url);
					if($FileName!=''){
					$upd_data = array("cv"=>$FileName);
					//$this->db->where('id', $id);
					//$this->db->update('bh_career', $upd_data);
					}
					}
				
				
				
          /*  Send Admin Email  */ 
				
				$config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
                $cv='';
				if($FileName!=""){
					 $cquery = $this->db->query("Select cv from bh_career where id='".$id."'");
					 $CarrerData = $cquery->row_array();
					 
					 $cv = $this->image->getImageSrc("cv",$CarrerData['cv'],"");
					 $cv = '<a href="'.$cv.'" target="_blank">'.$cv.'</a>';
				}

				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Ritz Media World');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$this->input->post('name').' have contact with Us regarding events.</p>';
				$message .= '<p>Name: '.trim($this->input->post('name')).'</p>';
				$message .= '<p>Email: '.trim($this->input->post('email')).'</p>';
				$message .= '<p>Mobile No: '.trim($this->input->post('mobile')).'</p>';
				$message .= '<p>State: '.$this->commonmod_model->GetStateName($this->input->post('state')).'</p>';
				$message .= '<p>City: '.$this->commonmod_model->GetCityName($this->input->post('city')).'</p>';
				$message .= '<p>Message: '.trim($this->input->post('message')).'</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email');
		  
		  $config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Events Request | CT Hotels');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully send message, <br> We will contact you soon.</p>';
				

			

			$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();


			
			
			$this->session->set_flashdata('error',"Events Form is submitted successfully.");
			redirect(BASE_URL.'events.html');
			}
		 }
		
		$this->load->view('front/content/events',$data);
	}
	public function partner_with_us()
	{
		$data['Content'] =  $this->content_model->GetContentByID(31);
		if($this->input->post('submit_contact') && $this->input->post('submit_contact')!="") 
		 {	
	
         $config = array( 	           
			array('field' => 'name','label' => 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile_number','label' => 'Mobile Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'property','label' => 'Property','rules' => 'trim|required|xss_clean'),
			array('field' => 'message','label' => 'Message','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/content/partner_with_us',$data);
			
			}
			else{
			
			
			$updata = array(
			'name' => $this->input->post('name'),
			'contact_number' => $this->input->post('mobile_number'),
			'message' => $this->input->post('message'),
			'property' => $this->input->post('property'),
			
			'add_date' => date("Y-m-d h:i:s"),
			'etype' => 'PartnerWithUs',
			'email' => $this->input->post('email')
			
			
			
			); 
			 		
             
		       $this->db->insert('bh_enquiry', $updata);
			   $id = $this->db->insert_id();
			
			
			
		$FileName='';
					if ($_FILES['cv']['name'])
					{	
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/cv/','5048','0','0','cv',$error_view_url);
					if($FileName!=''){
					$upd_data = array("cv"=>$FileName);
					//$this->db->where('id', $id);
					//$this->db->update('bh_career', $upd_data);
					}
					}
				
				
				
          /*  Send Admin Email  */ 
				
				$config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
                $cv='';
				if($FileName!=""){
					 $cquery = $this->db->query("Select cv from bh_career where id='".$id."'");
					 $CarrerData = $cquery->row_array();
					 
					 $cv = $this->image->getImageSrc("cv",$CarrerData['cv'],"");
					 $cv = '<a href="'.$cv.'" target="_blank">'.$cv.'</a>';
				}

				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Partner With Us| Ritz Media World');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$this->input->post('name').' have contact with Us regarding partner with us.</p>';
				$message .= '<p>Name: '.trim($this->input->post('name')).'</p>';
				$message .= '<p>Email: '.trim($this->input->post('email')).'</p>';
				$message .= '<p>Phone No: '.trim($this->input->post('phone')).'</p>';
				$message .= '<p>Property Name: '.trim($this->input->post('property')).'</p>';
				$message .= '<p>Message: '.trim($this->input->post('message')).'</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email');
		  
		  $config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Partner with Us Request | CT Hotels');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully send message, <br> We will contact you soon.</p>';
				

			

			$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();

            $this->session->set_flashdata('success',"Partner with Us Form is submitted successfully.");
			redirect(BASE_URL.'partner_with_us.html');
		    exit;
			}
		 }else{
		
		$this->load->view('front/content/partner_with_us',$data);
		 }
	}
	
	
	public function weddings()
	{
		$data['Content'] =  $this->content_model->GetContentByID(27);
		if($this->input->post('submit_contact') && $this->input->post('submit_contact')!="") 
		 {	
	
         $config = array( 	           
			array('field' => 'name','label' => 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile','label' => 'Mobile Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'message','label' => 'Message','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/content/weddings',$data);
			
			}
			else{
			
			
			$updata = array(
			'name' => $this->input->post('name'),
			'contact_number' => $this->input->post('mobile_number'),
			'message' => $this->input->post('message'),
			'post_apply' => $this->input->post('post_apply'),
			
			'email' => $this->input->post('email')
			
			
			
			); 
			 		
             
		     // $this->db->insert('bh_career', $updata);
			 // $id = $this->db->insert_id();
			
			
			
		$FileName='';
					if ($_FILES['cv']['name'])
					{	
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/cv/','5048','0','0','cv',$error_view_url);
					if($FileName!=''){
					$upd_data = array("cv"=>$FileName);
					//$this->db->where('id', $id);
					//$this->db->update('bh_career', $upd_data);
					}
					}
				
				
				
          /*  Send Admin Email  */ 
				
				$config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
                $cv='';
				if($FileName!=""){
					 $cquery = $this->db->query("Select cv from bh_career where id='".$id."'");
					 $CarrerData = $cquery->row_array();
					 
					 $cv = $this->image->getImageSrc("cv",$CarrerData['cv'],"");
					 $cv = '<a href="'.$cv.'" target="_blank">'.$cv.'</a>';
				}

				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Career| CT Hotels');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$this->input->post('name').' have contact with Us.</p>';
				$message .= '<p>Name: '.trim($this->input->post('name')).'</p>';
				$message .= '<p>Email: '.trim($this->input->post('email')).'</p>';
				$message .= '<p>Mobile No: '.trim($this->input->post('mobile')).'</p>';
				$message .= '<p>Property Name: '.trim($this->input->post('property_name')).'</p>';
				$message .= '<p>Message: '.trim($this->input->post('message')).'</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email');
		  
		  $config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Wedding Request | CT Hotels');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully send message, <br> We will contact you soon.</p>';
				

			

			$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();


			
			
			$this->session->set_flashdata('error',"Wedding Form is submitted successfully.");
			redirect(BASE_URL.'weddings.html');
			}
		 }
		else{
		$this->load->view('front/content/weddings',$data);
		}
	}
	
	public function management()
	{
		$data['Content'] =  $this->content_model->GetContentByID(23);
		  $data['OurTeam1'] =  $this->gallery_model->getALLImageCategoryFront('1');
		  $data['OurTeam2'] =  $this->gallery_model->getALLImageCategoryFront('2');
		  $data['OurTeam3'] =  $this->gallery_model->getALLImageCategoryFront('3');
		$this->load->view('front/content/management',$data);
	}
	
	public function howitworks()
	{
		$this->load->model("howitworks_model");
		$data['Content'] =  $this->content_model->GetContentByID(29);
		$this->load->view('front/content/howitworks',$data);
	}
	
	
	public function show_hotel_ajax()
	{
		$html = "";
		
		  $city = $this->input->post('city');
		  $hotel_id = $this->input->post('hotel_id');
		$this->db->select("*");
		$this->db->from('bh_support_listings');	
		$this->db->where("city",$city);		
		$this->db->order_by("listing_title","asc");

		$query=$this->db->get();
		$all_data =  $query->result_array(); 

		if(count($all_data) > 0){
		$html = '<option value="">Select Hotel</option>';			
		foreach($all_data as $singleData){
		//$url = $this->create_url($singleData['Title']);
		if($hotel_id==$singleData['id']){ $class= 'selected'; } else{  $class= '';  }
		$html .='<option value="'.$singleData['id'].'" '.$class.'>'.$singleData['listing_title'].'</option>';


		}
		}

		echo json_encode($html);
	
	}
	public function search_hotel(){
		 $city = $this->input->post('city');
		 $listing_id = $this->input->post('listing_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		$this->session->set_userdata('city',$city);
		$this->session->set_userdata('listing_id',$listing_id);
		$this->session->set_userdata('start_date',$start_date);
		$this->session->set_userdata('end_date',$end_date);
		
		$ListingData = $this->listing_model->GetSupportListingByID($listing_id);
		$redirectURL = BASE_URL.'hotel/'.create_url($ListingData[0]['listing_title']).'/'.$listing_id;
		redirect($redirectURL);
       
	   
	   
		
	}
	
	
	public function common($id)
	{
		$data['Content'] =  $this->content_model->GetContentByID($id);	
		$this->load->view('front/content/common',$data);
	}
	
	
	
	public function career()
	{
		$data['Content'] =  $this->content_model->GetContentByID(30);
		
		if($this->input->post('submit_contact') && $this->input->post('submit_contact')!="") 
		 {	
	
         $config = array( 	           
			array('field' => 'name','label' => 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile_number','label' => 'Mobile Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'message','label' => 'Message','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/content/career',$data);
			
			}
			else{
			
			
			$updata = array(
			'name' => $this->input->post('name'),
			'contact_number' => $this->input->post('mobile_number'),
			'message' => $this->input->post('message'),
			'post_apply' => $this->input->post('post_apply'),
			'add_date' => date("Y-m-d h:i:s"),
			'email' => $this->input->post('email')
			
			
			
			); 
			 		
             
		       $this->db->insert('bh_career', $updata);
			   $id = $this->db->insert_id();
			
			
			
		$FileName='';
					if ($_FILES['cv']['name'])
					{	
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/cv/','5048','0','0','cv',$error_view_url);
					if($FileName!=''){
					$upd_data = array("cv"=>$FileName);
					$this->db->where('id', $id);
					$this->db->update('bh_career', $upd_data);
					}
					}
				
				
				
          /*  Send Admin Email  */ 
				
				$config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
                $cv='';
				if($FileName!=""){
					 $cquery = $this->db->query("Select cv from bh_career where id='".$id."'");
					 $CarrerData = $cquery->row_array();
					 
					 $cv = $this->image->getImageSrc("cv",$CarrerData['cv'],"");
					 $cv = '<a href="'.$cv.'" target="_blank">'.$cv.'</a>';
				}

				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Career| CT Hotels');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$this->input->post('name').' have contact with Us.</p>';
				$message .= '<p>Name: '.trim($this->input->post('name')).'</p>';
				$message .= '<p>Email: '.trim($this->input->post('email')).'</p>';
				$message .= '<p>Mobile No: '.trim($this->input->post('mobile_number')).'</p>';
				$message .= '<p>Post Apply: '.trim($this->input->post('post_apply')).'</p>';
				$message .= '<p>Message: '.trim($this->input->post('message')).'</p>';
				$message .= '<p>Attachement: '.$cv.'</p>';

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email');
		  
		  $config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Career | CT Hotels');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully send message, <br> We will contact you soon.</p>';
				

			

			$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();


			
			
			$this->session->set_flashdata('error',"Career Form is submitted successfully.");
			redirect(BASE_URL.'career.html');
			}
		 }
		 
	else{
		$this->load->view('front/content/career',$data);
		 }	
		
	}
	public function contact()
	{
		$data['Content'] =  $this->content_model->GetContentByID(21);
		
		if($this->input->post('submit_contact') && $this->input->post('submit_contact')!="") 
		 {	
	
         $config = array( 	           
			array('field' => 'name','label' => 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|xss_clean'),
			array('field' => 'mobile_number','label' => 'Mobile Number','rules' => 'trim|required|xss_clean'),
			array('field' => 'message','label' => 'Message','rules' => 'trim|required|xss_clean')
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('front/content/contact',$data);
			
			}
			else{
			
		
          /*  Send Admin Email  */ 
		  
		  $updata = array(
			'name' => $this->input->post('name'),
			'contact_number' => $this->input->post('mobile_number'),
			'message' => $this->input->post('message'),
			'email' => $this->input->post('email'),
			'etype' => 'ContactUs',
			'add_date' => date("Y-m-d h:i:s"),
			); 
			 		
             
		       $this->db->insert('bh_enquiry', $updata);
			   $id = $this->db->insert_id();
			   
				
				$config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);


				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Contact Us');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>'.$this->input->post('name').' have contact with Us.</p>';
				$message .= '<p>Name: '.trim($this->input->post('name')).'</p>';
				$message .= '<p>Email: '.trim($this->input->post('email')).'</p>';
				$message .= '<p>Mobile No: '.trim($this->input->post('mobile_number')).'</p>';
				$message .= '<p>Message: '.trim($this->input->post('message')).'</p>';

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $this->input->post('email');
		  
		  $config2['protocol'] = 'sendmail';
				$config2['mailpath'] = '/usr/sbin/sendmail';
				$config2['mailtype'] = 'html';
				$config2['charset'] = 'iso-8859-1';
				$config2['wordwrap'] = TRUE;

				$this->email->initialize($config2);
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to($User_EmailId);
				//$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Contact Us');
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully send message, <br> We will contact you soon.</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();


			
			
			$this->session->set_flashdata('error',"Contact Us Form is submitted successfully.");
			redirect(BASE_URL.'contact.html');
			}
		 }
		 
	else{
		$this->load->view('front/content/contact',$data);
		 }	
		
	}
	
	public function gallery()
	{
		$data['Content'] =  $this->content_model->GetContentByID(17);
		$data['Gallery'] =  $this->gallery_model->getALLImage();
		$this->load->view('front/content/gallery',$data);
	}
	
	public function media()
	{
		$data['Content'] =  $this->content_model->GetContentByID();
		$this->load->view('front/content/media',$data);
	}
	public function upcomingevents()
	{
		$data['Content'] =  $this->content_model->GetContentByID();
		$this->load->view('front/content/upcomingevents',$data);
	}
	
	
	public function showroombookingform(){
		echo $room = $this->input->post('room');
		$html = 'hello';
		for($i=1; $i <= $room; $i++){
			
			$html .= '<div class="row row'.($i+1).'">
										<div class="col-lg-3">
											<p>Room '.$i.'</p>
										</div>
										
										<div class="col-lg-3">
											<form>
												<div class="form-group">
													<select class="form-control" id="exampleFormControlSelect1">
													  <option>Adults</option>
													  <option>1</option>
													  <option>2</option>
													  <option>3</option>
													</select>
												  </div>
											</form>
										</div>
										<div class="col-lg-3">
											<form>
												<div class="form-group">
													<select class="form-control" id="exampleFormControlSelect1">
													  <option>Child</option>
													  <option>0</option>
													  <option>1</option>
													</select>
												  </div>
											</form>
										</div>
										<div class="col-lg-3">
											<form>
												<div class="form-group">
													<select class="form-control" id="exampleFormControlSelect1">
													  <option>Infants</option>
													  <option>1</option>
													  <option>2</option>
													  <option>3</option>
													</select>
												  </div>
											</form>
										</div>
									</div>';
			
		}
		return $html;
	}
	
	
	

	
}
