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
						<li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
        if(validation_errors())
        echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
        if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
    ?> 							
    <form method="post" action="<?=BASE_URL.'user/resetpassword/'.$user_id.'/'.$reset_pass_key?>" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input id="SaveStatus" name="submitF" type="hidden" value="1" />
    <table>
        <tr>
            <td><input type="password" class="form-control" name="password" placeholder="Password"></td>
        </tr>
        <tr>
            <td><input type="password" class="form-control" name="password2" placeholder="Confirm Password"></td>
        </tr>
        <tr>
            <td><button class="btn btn-lg btn-success btn-block btn-signin" name="submitForm" type="submit">Update</button></td>
        </tr>
    </table> 
        
    </form>  
       
    </div>
</section> 

<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>