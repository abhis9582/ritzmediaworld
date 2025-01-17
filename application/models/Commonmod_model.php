<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commonmod_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->library('image');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
	}
	public function incrementVistor()
	{

		$this->db->where('id', '1');
		$this->db->set('visitor', '`visitor`+1', false);
		$this->db->update('bh_visitors');
	}
	public function GetVistor()
	{
		$this->db->where("id", "1");
		$tabledata = $this->db->get("bh_visitors");
		$data = $tabledata->row_array();
		return $data['visitor'];
	}
	public function getMonthName($month){
		$monthArray = array("1"=>'January',
		"2"=>'February',
		"3"=>'March',
		"4"=>'April',
		"5"=>'May',
		"6"=>'June',
		"7"=>'July',
		"8"=>'August',
		"9"=>'September',
		"10"=>'Octobar',
		"11"=>'November',
		"12"=>'December'
		);
				   
		return $monthArray[$month];
		
		}


	public function GetAllFunctionsOfModule($module_id)
	{
		$this->db->select("*");
		$this->db->from('bh_module_functions');
		//$this->db->join('Author', 'Author.AuthorID = Books.AuthorID');		
		$this->db->where("module_id", $module_id);
		$this->db->order_by("id", "asc");

		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}


	public function GetCountBlogBycategory($category_id)
	{
		$this->db->select("count(id) as total");
		$this->db->from('bh_blogs');
		//$this->db->join('Author', 'Author.AuthorID = Books.AuthorID');		
		$this->db->where("category_id", $category_id);
		$this->db->where("status", '1');
		$this->db->order_by("id", "asc");

		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData[0]['total'];
	}

	function GetSingleBlogdata($category_id)
	{

		$this->db->select("bh_blogs.*");
		$this->db->from('bh_blogs');
		$this->db->where("category_id", $category_id);
		$this->db->where("status", '1');
		$this->db->limit('1', '0');
		$this->db->order_by("id", "asc");

		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}

	public function getALLOthersParentCategories($category_type)
	{
		$this->db->select("*");
		$this->db->from('bh_others_categories');
		$this->db->where("status", '1');
		$this->db->where("parent_id", '0');
		$this->db->where("category_type", $category_type);
		$this->db->order_by("id", "asc");

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getALLChildCategories($category_type = "")
	{
		$this->db->select("*");
		$this->db->from('bh_others_categories');
		$this->db->where("status", '1');

		$this->db->order_by("id", "asc");

		$query = $this->db->get();
		return $query->result_array();
	}

	public function CategoryName($id = "")
	{
		$this->db->select("*");
		$this->db->from('bh_others_categories');
		$this->db->where("id", $id);

		$this->db->order_by("id", "asc");

		$query = $this->db->get();
		$data = $query->result_array();
		return $data[0]['category_name'];
	}


	public function getALLOthersChildCategories()
	{
		$this->db->select("*");
		$this->db->from('bh_others_categories');
		$this->db->where("status", '1');

		$this->db->order_by("sort_order", "asc");

		$query = $this->db->get();
		return $query->result_array();
	}
	public function uploadCommonFile($original_upload_path, $image_upload_path, $upload_size, $width, $height, $imagename, $error_view_url)
	{
		$FileName = '';
		$config = array();
		$config['upload_path'] = $original_upload_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = $upload_size;
		$config['max_width'] = $width;
		$config['max_height'] = $height;
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$error = '';
		if (!$this->upload->do_upload($imagename)) {
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('admin/user/add_user',$data); 
			$image = "";
			$ImageID = "";
		} else {
			$data_upload_files = $this->upload->data();
			$image = $data_upload_files["file_name"];
			$OriginalImageName = $data_upload_files["orig_name"];
			$ImageWidth = $data_upload_files["image_width"];
			$ImageHeight = $data_upload_files["image_height"];

			////////////Getting New Image Name//////////////////////				
			$GUID = $this->image->getGUID();
			$NewImageName = $this->image->CreateImageFilename($GUID, $ImageWidth, $ImageHeight);



			$destinationimgae = $image_upload_path . $NewImageName . $data_upload_files["file_ext"];

			/////////copy image at original desitnation/////////////////////
			$this->image->CreateImage($original_upload_path . $image, $destinationimgae);
			if ($NewImageName != "") {
				$FileName = $NewImageName . $data_upload_files["file_ext"];

			}
		}
		return $FileName;
	}



	public function uploadVideoFile($original_upload_path, $video_upload_path, $upload_size, $width, $height, $imagename, $error_view_url)
	{
		$FileName = '';
		$config = "";
		$config['upload_path'] = $original_upload_path;
		$config['allowed_types'] = 'mp4';
		$config['max_size'] = $upload_size;
		$config['max_width'] = $width;
		$config['max_height'] = $height;
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$error = '';
		if (!$this->upload->do_upload($imagename)) {
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('admin/user/add_user',$data); 
			$image = "";
			$ImageID = "";
		} else {
			$data_upload_files = $this->upload->data();
			$image = $data_upload_files["file_name"];
			$OriginalImageName = $data_upload_files["orig_name"];
			$ImageWidth = $data_upload_files["image_width"];
			$ImageHeight = $data_upload_files["image_height"];

			////////////Getting New Image Name//////////////////////				
			$GUID = $this->image->getGUID();
			$NewImageName = $this->image->CreateImageFilename($GUID, $ImageWidth, $ImageHeight);



			$destinationimgae = $video_upload_path . $NewImageName . $data_upload_files["file_ext"];

			/////////copy image at original desitnation/////////////////////
			$this->image->CreateImage($original_upload_path . $image, $destinationimgae);
			if ($NewImageName != "") {
				$FileName = $NewImageName . $data_upload_files["file_ext"];

			}
		}
		return $FileName;
	}

	public function GetIpLocation($ipAddress)
	{
		$url = "http://api.ipinfodb.com/v3/ip-city/?key=7f310bdbcd10d0aea3da474412c74636aa82afb413fb76f43bd90a887c0bf561&ip=$ipAddress&format=json";
		$d = file_get_contents($url);
		$browser_location = json_decode($d, true);
		return $browser_location;

	}

	public function GetCountUserByUsertypeAdmin($usertype)
	{
		$this->db->select("count(user_id) as total");
		$this->db->from('bh_users');
		$this->db->where("user_type", $usertype);
		$this->db->order_by("user_id", "asc");
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData[0]['total'];
	}

	// Front End Function

	public function GetSystemConfigSetting($id)
	{
		$this->db->select("*");
		$this->db->from('bh_system_settings');
		$this->db->where("id", $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}
	public function GetTotalNoSupportpostedFront(){
		$this->db->select("count(id) as total");
	   $this->db->from('bh_support_listings');	
		$this->db->order_by("id","asc");
	   
	   $query=$this->db->get();
	   $userData = $query->result_array(); 
	   return $userData[0]['total'];
}
	// admin functions
	public function getAdminFunctionPermission($admin_id, $module_id, $function_id)
	{
		$this->db->where("admin_id", $admin_id);
		$this->db->where("module_id", $module_id);
		$this->db->where("function_id", $function_id);
		$this->db->where("status", "1");
		$permission = $this->db->get("bh_permissions");
		if (count($permission->result_array()) > 0)
			return true;
		else
			return 0;


	}
	public function getAdminMenuPermission($admin_id,$module_id){
		$this->db->where("admin_id",$admin_id);
		$this->db->where("module_id",$module_id);
		$this->db->where("status","1");
		$permission = $this->db->get("bh_permissions");
		if(count($permission->result_array()) > 0)
		return true;
		else
		return false;
		}
	public function StringtoArray($string)
	{
		$stringArraTotal = array();
		$stringarr = explode(",", $string);
		if (count($stringarr) > 0) {
			foreach ($stringarr as $stringval) {
				$stringArraTotal[] = $stringval;
			}
		}
		return $stringArraTotal;

	}
}