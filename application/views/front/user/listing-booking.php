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


 <link rel="stylesheet" href="<?=FRONT_DIR?>css/jquery-ui.css">

<!--second-head-->
<div class="second-head2">
<div class="container">
<div class="left-align col-md-6">
<p>Booking  : <?=$SupportSingleData[0]['listing_title'];?></p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / Booking / <?=$SupportSingleData[0]['listing_title'];?></p>
</div>

</div>
</div><!--second-head-->






<div class="container">


<div class="col-md-12 empty_space"></div>
<div class="col-md-12 empty_space"></div>


<div class="col-md-12">
	

<div class="col-sm-8">	
	
      <div class="panel panel-info" >
                    <div class="panel-heading">
				
								
								   <div class="panel-title text-center">Book Now</div>
									

                                     
                                </div>
                     
       </div>     
	   <div class="font_white_p">

                       <?php 
 echo validation_errors();
echo form_open(BASE_URL.'listing-booking/'.$id.'/'.$category_id,array('class'=>'form-horizontal'));

if(isset($error)){ ?>  
<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?=$error?></div><?php }?>


<?php if($this->session->flashdata("error")){  ?>                              
<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?=$this->session->flashdata("error")?></div><?php }?>

<?php if($this->session->flashdata("success")){  ?>  
<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                            
<?=$this->session->flashdata("success")?></div><?php } ?>

     <input id="SaveStatus" name="submitF" type="hidden" value="1" />
     <input id="return_url" name="return_url" type="hidden" value="<?=($this->input->post('return_url'))?$this->input->post('return_url'):''?>" />
                       
					   	<div class="form-group">
                                    <div class="col-md-12">
									<select name="property_type" class="form-control" onchange="redirect(this.value);">
									<option value="">Please Select</option>
                                       	<?php $allOthercat = $this->commonmod_model->getALLOthersChildCategories(); 
									if(count($allOthercat) > 0){
									
                        $all_supoort_ids = $this->commonmod_model->StringtoArray($SupportSingleData[0]['category_id']);
									
									foreach($allOthercat as $allOthercatData){
										  if(in_array($allOthercatData['id'],$all_supoort_ids)){
									?>
								<option  value="<?=$allOthercatData['id']?>" <?php if($allOthercatData['id']==$category_id){?> selected <?php } ?>><?=$allOthercatData['category_description']?> </option>
									<?php }  } } ?>   
                                    </select>									
                                    </div>
                                </div>
			<script>
			function redirect(url){
				if(url=="") return false;
				window.location.href = "<?=BASE_URL.'listing-booking/'.$id.'/'?>"+url;
			}
			</script>
								<div class="form-group">
                                    <div class="col-md-12">
                                        <input id="login-username" type="text" class="form-control " name="email_id" value="" placeholder="Email Id">                                        
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="col-md-12">
                                        <input id="login-username" type="text" class="form-control" name="mobile_number" value="" placeholder="Contact Number: Mobile/Telephone">                                        
                                    </div>
                                </div>
									
								<div class="form-group">
                                    <div class="col-md-12">
                                      <input id="booking_date_from" type="text" class="form-control datepicker" name="booking_date_from" value="" placeholder="Booking From Date: 2017-06-26">                                        
                                    </div>
                                </div>
								
                                <div class="form-group">
                                   	<div class="col-md-12">
                                     <input id="booking_date_to" type="text" class="form-control datepicker" name="booking_date_to" value="" placeholder="Booking To Date: 2017-06-28">                                        
                                    </div>
                                </div>
								
		<div class="form-group">
		<div class="col-md-12">
		<textarea class="form-control" name="comment" placeholder="Please Enter Booking Details"></textarea>                                      
		</div>
		</div>
                                    
								<div class="form-group">
                                  
                                    <!-- Button -->
                                    <div class="col-sm-12 text-center controls">
                                      <button id="btn-login" type="submit" class="btn btn-danger btn-md" style="padding:8px 26px">Submit  </button>
                                    </div>
                                </div>


                                 
                            </form>     

                        </div>                     
                    </div>  
<div class="col-sm-4">	   
		
	
    <div class="text-center background_header padding10px" style="display:none;">
	
	<h3 class="black_color_bl"><?=$SupportSingleData[0]['listing_title'];?>, <?=$this->commonmod_model->GetCityName($SupportSingleData[0]['city']);?> , <?=$this->commonmod_model->GetCityName($SupportSingleData[0]['state']);?></h3>
    </div>
	
	

	<!--  Gallery--> 
    <?php if(count($Listing_Images) > 0){ ?>
    
	
	
	<div class="col-sm-12">
   
	
		<div class="">
			
				
				<div class="carousel-inner2">
				 
				 <?php $i=1; 
				 foreach($Listing_Images as $ListingImagesData){ 
				 $src = $this->image->getImageSrc("listings",$ListingImagesData['image_name'],"./webroot/front/images_not_found.jpg");
				 if($i==1){
				 ?>
					<div class="item  <?=($i==1)?'active':'';?>">
						
					   <img src="<?=$src?>" thumb-url="<?=$src?>" class="img-responsive">
						
						
					</div>
					
					
					
				 <?php } $i++; } ?>
							  
				 
				</div>
				
		</div>
		 <div class="text-center" style="margin-top:15px;"><h4 class="black_color_bl"> <?=$SupportSingleData[0]['listing_title'];?>, <?=$this->commonmod_model->GetCityName($SupportSingleData[0]['city']);?></h4></div>
	
    </div>
	<div class="col-sm-12">
	
	<div class="text-center padding10px black_color_p">
	<div style="height:10px;"></div>
	<?=html_entity_decode(strip_tags($SupportSingleData[0]['listing_description'],"<p></p><ol></ol>"));?>
	
    </div>
    </div>
	
	
	
    <?php } ?>
</div>






</div>
	
	
	
	
</div>
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:150px;"></div> </div>
</div>







<?php $this->load->view("Element/front/footer.php");?>

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script>
  // var unavailableDates = ["9-6-2017", "14-6-2017", "15-6-2017"];
  var html;
 <?php  $html='';

if(count($BookedDate) > 0){
	$i=1; foreach($BookedDate as $BookDatesOne){ 
        if($i==1){ $html = '"'.$BookDatesOne.'"'; 
       } else if($i==count($BookedDate)){   $html .= ',"'.$BookDatesOne.'"';  
       } else {   $html .= ',"'.$BookDatesOne.'"'; }
 $i++; } } ?>
   var unavailableDates = [<?=$html?>];


    function unavailable(date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if ($.inArray(dmy, unavailableDates) == -1) {
            return [true, ""];
        } else {
            return [false, "", "Unavailable"];
        }
    }
	
  $( function() {
    $( ".datepicker" ).datepicker({
              dateFormat: 'yy-mm-dd ',
			 beforeShowDay: unavailable
        });
		
        });
 
  </script>

<?php $this->load->view("Element/front/footer_common.php");?>