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
<script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1491326822260603');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1491326822260603&ev=PageView&noscript=1" />
        </noscript>
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>


<div class="clearfix"></div>
 <?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
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
			    <?php if($Content[0]['read_more_link']!=""){ ?>
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
                    <li class="active"><?=$Content[0]['page_heading']?></li>
                   
                </ol>
            </div>
        </div>
    </div>
</div> 

<section class="getInto">
    <div class="container padLR">
      <p class="conHead"><?=$Content[0]['page_heading'];?></p>
       <div class="line" style="margin-bottom:30px;"><img src="<?=FRONT_DIR?>img/about/line.png" /> </div>
        
       
          <div class="col-md-12">
         <p style="color:#ccc; margin-bottom:30px;">
		 <?=html_entity_decode($Content[0]['page_description']);?>
          </p>
		</div>
		
		

    <div class="container padLR" id="feed">
   
        <!--<div class="col-md-10 col-md-offset-1">
            <input type="text" class="form-control about-box " placeholder="First Name : * ">
            <input type="text" class="form-control about-box " placeholder="Last Name : * ">
            <input type="text" class="form-control about-box " placeholder="Email : * ">
            <textarea class="form-control about-box " rows="10" placeholder="Message : *"></textarea>
        </div>-->
          <div class="col-md-12">
          <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error")) 
	echo '<div class="error" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
if($this->session->flashdata("success")) 
	echo '<div class="success" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

  
  ?> 
		<?php if ($this->session->userdata('bh_front_user_id') != '') { ?> 
		
		
		
		
		  <div class="row" id="feedbackfrm" >	
		<div class="col-sm-8 contact-form">	
 <form class="form-horizontal" action="<?=BASE_URL.'feedback'?>" method="post">	
 	  <input name="submitF" type="hidden" value="1" />
							  <input  name="user_id" type="hidden" value="0" />
             <div class="heading col-sm-12">
           
            </div>
            <div class="col-sm-6 form-group">
              <label class="text-white2">Star*</label>
              <select name="fstar" class="form-control">
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
			  </select>
            </div><!--col-sm-6 form-group-->
          
            <div class="col-sm-12 form-group">
              <label  class="text-white2">Subject*</label>
              <input type="text" name="fsubject" value="<?=($this->input->post("fsubject"))?$this->input->post("fsubject"):''?>" class="form-control">
            </div><!--col-sm-6 form-group-->
            
            <div class="col-sm-12 form-group">
              <label  class="text-white2">Message*</label>
              <textarea name="fmessage" class="form-control"><?=($this->input->post("fmessage"))?$this->input->post("fmessage"):''?></textarea>
            </div><!--col-sm-6 form-group-->
            <div class="col-sm-12"><button type="submit" class="btn btn-danger btn-md buttonsupport">Submit</button>
     	
     </div>
       </form>
	   </div><!--col-sm-8-->    
         
	

	</div>
	<?php }else{  ?>
		<div class="text-white"> <a class="btn btn-danger" href="<?=BASE_URL?>login">Login</a> to give feedback </div>
		<?php } ?>
		
		
		
		<?php  if(count($Allfeedback) > 0) { 
		$i=0; 
		
		foreach($Allfeedback as $Feedbackdata){ 
		if($i < 2){
		 $userData = $this->user_model->UserByID($Feedbackdata['user_id']);
		 
		 $src = $this->image->getImageSrc("users",$userData[0]['user_image1'],"");
		?>
		  <div class="row" id="feedbackfrm" >	
            <div class="col-md-12">
		 <div class="col-md-2">
           <img class="img-thumbnail" src="<?=$src?>" alt="">
         </div><!--col-md-5-->
         <div class="col-md-10 supportbx text-left">
             <h3><?=$userData[0]['first_name']." ".$userData[0]['last_name']?></h3>
          <?=($this->commonmod_model->GetStateName($userData[0]['state'])!="")?'<h5>From '.$this->commonmod_model->GetStateName($userData[0]['state']).'</h5>':'';?>
            <span class="subject text-white2"><?=strip_tags($Feedbackdata['subject']);?></span>
            <p>
             <?=html_entity_decode(strip_tags($Feedbackdata['message']));?>
                
            </p>
             <p class="pull-right text-white2">Date: <?=date("d M, Y",strtotime($Feedbackdata['add_date']))?></p>
         </div><!--col-md-7-->
                </div>
         <div class="clearfix"></div>
	
	</div>
		<?php } $i++; }  } ?>
	
 
  </div> 
<!--<div class="col-md-10 col-md-offset-1" style="text-align:center;">
            <a href="#" class="btn btn-lg redBttn">Send Feedback</a>
        </div>-->
        </div>





		
		    <div class="col-md-12">
		
		
		<?php  if(count($Allfeedback) > 0) { foreach($Allfeedback as $Feedbackdata){ 
		 $userData = $this->user_model->UserByID($Feedbackdata['user_id']);
		 
		 $src = $this->image->getImageSrc("users",$userData[0]['user_image1'],"");
		?>
		  <div class="row" id="feedbackfrm" >	
            <div class="col-md-12">
		 <div class="col-md-2">
           <img class="img-thumbnail" src="<?=$src?>" alt="">
         </div><!--col-md-5-->
         <div class="col-md-10 supportbx text-left">
             <h3><?=$userData[0]['first_name']." ".$userData[0]['last_name']?></h3>
          <?=($this->commonmod_model->GetStateName($userData[0]['state'])!="")?'<h5>From '.$this->commonmod_model->GetStateName($userData[0]['state']).'</h5>':'';?>
            <span class="subject text-white2"><?=strip_tags($Feedbackdata['subject']);?></span>
            <p>
             <?=html_entity_decode(strip_tags($Feedbackdata['message']));?>
                
            </p>
             <p class="pull-right text-white2">Date: <?=date("d M, Y",strtotime($Feedbackdata['add_date']))?></p>
         </div><!--col-md-7-->
                </div>
         <div class="clearfix"></div>
	
	</div>
		<?php }  } ?>
	
  </div> 
<!--<div class="col-md-10 col-md-offset-1" style="text-align:center;">
            <a href="#" class="btn btn-lg redBttn">Send Feedback</a>
        </div>-->
        </div>

</section>





<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>