<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Payment_Model extends CI_Model {
	


public function getALLPayment(){
        $this->db->select("*");
		$this->db->from('bh_payments');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLPaymentById($id){
	if($id!=""){
         $this->db->select("*");
		$this->db->from('bh_payments');	 	
		$this->db->where("id",$id);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
	
		return $query->result_array();  
	}
	return false;
}








}