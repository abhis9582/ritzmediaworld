<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>All Corporate Request</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Request</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Listing</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
					         <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
  ?> 
        
                          <header class="panel-heading">
                          Corporate Request
							
							 <br>
                           </header>
                          	<?php $Allrequest =  $this->listing_model->GetAllAdminRequest();?>
                          <table id="myTable" class="table table-striped table-advance table-hover">
                         
						   <?php if(count($Allrequest) > 0) { ?>
                                <thead>
								<tr>
                                  <th>Name</th>
                            <th>Department</th>
                            <th>EmpID</th>
                            <th>Message</th>
                            <th>Add Date</th>
                            <th>Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
							<tr>
                                 <th>Name</th>
                            <th>Department</th>
                            <th>EmpID</th>
                            <th>Message</th>
                            <th>Add Date</th>
                            <th>Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>
                              <?php  foreach($Allrequest as $BlogsData) { ?>
                              <tr>
                                <td><?=$BlogsData['name']?></td>
                        <td><?=$BlogsData['department']?></td>
                        <td><?=$BlogsData['empid']?></td>
                        <td><?=$BlogsData['message']?></td>
                        <td><?=date("d M,Y",strtotime($BlogsData['add_date']));?> </td>
                        <td><?=($BlogsData['status']==0)?'Pending':'Booked';?></td>
                                 <td>
                              <div class="btn-group">
							   	  <a href="<?=BASE_URL?>admin/listing/requestdetail/<?=$BlogsData['id']?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a>
								
								 <a class="btn btn-danger" href="<?=BASE_URL?>admin/listing/rdelete/<?=$BlogsData['id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                  </div>
                                  </td>
                              </tr>  
								 <?php } ?>						  
					 <?php } else{  ?>
						   <tbody>
								
                                                              
							                               <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No records found</td></tr></tbody>
						  								  
						   <?php } ?>									  
                           </tbody>
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
 <script>
function redirect(url){
window.location.href= url ;

}
</script>
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
  </body>
</html>
