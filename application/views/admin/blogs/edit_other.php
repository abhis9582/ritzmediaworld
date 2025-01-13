<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Blog</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Blog</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/blogs">Blog</a></li>						  	
						<li><i class="fa fa-laptop"></i> <?=(isset($BlogsData[0]['title'])!='')?$BlogsData[0]['title']:''?></li>						  	
					</ol>
				</div>
			</div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Edit Blog<br>
                        <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/blogs/edit/<?php echo $BlogsData[0]['id']; ?>" title="Back">Back</a>
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
                        <form class="form-horizontal" action="<?=BASE_URL.'admin/blogs/edit_other/'.$BlogsData[0]['id'];?>" method="post" enctype="multipart/form-data">
						    <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							<input id="id" name="id" type="hidden" value="<?=$BlogsData[0]['id']?>" />
							
                            <?php
                                for($i=2;$i<12;$i++){

                                $y_arr = json_decode($BlogsData[0]['y'.$i.'_size']);
                                $y_width = $y_arr[0];
                                $y_height = $y_arr[1];
                            ?>
                            <!-- THIS IS BLOG IMAGE --><?php //echo $i;?><!-- DATA   -->
                            <div class="form-group">
                                <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Title (<?php echo $i;?>)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="title<?php echo $i;?>" id="title<?php echo $i;?>" value="<?=$BlogsData[0]['title'.$i];?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Image (<?php echo $i;?>)</label>
                                <div class="col-sm-6">
                                    <input type="file" name='blog_image<?php echo $i;?>' id="blog_image<?php echo $i;?>" class="form-control"> <br>
                                <?php 
                                if($BlogsData[0]['blog_image'.$i]){
                                    $imagename2=$BlogsData[0]['blog_image'.$i];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename2; ?>" style="width:110px;"/>
                                <?php } ?>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (<?php echo $i;?>)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img<?php echo $i;?>_size" id="img<?php echo $i;?>_size" value="<?php echo $BlogsData[0]['img'.$i.'_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (<?php echo $i;?>)</label>
                                <div class="col-sm-6">
                                    <textarea name="description<?php echo $i;?>" id="description<?php echo $i;?>" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description'.$i])!='')?stripslashes($BlogsData[0]['description'.$i]):''?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Youtube Url (<?php echo $i;?>)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="youtube_video<?php echo $i;?>" id="youtube<?php echo $i;?>" value="<?=$BlogsData[0]['youtube_video'.$i];?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                      <label class="col-sm-2 control-label">Youtube Width (<?php echo $i;?>)</label>
                                      <div class="col-sm-2">
                                          <input type="number" name="y<?php echo $i;?>_width" id="y<?php echo $i;?>_width" value="<?php echo $y_width;?>" class="form-control" min="0">
                                      </div>
                                      <label class="col-sm-2 control-label">Youtube Height (<?php echo $i;?>)</label>
                                      <div class="col-sm-2">
                                          <input type="number" name="y<?php echo $i;?>_height" id="y<?php echo $i;?>_height" value="<?php echo $y_height;?>" class="form-control" min="0">
                                      </div>
                                  </div>
                            <?php
                                }
                            ?>
                            
                            
                            <!-- THIS IS BLOG IMAGE 3 DATA   -->
                            <!-- <div class="form-group">
                                <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (3)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image3" id="blog_image3" class="form-control"> <br>
                            <?php 
                                $imagename3=$BlogsData[0]['blog_image3'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename3; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (3)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img3_size" id="img3_size" value="<?php echo $BlogsData[0]['img3_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (3)</label>
                                <div class="col-sm-6">
                                    <textarea name="description3" id="description3" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description3'])!='')?stripslashes($BlogsData[0]['description3']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 4 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (4)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image4" id="blog_image4" class="form-control"> <br>
                            <?php 
                                $imagename4=$BlogsData[0]['blog_image4'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename4; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (4)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img4_size" id="img4_size" value="<?php echo $BlogsData[0]['img4_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (4)</label>
                                <div class="col-sm-6">
                                    <textarea name="description4" id="description4" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description4'])!='')?stripslashes($BlogsData[0]['description4']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 5 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (5)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image5" id="blog_image5" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image5'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (5)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img5_size" id="img5_size" value="<?php echo $BlogsData[0]['img5_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (5)</label>
                                <div class="col-sm-6">
                                    <textarea name="description5" id="description5" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description5'])!='')?stripslashes($BlogsData[0]['description5']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 6 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (6)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image6" id="blog_image6" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image6'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (6)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img6_size" id="img6_size" value="<?php echo $BlogsData[0]['img6_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (6)</label>
                                <div class="col-sm-6">
                                    <textarea name="description6" id="description6" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description6'])!='')?stripslashes($BlogsData[0]['description6']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 7 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (7)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image7" id="blog_image7" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image7'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (7)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img7_size" id="img7_size" value="<?php echo $BlogsData[0]['img7_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (7)</label>
                                <div class="col-sm-6">
                                    <textarea name="description7" id="description7" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description7'])!='')?stripslashes($BlogsData[0]['description7']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 8 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (8)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image8" id="blog_image8" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image8'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (8)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img8_size" id="img8_size" value="<?php echo $BlogsData[0]['img8_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (8)</label>
                                <div class="col-sm-6">
                                    <textarea name="description8" id="description8" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description8'])!='')?stripslashes($BlogsData[0]['description8']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 9 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (9)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image9" id="blog_image9" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image9'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (9)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img9_size" id="img9_size" value="<?php echo $BlogsData[0]['img9_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (9)</label>
                                <div class="col-sm-6">
                                    <textarea name="description9" id="description9" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description9'])!='')?stripslashes($BlogsData[0]['description9']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 10 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (10)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image10" id="blog_image10" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image10'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (10)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img10_size" id="img10_size" value="<?php echo $BlogsData[0]['img10_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (10)</label>
                                <div class="col-sm-6">
                                    <textarea name="description10" id="description10" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description10'])!='')?stripslashes($BlogsData[0]['description10']):''?></textarea>
                                </div>
                            </div> -->

                            <!-- THIS IS BLOG IMAGE 11 DATA   -->
                            <!-- <div class="form-group">
                            <hr style='border:1px solid black;'>
                                <label class="col-sm-2 control-label">Blog Image (11)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="blog_image11" id="blog_image11" class="form-control"> <br>
                            <?php 
                                $imagename5=$BlogsData[0]['blog_image11'];
                                ?>
                                    <img src="<?php echo BASE_URL . 'webroot/images/blogs/'. $imagename5; ?>" style="width:110px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image Size (11)</label>
                                <div class="col-sm-6">
                                    <input type="number" max="100" min="0" name="img11_size" id="img11_size" value="<?php echo $BlogsData[0]['img11_size'];?>" class="form-control">
                                </div>
                            </div>
								  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Blog Description (11)</label>
                                <div class="col-sm-6">
                                    <textarea name="description11" id="description11" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description11'])!='')?stripslashes($BlogsData[0]['description11']):''?></textarea>
                                </div>
                            </div>
                             -->
								  
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4" >
                                    <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Update</button>
                                    <button onclick="window.location.href='<?=BASE_URL?>admin/blogs/edit/<?php echo $BlogsData[0]['id']; ?>'" class="btn btn-default" type="button">Cancel</button>
                                </div>
                            </div>
                        </form>
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