<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  User_Model extends CI_Model {
	

public function getALLUser(){
         $this->db->select("*");
		$this->db->from('bh_users');		
		$this->db->order_by("user_id","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function getALLUserByType($usertype){
	    $this->db->select("*");
		$this->db->from('bh_users');	
        $this->db->where("user_type",$usertype);		
		$this->db->order_by("user_id","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function GetAllRequest($userID){
	$this->db->select("*");
		$this->db->from('bh_request');	
        $this->db->where("user_id",$userID);		
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		return $query->result_array(); 
}


public function UserByID($user_id){
         $this->db->select("*");
		$this->db->from('bh_users');		
		$this->db->where("user_id",$user_id);
		$this->db->order_by("user_id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}


public function GetMySupportRandomListing(){
         $this->db->select("*");
		$this->db->from('bh_support_listings');	
		$this->db->where('status',"1");	
	     $this->db->limit(3,0);
		 $this->db->order_by('rand()');
		
		$query=$this->db->get();
		return $query->result_array();  
}	

public function GetMyNeedRandomListing(){
         $this->db->select("*");
		$this->db->from('bh_need_listings');	
		$this->db->where('status',"1");	
	     $this->db->limit(3,0);
		 $this->db->order_by('rand()');
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function setHomePage($type,$blog_id=""){
	if($type=="unset"){
		$data2= array("set_home"=>'0');
		
		$this->db->update("bh_users",$data2);
	}else if($type=="set"){
		$updata= array("set_home"=>'1');
		
		$this->db->where("user_id",$blog_id);
		$this->db->update("bh_users",$updata);
	
	}
	
	


}
public function setBloghome(){
         $this->db->select("*");
		$this->db->from('bh_users');		
		$this->db->where("status",'1');
		$this->db->where("set_home",'1');
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}	

}