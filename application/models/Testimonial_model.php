<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Testimonial_Model extends CI_Model {
	

public function getALLTestimonial(){
         $this->db->select("*");
		$this->db->from('bh_testimonial');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function getALLTestimonialFront(){
         $this->db->select("*");
		$this->db->from('bh_testimonial');		
		$this->db->order_by("rand()");
		$this->db->limit(4);
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetTestimonialByID($id){
         $this->db->select("*");
		$this->db->from('bh_testimonial');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}


}