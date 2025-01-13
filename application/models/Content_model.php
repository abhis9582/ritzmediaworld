<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Content_Model extends CI_Model {
	
	public function GetALLContent(){
		$this->db->select("*");
		$this->db->from('bh_content');		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
	}

	public function GetContentByID($id){
		$this->db->select("*");
		$this->db->from('bh_content');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");		
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
		return $ContentData;
	}

	public function GetPolicy($url){
		$this->db->select("*");
		$this->db->from('bh_content');		
		$this->db->where("page_url",$url);	
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
		return $ContentData;
	}
	
	public function GetRefund($url){
		$this->db->select("*");
		$this->db->from('bh_content');		
		$this->db->where("page_url",$url);	
		$query=$this->db->get();
		$ContentData = $query->result_array(); 
		return $ContentData;
	}

	public function getMenuContent($url){
		$this->db->select('*');
		$this->db->from('bh_menu_list');
		$this->db->where('menu_url', $url);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getContentData($url){
		$this->db->select('*');
		$this->db->from('bh_content');
		$this->db->where('page_url', $url);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function GetAllWedding(){
	    $this->db->select("*");
		$this->db->from('bh_wedding');
		$this->db->order_by("id","desc");
		$query=$this->db->get();
		$WeddingData = $query->result_array(); 
	    return $WeddingData;
	}

	public function GetWeddingByID($id){
	    $this->db->select("*");
		$this->db->from('bh_wedding');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		$query=$this->db->get();
		$WeddingData = $query->result_array(); 
	    return $WeddingData;
	}

	public function GetAllEvent(){
	    $this->db->select("*");
		$this->db->from('bh_event');
		$this->db->order_by("id","desc");
		$query=$this->db->get();
		$EventData = $query->result_array(); 
	    return $EventData;
	}

	public function GetEventByID($id){
	    $this->db->select("*");
		$this->db->from('bh_event');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		$query=$this->db->get();
		$EventData = $query->result_array(); 
	    return $EventData;
	}
	
}