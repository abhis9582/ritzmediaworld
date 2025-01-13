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
		$this->load->helper('security');
		$this->load->library('email');
		$this->load->library('encrypt');
		// Custom Ours

		$this->load->library('login');
		$this->load->library('image');
		$this->login->check_login();
		$this->load->model('blog_model');
		$this->load->model('commonmod_model');
		$this->load->database();
	}


	public function index()
	{
		$data['Blogs'] = $this->blog_model->getALLBlogs();
		$this->load->view('admin/blogs/index', $data);
	}

	public function category($id)
	{
		$data['category_id'] = $id;
		$data['Blogs'] = $this->blog_model->getALLBlogsBycategoryId($id);
		$this->load->view('admin/blogs/index', $data);
	}

	public function add()
	{
		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			$config = array(
				array('field' => 'category_id', 'label' => 'Blog Category', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'slug_url', 'label' => 'Blog URL', 'rules' => 'trim|required|xss_clean|is_unique[bh_blogs.slug_url]'),
				array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'meta_title', 'label' => 'Meta Title', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'meta_description', 'label' => 'Meta Description', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'meta_keywords', 'label' => 'Meta Keywords', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'status', 'label' => 'Meta Keywords', 'rules' => 'trim|required|xss_clean')
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/blogs/add');
			} else {
				$arr = array();
				$arr[0] = $this->input->post('y1_width');
				$arr[1] = $this->input->post('y1_height');
				$json = json_encode($arr);

				// Add new User Details
				$data = array(
					'category_id' => $this->input->post('category_id'),
					'title' => $this->input->post('title'),
					'slug_url' => $this->input->post('slug_url'),
					'youtube_video' => $this->input->post('youtube_video'),
					'description' => $this->input->post('description'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'meta_keywords' => $this->input->post('meta_keywords'),
					'alt_tag' => $this->input->post('alt_tag'),
					'y1_size' => $json,
					// 'description2' => $this->input->post('description2'),
					// 'description3' => $this->input->post('description3'),
					// 'description4' => $this->input->post('description4'),
					// 'description5' => $this->input->post('description5'),
					// 'description6' => $this->input->post('description6'),
					// 'description7' => $this->input->post('description7'),
					// 'description8' => $this->input->post('description8'),
					// 'description9' => $this->input->post('description9'),
					// 'description10' => $this->input->post('description10'),
					// 'description11' => $this->input->post('description11'),
					'add_date' => date("Y-m-d h:i:s"),

					'status' => $this->input->post('status')
				);
				// echo "<pre>";
				// print_r($data);
				// exit();

				$this->db->insert('bh_blogs', $data);
				$insert_id = $this->db->insert_id();
				// Add new Page Image
				for ($k = 1; $k <= 11; $k++) {
					if ($_FILES['blog_image' . $k]['name']) {
						$error_view_url = 'admin/user/edit';
						$FileName = $this->commonmod_model->uploadCommonFile('./webroot/images/original/', './webroot/images/blogs/', '3048', '0', '0', 'blog_image' . $k, $error_view_url);
						if ($FileName != '') {
							$upd_data = array(
								"blog_image" . $k => $FileName
							);
							$this->db->where('id', $insert_id);
							$this->db->update('bh_blogs', $upd_data);
						}
					}
				}

				for ($k = 1; $k <= 11; $k++) {
					if ($this->input->post('description' . $k)) {
						$upd_data = array(
							"description" . $k => $this->input->post('description' . $k)
						);
						$this->db->where('id', $insert_id);
						$this->db->update('bh_blogs', $upd_data);
					}
				}

				//$User_id = $this->db->insert_id();
				$this->update_sitemap();
				$this->session->set_flashdata('success', "Blog Added");
				redirect(BASE_URL . 'admin/blogs');
			}
		} else {
			$this->load->view('admin/blogs/add');
		}
	}

	// Get the latest blog post to add to the sitemap
	public function get_last_blog_post()
	{
		$this->db->select('slug_url, add_date');
		$this->db->order_by('add_date', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('bh_blogs');
		return $query->row_array();
	}
	// update sitemap.xml
	public function update_sitemap()
	{
		// Get the latest blog post
		$post = $this->get_last_blog_post();

		if ($post) {
			// Prepare the new blog post URL and lastmod date
			$slug_url = strtolower(str_replace(' ', '-', $post['slug_url'])); // Replace spaces with hyphens and convert to lowercase
			$url = base_url('blog/' . $slug_url); // Assuming URL structure is like /blog/{slug}
			$lastmod = date('Y-m-d', strtotime($post['add_date']));

			// Path to the sitemap file
			$sitemap_file = FCPATH . 'sitemap.xml';

			// Check if the sitemap file exists
			if (file_exists($sitemap_file)) {
				// Read the file content
				$sitemap_content = file_get_contents($sitemap_file);

				// Check if <urlset> exists in the file
				if (strpos($sitemap_content, '<urlset') === false) {
					// If <urlset> doesn't exist, create it
					$sitemap_content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n" . $sitemap_content;
				}

				// Check if the closing </urlset> tag exists
				if (strpos($sitemap_content, '</urlset>') === false) {
					// If no </urlset>, append it to the content (in case it's an incomplete file)
					$sitemap_content .= "\n</urlset>";
				}

				// Add the new URL entry before the closing </urlset> tag
				$new_url_entry = "    <url>\n";
				$new_url_entry .= "        <loc>{$url}</loc>\n";
				$new_url_entry .= "        <lastmod>{$lastmod}</lastmod>\n";
				$new_url_entry .= "        <priority>0.8</priority>\n";
				$new_url_entry .= "    </url>\n";

				// Insert the new URL entry right before the closing </urlset> tag
				$sitemap_content = str_replace('</urlset>', $new_url_entry . '</urlset>', $sitemap_content);

				// Write the updated content back to the sitemap file
				file_put_contents($sitemap_file, $sitemap_content);
			}
		}
	}
	public function edit($id)
	{
		$data['BlogsData'] = $this->blog_model->GetBlogByID($id);
		if ($id == "") {
			$this->session->set_flashdata('error', "Incorrect Url");
			redirect(BASE_URL . 'admin/blogs');
		}
		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			if ($data['BlogsData'][0]['slug_url'] == $this->input->post('slug_url')) {
				$config = array(
					array('field' => 'category_id', 'label' => 'Blog Category', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'slug_url', 'label' => 'Blog URL', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'meta_title', 'label' => 'Meta Title', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'meta_description', 'label' => 'Meta Description', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'meta_keywords', 'label' => 'Meta Keywords', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'status', 'label' => 'Status', 'rules' => 'trim|required|xss_clean')
				);
			} else {
				$config = array(
					array('field' => 'category_id', 'label' => 'Blog Category', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'slug_url', 'label' => 'Blog URL', 'rules' => 'trim|required|xss_clean|is_unique[bh_blogs.slug_url]'),
					array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'meta_title', 'label' => 'Meta Title', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'meta_description', 'label' => 'Meta Description', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'meta_keywords', 'label' => 'Meta Keywords', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'status', 'label' => 'Status', 'rules' => 'trim|required|xss_clean')
				);
			}



			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/blogs/edit', $data);
			} else {
				$arr = array();
				$arr[0] = $this->input->post('y1_width');
				$arr[1] = $this->input->post('y1_height');
				$json = json_encode($arr);

				// echo "<pre>";
				// print_r($arr);
				// exit();
				// Edit new User Details
				$upd_data = array(
					'category_id' => $this->input->post('category_id'),
					'title' => $this->input->post('title'),
					'slug_url' => $this->input->post('slug_url'),
					'img1_size' => $this->input->post('img1_size'),
					'youtube_video' => $this->input->post('youtube_video'),
					'y1_size' => $json,
					'description' => $this->input->post('description'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'meta_keywords' => $this->input->post('meta_keywords'),
					'updated_date' => date("Y-m-d h:i:s"),

					'status' => $this->input->post('status')
				);

				$this->db->where('id', $id);
				$this->db->update('bh_blogs', $upd_data);

				// edit blog Image
				// Add new Page Image
				for ($k = 1; $k <= 1; $k++) {
					if ($_FILES['blog_image' . $k]['name']) {
						$error_view_url = 'admin/user/edit';
						$FileName = $this->commonmod_model->uploadCommonFile('./webroot/images/original/', './webroot/images/blogs/', '3048', '2500', '2000', 'blog_image' . $k, $error_view_url);
						if ($FileName != '') {
							$upd_data = array("blog_image" . $k => $FileName);
							$this->db->where('id', $id);
							$this->db->update('bh_blogs', $upd_data);
						}
					}
				}

				$this->session->set_flashdata('success', "Blog Updated");
				redirect(BASE_URL . 'admin/blogs');
			}
		} else {
			$this->load->view('admin/blogs/edit', $data);
		}
	}

	public function delete($id)
	{
		if ($id != '') {
			$this->db->where("id", $id);
			$this->db->delete("bh_blogs");
			$this->session->set_flashdata('success', "Blog Deleted");
		}
		redirect(BASE_URL . 'admin/blogs');
	}

	public function view($id)
	{
		// // $ip = $this->input->ip_address();
		// // $visit = $this->blog_model->addBlogVisitors($id,$ip);
		// $new_urltitle = str_replace('-',' ',$urltitle);
		// $id = $this->blog_model->getBlogIdBySlug($new_urltitle);
		// $id = $id[0]['id'];

		// $data['allBlogVisitors'] = $this->blog_model->getBlogVisitors($id);
		// $data['Content'] = $this->content_model->GetContentByID(28);
		$data['RelatedBlogs'] = $this->blog_model->getRelatedBlogs($id);
		$data['BlogData'] = $this->blog_model->GetBlogByID($id);
		$data['RecentBlogs'] = $this->blog_model->getRecentBlogs();
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		$data['blog_id'] = $data['BlogData'][0]['category_id'];
		$id = $data['blog_id'];
		$data['category_name'] = $this->blog_model->getSingleCatName($id);
		// echo "<pre>";
		// print_r($data['RelatedBlogs']);
		// exit();
		$this->load->view('admin/blogs/view', $data);
	}

	public function archive($year, $month)
	{
		$data['year'] = $year;
		$data['month'] = $month;
		// $data['Content'] =  $this->content_model->GetContentByID(28);
		$data['Blogs'] = $this->blog_model->getALLBlogsByArchive($year, $month);
		$data['Category_list'] = $this->blog_model->allCategoryList();
		$data['All_BLOG_Category'] = $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Featured_Category'] = $this->blog_model->getALLBlogFeaturedCategory();
		// echo "<pre>";
		// print_r($data);
		// exit();
		$this->load->view('admin/blogcategory/view', $data);
	}

	public function edit_other($id)
	{
		$data['BlogsData'] = $this->blog_model->GetBlogByID($id);
		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {

			$config = array(
				array('field' => 'title2', 'label' => 'Title 2', 'rules' => 'trim|xss_clean'),
				array('field' => 'description2', 'label' => 'Description 2', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video2', 'label' => 'Youtube Url 2', 'rules' => 'trim|xss_clean'),

				array('field' => 'title3', 'label' => 'Title 3', 'rules' => 'trim|xss_clean'),
				array('field' => 'description3', 'label' => 'Description 3', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video3', 'label' => 'Youtube Url 3', 'rules' => 'trim|xss_clean'),

				array('field' => 'title4', 'label' => 'Title 4', 'rules' => 'trim|xss_clean'),
				array('field' => 'description4', 'label' => 'Description 4', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video4', 'label' => 'Youtube Url 4', 'rules' => 'trim|xss_clean'),

				array('field' => 'title5', 'label' => 'Title 5', 'rules' => 'trim|xss_clean'),
				array('field' => 'description5', 'label' => 'Description 5', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video5', 'label' => 'Youtube Url 5', 'rules' => 'trim|xss_clean'),

				array('field' => 'title6', 'label' => 'Title 6', 'rules' => 'trim|xss_clean'),
				array('field' => 'description6', 'label' => 'Description 6', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video6', 'label' => 'Youtube Url 6', 'rules' => 'trim|xss_clean'),

				array('field' => 'title7', 'label' => 'Title 7', 'rules' => 'trim|xss_clean'),
				array('field' => 'description7', 'label' => 'Description 7', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video7', 'label' => 'Youtube Url 7', 'rules' => 'trim|xss_clean'),

				array('field' => 'title8', 'label' => 'Title 8', 'rules' => 'trim|xss_clean'),
				array('field' => 'description8', 'label' => 'Description 8', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video8', 'label' => 'Youtube Url 8', 'rules' => 'trim|xss_clean'),

				array('field' => 'title9', 'label' => 'Title 9', 'rules' => 'trim|xss_clean'),
				array('field' => 'description9', 'label' => 'Description 9', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video9', 'label' => 'Youtube Url 9', 'rules' => 'trim|xss_clean'),

				array('field' => 'title10', 'label' => 'Title 10', 'rules' => 'trim|xss_clean'),
				array('field' => 'description10', 'label' => 'Description 10', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video10', 'label' => 'Youtube Url 10', 'rules' => 'trim|xss_clean'),

				array('field' => 'title11', 'label' => 'Title 11', 'rules' => 'trim|xss_clean'),
				array('field' => 'description11', 'label' => 'Description 11', 'rules' => 'trim|xss_clean'),
				array('field' => 'youtube_video11', 'label' => 'Youtube Url 11', 'rules' => 'trim|xss_clean'),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/blogs/edit_other', $data);
			} else {
				$arr2 = array();
				$arr2[0] = $this->input->post('y2_width');
				$arr2[1] = $this->input->post('y2_height');
				$json_2 = json_encode($arr2);

				$arr3 = array();
				$arr3[0] = $this->input->post('y3_width');
				$arr3[1] = $this->input->post('y3_height');
				$json_3 = json_encode($arr3);

				$arr4 = array();
				$arr4[0] = $this->input->post('y4_width');
				$arr4[1] = $this->input->post('y4_height');
				$json_4 = json_encode($arr4);

				$arr5 = array();
				$arr5[0] = $this->input->post('y5_width');
				$arr5[1] = $this->input->post('y5_height');
				$json_5 = json_encode($arr5);

				$arr6 = array();
				$arr6[0] = $this->input->post('y6_width');
				$arr6[1] = $this->input->post('y6_height');
				$json_6 = json_encode($arr6);

				$arr7 = array();
				$arr7[0] = $this->input->post('y7_width');
				$arr7[1] = $this->input->post('y7_height');
				$json_7 = json_encode($arr7);

				$arr8 = array();
				$arr8[0] = $this->input->post('y8_width');
				$arr8[1] = $this->input->post('y8_height');
				$json_8 = json_encode($arr8);

				$arr9 = array();
				$arr9[0] = $this->input->post('y9_width');
				$arr9[1] = $this->input->post('y9_height');
				$json_9 = json_encode($arr9);

				$arr10 = array();
				$arr10[0] = $this->input->post('y10_width');
				$arr10[1] = $this->input->post('y10_height');
				$json_10 = json_encode($arr10);

				$arr11 = array();
				$arr11[0] = $this->input->post('y11_width');
				$arr11[1] = $this->input->post('y11_height');
				$json_11 = json_encode($arr11);

				// Edit new User Details
				$upd_data = array(
					'title2' => $this->input->post('title2'),
					'img2_size' => $this->input->post('img2_size'),
					'description2' => $this->input->post('description2'),
					'youtube_video2' => $this->input->post('youtube_video2'),
					'y2_size' => $json_2,

					'title3' => $this->input->post('title3'),
					'img3_size' => $this->input->post('img3_size'),
					'description3' => $this->input->post('description3'),
					'youtube_video3' => $this->input->post('youtube_video3'),
					'y3_size' => $json_3,

					'title4' => $this->input->post('title4'),
					'img4_size' => $this->input->post('img4_size'),
					'description4' => $this->input->post('description4'),
					'youtube_video4' => $this->input->post('youtube_video4'),
					'y4_size' => $json_4,

					'title5' => $this->input->post('title5'),
					'img5_size' => $this->input->post('img5_size'),
					'description5' => $this->input->post('description5'),
					'youtube_video5' => $this->input->post('youtube_video5'),
					'y5_size' => $json_5,

					'title6' => $this->input->post('title6'),
					'img6_size' => $this->input->post('img6_size'),
					'description6' => $this->input->post('description6'),
					'youtube_video6' => $this->input->post('youtube_video6'),
					'y6_size' => $json_6,

					'title7' => $this->input->post('title7'),
					'img7_size' => $this->input->post('img7_size'),
					'description7' => $this->input->post('description7'),
					'youtube_video7' => $this->input->post('youtube_video7'),
					'y7_size' => $json_7,

					'title8' => $this->input->post('title8'),
					'img8_size' => $this->input->post('img8_size'),
					'description8' => $this->input->post('description8'),
					'youtube_video8' => $this->input->post('youtube_video8'),
					'y8_size' => $json_8,

					'title9' => $this->input->post('title9'),
					'img9_size' => $this->input->post('img9_size'),
					'description9' => $this->input->post('description9'),
					'youtube_video9' => $this->input->post('youtube_video9'),
					'y9_size' => $json_9,

					'title10' => $this->input->post('title10'),
					'img10_size' => $this->input->post('img10_size'),
					'description10' => $this->input->post('description10'),
					'youtube_video10' => $this->input->post('youtube_video10'),
					'y10_size' => $json_10,


					'title11' => $this->input->post('title11'),
					'img11_size' => $this->input->post('img11_size'),
					'description11' => $this->input->post('description11'),
					'youtube_video11' => $this->input->post('youtube_video11'),
					'y11_size' => $json_11,

					'updated_date' => date("Y-m-d h:i:s"),
				);

				$this->db->where('id', $id);
				$this->db->update('bh_blogs', $upd_data);

				// edit blog Image
				// Add new Page Image
				for ($k = 2; $k <= 12; $k++) {
					if ($_FILES['blog_image' . $k]['name']) {
						$error_view_url = 'admin/user/edit';
						$FileName = $this->commonmod_model->uploadCommonFile('./webroot/images/original/', './webroot/images/blogs/', '3048', '2500', '2000', 'blog_image' . $k, $error_view_url);
						if ($FileName != '') {
							$upd_data = array("blog_image" . $k => $FileName);
							$this->db->where('id', $id);
							$this->db->update('bh_blogs', $upd_data);
						}
					}
				}

				$this->session->set_flashdata('success', "Blog Updated");
				redirect(BASE_URL . 'admin/blogs');
			}
		} else {
			$this->load->view('admin/blogs/edit_other', $data);
		}
	}

	public function sethomepage($id)
	{
		if ($id != "") {
			$this->blog_model->setHomePage("unset", "");
			$this->blog_model->setHomePage("set", $id);
		}
		$this->session->set_flashdata('success', "Blog Id:" . $id . " is set as Home Page.");
		redirect(BASE_URL . 'admin/blogs');
	}

}
