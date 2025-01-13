<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	
	
	public function submitorder(){
		$flag = 'No';
		$Userdata = $this->user_model->UserByID($this->session->userdata('bh_front_user_id'));
		$payment_method = 'Cash On Delivery';
	if($this->input->post('payment_method')=='cod') { $payment_method = 'Cash On Delivery';  }
	if($this->input->post('payment_method')=='payumoney') { $payment_method = 'PayU Money';  }
	
	   $total = $this->checkout_model->getCartTotalAmount();
	   	if (count($this->cart->contents()) > 0):
		$order_data = array(
			
			'user_id' 	=> $this->session->userdata('bh_front_user_id'),
			'firstname' 	=> $Userdata[0]['first_name'],
			'lastname' 	=> $Userdata[0]['last_name'],
			'email' 	=> $Userdata[0]['email_id'],
			'telephone' 	=> $Userdata[0]['phone'],
			'mobile' 	=> $Userdata[0]['mobile'],
			'payment_firstname' 	=> $this->security->xss_clean($this->input->post('b_firstname')),
			'payment_lastname' 	=> $this->security->xss_clean($this->input->post('b_lastname')),
			'payment_country_id' 	=> $this->security->xss_clean($this->input->post('b_country_id')),
			'payment_state_id' 	=> $this->security->xss_clean($this->input->post('b_state_id')),
			'payment_city' 	=> $this->security->xss_clean($this->input->post('b_city')),
			'payment_address_1' 	=> $this->security->xss_clean($this->input->post('b_address_1')),
			'payment_address_2' 	=> $this->security->xss_clean($this->input->post('b_address_2')),
			'payment_postcode' 	=> $this->security->xss_clean($this->input->post('b_postcode')),
			'payment_method' 	=> $payment_method,
			'payment_code' 	=> $this->security->xss_clean($this->input->post('payment_method')),
			'shipping_firstname' 	=> $this->security->xss_clean($this->input->post('s_firstname')),
			'shipping_lastname' 	=> $this->security->xss_clean($this->input->post('s_lastname')),
			'shipping_country_id' 	=> $this->security->xss_clean($this->input->post('s_country_id')),
			'shipping_state_id' 	=> $this->security->xss_clean($this->input->post('s_state_id')),
			'shipping_city' 	=> $this->security->xss_clean($this->input->post('s_city')),
			'shipping_address_1' 	=> $this->security->xss_clean($this->input->post('s_address_1')),
			'shipping_address_2' 	=> $this->security->xss_clean($this->input->post('s_address_2')),
			'shipping_postcode' 	=> $this->security->xss_clean($this->input->post('s_postcode')),
			'total' 	=> $total,
			'currency_code' 	=> CURRENCY,
			'comment' 	=> $this->input->post('comment'),
			'date_added' => date('Y-m-d')
		);		

		$order_id = $this->checkout_model->InsertOrderData($order_data);
		$flag = 'Yes';
	
			foreach ($this->cart->contents() as $item):
			$product_data = $this->commonmod_model->GetProductListingDetails($item['id']);
			// Reduce Item Stock Quantity
				if($item['type']!="designpro"){
			$this->checkout_model->ReduceProductStock($item['id'],$item['qty']);
				}
			// Apply Tax On Product
			$tax = @$this->commonmod_model->ApplyTaxOnProduct($item['id'],$product_data[0]['tax_id']);
			$total_price = ($item['qty']) * ($item['price']);
			if($item['type']!="designpro"){
				$order_detail = array(
					'order_id' 		=> $order_id,
					'product_id' 	=> $item['id'],
					'type' 	=> 'product',
					'name' 	=> $product_data[0]['listing_title'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'total' 		=> $total_price,
					'tax' 		=> ($tax*$item['qty'])
				);
				 	// Add Order History			
                 $orderhistory_id = $this->checkout_model->InsertOrderHistory($order_id,'1');
				 // Add Order Product
                 $orderproduct_id = $this->checkout_model->InsertOrderProduct($order_detail);
			}else {
			        $order_detail = array(
					'order_id' 		=> $order_id,
					'product_id' 	=> $item['id'],
					'type' 	=> $item['type'],
					'name' 	=> $item['name'],
					'scents' 	=> @implode(",",$item['scents']),
					'addins' 	=> @implode(",",$item['addins']),
					'soap_label1' 		=> $item['soap_label1'],
					'soap_label2' 		=> $item['soap_label2'],
					'label_image' 		=> $item['label_image'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'total' 		=> $total_price,
					'tax' 		=> ($tax*$item['qty'])
				);
				 	// Add Order History			
                 $orderhistory_id = $this->checkout_model->InsertOrderHistory($order_id,'1');
				 // Add Order Product
                 $orderproduct_id = $this->checkout_model->InsertOrderProduct($order_detail);
			
			}				
                
				
			endforeach;
		endif;
		// send order email to admin
		if($flag=='Yes'){
		
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
				$message .= '<p>Hi Admin, <br> '.$Userdata[0]['first_name'].' have send order.</p>';
				
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
             <b>Mobile: </b> '.$Oneorder[0]['mobile'].'</td>
          </tr>
        </tbody>
      </table>
      <table class="table table-bordered table-hover" width="100%" style="border:1px solid #ddd; border-collapse: collapse;">
        <thead>
          <tr>
            <td class="text-left" style="width: 50%; border: 1px solid #ddd;padding: 8px;line-height: 1.42857143; vertical-align: top; font-weight:bold;">Payment Address</td>
            <td class="text-left" style="width: 50%; border: 1px solid #ddd;padding: 8px;line-height: 1.42857143; vertical-align: top; font-weight:bold;">Shipping Address</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left" style="border: 1px solid #ddd;padding: 8px;line-height: 1.42857143;">'.$Oneorder[0]['payment_firstname'].'
              '.$Oneorder[0]['payment_lastname'].'
              <br>
              '.$Oneorder[0]['payment_address_1'].'
              <br>
              '.$Oneorder[0]['payment_address_2'].'
              <br>
              '.$Oneorder[0]['payment_city'].'
              <br>
              '.$Oneorder[0]['payment_postcode'].'
			  <br>
            
              '.$this->commonmod_model->GetStateName($Oneorder[0]['payment_state_id']).'
              <br>
              '.$this->commonmod_model->GetCountryName($Oneorder[0]['payment_country_id']).'</td>
            <td class="text-left" style="border: 1px solid #ddd;padding: 8px;line-height: 1.42857143;">'.$Oneorder[0]['shipping_firstname'].'
              '.$Oneorder[0]['shipping_lastname'].'
              <br>
              '.$Oneorder[0]['shipping_address_1'].'
              <br>
              '.$Oneorder[0]['shipping_address_2'].'
              <br>
              '.$Oneorder[0]['shipping_city'].'
              <br>
              '.$Oneorder[0]['shipping_postcode'].'
              <br>
              '.$this->commonmod_model->GetStateName($Oneorder[0]['shipping_state_id']).'
              <br>
              '.$this->commonmod_model->GetCountryName($Oneorder[0]['shipping_country_id']).'</td>
          </tr>
        </tbody>
      </table>
      
      
        <table class="table table-bordered table-hover" width="100%" style="border: 1px solid #ddd;border-collapse: collapse;">
          <thead>
            <tr>
              <td class="text-left" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Product Name</td>
              <td class="text-left" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Model</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Quantity</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Price</td>
               <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Gst</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd; font-weight:bold; line-height: 1.42857143;">Total</td>
              
            </tr>
          </thead>
          <tbody>';
          
           $grand_total = 0; foreach($AllorderproductList as $Allproducts) {
			   if($item['type']!="designpro"){
            $message .= '<tr>
              <td class="text-left" style="padding:8px; border:1px solid #ddd;"> '.$Allproducts['name'].' <br>
                </td>
              <td class="text-left"  style="padding:8px; border:1px solid #ddd;">'.$Allproducts['model'].'</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd;">'.$Allproducts['quantity'].'</td>
              <td class="text-right" style="padding:8px ; border:1px solid #ddd;"><span class="WebRupee">'.CURRENCY.'&nbsp;</span>
			   '.number_format($Allproducts['price'],2).'</td>
               <td class="text-right" style="padding:8px; border:1px solid #ddd;">	'.CURRENCY.' '.$this->commonmod_model->GetTaxOnAdminProduct($Allproducts['order_product_id']).' </td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd;"><span class="WebRupee">'.CURRENCY.'&nbsp;</span>
			  '.number_format(($Allproducts['tax']+$Allproducts['total']),2).'</td>
              
              </tr>';
			   } else {
				   
			$message .= '<tr>
              <td class="text-left" style="padding:8px; border:1px solid #ddd;"> Base selection: '. $Allproducts['name'].' <br> Scents selection: '. $Allproducts['scents'].' <br> Addins selection: '.  $Allproducts['addins'].'<br> Soap label line 1: '.  $Allproducts['soap_label1'].' <br> Soap label line 2: '. $Allproducts['soap_label2'].' <br> Label image: '.  $Allproducts['label_image'].'
                </td>
              <td class="text-left"  style="padding:8px; border:1px solid #ddd;">'.$Allproducts['model'].'</td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd;">'.$Allproducts['quantity'].'</td>
              <td class="text-right" style="padding:8px ; border:1px solid #ddd;"><span class="WebRupee">'.CURRENCY.'&nbsp;</span>
			   '.number_format($Allproducts['price'],2).'</td>
               <td class="text-right" style="padding:8px; border:1px solid #ddd;">	'.CURRENCY.' '.$this->commonmod_model->GetTaxOnAdminProduct($Allproducts['order_product_id']).' </td>
              <td class="text-right" style="padding:8px; border:1px solid #ddd;"><span class="WebRupee">'.CURRENCY.'&nbsp;</span>
			  '.number_format(($Allproducts['tax']+$Allproducts['total']),2).'</td>
              
              </tr>';
				   
			   }
			 $grand_total = $grand_total + $Allproducts['total']+$Allproducts['tax'];
            
            } 
          $message .= '</tbody>
          <tfoot>
           
            <tr>
              <td colspan="4" style="padding:8px; background="#ddd;"></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;"><b>Total</b></td>
              <td class="text-right" style="padding:8px 8px 8px 15px; background:#ddd;">'.CURRENCY.' '.number_format(@$grand_total,2).'</td>
             
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

				$this->email->subject('Order is placed '.$order_id.' |'.WEBSITE_EMAIL_TITLE);
				$message = '<h2>'.WEBSITE_EMAIL_TITLE.'</h2>';
				$message .= '<p>Hi '.trim($this->input->post('name')).' you have successfully submitted  your order, <br> We will process order soon. </p>';
				

				$message .='<p>Thanks <br>
				'.WEBSITE_SIGNATURE.'
				</p>';

				$this->email->message($message);

				$this->email->send();
				
				
			
		}
		
	}
	
	public function InsertOrderData($insertdata){
		$this->db->insert('bh_order',$insertdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	
	}
	public function InsertOrderProduct($productdata){
		$insert_id = 0;
		if($productdata['quantity']!='0' && $productdata['quantity'] > 0){
	    $this->db->insert('bh_order_product',$productdata);
		$insert_id = $this->db->insert_id();
		}
		return $insert_id;
	
	}
	public function InsertOrderHistory($order_id,$order_status_id){
	$data = array("order_id"=>$order_id,"order_status_id"=>$order_status_id,"comment"=>'',
	"date_added"=>date("Y-m-d h:i:s"));
	    $this->db->insert('bh_order_history',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	public function GetUserAllAddress(){
	  $this->db->select("*");
		$this->db->from('bh_address');	
	
		$this->db->where("user_id",$this->session->userdata('bh_front_user_id'));
		
		$this->db->order_by("address_id","desc");
		
		$query=$this->db->get();
		$all_address =  $query->result_array(); 
		return $all_address;
       	
	}
	
	public function GetUserAddress($type){
	  $this->db->select("*");
		$this->db->from('bh_address');	
	
		$this->db->where("user_id",$this->session->userdata('bh_front_user_id'));
		
		$this->db->where("address_type",$type);
		$this->db->order_by("address_id","desc");
		
		$query=$this->db->get();
		$all_address =  $query->result_array(); 
		return $all_address;
       	
	}
	
	function getCartTotalAmount(){
		$grand_total = 0;
		$start_date = $this->session->userdata('start_date');
		$end_date = $this->session->userdata('end_date');
		$now = strtotime($end_date); // or your date as well
					$your_date = strtotime($start_date);
					$datediff = $now - $your_date;

					 $days =  round($datediff / (60 * 60 * 24));
					 
					$all_date = date_range($start_date,$end_date);
					
					
	if ($cart = $this->cart->contents()){
	$grand_total = 0; $i = 1;
						foreach ($cart as $item):
						$tax = $this->commonmod_model->ApplyTaxOnProduct($item['id'],'');
						  $tax_amount = $tax*$item['qty'];
						  
						  $total_charge = 0;
							foreach ($all_date as $value) {
							if($value != $end_date){
							$CurrentDateRoomCharge =  $this->listing_model->getRoomPriceByCurrentDate($value,$item['id'],$item['listing_id'],$item['room_type'],$item['children'],$item['infant']); 
							if(!empty($CurrentDateRoomCharge)){
							$total_charge = $total_charge + $CurrentDateRoomCharge;
							}else{
								$total_charge = $total_charge + $item['price'];
							}
							}		
							}
							$item['subtotal'] = $total_charge;
							
							
							
						   $grand_total = $grand_total + $item['subtotal']+$tax_amount;
						   endforeach;
	
	}
	return $grand_total;
	
	}
	
	public function ReduceProductStock($product_id,$quantity){
		if($product_id!=""){
	$productdata = $this->listing_model->GetSupportListingByID($product_id);
    $new_quantity = $productdata[0]['quantity'] - $quantity;
	$quantity_arr = array('quantity'=>$new_quantity);
	$this->db->where("id",$product_id);
	$this->db->update("bh_support_listings",$quantity_arr);
		}
	}

	
}