<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Category</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Category</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/othercategories">Other Categories</a></li>						  	
						<li><i class="fa fa-laptop"></i> <?=(isset($BlogCatData[0]['category_name'])!='')?$BlogCatData[0]['category_name']:''?></li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Categories
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/othercategories/edit/'.$BlogCatData[0]['id'];?>" method="post">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$BlogCatData[0]['id']?>" />
                                  
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Category Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="category_name" id="category_name" value="<?=(isset($BlogCatData[0]['category_name'])!='')?$BlogCatData[0]['category_name']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								 
								  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Category Description</label>
                                      <div class="col-sm-6">
                                          <textarea  name="category_description" id="category_description" cols="5" rows="3" class="form-control"><?=(isset($BlogCatData[0]['category_description'])!='')?$BlogCatData[0]['category_description']:''?></textarea>
                                      </div>
                                  </div>
								
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Total Rooms</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="total_rooms" id="total_rooms" value="<?=(isset($BlogCatData[0]['total_rooms'])!='')?stripslashes($BlogCatData[0]['total_rooms']):''?>" class="form-control">
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option>Please Select</option>
									 <option value="1" <?=($BlogCatData[0]['status']==1)?'selected="selected"':''?>>Active</option>
									 <option value="0" <?=($BlogCatData[0]['status']==0)?'selected="selected"':''?>>In-active</option>
									 </select>
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Sort Order</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="sort_order" id="sort_order" value="<?=(isset($BlogCatData[0]['sort_order'])!='')?$BlogCatData[0]['sort_order']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								  
								  <div class="form-group">
                                        <div class="col-lg-offset-12 col-lg-12" style="float:right;">
                                              <button class="btn btn-primary" name="submitForm" type="submit">Update</button>
                                              <button class="btn btn-default" type="button">Cancel</button>
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

  </body>
</html>
