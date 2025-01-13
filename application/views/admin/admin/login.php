<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Welcome to Ritz Media World - Best Advertising and Marketing Agency</title>

    <!-- Bootstrap CSS -->    
    <link href="<?=ADMIN_DIR?>css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?=ADMIN_DIR?>css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?=ADMIN_DIR?>css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?=ADMIN_DIR?>css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?=ADMIN_DIR?>css/style.css" rel="stylesheet">
    <link href="<?=ADMIN_DIR?>css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">

     
<?php 
 echo validation_errors();
echo form_open(BASE_URL.'admin/login',array('class'=>'login-form'));

if(isset($error)){ ?>  
<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?=$error?></div><?php }?>


<?php if($this->session->flashdata("error")){  ?>                              
<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?=$this->session->flashdata("error")?></div><?php }?>

<?php if($this->session->flashdata("success")){  ?>  
<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                            
<?=$this->session->flashdata("success")?></div><?php } ?>	  
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="email" name="email_id" id="email_id" required  class="form-control" placeholder="Email Id" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="password" id="password" required class="form-control" placeholder="Password">
            </div>
            <label class="checkbox displaysNone">
                <input type="checkbox" value="remember-me"> Remember Me
                <!--<span class="pull-right"> <a href="#"> Forgot Password?</a></span> -->
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button> -->
        </div>
      </form>
    <div class="text-right">
            <div class="credits text-center"><br>
              
                
            </div>
        </div>
    </div>


  </body>
</html>
