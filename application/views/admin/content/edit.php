<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Page</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Page</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/content">Page</a></li>						  	
						<li><i class="fa fa-laptop"></i> <?=(isset($BlogsData[0]['page_title'])!='')?$BlogsData[0]['page_title']:''?></li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Page
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/content/edit/'.$ContentData[0]['id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$ContentData[0]['id']?>" />
                                  
								  
								 <div class="col-sm-12">
								  
                                  <div class="form-group">
                                   
                                      <div class="col-sm-12">
									     <label class="control-label">Page Title</label>
                                          <input type="text" name="page_title" id="page_title" value="<?=(isset($ContentData[0]['page_title'])!='')?$ContentData[0]['page_title']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      
                                      <div class="col-sm-12">
									  <label class="control-label">Page Heading</label>
                                          <input type="text" name="page_heading" id="page_heading" value="<?=(isset($ContentData[0]['page_heading'])!='')?$ContentData[0]['page_heading']:''?>" class="form-control">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      
                                      <div class="col-sm-12">
									  <label class="control-label">Page Url</label>
                                          <input type="text" name="page_url" id="page_url" value="<?=(isset($ContentData[0]['page_url'])!='')?$ContentData[0]['page_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								   
								  
								<div class="form-group">
                                    
                                      <div class="col-sm-12">
									    <label class="control-label">Page Description</label>
                                          <textarea name="page_description" id="page_description" value="" class="form-control ckeditor"><?=(isset($ContentData[0]['page_description'])!='')?stripslashes($ContentData[0]['page_description']):''?></textarea>
                                      </div>
                                  </div>
								  
								    
								  </div>
								 <div class="col-sm-12">
								 	<div class="form-group">
                                      
                                      <!--div class="col-sm-12">
									  <label class="control-label">Header Banner Image </label>
                                          <input type="file" name="banner_image" id="banner_image" class="form-control">
										  <?php   
										$src = $this->image->getImageSrc("pages",$ContentData[0]['banner_image'],"");    
										?>
			 <img src="<?=$src?>" style="width:110px;"/> 
                                      </div-->
                                  </div>
                                  
								 
								   <div class="form-group">
                                     
                                      <div class="col-sm-12">
									   <label class="control-label">Meta Title</label>
                                          <input type="text" name="meta_title" id="meta_title" value="<?=(isset($ContentData[0]['meta_title'])!='')?$ContentData[0]['meta_title']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                  
                                      <div class="col-sm-12">
									      <label class="control-label">Meta Description</label>
                                          <input type="text" name="meta_description" id="meta_description" value="<?=(isset($ContentData[0]['meta_description'])!='')?$ContentData[0]['meta_description']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                     
                                      <div class="col-sm-12">
									   <label class="control-label">Meta Keyword</label>
                                          <input type="text" name="meta_keywords" id="meta_keywords" value="<?=(isset($ContentData[0]['meta_keywords'])!='')?$ContentData[0]['meta_keywords']:''?>" class="form-control">
                                      </div>
                                  </div>
								    <div class="form-group">
                                    
                                      <div class="col-sm-12">
									 <label class="control-label">Status</label>
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1" <?=($ContentData[0]['status']==1)?'selected="selected"':''?> >Active</option>
									 <option value="0" <?=($ContentData[0]['status']==0)?'selected="selected"':''?>>In-active</option>
									
									 </select>
                                      </div>
                                  </div>
								  
								  
								  <div class="form-group">
                                        <div class="col-sm-12">
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Update</button>
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
	 show_state(<?=$BlogCatData[0]['country'];?>,<?=$BlogCatData[0]['state'];?>);
	 show_city(<?=$BlogCatData[0]['state'];?>,<?=$BlogCatData[0]['city'];?>);
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
