<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		//
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->helper('common');
		$this->load->library('email');
		$this->load->library('encryption');
		// Custom Ours
		$this->load->library('login');
		//$this->login->check_login();	
		$this->load->model('gallery_model');
		$this->load->model('listing_model');
		$this->load->model('mediabanner_model');
		$this->load->model('testimonial_model');
		$this->load->model('user_model');
		$this->load->model('content_model');
		$this->load->model('clients_model');
		$this->load->model('commonmod_model');
		$this->load->model('blog_model');
		$this->load->model('home_model');
		$this->load->model('admin_model');
		$this->load->database();
	}

	/*  Home Page   */
	public function index()
	{
		$ip = $this->input->ip_address();
		$result = $this->home_model->addVisitor($ip);
		$data['Content'] = $this->content_model->GetContentByID(1);
		$data['Banner'] = $this->mediabanner_model->getALLImageFront();
		$data['Service'] = $this->home_model->getALLServices();
		$data['Customer'] = $this->home_model->getALLCustomers();
		$data['why_choose'] = $this->home_model->GetWhyChooseUs();
		$data['Testimonial'] = $this->testimonial_model->getALLTestimonialFront();
		$data['Networthy'] = $this->home_model->getALLNetworthyAssets();
		$data['Gallery'] = $this->gallery_model->getALLImageFront();
		$data['khm'] = $this->home_model->getALLKaamHaiMera();
		// $data['Blogs'] = $this->blog_model->getALLBlogsBySearch();
		$data['Blogs'] = $this->blog_model->getLatestBlogs();
		$data['head_titles'] = $this->home_model->GetTitle();
		$this->load->view('front/content/home', $data);
	}

	public function about()
	{
		$data['Content'] = $this->content_model->GetContentByID(2);
		//$data['Thought_Content'] =  $this->content_model->GetContentByID(12);
		$this->load->view('front/content/about', $data);
	}

	public function properties()
	{
		$data['Content'] = $this->content_model->GetContentByID(24);
		//$data['Content'] =  $this->content_model->GetContentByID(32);	
		$this->load->view('front/content/properties', $data);
	}

	public function offer_detail($offer_url, $offer_id)
	{
		$data['offer_id'] = $offer_id;
		$data['Content'] = $this->content_model->GetContentByID(25);
		$this->load->view('front/content/offer_detail', $data);
	}

	public function offers()
	{
		$data['Content'] = $this->content_model->GetContentByID(25);
		$this->load->view('front/content/offers', $data);
	}

	public function events()
	{
		$data['Content'] = $this->content_model->GetContentByID(26);
		$data['Event'] = $this->content_model->GetAllEvent();
		if ($this->input->post('submit_contact') && $this->input->post('submit_contact') != "") {
			$config = array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]'),
				array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('front/content/events', $data);
			} else {
				$updata = array(
					'name' => $this->input->post('name'),
					'contact_number' => $this->input->post('mobile_number'),
					'message' => $this->input->post('message'),
					'post_apply' => $this->input->post('post_apply'),
					'email' => $this->input->post('email')
				);
				// $this->db->insert('bh_career', $updata);
				//$id = $this->db->insert_id();
				$FileName = '';
				if ($_FILES['cv']['name']) {
					$error_view_url = 'admin/user/edit';
					$FileName = $this->commonmod_model->uploadCommonFile('./webroot/images/original/', './webroot/images/cv/', '5048', '0', '0', 'cv', $error_view_url);
					if ($FileName != '') {
						$upd_data = array("cv" => $FileName);
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
				$cv = '';
				if ($FileName != "") {
					$cquery = $this->db->query("Select cv from bh_career where id='" . $id . "'");
					$CarrerData = $cquery->row_array();
					$cv = $this->image->getImageSrc("cv", $CarrerData['cv'], "");
					$cv = '<a href="' . $cv . '" target="_blank">' . $cv . '</a>';
				}
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');
				$this->email->subject('Event| Ritz Media World');
				$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
				$message .= '<p>' . $this->input->post('name') . ' have contact with Us regarding events.</p>';
				$message .= '<p>Name: ' . trim($this->input->post('name')) . '</p>';
				$message .= '<p>Email: ' . trim($this->input->post('email')) . '</p>';
				$message .= '<p>Mobile No: ' . trim($this->input->post('mobile')) . '</p>';
				$message .= '<p>State: ' . $this->commonmod_model->GetStateName($this->input->post('state')) . '</p>';
				$message .= '<p>City: ' . $this->commonmod_model->GetCityName($this->input->post('city')) . '</p>';
				$message .= '<p>Message: ' . trim($this->input->post('message')) . '</p>';
				$message .= '<p>Thanks <br>
				' . WEBSITE_SIGNATURE . '
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
				$this->email->subject('Events Request | Shringar Hotels');
				$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
				$message .= '<p>Hi ' . trim($this->input->post('name')) . ' you have successfully send message, <br> We will contact you soon.</p>';
				$message .= '<p>Thanks <br>
				' . WEBSITE_SIGNATURE . '
				</p>';
				$this->email->message($message);
				$this->email->send();
				$this->session->set_flashdata('error', "Events Form is submitted successfully.");
				redirect(BASE_URL . 'events.html');
			}
		}
		$this->load->view('front/content/events', $data);
	}

	public function enquiries()
	{
		$data['Content'] = $this->content_model->GetContentByID(31);
		if ($this->input->post('submit_contact') && $this->input->post('submit_contact') != "") {
			$config = array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'property', 'label' => 'Property', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('front/content/enquiries', $data);
			} else {
				$isVerified = $this->captchaVerification();
				if (intval($isVerified["success"]) !== 1) {
					$this->session->set_flashdata('error', "Please complete the CAPTCHA.");
					redirect(BASE_URL . 'enquiries.html');
				} else {
					//  Send Admin Email  //
					$updata = array(
						'name' => $this->input->post('name'),
						'contact_number' => $this->input->post('mobile_number'),
						'message' => $this->input->post('message'),
						'property' => $this->input->post('property'),
						'add_date' => date("Y-m-d h:i:s"),
						'etype' => 'Enquiries',
						'email' => $this->input->post('email')
					);
					$this->db->insert('bh_enquiry', $updata);
					$id = $this->db->insert_id();
					$subject = "Contact Us";
					$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
					$message .= '<p>' . trim($updata['name']) . ' have contact with Us.</p>';
					$message .= '<p>Name: ' . trim($updata['name']) . '</p>';
					$message .= '<p>Email: ' . trim($updata['email']) . '</p>';
					$message .= '<p>Mobile No: ' . trim($updata['contact_number']) . '</p>';
					$message .= '<p>Property: ' . trim($updata['property']) . '</p>';
					$message .= '<p>Message: ' . trim($updata['message']) . '</p>';
					$result = $this->sendEmail($subject, $message);
					// Check if the email was sent successfully
					if ($result == 0) {
						$this->session->set_flashdata('error', "An error occured.");
					} else {
						$this->session->set_flashdata('success', "Enquiry Form is submitted successfully.");
					}
					redirect(BASE_URL . 'enquiries.html');
					exit;
				}
			}
		} else {
			$this->load->view('front/content/enquiries', $data);
		}
	}

	public function weddings()
	{
		$data['Content'] = $this->content_model->GetContentByID(27);
		$data['Wedding'] = $this->content_model->GetAllWedding();
		if ($this->input->post('submit_contact') && $this->input->post('submit_contact') != "") {
			$config = array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('front/content/weddings', $data);
			} else {
				$updata = array(
					'name' => $this->input->post('name'),
					'contact_number' => $this->input->post('mobile_number'),
					'message' => $this->input->post('message'),
					'post_apply' => $this->input->post('post_apply'),
					'email' => $this->input->post('email')
				);
				// $this->db->insert('bh_career', $updata);
				// $id = $this->db->insert_id();

				$FileName = '';
				if ($_FILES['cv']['name']) {
					$error_view_url = 'admin/user/edit';
					$FileName = $this->commonmod_model->uploadCommonFile('./webroot/images/original/', './webroot/images/cv/', '5048', '0', '0', 'cv', $error_view_url);
					if ($FileName != '') {
						$upd_data = array("cv" => $FileName);
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
				$cv = '';
				if ($FileName != "") {
					$cquery = $this->db->query("Select cv from bh_career where id='" . $id . "'");
					$CarrerData = $cquery->row_array();
					$cv = $this->image->getImageSrc("cv", $CarrerData['cv'], "");
					$cv = '<a href="' . $cv . '" target="_blank">' . $cv . '</a>';
				}
				$this->email->from(FROM_EMAIL, FROM_NAME);
				$this->email->to(ADMIN_EMAIL_ID);
				$this->email->cc(CC_EMAIL_ID);
				//$this->email->bcc('them@their-example.com');
				$this->email->subject('Career| Ritz Media World');
				$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
				$message .= '<p>' . $this->input->post('name') . ' have contact with Us.</p>';
				$message .= '<p>Name: ' . trim($this->input->post('name')) . '</p>';
				$message .= '<p>Email: ' . trim($this->input->post('email')) . '</p>';
				$message .= '<p>Mobile No: ' . trim($this->input->post('mobile')) . '</p>';
				$message .= '<p>Property Name: ' . trim($this->input->post('property_name')) . '</p>';
				$message .= '<p>Message: ' . trim($this->input->post('message')) . '</p>';
				$message .= '<p>Thanks <br>
				' . WEBSITE_SIGNATURE . '
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
				$this->email->subject('Wedding Request | Ritz Media World');
				$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
				$message .= '<p>Hi ' . trim($this->input->post('name')) . ' you have successfully send message, <br> We will contact you soon.</p>';
				$message .= '<p>Thanks <br>
				' . WEBSITE_SIGNATURE . '
				</p>';
				$this->email->message($message);
				$this->email->send();
				$this->session->set_flashdata('error', "Wedding Form is submitted successfully.");
				redirect(BASE_URL . 'weddings.html');
			}
		} else {
			$this->load->view('front/content/weddings', $data);
		}
	}

	public function management()
	{
		$data['Content'] = $this->content_model->GetContentByID(23);
		$data['OurTeam1'] = $this->gallery_model->getALLourTeamByCatIDFRont('1');
		$data['OurTeam2'] = $this->gallery_model->getALLourTeamByCatIDFRont('2');
		$data['OurTeam3'] = $this->gallery_model->getALLourTeamByCatIDFRont('3');
		$this->load->view('front/content/management', $data);
	}

	public function howitworks()
	{
		$this->load->model("howitworks_model");
		$data['Content'] = $this->content_model->GetContentByID(29);
		$this->load->view('front/content/howitworks', $data);
	}

	public function show_hotel_ajax()
	{
		$html = "";
		$city = $this->input->post('city');
		$hotel_id = $this->input->post('hotel_id');
		$this->db->select("*");
		$this->db->from('bh_support_listings');
		$this->db->where("city", $city);
		$this->db->order_by("listing_title", "asc");
		$query = $this->db->get();
		$all_data = $query->result_array();
		if (count($all_data) > 0) {
			$html = '<option value="">Select Hotel</option>';
			foreach ($all_data as $singleData) {
				//$url = $this->create_url($singleData['Title']);
				if ($hotel_id == $singleData['id']) {
					$class = 'selected';
				} else {
					$class = '';
				}
				$html .= '<option value="' . $singleData['id'] . '" ' . $class . '>' . $singleData['listing_title'] . '</option>';
			}
		}
		echo json_encode($html);
	}

	public function search_hotel()
	{
		$city = $this->input->post('city');
		$listing_id = $this->input->post('listing_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$this->session->set_userdata('city', $city);
		$this->session->set_userdata('listing_id', $listing_id);
		$this->session->set_userdata('start_date', $start_date);
		$this->session->set_userdata('end_date', $end_date);
		$ListingData = $this->listing_model->GetSupportListingByID($listing_id);
		$redirectURL = BASE_URL . 'hotel/' . create_url($ListingData[0]['listing_title']) . '/' . $listing_id;
		redirect($redirectURL);
	}

	public function common($id)
	{
		$data['Content'] = $this->content_model->GetContentByID($id);
		$this->load->view('front/content/common', $data);
	}

	function dd($variable)
	{
		echo '<pre>';
		var_dump($variable); // or use print_r($variable) if you prefer
		echo '</pre>';
		exit(); // Stop script execution
	}
	public function creativeservices($id)
	{
		$data['Category'] = $this->home_model->getALLCategories();
		$data['id'] = $id;
		// $this->dd($data['Category']);
		$this->load->view('front/content/creative-services', $data);
	}
	public function webStory(){
		$data['webStory'] = $this->admin_model->getALLWebStories();
		$this->load->view('front/content/web-story', $data);
	}
	public function landingPage()
	{
		$this->load->view('front/content/landing-page');
	}

	public function privacyPolicy()
	{
		$data['Content'] = $this->content_model->GetPolicy('privacy-policy.html');
		$this->load->view('front/content/privacy-policy', $data);
	}
	
	public function refundPolicy()
	{
		$data['Content'] = $this->content_model->GetRefund('refund-policy.html');
		$this->load->view('front/content/refund-policy', $data);
	}

	public function menudata($id)
	{
		$data['Service'] = $this->home_model->getALLServices();
		$data['Submenu'] = $this->home_model->getALLSubmenu($id);
		$data['id'] = $id;
		$this->load->view('front/content/branding-and-identity-development', $data);
	}
	public function querypage()
	{
		$this->load->view('front/content/querydetailpage');
	}
	public function seopage()
	{
		$this->load->view('front/content/seo');
	}
	
	public function newpage(){
		$this->load->view('front/content/new-common-page');
	}

	public function career()
	{
		$data['Content'] = $this->content_model->GetContentByID(30);
		if ($this->input->post('submit_contact') && $this->input->post('submit_contact') != "") {
			$config = array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('front/content/career', $data);
			} else {
				$isCaptchaVerified = $this->captchaVerification();
				if ($isCaptchaVerified["success"] != 1) {
					$this->session->unset_userdata('error');
					$this->session->set_flashdata('error', "Please complete the CAPTCHA.");
					redirect(BASE_URL . 'career.html');
				} else {
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
					$FileName = '';
					if ($_FILES['cv']['name']) {
						$error_view_url = 'admin/user/edit';
						$FileName = $this->commonmod_model->uploadCommonFile('./webroot/images/original/', './webroot/images/cv/', '5048', '0', '0', 'cv', $error_view_url);
						if ($FileName != '') {
							$upd_data = array("cv" => $FileName);
							$this->db->where('id', $id);
							$this->db->update('bh_career', $upd_data);
						}
					}
					$cv = '';
					if ($FileName != "") {
						$cquery = $this->db->query("Select cv from bh_career where id='" . $id . "'");
						$CarrerData = $cquery->row_array();
						$cv = $this->image->getImageSrc("cv", $CarrerData['cv'], "");
						$cv = '<a href="' . $cv . '" target="_blank">' . $cv . '</a>';
					}
					$subject = 'Career| Ritz Media World';
					$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
					$message .= '<p>' . $this->input->post('name') . ' have contact with Us.</p>';
					$message .= '<p>Name: ' . trim($this->input->post('name')) . '</p>';
					$message .= '<p>Email: ' . trim($this->input->post('email')) . '</p>';
					$message .= '<p>Mobile No: ' . trim($this->input->post('mobile_number')) . '</p>';
					$message .= '<p>Post Apply: ' . trim($this->input->post('post_apply')) . '</p>';
					$message .= '<p>Message: ' . trim($this->input->post('message')) . '</p>';
					$message .= '<p>Attachement: ' . $cv . '</p>';
					$message .= '<p>Thanks <br>
				' . WEBSITE_SIGNATURE . '
				</p>';
					$this->sendEmail($subject, $message);
					$this->session->unset_userdata('success');
					$this->session->set_flashdata('success', "Career Form is submitted successfully.");
					redirect(BASE_URL . 'career.html');
				}
			}
		} else {
			$this->load->view('front/content/career', $data);
		}
	}
	public function popUpcontact()
	{
		if ($this->input->is_ajax_request()) {
			// Get data from the form
			$updata = array(
				'name' => $this->input->post('name'),
				'contact_number' => $this->input->post('mobile'),
				'message' => $this->input->post('message'),
				'email' => $this->input->post('email'),
				'etype' => 'ContactUs',
				'property' => $this->input->post('services'),
				'add_date' => date("Y-m-d H:i:s"),  // Fixed the time format (24-hour format)
			);
			$subject = "Get in touch";
			$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
			$message .= '<p>Name: ' . trim($updata['name']) . '</p>';
			$message .= '<p>Email: ' . trim($updata['email']) . '</p>';
			$message .= '<p>Mobile No: ' . trim($updata['contact_number']) . '</p>';
			$message .= '<p>Message: ' . trim($updata['message']) . '</p>';
			$message .= '<p>Service: ' . trim($updata['property']) . '</p>';
			$result = $this->sendEmail($subject, $message);
			// Insert the data into the database
			if ($this->db->insert('bh_enquiry', $updata)) {
				// Success response
				$response = array(
					'status' => 'success',
					'message' => 'Your message has been sent successfully!'
				);
			} else {
				// Failure response
				$response = array(
					'status' => 'error',
					'message' => 'There was an error while submitting your form. Please try again.'
				);
			}
			header('Content-Type: application/json');
			// Return JSON response
			echo json_encode($response);
		} else {
			// If it's not an AJAX request, show an error
			show_404();
		}
	}

	public function cookieData()
	{
		if ($this->input->is_ajax_request()) {
			// Get data from the form
			$updata = array(
				'ip_address' => $this->input->post('ip'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'pincode' => $this->input->post('pincode'),
				'accept_date' => date("Y-m-d H:i:s"),
			);
			// Insert the data into the database
			if ($this->db->insert('cookie_acceptance', $updata)) {
				// Success response
				$response = array(
					'status' => 'success',
					'message' => 'Your message has been sent successfully!'
				);
			} else {
				// Failure response
				$response = array(
					'status' => 'error',
					'message' => 'There was an error while submitting your form. Please try again.'
				);
			}
			header('Content-Type: application/json');
			// Return JSON response
			echo json_encode($response);
		} else {
			// If it's not an AJAX request, show an error
			show_404();
		}
	}

	public function contact()
	{
		$data['Content'] = $this->content_model->GetContentByID(21);
		if ($this->input->post('submit_contact') && $this->input->post('submit_contact') != "") {
			$config = array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim|required|xss_clean|regex_match[/^[0-9]{10}$/]'),
				array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('front/content/contact', $data);
			} else {
				$isVerified = $this->captchaVerification();
				if (intval($isVerified["success"]) !== 1) {
					$this->session->set_flashdata('error', "Please complete the CAPTCHA.");
					redirect(BASE_URL . 'contact.html');
				} else {
					//  Send Admin Email  //
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
					$subject = "Contact Us";
					$message = '<h2>' . WEBSITE_EMAIL_TITLE . '</h2>';
					$message .= '<p>' . trim($updata['name']) . ' have contact with Us.</p>';
					$message .= '<p>Name: ' . trim($updata['name']) . '</p>';
					$message .= '<p>Email: ' . trim($updata['email']) . '</p>';
					$message .= '<p>Mobile No: ' . trim($updata['contact_number']) . '</p>';
					$message .= '<p>Message: ' . trim($updata['message']) . '</p>';
					$result = $this->sendEmail($subject, $message);
					// Check if the email was sent successfully
					if ($result == 0) {
						$this->session->set_flashdata('error', "An error occured.");
					} else {
						$this->session->set_flashdata('success', "Contact Us Form is submitted successfully.");
					}
					redirect(BASE_URL . 'contact.html');
				}
			}
		} else {
			$this->load->view('front/content/contact', $data);
		}
	}


	public function gallery()
	{
		$data['Content'] = $this->content_model->GetContentByID(17);
		$data['Gallery'] = $this->gallery_model->getALLImage();
		$this->load->view('front/content/gallery', $data);
	}

	public function client()
	{
		$data['Content'] = $this->content_model->GetContentByID(17);
		$data['Client'] = $this->clients_model->getALLImage();
		$this->load->view('front/content/client', $data);
	}

	public function media()
	{
		$data['Content'] = $this->content_model->GetContentByID();
		$this->load->view('front/content/media', $data);
	}

	public function upcomingevents()
	{
		$data['Content'] = $this->content_model->GetContentByID();
		$this->load->view('front/content/upcomingevents', $data);
	}

	public function showroombookingform()
	{
		echo $room = $this->input->post('room');
		$html = 'hello';
		for ($i = 1; $i <= $room; $i++) {
			$html .= '<div class="row row' . ($i + 1) . '">
										<div class="col-lg-3">
											<p>Room ' . $i . '</p>
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

	public function find_html()
	{
		// THIS WILL BE UNCOMMENT WHEN UPLOAD ON LIVE SERVER
		$url = str_replace('.html', '', $_SERVER['REQUEST_URI']);
		$url = str_replace('-', ' ', $url);
		$url = str_replace('/ritzmedia/', '', $url);
		// 		$url = 'abcd';

		$result = $this->content_model->getMenuContent($url);
		if ($result) {
			$data['Content'] = $result;
			$this->load->view('front/content/common', $data);
		} else {
			$result = $this->content_model->getContentData($url);
			if ($result) {
				$data['Content'] = $result;
				$this->load->view('front/content/common', $data);
			} else {
				$data['noRecordFound'] = 'No record found...';
				$this->load->view('front/content/common', $data);
			}
		}
		// else{
		// 	echo "herer";
		// 	exit();
		// 	$data['Content'] =  array(
		// 		'page_heading' 	=> 'no record found...',
		// 		'page_title'	=> 'no record found...'
		// 	);
		// 	$this->load->view('front/content/common',$data);
		// }
	}
	public function sendEmail($sub, $msg)
	{
		$to = MAIL_TO;
		$subject = $sub;
		$apiKey = API_KEY;
		$url = 'https://api.sendgrid.com/v3/mail/send';
		$message = $msg;
		// Prepare the data
		$data = [
			'personalizations' => [
				[
					'to' => [
						['email' => "info@ritzmediaworld.com"],
					],
					'subject' => $subject,
				],
			],
			'from' => ['email' => 'divya@ctm.co.in'],
			'content' => [
				[
					'type' => 'text/html',
					'value' => $message,
				],
			],
		];
		// Set up HTTP options
		$options = [
			'http' => [
				'header' => [
					"Authorization: Bearer $apiKey",
					"Content-Type: application/json"
				],
				'method' => 'POST',
				'content' => json_encode($data),
			],
		];
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		if ($result === FALSE) {
			return 0;
		} else {
			return 1;
		}
	}
	public function captchaVerification()
	{
		$recaptchaResponse = $_POST['g-recaptcha-response'];
		$secretKey = SECRET_KEY;
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => $secretKey,
			'response' => $recaptchaResponse
		);
		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
			),
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$responseKeys = json_decode($result, true);
		return $responseKeys;
	}
}
