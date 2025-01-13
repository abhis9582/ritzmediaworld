<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
						<li class="breadcrumb-item active" aria-current="page">Register</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contactus-section">
	<?=$Content[0]['page_short_description']?>
	<div class="container">
		<div class="row row1">
			<div class="col-lg-12">
				<div class="left-col">
				
      <?php if($this->session->userdata('bh_front_username')==""){ ?>
       
                         <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 
                            
                        <form method="post" action="<?=BASE_URL.'register'?>" id="" class="form-horizontal" role="form">
                        <input id="SaveStatus" name="submitF" type="hidden" value="1" />
                        <input  name="user_type" type="hidden" value="1" />
                     
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control input_field1" name="first_name" required value="<?=(isset($_POST['first_name'])!='')?$_POST['first_name']:''?>" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control input_field1" required name="last_name" value="<?=(isset($_POST['last_name'])!='')?$_POST['last_name']:''?>" placeholder="Last Name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email Id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control input_field1" required name="email_id" value="<?=(isset($_POST['email_id'])!='')?$_POST['email_id']:''?>"  placeholder="Email Address">
                                    </div>
                                </div>
                                
                               <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Mobile No.</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control input_field1" required name="mobile"  value="<?=(isset($_POST['mobile'])!='')?$_POST['mobile']:''?>" placeholder="Mobile No">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                      <label class="col-sm-3 control-label">Phone No</label>
                                      <div class="col-sm-9">
                                          <input type="text" name="phone" id="phone" value="<?=(isset($_POST['phone'])!='')?$_POST['phone']:''?>" class="form-control input_field1" placeholder="Phone No">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="sel5" class="col-md-3 control-label">Country</label>
                                  <div class="col-md-9">
                                      <select name="country_id" id="country" required class="form-control input_field1" onchange="this.size=1; return show_state(this.value);">
									 <?php
                                        $allcountry = $this->commonmod_model->GetAllCountry();
                                        //print_r($allcountry);
                                        foreach($allcountry as $singleData){
                                            //$url = $this->create_url($singleData['Title']);
                                            if(@$Country_id==$singleData['id'] || $singleData['id']=='101'){ $class= 'selected'; } else{  $class= '';  } ?>
                                    <option value="<?=$singleData['id'];?>" <?=$class;?>><?=$singleData['name'];?></option>
                                        <?php }  ?>
									 </select>
                                </div>
                                </div>
                                
							   <div class="form-group">
                                    <label for="sel4" class="col-md-3 control-label">State</label>
                                  <div class="col-md-9">
                                      <select name="state_id" id="state" required class="form-control input_field1" onchange="this.size=1;return show_city(this.value);">
									
									 </select>
                                </div>
                                </div>     
                                                          
								<div class="form-group">
                                    <label for="sel3" class="col-md-3 control-label">City</label>
                                  <div class="col-md-9">
                                      <input type="text" required class="form-control input_field1" name="city" value=""  placeholder="City">
									  
                                </div>
                                </div>                                
                                 
                                
                                <div class="form-group">
                                    <label for="comment" class="col-md-3 control-label">Address1</label>
                                    <div class="col-md-9">
                                        <textarea name="address_1" class="form-control input_field1" rows="5" id="comment"><?=(isset($_POST['address_1'])!='')?$_POST['address_1']:''?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment" class="col-md-3 control-label">Address2</label>
                                    <div class="col-md-9">
                                        <textarea name="address_2" class="form-control input_field1" rows="5" id="comment"><?=(isset($_POST['address_2'])!='')?$_POST['address_2']:''?></textarea>
                                    </div>
                                </div>
                                
								
								 <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Postcode</label>
                                    <div class="col-md-9">
<input class="form-control input_field1" name="postcode" required value="<?=(isset($_POST['postcode'])!='')?$_POST['postcode']:''?>" placeholder="Pincode" type="text">
                                    </div>
                                </div>
                                  
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" required class="form-control input_field1" name="password" placeholder="Password">
                                    </div>
                                </div>
                              
                                    

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 text-center controls">
                                      <button class="btn btn-primary" name="submitForm" type="submit">Submit</button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">

                                    </div>
                                </div>    
                            </form>     

                     
        <?php } else{  header('Location: '.BASE_URL.'myaccount'); ?>
         <?php } ?> 
    </div>
    </div>
    </div>
    </div>
    </section>
    

 

<?php $this->load->view("Element/front/footer.php");?>





 <script>
 
 $(document).ready(function(){
          $('.combobox').combobox()
        });
		
		 $(document).ready(function(){
          $('.combobox1').combobox1()
        });
		
		
 $(window).load(function (){
	 show_state('101');
 });
      function show_state(country){ 
       
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('user/show_state'); ?>",
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
	   
	    function show_city(state) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('user/show_city'); ?>",
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
    
 </script><?php $this->load->view("Element/front/footer_common.php");?>
 
 