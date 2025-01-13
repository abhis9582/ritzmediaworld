<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add New User</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Add User</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add New User</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Add New user
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/add-user'?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							    <div class="form-group">
                                      <label class="col-sm-2 control-label">User Type</label>
                                      <div class="col-sm-6" >
                                     <?=$this->commonmod_model->showUserTypeDropDown("");?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">First Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="first_name" id="first_name" value="<?=(isset($_POST['first_name'])!='')?$_POST['first_name']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Last Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="last_name" id="last_name" value="<?=(isset($_POST['last_name'])!='')?$_POST['last_name']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">User Image </label>
                                      <div class="col-sm-6">
                                          <input type="file" name="user_image1" id="user_image1" class="form-control">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Email Id</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="email_id" id="email_id" value="<?=(isset($_POST['email_id'])!='')?$_POST['email_id']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Password</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="password" id="password" value="<?=(isset($_POST['password'])!='')?$_POST['password']:''?>" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Mobile No</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="mobile" id="mobile" value="<?=(isset($_POST['mobile'])!='')?$_POST['mobile']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Phone No</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="phone" id="phone" value="<?=(isset($_POST['phone'])!='')?$_POST['phone']:''?>" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option value="1">Active</option>
									 <option value="2">In-active</option>
									 <option value="2">Archive</option>
									 </select>
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Country</label>
                                      <div class="col-sm-6">
                                     <select name="country" id="country" class="form-control" onchange="return show_state(this.value);">
									 <option value="">Select Country</option>
									 <?php
			$allcountry = $this->commonmod_model->GetAllCountry();
			//print_r($allcountry);
			foreach($allcountry as $singleData){
				//$url = $this->create_url($singleData['Title']);
				if(@$Country_id==$singleData['id'] || $singleData['id']=='101'){ $class= 'selected'; } else{  $class= '';  } ?>
		<option value="<?=$singleData['id'];?>" <?=$class;?>><?=$singleData['name'];?></option>
			<?php }  ?>
									 </select>
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label class="col-sm-2 control-label">State</label>
                                      <div class="col-sm-6" id="statesdiv">
                                     <select name="state" id="state" class="form-control" onchange="return show_city(this.value);">
									
									 </select>
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">City</label>
                                      <div class="col-sm-6">
                                     <select name="city" id="city" class="form-control">
									
									 </select>
                                      </div>
                                  </div>
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Address</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="address" id="address" value="<?=(isset($_POST['address'])!='')?$_POST['address']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								  
								 
								  
								  <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" name="submitForm" type="submit">Submit</button>
                                               <button class="btn btn-default" onclick="window.location.href='<?=BASE_URL?>admin/manage-users';" type="button">Cancel</button>
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

  </body>
</html>
