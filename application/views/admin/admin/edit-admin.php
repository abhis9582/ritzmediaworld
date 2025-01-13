<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Admin</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Admin</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Edit Admin</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Admin
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/edit-admin/'.$USER_DATA[0]['admin_id'];?>" method="post">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="admin_id" name="admin_id" type="hidden" value="<?=$USER_DATA[0]['admin_id']?>" />
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Admin Roles</label>
                                      <div class="col-sm-6">
                                      <select name="roles" class="form-control">
									  <option value="">Select Role</option>
									  <option value="Super Admin" <?php if($USER_DATA[0]['roles']=='Super Admin'){ echo 'selected'; }?>>Super Admin</option>
									  <option value="Admin" <?php if($USER_DATA[0]['roles']=='Admin'){ echo 'selected'; }?>>Admin</option>
									  </select>
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">User Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="username" id="username" value="<?=(isset($USER_DATA[0]['username'])!='')?$USER_DATA[0]['username']:''?>" class="form-control">
                                      </div>
                                  </div>
								   
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Email Id</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="email_id" id="email_id" value="<?=(isset($USER_DATA[0]['email_id'])!='')?$USER_DATA[0]['email_id']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Password</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="password" id="password" value="" class="form-control">
                                      </div>
                                  </div>
								 
								 <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option>Please Select</option>
									 <option value="1" <?=($USER_DATA[0]['status']==1)?'selected="selected"':''?>>Active</option>
									 <option value="0" <?=($USER_DATA[0]['status']==3)?'selected="selected"':''?>>Archive</option>
									 </select>
                                      </div>
                                  </div>
								   
								   <div class="form-group">
                                          <div class="col-md-offset-4 col-md-4">
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
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
	 show_state(<?=$USER_DATA[0]['country'];?>,<?=$USER_DATA[0]['state'];?>);
	 show_city(<?=$USER_DATA[0]['state'];?>,<?=$USER_DATA[0]['city'];?>);
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
