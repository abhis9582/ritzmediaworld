<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
        <meta name="author" content="GeeksLabs">
        <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Add Menu</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Add Menu</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add Menu</li>						  	
					</ol>
				</div>
			</div>
            
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Add Menu<br>
       <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/menu" title="Back">Back</a>
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/add_menu_list'?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
								  
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Menu Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="menu_name" id="menu_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Menu Url</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="menu_url" id="menu_url" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                <label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Heading</label>
                                <div class="col-sm-6">
                                    <input type="text" name="heading" id="heading" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                      <label class="col-sm-2 control-label">Description</label>
                                      <div class="col-sm-6">
                                          <textarea name="description" id="description" value="" class="form-control ckeditor"></textarea>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Meta Title</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="meta_title" id="meta_title" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Meta Description</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="meta_description" id="meta_description" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Meta Keyword</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="meta_keywords" id="meta_keywords" class="form-control">
                                      </div>
                                  </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Category Name</label>
                                        <div class="col-sm-6" >
                                            <select name="category_id" class="form-control" required>
									            <option>Select Category</option>
                                                <?php
                                                    foreach($allCategory as $cats){
                                                ?>
									            <option value="<?php echo $cats['id']; ?>"><?php echo $cats['category_name']; ?></option>
                                                <?php }?>
									        </select>
                                        </div>
                                    </div>
								    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-6" >
                                            <select name="status" class="form-control">
									            <option value="">Select Status</option>
									            <option value="1">Active</option>
									            <option value="0">In-active</option>
									        </select>
                                        </div>
                                    </div>
								  
								<div class="form-group">
                                    <div class="col-md-offset-4 col-md-4" >
                                        <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
                                        <button class="btn btn-default" onclick="window.location.href='<?=BASE_URL?>admin/menu'"  type="button">Cancel</button>
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
 
 <script>
    $(window).load(function (){
        show_state('101');
    });
    function show_state(country){
        if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
        
        $.ajax({
            url : "<?php echo base_url('admin/user/show_state'); ?>",
            type: "POST",
            data: {'countryval': country},
            dataType: 'json',
            success: function(data2){
                $("#state").html(data2);
            }, 
            error: function(){
            alert("there is error");
            }
        });
		 
    }
	   
	function show_city(state){  
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			url : "<?php echo base_url('admin/user/show_city'); ?>",
            type: "POST",
            data: {'state': state},
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
  <script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
  </body>
</html>
