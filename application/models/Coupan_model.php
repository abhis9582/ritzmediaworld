<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Coupan_Model extends CI_Model {
	

public function getALLCopuan(){
         $this->db->select("*");
		$this->db->from('wp_coupons');		
		$this->db->order_by("coupon_id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}




public function GetCoupanByID($id){
         $this->db->select("*");
		$this->db->from('wp_coupons');		
		$this->db->where("coupon_id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

}