<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>View User</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> View User</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/manage-users">Manage User</a></li>						  	
						<li><i class="fa fa-laptop"></i><?=$USER_DATA[0]['first_name'] ."".$USER_DATA[0]['last_name']; ?></li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            View User
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
 
<div class="col-md-8">
 <table width="100%"  class="Bordertables">
 <tr ><td width="30%"  class="leadBG">User Type</td><td><?=$this->commonmod_model->GetUserType($USER_DATA[0]['user_type']);?></td>
 </tr>
 <?php if(isset($USER_DATA[0]['first_name']) && $USER_DATA[0]['first_name']!=''){ ?>
 <tr><td width="30%"  class="leadBG">First Name</td><td><?=$USER_DATA[0]['first_name'];?></td></tr>
 <?php } ?>
  <?php if(isset($USER_DATA[0]['last_name']) && $USER_DATA[0]['last_name']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Last Name</td><td><?=$USER_DATA[0]['last_name'];?></td></tr>
  <?php } if(isset($USER_DATA[0]['email_id']) && $USER_DATA[0]['email_id']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Email Id</td><td><?=$USER_DATA[0]['email_id'];?></td></tr>
 <?php } if(isset($USER_DATA[0]['email_id']) && $USER_DATA[0]['email_id']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Mobile No</td><td><?=$USER_DATA[0]['mobile'];?></td></tr>
 <?php } if(isset($USER_DATA[0]['phone']) && $USER_DATA[0]['phone']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Phone No</td><td><?=$USER_DATA[0]['phone'];?></td></tr>
<?php } if(isset($USER_DATA[0]['address']) && $USER_DATA[0]['address']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Address</td><td><?=nl2br($USER_DATA[0]['address']);?></td></tr>

<?php  } if(isset($USER_DATA[0]['user_image1']) && $USER_DATA[0]['user_image1']!=''){ ?>
  <?php $src = $this->image->getImageSrc("users",$USER_DATA[0]['user_image1'],""); ?>
<tr><td width="30%"  class="leadBG">User Image</td><td><img src="<?=$src;?>" style="width:auto; height:200px"></td></tr>
  
 
 <?php } if(isset($USER_DATA[0]['city']) && $USER_DATA[0]['city']!=''){ ?>
 <tr><td width="30%"  class="leadBG">City</td><td><?=$this->commonmod_model->GetCityName($USER_DATA[0]['city']);?></td></tr>
 <?php } if(isset($USER_DATA[0]['state']) && $USER_DATA[0]['state']!=''){ ?>
 <tr><td width="30%"  class="leadBG">State</td><td><?=$this->commonmod_model->GetStateName($USER_DATA[0]['state']);?></td></tr>
  <?php } if(isset($USER_DATA[0]['country']) && $USER_DATA[0]['country']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Country</td><td><?=$this->commonmod_model->GetCountryName($USER_DATA[0]['country']);?></td></tr>
<?php } if(isset($USER_DATA[0]['add_date']) && $USER_DATA[0]['add_date']!=''){ ?>
 <tr><td width="30%"  class="leadBG">Add Date</td><td><?=date("d M, Y",strtotime($USER_DATA[0]['add_date']));?></td></tr>
  <?php } ?>
   

 </table>
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
