<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Listing_Model extends CI_Model {
	
	
	
	
public function getNewsLetter(){
         $this->db->select("*");
		$this->db->from('bh_newsletter');		
		$this->db->order_by("id","asc");
		$query=$this->db->get();
		return $query->result_array();  
}
	
public function GetHotelPayByListingId($hotel_id){
	 $this->db->select("*");
		$this->db->from('bh_hotel_pay');
        
		$this->db->where("hotel_id",$hotel_id);
		
		$query=$this->db->get();
		return $query->result_array(); 
}


public function GetHotelDatesByID($id=""){
	$this->db->select("*");
		$this->db->from('bh_hotel_pay');
        
		$this->db->where("id",$id);
		 
		$query=$this->db->get();
		return $query->result_array(); 
}



public function GetALLSupportListing($type=""){
        $this->db->select("*");
		$this->db->from('bh_support_listings');
        if($type=='today'){
	    $this->db->like('add_date', date("Y-m-d"), 'after');
         }  
		$this->db->order_by("id","desc");
		 $this->db->where('status !=', '2');
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetAllAdminRequest($userID){
	$this->db->select("*");
		$this->db->from('bh_request');			
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		return $query->result_array(); 
}



public function GetCorporateRequest($id){
	    $this->db->select("*");
		$this->db->from('bh_request');			
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		return $query->result_array(); 
}


public function GetALLSupportListingAdmin($type=""){
        $this->db->select("*");
		$this->db->from('bh_support_listings');
        if($type=='today'){
	    $this->db->like('add_date', date("Y-m-d"), 'after');
         }
        		 
		$this->db->order_by("id","desc");
		$this->db->where('status !=', '3');
		$query=$this->db->get();
		return $query->result_array();  
}



public function getSpecialOfferOne($category_id,$offer_id){
	  $this->db->select("*");
		$this->db->from('bh_listing_images');	
		$this->db->where("category_id",$category_id);
		$this->db->where("id",$offer_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->row_array(); 
        return $ContentData;
}

public function getALLHotelImageByCategoryIds($category_id){
	  $this->db->select("*");
		$this->db->from('bh_listing_images');	
		$this->db->where("category_id",$category_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}

public function getALLHotelImageByCategory($id, $category_id){
	  $this->db->select("*");
		$this->db->from('bh_listing_images');		
		$this->db->where("listing_id",$id);
		$this->db->where("category_id",$category_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}

public function getALLHomeHotelImageByCategory($category_id){
	  $this->db->select("*");
		$this->db->from('bh_listing_images');		
		$this->db->where("listing_id > ",0);
		$this->db->where("category_id",$category_id);
		
		$this->db->order_by("id","desc");
		$this->db->limit(4);
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}


	
public function GetALLEnableCity(){
        $this->db->select("*");
		$this->db->from('cities');
        $this->db->order_by("name","desc");
		 $this->db->where('status ', '1');
		$query=$this->db->get();
		return $query->result_array();  
}




public function GetHotelRoomsListingByID($id){
         $this->db->select("*");
		$this->db->from('bh_hotel_rooms');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}


public function GetSupportListingHotelRoomByListingId($id){
	$this->db->select("*");
		$this->db->from('bh_hotel_rooms');		
		$this->db->where("listing_id",$id);
		$this->db->where("status","1");
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}


public function GetSupportListingHotelRoomByListingIdFront($id){
	$this->db->select("*");
		$this->db->from('bh_hotel_rooms');		
		$this->db->where("listing_id",$id);
		$this->db->where("status","1");
		$this->db->order_by("id","asc");
		
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}



public function GetSupportListingHotelRoomByCategoryIdFront($id){
	$this->db->select("*");
		$this->db->from('bh_hotel_rooms');		
		$this->db->where("category_id",$id);
		$this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}

public function GetRoomAvailability($room_date,$room_id,$hotel_id){
	       $this->db->select("*");
		$this->db->from('bh_hotel_room_availability');		
		$this->db->where("room_date",$room_date);
		$this->db->where("room_id",$room_id);
		$this->db->where("hotel_id",$hotel_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->row_array();  
		
		 if($ContentData['status']==0){
				 //$msg = 'No Room Available for date: '.date('d M,Y',strtotime($room_date)).'<br>';
				 $msg = 'No Room Available.';
			}else if(!empty($ContentData) && $ContentData['current_rooms'] > 0){
			$msg = '';
			}else{
				 $msg = 'No Room Available for date: '.date('d M,Y',strtotime($room_date)).'<br>';
				 $msg = 'No Room Available.';
			}			 

		 return $msg;
	  
}

public function updateInventoryHotel($room_date,$room_id,$hotel_id,$room_type){
	
	$query = $this->db->query("Update bh_hotel_room_availability set current_rooms = (current_rooms-1) where hotel_id = '".$hotel_id."' and room_id = '".$room_id."'  and room_date = '".$room_date."' ");
}


public function getRoomPriceByCurrentDate($room_date,$room_id,$hotel_id,$room_type,$children,$infant){
	
	    $this->db->select("*");
		$this->db->from('bh_hotel_room_availability');		
		$this->db->where("room_date",$room_date);
		$this->db->where("room_id",$room_id);
		$this->db->where("hotel_id",$hotel_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->row_array(); 
		// get hotel data
		$this->db->select("*");
		$this->db->from('bh_hotel_rooms');		
		$this->db->where("id",$room_id);
		$this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$HotelRoomData = $query->row_array(); 
	
		 $price = 0;
		if($children > 0) {  $price =  $price + $children * $HotelRoomData['children_price']; }
		if($infant > 0) { $price = $price + $infant * $HotelRoomData['infant_price']; }
		
	
		
		if(!empty($ContentData)){
			if($room_type==3) { $price = $price + $ContentData['price2'] + $HotelRoomData['price3']; }
			else {
			 $price = $price + $ContentData['price'.$room_type];
			}			 

		 return $price;
			
		}
       
	     else {
			if($room_type==3) { $price = $price + $HotelRoomData['price2'] +  $HotelRoomData['price3']; }
			else {
			 $price = $price + $HotelRoomData['price'.$room_type];
			}			 
		
		 return $price;
		 }
}

public function checkInventoryTableData($cmonth,$cyear, $hotel_id){
        $this->db->select("*");
		$this->db->from('bh_hotel_room_availability');		
		$this->db->where("YEAR(room_date)",$cyear);
		$this->db->where("MONTH(room_date)",$cmonth);
		
		$this->db->where("hotel_id",$hotel_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
		
        return $ContentData;

}

public function GetInventoryTableData($room_date,$room_id, $hotel_id){
	    $this->db->select("*");
		$this->db->from('bh_hotel_room_availability');		
		$this->db->where("room_date",$room_date);
		$this->db->where("room_id",$room_id);
		$this->db->where("hotel_id",$hotel_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->row_array(); 
		
        return $ContentData;
}

public function GetHotelRoomPriceListingByID($id){
	    $this->db->select("*");
		$this->db->from('bh_hotel_room_availability');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;

}
public function GetHotelRoomAvailabilityByListingId($listing_id, $category_id){
	    $this->db->select("*");
		$this->db->from('bh_hotel_room_availability');		
		$this->db->where("category_id",$category_id);
		$this->db->where("listing_id",$listing_id);
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}

public function GetSupportListingHotelRoomByCategoryId($id,$category_id){
	$this->db->select("*");
		$this->db->from('bh_hotel_rooms');		
		$this->db->where("listing_id",$id);
		$this->db->where("category_id",$category_id);
		$this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}


public function GetALLSupportListingByCategoryId($category_id=""){
        $this->db->select("*");
		$this->db->from('bh_support_listings');
       
	   if($category_id!="")
		$where2 = "FIND_IN_SET('".$category_id."', category_id)";  
         $this->db->where('status !=', '2');
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
}
public function GetUserSupportListing(){
         $this->db->select("*");
		$this->db->from('bh_support_listings');	
	
		$this->db->where("user_id",$this->session->userdata('bh_front_user_id'));
		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
}




public function GetALLSupportListingArchive(){
        $this->db->select("*");
		$this->db->from('bh_support_listings');
       
		$this->db->order_by("id","desc");
		$this->db->where('status', '2');
		$query=$this->db->get();
		return $query->result_array();  
}



public function GetSupportListingByID($id){
         $this->db->select("*");
		$this->db->from('bh_support_listings');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}
public function GetSupportListingImagesDetails($id){
         $this->db->select("*");
		$this->db->from('bh_listing_images');		
		$this->db->where("listing_id",$id);
		$this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}


public function GetOthersCategoryByID($id){
         $this->db->select("*");
		$this->db->from('bh_others_categories');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

public function GetOthersParentCategorys($type){
         $this->db->select("*");
		$this->db->from('bh_others_categories');		
		$this->db->where("category_type",$type);
		$this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

public function getALLFeaturedProducts(){
         $this->db->select("*");
		$this->db->from('bh_support_listings');		
		
		$this->db->where('status', '1');
		$this->db->where('new_status =', '1');
		
		$this->db->order_by("add_date","desc");
		$this->db->limit(12);
		$query=$this->db->get();
		return $query->result_array();  
} 

public function getALLSalesProducts(){
			$this->db->select("*");
			$this->db->from('bh_support_listings');	
			$this->db->where('discount_enable', '1');
			$this->db->where('discount_price !=', '');		
			$this->db->order_by("id","asc");
			$this->db->limit(6);

			$query=$this->db->get();
		return $query->result_array();  
}

/*  Front End Function */



public function GetAllSupportStatesIDSearch($category_id="",$type){
	if($type=="Support"){
         $this->db->select("distinct(state) as state");
		$this->db->from('bh_support_listings');	
         if($category_id)		
		$this->db->where("category_id",$category_id);
	  
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
	}else if($type=="Need"){
         $this->db->select("distinct(state) as state");
		$this->db->from('bh_need_listings');	
         if($category_id)		
		$this->db->where("category_id",$category_id);
	    $this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
	}
	
        return $ContentData;
}


public function GetAllSupportCityIDSearch($category_id="",$state_id="",$type){
	if($type=="Support"){
         $this->db->select("distinct(city) as city");
		$this->db->from('bh_support_listings');	
         if($category_id)		
		$this->db->where("category_id",$category_id);
	   if($state_id)		
		$this->db->where("state",$state_id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
	}else if($type=="Need"){
         $this->db->select("distinct(city) as city");
		$this->db->from('bh_need_listings');	
         if($category_id)		
		$this->db->where("category_id",$category_id);
	   if($state_id)		
		$this->db->where("state",$state_id);
	  $this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
	}
	
        return $ContentData;
}


public function GetAllSupportPincodeIDSearch($category_id="",$city_id="",$type){
	if($type=="Support"){
         $this->db->select("distinct(pincode) as pincode");
		$this->db->from('bh_support_listings');	
         if($city_id)		
		$this->db->where("city",$city_id);
	    if($category_id)		
		$this->db->where("category_id",$category_id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
	} else if($type=="Need"){
          $this->db->select("distinct(pincode) as pincode");
		$this->db->from('bh_need_listings');	
        if($city_id)		
		$this->db->where("city",$city_id);
	    if($category_id)		
		$this->db->where("category_id",$category_id);
	    $this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array();
	}
	
        return $ContentData;
}



public function getCountSupportNo($category_id,$state_id="",$city_id="",$pincode=""){
		$this->db->select("count(id) as total");
		$this->db->from('bh_support_listings');
		 if($category_id)		
		$this->db->where("category_id",$category_id);
	    if($state_id)		
		$this->db->where("state",$state_id);
	    if($city_id)		
		$this->db->where("city",$city_id);
	    if($pincode)		
		$this->db->where("pincode",$pincode);
	    $this->db->where("status","1");
		$this->db->order_by("id","asc");
		$query=$this->db->get();
		$userData = $query->result_array(); 
		return $userData[0]['total'];
}



public function getCountNeedNo($category_id,$state_id="",$city_id="",$pincode=""){
		$this->db->select("count(id) as total");
		$this->db->from('bh_need_listings');
		 if($category_id)		
		$this->db->where("category_id",$category_id);
	    if($state_id)		
		$this->db->where("state",$state_id);
	    if($city_id)		
		$this->db->where("city",$city_id);
	    if($pincode)		
		$this->db->where("pincode",$pincode);
	     $this->db->where("status","1");
		$this->db->order_by("id","asc");
		$query=$this->db->get();
		$userData = $query->result_array(); 
		return $userData[0]['total'];
}

public function getAllTmpUrl($urltitle="",$category_id="",$state_id="",$city_id="",$pincode=""){
		$html='';
		if($urltitle!="")
		$html .='/'.trim($urltitle);
		if($category_id!="")
		$html .='/'.$category_id;
		if($state_id!="")
		$html .='/'.$state_id;
		if($city_id!="")
		$html .='/'.$city_id;
		if($pincode!="")
		$html .='/'.$pincode;

		return $html;


}



public function GetSingleListingImages($id){

  $this->db->select("*");
		$this->db->from('bh_listing_images');
       
		$this->db->where("id",$id);	
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array(); 
}

public function GetSupportListingImagesByListingId($id){
            $this->db->select("*");
		$this->db->from('bh_listing_images');
       
		$this->db->where("listing_id",$id);	
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
	}
	
	public function GetSupportListingImagesByCategoryId($id,$category_id=""){
            $this->db->select("*");
		$this->db->from('bh_listing_images');
       
		$this->db->where("listing_id",$id);	
		if($category_id)
		$this->db->where("category_id",$category_id);	
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
	}
	

	public function GetBookedDates($id,$category_id=""){
		$bookingDates = array();
		$this->db->select('booking_date_to, booking_date_from');
		$this->db->from('bh_bookings');

		$this->db->where('category_id',$category_id);
		$this->db->where('listing_id',$id);
		$this->db->where('booking_date_to !=',"0000-00-00 00:00:00");
		$this->db->where('booking_date_from !=',"0000-00-00 00:00:00");
		$this->db->where('status',"Booked");
		$query = $this->db->get()->result_array();

		if(count($query) > 0){
			for($i=0;$i<count($query);$i++){
				if($query[$i]['booking_date_to']==$query[$i]['booking_date_from']){ 
				  $booking_Dates = date("d-m-Y",strtotime($query[$i]['booking_date_from']));
				  $bookingDates[] = $this->commonmod_model->RemoveZeroFromMONTH($booking_Dates);
				} 

               else if($query[$i]['booking_date_to']!=$query[$i]['booking_date_from']){ 
				  $countdays = $this->commonmod_model->getNoOfDays($query[$i]['booking_date_from'],$query[$i]['booking_date_to']);

				  $start_date = strtotime($query[$i]['booking_date_from']);
				  $end_date = strtotime($query[$i]['booking_date_to']);
				  // Loop between timestamps, 24 hours at a time
				      for ( $i = $start_date;  $i <= $end_date; $i = $i + 86400 ) {
				      $booking_Dates = date( 'd-m-Y', $i ); 
				       $bookingDates[] = $this->commonmod_model->RemoveZeroFromMONTH($booking_Dates);
				     }

				}

			}
		}
		return $bookingDates;
	}
	
	
}