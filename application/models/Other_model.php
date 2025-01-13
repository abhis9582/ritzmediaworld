<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Other_Model extends CI_Model {
	

public function getALLOthersCategories(){
         $this->db->select("*");
		$this->db->from('bh_others_categories');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
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



}