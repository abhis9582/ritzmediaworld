<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add Gallery Images</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Add Gallery Image</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support">Add Gallery Image</a></li>						  	
											  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                       Add Gallery Image
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
		
								
			<form method="post" action="<?=BASE_URL.'admin/listing/add_image/'.$listing_id?>" class="form-horizontal" role="form" enctype="multipart/form-data">
			<input id="SaveStatus" name="submitF" type="hidden" value="1" />
			
			
			 	<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Category</label>
			<div class="col-md-9">
			
				<script>
				function showtitle(value){
				if(value=='2002'){ $("#offer_title").show(); }
				else{ $("#offer_title").hide(); }
				}
				</script>
				 <select name="category_id" id="category_id" class="form-control">
										
										  <option value="2000">Gallery </option>
										  <option value="2001">Activities</option>
										  <option value="2002">Special Offer</option>
										  <option value="2003">Features</option>
										    <option value="2004">Header Banner </option>
										    <option value="2005">Camp/Hotel Gallery </option>
										  
										  </select>	
</div>										  
</div>										  
								
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Image</label>
			<div class="col-md-9">
			<input name="image_name" id="fileupload" class="form-control" placeholder="" type="file">
		
		

			</div>
			</div>
			
			<div class="form-group" id="offer_title" style="display:none;">
			<label for="icode" class="col-md-3 control-label">Offer Title</label>
			<div class="col-md-9">
			<input class="form-control" name="image_title" value="<?=(isset($_POST['image_title'])!='')?$_POST['image_title']:''?>" placeholder="Offer Title" type="text">
			</div>
			</div>
			
			<div class="form-group" style="display:block;">
			<label for="icode" class="col-md-3 control-label">Description</label>
			<div class="col-md-9">
			<textarea class="form-control ckeditor" rows="5" cols="10" name="description"  placeholder="Description" type="text"><?=(isset($_POST['description'])!='')?$_POST['description']:''?></textarea>
			</div>
			</div>
			
			<div class="form-group" style="display:none;">
			<label for="icode" class="col-md-3 control-label">Sort order</label>
			<div class="col-md-9">
			<input class="form-control" name="sort_order" value="<?=(isset($_POST['sort_order'])!='')?$_POST['sort_order']:''?>" placeholder="Sort Order" type="text">
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
<script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
  </body>
</html>
