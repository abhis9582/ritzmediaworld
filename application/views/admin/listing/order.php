<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Order</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Order</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Order</li>						  	
					</ol>
				</div>
			</div>
              
           
		  <div class="row" style="display:block;">
                          
                          
                  <div class="col-md-3 col-xs-4">
                      <a href="<?=BASE_URL?>admin/listing/order/1">
                        <div class="dashboxes color1">
                              <div class="iconsdash">
                                <i class="fa fa-book  fa-fw fa-2x"></i>
                              </div>
                              <div class="dashtextes">
                                <h3>Booked</h3>
                                 <h2><?=$this->commonmod_model->GetCountOrderStatusAdmin(1,'');?></h2>
                              </div>
                        </div> 
                      </a>
                   </div> 

                   <div class="col-md-3 col-xs-4">
                      <a href="<?=BASE_URL?>admin/listing/order/7">
                        <div class="dashboxes color5">
                              <div class="iconsdash">
                                <i class="fa fa-check-circle fa-fw fa-2x"></i>
                              </div>
                             <div class="dashtextes">
                                <h3>Pending</h3>
                               <h2><?=$this->commonmod_model->GetCountOrderStatusAdmin(3,'');?></h2>
                            </div>
                        </div> 
                      </a>
                  </div>
                 
                  <div class="col-md-3 col-xs-4">
                      <a href="<?=BASE_URL?>admin/listing/order/2">
                        <div class="dashboxes color2">
                             <div class="iconsdash">
                               <i class="fa fa-inr fa-fw fa-2x"></i>
                             </div>
                             <div class="dashtextes">
                                 <h3>Cancelled</h3>
                                  <h2><?=$this->commonmod_model->GetCountOrderStatusAdmin(4,'');?></h2>
                             </div>
                        </div> 
                      </a>
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
                        Manage Order <br>
						
							
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                               	
										
                          </header>
                                 <div class="row">
                           
                        <div class="col-md-12">  
                           <a style="float:right; display:none; margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/add_order" title="Back">Add New Order</a>
			   
							 <br> </div> 
                          </div>
                          <table id="myTable" class="table table-striped table-advance table-hover">
                         
						   <?php if(count($AllorderList) > 0) { ?>
                                <thead>
								<tr>
                               
                                 <th>Name</th>
                                 <th>Customer ID</th>
                                 <th>Order ID</th>
                                 <th>Mobile No</th>
                                
                                 <th>Start Date</th>
                                 <th>End Date</th>
                               
                                 <th>Status</th>
                                
								
                                 <th> Date Added	</th>
                                 <th> View</th>
                              </tr>
							       </thead>
							   <tfoot>
							<tr> 
                            
                                 <th>Name</th>
                                 <th>Cust. ID</th>
                                 <th>Order ID</th>
                                 <th>Mobile</th>
                                 
                                 <th>Start <br>Date</th>
                                 <th>End <br>Date</th>
                               
                                 <th>Status</th>
                                
								
                                 <th> Date <br>Added	</th>
                                 <th> View</th>
                              </tr>
								</tfoot>
								<tbody>
                              <?php  foreach($AllorderList as $ContentData){ 
							      $CustomerData = $this->commonmod_model->GetUserData($ContentData[0]['user_id']);
							  ?>
                              <tr>
                            
                                 <td> <?=Ucfirst($ContentData['firstname']);?> <?=Ucfirst($ContentData['lastname']);?> </td>
                                   <td>#<?=$ContentData['user_id'];?></td>
                                   <td>#<?=$ContentData['order_id'];?></td>
                                   <td><?=$ContentData['mobile'];?></td>
                                  
                                  <td><?=date("d/ m/ Y",strtotime($ContentData['start_date']));?> </td>
                                  <td><?=date("d/ m/ Y",strtotime($ContentData['end_date']));?> </td>
                                     <td><?=$this->commonmod_model->getBookingStatus($ContentData['order_status_id'])?></td>
                                  <td><?=date("d/ m/ Y",strtotime($ContentData['date_added']));?> </td>
                               
                                 <td> <a href="<?=BASE_URL?>admin/listing/orderdetail/<?=$ContentData['order_id']?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a>
								 <a href="<?=BASE_URL?>admin/listing/orderdetail_edit/<?=$ContentData['order_id']?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Edit Order" style="display:none;"><i class="fa fa-pencil-square-o"></i></a>
								 <a class="btn btn-danger" href="<?=BASE_URL?>admin/listing/odelete/<?=$ContentData['order_id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
