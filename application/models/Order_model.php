<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Order_Model extends CI_Model {

public function GetsAllorder($user_id,$status_id=""){
         $this->db->select("*");
		$this->db->from('bh_order');	
		$this->db->where("user_id",$user_id);
		if($status_id!="")
		$this->db->where("order_status_id",$status_id);
		$this->db->order_by("order_id","desc");
		$query=$this->db->get();
		return $query->result_array();  
}
public function GetsAllorderAdmin(){
         $this->db->select("*");
		$this->db->from('bh_order');	
		
		$this->db->order_by("order_id","desc");
		$query=$this->db->get();
		return $query->result_array();  
}
public function GetOneorder($order_id){
         $this->db->select("*");
		$this->db->from('bh_order');	
		$this->db->where("order_id",$order_id);
		$this->db->order_by("order_id","desc");
		$query=$this->db->get();
		return $query->result_array();  
}
public function GetOrderListing($order_id){
         $this->db->select("*");
		$this->db->from('bh_order_product');	
		$this->db->where("order_id",$order_id);
		$this->db->order_by("order_product_id","desc");
		$query=$this->db->get();
		return $query->result_array();  
}
public function GetsingleOrderProduct($order_product_id){
         $this->db->select("*");
		$this->db->from('bh_order_product');	
		$this->db->where("order_product_id",$order_product_id);
		$this->db->order_by("order_product_id","desc");
		$query=$this->db->get();
		return $query->row_array();  
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


public function ShoworderHistory($id){
         $this->db->select("*");
		$this->db->from('bh_order_history');		
		$this->db->where("order_id",$id);
		$this->db->order_by("order_history_id","desc");
		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
        return $ContentData;
}




public function GetOneorderHistory($id){
		$this->db->select("*");
		$this->db->from('bh_order_history');		
		$this->db->where("order_history_id",$id);
		

		$query=$this->db->get();
		$ContentData = $query->result_array(); 
		return $ContentData;
}

	
}