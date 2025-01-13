<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogcategory extends CI_Controller {
	
	
	function __construct(){
		
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
     $this->login->check_login();	 
     $this->load->model('blog_model');   
     $this->load->model('commonmod_model');   
     $this->load->database();   
	}

	
	public function index(){
		$data['Blog_Categories'] =  $this->blog_model->getALLBlogCategories();
		$this->load->view('admin/blogcategory/index',$data);
	}
	
	public function add(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){	
			$config = array( 	           
				array('field' => 'category_name','label' => 'Category Name','rules' => 'trim|required|xss_clean|is_unique[bh_blog_categories.category_name]'),
				array('field' => 'category_description','label' => 'Category Description','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/blogcategory/add');
			}
			else{
				// Add new User Details
				$data = array(
					'category_name' => $this->input->post('category_name'),
					'category_description' => $this->input->post('category_description'),
					'status' => $this->input->post('status')
				);  		

				$result = $this->db->insert('bh_blog_categories', $data);
				//$User_id = $this->db->insert_id();
				if($result){
					$this->session->set_flashdata('success',"Blog Category Added");
				}
				else{
					$this->session->set_flashdata('error',"Blog Category Not Added!");
				}
				redirect(BASE_URL.'admin/blogcategories');
			}
		}
		else{
			$this->load->view('admin/blogcategory/add');
		}
		
		
	}
	
	public function edit($id){
		$data['BlogCatData'] =  $this->blog_model->GetBlogCategoryNameByID($id);
		if($id==""){  
			$this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/blogcategories'); 
		}
	
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
	      	$config = array(
				array('field' => 'category_name','label' => 'Category Name','rules' => 'trim|required|xss_clean|is_unique[bh_blog_categories.category_name]'),
				array('field' => 'category_description','label' => 'Category Description','rules' => 'trim|required|xss_clean')
		    );
			
			$this->form_validation->set_rules($config);		
			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/blogcategory/edit',$data);
			}
			else{
			// Edit new User Details
			$upd_data = array(
				'category_name' => $this->input->post('category_name'),
				'category_description' => $this->input->post('category_description'),
				
				'status' => $this->input->post('status')			
			); 
			
            $this->db->where('id', $id);
			$result = $this->db->update('bh_blog_categories', $upd_data);
			
			if($result){
				$this->session->set_flashdata('success',"Blog Category Updated");
			}
			else{
				$this->session->set_flashdata('error',"Blog Category Not Updated");
			}

			redirect(BASE_URL.'admin/blogcategories');
			}
		}
		else{
			$this->load->view('admin/blogcategory/edit',$data);
		}
	}
	
	public function delete($id){
		if($id!=''){
		$this->db->where("id",$id);
		$result = $this->db->delete("bh_blog_categories");
		if($result){
			$this->session->set_flashdata('success',"Blog Category Deleted");
		}
		else{
			$this->session->set_flashdata('error',"Blog Category Not Deleted");
		}
			
		
		}
		redirect(BASE_URL.'admin/blogcategories');
	}
	
	public function view($id){
		// $new_cat_name = str_replace('-',' ',$catname);
		// $category_id = $this->blog_model->getCatIdByName($new_cat_name);
		$category_id = $id;
	    // $data['Content'] =  $this->content_model->GetContentByID(28);
	    $data['CategoryData'] =  $this->blog_model->GetBlogCategoryNameByID($category_id);
		// exit();
		// if($this->input->post('search_key')){
		// $data['Blogs'] =  $this->blog_model->getALLBlogsBySearch();
		// }else{
		// $data['Blogs'] =  $this->blog_model->getALLBlogsBycategoryId($category_id);	
		// }
		$data['Blogs'] =  $this->blog_model->getALLBlogsBycategoryId($category_id);
		$data['All_BLOG_Category'] =  $this->blog_model->getALLBlogCategoryWithBlog();
		$data['Category_list'] = $this->blog_model->allCategoryList();
		// $data['Featured_Category'] =  $this->blog_model->getALLBlogFeaturedCategory();
		// echo "<pre>";
		// print_r($data['Blogs']);
		// exit();
		$this->load->view('admin/blogcategory/view',$data);
	}

	
}
