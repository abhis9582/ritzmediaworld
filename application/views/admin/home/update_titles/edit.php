<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Titles</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Titles</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
					</ol>
				</div>
			</div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Titles<br>
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
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <form class="form-horizontal" action="<?=BASE_URL.'admin/home/update_title'?>" method="post" enctype="multipart/form-data">
                                        <input id="SaveStatus" name="submitF" type="hidden" value="1" />
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Capture Attention Section Description</label>
                                            <div class="col-sm-6">
                                                <textarea name="description1" id="description1"  class="form-control" style="resize:none;" rows="8"><?php echo $head_titles[0]['title1']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Our Service Section Description</label>
                                            <div class="col-sm-6">
                                                <textarea name="description2" id="description2"  class="form-control" style="resize:none;" rows="8"><?php echo $head_titles[0]['title2']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Solution Provider Section Description</label>
                                            <div class="col-sm-6">
                                                <textarea name="description3" id="description3"  class="form-control" style="resize:none;" rows="8"><?php echo $head_titles[0]['title3']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Our Customer Section Description</label>
                                            <div class="col-sm-6">
                                                <textarea name="description4" id="description4"  class="form-control" style="resize:none;" rows="8"><?php echo $head_titles[0]['title4']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Networthy Section Description</label>
                                            <div class="col-sm-6">
                                                <textarea name="description5" id="description5"  class="form-control" style="resize:none;" rows="8"><?php echo $head_titles[0]['title5']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Testimonial Section Description</label>
                                            <div class="col-sm-6">
                                                <textarea name="description6" id="description6"  class="form-control" style="resize:none;" rows="8"><?php echo $head_titles[0]['title6']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-4" >
                                                <button class="btn btn-primary admin-buttns2" name="submitForm" onclick="return confirm('Are you sure you want to update this?')" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <?php $this->load->view("Element/admin/footer_common.php");?>
    </section>
      <!--main content end-->
</section>
  <!-- container section start -->

<?php $this->load->view("Element/admin/footer.php");?>
 
 <script>
 $(window).load(function (){
	 show_state(<?=$BlogCatData[0]['country'];?>,<?=$BlogCatData[0]['state'];?>);
	 show_city(<?=$BlogCatData[0]['state'];?>,<?=$BlogCatData[0]['city'];?>);
 });
      function show_state(country,current_id){ 
       
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_state'); ?>",
          type: "POST",
          data: {'countryval': country ,'current_id':current_id },
		  dataType: 'json',
           success: function(data2){
           
           $("#state").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	    function show_city(state,current_id) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_city'); ?>",
          type: "POST",
          data: {'state': state, 'current_id':current_id },
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
