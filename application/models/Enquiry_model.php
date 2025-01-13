<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Enquiry_Model extends CI_Model {
	

public function getALLEnquiry($type=""){
         $this->db->select("*");
		$this->db->from('bh_enquiry');		
		$this->db->order_by("id","desc");
		if($type!='')
		$this->db->where("etype",$type);
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLCareer(){
         $this->db->select("*");
		$this->db->from('bh_career');		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
}



}