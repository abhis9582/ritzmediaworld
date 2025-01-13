<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Users</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Users</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Users</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
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
  <header class="panel-heading">
                            Manage User  
							<br>
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                               <div class="col-md-4" style=" margin-top: 8px; margin-bottom: 7px;">
								<select name="user_type" id="user_type" class="form-control" ONCHANGE="redirect(this.value)">
										<option value="<?=BASE_URL?>admin/blogs">Select User Type</option>
										<?php
										$allAgent = $this->commonmod_model->GetAllUserType();
										//print_r($allcountry);
										foreach($allAgent as $key => $value){
										//$url = $this->create_url($singleData['Title']);
										if(@$user_type==$key){ $class= 'selected'; } else{  $class= '';  } ?>
										<option value="<?=BASE_URL?>admin/user/search/<?=$key;?>" <?=$class;?>><?=ucwords($value);?></option>
										<?php }  ?>
											<option value="<?=BASE_URL?>admin/manage-users">All User</option>
										</select>
									</div>	
							<div class="col-md-2">	
<?php 
if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'3','4')){ ?>							
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/add-user" title="Add New User">Add New User</a>
<?php } ?>
                            </div>
							
							
                          </header>
                        
                          <table id="myTable" class="table table-striped table-advance table-hover">
                          
						   <?php if(count($ALL_USER_DATA) > 0) { ?>
                               <thead><tr>
                                 <th> Image</th>
                                 <th> Name</th>
                                 <th> Email </th>
                                 
                                 <th> Address</th>
                                 <th> Mobile</th>
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
							<tr>
                                 <th> Image</th>
                                 <th> Name</th>
                                 <th> Email </th>
                                 
                                 <th> Address</th>
                                 <th> Mobile</th>
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>   
                              <?php  foreach($ALL_USER_DATA as $UserData) { ?>
                              <tr>
                                 <td>
								 <?php $src = $this->image->getImageSrc("users",$UserData['user_image1'],"");  ?>
                                 <img src="<?=$src;?>" style="width:100px;">
								 </td>
                                 <td><?=Ucfirst($UserData['first_name']);?> <?=Ucfirst($UserData['last_name']);?> </td>
                                 <td><?=$UserData['email_id'];?></td>
                                 <td><?=$UserData['address'];?></td>
                                 <td><?=$UserData['mobile'];?></td>
                                 <td><?=($UserData['status']==1)?'Active':(($UserData['status']==2)?'Pending':'Archive');?></td>
                               
                                 <td>
                                  <div class="btn-group">
								  <?php if($UserData['set_home']=="1"){ ?>
								      <a class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i></a>
								  <?php } ?>
								  <?php if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'3','35')){ ?>
                                      <a class="btn btn-primary" href="<?=BASE_URL.'admin/view-user/'.$UserData['user_id']?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
								  <?php } if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'3','6')){ ?>
                                      <a class="btn btn-info" href="<?=BASE_URL.'admin/edit-user/'.$UserData['user_id']?>" onclick="return confirm('Are You Sure to Edit ?');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<?php } if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'3','5')){ ?>
                                      <a class="btn btn-danger" href="<?=BASE_URL.'admin/user/delete_user/'.$UserData['user_id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									  <?php } ?>
                                  </div>
                                  </td>
                              </tr>  
								 <?php } ?>							  
						  						  
						     </tbody>
							 <?php } else{  ?>
						   <tbody>
								
                                                              
							                               <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No records found</td></tr></tbody>
						   <?php } ?>		
                        </table>
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
<script>
function redirect(url){
window.location.href= url ;

}
</script>
 <?php $this->load->view("Element/admin/footer.php");?>
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
  </body>
</html>
