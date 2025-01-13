<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{

	public function getVisitorCount()
	{
		$this->db->select("*");
		$this->db->from('bh_visitors');
		$data = $this->db->get()->num_rows();
		return $data;
	}

	public function getALLAdmin()
	{
		$this->db->select("*");
		$this->db->from('bh_admin');
		$this->db->order_by("admin_id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getALLWebStories()
	{
		$this->db->select("*");
		$this->db->from('bh_web_story');
		$this->db->order_by('id', 'DESC'); // Assuming 'created_at' is the column that stores the timestamp
		$this->db->limit(10); // Limit the results to 10
		$query = $this->db->get();
		return $query->result_array();
	}

	public function AdminByID($admin_id)
	{
		$this->db->select("*");
		$this->db->from('bh_admin');
		$this->db->where("admin_id", $admin_id);
		$this->db->order_by("admin_id", "desc");
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData;
	}


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

	public function getModuleFunctionName($function_id)
	{
		$this->db->select("*");
		$this->db->from('bh_module_functions');
		$this->db->where("id", $function_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$userData = $query->result_array();
		return $userData[0]['function_name'];
	}


	public function GetAllModules()
	{
		$this->db->select("*");
		$this->db->from('bh_modules');
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}


	public function GetAllFunctionsOfModule($module_id, $admin_id)
	{
		$this->db->select("*");
		$this->db->from('bh_permissions');
		$this->db->where("bh_permissions.module_id", $module_id);
		$this->db->where("bh_permissions.admin_id", $admin_id);
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function GetAllUserModules($admin_id)
	{
		$this->db->select("distinct(bh_permissions.module_id),bh_modules.module_name as module_name");
		$this->db->from('bh_permissions');
		$this->db->join('bh_modules', 'bh_modules.id = bh_permissions.module_id', 'inner');
		$this->db->where("bh_permissions.admin_id", $admin_id);
		$this->db->order_by("bh_permissions.id", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}
}