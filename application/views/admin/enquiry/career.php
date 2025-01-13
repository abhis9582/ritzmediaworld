<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Career</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Career</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Career</li>						  	
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
                           Career Enquiry  
						<br>
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
							<div class="col-md-12">		
								
                            </div>
                          </header>
                         
                          <table id="myTable" class="table table-striped table-advance table-hover">
                        
						   <?php if(count($Gallery) > 0) { ?>
                              <thead>  <tr>
                                
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Mobile No</th>
                                 <th>CV</th>
                                 <th>Message</th>
                                 <th>Send Date</th>
                                <th> Action</th>
                               
                               
                              </tr>
							       </thead>
							   <tfoot>
						  <tr>
                                  
								   <th>Name</th>
                                 <th>Email</th>
                                 <th>Mobile No</th>
                                 <th>CV</th>
                                 <th>Message</th>
                                 <th>Send Date</th>
								  <th> Action</th>
                               
                              </tr>
								</tfoot>
								<tbody>   
                              <?php  
							  foreach($Gallery as $GalleryData) { 
								$cv = $this->image->getImageSrc("cv",$GalleryData['cv'],"");
								if($GalleryData['cv']!=""){
								$cv = '<a href="'.$cv.'" target="_blank">'.$cv.'</a>';
								}else{
									$cv = '';
								}
							    ?>
                              <tr>
                                
                               
                                 <td><?=$GalleryData['name'];?> </td>
                                 <td><?=$GalleryData['email'];?> </td>
                                 <td><?=$GalleryData['contact_number'];?> </td>
                                 <td><?=$cv;?> </td>
                                 <td><?=$GalleryData['message'];?> </td>
                                 <td><?=date("d M, Y",strtotime($GalleryData['add_date']));?> </td>

                                   <td>
                              <div class="btn-group">
							    
                                      <a class="btn btn-danger" href="<?=BASE_URL.'admin/enquiry/cdelete/'.$GalleryData['id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							
									  
                                  </div>
                                  </td>
                                 
                              </tr>  
								 <?php } ?>							  
						  						  
						     </tbody>
							 <?php } else{  ?>
						   <tbody>
								
                                                              
							                               <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No records found</td></tr></tbody>
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
