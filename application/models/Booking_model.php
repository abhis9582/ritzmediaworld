<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Booking_Model extends CI_Model {
	


public function getALLBooking($status=""){
         $this->db->select("*");
		$this->db->from('bh_bookings');		
		$this->db->order_by("id","asc");
		if($status!="")
		$this->db->where("status",$status);
		$query=$this->db->get();
		return $query->result_array();  
}


public function GetBookingByOwnwerId($owner_id,$status=""){
         $this->db->select("*");
		$this->db->from('bh_bookings');	 	
		$this->db->where("listing_owner_id",$owner_id);
		if($status!="")
		$this->db->where("status",$status);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}
public function GetBookingByBookedId($booked_id,$status=""){
         $this->db->select("*");
		$this->db->from('bh_bookings');	 	
		$this->db->where("booked_by",$booked_id);
		if($status!="")
		$this->db->where("status",$status);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function getALLBookingsBycategoryId($category_id){
         $this->db->select("*");
		$this->db->from('bh_bookings');	 	
		$this->db->where("category_id",$category_id);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}





public function GetBookingsByID($id){
         $this->db->select("*");
		$this->db->from('bh_bookings');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}	





}