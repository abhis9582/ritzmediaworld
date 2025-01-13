<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
		$this->load->library('encryption');
		// Custom Ours
		$this->load->library('login');
		$this->load->model('admin_model');
		$this->load->model('commonmod_model');
		$this->load->database();
		$this->load->library('upload');
	}


	public function index()
	{
		$this->login->check_login();
		$this->load->view('admin/admin/index');
	}

	public function login()
	{
		$config = array(
			array(
				'field' => 'email_id',
				'label' => 'Email Id',
				'rules' => 'trim|required|min_length[5]|xss_clean'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[5]|md5|xss_clean'
			)
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/admin/login');
		} else {
			$email = set_value('email_id');
			$password = set_value('password');

			$this->db->select("*");
			$this->db->from('bh_admin');
			$this->db->where(array("email_id" => $email));
			$query = $this->db->get();
			$datachk = $query->row_array();

			/* check login */
			$this->login->process_login($email, $password);
			/* ------ */
			if ($this->session->userdata('logged_in') == '') {
				// display login error
				$this->session->set_flashdata('error', 'Either your email address or password is incorrect');

				$this->load->view('admin/admin/login');
				//return redirect(SITEURL."register/signin");				
			} else {
				return redirect(BASE_URL . "admin/dashboard");
			}
			// else password is not blanck 
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('bh_admin_role');
		$this->session->unset_userdata('bh_admin_id');
		$this->session->unset_userdata('bh_admin_email_id');
		redirect(BASE_URL . 'admin/login?msg=login');

	}

	public function view_all()
	{
		$data['ALL_ADMIN_DATA'] = $this->admin_model->getALLAdmin();
		$this->load->view('admin/admin/view-all', $data);
	}

	public function add_admin()
	{
		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			$config = array(
				array('field' => 'username', 'label' => 'User Name', 'rules' => 'is_unique[bh_admin.username]|required|xss_clean'),
				array('field' => 'email_id', 'label' => 'Email Id', 'rules' => 'trim|required|xss_clean|is_unique[bh_admin.email_id]'),
				array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean'),

				array('field' => 'status', 'label' => 'Status', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'roles', 'label' => 'Admin Roles', 'rules' => 'trim|required|xss_clean')
			);
			$emailcheck = '';
			$usernamecheck = '';
			if ($this->input->post('email_id') != '') {
				$emailcheck = $this->commonmod_model->checkField($this->input->post('email_id'), 'email_id', 'bh_admin');
			}

			if ($this->input->post('username') != '') {
				$usernamecheck = $this->commonmod_model->checkField($this->input->post('username'), 'username', 'bh_admin');
			}

			$error = '';
			if ($emailcheck) {
				$error = "Email Id already exists.<br>";
			}
			if ($usernamecheck) {
				$error .= "Username already exists.<br>";
			}

			if ($emailcheck || $usernamecheck) {
				$this->session->set_flashdata('error', $error);
				$this->load->view('admin/admin/add-admin');
			} else {
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('admin/admin/add-admin');
				} else {
					// Add new User Details
					$data = array(
						'username' => $this->input->post('username'),
						'email_id' => $this->input->post('email_id'),
						'password' => md5($this->input->post('password')),

						'roles' => $this->input->post('roles'),
						'status' => $this->input->post('status')
					);

					$this->db->insert('bh_admin', $data);
					$admin_id = $this->db->insert_id();
					$this->AddDefaultPermissiontoNewAdmin($admin_id);

					if ($admin_id) {
						$this->session->set_flashdata('success', "Admin added");
					} else {
						$this->session->set_flashdata('error', "Admin Not added");
					}
					redirect(BASE_URL . 'admin/manage-admin');
				}
			}
		} else {
			$this->load->view('admin/admin/add-admin');
		}
	}

	public function change_password()
	{
		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			$config = array(
				array('field' => 'old_password', 'label' => 'Old Password', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|xss_clean')
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/admin/change-password');
			} else {
				$input_old = $this->input->post('old_password');
				$input_new = $this->input->post('new_password');
				$input_conf = $this->input->post('confirm_password');
				$admin_id = $this->session->userdata('bh_admin_id');
				$result = $this->admin_model->AdminByID($admin_id);
				$d_password = $result[0]['password'];
				if ($d_password == md5($input_old)) {
					if ($input_new == $input_conf) {
						$data = array(
							'password' => md5($input_new)
						);

						$this->db->where('admin_id', $admin_id);
						$result = $this->db->update('bh_admin', $data);

						$this->session->set_flashdata('success', "Password Changed Successfully.");
						redirect(BASE_URL . 'admin/change-password');
					} else {
						$this->session->set_flashdata('error', "Confirm Password not matched!");
						redirect(BASE_URL . 'admin/change-password');
					}
				} else {
					$this->session->set_flashdata('error', "Old Password not matched!");
					redirect(BASE_URL . 'admin/change-password');
				}
			}
		} else {
			$this->load->view('admin/admin/change-password');
		}
	}

	public function AddDefaultPermissiontoNewAdmin($admin_id)
	{
		if ($admin_id != "") {

			$this->db->where("module_id !=", "1");
			$module_data = $this->db->get("bh_module_functions");
			$all_functionsdata = $module_data->result_array();
			foreach ($all_functionsdata as $all_functions) {
				$data = array("admin_id" => $admin_id, "module_id" => $all_functions['module_id'], "function_id" => $all_functions['id'], "status" => "1");
				$this->db->insert("bh_permissions", $data);

			}
		}
		return false;
	}

	public function edit_admin($User_ID)
	{
		$data['USER_DATA'] = $this->admin_model->AdminByID($User_ID);
		if ($User_ID == "") {
			$this->session->set_flashdata('error', "Incorrect Url");
			redirect(BASE_URL . 'admin/manage-admin');
		}

		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			$emailcheck = '';
			$usernamecheck = '';
			if ($this->input->post('email_id') != '' && $this->input->post('email_id') != $data['USER_DATA'][0]['email_id']) {
				$emailcheck = $this->commonmod_model->checkField($this->input->post('email_id'), 'email_id', 'bh_admin');
			}

			if ($this->input->post('username') != '' && $this->input->post('username') != $data['USER_DATA'][0]['username']) {
				$usernamecheck = $this->commonmod_model->checkField($this->input->post('username'), 'username', 'bh_admin');
			}

			$error = '';
			if ($emailcheck) {
				$error = "Email Id already exists.<br>";
			}
			if ($usernamecheck) {
				$error .= "Username already exists.<br>";
			}

			if ($emailcheck || $usernamecheck) {
				$this->session->set_flashdata('error', $error);
				$this->load->view('admin/admin/edit-admin', $data);
			} else {

				$config = array(
					array('field' => 'username', 'label' => 'User Name', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'email_id', 'label' => 'Email Id', 'rules' => 'trim|required|xss_clean'),


					array('field' => 'status', 'label' => 'Status', 'rules' => 'trim|required|xss_clean'),
					array('field' => 'roles', 'label' => 'Roles', 'rules' => 'trim|required|xss_clean')
				);

				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() === FALSE) {

					$this->load->view('admin/admin/edit-admin', $data);

				} else {
					$admin_id = $this->input->post('admin_id');
					// Edit new User Details
					$upd_data = array(
						'username' => $this->input->post('username'),
						'email_id' => $this->input->post('email_id'),
						'roles' => $this->input->post('roles'),
						'status' => $this->input->post('status')
					);

					if ($admin_id != "") {
						$this->db->where('admin_id', $admin_id);
						$this->db->update('bh_admin', $upd_data);

						//update pass data
						if ($this->input->post('password') != '') {
							$pass_data = array('password' => md5($this->input->post('password')));
							$this->db->where('admin_id', $admin_id);
							$this->db->update('bh_admin', $pass_data);
						}

						$this->session->set_flashdata('success', "Admin updated");
					}
					redirect(BASE_URL . 'admin/manage-admin');
				}
			}
		} else {
			$this->load->view('admin/admin/edit-admin', $data);
		}


	}


	public function systemsetting()
	{
		$data['USER_DATA'] = $this->admin_model->GetSystemConfigSetting('1');
		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			$config = array(
				array('field' => 'website_url', 'label' => 'Website Url', 'rules' => 'trim|required|xss_clean'),
				array('field' => 'website_email_id', 'label' => 'Email id', 'rules' => 'trim|required|xss_clean')

			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/admin/sytem-config', $data);
			} else {
				$id = $this->input->post('id');
				// Edit new User Details
				$upd_data = array(
					'website_name' => $this->input->post('website_name'),
					'website_url' => $this->input->post('website_url'),
					'website_email_id' => $this->input->post('website_email_id'),
					'website_address' => $this->input->post('website_address'),
					'phone_number' => $this->input->post('phone_number'),
					'mobile_number' => $this->input->post('mobile_number'),
					'facebook_url' => $this->input->post('facebook_url'),
					'vimeo_url' => $this->input->post('vimeo_url'),
					'twitter_url' => $this->input->post('twitter_url'),
					'youtube_url' => $this->input->post('youtube_url'),
					'linkedin_url' => $this->input->post('linkedin_url'),
					'hotel_mail_content' => $this->input->post('hotel_mail_content'),
					'resorts_mail_content' => $this->input->post('resorts_mail_content'),
					'google_url' => $this->input->post('google_url')
				);

				if ($id != "") {
					$this->db->where('id', $id);
					$this->db->update('bh_system_settings', $upd_data);
					$this->session->set_flashdata('success', "System Config updated.");
				}
				redirect(BASE_URL . 'admin/system-setting');
			}

		} else {
			$this->load->view('admin/admin/system-config', $data);
		}
	}

	public function webStory()
	{
		$data['webStory'] = $this->admin_model->getALLWebStories();
		$this->load->view('admin/admin/web-story', $data);
	}


	public function permission($User_ID)
	{
		$data['User_ID'] = $User_ID;
		$data['ALL_Modules2'] = $this->admin_model->GetAllModules();
		$ALL_User_ModulesFunction = $this->admin_model->GetAllUserModules($User_ID);

		$data['ALL_Modules'] = @$ALL_User_ModulesFunction;

		if ($User_ID == "") {
			$this->session->set_flashdata('error', "Incorrect Url");
			redirect(BASE_URL . 'admin/manage-admin');
		}

		if ($this->input->post('submitF') && $this->input->post('submitF') != "") {
			$permissionids = $this->input->post('permission_function_id');
			for ($i = 0; $i < count($permissionids); $i++) {

				$module_id = $this->input->post('module_id');
				$module_ids = $module_id[$i];
				$permission_id = $permissionids[$i];
				$function_list = $this->input->post('function_id_' . $permission_id);
				$status_list = $this->input->post('status_' . $permission_id);

				// Edit new User Details
				$upd_data = array(
					'admin_id' => $this->input->post('admin_id'),
					'module_id' => $module_ids,
					'function_id' => $function_list[0],
					'status' => $status_list[0]
				);

				if ($permission_id != "0") {
					$this->db->where('id', $permission_id);
					$this->db->where('admin_id', $this->input->post('admin_id'));
					$this->db->update('bh_permissions', $upd_data);
					$this->session->set_flashdata('success', "Permission updated");
				} else {
					$this->db->insert('bh_permissions', $upd_data);
					$this->session->set_flashdata('success', "Permission added");
				}
			}
			redirect(BASE_URL . 'admin/manage-admin');
		} else {
			$this->load->view('admin/admin/permission', $data);
		}
	}

	public function delete_admin($id)
	{
		if ($id != '' && $id != '1') {
			$this->db->where("admin_id", $id);
			$this->db->delete("bh_admin");
			$this->session->set_flashdata('success', "Admin Deleted");
		}
		redirect(BASE_URL . 'admin/manage-admin');
	}

	public function saveWebStory()
	{
		// Check if the request is a POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Get input data
			$heading = $this->input->post('heading');
			$description = $this->input->post('description');
			$base_url = base_url();
			// File upload configuration
			$config['upload_path'] = './webroot/images/webstory/'; // Destination directory
			$config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
			$config['max_size'] = 5000; // Max file size in KB
			$config['file_name'] = uniqid('media_'); // Unique file name

			// Load the upload library with the config
			$this->upload->initialize($config);

			// Check if file is uploaded
			if (!$this->upload->do_upload('media')) {
				// If upload fails, return error message
				echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
			} else {
				// Get the uploaded file data
				$uploadData = $this->upload->data();

				// Save the uploaded file path in the database
				$media_url = $uploadData['file_name'];

				// Save to database using the model
				$data = [
					'heading' => $heading,
					'description' => $description,
					'file_url' => $media_url
				];
				;
				if ($this->db->insert('bh_web_story', $data)) {
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Failed to save data.']);
				}
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
		}
	}

}
