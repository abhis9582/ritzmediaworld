<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>List Hotel Category</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Hotel Category</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support">Hotel Category</a></li>						  	
											  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                         Hotel Category
						<br>
                          </header>
                          <div class="panel-body">
						 <a style="float:right;margin-bottom:10px;" class="btn btn-primary" href="<?=BASE_URL?>admin/listing/support" title="Back">Back</a> &nbsp;&nbsp;
						
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary" href="<?=BASE_URL?>admin/listing/add_hotel_room/<?=$id?>" title="Back">Add New Hotel Category</a> 
							
				     
					 <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 
		  

 
  <div class="col-lg-12">
		<?php if(count($listing_images) > 0){ ?>
			<table border="1" style="width:100%">
			<tr>
			<th>SN.</th>
			<th>Category Name</th>
			
			
			
			<th>Price SGL </th>
			<th>Price DBL </th>
			<th>Price Third Person </th>
		
			<th>Action</th>
			</tr>
			<?php $i=1; foreach($listing_images as $listing_imagesData){
          
			?>
			<tr>
			<td><?=$i?></td>
			
			<td> <?php  $src = $this->image->getImageSrc("listings",$listing_imagesData['image_name'],"");?>
		<img src="<?=$src?>" style="width:110px;"/> <br>
		<?=$listing_imagesData['image_title']; ?>
			
			</td>
			
			<td> <?=$listing_imagesData['price1']; ?></td>
			<td> <?=$listing_imagesData['price2']; ?></td>
			<td> <?=$listing_imagesData['price3']; ?></td>
			<td>   

				<div class="btn-group">
				<a class="btn btn-success" href="<?=BASE_URL.'admin/listing/edit_hotel_room/'.$listing_imagesData['id'].'/'.$listing_imagesData['listing_id']?>" ><i class="icon_check_alt2"></i></a>
				<a class="btn btn-danger" href="<?=BASE_URL.'admin/listing/delete_hotel_room/'.$listing_imagesData['id'].'/'.$listing_imagesData['listing_id']?>" ><i class="icon_check_alt2"></i></a> 
				</div>
								  
								  </td>
			
			
			</tr>
		
		<?php $i++; } ?>
		</table>
		<?php } ?>
                           
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
