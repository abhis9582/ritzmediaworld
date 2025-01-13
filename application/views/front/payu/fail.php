<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Bhalaai">
<title><?=@$Content[0]['meta_title']?></title>
<meta name="description" content="<?=@$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=@$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
</head>
<body>
<?php $this->load->view("Element/front/header.php");?>
<div class="clearfix"></div>
<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],""); ?>
<div class="banner-area pdt100 pdb100" style="background: url(<?=$src?>);">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="sliderText" style="margin-top:60px;">
		<?php if($Content[0]['heading_title']!=""){ ?>
                <h1><?php $head = strip_tags($Content[0]['heading_title']);
				echo (strlen($head) > 20)?substr($head,0,20):$head;
				?></h1>
		<?php } ?>
            
               <?php if($Content[0]['heading_description']!=""){ ?>
			   <h3><?php $headdes =strip_tags($Content[0]['heading_description']); 
			   
			   echo (strlen($headdes) > 100)?substr($headdes,0,100).'...':$headdes;
			   ?></h3>
			   <?php } ?>
			    <?php if(@$Content[0]['read_more_link']!=""){ ?>
                 <a href="<?=$Content[0]['read_more_link']?>" class="btn btn-default btn-lg redBttn"><?=strip_tags($Content[0]['read_more_text'])?></a>
				<?php } ?>
              </div>
                </div>
            </div>
        </div>
    </div>
   	<div class="clearfix"></div>
<div style=" background-color: rgba(204, 204, 204, 0.49) ;box-shadow: inset 0px 0px 2px 0px rgba(0,0,0,0.75) !important; padding:10px 0px;">
      <div class="container">  
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb magin-top" >
                    <li><a href="<?=BASE_URL?>">Home</a>
                    </li>
                    <li class="active"><?=@$Content[0]['page_heading']?></li>
                   
                </ol>
            </div>
        </div>
    </div>
</div> 
<section class="section1">
  <div class="container">
    <div class="row">
    <div class="heading col-sm-12">
     <h4><?=@$Content[0]['page_heading']?></h4>
   </div>
      <div class="col-sm-12 text-center">     
             <p style="font-size:25px;"><em><?=html_entity_decode(stripslashes($Content[0]['page_short_description']));?></em></p><br>
      </div><!--col-sm-12-->
    </div><!--row-->
  </div><!--container-->
</section>
<section class="section4">
  <div class="container">
    <div class="row">
<div class="sub-heading col-xs-12">
<div class="row magin20">
 <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 	
</div>
</div><!--col-sm-6-->

    </div><!--row-->
  </div><!--container-->
</section>


<footer class="green">
  <div class="container">
    <div class="row">
    
        <div class="col-md-4">
         <h1><span>Get </span>In Touch</h1>
          <div class="clearfix"></div>
         <div class="Touch">
            <ul>
                <li><a>A-95, New Ashok Nagar, New Delhi</a></li>
                <li><span class="red">Free Phone : </span> <a>+91 1800-987654</a></li>
                <li><span class="red">Tele Phone : </span><a> +91 9876-543210</a></li>
                <li><span class="red">Email :</span><a href="#">pradeepbaghel@gmail.com</a></li>             
            </ul>
         </div><!--quicklink-->
      </div><!--col-sm-3-->   
    
    
      <div class="col-md-4">
         <h1><span>Qui</span>ck Links</h1>
         <div class="clearfix"></div>
         <div class="quicklink">
            <ul>
                <li><a href="about.html">About us</a></li>
                <li><a href="about.html">How it Works</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">Emergency Needs</a></li>                                                
                <li><a href="about.html">Your Feedback / Suggestions</a></li>
                <li><a href="donate.html">Donate us</a></li>
                <li><a href="contact.html">Contact</a></li>
                
            </ul>
            
         </div><!--quicklink-->
      </div><!--col-sm-3-->

       <div class="col-sm-4">
         <h1><span>Sm</span>art Giving</h1>
         <div class="clearfix"></div>
         <div class="Touch">
            <ul>
                     <div class="amount1">
                 		 <img src="img/bhalaai-logo.png" />
        			 </div>
              <li>
                 <a>Lorem ipsum dolor sit amet, consectetuer is now adipiscing. Aenean commodo  ligula eget massa.</a>
              </li>
           </ul>
         </div><!--Touch-->
      </div><!--col-sm-6-->
    </div><!--row-->
  </div><!--container-->
</footer>
<script type="text/javascript">
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>