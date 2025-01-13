<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Cart extends CI_Controller {

	
	public function __construct(){
		
	 parent::__construct();
	$this->load->library('form_validation');	
   $this->load->helper(array('form', 'url')); 	 
   $this->load->helper('cookie');
   $this->load->helper('common');
   //
  
    $this->load->library('session'); 
    $this->load->library('cart'); 
    $this->load->helper('security');
    $this->load->library('email');
	$this->load->library('encryption');
  // Custom Ours
  
     $this->load->library('login');   
    // $this->login->check_login();	 
     $this->load->model('cart_model');   
     $this->load->model('blog_model');   
     $this->load->model('user_model');   
     $this->load->model('commonmod_model');   
     $this->load->model('listing_model');   
     $this->load->database();   
	}


	public function index()
	{	
		$data['title'] = 'Shopping Carts';

		if (!$this->cart->contents()){
			$data['message'] = '<p>Your cart is empty!</p>';
		}else{
			$data['message'] = $this->session->flashdata('message');
		}

		$this->load->view('front/cart/cart', $data);
	}

	public function add()
	{
		$this->load->model('cart_model');
		
		$current_url = $this->security->xss_clean($this->input->post('current_url'));
		$id = $this->security->xss_clean($this->input->post('id'));
		$name = $this->security->xss_clean($this->input->post('name'));
		$listing_id = $this->security->xss_clean($this->input->post('listing_id'));
		$category_id = $this->security->xss_clean($this->input->post('category_id'));
		$room_type = $this->security->xss_clean($this->input->post('room_type'));
		$adults = $this->security->xss_clean($this->input->post('adults'));
		$children = $this->security->xss_clean($this->input->post('children'));
		$infant = $this->security->xss_clean($this->input->post('infant'));
		$room = $this->security->xss_clean($this->input->post('room'));
		
		$days = $this->session->userdata('days');
		$price = $this->security->xss_clean($this->input->post('price'));
					  
		
		
	   $quantity = '1'; 
	   $data= array(
			'id' => $id,
			'category_id' => $category_id,
			'listing_id' => $listing_id,
			'name' => $name,
			'price' => $price,
			'room_type' => $room_type,
			'adults' => $adults,
			'children' => $children,
			'infant' => $infant,
			'qty' =>  $quantity,
			'room' =>  $room,
			'options' =>  $room,
		);	

		$allpro_ids = array();
if(count($this->cart->contents()) > 0){ 
	foreach ($this->cart->contents() as $item){
	$allpro_ids[] = $item['id'];
	}
	//print_r($allpro_ids);
}



		$this->cart->insert($data);
			
		redirect($current_url);
	}
	
	function remove($rowid) {
		if ($rowid=="all"){
			$this->cart->destroy();
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
		}
		
		
	}	

	function update_cart(){
		
			$current_url = $this->input->post('current_url');
			
			$i=1;
 		foreach($_POST['cart'] as $id => $cart)
		{			
			
			$data = array("rowid"=>$cart['rowid'],"room_type"=>$cart['adults'],"adults"=>$cart['adults'],"children"=>$cart['children'],"infant"=>$cart['infant']);
			
			$this->cart_model->update_cart($data);
			
			$this->session->set_userdata('adults_name_1_'.$i, $cart['adults_name_1']);
			$this->session->set_userdata('adults_name_2_'.$i, $cart['adults_name_2']);
			$this->session->set_userdata('adults_name_3_'.$i, $cart['adults_name_3']);
			$this->session->set_userdata('children_name_1_'.$i, $cart['children_name_1']);
			$this->session->set_userdata('children_name_2_'.$i, $cart['children_name_2']);
			
		$i++; }
		
		
						
		if($this->input->post('make_discount')!='') {
			$coupon_code=trim($this->input->post('coupon_code'));
			if($coupon_code!=""){

	
			$discount_res          =  get_discount( $coupon_code);
				if(is_array($discount_res) && !empty($discount_res)) {
					
					$cart_total      = $this->session->userdata('grand_total');
					if($cart_total < $discount_res['minimum_order_amount'])	{
$this->session->set_flashdata('coupan_error',"Sub total amount is not greater or equal to minimum order amount (".$discount_res['minimum_order_amount'].").You can not use this coupon code.");

						redirect($current_url);
					}else{
						apply_coupon_code( $discount_res );
						redirect($current_url);
					}

				}else{
					
					$this->session->set_flashdata('coupan_error','Invalid coupon code');
					redirect($current_url);
				}
			}else{
				
				$this->session->set_flashdata('coupan_error','Please enter coupon code');
				redirect($current_url);
			}
			$data['discount_res']       = $discount_res;
		}

		
		
		
		
		redirect($current_url);
	}
	
	public function add_new_ajax(){
		
	$category_id =$this->input->post('category_id');
	
	if(count($this->cart->contents()) > 0){ 
	foreach ($this->cart->contents() as $item){
		if($category_id==trim($item['category_id']))
		{
		 $name = $item['name'];
		 $id = $item['id'];
		$listing_id = $item['listing_id'];
		$category_id = $item['category_id'];
		$room_type = 1;
		
		$option = mt_rand(9999,99999);
		
		$price = $item['price'];
		}
	}
	}
	
	    $data2= array(
			'id' => $id,
			'category_id' => $category_id,
			'listing_id' => $listing_id,
			'name' => $name,
			'price' => $price,
			'room_type' => 1,
			'adults' => 1,
			'children' => 0,
			'infant' => 0,
			'qty' =>  1,
			'room' =>  1,
			'options' =>  $option,
		);	
		
		
       
		$this->cart->insert($data2);
		exit;
		
	
	}
	


	public function add_ajax()
	{
		$this->load->model('cart_model');
		$quantity=1;
		$id = $this->security->xss_clean($this->input->post('id'));
		$name = $this->security->xss_clean($this->input->post('name'));
		$listing_id = $this->security->xss_clean($this->input->post('listing_id'));
		$category_id = $this->security->xss_clean($this->input->post('category_id'));
		$room_type = $this->security->xss_clean($this->input->post('room_type'));
		$adults = $this->security->xss_clean($this->input->post('adults'));
		$children = $this->security->xss_clean($this->input->post('children'));
		$infant = $this->security->xss_clean($this->input->post('infant'));
		$room = $this->security->xss_clean($this->input->post('room'));
		
		$days = $this->session->userdata('days');
		$price = $this->security->xss_clean($this->input->post('price'));
					  
		
		
	   $quantity = '1'; 
	   $data= array(
			'id' => $id,
			'category_id' => $category_id,
			'listing_id' => $listing_id,
			'name' => $name,
			'price' => $price,
			'room_type' => $room_type,
			'adults' => $adults,
			'children' => $children,
			'infant' => $infant,
			'qty' =>  $quantity,
			'room' =>  $room,
			'options' =>  $room,
		);	

		$allpro_ids = array();
if(count($this->cart->contents()) > 0){ 
	foreach ($this->cart->contents() as $item){
	$allpro_ids[] = $item['id'];
	}
	//print_r($allpro_ids);
}


foreach ($this->cart->contents() as $item){
			
	if(in_array($item['id'],$allpro_ids)){
		
			$cart['qty'] = 1;
			$amount = $price;
			
			//$this->cart_model->update_cart( $item['rowid'], $cart['qty'], $price, $amount);
			//echo $this->update_cart_ajax();
			//exit;
		
	}	
	}

		$this->cart->insert($data);
			
		echo $this->update_cart_ajax();
	}
	function countpro(){
	echo count($this->cart->contents());
	
	}
	
public function removepro(){
	$rowid = $this->input->post('rowid');
	$data = array(
	'rowid'   => $rowid,
	'qty'     => 0
	);

	$this->cart->update($data);
	echo $this->update_cart_ajax();
}	
	
	public function update_date(){
	     $start_date = ($this->input->post('start_date')!="")?$this->input->post('start_date'):$this->session->userdata('start_date');
		 $end_date = ($this->input->post('end_date')!="")?$this->input->post('end_date'):$this->session->userdata('end_date');
	  $this->session->set_userdata('start_date',$start_date);
	  $this->session->set_userdata('end_date',$end_date);
	  
	  $now = strtotime($end_date); // or your date as well
		$your_date = strtotime($start_date);
		$datediff = $now - $your_date;
      
		 $days =  round($datediff / (60 * 60 * 24)); 
		 $this->session->set_userdata('days',$days);
		 echo	$days2 = $days; 
	}
	
	public function update_cart_ajax(){
		 $start_date = ($this->input->post('start_date')!="")?$this->input->post('start_date'):$this->session->userdata('start_date');
		 $end_date = ($this->input->post('end_date')!="")?$this->input->post('end_date'):$this->session->userdata('end_date');
		
		$now = strtotime($end_date); // or your date as well
		$your_date = strtotime($start_date);
		$datediff = $now - $your_date;

		    $days =  round($datediff / (60 * 60 * 24)); 
			
			$all_date = date_range($start_date,$end_date);
			
		if(count(@$_POST['cart']) > 0){			
 		foreach(@$_POST['cart'] as $id => $cart)
		{			
			$price = $cart['price'];
			$cart['days']=$days;
			$cart['qty'] = 1;
			$amount = $price * $cart['days'];
			
			$this->cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
		}
		}
		
		
		
		
			echo form_open(BASE_URL.'cart/update_cart','id="formup"');
					$sub_total = 0; $i = 1;
					$grand_deposite = 0;
				
					echo $html = '
							
								<div class="right_head_bottom">
    					<table>
    		            <tr>
        					<th class="right_head">Room </th>
        					<th class="right_head">Room Type</th>
        					<th class="right_head">Amount</th> 
    					</tr>
    					</table>
					</div>';
					$error = array();
						$available_error = array();
							$total_adults = 0;
					$total_children = 0;
					$total_infant = 0;
					foreach ($this->cart->contents() as $item):
					
					
					$current_url = get_hotel_url($item['listing_id']);
					   $days = $this->session->set_userdata('days',$days);
					 //  $item['price'] = getProductPriceByDays($item['id'],$days);
							echo form_hidden('current_url', $current_url);	
						echo form_hidden('cart['. $i .'][qty]', $item['qty']);
						echo form_hidden('cart['. $i .'][id]', $i);
						echo form_hidden('cart['. $i .'][listing_id]', $item['listing_id']);
						echo form_hidden('cart['. $i .'][category_id]', $item['category_id']);
						echo form_hidden('cart['. $i .'][rowid]', $item['rowid']);
						echo form_hidden('cart['. $i .'][name]', $item['name']);
						echo form_hidden('cart['. $i .'][price]', $item['price']);
						
						echo form_hidden('cart['. $i .'][days]', $item['days']);
						
						echo form_hidden('cart['. $i .'][room_type]', $item['room_type']);
						echo form_hidden('cart['. $i .'][room]', $item['room']);
						echo form_hidden('cart['. $i .'][options]', $item['options']);
						
					
						$item['qty'] = 1;
						
							$total_charge = 0;
							$available_error2 = '';
							foreach ($all_date as $value) {
							if($value != $end_date){
								$CurrentDateRoomCharge =  $this->listing_model->getRoomPriceByCurrentDate($value,$item['id'],$item['listing_id'],$item['room_type'],$item['children'],$item['infant']); 


							$check_room_availablity = $this->listing_model->GetRoomAvailability($value,$item['id'],$item['listing_id'],$item['room_type']);
							if($check_room_availablity!=''){
								$available_error2 .= $check_room_availablity;
								$available_error[] = 1;
							}


							
							if(!empty($CurrentDateRoomCharge)){
							$total_charge = $total_charge + $CurrentDateRoomCharge;
							}else{
								$total_charge = $total_charge + $item['price'];
							}
							}		
							}
							
						
					        $quantval = "qty".$i;
							$totalmate = $item['adults']+$item['children'];
							$total_adults = $total_adults + $item['adults'];
							$total_children = $total_children + $item['children'];
							$total_infant = $total_infant + $item['infant'];
							if($totalmate > 3){
							$error[] = $totalmate;
							}
							
							echo $html = '
						
							<div class="right_head_bottom">
								<table>
									<tr style="background:#EEE;">
										
										<td>Room '.$i.'</td>
										<td>'.$item['name'].'</td>
										<td><i class="fa fa-rupee"></i> '.$total_charge.'</td>
										
									</tr>';
									echo $html = '<tr> 
    									<td><div class="Ad_box">Adults&nbsp;
    								<select id="adults_'.$i.'" name="cart['.$i.'][adults]" onchange="return setprice('.$i.',this.value);">';
    								for($j=1;$j<4;$j++){ 
    								if($j==$item['adults']) {  $sel ='selected="selected"';} else{ $sel ='';}
    								?>
    								<option value="<?=$j?>" <?=$sel;?>><?=$j?></option>
    								<?php }
    								echo '</select></div></td>
    								
    								<td><div class="Ad_box">Children&nbsp;
    								<select id="children_'.$i.'" name="cart['.$i.'][children]" >';
    								for($j=0;$j<3;$j++){ 
    								if($j==$item['children']) {  $sel ='selected="selected"'; } else{ $sel ='';}
    								?>
    								<option value="<?=$j?>" <?php echo $sel;?>><?=$j?></option>
    								<?php }
    								echo '
    								</select></div></td>
    								
    								<td><div class="Ad_box">Infant&nbsp;
    								<select id="infant_'.$i.'" name="cart['.$i.'][infant]">';
    								for($j=0;$j<3;$j++){ 
    								if($j==$item['infant']) {  $sel ='selected="selected"'; } else{ $sel ='';}
    								?>
    								<option value="<?=$j?>" <?=$sel;?>><?=$j?></option>
    								<?php }
    								echo '
    								</select></div></td>
								</tr>';
									if($totalmate > 3){
									echo $html = '<tr>
								<div class="more_error">We are sorry!<br />Available Rooms cannot Accommodate more then 3 Guests. So please add new room.</div>
										 
									</tr>';	
								}
								
								if(!empty($available_error2)){
									echo $html = '<tr>
										<div class="more_error">'.$available_error2.'</div>
									</tr>';	
								}
								
									
									
									
							echo $html ='</table>
							</div>
							<div class="btn_boxx"><i onclick="removePro(&#39;'.$item['rowid'].'&#39;,&#39;'.$i.'&#39;)"  title="Delete Room" class="fa fa-trash pkg_del" aria-hidden="true"></i>  <i class="fa fa-plus pkg_add" title="Add Another Room" onclick="add_ajax_another('.$i.','.$i.');"></i></div>
							'; 
							$room = (int)$item['adults'];
						
							
							
							$item['qty'] = 1;
							$item['subtotal'] = $total_charge;
							$i++;
							$sub_total = $sub_total + $item['subtotal'];
							
							
							
							 endforeach; 
					
							$tax = get_tax($sub_total);
							
							$grand_total = $sub_total + $tax;
							
							
							$this->session->set_userdata('sub_total',$sub_total);
							$this->session->set_userdata('total_tax',$tax);
							$this->session->set_userdata('grand_total',$grand_total);
							
					echo	$html ='
						
						
							<div class="row">
								<div class="col-md-12 col-sm-6 col-xs-6 row_padding">
								<div class="boxex-right">
								   <table>
								       <tr>
								            <td><span class="theme_color font_w ">Total Adults:  </span></td>
								            <td style="text-align:right;">
										    <span class="font_w18 ">'.$total_adults.'</span></td>
								        </tr>
										 <tr>
								            <td><span class="theme_color font_w ">Total Children:  </span></td>
								            <td style="text-align:right;">
										    <span class="font_w18 ">'.$total_children.'</span></td>
								        </tr>
										 <tr>
								            <td><span class="theme_color font_w ">Total Infant:  </span></td>
								            <td style="text-align:right;">
										    <span class="font_w18 ">'.$total_infant.'</span></td>
								        </tr><tr>
								            <td colspan="3"></td>
								        </tr>

										<tr>
								            <td><span class="theme_color font_w ">Sub Total:  </span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
										    <span class="font_w18 ">'.number_format(@$sub_total,2).'</span></td>
								        </tr>
								        <tr>
								            <td><span class="theme_color font_w ">Tax: </span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
									        <span class="font_w18 ">'.number_format(@$tax,2).'</span></td>
								        </tr>
								        <tr>
								            <td><span class="theme_color font_w ">Grand Total</span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
										    <span class="font_w18 ">'.number_format(@$grand_total,2).'</span></td>
								        </tr>
								    </table>
								</div>
								</div>
								
							</div>
							<button type="submit" class="booking_now"> Update Cart </button>
							
						';
							$listing_id = $item['listing_id'];
							$dates_available = $this->commonmod_model->checkHotelDatesIsAvailable($listing_id,$start_date,$end_date);
							
							
							 echo form_close(); 
								 
	if (count($this->cart->contents()) > 0  && count($available_error)==0 && count($error)==0  && (!empty($this->session->userdata('bh_front_user_id'))) && $days > 0){ 
								echo $html = '<div class="check_avilable">
								<button type="button" class="booking_now" onclick="SubmitRequest();"> Pay Now </button>

								</div>';
								
								if(count($dates_available) > 0) {
								echo $html = '<div class="check_avilable">
								<button type="button" class="booking_now" onclick="PayatHotel();"> Pay at Hotel</button>

								</div>';
								}
								
								

					 } else if(count($this->cart->contents()) > 0  && count($available_error)==0 && count($error)==0 && $days > 0) { 
				
					
					echo $html ='<ul class="cd-main-nav__list js-signin-modal-trigger tarrif_login">
				<!-- inser more l
				inks here -->
					
						<li><a data-toggle="modal" class="booking_now" data-target="#myModalLogin"> Book Now</a></li>
					
						</ul>';
			
						 } 
						
	}
	
}