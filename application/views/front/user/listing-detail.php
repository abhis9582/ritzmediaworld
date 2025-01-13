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
<p>SEARCH RESULT : <?=$SupportSingleData[0]['listing_title'];?></p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / SEARCH RESULTS / <?=$SupportSingleData[0]['listing_title'];?></p>
</div>

</div>
</div><!--second-head-->



		

  











  




<div class="container">


<div class="col-md-12 empty_space"></div>
<div class="col-md-12 empty_space"></div>



<div class="left-side col-md-8">
	
	
	
	
	
		
        
		
	
    <div class="text-center background_header padding10px" style="display:none;">
	
    <h3 class="black_color_bl ravi_fontweight900"><?=$SupportSingleData[0]['listing_title'];?>, <?=$this->commonmod_model->GetCityName($SupportSingleData[0]['city']);?> , <?=$this->commonmod_model->GetStateName($SupportSingleData[0]['state']);?></h3>
    </div>
	
	
	
	
	 
	<!--  Gallery--> 
	<?php 
	
	$Listing_Images_cat = $this->listing_model->GetSupportListingImagesByCategoryId($id,$category_id);
	 if(count($Listing_Images_cat) > 0 && $category_id!=""){ ?>
    
	
	
	<div class="">
    
	<div id="carousel-example" class="carousel slide" data-ride="carousel">
			
			<div class="carousel-inner"> 
				 <?php $i=1; 
				 foreach($Listing_Images_cat as $ListingImagesData){ 
				 $src = $this->image->getImageSrc("listings",$ListingImagesData['image_name'],"./webroot/front/images_not_found.jpg");
				
				 ?>
					<div class="item  <?=($i==1)?'active':'';?>">
						
					   <img src="<?=$src?>" thumb-url="<?=$src?>" class="img-responsive">
						
						<div class="col-md-12 background_header padding10px">
						<?=nl2br($ListingImagesData['image_title']);?>
					</div>
					
					</div>
					
					
					
				 <?php  $i++; } ?>
							  
				 
				</div>
			<ul class="nav nav-pills nav-justified">
			<?php $i=0; 
			 foreach($Listing_Images_cat as $ListingImagesData){ 
			 $src = $this->image->getImageSrc("listings",$ListingImagesData['image_name'],"./webroot/front/images_not_found.jpg");
			 ?>
				<span data-target="#carousel-example" data-slide-to="<?php echo $i; ?>"><a href="#"><img class="slider_nav_img1" src="<?=$src?>" thumb-url="<?=$src?>"></a></span>
			   
			<?php $i++; } ?>		
			</ul>
				
		</div>
	
    </div>

	 <?php } else if(count($Listing_Images) > 0){ ?>
    
	
	
<div class="">
    
	<div class="">
		
		<div id="carousel-example" class="carousel slide" data-ride="carousel">
			
			<div class="carousel-inner">
			 
			 <?php $i=1; 
			 foreach($Listing_Images as $ListingImagesData){ 
			 $src = $this->image->getImageSrc("listings",$ListingImagesData['image_name'],"./webroot/front/images_not_found.jpg");
			 ?>
				<div class="item  <?=($i==1)?'active':'';?>">
					
				   <img src="<?=$src?>" thumb-url="<?=$src?>" class="img-responsive">
					<div class="col-md-12 background_header padding10px" style="display:none;">
						<?=$ListingImagesData['image_title'];?>
					</div>
					
				</div>
				
				
				
			 <?php $i++; } ?>
						  
			 
			</div>
			
			<ul class="nav nav-pills nav-justified">
			<?php $i=0; 
			 foreach($Listing_Images as $ListingImagesData){ 
			 $src = $this->image->getImageSrc("listings",$ListingImagesData['image_name'],"./webroot/front/images_not_found.jpg");
			 ?>
				<span data-target="#carousel-example" data-slide-to="<?php echo $i; ?>"><a href="#"><img class="slider_nav_img1" src="<?=$src?>" thumb-url="<?=$src?>"></a></span>
			   
			<?php $i++; } ?>		
			</ul>
			
			
			
			
			
			
		</div>
	</div>
	
    </div>
    <?php } ?>
    
    
	
	<span class="font_white_p">
				<?=html_entity_decode(strip_tags($SupportSingleData[0]['listing_description'],"<p></p><ol></ol>"));?>
			</span>
			
			<div class="font_white_p">&nbsp; <!------------empty space--> <div style="height:20px;"></div> </div>
			
			
			<div class="background_header">
				<p class="black_color_bl padding10px h4_font">Approx Distance:</p>
			</div>
			
			<span class="font_white_p">
				<?=html_entity_decode(strip_tags($SupportSingleData[0]['approx_distance'],"<p></p><ol></ol>"));?>
			</span>
			
			
			<div class="background_header">
				<p class="black_color_bl padding10px h4_font">Hotel Features:</p>
			</div>
			
			<span class="font_white_p">
			 <?=html_entity_decode(strip_tags($SupportSingleData[0]['property_features'],"<p></p><ol></ol>"));?>
			</span>
	
	
  
    
</div>








<div class="right-side col-md-4">
<div class="text-center"><h4 class="black_color_bl"> <?=$SupportSingleData[0]['listing_title'];?>, <?=$this->commonmod_model->GetCityName($SupportSingleData[0]['city']);?></h4><hr></hr></div>

	<script>
			function redirect(){
				url = $("#property_type").val();
				if(url=="") return false;
				window.location.href = "<?=BASE_URL.'listing-booking/'.$id.'/'?>"+url;
			}
			</script>
			<div style="padding:10px;margin-top:10px;">
	<form class="form-horizontal">
								 	<div class="form-group">
                                    <div class="col-md-12">
									<select name="property_type" id="property_type"  onchange="redirect(this.value);" required class="form-control">
									<option value="">Please Select</option>
                                       	<?php $allOthercat = $this->commonmod_model->getALLOthersChildCategories(); 
									if(count($allOthercat) > 0){
									
                        $all_supoort_ids = $this->commonmod_model->StringtoArray($SupportSingleData[0]['category_id']);
									
									foreach($allOthercat as $allOthercatData){
										  if(in_array($allOthercatData['id'],$all_supoort_ids)){
									?>
								<option  value="<?=$allOthercatData['id']?>" <?php if($allOthercatData['id']==@$category_id){?> selected <?php } ?>><?=$allOthercatData['category_description']?> </option>
									<?php }  } } ?>   
                                    </select>									
                                    </div>
                                </div>
							<script>
			function redirect(url){
				if(url=="") return false;
				
				window.location.href = "<?=BASE_URL.'listing-detail/'.$id.'/'?>"+url;
			}
				
			function redirect_booking(){
				url = $("#property_type").val();
				if(url=="") return false;
				window.location.href = "<?=BASE_URL.'listing-booking/'.$id.'/'?>"+url;
			}
		
			</script>	
								
								<button type="button" onclick="return redirect_booking();" style="float:right;margin-bottom:10px;" class="btn btn-danger btn-md">Book Now</button> 
									
							
							</form>						
							</div>		 
								
	
<div style="padding:10px;margin-top:10px;">
<?=strip_tags($SupportSingleData[0]['map'],"<iframe></iframe>");?>

</div>
</div>	



</div>


<div class="container">
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:7px;"></div> </div>
</div>






<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:150px;"></div> </div>

<?php $this->load->view("Element/front/footer.php");?>
<script>
$(document).ready(function(){
    var $gallery = $('.gallery');

    $gallery.vitGallery({
        autoplay: false
	
    })
})
</script>
<script type="text/javascript" src="<?=FRONT_DIR?>js/gallery.js"></script>

<?php $this->load->view("Element/front/footer_common.php");?>