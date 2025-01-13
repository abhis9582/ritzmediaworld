<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog_Model extends CI_Model
{


	public function getALLBlogCategories()
	{
		$this->db->select("*");
		$this->db->from('bh_blog_categories');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getALLBlogsFront()
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->order_by("id", "desc");
		$this->db->where("status", "1");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getSingleCatName($id)
	{
		$this->db->select('*');
		$this->db->from('bh_blog_categories');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getOneBlogFront()
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->order_by("id", "desc");
		$this->db->where("status", "1");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getALLBlogs()
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getLatestBlogs()
	{
		$q = $this->db->select('*')
			->from('bh_blogs')
			->where('status', "1")
			->order_by("id", "desc")
			->get()->result_array();
		return $q;
	}

	public function getALLMonthBlogs()
	{
		$sql = "SELECT DISTINCT YEAR(add_date) as year, MONTH(add_date) as month FROM bh_blogs where status='1' order by add_date asc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getALLBlogsBySearch()
	{
		$search_key = $this->input->post('search_key');
		// $this->db->select("*");
		// $this->db->from('bh_blogs');		

		// $this->db->where('status', "1");	
		// $this->db->like('title', $search_key);	
		// $this->db->like('description', $search_key);	
		// $this->db->order_by("id","asc");

		// $query=$this->db->get();
		// return $query->result_array();  
		$q = $this->db->select('*')
			->from('bh_blogs')
			->where('status', "1")
			->where("(title LIKE '%" . $search_key . "%' OR description LIKE '%" . $search_key . "%')", NULL, FALSE)
			->get()->result_array();
		return $q;
	}

	public function getALLBlogsByArchive($year, $month)
	{
		$month = $this->commonmod_model->getMonthID($month);
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->like('add_date', date($year . "-" . $month), 'after');
		$this->db->order_by("id", "desc");
		$this->db->where("status", "1");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getALLBlogsBycategoryId($category_id)
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->where("category_id", $category_id);
		$this->db->order_by("id", "desc");

		$query = $this->db->get();
		return $query->result_array();
	}

	public function GetBlogCategoryNameByID($id)
	{
		$this->db->select("*");
		$this->db->from('bh_blog_categories');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");

		$query = $this->db->get();
		$userData = $query->row_array();
		return $userData;
	}


	public function GetBlogByID($id)
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}

	public function getALLBlogCategoryWithBlog()
	{
		$this->db->select("distinct(bh_blogs.category_id) as id,bh_blog_categories.category_name");
		$this->db->from('bh_blog_categories');
		$this->db->join('bh_blogs', 'bh_blog_categories.id = bh_blogs.category_id', 'left outer');
		$this->db->group_by("bh_blogs.category_id");
		$this->db->order_by("bh_blogs.id", "desc");
		$this->db->order_by("bh_blogs.status", "1");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function allCategoryList()
	{
		$this->db->select("*");
		$this->db->from('bh_blog_categories');
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getALLBlogFeaturedCategory()
	{
		$this->db->select("bh_blog_categories.id as featured_category_id,bh_blog_categories.category_name");
		$this->db->from('bh_blog_categories');
		$this->db->join('bh_blogs', 'bh_blog_categories.id = bh_blogs.category_id', 'left outer');
		$this->db->where("bh_blog_categories.featured_status", '1');
		$this->db->order_by("bh_blog_categories.id", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function setHomePage($type, $blog_id = "")
	{
		if ($type == "unset") {
			$data2 = array("set_home" => '0');
			$this->db->update("bh_blogs", $data2);
		} else if ($type == "set") {
			$updata = array("set_home" => '1');
			$this->db->where("id", $blog_id);
			$this->db->update("bh_blogs", $updata);
		}
	}

	public function setBloghome()
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->where("status", '1');
		$this->db->where("set_home", '1');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}

	public function addBlogVisitors($id, $ip)
	{
		$this->db->select('*');
		$this->db->from('bh_blog_visitors');
		$this->db->where('blog_id', $id);
		$result = $this->db->get()->result_array();
		$arr = json_decode($result[0]['ip_address']);
		$ser = in_array($ip, $arr);
		if ($ser) {
		} else {
			array_push($arr, $ip);
		}
		$arr = json_encode($arr);
		$data = array(
			'ip_address' => $arr
		);
		$this->db->where('blog_id', $id);
		$result = $this->db->update('bh_blog_visitors', $data);

		// $ip_add = $result[0]['ip_address'];
		// $arr_ip = json_decode($ip_add);
		// if($result == 0){
		// 	$data = array(
		// 		'blog_id' => $id,
		// 		'ip_address' => $ip
		// 	);

		// 	$this->db->insert('bh_blog_visitors',$data);
		// }
		return $result;
	}

	public function getRelatedBlogs($blog_id)
	{
		$this->db->select('*');
		$this->db->from('bh_blogs');
		$this->db->where('id', $blog_id);
		$result = $this->db->get()->result_array();
		$cat_id = $result[0]['category_id'];
		$this->db->select('id');
		$this->db->select('title');
		$this->db->select('slug_url');
		$this->db->select('blog_image1');
		$this->db->from('bh_blogs');
		$this->db->where('category_id', $cat_id);
		$record = $this->db->get()->result_array();
		return $record;
	}

	public function getBlogVisitors()
	{
		$this->db->select('*');
		$this->db->from('bh_blog_visitors');
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getRecentBlogs()
	{
		$this->db->select("*");
		$this->db->from('bh_blogs');
		$this->db->where("status", '1');
		$this->db->order_by("id", "desc");
		$this->db->limit(3);  // Limit the result to 6 rows
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}

	public function getDistinctPopularBlogs()
	{
		$this->db->distinct();
		$this->db->select('blog_id');
		$this->db->from('bh_blog_visitors');
		$record = $this->db->get()->result_array();

		// $arr = array();
		// foreach($record as $r){
		// 	$result = $this->getPopularBlogsCount($r['blog_id']);
		// 	$arr[$result] = $r['blog_id'];
		// }
		return $record;
	}

	// public function getPopularBlogsCount($val){
	// 	$this->db->select('*');
	// 	$this->db->from('bh_blog_visitors');
	// 	$this->db->where('blog_id',$val);
	// 	$result = $this->db->get()->num_rows();
	// 	return $result;
	// }

	// public function simple_to_associative($array) {
	// 	$new_array = [];
	// 	$i = 0;
	// 	$last_elem = end($array);
	// 	$nr_elems = count($array);
	// 	foreach ($array as $index=>$value) {
	// 		if($i % 2 == 0 && $last_elem == $value) {
	// 			$new_array[$value] = '';
	// 		} elseif($i % 2 == 0) {
	// 			$new_array[$value] = $array[$index + 1];
	// 		}
	// 		$i++;
	// 	}
	// 	return $new_array;
	// }

	public function getCatIdByName($catName)
	{
		$this->db->select('id');
		$this->db->from('bh_blog_categories');
		$this->db->where('category_name', $catName);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getBlogIdBySlug($url)
	{
		$this->db->select('id');
		$this->db->from('bh_blogs');
		$this->db->where('slug_url', $url);
		$result = $this->db->get()->result_array();
		return $result;
	}
}