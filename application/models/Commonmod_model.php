<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Commonmod_model extends CI_Model {
	
public function __construct()
{
 $this->load->database();
 $this->load->library('image');
$this->load->library('form_validation');	
$this->load->helper(array('form', 'url')); 	 
}



  public function GetAllOrderStatus()
{	  
         $orderstatus = array("2"=>'Pending',"3"=>'Cancelled',"7"=>"Booked","6"=>'Completed');
		 
		
		return $orderstatus;
} 

public function GetOrderStatusType($order_status_id)
{	   
         $orderstatus = array("2"=>'Pending',"3"=>'Cancelled',"7"=>"Booked","6"=>'Completed');
		 
		return $orderstatus[$order_status_id];
} 


public function GetTaxOnAdminProduct($order_product_id){
   
     $orderData =  $this->order_model->GetsingleOrderProduct($order_product_id);//print_r($orderData );
	   $productdata = $this->commonmod_model->GetProductListingDetails($orderData['product_id']);
	  $taxData =  $this->commonmod_model->GetTAxSingleRecords($productdata[0]['tax_id']);
     if(count($taxData) > 0){ 
		if($taxData['type']=='Fixed'){ return number_format($orderData['tax'],2).'('.@$taxData['type'].')';  } 
		if($taxData['type']=='Percent'){ return number_format($orderData['tax'],2).'('.@$taxData['rate'].'%'.')' ;} 
		return '0.00';
		}
		return '0.00';
}


function GetProductListingDetails($id){

        $this->db->select("*");
		$this->db->from('bh_support_listings');	
        $this->db->where("id",$id);
		
		$this->db->limit('1','0');
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}


public function GetTaxOnProduct($product_id){
    $productdata = $this->commonmod_model->GetProductListingDetails($product_id);
     $taxData =  $this->commonmod_model->GetTAxSingleRecords($productdata[0]['tax_id']);
	 $price = $this->commonmod_model->GetPriceofProduct($product_id);
     if(count($taxData) > 0){ 
		if($taxData['type']=='Fixed'){ return number_format($taxData['rate'],2).'('.$taxData['type'].')';  } 
		if($taxData['type']=='Percent'){ return number_format((($taxData['rate']*$price)/100),2).'('.$taxData['rate'].'%'.')' ;} 
		return '0.00';
		}
		return '0.00';
}
public function GetTAxSingleRecords($tax_id){
		$this->db->select("*");
		$this->db->from('bh_tax');


		$this->db->where("id",$tax_id);
		$this->db->order_by("rate","asc");

		$query=$this->db->get();
		$taxData = $query->row_array();
		return 	$taxData;	
}


public function GetTaxRateByTaxId($price,$tax_id){
	
      $taxData =  $this->commonmod_model->GetTAxSingleRecords($tax_id);
		if(count($taxData) > 0){ 
		if($taxData['type']=='Fixed'){ return $taxData['rate'];} 
		if($taxData['type']=='Percent'){ return (($taxData['rate']*$price)/100) ;} 
		return 0;
		}
		return 0;
}

public function ApplyTaxOnProduct($product_id,$tax_id){
	    $productdata = $this->commonmod_model->GetProductListingDetails($product_id);
	    $price =  $this->commonmod_model->GetPriceofProduct($product_id);
	    $tax_amount = $this->commonmod_model->GetTaxRateByTaxId($price,$productdata[0]['tax_id']);
	    
   
		return $tax_amount;  
}


public function GetPriceofProduct($product_id){
	$productdata = @$this->GetProductListingDetails($product_id);
	if(@$productdata[0]['discount_enable']==1) return $productdata[0]['discount_price'];
	else if(@$productdata[0]['discount_enable']==0) return $productdata[0]['price'];
	return false;
}


public function GetAllCountry($Country_id="")
{	   
        $html = "";
		$this->db->select("*");
		$this->db->from('countries');		
		$this->db->order_by("name","asc");
		$query=$this->db->get();
		$all_data =  $query->result_array();   
		return $all_data;
 }
 
 public function getHotelByCity($city){
	
		$this->db->select("*");
		$this->db->from('bh_support_listings');	
		$this->db->where("city",$city);		
		$this->db->where("status","1");		
		$this->db->order_by("listing_title","asc");

		$query=$this->db->get();
		$all_data =  $query->result_array(); 
		return $all_data;
 }
   
  public function GetAllUserType()
{	   
       $usertype = array("1"=>'Corporate User',"2"=>'User');
		   
		return $usertype;
} 

public function getMonthID($month){
$monthArray = array("1"=>'01',
"2"=>'02',
"3"=>'03',
"4"=>'04',
"5"=>'05',
"6"=>'06',
"7"=>'07',
"8"=>'08',
"9"=>'09',
"10"=>'10',
"11"=>'11',
"12"=>'12'
);
		   
return $monthArray[$month];

}
public function getMonthIDWithoutZero($month){
$monthArray = array("01"=>'1',
"02"=>'2',
"03"=>'3',
"04"=>'4',
"05"=>'5',
"06"=>'6',
"07"=>'7',
"08"=>'8',
"09"=>'9',
"10"=>'10',
"11"=>'11',
"12"=>'12'
);
		   
return $monthArray[$month];

}

public function getBookingStatus($value){
$bookArray = array("1"=>'Booked',
"3"=>'Pending',
"4"=>'Cancelled'
);
		   
return $bookArray[$value];

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

public function GetUserType($user_type)
{	   
       $usertype = array("1"=>'Agent',"2"=>'User');
		   
		return $usertype[$user_type];
}  
 public function GetUserStatus($user_type)
{	   
       $usertype = array("1"=>'Agent',"2"=>'User');
		   
		return $usertype[$user_type];
}  
   public function showUserTypeDropDown($current_val=""){
		$html = '';
		$sel1= ($current_val==1)?'selected="selected"':'';
		$sel2= ($current_val==2)?'selected="selected"':'';
		
		$html .= '<select name="user_type" class="form-control">';
		$html .= '<option value="">Select User Type</option>';
		$html .= '<option value="1" '.$sel1.'>Corporate User</option>';
		$html .= '<option value="2" '.$sel2.'>User</option>';
	
		$html .= '<select>';
		return $html;
   }
   
   public function showExpireTimeDropDown($current_val){
        $html = '';
		$sel1= ($current_val=='10')?'selected="selected"':'';
	
		$sel2= ($current_val=='15')?'selected="selected"':'';
		$sel3= ($current_val=='30')?'selected="selected"':'';
		$sel4= ($current_val=='60')?'selected="selected"':'';
		$sel5= ($current_val=='Expired')?'selected="selected"':'';
			

		$html .= '<select name="expire_time" class="form-control">';
		$html .= '<option value="">Expired Time</option>';
		$html .= '<option value="10" '.$sel1.'>10 days</option>';
		$html .= '<option value="15" '.$sel2.'>15 days</option>';
		$html .= '<option value="30" '.$sel3.'>1 Month</option>';
		$html .= '<option value="60" '.$sel4.'>2 Month</option>';
		$html .= '<option value="Expired" '.$sel5.'>Expired</option>';
	
		$html .= '<select>';
		return $html;
   
   }
   
   
   
     public function GetCityName($id)
   {	   
		$this->db->select("name");
		$this->db->from('cities');	
		$this->db->where('id',$id);
		$query=$this->db->get();		
		$data=$query->row_array();	
		if($data["name"]) return $data["name"];
		else return false; 	 
   }
      public function GetStateName($id)
   {	   
		$this->db->select("name");
		$this->db->from('states');	
		$this->db->where('id',$id);
		$query=$this->db->get();		
		$data=$query->row_array();	
		if($data["name"]) return $data["name"];
		else return false; 	 
   }
   
    public function GetAllState2($id)
   {	   
		$this->db->select("*");
		$this->db->from('states');	
		$this->db->where('country_id','101');
		$query=$this->db->get();		
		$data=$query->result_array();	
		return $data; 
   }
   
   
      public function GetCountryName($id)
   {	   
		$this->db->select("name");
		$this->db->from('countries');	
		$this->db->where('id',$id);
		$query=$this->db->get();		
		$data=$query->row_array();	
		if($data["name"]) return $data["name"];
		else return false; 	 
   }
   
     public function GetUserName($id)
   {	   
		$this->db->select("first_name");
		$this->db->from('bh_users');	
		$this->db->where('user_id',$id);
		$query=$this->db->get();		
		$data=$query->row_array();	
		if($data["first_name"]) return $data["first_name"];
		else return false; 	 
   }
   
   public function GetListingCategoryByID($id){
	   if($id!=0){
         $this->db->select("*");
		$this->db->from('bh_others_categories');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
		
        return $userData;
	   }
	   return false;
}

public function GetAllfeedback(){

         $this->db->select("*");
		$this->db->from('bh_feedbacks');		
		$this->db->where("status","1");
		$this->db->order_by("id","desc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
		
        return $userData;
	  
}

   
      public function checkField($field_val,$field_name,$table_name)
   {	
        if($field_val!=''){   
		$this->db->select($field_name);
		$this->db->from($table_name);	
		$this->db->where($field_name,$field_val);
		$query=$this->db->get();		
		$data=$query->row_array();	
		if($data[$field_name]!='') return 'exists';
		else return false; 	 
		}
		return false;
   }
   
   
    
public function create_url($value)
		  {    
		   if($value!=""){
			//$cng=array('<', '>', '&', '{', '}', '*','$','1','2','3','4','5','6','7','8','9','0');
			
			$cng=array('<', '>', '&', '{', '}', '*','$');
			
			
			$value = str_replace("/","",$value);
			
			$value= strtolower($value);
			
			$value = str_replace($cng, '', trim($value));
			
			$langth=strlen($value);
			$value = str_replace(' ', '-', trim($value));
			
			return $value;
		   }
		   return false;

} 


public function GetAllFunctionsOfModule($module_id){
         $this->db->select("*");
		$this->db->from('bh_module_functions');	
      //$this->db->join('Author', 'Author.AuthorID = Books.AuthorID');		
		$this->db->where("module_id",$module_id);
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}


public function GetCountBlogBycategory($category_id){
         $this->db->select("count(id) as total");
		$this->db->from('bh_blogs');	
      //$this->db->join('Author', 'Author.AuthorID = Books.AuthorID');		
		$this->db->where("category_id",$category_id);
		$this->db->where("status",'1');
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData[0]['total'];
}

function GetSingleBlogdata($category_id){

        $this->db->select("bh_blogs.*");
		$this->db->from('bh_blogs');	
        $this->db->where("category_id",$category_id);
		$this->db->where("status",'1');
		$this->db->limit('1','0');
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

	public function getALLOthersParentCategories($category_type){
         $this->db->select("*");
		$this->db->from('bh_others_categories');
         $this->db->where("status",'1');		
        $this->db->where("parent_id",'0');		
        $this->db->where("category_type",$category_type);		
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function getALLChildCategories($category_type=""){
         $this->db->select("*");
		$this->db->from('bh_others_categories');
         $this->db->where("status",'1');		
      	
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}

public function CategoryName($id=""){
		$this->db->select("*");
		$this->db->from('bh_others_categories');
		$this->db->where("id",$id);		

		$this->db->order_by("id","asc");

		$query=$this->db->get();
		$data =  $query->result_array(); 
		return $data[0]['category_name'];		
}


public function getALLOthersChildCategories(){
         $this->db->select("*");
		$this->db->from('bh_others_categories');
         $this->db->where("status",'1');		
     		
		$this->db->order_by("sort_order","asc");
		
		$query=$this->db->get();
		return $query->result_array();  
}


public function GetSupportListing($state_id="",$city_id="",$category_id=""){
	
        $this->db->select("*");
		$this->db->from('bh_support_listings');
        $this->db->where("status",'1');
		if($category_id!="")
		$where2 = "FIND_IN_SET('".$category_id."', category_id)";  



			if($state_id!="")	
			$this->db->where("state",$state_id);
			if($city_id!="")	
			$this->db->where("city",$city_id);
			if($category_id!="")	
			$this->db->where($where2);
			$this->db->order_by("add_date","desc");

			$query=$this->db->get();
			return $query->result_array();  
}


function GetSupportListingDetails($id){

        $this->db->select("*");
		$this->db->from('bh_support_listings');	
        $this->db->where("id",$id);
		
		$this->db->limit('1','0');
		$this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}

public function uploadCommonFile($original_upload_path,$image_upload_path,$upload_size,$width,$height,$imagename,$error_view_url){
$FileName ='';
                $config=array();	
				$config['upload_path'] = $original_upload_path;
				$config['allowed_types'] = '*';
				$config['max_size']	= $upload_size;
				$config['max_width']  = $width;
				$config['max_height']  = $height;
				$config['encrypt_name'] = true;
				$this->load->library('upload', $config);		
				$this->upload->initialize($config);	
				$error=''; 		
				if ( ! $this->upload->do_upload($imagename))
				{
				$error = array('error' => $this->upload->display_errors());
				//$this->load->view('admin/user/add_user',$data); 
				$image="";
				$ImageID="";
				}
				else
				{
				$data_upload_files = $this->upload->data();				
				 $image = $data_upload_files["file_name"]; 
				$OriginalImageName=$data_upload_files["orig_name"];				
				$ImageWidth=$data_upload_files["image_width"];
				$ImageHeight=$data_upload_files["image_height"];

				////////////Getting New Image Name//////////////////////				
				$GUID=$this->image->getGUID();				
				$NewImageName=$this->image->CreateImageFilename($GUID,$ImageWidth,$ImageHeight);


				
				$destinationimgae = $image_upload_path.$NewImageName.$data_upload_files["file_ext"];

				/////////copy image at original desitnation/////////////////////
				$this->image->CreateImage($original_upload_path.$image,$destinationimgae);	
                if($NewImageName!=""){				
                $FileName=$NewImageName.$data_upload_files["file_ext"];
				
				}
				}
				return $FileName;
}
				
	
  
public function uploadVideoFile($original_upload_path,$video_upload_path,$upload_size,$width,$height,$imagename,$error_view_url){
$FileName ='';
                $config="";	
				$config['upload_path'] = $original_upload_path;
				$config['allowed_types'] = 'mp4';
				$config['max_size']	= $upload_size;
				$config['max_width']  = $width;
				$config['max_height']  = $height;
				$config['encrypt_name'] = true;
				$this->load->library('upload', $config);		
				$this->upload->initialize($config);	
				$error=''; 		
				if ( ! $this->upload->do_upload($imagename))
				{
				$error = array('error' => $this->upload->display_errors());
				//$this->load->view('admin/user/add_user',$data); 
				$image="";
				$ImageID="";
				}
				else
				{
				$data_upload_files = $this->upload->data();				
				 $image = $data_upload_files["file_name"]; 
				$OriginalImageName=$data_upload_files["orig_name"];				
				$ImageWidth=$data_upload_files["image_width"];
				$ImageHeight=$data_upload_files["image_height"];

				////////////Getting New Image Name//////////////////////				
				$GUID=$this->image->getGUID();				
				$NewImageName=$this->image->CreateImageFilename($GUID,$ImageWidth,$ImageHeight);


				
				$destinationimgae = $video_upload_path.$NewImageName.$data_upload_files["file_ext"];

				/////////copy image at original desitnation/////////////////////
				$this->image->CreateImage($original_upload_path.$image,$destinationimgae);	
                if($NewImageName!=""){				
                $FileName=$NewImageName.$data_upload_files["file_ext"];
				
				}
				}
				return $FileName;
}
  
public function GetIpLocation($ipAddress)
   {	  
	  $url = "http://api.ipinfodb.com/v3/ip-city/?key=7f310bdbcd10d0aea3da474412c74636aa82afb413fb76f43bd90a887c0bf561&ip=$ipAddress&format=json";
	  $d = file_get_contents($url);
	  $browser_location = json_decode($d , true);	  
	  return $browser_location;
	   
   }
   
 public function GetCountUserByUsertypeAdmin($usertype){
			$this->db->select("count(user_id) as total");
			$this->db->from('bh_users');
			$this->db->where("user_type",$usertype);
			$this->db->order_by("user_id","asc");
			$query=$this->db->get();
			$userData = $query->result_array(); 
			return $userData[0]['total'];
}

// Front End Function



	public function GetTotalNoSupportpostedFront(){
         $this->db->select("count(id) as total");
		$this->db->from('bh_support_listings');	
         $this->db->order_by("id","asc");
		
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData[0]['total'];
}


public function GetSystemConfigSetting($id){
         $this->db->select("*");
		$this->db->from('bh_system_settings');		
		$this->db->where("id",$id);
		$this->db->order_by("id","desc");
		$query=$this->db->get();
		$userData = $query->result_array(); 
        return $userData;
}
public function getReturnvideoHtml($videosrc,$id,$height,$width){
			$style = '';
			if($height!="") $style .= 'height:'.$height.';';
			if($width!="") $style .= 'height:'.$width.';';
			$html = '<div class="zd-video-container zd-video-ispause"  style="'.$style.'" id="'.$id.'">
			</div>
			<script>
			var video = new ZdVideo({
			container: "'.$id.'",
			source: "'.$videosrc.'",
			
			});
			</script>';
			return $html;
	}
	

	
	function GetALLSupportListing($type,$id,$state_id,$city_id,$pincode){
		$this->db->select("*");
		$this->db->from('bh_support_listings');
        $this->db->where("status",'1');
		if($type=='today'){
		
		$this->db->like('add_date', date("Y-m-d"), 'after');
		}
		if($id!="")	
		$this->db->where("category_id",$id);
		if($state_id!="")	
		$this->db->where("state",$state_id);
	    if($city_id!="")	
		$this->db->where("city",$city_id);
		if($pincode!="")	
		$this->db->where("pincode",$pincode);	
		$this->db->order_by("add_date","desc");
		
		$query=$this->db->get();
		return $query->result_array();  
	}
	
	

	
	// admin functions
	
	
public function getAdminFunctionPermission($admin_id,$module_id,$function_id){
	$this->db->where("admin_id",$admin_id);
	$this->db->where("module_id",$module_id);
	$this->db->where("function_id",$function_id);
	$this->db->where("status","1");
	$permission = $this->db->get("bh_permissions");
	if(count($permission->result_array()) > 0)
	return true;
    else
	return 0;


	}
	
	public function GetOrderInvoice($order_id){
		
		$AllorderproductList = $this->order_model->GetOrderListing($order_id);
		$Oneorder =  $this->order_model->GetOneorder($order_id);
			
			foreach($AllorderproductList as $Allproducts) {
        					
        					
        					
        					$HotelData = $this->listing_model->GetSupportListingByID($Allproducts['product_id']);
	}
	
	$hotelmaildata = $this->commonmod_model->getSystemValue('hotel_mail_content');
	$resortsmaildata = $this->commonmod_model->getSystemValue('resorts_mail_content'); 
	$mail_content = ($HotelData[0]['hotel_type']=='Hotel')?($hotelmaildata):$resorts_mail_content;
	
	
				
				$message = '
   				
<center>						
<table style="width:600px; font-family: Arial, Helvetica, sans-serif; color:#000000; font-size:14px; line-height:22px; padding: 6px 8px; border: 1px solid #000;">
	<tr>
		<td align="center"><img src="'.FRONT_DIR.'images/logo.png" alt="invoice-logo" width="80px"/></td>
	</tr>
	
	<tr>
		<td style="text-transform:uppercase; font-weight:bold;"><p style="margin-top:10px;">Dear '.$Oneorder[0]['firstname'].' '.$Oneorder[0]['lastname'].'</p></td>
	</tr>
	
	<tr>
		<td  style="text-align:center"><p style="margin-top:0px;">We thank you for choosing '.$HotelData[0]['listing_title'].' as your preferred hotel in '.get_city_name($HotelData[0]['city']).'. Below is a summary of your
booking and room information. We look forward to making your stay unique, comfortable and memorable</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Guest Name</td>
					<td style="border-bottom:1px solid #000; padding: 5px; text-transform:uppercase;">'.$Oneorder[0]['firstname'].' '.$Oneorder[0]['lastname'].'</td>						
				</tr>
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">E-Mail Id</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['email'].' </td>					
				</tr>
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Mobile/Telephone No</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['mobile'].' </td>					
				</tr>
				<tr style="display:none;">
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Company Name</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">CORPORATE TRIP</td>					
				</tr>
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Check In Date & Time</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.date("d/M/Y",strtotime($Oneorder[0]['start_date'])).' <span style="margin: 0 10px;">12.00</span></td>					
				</tr>';
				
				
					$now = strtotime($Oneorder[0]['end_date']); 
					$your_date = strtotime($Oneorder[0]['start_date']);
					$datediff = $now - $your_date;

					$days =  round($datediff / (60 * 60 * 24));
					
					
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Check Out Date & Time</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">
					'.date("d/M/Y",strtotime($Oneorder[0]['end_date'])).' <span style="margin: 0 10px;">12.00</span> <span style="margin: 0 10px;">No of Night</span> '.$days.'</td>					
				</tr>
				
				
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Confirmation No</td>	
		<td style="border-bottom:1px solid #000; padding: 5px; font-weight:bold">
		'.$Oneorder[0]['order_id'].'</td>					
				</tr>
				<tr>
					<td style="border-right:1px solid #000; padding: 5px;">Reservation status</td>	
					<td style="padding: 5px; font-weight:bold">'.$this->commonmod_model->GetOrderStatusType($Oneorder[0]['order_status_id']).'</td>					
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td style="font-weight:bold; font-size:15px;"><p style="margin-bottom: 8px;">Rate Information</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">';
				
				  $grand_total = 0; $i=0; foreach($AllorderproductList as $Allproducts) {
        					
        	$HotelData = $this->listing_model->GetSupportListingByID($Allproducts['product_id']);
        
        		$guest_detail = '';	
					if(!empty($Allproducts['adults_name1'])){
					$guest_detail .= 'Guest 1 - '.$Allproducts['adults_name1'].'<br>';	
					}
					if(!empty($Allproducts['adults_name2'])){
					$guest_detail .= 'Guest 2 - '.$Allproducts['adults_name2'].'<br>';		
					}
					if(!empty($Allproducts['adults_name3'])){
					$guest_detail .= 'Guest 3 - '.$Allproducts['adults_name3'].'<br>';		
					}
$children_detail = '';
if(!empty($Allproducts['children_name1'])){
					$children_detail .= 'Children 1 - '.$Allproducts['children_name1'].'<br>';		
					}
					if(!empty($Allproducts['children_name2'])){
					$children_detail .= 'Children 2 - '.$Allproducts['children_name2'].'<br>';		
					}
					
			$message .= '	<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;"> Price</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.($Allproducts['total']).' </td>	
				</tr>
				
				<tr>				
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Room type</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">
					'.get_hotel_room_category($Allproducts['room_id']).'</td>	
				</tr>
				
				<tr style="display:none;">				
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Room Plan</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">CONTINENTAL PLAN</td>	
				</tr>
				
				<tr>				
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Guest Details</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$guest_detail.'</td>	
				</tr>
				<tr>				
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Children Details</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$children_detail.'</td>	
				</tr>
				';
				
				  $i++; }
				$message .= ' 
				
				
			</table>
		</td>
	</tr>
		
	<tr>
		<td style="font-weight:bold; font-size:15px;"><p style="margin-bottom: 8px;">Payment Information</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">';
			
			$message .= '	<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Pay By</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$pay_by.'</td>	
				</tr>';
				if($payment_id > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Payment ID</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$payment_id.'</td>	
				</tr>';
				}
				if($payment_status > 0){
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Payment Status</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$payment_status.'</td>	
				</tr>';
				}
				if($payment_request_id > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Payment Request ID</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$payment_request_id.'</td>	
				</tr>';
				}
				
				if($Oneorder[0]['tax'] > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Tax</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['tax'].'</td>	
				</tr>';
				}
				
				if($Oneorder[0]['discount_amount'] > 0)
				{
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Coupon Applied ('.$Oneorder[0]['coupon_code'].'):</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['discount_amount'].'</td>	
				</tr>';
				}
				$message .= '<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">Grand Total</td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">'.$Oneorder[0]['total'].'</td>	
				</tr>';
				
				
			$message .= '</table>
		</td>
	</tr>
			 
			 
	<tr>
		<td style="font-weight:bold; font-size:15px;"><p style="margin-bottom: 8px;">Room Information</p></td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #000;">
				<tr>
					<td style="border-right:1px solid #000; border-bottom:1px solid #000; padding: 5px;">No of Rooms </td>	
					<td style="border-bottom:1px solid #000; padding: 5px;">SGL '.$i.' <span style="margin: 0 10px;">/ DBL 0</span> / TPL 0 </td>	
				</tr>
				
				<tr>				
					<td style="border-right:1px solid #000; padding: 5px;">No. of Occupants</td>	
					<td style="padding: 5px;"> 1 <span style="margin: 0 10px;">/ 0</span></td>	
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="font-weight:bold; font-size:16px;"><p style="margin-bottom: 8px; text-align:center;">Terms & Conditions</p></td>
	</tr>
	
	<tr>
		<td> 
		'.$mail_content.'
		</td>
		</tr>
		
</table>
</center> ';

return $message;
 
		
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
	
	public function incrementVistor(){
	
		$this->db->where('id', '1');
		$this->db->set('visitor', '`visitor`+1',false);
		$this->db->update('bh_visitors');
	}
	public function GetVistor(){
	$this->db->where("id","1");
	$tabledata= $this->db->get("bh_visitors");
	$data = $tabledata->row_array();
	return $data['visitor'];
	}
	
	public function getSystemValue($fieldname){
	     $this->db->select($fieldname);
		$this->db->from('bh_system_settings');		
		$this->db->where("id","1");
		$this->db->order_by("id","desc");
		$query=$this->db->get();
		$userData = $query->row_array(); 
        return $userData[$fieldname];

	
	}
	
	

  public function GetAllAgent(){
   $this->db->select("*");
		$this->db->from('bh_users');	
		
		$this->db->where('status','1');
		$this->db->where('user_type','1');
		$this->db->order_by("user_id","asc");
		
		
		$query=$this->db->get();		
		$data=$query->result_array();	
		 return $data;
   
   }
   


public function GetCountOrderStatusAdmin($status_id,$user_id){
			$this->db->select("count(order_id) as total");
			$this->db->from('bh_order');
			if($user_id!="")
			$this->db->where("user_id",$user_id);
			$this->db->where("order_status_id",$status_id);
			$this->db->order_by("order_id","asc");
			$query = $this->db->get();
			$userData = $query->result_array(); 
			return $userData[0]['total'];
}



public function GetAllOrderByYear($year){
			$this->db->select("*");
			$this->db->from('bh_order');
			if($year!="")
			$this->db->where("YEAR(`date_added`)",$year);
			
			$this->db->order_by("order_id","asc");
			$query = $this->db->get();
			$userData = $query->result_array(); 
			return $userData;
}

public function GetUserdata($user_id){
        $this->db->select("*");
		$this->db->from('bh_users');	
		$this->db->where('status','1');
		$this->db->where('user_id',$user_id);
		$this->db->order_by("user_id","asc");
		$query=$this->db->get();		
		$data=$query->result_array();	
	    return $data;
    }
   



public function GetAllOrder($status_id){
			$this->db->select("*");
			$this->db->from('bh_order');
			if($status_id!="")
			$this->db->where("order_status_id",$status_id);	
			$this->db->order_by("order_id","asc");
			$query=$this->db->get();
			$userData = $query->result_array(); 
			return $userData;
}  
public function CountGetTodayOrder(){
			$this->db->select("count(order_id) as total");
			$this->db->from('bh_order');
			$this->db->where("date_added",date("Y-m-d"));
			$this->db->order_by("order_id","asc");
			$query=$this->db->get();
			$userData = $query->result_array(); 
			return $userData[0]['total'];
}

   
   public function GetAllUser(){
   $this->db->select("*");
		$this->db->from('bh_users');	
		
		$this->db->where('status','1');
		$this->db->order_by("user_id","asc");
		
		
		$query=$this->db->get();		
		$data=$query->result_array();	
		 return $data;
   
   }
   
   
 
    
	
	function addDayswithdate($date,$days){
		$newdate= '';
if($days==10){
    $newdate = strtotime("+10 days", strtotime($date));
}
else if($days==15){
    $newdate = strtotime("+15 days", strtotime($date));
}
else if($days==30){
    $newdate = strtotime("+1 month", strtotime($date));
}
else if($days==60){
    $newdate = strtotime("+2 month", strtotime($date));
}
else {
    $newdate = strtotime("-10 days", strtotime($date));
}
    return  date("Y-m-d", $newdate);

}

public function GetListingState(){
      $html = "";
	 
		$this->db->select('bh_support_listings.state');
		
		$this->db->from('bh_support_listings');
		$this->db->where('bh_support_listings.status','1');
		$query = $this->db->get();
		$all_data =  $query->result_array();
		foreach($all_data as $statedata){
			$state_ids[] = $statedata['state'];
		}
		
		if(count($state_ids) > 0){
		$this->db->select('states.*');
		
		$this->db->from('states');
		$this->db->where_in('id', $state_ids);

		$query = $this->db->get();
		$all_data =  $query->result_array(); 
     
		if(count($all_data) > 0){
				$html = '<option value="">Select State</option>';			
				foreach($all_data as $singleData){
				//$url = $this->create_url($singleData['Title']);
				if($current_id==$singleData['id']){ $class= 'selected'; } else{  $class= '';  }
				$html .='<option value="'.$singleData['id'].'" '.$class.'>'.$singleData['name'].'</option>';


				}
		}
		}
		return $html;

}



public function GetAllPropertyType(){
      $html = "";
	 
		$this->db->select('bh_support_listings.category_id');
		
		$this->db->from('bh_support_listings');
		$this->db->where('bh_support_listings.status','1');
		$query = $this->db->get();
		$all_data =  $query->result_array();
		foreach($all_data as $statedata){
			$category_id = $statedata['category_id'];
			$category_ids = $this->StringtoArray($category_id);
			foreach($category_ids as $category_id_single){
			$all_category_id[] = $category_id_single;
			}
		}
	
		$all_category_id = array_unique($all_category_id);
		if(count($all_category_id) > 0){
		$this->db->select('bh_others_categories.*');
		
		$this->db->from('bh_others_categories');
		$this->db->where_in('id', $all_category_id);

		$query = $this->db->get();
		$all_data =  $query->result_array(); 
     
		if(count($all_data) > 0){
				$html = '';			
				foreach($all_data as $singleData){
				//$url = $this->create_url($singleData['Title']);
				if($current_id==$singleData['id']){ $class= 'selected'; } else{  $class= '';  }
				$html .='<option value="'.$singleData['id'].'" '.$class.'>'.$singleData['category_name'].'</option>';


				}
		}
		}
		return $html;

}

public function getCurrencyPrice($price){
$price = "Rs".$price;
return $price;
}

public function StringtoArray($string){
	$stringArraTotal = array();
	$stringarr = explode(",",$string);
	if(count($stringarr) > 0){
	foreach($stringarr as $stringval){
		$stringArraTotal[] = $stringval;
	}
	}
	return $stringArraTotal;
	
}

public function ArraytoString($array){
	$stringArraTotal = '';
	$stringArraTotal = implode(",",$array);
	
	return $stringArraTotal;
	
}


public function checkHotelDatesIsAvailable($hotel_id,$startdate,$enddate,$current_id="")
{
            $this->db->select('start_date, end_date');
			$this->db->from('bh_hotel_pay');
			$this->db->where('( (start_date  <= "' . $startdate . '" OR end_date  >= "' . $enddate . '") AND hotel_id="'.$hotel_id.'"  )');
			
			if($current_id!="")
			$this->db->where('id !=',$current_id);
			
			$query = $this->db->get()->result_array();
             
			return $query;
}


public function checkBookingDatesIsAvailable($id,$category_id,$startdate,$enddate,$current_id="")
{
            $this->db->select('booking_date_to, booking_date_from');
			$this->db->from('bh_bookings');
			$this->db->where('(booking_date_from BETWEEN "' . $startdate . '" AND "' . $enddate . '") OR (booking_date_to BETWEEN "' . $startdate . '" AND "' . $enddate . '")');
			$this->db->where('category_id',$category_id);
			if($current_id!="")
			$this->db->where('id !=',$current_id);
			$this->db->where('listing_id',$id);
			$query = $this->db->get()->result_array();

			return $query;
}

	public function getNoOfDays($start_date,$end_date){

	$end_date = strtotime($end_date);
	$start_date = strtotime($start_date);
	$datediff = $end_date - $start_date;

	$days =  floor($datediff / (60 * 60 * 24));
	return $days;
	}
	public function RemoveZeroFromMONTH($booking_Dates){
		$finaldate = array();
	$date =  explode("-",$booking_Dates);
	$month = $date[1];
	$month = $this->getMonthIDWithoutZero($month);
	$finaldate = $date[0]."-".$month."-".$date[2];
	return $finaldate;
	}


}