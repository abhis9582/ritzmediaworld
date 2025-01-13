<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Hotel dates</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Hotel dates</h3>
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
                          Listing
							
							 <br>
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                               <div class="col-md-4" style=" margin-top: 8px; margin-bottom: 7px;" >
								
									</div>	
										<div class="col-md-2" style="display:block;">	
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/add_hotel_pay/<?=$id?>" title="Add Hotel Dates">Add Hotel dates</a> &nbsp;
							
                            </div>
                          </header>
                          
                          <table id="myTable" class="table table-striped table-advance table-hover">
                         
						   <?php if(count($HotelPayListing) > 0) { ?>
                                <thead>
								<tr>
                                 <th>Start date</th>
                                 <th>End date</th>
                                
								
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
							<tr>
                                  <th>Start date</th>
                                 <th>End date</th>
                                
								
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>
                              <?php  foreach($HotelPayListing as $ContentData) { ?>
                              <tr>
                                 
                                
                                 <td><?=date("d M,Y",strtotime($ContentData['start_date']));?> </td>
                                 <td><?=date("d M,Y",strtotime($ContentData['end_date']));?> </td>
                               
                                 <td><?=($ContentData['status']==1)?'Active':'Archive';?></td>
                               
                                 <td>
                              <div class="btn-group">
							    
								    <a class="btn btn-plus" title="Hotel Images" href="<?=BASE_URL.'admin/listing/edit_hotel_pay/'.$ContentData['id']?>/<?=$ContentData['hotel_id']?>" >Edit Hotel Pay </a><br>
								  
								 
								  <a class="btn btn-plus" title="Manage Price" href="<?=BASE_URL.'admin/listing/delete_hotel_pay/'.$ContentData['id']?>/<?=$ContentData['hotel_id']?>" > Delete </a><br>
								
									  
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
