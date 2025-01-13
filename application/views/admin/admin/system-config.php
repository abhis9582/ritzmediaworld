<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>System Configuration</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i>Manage System Config</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin">Home</a></li>
						<li><i class="fa fa-laptop"></i>System config</li>						  	
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
                          
                          </header>
                          <div class="panel-body">
						  
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/admin/systemsetting';?>" method="post">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$USER_DATA[0]['id']?>" />
                                 
								  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Website Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="website_name" id="website_name" value="<?=(isset($USER_DATA[0]['website_name'])!='')?$USER_DATA[0]['website_name']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Website Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="website_url" id="website_url" value="<?=(isset($USER_DATA[0]['website_url'])!='')?$USER_DATA[0]['website_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								   
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Website Email Id</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="website_email_id" id="website_email_id" value="<?=(isset($USER_DATA[0]['website_email_id'])!='')?$USER_DATA[0]['website_email_id']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Website Address</label>
                                      <div class="col-sm-6">
                                          <textarea name="website_address" id="website_address" class="form-control"><?=(isset($USER_DATA[0]['website_address'])!='')?$USER_DATA[0]['website_address']:''?></textarea>
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Phone Number</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="phone_number" id="phone_number" value="<?=(isset($USER_DATA[0]['phone_number'])!='')?$USER_DATA[0]['phone_number']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Mobile Number</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="mobile_number" id="mobile_number" value="<?=(isset($USER_DATA[0]['mobile_number'])!='')?$USER_DATA[0]['mobile_number']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Facebook Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="facebook_url" id="facebook_url" value="<?=(isset($USER_DATA[0]['facebook_url'])!='')?$USER_DATA[0]['facebook_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Twitter Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="twitter_url" id="twitter_url" value="<?=(isset($USER_DATA[0]['twitter_url'])!='')?$USER_DATA[0]['twitter_url']:''?>" class="form-control">
                                      </div>
                                  </div> <div class="form-group">
                                      <label class="col-sm-2 control-label">Google+ Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="google_url" id="google_url" value="<?=(isset($USER_DATA[0]['google_url'])!='')?$USER_DATA[0]['google_url']:''?>" class="form-control">
                                      </div>
                                  </div> <div class="form-group">
                                      <label class="col-sm-2 control-label">Instagram Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="vimeo_url" id="vimeo_url" value="<?=(isset($USER_DATA[0]['vimeo_url'])!='')?$USER_DATA[0]['vimeo_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								<div class="form-group">
                                      <label class="col-sm-2 control-label">Linkedin Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="linkedin_url" id="linkedin_url" value="<?=(isset($USER_DATA[0]['linkedin_url'])!='')?$USER_DATA[0]['linkedin_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Youtube Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="youtube_url" id="youtube_url" value="<?=(isset($USER_DATA[0]['youtube_url'])!='')?$USER_DATA[0]['youtube_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Hotel Mail Content</label>
                                      <div class="col-sm-6">
                                          <textarea name="hotel_mail_content" cols="10" rows="15" id="hotel_mail_content" class="form-control ckeditor"><?=(isset($USER_DATA[0]['hotel_mail_content'])!='')?$USER_DATA[0]['hotel_mail_content']:''?></textarea>
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Resorts Mail Content</label>
                                      <div class="col-sm-6">
                                          <textarea name="resorts_mail_content"  cols="10" rows="15" id="resorts_mail_content" class="form-control ckeditor"><?=(isset($USER_DATA[0]['resorts_mail_content'])!='')?$USER_DATA[0]['resorts_mail_content']:''?></textarea>
                                      </div>
                                  </div>
								  
								  
								   
								   <div class="form-group">
                                          <div class="col-md-offset-4 col-md-4">
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
                                              <button class="btn btn-default" type="button">Cancel</button>
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
 
<script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>

  </body>
</html>
