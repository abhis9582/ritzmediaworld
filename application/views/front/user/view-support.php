<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Bhalaai">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>

<!--second-head-->
<div class="second-head2">
<div class="container">
<div class="left-align col-md-6">
<p>View Properties</p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / View Properties</p>
</div>

</div>
</div><!--second-head-->














<div class="padding20px_leftright">
        
<div class="col-md-3 height500">
  <br>
  <br>
  <?php $this->load->view("Element/front/myaccount-left.php");?>
  
</div> 
 
<div class="col-md-9">
  
  
  <div class="col-md-11 col-sm-12 col-xs-12">
  
  
  <!------------after user login--------->
				            
     
			  <div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:20px;"></div> </div>
			  
			   <div class="black_color_p">
                     <h3 class="mainHeadText padding10px_table"> View Properties </h3>
				<br>
                </div>
					
					
 <table class="table">

 
 
 
 <?php if(isset($SupportData[0]['listing_title']) && $SupportData[0]['listing_title']!=''){ ?>
 <tr><td width="30%">Listing Title</td><td><?=$SupportData[0]['listing_title'];?></td></tr>
 <?php } ?>
  <?php if(isset($SupportData[0]['listing_short_description	']) && $SupportData[0]['listing_short_description	']!=''){ ?>
 <tr><td width="30%">Short Description</td><td><?=$SupportData[0]['listing_short_description	'];?></td></tr>
 
  <?php } if(isset($SupportData[0]['listing_description']) && $SupportData[0]['listing_description']!=''){ 
  
  ?>
 <tr><td width="30%">Description</td><td class="black_color_p"><?=html_entity_decode($SupportData[0]['listing_description']);?></td></tr>
 
 <?php } if(isset($SupportData[0]['listing_image1']) && $SupportData[0]['listing_image1']!=''){ 
 
 
	$src = $this->image->getImageSrc("listings",$SupportData[0]['listing_image1'],""); 	 
		 
 ?>
 <tr><td width="30%">Listing Image 1</td><td><img src="<?=$src;?>" width="200px"></td></tr>
 
 <?php } if(isset($SupportData[0]['listing_image2']) && $SupportData[0]['listing_image2']!=''){
	$src = $this->image->getImageSrc("listings",$SupportData[0]['listing_image2'],""); 	 
 ?>
 <tr><td width="30%">Listing Image 2</td><td><img src="<?=$src;?>" width="200px"></td></tr>
 
 <?php } if(isset($SupportData[0]['listing_image3']) && $SupportData[0]['listing_image3']!=''){ 
 $src = $this->image->getImageSrc("listings",$SupportData[0]['listing_image3'],"");
 ?>
 <tr><td width="30%">Listing Image 3</td><td><img src="<?=$src;?>" width="200px"></td></tr>
 
 
  <?php } if(isset($SupportData[0]['listing_video']) && $SupportData[0]['listing_video']!=''){
	  
  $videosrc = $this->image->getVideoSrc("listings/video",$SupportData[0]['listing_video'],""); 
				  
				  if($videosrc!=""){
					  ?>
             <tr><td width="30%">Video</td><td>
				      <?php echo $this->commonmod_model->getReturnvideoHtml(BASE_URL.$videosrc,"video1","100","80"); ?> 
 </td> </tr>
				  <?php } ?>
  
 <?php } if(isset($SupportData[0]['address']) && $SupportData[0]['address']!=''){ ?>
 <tr><td width="30%">Address</td><td><?=$SupportData[0]['address'];?></td></tr>
 
 <?php } if(isset($SupportData[0]['pincode']) && $SupportData[0]['pincode']!=''){ ?>
 <tr><td width="30%">Pincode</td><td><?=$SupportData[0]['pincode'];?></td></tr>
 
 <?php } if(isset($SupportData[0]['city']) && $SupportData[0]['city']!=''){ ?>
 <tr><td width="30%">City</td><td><?=$this->commonmod_model->GetCityName($SupportData[0]['city']);?></td></tr>
 

 <?php } if(isset($SupportData[0]['state']) && $SupportData[0]['state']!=''){ ?>
 <tr><td width="30%">State</td><td><?=$this->commonmod_model->GetStateName($SupportData[0]['state']);?></td></tr>
 
  <?php } if(isset($SupportData[0]['country']) && $SupportData[0]['country']!=''){ ?>
 <tr><td width="30%">Country</td><td><?=$this->commonmod_model->GetCountryName($SupportData[0]['country']);?></td></tr>
  <?php  } if(isset($SupportData[0]['status']) && $SupportData[0]['status']!=''){ ?>
 <tr><td width="30%">Status</td><td><?=($SupportData[0]['status']==1)?'Active':'In-Active';?></td></tr>
  <?php } ?>
 
 </table>	
	 
  
  <!-------------after user login close------>
  
  </div>
  
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:100px;"></div> </div> 
</div>  
  
  
  
  
  
</div>









<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>