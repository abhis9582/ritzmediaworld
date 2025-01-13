<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class  Service_Model extends CI_Model {
	
// public function getALLBlogsFront(){
	
// 	  $this->db->select("*");
// 		$this->db->from('bh_blogs');		
// 		$this->db->order_by("id","asc");
// 		$this->db->where("status","1");
		
// 		$query=$this->db->get();
// 		return $query->result_array();
		
// }
public function getALLServices(){
	$this->db->select("*");
	$this->db->from('bh_services');		
	$this->db->order_by("id","asc");
	
	$query=$this->db->get();
	return $query->result_array();  
}

// public function getALLMonthBlogs(){
// 	  $sql = "SELECT DISTINCT YEAR(add_date) as year, MONTH(add_date) as month FROM bh_blogs where status='1' order by add_date asc";
// 	   $query = $this->db->query($sql);
		
		
// 		return $query->result_array();  
// }
// public function getALLBlogsBySearch(){
// 	    $search_key =  $this->input->post('search_key');
//          $this->db->select("*");
// 		$this->db->from('bh_blogs');		
			
// 		$this->db->where('status', "1");	
// 		$this->db->like('title', $search_key);	
// 		$this->db->like('description', $search_key);	
// 		$this->db->order_by("id","asc");
		
// 		$query=$this->db->get();
// 		return $query->result_array();  
// }


// public function getALLBlogsByArchive($year,$month){
// 	   $month =  $this->commonmod_model->getMonthID($month);
//         $this->db->select("*");
// 		$this->db->from('bh_blogs');		
			
// 		$this->db->like('add_date', date($year."-".$month), 'after');	
// 		$this->db->order_by("id","asc");
// 		$this->db->where("status","1");
		
// 		$query=$this->db->get();
// 		return $query->result_array();  
// }

// public function getALLBlogsBycategoryId($category_id){
//          $this->db->select("*");
// 		$this->db->from('bh_blogs');	 	
// 		$this->db->where("category_id",$category_id);
// 		$this->db->order_by("id","asc");
		
// 		$query=$this->db->get();
// 		return $query->result_array();  
// }


// public function GetBlogCategoryNameByID($id){
//          $this->db->select("*");
// 		$this->db->from('bh_blog_categories');		
// 		$this->db->where("id",$id);
// 		$this->db->order_by("id","desc");
		
// 		$query=$this->db->get();
// 		$userData = $query->row_array(); 
//         return $userData;
// }


public function GetServiceByID($id){
         $this->db->select("*");
		$this->db->from('bh_services');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}	

// public function getALLBlogCategoryWithBlog(){
//         $this->db->select("distinct(bh_blogs.category_id) as id,bh_blog_categories.category_name");
// 		$this->db->from('bh_blog_categories');		
// 		$this->db->join('bh_blogs','bh_blog_categories.id = bh_blogs.category_id','left outer');		
			
// 		$this->db->group_by("bh_blogs.category_id");
// 		$this->db->order_by("bh_blogs.id","asc");
// 		$this->db->order_by("bh_blogs.status","1");
		
// 		$query=$this->db->get();
// 		return $query->result_array();  
// } 




// public function getALLBlogFeaturedCategory(){
//         $this->db->select("bh_blog_categories.id as featured_category_id,bh_blog_categories.category_name");
// 		$this->db->from('bh_blog_categories');		
// 		$this->db->join('bh_blogs','bh_blog_categories.id = bh_blogs.category_id','left outer');		
// 		$this->db->where("bh_blog_categories.featured_status",'1');	
// 		$this->db->order_by("bh_blog_categories.id","asc");
		
// 		$query=$this->db->get();
// 		return $query->result_array();  
// }

// public function setHomePage($type,$blog_id=""){
// 	if($type=="unset"){
// 		$data2= array("set_home"=>'0');
		
// 		$this->db->update("bh_blogs",$data2);
// 	}else if($type=="set"){
// 		$updata= array("set_home"=>'1');
		
// 		$this->db->where("id",$blog_id);
// 		$this->db->update("bh_blogs",$updata);
	
// 	}
	
	


// }
// public function setBloghome(){
//          $this->db->select("*");
// 		$this->db->from('bh_blogs');		
// 		$this->db->where("status",'1');
// 		$this->db->where("set_home",'1');
// 		$this->db->order_by("id","desc");
		
// 		$query=$this->db->get();
// 		$userData = $query->result_array(); 
//         return $userData;
// }	

}