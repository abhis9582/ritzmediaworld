<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller {
	
	
	function __construct(){
		
	 parent::__construct();
		$this->load->library('form_validation');	
		$this->load->helper(array('form', 'url')); 	 
		$this->load->helper('cookie');
		$this->load->helper('common');
		//

		$this->load->library('session'); 
		$this->load->helper('security');
		$this->load->helper('common');
		$this->load->library('email'); 
		$this->load->library('encrypt');
		// Custom Ours

		$this->load->library('login');  
        $this->load->library('image');   		
		$this->login->check_login();
		$this->load->model('cart_model');	 
		$this->load->model('order_model');	 
		$this->load->model('user_model');	 
		$this->load->model('listing_model');   
		$this->load->model('commonmod_model');   
		$this->load->database();   
	}
	
	public function listing_hotel_pay($id){
		$data['id'] =  $id;
		$data['listing'] =  $this->listing_model->GetSupportListingById($id);
	     $data['HotelPayListing'] =  $this->listing_model->GetHotelPayByListingId($id);
		
			 $this->load->view('admin/listing/list_hotel_pay',$data);
			 
		 
	
	}
	
	public function add_hotel_pay($listing_id){
		
		$data['listing_id'] =  $listing_id;
			$data['listing'] =  $this->listing_model->GetSupportListingById($listing_id);
	
	 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {
		 

		$start_date = date("Y-m-d",strtotime($this->input->post('start_date'))); 
		$end_date = date("Y-m-d",strtotime($this->input->post('end_date'))); 
		
		
		
				$dates_available = $this->commonmod_model->checkHotelDatesIsAvailable($listing_id,$start_date,$end_date);

			
             if(count($dates_available) > 0){
			 $this->session->set_flashdata('error',"Start Date ".$start_date." to ".$end_date." is not available.");
			 redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
			 exit();
			 
			 }
			 if(strtotime($end_date) < strtotime($start_date)){
			   $this->session->set_flashdata('error',"Start Date can be greater than End Date");
			  redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
			   exit();
			 
			 }
		
		

		$status = $this->input->post('status'); 
		$insert_data = array("start_date"=>$start_date,"end_date"=>$end_date,"status"=>$status,"hotel_id"=>$listing_id);

		$this->db->insert('bh_hotel_pay', $insert_data);


		$this->session->set_flashdata('success',"Hotel Dates inserted");
		redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
		

		 }else{
			 $this->load->view('admin/listing/add_hotel_pay',$data);
			 
		 }	
	
	}
	
	
	public function edit_hotel_pay($id,$listing_id){
		$data['id'] =  $id;
		$data['listing_id'] =  $listing_id;
		$data['listing'] =  $this->listing_model->GetSupportListingById($listing_id);
	$data['listingpay'] =  $this->listing_model->GetHotelDatesByID($id);
	 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {
		 
			
			$start_date = date("Y-m-d",strtotime($this->input->post('start_date'))); 
			$end_date = date("Y-m-d",strtotime($this->input->post('end_date'))); 
			$dates_available = $this->commonmod_model->checkHotelDatesIsAvailable($listing_id,$start_date,$end_date,$id);

			
             if(count($dates_available) > 1){
			 $this->session->set_flashdata('error',"Start Date ".$start_date." to ".$end_date." is not available.");
			  redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
			 
			 }
			 if(strtotime($end_date) < strtotime($start_date)){
			   $this->session->set_flashdata('error',"Start Date can be greater than End Date");
			   redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
			 
			 }
			 
			 
			$status = $this->input->post('status'); 
			$insert_data = array("start_date"=>$start_date,"end_date"=>$end_date,"status"=>$status,"hotel_id"=>$listing_id);
			$this->db->where('id', $id);
			$this->db->update('bh_hotel_pay', $insert_data);

				
				
			$this->session->set_flashdata('success',"Hotel Dates updated");
			redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
				
		 }else{
			 $this->load->view('admin/listing/edit_hotel_pay',$data);
			 
		 }	
	
	}
	
	

	
	

	public function index()
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListing();
		$this->load->view('admin/listing/support',$data);
	}
	
	public function corporate_request()
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListing();
		$this->load->view('admin/listing/all_request',$data);
	}
	
	public function support()
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListing();
		$this->load->view('admin/listing/support',$data);
	}
	public function  support_fullfilled(){
	
	
		$data['Content'] =  $this->listing_model->GetALLSupportListingArchive();
		$this->load->view('admin/listing/support',$data);
	}
	
	
	public function support_category($category_id)
	{
		$data['category_id'] =  $category_id;
		$data['Content'] =  $this->listing_model->GetALLSupportListingByCategoryId($category_id);
		$this->load->view('admin/listing/support',$data);
	}
	
	
	public function add_support()
	{
		
		
		//$data['Content'] =  $this->content_model->GetContentByID(15);
		//$data['listing'] =  $this->listing_model->GetSupportListingById($id);
		//$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
			$data = array();
			 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'listing_title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			array('field' => 'city','label' => 'City','rules' => 'trim|required|xss_clean'),
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/listing/add-support',$data);
			
			}
			else{
			// Add new User Details
			$category_id = $this->input->post('category_id');
		
		 $category_ids = $this->commonmod_model->ArraytoString($category_id);
			$updata = array(
			
			'listing_title' => $this->input->post('listing_title'),
			
			'hotel_type' => $this->input->post('hotel_type'),
			'city' => $this->input->post('city'),
			'map' => $this->input->post('map'),
			
			'address' => $this->input->post('address'),
			'email_id' => $this->input->post('email_id'),
			'phone_number' => $this->input->post('phone_number'),
			'mobile_number' => $this->input->post('mobile_number'),
			'activities' => $this->input->post('activities'),
			'tarrif_desc' => $this->input->post('tarrif_desc'),
			'policies' => $this->input->post('policies'),
			'camp_desc' => $this->input->post('camp_desc'),
			'property_features' => $this->input->post('property_features'),
			
			
			
			'add_date' =>date("Y-m-d"),
			'listing_description' => $this->input->post('listing_description'),
			'status' => $this->input->post('status')
			
			
			
			); 
			 		
             
		       $this->db->insert('bh_support_listings', $updata);
			   
			//print_r($this->db->last_query());
			   $id = $this->db->insert_id();
			  
			   for($k=1;$k<=2;$k++){
		if ($_FILES['listing_image'.$k]['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/','2048','3000','3000','listing_image'.$k,$error_view_url);
				if($FileName!=''){
				  $upd_data = array("listing_image".$k=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_support_listings', $upd_data);
				}
				}
			   }
			   
			   if ($_FILES['listing_video']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/video/','20048','0','0','listing_video',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("listing_video"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_support_listings', $upd_data);
				}
				}
				
				
				
				
			
			$this->session->set_flashdata('success',"Hotel is added");
			redirect(BASE_URL.'admin/listing/support');
			}
		 }else{
		$this->load->view('admin/listing/add-support',$data);
		 }
	
	}
	
	
	
	
	
	public function gallery_category($id,$category_id){
		$data['id'] =  $id;
		$data['category_id'] =  $category_id;
		$data['listing'] =  $this->listing_model->GetSupportListingById($id);
	$data['listing_images'] =  $this->listing_model->getALLHotelImageByCategory($id,$category_id);
		
			 $this->load->view('admin/listing/listing_images',$data);
			 
		 
	
	}
	
	public function listing_images($id){
		$data['id'] =  $id;
		$data['listing'] =  $this->listing_model->GetSupportListingById($id);
	$data['listing_images'] =  $this->listing_model->GetSupportListingImagesByListingId($id);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));

			 $this->load->view('admin/listing/listing_images',$data);
			 
		 
	
	}
	public function edit_image($id,$listing_id){
		$data['id'] =  $id;
		$data['listing_id'] =  $listing_id;
		$data['listing'] =  $this->listing_model->GetSupportListingById($listing_id);
	$data['listing_edit_images'] =  $this->listing_model->GetSingleListingImages($id);
	 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {
		 
			 $image_title = $this->input->post('image_title'); 
			 $description = $this->input->post('description'); 
			 $sort_order = $this->input->post('sort_order'); 
			 $category_id = $this->input->post('category_id');
					
				if ($_FILES['image_name']['name'])
				{	
				$error_view_url = 'admin/user/edit';			
				 $FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/','2048','2500','2000','image_name',$error_view_url);
				
				if($FileName!=''){
				$upd_data = array("image_name"=>$FileName);
				$this->db->where('id', $id);
				$this->db->update('bh_listing_images', $upd_data);
				
				}
				
				}
				$upd_data2 = array("image_title"=>$image_title,"description"=>$description,"sort_order"=>$sort_order,"category_id"=>$category_id);
				$this->db->where('id', $id);
				$this->db->update('bh_listing_images', $upd_data2);
				
			$this->session->set_flashdata('success',"Listing Images updated");
			redirect(BASE_URL.'admin/listing/gallery_category/'.$listing_id.'/'.$category_id);
				
		 }else{
			 $this->load->view('admin/listing/edit_image',$data);
			 
		 }	
	
	}
	
	public function add_image($listing_id){
		
		$data['listing_id'] =  $listing_id;
			$data['listing'] =  $this->listing_model->GetSupportListingById($listing_id);
	
	 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {
		 
			 $description = $this->input->post('description'); 
			 $image_title = $this->input->post('image_title'); 
			 $sort_order = $this->input->post('sort_order'); 
			 $category_id = $this->input->post('category_id'); 
					
				if ($_FILES['image_name']['name'])
				{	
				$error_view_url = 'admin/user/edit';			
				$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/','2048','2500','2000','image_name',$error_view_url);
				if($FileName!=''){
				$insert_data = array("image_name"=>$FileName,"description"=>$description,"listing_id"=>$listing_id,"category_id"=>$category_id,"image_title"=>$image_title,"sort_order"=>$sort_order);
				
				$this->db->insert('bh_listing_images', $insert_data);
				}
				}
				
			$this->session->set_flashdata('success',"Listing Images inserted");
			redirect(BASE_URL.'admin/listing/gallery_category/'.$listing_id.'/'.$category_id);
				
		 }else{
			 $this->load->view('admin/listing/add_image',$data);
			 
		 }	
	
	}
	
	
	public function listing_hotel_room($id){
		$data['id'] =  $id;
		$data['listing'] =  $this->listing_model->GetSupportListingById($id);
	$data['listing_images'] =  $this->listing_model->GetSupportListingHotelRoomByListingId($id);
		
			 $this->load->view('admin/listing/list_hotel_room',$data);
			 
		 
	
	}
	
	
	public function edit_support($id)
	{
		
		
		//$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['listing'] =  $this->listing_model->GetSupportListingById($id);
		$data['UserData'] =  $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
			
			 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			
			array('field' => 'listing_title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			array('field' => 'city','label' => 'City','rules' => 'trim|required|xss_clean'),
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/listing/edit-support',$data);
			
			}
			else{
			// Add new User Details
		$category_id = $this->input->post('category_id');
		
			 $category_ids = $this->commonmod_model->ArraytoString($category_id); 
			$updata = array(
			'user_id' => $this->input->post('user_id'),
			'category_id' => $category_ids,
			'listing_title' => $this->input->post('listing_title'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'map' => addslashes($this->input->post('map')),
			'hotel_type' => $this->input->post('hotel_type'),
			'address' => addslashes($this->input->post('address')),
			'email_id' => $this->input->post('email_id'),
			'phone_number' => $this->input->post('phone_number'),
			'mobile_number' => $this->input->post('mobile_number'),
			'activities' => addslashes($this->input->post('activities')),
			'tarrif_desc' => addslashes($this->input->post('tarrif_desc')),
			'camp_desc' => addslashes($this->input->post('camp_desc')),
			'property_features' => $this->input->post('property_features'),
			'policies' => addslashes($this->input->post('policies')),
			
			'pincode' => $this->input->post('pincode'),
			'listing_description' => addslashes($this->input->post('listing_description')),
		
			
			'status' => $this->input->post('status'),
			
			
			
			); 
			 		
               $this->db->where("id",$id);
		       $this->db->update('bh_support_listings', $updata);
			   
			  
			  for($k=1;$k<=2;$k++){
		if ($_FILES['listing_image'.$k]['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/','2048','3000','3000','listing_image'.$k,$error_view_url);
				if($FileName!=''){
				  $upd_data = array("listing_image".$k=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_support_listings', $upd_data);
				}
				}
			   }
			   
			   if ($_FILES['listing_video']['name'])
				{	
			    $error_view_url = 'admin/user/edit';			
$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/video/','20048','0','0','listing_video',$error_view_url);
				if($FileName!=''){
				  $upd_data = array("listing_video"=>$FileName);
				  $this->db->where('id', $id);
			      $this->db->update('bh_support_listings', $upd_data);
				}
				}
				
				
				
				
				
				
			
			$this->session->set_flashdata('success',"Hotel is updated");
			redirect(BASE_URL.'admin/listing/support');
			}
		 }else{
		$this->load->view('admin/listing/edit-support',$data);
		 }
	
	}
	
	
	
	public function sdelete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_support_listings");
		
		$this->db->where("listing_id",$id);
		$this->db->delete("bh_hotel_rooms");
		
		
		$this->db->where("hotel_id",$id);
		$this->db->delete("bh_hotel_room_availability");
		
		$this->db->where("listing_id",$id);
		$this->db->delete("bh_listing_images");
		
		$this->session->set_flashdata('success',"Hotel is  Deleted Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/listing/support');
	}
	
	
	public function rdelete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_request");
		$this->session->set_flashdata('success',"Request is  Deleted Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/listing/corporate_request/');
	}
	public function delete_image($id,$listing_id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_listing_images");
		$this->session->set_flashdata('success',"Listing Image is  Deleted Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/listing/listing_images/'.$listing_id);
	}
	
	
	
	public function delete_hotel_pay($id,$listing_id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_hotel_pay");
		$this->session->set_flashdata('success',"Hotel Dates is  Deleted Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/listing/listing_hotel_pay/'.$listing_id);
	}
	
	public function delete_hotel_room($id,$listing_id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_hotel_rooms");
		$this->session->set_flashdata('success',"Hotel Rooms is  Deleted Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/listing/listing_hotel_room/'.$listing_id);
	}
	
	public function sview($id)
	{
		$data['SupportData'] =  $this->listing_model->GetSupportListingByID($id);
		$this->load->view('admin/listing/sview',$data);
	}
	public function shistory($listing_id)
	{
		$data['SupportData'] =  $this->listing_model->GetHistoryDetailsByID($listing_id,'Support');
		$this->load->view('admin/listing/shistory',$data);
	}
	
	public function odelete($id){
		if($id!=''){
		$this->db->where("order_id",$id);
		$this->db->delete("bh_order");
		$this->session->set_flashdata('success',"Order is  Deleted Successfully.");
		}
		if($id!=''){
		$this->db->where("order_id",$id);
		$this->db->delete("bh_order_product");
		$this->session->set_flashdata('success',"Order is  Deleted Successfully.");
		}
		redirect(BASE_URL.'admin/listing/order/');
	}
	
	public function user_order($user_id="",$status_id ="")
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListingAdmin();
		$data['user_id'] =  $user_id;
		
		if($status_id!=""){
			$data['AllorderList'] =  $this->commonmod_model->GetUserOrder($user_id,$status_id);
		}
		else{ 
		$data['AllorderList'] =  $this->commonmod_model->GetUserOrder($user_id,"");
		}
		$this->load->view('admin/listing/user_order',$data);
	}
	
	public function requestdetail($id)
	{
		$data['RequestData'] =  $this->listing_model->GetCorporateRequest($id);
		$data['id'] = $id;
		$this->load->view('admin/listing/requestdetail',$data);
	}
	public function orderdetail($order_id)
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListingAdmin();
		
		$data['AllOrderlist'] = $this->order_model->ShoworderHistory($order_id);
		$data['AllorderproductList'] = $allprolist = $this->order_model->GetOrderListing($order_id);
		$data['order_id'] = $order_id;
		
		$data['Oneorder'] = $orderdata =  $this->order_model->GetOneorder($order_id);
		 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
	

	      $config = array( 	           
			array('field' => 'order_status_id','Status'=> 'Name','rules' => 'trim|required|xss_clean'),
			array('field' => 'comment','label' => 'Comment','rules' => 'trim|required|xss_clean'),
			
			
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/listing/orderdetail',$data);
			
			}
			else{
			// Add new User Details
			$listingDetail =  $this->listing_model->GetSupportListingById($id);
			
			$updata = array(
			'order_status_id' => $this->input->post('order_status_id'),
			'subject' => $this->input->post('subject'),
			'comment' => $this->input->post('comment'),
			'date_added' => date('Y-m-d H:i:s'),
			'notify' => ($this->input->post('notify')!="")?$this->input->post('notify'):'0',
			'order_id' => $order_id,
			
		
			); 
			 $subject = $this->input->post('subject');		
              
		       $this->db->insert('bh_order_history', $updata);
			    $id = $this->db->insert_id();
			   
			   
			if ($_FILES['image']['name'])
			{	
				$error_view_url = 'admin/listing/orderdetail';			
				$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/listings/','4096','1500','1500','image',$error_view_url);
				if($FileName!=''){
				$upd_data = array("image"=>$FileName);
				$this->db->where('order_history_id', $id);
				$this->db->update('bh_order_history', $upd_data);
				}
			}
		
				
				
				
			    /*  Send User Email Notify User */ 
				if($this->input->post('notify')=='1'){ 
						$user_id = $orderdata[0]['user_id'];
						$orderHistory = $this->order_model->GetOneorderHistory($id);
						$src = $this->image->getImageSrc("listings",$orderHistory[0]['image'],"");
						
						
						$Userdata = $this->user_model->UserByID($user_id);

						$User_EmailId =  $Userdata[0]['email_id'];

						$config['protocol'] = 'sendmail';
						$config['mailpath'] = '/usr/sbin/sendmail';
						$config['mailtype'] = 'html';
						$config['charset'] = 'iso-8859-1';
						$config['wordwrap'] = TRUE;

						$this->email->initialize($config);
						$this->email->from(FROM_EMAIL, FROM_NAME);
						$this->email->to($User_EmailId);
						//$this->email->cc(CC_EMAIL_ID);
						
                        $nstatus = $this->commonmod_model->GetOrderStatusType($this->input->post('order_status_id'));
						$this->email->subject($subject);
						
					
					
						$message .= '<p> '.nl2br($this->input->post('comment')).'

						</p>';
						
						if ($_FILES['image']['name']!="")
			            {	
						$message .= '<p> Attachment: <img src="'.$src.'" style="width:400px;height:300px;"></p>';
						}


						$message .='<p>Thanks <br>
						'.WEBSITE_SIGNATURE.'
						</p>';

						$this->email->message($message);

						$this->email->send();
				}
				
			   
			   
			   $updata1 = array(
			'order_status_id' => $this->input->post('order_status_id'),
		); 
			 		
              $this->db->where("order_id",$order_id);
		       $this->db->update('bh_order', $updata1);
				
			
			$this->session->set_flashdata('success',"updated successfully.");
			redirect(BASE_URL.'admin/listing/orderdetail/'.$order_id);
			}
		 }else{
		$this->load->view('admin/listing/orderdetail',$data);
		}
	}
	
	public function orderdetail_edit_old($order_id)
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListingAdmin();
		
		$data['AllOrderlist'] = $this->order_model->ShoworderHistory($order_id);
		$data['AllorderproductList'] = $allprolist = $this->order_model->GetOrderListing($order_id);
		$data['order_id'] = $order_id;
		
		$data['Oneorder'] = $orderdata =  $this->order_model->GetOneorder($order_id);
		 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');

			$now = strtotime($end_date); // or your date as well
			$your_date = strtotime($start_date);
			$datediff = $now - $your_date;

			$days =  round($datediff / (60 * 60 * 24)); 

			$start_date = date("Y-m-d h:i:s",strtotime($this->input->post('start_date')));
			$end_date = date("Y-m-d h:i:s",strtotime($this->input->post('end_date')));
	
				if(count(@$_POST['cart']) > 0){			
				foreach(@$_POST['cart'] as $id => $cart)
				{			
				$price =  getProductPriceByDays($cart['product_id'],$days);
				$amount = $price * $cart['qty'];
				$deposite = ($cart['qty']*$cart['deposite']);
				$total = $amount + $deposite;

				$updata1 = array(
				'price' => $price,
				'discount_price' => $cart['discount_price'],
				'deposite' => $cart['deposite'],
				'discount_deposite' => $cart['discount_deposite'],
				'quantity' =>  $cart['qty'],
				'total' => $total,
				); 

				$this->db->where("order_product_id",$cart['id']);
				$this->db->update('bh_order_product', $updata1);
				
				}

				$deposite = 0;
				$total = 0;
				$amount = 0;
				foreach(@$_POST['cart'] as $id => $cart)
				{			
				$price =  getProductPriceByDays($cart['product_id'],$days);
				$amount = $amount + ($price - $cart['discount_price']) * $cart['qty'];
				$deposite = $deposite + ($cart['qty']*($cart['deposite'] - $cart['discount_price']));
				$total =  $total + $amount + $deposite;

				}	

				$gst_tax = $this->commonmod_model->getSystemValue('gst_tax');
				$totalamount = $amount;
				$gst = ($gst_tax*$totalamount)/100 ;
				$updata2 = array(
				'total' => $total,
				'tax' => $gst,
				'start_date' =>  $start_date,
				'end_date' =>  $end_date,
				'days' =>  $days,
				'delivery_service' =>  $this->input->post('delivery_service'),

				); 

			$this->db->where("order_id",$order_id);
			$this->db->update('bh_order', $updata2);
		
		
		
		}
			
	      $this->session->set_flashdata('success',"updated successfully.");
			redirect(BASE_URL.'admin/listing/orderdetail/'.$order_id);
			
		 }else{
		$this->load->view('admin/listing/orderdetail_edit',$data);
		}
	}
	
	public function orderdetail_edit($order_id)
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListingAdmin();
		
		$data['AllOrderlist'] = $this->order_model->ShoworderHistory($order_id);
		$data['AllorderproductList'] = $allprolist = $this->order_model->GetOrderListing($order_id);
		$data['order_id'] = $order_id;
		
		$data['Oneorder'] = $orderdata =  $this->order_model->GetOneorder($order_id);
		 if($this->input->post('submitF') && $this->input->post('submitF')!="") 
		 {	
			

				$sub_total = $this->input->post('sub_total');
				
				
				$gst = get_tax($totalamount);
				$totalamount = $sub_total + $gst;
				$updata2 = array(
				'sub_total' => $sub_total,
				'total' => $totalamount,
				'tax' => $gst,
				

				); 

			$this->db->where("order_id",$order_id);
			$this->db->update('bh_order', $updata2);
		
		$this->session->set_flashdata('success',"updated successfully.");
			redirect(BASE_URL.'admin/listing/orderdetail/'.$order_id);
		
		}
			
	      
			
		 else{
		$this->load->view('admin/listing/orderdetail_edit',$data);
		}
	}
	
	
	function removepro($order_id,$order_proid){
	
	if($order_proid!=''){
		$this->db->where("order_product_id",$order_proid);
		$this->db->delete("bh_order_product");
		$this->session->set_flashdata('success',"Product is removed  Successfully.");
			
		
		}
		redirect(BASE_URL.'admin/listing/orderdetail_edit/'.$order_id);
	}
	
	public function delete_email($id){
		
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_newsletter");
		$this->session->set_flashdata('success',"Email is  Deleted Successfully.");
		}
		redirect(BASE_URL.'admin/listing/newsletter/');
	}
	
	
	
	public function newsletter()
	{
		//$data['Content'] =  $this->listing_model->GetALLSupportListingAdmin();
		$data['NewsLetter'] =  $this->listing_model->getNewsLetter();
		$this->load->view('admin/listing/newsletter',$data);
	}
	
	
	public function add_order()
	{
		$start_date = ($this->input->post('start_date')!="")?$this->input->post('start_date'):$this->session->userdata('start_date');
		$end_date = ($this->input->post('end_date')!="")?$this->input->post('end_date'):$this->session->userdata('end_date');

		$start_date = str_replace('/','-',$start_date);
		$end_date = str_replace('/','-',$end_date);
		$this->session->set_userdata('start_date',$start_date);
		$this->session->set_userdata('end_date',$end_date);
		
		$now = strtotime($end_date); // or your date as well
		$your_date = strtotime($start_date);
		$datediff = $now - $your_date;
		$days =  round($datediff / (60 * 60 * 24));
		$this->session->set_userdata('days',$days);
	   
	   

		$data['start_date'] =  $start_date;
		$data['end_date'] = $end_date;

		$data['Content'] =  $this->content_model->GetContentByID(24);
		$this->load->view('admin/listing/add_order',$data);
	}
	
	public function submit_request(){
	   
	
         $user_id = $this->session->userdata('admin_user_order'); 
		$Userdata = $this->user_model->UserByID($user_id);
		
		 $name = $Userdata[0]['first_name'];  
		$email = $Userdata[0]['email_id'] ;
		$mobile = $Userdata[0]['mobile'] ;
		$phone = $Userdata[0]['phone'] ;
		
		$total = $this->checkout_model->getCartTotalAmount();
		if (count($this->cart->contents()) > 0){
		$now = strtotime($this->session->userdata('end_date')); // or your date as well
		$your_date = strtotime($this->session->userdata('start_date'));
		$datediff = $now - $your_date;

		$days =  round($datediff / (60 * 60 * 24));
        
		$gst_tax = $this->commonmod_model->getSystemValue('gst_tax');
		$gst = $gst_tax*$total/100;
		 $eds = 'Yes';
		$order_data = array(
			
			'user_id' 	=> $user_id,
			'firstname' 	=> $name,
			'lastname' 	=> $Userdata[0]['last_name'],
			'email' 	=> $email,
			'telephone' 	=>  $phone,
			'mobile' 	=> $mobile,
			
			'tax' 	=> $gst,
			'total' 	=> $total,
			'currency_code' 	=> CURRENCY,
			'comment' 	=> $this->input->post('comment'),
			'delivery_service' 	=> $eds,
			'days' 	=> $days,
			'end_date' 	=> date("Y-m-d h:i:s",strtotime($this->session->userdata('end_date'))),
			'start_date' 	=> date("Y-m-d h:i:s",strtotime($this->session->userdata('start_date'))),
			'date_added' => date('Y-m-d')
		);		

		  $order_id = $this->checkout_model->InsertOrderData($order_data); 
	

      
		
		$flag = 'Yes';
	
			foreach ($this->cart->contents() as $item):
			$product_data = $this->commonmod_model->GetProductListingDetails($item['id']);
			// Reduce Item Stock Quantity
				
			// Apply Tax On Product
			//$tax = @$this->commonmod_model->ApplyTaxOnProduct($item['id'],$product_data[0]['tax_id']);
			$total_price = ($item['qty']) * ($item['price']-$item['discount_price']);
			
			        $order_detail = array(
					'order_id' 		=> $order_id,
					'product_id' 	=> $item['id'],
					'type' 	=> 'No',
					'name' 	=> $item['name'],
					'scents' 	=> @implode(",",$item['scents']),
					'addins' 	=> @implode(",",$item['addins']),
					'soap_label1' 		=> $item['soap_label1'],
					'soap_label2' 		=> $item['soap_label2'],
					'label_image' 		=> $item['label_image'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'deposite' 		=> $item['deposite'],
					'discount_price' 		=> $item['discount_price'],
					'discount_deposite' 		=> $item['discount_deposite'],
					'total' 		=> $total_price,
					'tax' 		=> ($tax*$item['qty'])
				);
				 	// Add Order History			
                 $orderhistory_id = $this->checkout_model->InsertOrderHistory($order_id,'1');
				 // Add Order Product
                 $orderproduct_id = $this->checkout_model->InsertOrderProduct($order_detail);
			
			  
				
			endforeach;
		
		// send order email to admin
	
		
		$AllorderproductList = $this->order_model->GetOrderListing($order_id);
		$Oneorder =  $this->order_model->GetOneorder($order_id);
			
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
				//$this->email->bcc('ambuj@graphicsmerlin.com');

				$this->email->subject('New Order - #'.$order_id.' | '.WEBSITE_EMAIL_TITLE);
			
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi Admin, <br> '.$name.' have send order.</p>';
				
				$message .= '
      <h2>Order Information</h2>
      <table class="table table-bordered table-hover" width="100%" style="border: 1px solid #ddd;border-collapse: collapse;">
        <thead class="tableHead">
          <tr>
            <td class="text-left" colspan="2" style="border-width: 2px;padding:8px; border: 1px solid #ddd;line-height: 1.42857143;">Order Details</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left" style="width: 50%; border: 1px solid #ddd;padding: 8px;line-height: 1.42857143;"><b>Order ID:</b>
              '.$AllorderproductList[0]['order_id'].'
              <br>
              <b>Date Added:</b>
              '.date("d/ m/ Y",strtotime($Oneorder[0]['date_added'])).'</td>
            <td class="text-left" style="width: 50%; padding: 8px;line-height: 1.42857143; border: 1px solid #ddd"><b>Payment Method:</b>
              '.$Oneorder[0]['payment_method'].'
               <br>
              <b>Email: </b>'.$Oneorder[0]['email'].'<br>
              <b>Telephone: </b>'.$Oneorder[0]['telephone'].'
			  <br>
             <b>Mobile: </b> '.$Oneorder[0]['mobile'].'
			 <br><br>
			 <b>Duration</b>
			 <br>  <br>
			 <b>Start Date:'.date("d M, Y h:i:s ",strtotime($this->session->userdata('start_date'))).'</b>  <br>
			 <b>End Date:'.date("d M, Y h:i:s",strtotime($this->session->userdata('end_date'))).'</b>  <br>
			 <b>Days:'.$days.'</b>  <br>  <br>
			 <b>Delivery Service:'.$eds.'</b>
			 
			 
			 </td>
          </tr>
        </tbody>
      </table>
     
      
        <table class="table table-bordered table-hover" width="100%" style="border: 1px solid #ddd;border-collapse: collapse;">
          <thead>
            <tr>
              <td class="text-left" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Product Name</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Quantity</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Price<br> Per Quantity</td>
              <td class="text-left" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Deposite<br> Per Quantity</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Total</td>
              
            </tr>
          </thead>
          <tbody>';
          
           $grand_total = 0;  
		   $grand_deposite = 0; 
		   foreach($AllorderproductList as $Allproducts) {
			 
				   
			$message .= '<tr>
              <td class="text-left" style="padding:8px; border:1px solid #ddd;">  '. $Allproducts['name'].' 
                </td>
            
              <td class="text-right" style="padding:8px; border:1px solid #ddd;">'.$Allproducts['quantity'].'</td>
              <td class="text-right" style="padding:8px ; border:1px solid #ddd;"><span class="WebRupee">'.CURRENCY.'&nbsp;</span>
			   '.number_format($Allproducts['price']-$Allproducts['price'],2).' <br> Discount Price:<span class="WebRupee">'.CURRENCY.'&nbsp;</span>
  '.number_format($Allproducts['discount_price'],2).'
			   </td>
            <td class="text-left"  style="padding:8px; border:1px solid #ddd;">'.$Allproducts['deposite'].'
			<br> Discount Price:<span class="WebRupee">'.CURRENCY.'&nbsp;</span>
  '.number_format($Allproducts['discount_price'],2).'
			</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd;"><span class="WebRupee">'.CURRENCY.'&nbsp;</span>
			  '.number_format((($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']))+($Allproducts['total']-$Allproducts['discount_price'])),2).'</td>
              
              </tr>';
				   
			
			 $grand_total = $grand_total + ($Allproducts['total'] - $Allproducts['discount_price'])+$Allproducts['tax'];
            $grand_deposite = $grand_deposite + $Allproducts['quantity']*($Allproducts['deposite']- $Allproducts['discount_deposite']); 
            } 
			
			$gst_tax = $this->commonmod_model->getSystemValue('gst_tax');
			$totalamount = $grand_total;
			$gst = ($gst_tax*$totalamount)/100 ;
			
          $message .= '</tbody>
          <tfoot>
           <tr>
              <td colspan="3" style="padding:8px; background="#ddd;"></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;"><b>Sub Total</b></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;">'.CURRENCY.' '.number_format((@$grand_total+$grand_deposite),2).'</td>
             
            </tr>
			<tr>
              <td colspan="3" style="padding:8px; background="#ddd;"></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;"><b>GST</b></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;">'.CURRENCY.' '.number_format($gst,2).'</td>
             
            </tr>
            <tr>
              <td colspan="3" style="padding:8px; background="#ddd;"></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;"><b>Total</b></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;">'.CURRENCY.' '.number_format((@$grand_total+$grand_deposite+$gst),2).'</td>
             
            </tr>
          </tfoot>
        </table>
      ';
	$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';
	

				$this->email->message($message);

				$this->email->send();
			
		
				
				
          /*  Send User Email  */ 
		  
		  $User_EmailId = $Oneorder[0]['email'];
		  
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

				$this->email->subject(WEBSITE_EMAIL_TITLE .' New Order:  '.$order_id);
				$mobileno = $this->commonmod_model->getSystemValue('mobile_number');
				
				$message = '<p>Hi '.trim($this->input->post('name')).', <br><br>
				Your order '.$order_id.' <br> We confirm the availibility only till our stocks last. <br>
				Kindly refer Rental Agreement on our website as it covers all bookings and/or usage of our www.unwindlife.com												
				You may Login into your account, and click - My Account in top right corner to check all your booking details from time to time. <br>												
				Kindly call '.$mobileno.' for any assistance.												
				</p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';
				
				$this->email->message($message);

				$this->email->send();
				//$this->session->set_userdata('order_id',$order_id);
				$this->session->unset_userdata('start_date');
				$this->session->unset_userdata('end_date');
					$this->cart->destroy();
					echo  '	<script>window.location.replace("'.BASE_URL.'admin/listing/orderdetail/'.$order_id.'");</script>';
				
	}else {
			      	echo  '	<script>window.location.replace("'.BASE_URL.'admin/listing/order");</script>';
	}
	}
	
	
	
	public function order($status="")
	{
		$data['Content'] =  $this->listing_model->GetALLSupportListingAdmin();
		
		if($status!=""){
			$data['AllorderList'] =  $this->commonmod_model->GetAllOrder($status);
		}
		else{ 
		$data['AllorderList'] =  $this->order_model->GetsAllorderAdmin();
		}
		$this->load->view('admin/listing/order',$data);
	}
	
	
	
	
	
		


	
}
