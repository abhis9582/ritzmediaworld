<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Howitworks_Model extends CI_Model {
	


public function getALLHowItworks(){
         $this->db->select("*");
		$this->db->from('bh_howitworks');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLHowItworksBycategoryId($category_id){
         $this->db->select("*");
		$this->db->from('bh_howitworks');	 	
		$this->db->where("category_id",$category_id);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function GetHowItworksCategoryNameByID($id){
        if($id=='1') return 'How It Works.';
        if($id=='2') return 'FAQ';
        if($id=='3') return 'Question And Answer';
        return false;
}


public function GetHowitworksByID($id){
         $this->db->select("*");
		$this->db->from('bh_howitworks');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}	





}