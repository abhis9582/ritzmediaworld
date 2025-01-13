<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	
	
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

	
	
	
	public function search_properties($state_id="",$city_id="",$category_id="")
	{
		
		
		$data['state_id'] =  $state_id;
		$data['city_id'] =  $city_id;
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['SupportData'] =  $this->commonmod_model->GetSupportListing($state_id,$city_id,$category_id);
		
		$this->load->view('front/user/search-properties',$data);
	}
	
	
	
	

public function hotel_detail($url_title="",$id="")
	{
		$data['id'] =  $id;
		
		//$data['category_id'] = $category_id;
			$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['SupportSingleData'] =  $this->commonmod_model->GetSupportListingDetails($id);
		$data['Listing_Images'] =  $this->listing_model->GetSupportListingImagesDetails($id);
		
		
		$this->load->view('front/search/hotel-detail',$data);
		
		
	}
	
	
	public function support_detail($url_title="",$id="")
	{
		$data['id'] =  $id;
		
		
		
		
		
		//$data['category_id'] = $category_id;
		
		$current_url = str_replace("index.php/","",current_url());
		
		
		
		
		if($this->session->userdata('current_hotel')==''){
			$this->session->set_userdata('current_hotel',$id);
			
			
		}else if($id != $this->session->userdata('current_hotel') && $this->input->post('start_date')=='' && $this->input->post('end_date')==''){
			$this->session->set_userdata('current_hotel',$id);
			$this->cart->destroy();
			$this->session->set_userdata('start_date',date("Y-m-d"));
			$this->session->set_userdata('end_date',date("Y-m-d", strtotime("+1 day")));
			
			
		}
		
		
		
		$start_date = ($this->session->userdata('start_date')!="")?$this->session->userdata('start_date'):$this->input->post('start_date');
		$end_date = ($this->session->userdata('end_date')!="")?$this->session->userdata('end_date'):$this->input->post('end_date');

		 $start_date1= date("d M",strtotime($start_date )) ;
		 $end_date1= date("d M",strtotime($end_date )) ;
		
		$start_date = str_replace('/','-',$start_date);
		$end_date = str_replace('/','-',$end_date);
		
		
		
		
		
		
		
		  $total = $this->checkout_model->getCartTotalAmount();
		$this->session->set_userdata('start_date',$start_date);
		$this->session->set_userdata('end_date',$end_date);
		
		$now = strtotime($end_date); // or your date as well
		$your_date = strtotime($start_date);
		$datediff = $now - $your_date;
		$days =  round($datediff / (60 * 60 * 24));
		$this->session->set_userdata('days',$days);
	   
	   

		$data['days'] =  $days ;
		$data['start_date'] =  $start_date;
		$data['start_date1'] =  $start_date1;
		$data['end_date1'] = $end_date1;
		$data['end_date'] = $end_date;
		$data['Content'] =  $this->content_model->GetContentByID(15);
		$data['SupportSingleData'] =  $this->commonmod_model->GetSupportListingDetails($id);
		$data['Listing_Images'] =  $this->listing_model->GetSupportListingImagesDetails($id);
		
		
		$this->load->view('front/search/listing-detail',$data);
		
		
	}
	
	
	public function submit_request(){
	 $name = ($this->input->post('name')!="")?$this->input->post('name'):$this->session->userdata('bh_front_username');
		$email = ($this->input->post('email')!="")?$this->input->post('email'):$this->session->userdata('bh_front_email_id');
		$phone = ($this->input->post('phone')!="")?$this->input->post('phone'):$this->session->userdata('bh_front_mobile_number');
	
	  
	  
	   	if (count($this->cart->contents()) > 0){
			$now = strtotime($this->session->userdata('end_date')); // or your date as well
$your_date = strtotime($this->session->userdata('start_date'));
$datediff = $now - $your_date;

$days =  round($datediff / (60 * 60 * 24));
        
		 $sub_total = $this->session->userdata('sub_total');
		 $total = $this->session->userdata('grand_total');
		 $gst = get_tax($sub_total);
		 $eds = 'Yes';
		 
		 $payment_request_id =   ($this->session->userdata('payment_request_id')!="")?$this->session->userdata('payment_request_id'):'0';
		 $payment_status =   ($this->session->userdata('payment_status')!="")?$this->session->userdata('payment_status'):'0';
		 $payment_id =   ($this->session->userdata('payment_id')!="")?$this->session->userdata('payment_id'):'0';
		 $pay_by =   ($this->session->userdata('pay_by')!="")?$this->session->userdata('pay_by'):'Pay at Hotel';
			
		 
			 
		$order_data = array(
			
			'user_id' 	=> $this->session->userdata('bh_front_user_id'),
			'firstname' 	=> $name,
			'lastname' 	=> '',
			'email' 	=> $email,
			'telephone' 	=>  $this->session->userdata('bh_front_phone'),
			'coupon_code' 	=>  ($this->session->userdata('coupon_code')!='')?$this->session->userdata('coupon_code'):'0',
			'coupon_id' 	=>  ($this->session->userdata('coupon_id')!='')?$this->session->userdata('coupon_id'):'0',
			'discount_amount' 	=>  ($this->session->userdata('discount_amount')!='')?$this->session->userdata('discount_amount'):'0',
			'payment_request_id' 	=>  $payment_request_id,
			'payment_status' 	=>  $payment_status,
			'payment_id' 	=>  $payment_id,
			'pay_by' 	=>  $pay_by,
			'mobile' 	=> $this->session->userdata('bh_front_mobile'),
			
			'tax' 	=> $gst,
			'sub_total' 	=> $sub_total,
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
		 
		  if($order_id > 0){
         $all_date = date_range($this->session->userdata('start_date'),$this->session->userdata('end_date'));

		
		$flag = 'Yes';
	$i=1;
			foreach ($this->cart->contents() as $item):
			$product_data = $this->commonmod_model->GetProductListingDetails($item['id']);
			// Reduce Item Stock Quantity
				
			$total_price = 0;
			$end_date = $this->session->userdata('end_date');
							foreach ($all_date as $value) {
							if($value != $end_date){
							$CurrentDateRoomCharge =  $this->listing_model->getRoomPriceByCurrentDate($value,$item['id'],$item['listing_id'],$item['room_type'],$item['children'],$item['infant']); 
							if(!empty($CurrentDateRoomCharge)){
							$total_price = $total_price + $CurrentDateRoomCharge;
							}
							else{
								$total_price = $total_price + $item['price'];
							}
							}		
							}
			
			
			        $order_detail = array(
					'order_id' 		=> $order_id,
					'product_id' 	=> $item['listing_id'],
					'room_id' 	=> $item['id'],
					'type' 	=> 'No',
					'name' 	=> $item['name'],
					
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'category_id' 		=> $item['category_id'],
					'adults' 		=> $item['adults'],
					'children' 		=> $item['children'],
					'infant' 		=> $item['infant'],
					'adults_name1' 		=> $this->session->userdata('adults_name_1_'.$i),
					
					'adults_name2' 		=> $this->session->userdata('adults_name_2_'.$i),
					'adults_name3' 		=> $this->session->userdata('adults_name_3_'.$i),
					'children_name1' 		=>$this->session->userdata('children_name_1_'.$i),
					'children_name2' 		=> $this->session->userdata('children_name_2_'.$i),
					'deposite' 		=> $item['deposite'],
					'total' 		=> $total_price,
					'tax' 		=> ($tax*$item['qty'])
				);
				 	// Add Order History			
                 
				 // Add Order Product
                 $orderproduct_id = $this->checkout_model->InsertOrderProduct($order_detail);
			
			  $i++;
				
			endforeach;
			
			
			foreach ($all_date as $value) {
							if($value != $end_date){
							$CurrentDateRoomCharge =  $this->listing_model->updateInventoryHotel($value,$item['id'],$item['listing_id'],$item['room_type']); 
							
							}		
							}
							
							
							
		$orderhistory_id = $this->checkout_model->InsertOrderHistory($order_id,'1');
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
				$this->email->cc($Oneorder[0]['email']);
				//$this->email->bcc('ambuj@graphicsmerlin.com');

				$this->email->subject('New Order - #'.$order_id.' | '.WEBSITE_EMAIL_TITLE);
			
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				//$message .= '<p>Hi Admin, <br> '.$name.' have send order.</p>';
				foreach($AllorderproductList as $Allproducts) {
        					
        					
        					
        					$HotelData = $this->listing_model->GetSupportListingByID($Allproducts['product_id']);
	}
	
	$hotelmaildata = $this->commonmod_model->getSystemValue('hotel_mail_content');
	$resortsmaildata = $this->commonmod_model->getSystemValue('resorts_mail_content'); 
	$mail_content = ($HotelData[0]['hotel_type']=='Hotel')?($hotelmaildata):$resorts_mail_content;
	
	
				
				$message .= '
   				
<center>						
<table style="width:600px; font-family: Arial, Helvetica, sans-serif; color:#000000; font-size:14px; line-height:22px; padding: 6px 8px; border: 1px solid #000;">
	<tr>
		<td align="center"><img src="'.FRONT_DIR.'images/logo.png" alt="invoice-logo" width="80px"/></td>
	</tr>
	
	<tr>
		<td style="text-transform:uppercase; font-weight:bold;"><p style="margin-top:10px;">Dear '.$Oneorder[0]['firstname'].' '.$Oneorder[0]['lastname'].'</p></td>
	</tr>
	
	<tr>
		<td  style="text-align:center"><p style="margin-top:0px;">We thank you for choosing '.$HotelData[0]['listing_title'].' as your preferred hotel in '.get_city_name($HotelData[0]['city']).'. Below is a summary of your
booking and room information. We look forward to making your stay unique, comfortable and memorable</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Guest Name</td>
					<td style="border-bottom:1px solid #000; padding: 5px; text-transform:uppercase;">'.$Oneorder[0]['firstname'].' '.$Oneorder[0]['lastname'].'</td>						
				</tr>
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">E-Mail Id</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['email'].' </td>					
				</tr>
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Mobile/Telephone No</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['mobile'].' </td>					
				</tr>
				<tr style="display:none;">
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Company Name</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">CORPORATE TRIP</td>					
				</tr>
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Check In Date & Time</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.date("d/M/Y",strtotime($Oneorder[0]['start_date'])).' <span style="margin: 0 10px;">12.00</span></td>					
				</tr>';
				
				
					$now = strtotime($Oneorder[0]['end_date']); 
					$your_date = strtotime($Oneorder[0]['start_date']);
					$datediff = $now - $your_date;

					$days =  round($datediff / (60 * 60 * 24));
					
					
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Check Out Date & Time</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">
					'.date("d/M/Y",strtotime($Oneorder[0]['end_date'])).' <span style="margin: 0 10px;">12.00</span> <span style="margin: 0 10px;">No of Night</span> '.$days.'</td>					
				</tr>
				
				
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Confirmation No</td>	
		<td style="border-bottom:1px solid #000; padding: 5px; font-weight:bold">
		'.$Oneorder[0]['order_id'].'</td>					
				</tr>
				<tr>
					<td style="border-right:1px solid #000; padding: 5px;">Reservation status</td>	
					<td style="padding: 5px; font-weight:bold">'.$this->commonmod_model->GetOrderStatusType($Oneorder[0]['order_status_id']).'</td>					
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td style="font-weight:bold; font-size:15px;"><p style="margin-bottom: 8px;">Rate Information</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">';
				
				  $grand_total = 0; $i=0; foreach($AllorderproductList as $Allproducts) {
        					
        	$HotelData = $this->listing_model->GetSupportListingByID($Allproducts['product_id']);
        
        				
			$message .= '	<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Price Price</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.($Allproducts['total']).' </td>	
				</tr>
				
				<tr>				
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Room type</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">
					'.get_hotel_room_category($Allproducts['room_id']).'</td>	
				</tr>
				
				<tr style="display:none;">				
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Room Plan</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">CONTINENTAL PLAN</td>	
				</tr>';
				  $i++; }
				$message .= ' 
				
				
			</table>
		</td>
	</tr>
		
	<tr>
		<td style="font-weight:bold; font-size:15px;"><p style="margin-bottom: 8px;">Payment Information</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">';
			
			$message .= '	<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Pay By</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$pay_by.'</td>	
				</tr>';
				if($payment_id > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Payment ID</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$payment_id.'</td>	
				</tr>';
				}
				if($payment_status > 0){
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Payment Status</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$payment_status.'</td>	
				</tr>';
				}
				if($payment_request_id > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Payment Request ID</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$payment_request_id.'</td>	
				</tr>';
				}
				
				if($Oneorder[0]['tax'] > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Tax</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['tax'].'</td>	
				</tr>';
				}
				
				if($Oneorder[0]['discount_amount'] > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Coupon Applied ('.$Oneorder[0]['coupon_code'].'):</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['discount_amount'].'</td>	
				</tr>';
				}
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Grand Total</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['total'].'</td>	
				</tr>';
				
				
			$message .= '</table>
		</td>
	</tr>
			 
			 
	<tr>
		<td style="font-weight:bold; font-size:15px;"><p style="margin-bottom: 8px;">Room Information</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">No of Rooms </td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">SGL '.$i.' <span style="margin: 0 10px;">/ DBL 0</span> / TPL 0 </td>	
				</tr>
				
				<tr>				
					<td style="border-right:1px solid #000; padding: 5px;">No. of Occupants</td>	
					<td style="padding: 5px;"> 1 <span style="margin: 0 10px;">/ 0</span></td>	
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="font-weight:bold; font-size:16px;"><p style="margin-bottom: 8px; text-align:center;">Terms & Conditions</p></td>
	</tr>
	
	<tr>
		<td> 
		'.$mail_content.'
		</td>
		</tr>
		
</table>
</center> ';
 
				$this->email->message($message);
                $this->email->send();
			
		
			
		
		
		       $User_EmailId = $Oneorder[0]['email'];
			   
		         $this->session->set_userdata('order_id',$order_id);
				$this->session->unset_userdata('start_date');
				$this->session->unset_userdata('end_date');
				$this->session->unset_userdata('payment_request_id');
				$this->session->unset_userdata('payment_status');
				$this->session->unset_userdata('payment_id');
				$this->session->unset_userdata('sub_total');
				$this->session->unset_userdata('total');
				
				$this->session->unset_userdata('total_tax');
				
				$this->session->unset_userdata('coupon_code');
				$this->session->unset_userdata('coupon_id');
				$this->session->unset_userdata('discount_amount');
				$i=1;
			foreach ($this->cart->contents() as $item):
				$this->session->unset_userdata('adults_name_1_'.$i);
				$this->session->unset_userdata('adults_name_2_'.$i);
				$this->session->unset_userdata('adults_name_3_'.$i);
				$this->session->unset_userdata('children_name_1_'.$i);
				$this->session->unset_userdata('children_name_2_'.$i);
				$i++;
			 endforeach;
				$this->cart->destroy();
				if($pay_by=='Pay at Hotel'){
				     redirect(BASE_URL.'checkout/success_payathotel');
			   }else{
				 
				   redirect(BASE_URL.'checkout/success');
			   }
				
				
				
	}
	}else {
			      
						redirect(BASE_URL.'checkout/fail');
	}
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

			
             if(count($dates_available) > 0){
			 $this->session->set_flashdata('error',"Booking Date ".$startdate." to ".$enddate." is not available.");
			 redirect(BASE_URL.'listing-booking/'.$id.'/'.$category_id);
			 exit();
			 
			 }
			 if(strtotime($enddate) < strtotime($startdate)){
			  $this->session->set_flashdata('error',"Booking Date From can be greater than Boking Date To");
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
			
			$this->session->set_flashdata('error',"Your Account is created, Please check your email inbox,spam and approve your account");
			
			
					$this->session->set_flashdata('error',"Your Booking Enquiry is submitted successfully.");
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
