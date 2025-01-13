<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Gallery_Model extends CI_Model {
	

public function getALLImage(){
         $this->db->select("*");
		$this->db->from('bh_gallery');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}




public function getALLImageCategory($id){
         $this->db->select("*");
		$this->db->from('bh_gallery');		
		$this->db->where("category_id",$id);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLImageCategoryFront($id){
         $this->db->select("*");
		$this->db->from('bh_gallery');
		$this->db->where("category_id",$id);
		$this->db->where("status",1);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}



public function getALLImageFront(){
         $this->db->select("*");
		$this->db->from('bh_gallery');		
		$this->db->order_by("id","asc");
		$this->db->where("status","1");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetImageByID($id){
         $this->db->select("*");
		$this->db->from('bh_gallery');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
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



public function getALLourTeamByCatID($category_id){
         $this->db->select("*");
		$this->db->from('bh_ourteam');		
		$this->db->order_by("id","asc");
		$this->db->where("category_id",$category_id);
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function getALLourTeamByCatIDFRont($category_id){
         $this->db->select("*");
		$this->db->from('bh_ourteam');		
		$this->db->order_by("id","asc");
		$this->db->where("status","1");
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