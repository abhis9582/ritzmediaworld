<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Hotel Rooms Price</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Hotel Rooms Price</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support">Support Listing</a></li>						  	
											  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                       Edit List Price By Date (Hotel - <?=$listing[0]['listing_title']?>)
							<br>
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/support" title="Back">Back</a>
                          </header>
                          <div class="panel-body">
				     
					 <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 
		  

 
  <div class="col-lg-6">
		
				
			<form method="post" action="<?=BASE_URL.'admin/listing/edit_hotel_price/'.$id.'/'.$listing_id.'/'.$category_id?>" class="form-horizontal" role="form" enctype="multipart/form-data">
			<input id="SaveStatus" name="submitF" type="hidden" value="1" />
			<input id="SaveStatus" name="category_id" type="hidden" value="<?=$category_id?>" />
				<div class="form-group">
                                  	Category - <?=$this->commonmod_model->CategoryName($category_id);?>
                                </div>
								
								<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Date</label>
			<div class="col-md-9">
			<input type="text" class="form-control datepicker" name="room_date" value="<?=(isset($listing_edit_price[0]['room_date'])!='')?$listing_edit_price[0]['room_date']:''?>" placeholder="Room Date">
			</div>
			</div>
								
								
								<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price" value="<?=(isset($listing_edit_price[0]['price'])!='')?$listing_edit_price[0]['price']:''?>" placeholder="Price">
			</div>
			</div>
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price(Room Only) Per Person</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price1" value="<?=(isset($listing_edit_price[0]['price1'])!='')?$listing_edit_price[0]['price1']:''?>" placeholder="Price">
			</div>
			</div>
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price(Room Only) Description</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price1_description" value="<?=(isset($listing_edit_price[0]['price1_description'])!='')?$listing_edit_price[0]['price1_description']:''?>" placeholder="Price 1 Description">
			</div>
			</div>
			
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price(Room With Breakfast) Per Person</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price2" value="<?=(isset($listing_edit_price[0]['price2'])!='')?$listing_edit_price[0]['price2']:''?>" placeholder="Price">
			</div>
			</div>
			
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price(Room With Breakfast) Description</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price2_description" value="<?=(isset($listing_edit_price[0]['price2_description'])!='')?$listing_edit_price[0]['price2_description']:''?>" placeholder="Price 2 Description">
			</div>
			</div>
			
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price(CP SINGLE) Per Person</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price3" value="<?=(isset($listing_edit_price[0]['price3'])!='')?$listing_edit_price[0]['price3']:''?>" placeholder="Price">
			</div>
			</div>
			
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Price(CP Single) Description</label>
			<div class="col-md-9">
			<input type="text" class="form-control" name="price3_description" value="<?=(isset($listing_edit_price[0]['price3_description'])!='')?$listing_edit_price[0]['price3_description']:''?>" placeholder="Price 3 Description">
			</div>
			</div>
								
								
			
			 <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 text-center controls">
                                        <button type="submit" class="btn btn-default2">Submit</button>
                                    </div>
                                </div>
			</form>
			
		
</div>
</form>
                           
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
