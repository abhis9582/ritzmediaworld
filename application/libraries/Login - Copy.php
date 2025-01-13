<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login 
{
    public function __construct(){   

        $this->CI =& get_instance();
	}
		
		
		
	function redirect(){
		
        $isLogin = $this->CI->session->userdata('isLogin');
        $backUrl = $this->CI->session->userdata('backUrl');
        if(!empty($isLogin)){
            empty($backUrl) ? $backUrl = 'home' : '';
            $this->CI->session->unset_userdata('isLogin');

            
        }
		redirect($this->CI->config->item('SITEURL'));
        return TRUE;
    }

	 public function check_login()    {
      
	    $user_id = $this->CI->session->userdata('bh_admin_id');
	    if ($user_id=='') { 
	    $msg = array('login' => '<p>You must be logged in to access secure area.</p>');           
        redirect(BASE_URL.'admin/login?msg=login',$msg);

        }
        
    }
	


    function process_login($email, $password)
    {       
		
		
		//set where options
        $this->CI->db->where('email_id', $email);
        $this->CI->db->where('password', $password);
      

        //query table for the user
        $query = $this->CI->db->get('bh_admin');

        //count number of rows
        $numrows = $query->num_rows();
        //if count of row == 1
		
        if ($numrows == 1) {			

            $data = $query->result_array();
			
		
             $this->CI->session->set_userdata('logged_in', '1');			
             $this->CI->session->set_userdata('bh_admin_role', $data[0]["roles"]);			
			 $this->CI->session->set_userdata('bh_admin_id', $data[0]["admin_id"]);
			 $this->CI->session->set_userdata('bh_admin_email_id', $data[0]["email_id"]);
		
			

        } else {
            $this->CI->session->set_userdata('logged_in', '');
            return FALSE;
        }

    }
	
	
		
		public function MaxDisplayOrder($table){
	    $this->CI->db->select("*");
		 $this->CI->db->from($table);	
		 $this->CI->db->order_by('DisplayOrder','desc');
		$query=$this->CI->db->get();
		$maxdata =  $query->result_array();	
		$displayorder = $maxdata[0]['DisplayOrder'];
		return ($displayorder +1);
	} 
	
	public function PriceRound($price){
		
		return  number_format($price,2);
	}
	
	
	
}
