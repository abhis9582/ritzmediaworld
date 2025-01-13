<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Admin</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Admin</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Admin</li>						  	
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
                            Manage Admin  
							<br>
							 <?php  if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'1','1')){ ?>
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/add-admin" title="Add New Admin">Add New Admin</a>
							 <?php } ?>
                          </header>
                      
                          <table id="myTable" class="table table-striped table-advance table-hover">
                          
						   <?php if(count($ALL_ADMIN_DATA) > 0) { ?>
                                <thead>
								<tr>
                                 <th> User Name</th>
                                <th> Email </th>
                                 
                                <th> Status</th>
                                <th> Roles</th>
                                 <th>Action</th>
                              </tr>
							     </thead>
							   <tfoot>
							  <tr>
                                 <th> User Name</th>
                                <th> Email </th>
                                 
                                <th> Status</th>
                                <th> Roles</th>
                                 <th>Action</th>
                              </tr>
								</tfoot>
								<tbody>
                              <?php  foreach($ALL_ADMIN_DATA as $UserData) { ?>
                              <tr>
                                 <td><?=Ucfirst($UserData['username']);?> </td>
                                 <td><?=Ucfirst($UserData['email_id']);?> </td>
                              
                                 <td><?=($UserData['status']==1)?'Active':'Archive';?></td>
                                  <td><?=$UserData['roles'];?></td>
                                 <td>
                                  <div class="btn-group">
                                     <br>
							 <?php  if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'1','3')){ ?>
                                      <a class="btn btn-info" href="<?=BASE_URL.'admin/edit-admin/'.$UserData['admin_id']?>" onclick="return confirm('Are You Sure to Edit ?');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									  
							 <?php  } ?>
									  
                                      <?php if($UserData['admin_id']!='1' && $this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'1','33')) { ?>
                                      <a class="btn btn-warning" href="<?=BASE_URL.'admin/permission/'.$UserData['admin_id']?>"><i class="fa fa-cog" aria-hidden="true"></i></a>
									  <?php } if($UserData['admin_id']!='1' && $this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'1','2')) { ?>
                                      <a class="btn btn-danger" href="<?=BASE_URL.'admin/admin/delete_admin/'.$UserData['admin_id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

 <?php $this->load->view("Element/admin/footer.php");?>

  </body>
  
 <script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
</html>
