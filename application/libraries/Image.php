<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Image 
{
    public function __construct(){ 

        $this->CI =& get_instance();
	}
 function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = 
            substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
}
//$GUID = getGUID();
//echo "dddd".$GUID;	
	
 public function CreateImageFilename($Guid,$ImageWidth=false,$ImaheHeight=false)
        {
            $fileID=strtolower($Guid);
            if($ImageWidth=="" || $ImaheHeight=="")
            return $fileID;
			else return $fileID.(($ImageWidth)?'_'.$ImageWidth:'').(($ImaheHeight)?'_'.$ImaheHeight:'');
        }

 public function GetAndCreateImageDirectory($baseDirectory,$Guid)
        {           
			//$path = substr(strtolower($Guid),0,1);			
			if(!is_dir("webroot/images/".$baseDirectory))
				{	                   	
					@mkdir("webroot/images/".$baseDirectory,0777,true);					
				} 
			return $path;
        }
 public function GetImageDirectory($baseDirectory,$ImageName)
        {           
			//$path = substr($ImageName,0,1);
			return "webroot/images/".$baseDirectory;
        }
		
	public function getImageSrc($folder_name="",$imagename="",$default_image=""){
		if($default_image==""){
             $default_image='webroot/images/blog_not_found.jpg';
		}
		 $image_src = $default_image;
		 
	      $imgpath=$this->GetImageDirectory($folder_name,$imagename);
		 if($imagename!="" && file_exists($imgpath."/".$imagename)==true){
			$image_src=($imagename)?$imgpath.'/'.$imagename:$default_image;   
		 }
		 return BASE_URL.$image_src;
	}
	
	public function getVideoSrc($folder_name="",$imagename="",$default_image=""){
		
		 $image_src = '';
		 
	      $imgpath=$this->GetImageDirectory($folder_name,$imagename);
		 if($imagename!="" && file_exists($imgpath."/".$imagename)==true){
			$image_src=  BASE_URL.($imagename)?$imgpath.'/'.$imagename:$default_image;   
		 }
		 return $image_src;
	}
	
		public function CreateImage($sourcefilename,$destinationfilename)
		{
		   copy($sourcefilename,$destinationfilename);
		}
		
  public function ImageCrop($source_image,$new_image,$width,$height,$x_axis,$y_axis)
	{	
		$image_config['image_library'] = 'gd2';
		$image_config['source_image'] = $source_image;
		$image_config['new_image'] = $new_image;
		$image_config['quality'] = "100%";
		$image_config['maintain_ratio'] = FALSE;
		$image_config['width'] = $width;
		$image_config['height'] = $height;
		$image_config['x_axis'] = $x_axis;
		$image_config['y_axis'] = $y_axis;	
		$this->CI->load->library('image_lib');		
		$this->CI->image_lib->clear();
		$this->CI->image_lib->initialize($image_config); 
		$this->CI->image_lib->crop();
	}
   public function ImageResize($source_image,$new_image,$width=false,$height=false)
	{	
		$image_config['image_library'] = 'gd2';
		$image_config['source_image'] = $source_image;
		$image_config['new_image'] = $new_image;
		$image_config['create_thumb'] = FALSE;
		$image_config['maintain_ratio'] = TRUE;
		$image_config['quality'] = "100%";
		if($width)  $image_config['width'] = $width;
		if($height) $image_config['height'] = $height;		
		$this->CI->load->library('image_lib');		
		$this->CI->image_lib->clear();
		$this->CI->image_lib->initialize($image_config); 
		$this->CI->image_lib->resize();	
   }
}