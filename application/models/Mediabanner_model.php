<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Mediabanner_Model extends CI_Model {
	

public function getALLImage(){
         $this->db->select("*");
		$this->db->from('bh_mediabanner');
		$this->db->where("img_type_id",'0');
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLImageFront(){
         $this->db->select("*");
		$this->db->from('bh_mediabanner');
		$this->db->where("img_type_id",'0');		
		$this->db->where("status","1");
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetImageByID($id){
         $this->db->select("*");
		$this->db->from('bh_mediabanner');
		$this->db->where("img_type_id",'0');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}


}