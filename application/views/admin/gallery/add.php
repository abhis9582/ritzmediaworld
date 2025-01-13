<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add New Image</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Add Image</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add New Image</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Add New Image
                          </header>
                          <div class="panel-body">
                          <?php
  if(validation_errors())
  echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
  if($this->session->flashdata("error")){ 
      echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata("error").'</div>';}
  else if($this->session->flashdata("success")){ 
      echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata("success").'</div>';}
  if(isset($_SESSION['error'])){
      unset($_SESSION['error']);
  }
  else if(isset($_SESSION['success'])){
      unset($_SESSION['success']);
  }
  ?> 
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/gallery/add'?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
                                  <div class="form-group">
								<?php
								$this->db->select("*");
								$this->db->from('bh_support_listings');	

								$this->db->order_by("status","1");
								$this->db->order_by("listing_title","asc");

								$query=$this->db->get();
								$all_data =  $query->result_array(); 

								
								?>
        
									 <label class="col-sm-2 control-label">Category</label>
                                      <div class="col-sm-6">
                                          <select name="category_id" id="category_id" class="form-control">
										  <option value="1000">Home Page Middle Image</option>
										  <option value="1001">Brand Image</option>
										  <option value="1002">What We Offer</option>
										  <option value="1003">Wedding Page</option>
										  <option value="1004">Event Page</option>
										  
										  </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Image Title</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="image_tittle" id="image_tittle" value="<?=(isset($_POST['image_tittle'])!='')?$_POST['image_tittle']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								  	<div class="form-group">
                                      <label class="col-sm-2 control-label">Image Name </label>
                                      <div class="col-sm-6">
                                          <input type="file" name="image_name" id="image_name" class="form-control">
                                      </div>
                                  </div>
                                  
                                  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Banner Description</label>
                                      <div class="col-sm-6">
                                      <textarea class="form-control " name="description" rows="4" cols="50" id="description">
                                      
                                      <?=(isset($_POST['description'])!='')?trim($_POST['description']):''?>
                                      </textarea>
                                         
                                      </div>
                                  </div>
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1">Active</option>
									 <option value="0">In-active</option>
									
									 </select>
                                      </div>
                                  </div>
								  
								 
								  
								  <div class="form-group">
                                          <div class="col-md-offset-4 col-md-4" >
                                              <button class="btn btn-primary" name="submitForm" type="submit">Submit</button>
                                              <button class="btn btn-default" type="button" onclick="window.location.href='<?=BASE_URL?>admin/gallery'">Cancel</button>
                                          </div>
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
	 show_state('101');
 });
      function show_state(country){ 
       
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_state'); ?>",
          type: "POST",
          data: {'countryval': country},
		  dataType: 'json',
           success: function(data2){
           
           $("#state").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	    function show_city(state) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_city'); ?>",
          type: "POST",
          data: {'state': state},
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
