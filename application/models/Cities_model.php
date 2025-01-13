<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Cities_Model extends CI_Model {
	

public function getALLCity(){        $state_id = $_REQUEST['state_id'];
         $this->db->select("*");
		$this->db->from('cities');		        if($state_id !=""){
		$this->db->where("state_id",$state_id);		}		$this->db->order_by("id","asc");
		$query=$this->db->get();				
		return $query->result_array();  
}


public function GetCityByID($id){
         $this->db->select("*");
		$this->db->from('cities');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");        $query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

public function getALLourTeam(){
         $this->db->select("*");
		$this->db->from('bh_ourteam');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLourTeamFront(){
         $this->db->select("*");
		$this->db->from('bh_ourteam');		
		$this->db->order_by("id","asc");
		$this->db->where("status","1");
		
		$query=$this->db->get();
		return $query->result_array();  
}





public function getALLourTeamByCatID($category_id){
         $this->db->select("*");
		$this->db->from('bh_ourteam');		
		$this->db->order_by("id","asc");
		$this->db->where("category_id",$category_id);
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function getALLourTeamID($id){
         $this->db->select("*");
		$this->db->from('bh_ourteam');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

}