<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Feedback_Model extends CI_Model {
	

public function getFeedback(){
         $this->db->select("*");
		$this->db->from('bh_feedbacks');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetFeedbackByID($id){
         $this->db->select("*");
		$this->db->from('bh_feedbacks');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}


}