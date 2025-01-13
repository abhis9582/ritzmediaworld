<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit User</title>
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
                            Edit User
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/edit-user/'.$USER_DATA[0]['user_id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="user_id" name="user_id" type="hidden" value="<?=$USER_DATA[0]['user_id']?>" />
                                  <div class="form-group" >
                                      <label class="col-sm-2 control-label">User Type</label>
                                      <div class="col-sm-6" >
                                     <?=$this->commonmod_model->showUserTypeDropDown($USER_DATA[0]['user_type']);?>
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">First Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="first_name" id="first_name" value="<?=(isset($USER_DATA[0]['first_name'])!='')?$USER_DATA[0]['first_name']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Last Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="last_name" id="last_name" value="<?=(isset($USER_DATA[0]['last_name'])!='')?$USER_DATA[0]['last_name']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">User Image </label>
                                      <div class="col-sm-6">
                                          <input type="file" name="user_image1" id="user_image1" class="form-control"> <br>
										   <?php   $imagename=$USER_DATA[0]['user_image1'];
	      $imgpath=$this->image->GetImageDirectory('users',$imagename);
		 if($imagename!="" && file_exists($imgpath."/".$imagename)==true){ ?>
			 <img src="<?=BASE_URL?><?=($imagename)?$imgpath.'/'.$imagename:"webroot/images/rap_temp.jpg"?>" style="width:110px;"/>   
		<?php 
		} 
		?>
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
                                      <label class="col-sm-2 control-label">Mobile No</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="mobile" id="mobile" value="<?=(isset($USER_DATA[0]['mobile'])!='')?$USER_DATA[0]['mobile']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Phone No</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="phone" id="phone" value="<?=(isset($USER_DATA[0]['phone'])!='')?$USER_DATA[0]['phone']:''?>" class="form-control">
                                      </div>
                                  </div>
								 <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option>Please Select</option>
									 <option value="1" <?=($USER_DATA[0]['status']==1)?'selected="selected"':''?>>Active</option>
									 <option value="2" <?=($USER_DATA[0]['status']==2)?'selected="selected"':''?>>In-active</option>
									</select>
                                      </div>
                                  </div>
								  
								   <div class="form-group" style="display:none;">
                                      <label class="col-sm-2 control-label">Set Home</label>
                                      <div class="col-sm-6" >
                                     <select name="set_home" class="form-control">
									 <option>Please Select</option>
									 <option value="1" <?=($USER_DATA[0]['status']==1)?'selected="selected"':''?>>Yes</option>
									 <option value="0" <?=($USER_DATA[0]['status']==0)?'selected="selected"':''?>>No</option>
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
				if(@$USER_DATA[0]['country_id']==$singleData['id']){ $class= 'selected'; } else{  $class= '';  } ?>
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
                                          <textarea  name="address" id="address" cols="5" rows="3" class="form-control"><?=(isset($USER_DATA[0]['address'])!='')?$USER_DATA[0]['address']:''?></textarea>
                                      </div>
                                  </div>
								   
								  
								  
								  
								  
								  <div class="form-group">
                                          <div class="col-md-offset-4 col-md-4">
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
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
