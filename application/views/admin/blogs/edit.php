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
                            <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/blogs" title="Back">Back</a>
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/blogs/edit/'.$BlogsData[0]['id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$BlogsData[0]['id']?>" />
                                  
								  
								 <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog Category</label>
                                      <div class="col-sm-6">
                                     <select name="category_id" id="category_id" class="form-control">
									 <option>Please Select</option>
									 <?php
			$allblogs = $this->blog_model->getALLBlogCategories();
			//print_r($allcountry);
			foreach($allblogs as $singleData){
				//$url = $this->create_url($singleData['Title']);
				if($BlogsData[0]['category_id']==$singleData['id']){ $class= 'selected'; } else{  $class= '';  } ?>
		<option value="<?=$singleData['id'];?>" <?=$class;?>><?=$singleData['category_name'];?></option>
			<?php }  ?>
									 </select>
                                      </div>
                                  </div>
								  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog Title</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="title" id="title" value="<?=(isset($BlogsData[0]['title'])!='')?$BlogsData[0]['title']:''?>" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog URL</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="slug_url" id="slug_url" value="<?=(isset($BlogsData[0]['slug_url'])!='')?$BlogsData[0]['slug_url']:''?>" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Blog Image </label>
                                      <div class="col-sm-6">
                                          <input type="file" name="blog_image1" id="blog_image1" class="form-control"> <br>
										   <?php   $imagename=$BlogsData[0]['blog_image1'];
	      $imgpath=$this->image->GetImageDirectory('blogs',$imagename);
		 if($imagename!="" && file_exists($imgpath."/".$imagename)==true){ ?>
			 <img src="<?=BASE_URL?><?=($imagename)?$imgpath.'/'.$imagename:"webroot/images/rap_temp.jpg"?>" style="width:110px;"/>   
		<?php 
		} 
		?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Image Size</label>
                                      <div class="col-sm-6">
                                          <input type="number" max="100" min="0" name="img1_size" id="img1_size" value="<?php echo $BlogsData[0]['img1_size'];?>" class="form-control">
                                      </div>
                                  </div>
								  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Youtube Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="youtube_video" id="title" value="<?=(isset($BlogsData[0]['youtube_video'])!='')?$BlogsData[0]['youtube_video']:''?>" class="form-control">
                                      </div>
                                  </div>

                                  <?php $y1_arr = json_decode($BlogsData[0]['y1_size']); ?>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Youtube Width</label>
                                      <div class="col-sm-2">
                                          <input type="number" name="y1_width" id="y1_width" value="<?php echo $y1_arr[0];?>" class="form-control" min="0">
                                      </div>
                                      <label class="col-sm-2 control-label">Youtube Height</label>
                                      <div class="col-sm-2">
                                          <input type="number" name="y1_height" id="y1_height" value="<?php echo $y1_arr[1];?>" class="form-control" min="0">
                                      </div>
                                  </div>
								  
								    <!-- <div class="form-group">
                                      <label class="col-sm-2 control-label">Custom Video Link</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="custom_video" id="title" value="<?=(isset($BlogsData[0]['custom_video'])!='')?$BlogsData[0]['custom_video']:''?>" class="form-control">
                                      </div>
                                  </div> -->
								  
								<div class="form-group">
                                      <label class="col-sm-2 control-label">Blog Description</label>
                                      <div class="col-sm-6">
                                          <textarea name="description" id="description" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description'])!='')?stripslashes($BlogsData[0]['description']):''?></textarea>
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Meta Title</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="meta_title" id="meta_title" value="<?=(isset($BlogsData[0]['meta_title'])!='')?$BlogsData[0]['meta_title']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Meta Description</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="meta_description" id="meta_description" value="<?=(isset($BlogsData[0]['meta_description'])!='')?$BlogsData[0]['meta_description']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">Meta Keyword</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="meta_keywords" id="meta_keywords" value="<?=(isset($BlogsData[0]['meta_keywords'])!='')?$BlogsData[0]['meta_keywords']:''?>" class="form-control">
                                      </div>
                                  </div>
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1" <?=($BlogsData[0]['status']==1)?'selected="selected"':''?> >Active</option>
									 <option value="0" <?=($BlogsData[0]['status']==0)?'selected="selected"':''?>>In-active</option>
									
									 </select>
                                      </div>
                                  </div>
								  
								  <div class="form-group">
                                      <div><a href="<?php echo BASE_URL; ?>admin/blogs/other/edit/<?php echo $BlogsData[0]['id']; ?>">Edit Other Data</a></div>
                                        <div class="col-md-offset-4 col-md-4" >
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Update</button>
                                              <button onclick="window.location.href='<?=BASE_URL?>admin/blogs'" class="btn btn-default" type="button">Cancel</button>
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