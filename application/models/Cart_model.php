<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function update_cart($data) {
 		

		$this->cart->update($data);
	}
	
	function getNewCartId(){
	
		$this->db->select("MAX(id) as cart_id");
		$this->db->from('bh_temp_cart');		
		$this->db->order_by("id","asc");
		$this->db->limit(1);

		$query=$this->db->get();
		$data =  $query->row_array(); 
		return ($data['cart_id'] + 1);		
    }
	function CheckTemCartId($temp_cartid){
	$this->db->select("*");
		$this->db->from('bh_temp_cart');		
		$this->db->where("id",$temp_cartid);
		$this->db->order_by("id","asc");
		$this->db->limit(1);

		$query=$this->db->get();
		$data =  $query->row_array(); 
		return (($data['id'] > 0)?'1':'0');	
	
	}
}