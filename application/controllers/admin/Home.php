<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
 		$this->load->library('image');   		 
		$this->login->check_login();	 
		$this->load->model('home_model');
		$this->load->model('service_model');
		$this->load->model('commonmod_model');
		$this->load->database();   
	}

	
	public function index(){
		// $data['Services'] =  $this->home_model->getALLServices();
		$this->load->view('admin/home/services/index');
	}

	public function category($id){
		// $data['category_id'] =  $id;
		// $data['Blogs'] =  $this->blog_model->getALLBlogsBycategoryId($id);
		// $this->load->view('admin/blogs/index',$data);
	}

	public function why_choose_us(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'title','label' => 'Heading','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
			);		
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/why_choose_us/wcu',$data);
			}
			else{
				// Edit new User Details
				$upd_data = array(
					'wcu_head' => $this->input->post('title'),
					'wcu_desc' => $this->input->post('description')
				);
				$this->db->where('id', '1');
				$this->db->update('bh_why_choose_us', $upd_data);
			
				$this->session->set_flashdata('success',"Data Updated");
				redirect(BASE_URL.'admin/why_choose_us');
			}
		}
		else{
			$data['wcu_data'] = $this->home_model->GetWhyChooseUs();
			$this->load->view('admin/home/why_choose_us/wcu',$data);
		}
	}

	public function why_best(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'title','label' => 'Heading','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
			);
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/why_choose_us/why_best',$data);
			}
			else{
				// Edit new User Details
				$upd_data = array(
					'why_best_head' => $this->input->post('title'),
					'why_best_desc' => $this->input->post('description')
				);
				$this->db->where('id', '1');
				$this->db->update('bh_why_choose_us', $upd_data);
			
				$this->session->set_flashdata('success',"Data Updated");
				redirect(BASE_URL.'admin/why_ritz_best');
			}
		}
		else{
			$data['wcu_data'] = $this->home_model->GetWhyChooseUs();
			$this->load->view('admin/home/why_choose_us/why_best',$data);
		}
	}

	public function our_vision(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'title','label' => 'Heading','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
			);		
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/why_choose_us/our_vision',$data);
			}
			else{
				// Edit new User Details
				$upd_data = array(
					'our_vision_head' => $this->input->post('title'),
					'our_vision_desc' => $this->input->post('description')
				);
				$this->db->where('id', '1');
				$this->db->update('bh_why_choose_us', $upd_data);
			
				$this->session->set_flashdata('success',"Data Updated");
				redirect(BASE_URL.'admin/our_vision');
			}
		}
		else{
			$data['wcu_data'] = $this->home_model->GetWhyChooseUs();
			$this->load->view('admin/home/why_choose_us/our_vision',$data);
		}
	}

	public function how_we_work(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'title','label' => 'Heading','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
			);
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/why_choose_us/how_we_work',$data);
			}
			else{
				// Edit new User Details
				$upd_data = array(
					'how_we_work_head' => $this->input->post('title'),
					'how_we_work_desc' => $this->input->post('description')
				);
				$this->db->where('id', '1');
				$this->db->update('bh_why_choose_us', $upd_data);
				$this->session->set_flashdata('success',"Data Updated");
				redirect(BASE_URL.'admin/how_we_work');
			}
		}
		else{
			$data['wcu_data'] = $this->home_model->GetWhyChooseUs();
			$this->load->view('admin/home/why_choose_us/how_we_work',$data);
		}
	}

	// 	SERVICES
	public function services(){
		$data['head_titles'] = $this->home_model->GetTitle();
		$data['Services'] =  $this->home_model->getALLServices();
		$this->load->view('admin/home/services/index',$data);
	}
	public function add_service(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'service_title','label' => 'Title','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean')
			);	
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	
			$this->load->view('admin/home/services/add'); 		
			}
			else{			
			// Add new User Details			
			// Add new Page Image
			// for($k=1;$k<=1;$k++){
				if ($_FILES['service_image1']['name']){
					$error_view_url = 'admin/home/add_service';
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/services/','3048','0','0','service_image1',$error_view_url);
					if($FileName!=''){
					$data = array(
						'service_title' => $this->input->post('service_title'),
						'service_image' => $FileName,
						'description' => $this->input->post('description'),
						'add_date' => date("Y-m-d h:i:s")
						);		
						$this->db->insert('bh_services', $data);
						$insert_id = $this->db->insert_id();
					}
					if($insert_id){
						$this->session->set_flashdata('success',"Service Added");
					}
					else{
						$this->session->set_flashdata('error',"Service Not Added");
					}	
				}
				redirect(BASE_URL.'admin/services');
			}
		}
		else{
			$this->load->view('admin/home/services/add');
		}
	}
	
	public function edit_service($id){
		$data['ServiceData'] =  $this->home_model->GetServiceByID($id);
		if($id==""){  
			$this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/services'); 
		}
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean'),
			);
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/edit_service',$data);
			}
			else{
				// Edit new User Details
				$upd_data = array(
					'service_title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'update_date' => date("Y-m-d h:i:s")
				);
				$this->db->where('id', $id);
				$this->db->update('bh_services', $upd_data);
				
				// edit blog Image
				// Add new Page Image
				if ($_FILES['service_image1']['name']){
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile
					('./webroot/images/original/','./webroot/images/services/','3048','2500','2000','service_image1',$error_view_url);
					if($FileName!=''){
						$upd_data = array("service_image"=>$FileName);
						$this->db->where('id', $id);
						$this->db->update('bh_services', $upd_data);
					}
				}
				$this->session->set_flashdata('success',"Service Updated");
				redirect(BASE_URL.'admin/services');
			}
		}
		else{
			$this->load->view('admin/home/services/edit',$data);
		}
	}
	
	public function delete_service($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_services");
		$this->session->set_flashdata('success',"Service Deleted");
		}
		redirect(BASE_URL.'admin/home/services');
	}

	// CUSTOMERS
	public function customers(){
		$data['Customers'] =  $this->home_model->getALLCustomers();
		$data['head_titles'] = $this->home_model->GetTitle();
		$this->load->view('admin/home/customers/index',$data);
	}

	public function add_customer(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			if ($_FILES['customer_image1']['name']){
				$error_view_url = 'admin/home/add_service';
				$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/customers/','3048','0','0','customer_image1',$error_view_url);
				if($FileName!=''){
					// $upd_data = array("service_image1"=>$FileName);
					// $this->db->where('id', $insert_id);
					// // $this->db->update('bh_services', $upd_data);
					// echo "Yes";
					// echo $FileName;
					// exit();
					$data = array(
					'customer_image' => $FileName,
					'add_date' => date("Y-m-d h:i:s")
					);
					$this->db->insert('bh_customers', $data);
					$insert_id = $this->db->insert_id();
				}
				if($insert_id){
					$this->session->set_flashdata('success',"Customer Added");
				}
			}
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Customer Added");
			redirect(BASE_URL.'admin/home/customers');
		}
		else{
			$this->load->view('admin/home/customers/add');
		}
	}

	public function edit_customer($id){
		$data['CustomerData'] =  $this->home_model->GetCustomerByID($id);
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			
			if ($_FILES['customer_image1']['name']){
				$error_view_url = 'admin/home/edit_customer';			
				$FileName =  $this->commonmod_model->uploadCommonFile
				('./webroot/images/original/','./webroot/images/customers/','3048','2500','2000','customer_image1',$error_view_url);
				if($FileName!=''){
					$upd_data = array("customer_image"=>$FileName);
					$this->db->where('id', $id);
					$this->db->update('bh_customers', $upd_data);
				}
			}
		
			$this->session->set_flashdata('success',"Customer Updated");
			redirect(BASE_URL.'admin/home/customers');
		}
		else{
			$this->load->view('admin/home/customers/edit',$data);
		}
	}
	
	public function delete_customer($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_customers");
		$this->session->set_flashdata('success',"Customer Deleted");
		}
		redirect(BASE_URL.'admin/home/customers');
	}

	// TESTIMONIALS
	public function testimonials(){
		$data['testimonial'] =  $this->home_model->getALLTestimonials();
		$this->load->view('admin/home/testimonial/index',$data);
	}
	
	public function add_testimonial(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'member_name','label' => 'Member Name','rules' => 'trim|required|xss_clean'),
				array('field' => 'position','label' => 'Position','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean')
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/home/testimonial/add'); 
			
			}
			else{
				if ($_FILES['company_logo']['name']){
					$error_view_url = 'admin/home/add_service';
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/testimonials/','3048','0','0','company_logo',$error_view_url);
					if($FileName!=''){
						$data = array(
							'member_name' 	=> $this->input->post('member_name'),
							'position' 		=> $this->input->post('position'),
							'company_logo'	=> $FileName,
							'description' 	=> $this->input->post('description')
						);
		
						$this->db->insert('bh_testimonial', $data);
						$insert_id = $this->db->insert_id();
					}
				}
				if($insert_id){
					$this->session->set_flashdata('success',"Testimonial Added");
					redirect(BASE_URL.'admin/testimonials');
				}
				else{
					//$User_id = $this->db->insert_id();
					$this->session->set_flashdata('error',"Testimonial Not Added");
					redirect(BASE_URL.'admin/testimonials');
				}
			
			}
		}
		
		else{
			$this->load->view('admin/home/testimonial/add');
		}
	}
	
	public function edit_testimonial($id){
		$data['TestimonialData'] =  $this->home_model->GetTestimonialByID($id);
		if($id==""){  
			$this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/testimonials'); 
		}

		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'member_name','label' => 'Member Name','rules' => 'trim|required|xss_clean'),
				array('field' => 'position','label' => 'Position','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'Description','rules' => 'trim|required|xss_clean')
			);
		
		
			$this->form_validation->set_rules($config);		
			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/testimonial/edit',$data);
			}
			else{
				$data = array(
					'member_name' 	=> $this->input->post('member_name'),
					'position' 		=> $this->input->post('position'),
					'description' 	=> $this->input->post('description')
				);
	
				$this->db->where('id', $id);
				$this->db->update('bh_testimonial', $data);

				if ($_FILES['company_logo']['name']){
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile
					('./webroot/images/original/','./webroot/images/testimonials/','3048','2500','2000','company_logo',$error_view_url);
					if($FileName!=''){
						$upd_data = array("company_logo"=>$FileName);
						$this->db->where('id', $id);
						$this->db->update('bh_testimonial', $upd_data);
					}
				}

				$this->session->set_flashdata('success',"Testimonial Updated");
				redirect(BASE_URL.'admin/testimonials');
			}
		}
		else{
			// echo "no";
			// exit();
			$this->load->view('admin/home/testimonial/edit',$data);
		}
	}
	
	public function delete_testimonial($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_testimonial");
		$this->session->set_flashdata('success',"Testimonial Deleted");
		}
		redirect(BASE_URL.'admin/testimonials');
	}

	// 	NETWORTHY ASSETS
	public function networthy_assets(){
		$data['head_titles'] = $this->home_model->GetTitle();
		$data['networthy'] =  $this->home_model->getALLNetworthyAssets();
		$this->load->view('admin/home/networthy/index',$data);
	}
	
	public function add_networthy_assets(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'title','label' => 'Title','rules' => 'trim|required|xss_clean')
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/home/networthy/add'); 
			
			}
			else{
				if ($_FILES['n_image']['name']){
					$error_view_url = 'admin/home/add_service';
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/networthy/','3048','0','0','n_image',$error_view_url);
					if($FileName!=''){
						// $upd_data = array("n_image"=>$FileName);
						// $this->db->where('id', $insert_id);
						// // $this->db->update('bh_services', $upd_data);
						// echo "Yes";
						// echo $FileName;
						// exit();
					$data = array(
						'title' => $this->input->post('title'),
						'n_image' => $FileName
						);
			
						$this->db->insert('bh_networthy', $data);
						$insert_id = $this->db->insert_id();
					}
					if($insert_id){
						$this->session->set_flashdata('success',"Data Added");
					}
				}
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Data Added");
			redirect(BASE_URL.'admin/networthy_assets');
			}
		}
		else{
			$this->load->view('admin/home/networthy/add');
		}
	}
	
	public function edit_networthy_assets($id){
		$data['n_Data'] =  $this->home_model->GetNetworthyByID($id);
		if($id==""){  
			$this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/networthy_assets');
		}

		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'title','label' => 'Title','rules' => 'trim|required|xss_clean'),
			);
		
		
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/home/networthy/edit',$data);
			}
			else{
				// Edit new User Details
				$upd_data = array(
					'title' => $this->input->post('title')
				);
			
				$this->db->where('id', $id);
				$this->db->update('bh_networthy', $upd_data);
				
				// edit blog Image
				// Add new Page Image
				if ($_FILES['n_image']['name']){
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile
					('./webroot/images/original/','./webroot/images/networthy/','3048','2500','2000','n_image',$error_view_url);
					if($FileName!=''){
						$upd_data = array(
							'title' => $this->input->post('title'),
							"n_image"=>$FileName
						);
						$this->db->where('id', $id);
						$this->db->update('bh_networthy', $upd_data);
					}
				}
			
				$this->session->set_flashdata('success',"Data Updated");
				redirect(BASE_URL.'admin/networthy_assets');
			}
		}
		else{
			$this->load->view('admin/home/networthy/edit',$data);
		}
	}
	
	public function delete_networthy_assets($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_networthy");
		$this->session->set_flashdata('success',"Data Deleted");
		}
		redirect(BASE_URL.'admin/networthy_assets');
	}

	// 	NETWORTHY ASSETS
	public function kaam_hai_mera(){
		$data['khm_data'] =  $this->home_model->getALLKaamHaiMera();
		$this->load->view('admin/home/khm/index',$data);
	}
	
	public function add_khm(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			
			if($_FILES['khm_image']['name']){
				$error_view_url = 'admin/home/add_khm';
				$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/khm/','3048','0','0','khm_image',$error_view_url);
				if($FileName!=''){
				$data = array(
					'khm_image' => $FileName
					);
		
					$this->db->insert('bh_khm', $data);
					$insert_id = $this->db->insert_id();
				}
				if($insert_id){
					$this->session->set_flashdata('success',"Data Added");
				}
			}
			
			//$User_id = $this->db->insert_id();
			$this->session->set_flashdata('success',"Data Added");
			redirect(BASE_URL.'admin/kaam_hai_mera');
		}
		else{
			$this->load->view('admin/home/khm/add');
		}
	}
	
	public function edit_khm($id){
		$data['khm_data'] =  $this->home_model->GetKhmByID($id);
		if($id==""){  
			$this->session->set_flashdata('error',"Incorrect Url");
			redirect(BASE_URL.'admin/kaam_hai_mera');
		}

		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			
				if ($_FILES['khm_image']['name']){
					$error_view_url = 'admin/user/edit';			
					$FileName =  $this->commonmod_model->uploadCommonFile
					('./webroot/images/original/','./webroot/images/khm/','3048','2500','2000','khm_image',$error_view_url);
					if($FileName!=''){
						$upd_data = array(
							"khm_image"=>$FileName
						);
						$this->db->where('id', $id);
						$this->db->update('bh_khm', $upd_data);
					}
				}
			
				$this->session->set_flashdata('success',"Data Updated");
				redirect(BASE_URL.'admin/kaam_hai_mera');
			}
		else{
			$this->load->view('admin/home/khm/edit',$data);
		}
	}
	
	public function delete_khm($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_khm");
		$this->session->set_flashdata('success',"Data Deleted");
		}
		redirect(BASE_URL.'admin/kaam_hai_mera');
	}

	// MENU
	public function menu(){
		$data['allmenu'] = $this->home_model->getALLMenuList();
		$data['allcategory'] = $this->home_model->getMenuCategory();
		$this->load->view('admin/menu/index',$data);
	}

	public function add_menu_list(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'menu_name','label' => 'Menu Name','rules' => 'trim|required|xss_clean'),
				array('field' => 'menu_url','label' => 'URL','rules' => 'trim|required|xss_clean'),
				array('field' => 'category_id','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
				array('field' => 'menu_url','label' => 'Menu Url','rules' => 'trim|required|xss_clean|is_unique[bh_menu_list.menu_url]|is_unique[bh_content.page_url]'),
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				echo "no";
				exit();
				$data['allCategory'] = $this->home_model->getMenuCategory();
				$this->load->view('admin/menu/add_menu_list',$data);
			}
			else{
				$url = $this->input->post('menu_url');
				$data = array(
					'menu_name' 		=> $this->input->post('menu_name'),
					'menu_url' 			=> $url,
					'page_title'		=> $this->input->post('title'),	
					'page_heading'		=> $this->input->post('heading'),
					'page_description' 	=> $this->input->post('description'),
					'meta_title'  		=> $this->input->post('meta_title'),
					'meta_description' 	=> $this->input->post('meta_description'),
					'meta_keywords' 	=> $this->input->post('meta_keywords'),
					'category_id' 		=> $this->input->post('category_id'),
					'status' 			=> $this->input->post('status'),
					'update_date' 		=> date("Y-m-d h:i:s")
				);
		
				$this->db->insert('bh_menu_list', $data);
				$insert_id = $this->db->insert_id();
				if($insert_id){
					$this->session->set_flashdata('success',"Menu Added");
				}
				else{
					$this->session->set_flashdata('error',"Menu Not Added");
				}
				redirect(BASE_URL.'admin/menu');
			}
		}
		else{
			$data['allCategory'] = $this->home_model->getMenuCategory();
			$this->load->view('admin/menu/add_menu_list',$data);
		}
	}

	public function edit_menu_list($id){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$data['menu'] = $this->home_model->getSelectedMenuList($id);
			if($data['menu'][0]['menu_url'] == $this->input->post('menu_url')){
				$config = array(
					array('field' => 'menu_name','label' => 'Menu Name','rules' => 'trim|required|xss_clean'),
					array('field' => 'menu_url','label' => 'URL','rules' => 'trim|required|xss_clean'),
					array('field' => 'category_id','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
					array('field' => 'menu_url','label' => 'Menu Url','rules' => 'trim|required|xss_clean|is_unique[bh_content.page_url]'),
				);
			}
			else{
				$config = array(
					array('field' => 'menu_name','label' => 'Menu Name','rules' => 'trim|required|xss_clean'),
					array('field' => 'menu_url','label' => 'URL','rules' => 'trim|required|xss_clean'),
					array('field' => 'category_id','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
					array('field' => 'menu_url','label' => 'Menu Url','rules' => 'trim|required|xss_clean|is_unique[bh_menu_list.menu_url]|is_unique[bh_content.page_url]'),
				);
			}
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE){
				$data['allCategory'] = $this->home_model->getMenuCategory();
				$data['menu'] = $this->home_model->getSelectedMenuList($id);
				$this->load->view('admin/menu/edit_menu_list',$data);
			}
			else{
				$url = $this->input->post('menu_url');
				$data = array(
					'menu_name' 		=> $this->input->post('menu_name'),
					'menu_url' 			=> $url,
					'page_title'		=> $this->input->post('title'),	
					'page_heading'		=> $this->input->post('heading'),
					'page_description' 	=> $this->input->post('description'),
					'meta_title'  		=> $this->input->post('meta_title'),
					'meta_description' 	=> $this->input->post('meta_description'),
					'meta_keywords' 	=> $this->input->post('meta_keywords'),
					'category_id' 		=> $this->input->post('category_id'),
					'status' 			=> $this->input->post('status'),
					'update_date' 		=> date("Y-m-d h:i:s")
				);
		
				$this->db->where('id', $id);
				$result = $this->db->update('bh_menu_list', $data);
			}
			if($result){
				$this->session->set_flashdata('success',"Menu Updated");
				redirect(BASE_URL.'admin/menu');
			}
			else{
				$this->session->set_flashdata('error',"Menu Not Updated");
				redirect(BASE_URL.'admin/menu');
			}
				
			
		}
		else{
			$data['allCategory'] = $this->home_model->getMenuCategory();
			$data['menu'] = $this->home_model->getSelectedMenuList($id);
			$this->load->view('admin/menu/edit_menu_list',$data);
		}
	}

	public function delete_menu_list($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_menu_list");
		$this->session->set_flashdata('success',"Data Deleted");
		}
		redirect(BASE_URL.'admin/menu');
	}

	public function menu_category(){
		$data['allcategory'] = $this->home_model->getMenuCategory();
		$this->load->view('admin/menu/categories',$data);
	}

	public function add_menu_category(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'category_name','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
			);
			
			$this->form_validation->set_rules($config);		
			if ($this->form_validation->run() === FALSE)
			{	

			$this->load->view('admin/menu/add_category'); 
			
			}
			else{
				if ($_FILES['category_image']['name']){
					$error_view_url = 'admin/home/add_menu_category';
					$FileName =  $this->commonmod_model->uploadCommonFile('./webroot/images/original/','./webroot/images/menu/','3048','0','0','category_image',$error_view_url);
					if($FileName!=''){
					$data = array(
						'category_name' => $this->input->post('category_name'),
						'category_image' => $FileName,
						'status' => $this->input->post('category_status'),
						'update_date' => date("Y-m-d h:i:s")
						);
			
						$this->db->insert('bh_menu_category', $data);
						$insert_id = $this->db->insert_id();
					}
					if($insert_id){
						$this->session->set_flashdata('success',"Menu Category Added");
					}
					else{
						$this->session->set_flashdata('error',"Menu Category Not Added");
					}
					
					
				}
				redirect(BASE_URL.'admin/menu_category');
			}
		}
		else{
			$this->load->view('admin/menu/add_category');
		}
	}

	public function edit_menu_category($id){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){
			$config = array(
				array('field' => 'category_name','label' => 'Category Name','rules' => 'trim|required|xss_clean'),
			);
			
			$this->form_validation->set_rules($config);	
			if ($this->form_validation->run() === FALSE){
				// $data['allCategory'] = $this->home_model->getMenuCategory();
				// $data['menu'] = $this->home_model->getSelectedMenuList($id);
				$this->load->view('admin/menu/edit_category');
			}
			else{
				if ($_FILES['category_image']['name']){
					$error_view_url = 'admin/home/edit_customer';			
					$FileName =  $this->commonmod_model->uploadCommonFile
					('./webroot/images/original/','./webroot/images/menu/','3048','2500','2000','category_image',$error_view_url);
					if($FileName!=''){
						$upd_data = array(
							'category_name' => $this->input->post('category_name'),
							"category_image"=>$FileName,
							'status' => $this->input->post('status'),
							'update_date' => date("Y-m-d h:i:s")
						);
						$this->db->where('id', $id);
						$this->db->update('bh_menu_category', $upd_data);

						$this->session->set_flashdata('success',"Menu Updated");
					}
				}
				else{
					$data = array(
						'category_name' => $this->input->post('category_name'),
						'status' => $this->input->post('status'),
						'update_date' => date("Y-m-d h:i:s")
					);

					$this->db->where('id', $id);
					$this->db->update('bh_menu_category', $data);

					$this->session->set_flashdata('success',"Menu Updated");
				}
			}
				
			redirect(BASE_URL.'admin/menu_category');
		}
		else{
			$data['category'] = $this->home_model->getSelectedMenuCategory($id);
			$this->load->view('admin/menu/edit_category',$data);
		}
	}

	public function delete_menu_category($id){
		if($id!=''){
		$this->db->where("id",$id);
		$this->db->delete("bh_menu_category");
		$this->session->set_flashdata('success',"Data Deleted");
		}
		redirect(BASE_URL.'admin/menu');
	}

	// UPDATE TITLES / DECRIPTIONS
	public function update_title(){
		if($this->input->post('submitF') && $this->input->post('submitF')!=""){

			$upd_data = array(
				"title1" => $this->input->post('description1'),
				"title2" => $this->input->post('description2'),
				"title3" => $this->input->post('description3'),
				"title4" => $this->input->post('description4'),
				"title5" => $this->input->post('description5'),
				"title6" => $this->input->post('description6')
			);
			$this->db->where('id', '1');
			$this->db->update('bh_head_titles', $upd_data);
		
			$this->session->set_flashdata('success',"Data Updated");
			$data['head_titles'] = $this->home_model->GetTitle();
			$this->load->view('admin/home/update_titles/edit',$data);
		}
		else{
			$data['head_titles'] = $this->home_model->GetTitle();
			$this->load->view('admin/home/update_titles/edit',$data);
		}
	}

	public function update_title_page(){
		$data['head_titles'] =  $this->home_model->GetTitle();
		$this->load->view('admin/home/update_titles/edit',$data);
	}
	
	// public function sethomepage($id){ 
	// 	if($id!=""){
	// 	 $this->blog_model->setHomePage("unset","");
	// 	 $this->blog_model->setHomePage("set",$id);
	// 	}
	// 	 $this->session->set_flashdata('success',"Blog Id:".$id." is set as Home Page.");
	// 	 redirect(BASE_URL.'admin/blogs');
	// }
}