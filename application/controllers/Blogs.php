<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blogs extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		//

		$this->load->library('session');

		$this->load->helper('common');
		$this->load->helper('security');
		$this->load->library('email');
		$this->load->library('encryption');
		// Custom Ours

		$this->load->library('login');
		$this->load->library('image');
		// $this->login->check_login();	 
		$this->load->model('listing_model');
		$this->load->model('content_model');
		$this->load->model('blog_model');
		$this->load->model('commonmod_model');
		$this->load->database();
	}


	public function index()
	{
		// Load the Pagination Library
		$this->load->library('pagination');
		// Set pagination configuration
		$config['base_url'] = base_url('blogs');
		$config['total_rows'] = $this->get_total_rows(); // Total number of blogs
		$config['per_page'] = 15; // Number of blogs per page
		$config['uri_segment'] = 2; // Segment in URL containing the page number

		// Styling the pagination (optional)
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		// Initialize pagination
		$this->pagination->initialize($config);

		// Fetch blogs for the current page
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data['Blogs'] = $this->get_data($config['per_page'], $page);
		// Create pagination links
		$data['pagination_links'] = $this->pagination->create_links();
		$data['Content'] = $this->content_model->GetContentByID(28);
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		$data['RelatedBlogs'] = null;
		$data['RecentBlogs'] = null;
		$this->load->view('front/blogs/index', $data);
	}
	public function get_data($limit, $start)
	{
		$this->db->limit($limit, $start); // Apply limit and offset
		$query = $this->db->order_by('id', 'desc') // Corrected order_by method
			->get('bh_blogs'); // Query the 'bh_blogs' table
		return $query->result_array(); // Return the results as an array
	}
	public function get_tags_data($limit, $start, $tag)
	{
		// Use LIKE to search for the tag in the meta_keywords column
		$this->db->select('*');
		$this->db->from('bh_blogs');
		$this->db->like('meta_keywords', $tag);

		// Apply limit and offset (pagination)
		$this->db->limit($limit, $start);  // $limit is the number of rows, $start is the starting offset

		// Order by 'id' in descending order
		$this->db->order_by('id', 'desc');

		// Execute the query and return the results as an array
		$query = $this->db->get();
		return $query->result_array();  // Return the results as an array
	}


	public function get_total_rows()
	{
		$query = $this->db->get('bh_blogs'); // Replace 'your_table' with your table name
		return $query->num_rows(); // Get total rows
	}
	public function get_total_rows_of_tags($tag)
	{
		$this->db->select('*');
		$this->db->from('bh_blogs');
		$this->db->like('meta_keywords', $tag);
		// Execute the query and get the result object
		$query = $this->db->get();
		// Return the number of rows in the result set
		return $query->num_rows();
	}
	public function blog_single($urltitle)
	{
		// $ip = $this->input->ip_address();
		// $visit = $this->blog_model->addBlogVisitors($id,$ip);
		$new_urltitle = str_replace('-', ' ', $urltitle);
		$id = $this->blog_model->getBlogIdBySlug($new_urltitle);
		$id = $id[0]['id'];

		$data['allBlogVisitors'] = $this->blog_model->getBlogVisitors($id);
		$data['Content'] = $this->content_model->GetContentByID(28);
		$data['RelatedBlogs'] = $this->blog_model->getRelatedBlogs($id);
		$data['RecentBlogs'] = null;
		$data['BlogData'] = $this->blog_model->GetBlogByID($id);
		$data['RecentBlogs'] = $this->blog_model->getRecentBlogs();
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		$data['blog_id'] = $data['BlogData'][0]['category_id'];
		$id = $data['blog_id'];
		$data['category_name'] = $this->blog_model->getSingleCatName($id);
		// echo "<pre>";
		// print_r($data);
		// exit();
		$this->load->view('front/blogs/singleblog', $data);
	}
	public function tagsRelatedBlogs($tag)
	{
		$new_urltitle = str_replace('-', ' ', $tag);
		// Load the Pagination Library
		$this->load->library('pagination');
		// Set pagination configuration
		$config['base_url'] = base_url('blogs');
		$config['total_rows'] = $this->get_total_rows_of_tags($new_urltitle); // Total number of blogs
		$config['per_page'] = 15; // Number of blogs per page
		$config['uri_segment'] = 2; // Segment in URL containing the page number

		// Styling the pagination (optional)
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		// Initialize pagination
		$this->pagination->initialize($config);

		// Fetch blogs for the current page
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data['Blogs'] = $this->get_tags_data($config['per_page'], $page, $new_urltitle);
		// print_r($data['Blogs']);
		// Create pagination links
		$data['pagination_links'] = $this->pagination->create_links();

		// Load the view
		//$this->load->view('blogs_view', $data);
		$data['Content'] = $this->content_model->GetContentByID(28);
		// if ($this->input->post('search_key')) {
		// 	$data['Blogs'] = $this->blog_model->getALLBlogsBySearch();
		// } else {
		// 	$data['Blogs'] = $this->blog_model->getALLBlogsFront();
		// }
		// // $data['RecentBlogs'] =$this->blog_model->getRecentBlogs();
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		$data['RelatedBlogs'] = null;
		$data['RecentBlogs'] = null;
		// echo "<pre>";
		// print_r($data['All_BLOG_Category']);
		// exit();
		$this->load->view('front/blogs/tagsblogs', $data);
	}

	public function search()
	{
		$data['searckkey'] = $this->input->post('search_key');
		$data['Content'] = $this->content_model->GetContentByID(28);
		$data['Blogs'] = $this->blog_model->getALLBlogsBySearch();
		// echo "<pre>";
		// print_r($data['Blogs']);
		// exit();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		$this->load->view('front/blogs/category', $data);
	}

	public function archive($year, $month)
	{
		$data['year'] = $year;
		$data['month'] = $month;
		$data['Content'] = $this->content_model->GetContentByID(28);
		$data['Blogs'] = $this->blog_model->getALLBlogsByArchive($year, $month);
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		$this->load->view('front/blogs/category', $data);
	}

	public function category($catname)
	{
		$new_cat_name = str_replace('-', ' ', $catname);
		$category_id = $this->blog_model->getCatIdByName($new_cat_name);
		$category_id = $category_id[0]['id'];
		$data['Content'] = $this->content_model->GetContentByID(28);
		$data['CategoryData'] = $this->blog_model->GetBlogCategoryNameByID($category_id);
		if ($this->input->post('search_key')) {
			$data['Blogs'] = $this->blog_model->getALLBlogsBySearch();
		} else {
			$data['Blogs'] = $this->blog_model->getALLBlogsBycategoryId($category_id);
		}
		//$data['Blogs'] =  $this->blog_model->getALLBlogsBycategoryId($category_id);
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		// echo "<pre>";
		// print_r($data);
		// exit();
		$this->load->view('front/blogs/category', $data);
	}

}
