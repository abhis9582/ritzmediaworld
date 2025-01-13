<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add New Page</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Add Page</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add New Page</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Add New Page
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/wedding/add'?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							
								   <div class="col-sm-6">
								     
                                  <div class="form-group">
                                     
                                      <div class="col-sm-12">
									   <label class="control-label">Page Title</label>
                                          <input type="text" name="page_title" id="page_title" value="<?=(isset($_POST['page_title'])!='')?$_POST['page_title']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                  
                                      <div class="col-sm-12">
									      <label class="control-label">Page Heading</label>
                                          <input type="text" name="page_heading" id="page_heading" value="<?=(isset($_POST['page_heading'])!='')?$_POST['page_heading']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								
								  
								<div class="form-group">
                                     
                                      <div class="col-sm-12">
									   <label class="control-label">Page Description</label>
                                          <textarea name="page_description" id="page_description" value="" class="form-control ckeditor"><?=(isset($_POST['page_description'])!='')?stripslashes($_POST['page_description']):''?></textarea>
                                      </div>
                                  </div>
								    <div class="form-group">
                                    
                                      <div class="col-sm-12">
									    <label class="control-label">Page Short Description</label>
                                          <textarea name="page_short_description" id="page_short_description" value="" class="form-control ckeditor"><?=(isset($_POST['page_short_description'])!='')?stripslashes($_POST['page_short_description_']):''?></textarea>
                                      </div>
                                  </div>
								  	<div class="form-group">
                                   
                                      <div class="col-sm-12">
									     <label class="control-label">Page Image 1</label>
                                          <input type="file" name="page_image1" id="page_image1" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group" style="display:none;">
                                     
                                      <div class="col-sm-12">
									   <label class="control-label">Page Image 2</label>
                                          <input type="file" name="page_image2" id="page_image2" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group">
                                     
                                      <div class="col-sm-12" style="display:none;">
									   <label class="control-label">Page Image 3</label>
                                          <input type="file" name="page_image3" id="page_image3" class="form-control">
                                      </div>
                                  </div>
								  
								  
								  </div>
								   <div class="col-sm-6">
								
								   	<div class="form-group">
                                      
                                      <div class="col-sm-12">
									  <label class="control-label">Header Banner Image </label>
                                          <input type="file" name="banner_image" id="banner_image" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    
                                      <div class="col-sm-12">
									    <label class="control-label">Bannner Heading Title</label>
                                          <input type="text" name="heading_title" id="heading_title" value="<?=(isset($_POST['heading_title'])!='')?$_POST['heading_title']:''?>" class="form-control">
                                      </div>
                                  </div>
								 
								  
								
								  
								<div class="form-group">
                                      
                                      <div class="col-sm-12">
									   <label class="control-label">Banner Description</label>
                                          <textarea name="heading_description" id="heading_description"  value="" class="form-control ckeditor"><?=(isset($_POST['heading_description'])!='')?stripslashes($_POST['heading_description']):''?></textarea>
                                      </div>
                                  </div>
								    <div class="form-group">
                                    
                                      <div class="col-sm-12">
									    <label class="control-label">Read More text</label>
                                          <input type="text" name="read_more_text" id="read_more_text" value="<?=(isset($_POST['read_more_text'])!='')?$_POST['read_more_text']:''?>" class="form-control">
                                      </div>
                                  </div>
								    <div class="form-group">
                                     <div class="col-sm-12">
									   <label class="control-label">Read More Link</label>
                                          <input type="text" name="read_more_link" id="read_more_link" value="<?=(isset($_POST['read_more_link'])!='')?$_POST['read_more_link']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                    
                                      <div class="col-sm-12">
									    <label class="control-label">Meta Title</label>
                                          <input type="text" name="meta_title" id="meta_title" value="<?=(isset($_POST['meta_title'])!='')?$_POST['meta_title']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                    
                                      <div class="col-sm-12">
									    <label class="control-label">Meta Description</label>
                                          <input type="text" name="meta_description" id="meta_description" value="<?=(isset($_POST['meta_description'])!='')?$_POST['meta_description']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                     
                                      <div class="col-sm-12">
									   <label class="control-label">Meta Keyword</label>
                                          <input type="text" name="meta_keywords" id="meta_keywords" value="<?=(isset($_POST['meta_keywords'])!='')?$_POST['meta_keywords']:''?>" class="form-control">
                                      </div>
                                  </div>
								    <div class="form-group">
                                      
                                      <div class="col-sm-12" >
									  <label class="control-label">Status</label>
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1">Active</option>
									 <option value="0">In-active</option>
									
									 </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                          <div class="col-md-12">
                                             
                                          </div>
                                      </div>
									  
								    <div class="form-group">
                                          <div class="col-md-12">
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
                                              <button class="btn btn-default" type="button">Cancel</button>
                                          </div>
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
    //   function show_state(country){ 
       
    //      if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
    //     $.ajax({
			 // url : "<?php echo base_url('admin/user/show_state'); ?>",
    //       type: "POST",
    //       data: {'countryval': country},
		  // dataType: 'json',
    //        success: function(data2){
           
    //        $("#state").html(data2);
    //        }, 
		  //  error: function(){
		  //  alert("there is error");
		  //  }
    //      });
		 
    //    }
	   
	   //  function show_city(state) {
      
    //     if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
    //     $.ajax({
			 // url : "<?php echo base_url('admin/user/show_city'); ?>",
    //       type: "POST",
    //       data: {'state': state},
		  // dataType: 'json',
    //        success: function(data){
           
    //        $("#city").html(data);
    //        }, 
		  //  error: function(){
		  //  alert("there is error");
		  //  }
    //      });
		 
    //    }
    
 </script>
 <script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
  </body>
</html>
