<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>
<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
<section class="aboutus-section1" style="background: url(<?=$src?>);">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1><?=$Content[0]['page_heading']?></h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contactus-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="user_left_area">  
            	    <?php $this->load->view("Element/front/myaccount-left.php");?>
            	</div>
            </div>
            <div class="col-lg-9">
                <div class="user_right_area">
                <h3 class="right_heading">Edit Profile</h3>
                <?php
                    if(validation_errors())
                    echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
                    if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'<br></div>';
                ?>
                
                <form method="post" action="<?=BASE_URL.'user/edit_profile'?>/<?=$UserData[0]['user_id']?>" class="form-horizontal" role="form" enctype="multipart/form-data">
		 
						<input id="SaveStatus" name="submitF" type="hidden" value="1" />
						
						<table>
						    <tr>
						        <td><input type="text" name="first_name" value="<?=(isset($UserData[0]['first_name'])!='')?$UserData[0]['first_name']:''?>" placeholder="First Name"></td>
						    </tr>
						    <tr>
						        <td><input type="text" name="last_name" value="<?=(isset($UserData[0]['last_name'])!='')?$UserData[0]['last_name']:''?>" placeholder="Last Name"></td>
						    </tr>
						    <tr>
						        <td><input type="text" name="email_id" value="<?=(isset($UserData[0]['email_id'])!='')?$UserData[0]['email_id']:''?>"  placeholder="Email Address"></td>
						    </tr>
						    <tr>
						        <td><input type="text" name="mobile"  value="<?=(isset($UserData[0]['mobile'])!='')?$UserData[0]['mobile']:''?>" placeholder="Mobile No"></td>
						    </tr>
						    <tr>
						        <td><input type="text" name="phone" id="phone" value="<?=(isset($UserData[0]['phone'])!='')?$UserData[0]['phone']:''?>" placeholder="Phone Number"></td>
						    </tr>
						    <tr>
						        <td>
						            <select name="country" id="country" onchange="return show_state(this.value);">
									<option value="">Select Country</option>
									 <?php
                            			$allcountry = $this->commonmod_model->GetAllCountry();
                            			//print_r($allcountry);
                            			foreach($allcountry as $singleData){
                            				//$url = $this->create_url($singleData['Title']);
                            				if(@$Country_id==$singleData['id'] ){ $class= 'selected'; } else{  $class= '';  } ?>
                            		<option value="<?=$singleData['id'];?>" <?=$class;?>><?=$singleData['name'];?></option>
                            			<?php }  ?>
                            		 </select>
						        </td>
						    </tr>
						    <tr>
						        <td><select name="state" id="state" onchange="return show_city(this.value);"></select></td>
						    </tr>
						    <tr>
						        <td><select name="city" id="city"></select></td>
						    </tr>
						    <tr>
						        <td><input type="text" name="address" placeholder="Address" id="address" value="<?=(isset($UserData[0]['address'])!='')?$UserData[0]['address']:''?>"></td>
						    </tr>
						    <tr>
						        <td><b>User Image</b> <b>Note:</b> We are supported png format. Image dimension : 225px X 225px.</td>
						    </tr>
						    <tr>
						        <td><input name="user_image1" value="user_image1" id="fileupload" class="form-control" placeholder="" type="file"></td>
						    </tr>
						    <tr>
						        <td><?php  $src = $this->image->getImageSrc("users",$UserData[0]['user_image1'],"");?><img src="<?=$src?>" class="img-responsive user-pic"></td>
						    </tr>
						    <tr>
						        <td><button class="btn btn-primary" name="submitForm" type="submit">Submit</button></td>
						    </tr>
						</table>
					</form>
                
                </div>
                
            </div>
        </div>
    </div>
</section>



<?php $this->load->view("Element/front/footer.php");?>
 <script>
 $(window).load(function (){
	
	  show_state('<?=$UserData[0]['country'];?>','<?=$UserData[0]['state'];?>'); 
	
	 show_city('<?=$UserData[0]['state'];?>','<?=$UserData[0]['city'];?>');
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
<?php $this->load->view("Element/front/footer_common.php");?>
