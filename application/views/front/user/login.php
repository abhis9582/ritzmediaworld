<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Vacation">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>
 <body class="login-bg">
 
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
						<li class="breadcrumb-item active" aria-current="page">Login</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contactus-section">

   
   <div class="login-page-box">
       
       

			   <?php 
 echo validation_errors();
echo form_open(BASE_URL.'login',array('class'=>'form-signin'));

if(isset($error)){ ?>  
<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?=$error?></div><?php }?>


<?php if($this->session->flashdata("error")){  ?>                              
<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?=$this->session->flashdata("error")?></div><?php }?>

<?php if($this->session->flashdata("success")){  ?>  
<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                            
<?=$this->session->flashdata("success")?></div><?php } ?>

<input id="SaveStatus" name="submitF" type="hidden" value="1" />
<input id="return_url" name="return_url" type="hidden" value="<?=($this->input->post('return_url'))?$this->input->post('return_url'):''?>" />
   
   <table>
       <tr>
           <td><input type="email" name="email_id" id="inputEmail" class="form-control" placeholder="Please Enter Email Id" required autofocus></td>
       </tr>
       <tr>
           <td><input type="password" name="password" id="inputPassword" class="form-control" placeholder="Please Enter Password"></td>
       </tr>
       <tr style="display:none;">
           <td><div id="remember" class="checkbox" style="display:none;"><label><input type="checkbox" value="remember-me"> REMEMBER ME</label></div></td>
       </tr>
       <tr>
           <td><button class="btn btn-lg btn-success btn-block btn-signin" type="submit">SIGN IN</button></td>
       </tr>
       <tr>
           <td><a href="<?=BASE_URL?>forgotpassword" class="forgot-password">Forgot password ?</a></td>
       </tr>
   </table> 
       </form><!-- /form -->   
       
       
       
       
   </div>
   
         
</section>



<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>