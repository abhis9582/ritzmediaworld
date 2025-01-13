<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Ritz Media World - Best Advertising and Marketing Agency</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Dashboard</li>						  	
					</ol>
				</div>
			</div>
              
              
                      <!--div class="row" >
                    <div class="col-lg-6 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?=BASE_URL?>admin/user/search/1">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users  fa-fw fa-3x"></i>
                                </div>
                            
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Corporate Clients
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$this->commonmod_model->GetCountUserByUsertypeAdmin(1);?>
                                    <span id="sparklineA"></span>
                                </div>
                            </div>
							</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="circle-tile">
                             <a href="<?=BASE_URL?>admin/user/search/2">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-thumbs-o-up fa-fw fa-3x"></i>
                                </div>
                          
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Users
                                </div>
                                <div class="circle-tile-number text-faded">
                                      <?=$this->commonmod_model->GetCountUserByUsertypeAdmin(2);?>
                                </div>
                            </div>
							</a>
                        </div>
                    </div>
                   
                    </div-->
					     <div class="row" >
						 
                    <div class="col-md-12">
                        <div class="circle-tile">
                           
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-globe fa-fw fa-3x"></i>
                                </div>
                          
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Total Visitor On Website 
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php
                                        echo $this->admin_model->getVisitorCount();
                                    ?>
                                    <span id="sparklineD"></span>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <!--div class="col-lg-6 col-sm-6">
                        <div class="circle-tile">
                              <a href="<?=BASE_URL?>admin/listing/support">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-heart fa-fw fa-3x"></i>
                                </div>
                           
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Total No of Hotels
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$this->commonmod_model->GetTotalNoSupportpostedFront();?>
                                    <span id="sparklineA"></span>
                                </div>
                            </div>
							 </a>
                        </div>
                    </div-->
                  
                    
                          
                  
      
                </div>

				
				
           <div class="row">
		    <div class="col-lg-9 col-md-12">
					
					
				</div>
              <div class="col-md-3">
            
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
</html>
