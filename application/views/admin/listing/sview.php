<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>View Listing</title>
    <?php $this->load->view("Element/admin/header_common.php");?>

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
     <?php $this->load->view("Element/admin/header.php");?>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> View  Listing</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support"> Listings</a></li>						  	
											  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            View  Listing
							<br>
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/support" title="Back">Back</a>
                          </header>
                          <div class="panel-body">
 <?php
						
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

 ?> 
  <div class="col-md-8">
 <table width="100%"  class="Bordertables" >
 <?php if(isset($SupportData[0]['user_id']) && $SupportData[0]['user_id']!=''){ ?>
 <tr><td width="30%" class="leadBG">Agent</td><td><a href="<?=BASE_URL?>admin/view-user/<?=$SupportData[0]['user_id']?>"><?=$this->commonmod_model->GetUserName($SupportData[0]['user_id']);?></a></td></tr>
 <?php } ?>
 
  
 
 <?php if(isset($SupportData[0]['listing_title']) && $SupportData[0]['listing_title']!=''){ ?>
 <tr><td width="30%" class="leadBG">Property Name </td><td><?=$SupportData[0]['listing_title'];?></td></tr>
 <?php } ?>

  <?php  if(isset($SupportData[0]['listing_description']) && $SupportData[0]['listing_description']!=''){ 
  
  ?>
 <tr><td width="30%" class="leadBG">Description</td><td><?=$SupportData[0]['listing_description'];?></td></tr>
 
 <?php } if(isset($SupportData[0]['listing_image1']) && $SupportData[0]['listing_image1']!=''){ 
 
 
	$src = $this->image->getImageSrc("support",$SupportData[0]['listing_image1'],""); 	 
		 
 ?>
 <tr><td width="30%" class="leadBG">Listing Image 1</td><td><img src="<?=$src;?>" style="width:100px;"></td></tr>

 <?php   } $videosrc = $this->image->getVideoSrc("listings/video",$SupportData[0]['listing_video'],""); ?>
  <tr><td width="30%" class="leadBG">Video</td><td> 
  <?php echo $this->commonmod_model->getReturnvideoHtml(BASE_URL.$videosrc,"video1","100","80");  ?>
					</td></tr>
 
 
 

 <?php  if(isset($SupportData[0]['city']) && $SupportData[0]['city']!=''){ ?>
 <tr><td width="30%" class="leadBG">City</td><td><?=$this->commonmod_model->GetCityName($SupportData[0]['city']);?></td></tr>
 
 <?php } if(isset($SupportData[0]['state']) && $SupportData[0]['state']!=''){ ?>
 <tr><td width="30%" class="leadBG">State</td><td><?=$this->commonmod_model->GetStateName($SupportData[0]['state']);?></td></tr>
 
  <?php } if(isset($SupportData[0]['country']) && $SupportData[0]['country']!=''){ ?>
 <tr><td width="30%" class="leadBG">Country</td><td><?=$this->commonmod_model->GetCountryName($SupportData[0]['country']);?></td></tr>
 <?php } if(isset($SupportData[0]['approx_distance']) && $SupportData[0]['approx_distance']!=''){ ?>
 <tr><td width="30%" class="leadBG">Approx Distance</td><td><?=nl2br($SupportData[0]['approx_distance']);?></td></tr>
 
 <?php } if(isset($SupportData[0]['property_features']) && $SupportData[0]['property_features']!=''){ ?>
 
  <tr><td width="30%" class="leadBG">Property Features</td><td><?=nl2br($SupportData[0]['property_features']);?></td></tr>
 <?php } if(isset($SupportData[0]['add_date']) && $SupportData[0]['add_date']!=''){ ?>
 <tr><td width="30%" class="leadBG">Add Date</td><td><?=date("d M, Y",strtotime($SupportData[0]['add_date']));?></td></tr>
 
 
<?php } if(isset($SupportData[0]['status']) && $SupportData[0]['status']!=''){ ?>
 <tr><td width="30%" class="leadBG">Status</td><td><?=($SupportData[0]['status']==1)?'Active':'In-Active';?></td></tr>
  <?php } ?>
 
 </table>
</div>
                           
                          </div>
                      </section>
                  </div>
              </div>
            
		
              <!-- project team & activity end -->

          </section>
         <?php $this->load->view("Element/admin/footer_common.php");?>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

 <?php $this->load->view("Element/admin/footer.php");?>
 
 <script>
 $(window).load(function (){
	 show_state(<?=$SupportData[0]['country'];?>,<?=$SupportData[0]['state'];?>);
	 show_city(<?=$SupportData[0]['state'];?>,<?=$SupportData[0]['city'];?>);
 });
      function show_state(country,current_id){ 
       
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_state'); ?>",
          type: "POST",
          data: {'countryval': country ,'current_id':current_id },
		  dataType: 'json',
           success: function(data2){
           
           $("#state").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	    function show_city(state,current_id) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_city'); ?>",
          type: "POST",
          data: {'state': state, 'current_id':current_id },
		  dataType: 'json',
           success: function(data){
           
           $("#city").html(data);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
    
 </script>

  </body>
</html>
