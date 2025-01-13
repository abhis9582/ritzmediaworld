<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Address_Model extends CI_Model {

public function GetUserSupportListing(){
         $this->db->select("*");
		$this->db->from('bh_address');	
	
		$this->db->where("user_id",$this->session->userdata('bh_front_user_id'));
		
		$this->db->order_by("address_id","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetSupportListingByID($id){
         $this->db->select("*");
		$this->db->from('bh_address');		
		$this->db->where("address_id",$id);
		$this->db->order_by("address_id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}

	
}