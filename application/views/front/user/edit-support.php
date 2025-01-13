<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Bhalaai">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
</head>
<body>
<?php $this->load->view("Element/front/header.php");?>

<!--second-head-->
<div class="second-head2">
<div class="container">
<div class="left-align col-md-6">
<p>Edit Properties</p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / Edit Properties</p>
</div>

</div>
</div><!--second-head-->












<div class="padding20px_leftright">
        
<div class="col-md-3">
  <br>
  <br>
  <?php $this->load->view("Element/front/myaccount-left.php");?>
  
</div> 
 
<div class="col-md-9">
  
  
  <div class="col-md-12 col-sm-12 col-xs-12">
  
  
  <!------------body--------->
				            
     
				<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:10px;"></div> </div>
				
				
				
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                         
				<div class="col-sm-12 main-content" style="margin-top:20px; margin-bottom:20px;">
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title text-center">Edit Properties</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body">
                    <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
<form method="post" action="<?=BASE_URL.'user/edit_support/'.$listing[0]['id']?>" id="" class="form-horizontal" role="form" enctype="multipart/form-data">

<input id="SaveStatus" name="submitF" type="hidden" value="1" />
 <input id="user_id" name="user_id" type="hidden" value="<?=$listing[0]['user_id']?>" />
                             
                                
                              
<div class="form-group">
                  <label for="icode" class="col-md-12">Title</label>
                 <div class="col-md-12">
<input class="form-control" value="<?=(isset($listing[0]['listing_title'])!='')?$listing[0]['listing_title']:''?>" name="listing_title" placeholder="Title" type="text">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="comment" class="col-md-12">Description</label>
                                    <div class="col-md-12">
                                        <textarea name="listing_description" class="form-control ckeditor" rows="5" id="comment"><?=(isset($listing[0]['listing_description'])!='')?$listing[0]['listing_description']:''?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="email" class="col-md-12">Image</label>
                                    <div class="col-md-12">
                 <input name="listing_image1" value="listing_image1" id="fileupload" class="form-control" placeholder="" type="file">
                  <?php  $src = $this->image->getImageSrc("listings",$listing[0]['listing_image1'],"");?>
                  <img src="<?=$src?>" style="width:110px;"/>
				   <span>Image Size must be (400 px * 400 px) - 2 MB</span>
                                    </div>
                                </div>
                                
								
                                
                               
                                                              
                                <div class="form-group">
                                    <label for="sel5" class="col-md-12">Country</label>
                                  <div class="col-md-12">
  <select name="country" id="country" class="form-control" onchange="return show_state(this.value,'');">
									<?php
			$allcountry = $this->commonmod_model->GetAllCountry();
			//print_r($allcountry);
			foreach($allcountry as $singleData){
				//$url = $this->create_url($singleData['Title']);
				if(@$listing[0]['country']==$singleData['id'] || $singleData['id']=='101'){ $class= 'selected'; } else{  $class= '';  } ?>
		<option value="<?=$singleData['id'];?>" <?=$class;?>><?=$singleData['name'];?></option>
			<?php }  ?>
            
									 </select>
                                </div>
                                </div>
                                
							   <div class="form-group">
                                    <label for="sel4" class="col-md-12">State</label>
                                  <div class="col-md-12">
                                      <select name="state" id="state" class="form-control" onchange="return show_city(this.value,'');" onfocus="this.size=10;" onblur="this.size=1;" onchange="this.size=1; this.blur();" size="1">
									
									 </select>
                                </div>
                                </div>     
                                                          
								<div class="form-group">
                                    <label for="sel3" class="col-md-12">City</label>
                                  <div class="col-md-12">
                                      <select name="city" id="city" class="form-control" onfocus="this.size=10;" onblur="this.size=1;" onchange="this.size=1; this.blur();" size="1">
									
									 </select>
                                </div>
                                </div>                                
                                   <div class="form-group">
                                    <label for="icode" class="col-md-12">Map</label>
                                    <div class="col-md-12">
  <textarea name="map" class="form-control" rows="5" id="map"><?=(isset($listing[0]['map'])!='')?$listing[0]['map']:''?></textarea>
                                    </div>
                                </div>
								
									<div class="form-group">
						<label for="comment" class="col-md-12">Approx Distance</label>
						<div class="col-md-12">
						<textarea name="approx_distance" class="form-control ckeditor" rows="5" id="approx_distance"><?=(isset($listing[0]['approx_distance'])!='')?$listing[0]['approx_distance']:''?></textarea>
						</div>
						</div> 
							<div class="form-group">
						<label for="comment" class="col-md-12">Property Features</label>
						<div class="col-md-12">
						<textarea name="property_features" class="form-control ckeditor" rows="5" id="property_features"><?=(isset($listing[0]['property_features'])!='')?$listing[0]['property_features']:''?></textarea>
						</div>
						</div>  
								
							
								
                              

								

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 text-center controls">
                                        <button type="submit" class="btn btn-default2">Submit</button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                      
                                    </div>
                                </div>    
                            </form>     

                        </div>                     
                    </div>
                </div>	
 					  
                
			</div>
		
	 
  
  <!-------------close body------>
  
  </div>
  
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:100px;"></div> </div> 
</div>  
  
  
  
  
  
</div>






	
<?php $this->load->view("Element/front/footer.php");?>

 <script>
 $(window).load(function (){
	
	  show_state('<?=$listing[0]['country'];?>','<?=$listing[0]['state'];?>'); 
	
	 show_city('<?=$listing[0]['state'];?>','<?=$listing[0]['city'];?>');
 });
      function show_state(country,current_id2){ 
    
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('user/show_state'); ?>",
          type: "POST",
          data: {'countryval': country ,'current_id':current_id2 },
		  dataType: 'json',
           success: function(data2){
         
           $("#state").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	    function show_city(state,current_id2) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('user/show_city'); ?>",
          type: "POST",
          data: {'state': state, 'current_id':current_id2 },
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

<?php $this->load->view("Element/front/footer.php");?>
  <script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
<?php $this->load->view("Element/front/footer_common.php");?>

 