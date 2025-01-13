<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Listing</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Listing</h3>
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
                            <div class="col-md-10" style="text-align: right; color: #000; line-height: 47px;"> </div>
                               <!--div class="col-md-4" style=" margin-top: 8px; margin-bottom: 7px;" >
								<select name="category_id" id="category_id" class="form-control" ONCHANGE="redirect(this.value)">
										<option value="<?=BASE_URL?>admin/listing/support">Select Category</option>
										<?php
										$allParentcat = $this->commonmod_model->getALLChildCategories(); 
										
										foreach($allParentcat as $AgentData){
										//$url = $this->create_url($singleData['Title']);
										if(@$category_id==$AgentData['id']){ $class= 'selected'; } else{  $class= '';  } ?>
										<option value="<?=BASE_URL?>admin/listing/support_category/<?=$AgentData['id'];?>" <?=$class;?>><?=ucwords($AgentData['category_name']);?></option>
										<?php }  ?>
											<option value="<?=BASE_URL?>admin/listing/support">All Category</option>
										</select>
									</div-->	
										<div class="col-md-2" style="display:block;">	
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/add_support" title="Add New Hotel">Add New Hotel</a> &nbsp;
							
                            </div>
                          </header>
                          
                          <table id="myTable" class="table table-striped table-advance table-hover">
                         
						   <?php if(count($Content) > 0) { ?>
                                <thead>
								<tr>
                                 <th>Hotel Name</th>
                                
                                 <th>City</th>
                                 <th>Add Date</th>
                                
								
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
							<tr>
                                 <th>Hotel Name</th>
                                 
                                 <th>City</th>
                                 <th>Add Date</th>
                                
								
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>
                              <?php  foreach($Content as $ContentData) { ?>
                              <tr>
                                 <td><?=Ucfirst($ContentData['listing_title']);?> </td>
                                
                                 <td><?=$this->commonmod_model->GetCityName($ContentData['city']);?> </td>
                                
                                 <td><?=date("d M,Y",strtotime($ContentData['add_date']));?> </td>
                               
                                 <td><?=($ContentData['status']==1)?'Active':'Archive';?></td>
                               
                                 <td>
                              <div class="btn-group">
							      <a class="btn btn-success" href="<?=BASE_URL.'admin/listing/edit_support/'.$ContentData['id']?>" >Edit Hotel</a>
								  <a class="btn btn-plus" title="Hotel Images" href="<?=BASE_URL.'admin/listing/listing_images/'.$ContentData['id']?>" >Hotel Images</a>
								  
								  <!--a class="btn btn-plus" title="Hotel Images" href="<?=BASE_URL.'admin/listing/listing_hotel_pay/'.$ContentData['id']?>" >Hotel Pay </a-->
								  <!--a class="btn btn-plus" title="Hotel Category" href="<?=BASE_URL.'admin/listing/listing_hotel_room/'.$ContentData['id']?>" >Hotel Room Category</a-->
								 
								  <!--a class="btn btn-plus" title="Manage Price" href="<?=BASE_URL.'admin/listing/manage_inventory/'.$ContentData['id']?>" > Manage Inventory </a-->
								
								<a class="btn btn-danger" title="Delete Hotel" onclick="return confirm('Are You Sure to Delete ?');"  href="<?=BASE_URL.'admin/listing/sdelete/'.$ContentData['id']?>" > Delete Hotel </a>
									  
									  
										
										
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
