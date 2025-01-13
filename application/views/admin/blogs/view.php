<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
<title> <?=strip_tags($BlogData[0]['meta_title'])?></title>
 <meta name="description" content="<?=strip_tags($BlogData[0]['meta_description']);?>">
 <meta name="keyword" content="<?=strip_tags($BlogData[0]['meta_keywords']);?>">
 

   <meta property="og:title" content=" <?=strip_tags($BlogData[0]['title'])?>" /> 
<meta property="og:description" content="<?=strip_tags($BlogData[0]['description']);?>" />
<meta property="og:image" content="<?php echo $this->image->getImageSrc("blogs",$BlogData[0]['blog_image1'],""); ?>" />
 <meta name="author" content="Ritz Media World">
 <link href="<?php echo BASE_URL;?>webroot/front/images/fav-icon.png" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/bootnavbar.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/owl.carousel.min.css">
<!-- <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css"> -->
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/style.css">
<!--link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/new_style.css"-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo BASE_URL;?>webroot/front/js/jquery.validate.min.js" type="text/javascript"></script>
<?php //$this->load->view("Element/front/header_common.php");?>

</head>

<body>
<?php //$this->load->view("Element/front/header.php");?>

<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
<section class="aboutus-section1" style="background: url(<?=$src?>);">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1 style="width: 100%;height:100%;padding: 10px 0;"><?=Ucwords($BlogData[0]['title'])?></h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					   <li class="breadcrumb-item"><a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                    <li class="breadcrumb-item active"><?=Ucwords($category_name[0]['category_name'])?></li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<!--end of about-us section1-->

<!--start contactus-content-->
  <?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>
<section class="contactus-section">
	
	<div class="container">
		<div class="row row1">
			<div class="col-lg-9">
				<div class="left-col">
					
                <div class="projects events-list">
                   
					<?php  //print_r($Blogs);
					
				
					$url_title = str_replace(" ","",$BlogData[0]['title']);
					$url_title = strtolower($url_title);
					$day = date("d",strtotime($BlogData[0]['add_date']));
					$month = date("M",strtotime($BlogData[0]['add_date']));
					?>
                        
						
						<div class="col-md-12 col-sm-12 col-xs-12">
						<?php $src = 'webroot/images/blog_not_found.jpg';
								    $imagename=$BlogData[0]['blog_image1'];
								  $imgpath=$this->image->GetImageDirectory('blogs',$imagename);
								 if($imagename!="" && file_exists($imgpath."/".$imagename)==true){
									$src=($imagename)?$imgpath.'/'.$imagename:"webroot/images/rap_temp.jpg";   
								 }
								 ?>
                               <img src="<?=BASE_URL.$src?>" class="img-responsive blog-img" <?php if($BlogData[0]['img1_size']){ echo "style='width:".$BlogData[0]['img1_size']."%'"; } ?> alt="image">
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="media-body blog_main">
								<header class="post-heading">
									<div class="date-tag"><span><?=$day?></span><?=$month?></div>
									<h4 class="media-heading headingfont"><?=$BlogData[0]['title']?></h4>
								</header> 
								
								<div class="addthis_inline_share_toolbox"></div>
								<div class="clearfix"></div>
								<p>
								<?=stripslashes($BlogData[0]['description'])?>
								</p>
								<?php 
									if($BlogData[0]['youtube_video']){
										if(substr($BlogData[0]['youtube_video'],0,17) == 'https://youtu.be/'){
											$right_url = substr($BlogData[0]['youtube_video'],17);
											$new_url = 'https://www.youtube.com/embed/'.$right_url ;

											echo '<iframe width="560" height="400" src="'.$new_url.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
										}
										else if(substr($BlogData[0]['youtube_video'],0,24) == 'https://www.youtube.com/'){
											$right_url = substr($BlogData[0]['youtube_video'],32,11);
											$new_url = 'https://www.youtube.com/embed/'.$right_url ;
											echo '<iframe width="560" height="400" src="'.$new_url.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
										}
									}
									?>
							</div>
						</div>
						<br><br>
						<?php
							for($i=2;$i<12;$i++){
								if($BlogData[0]['title'.$i] || $BlogData[0]['blog_image'.$i] || $BlogData['description'.$i] || $BlogData[0]['youtube_video'.$i]){
						?>
						<?php if($BlogData[0]['blog_image'.$i]){ ?>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<?php
								$src = 'webroot/images/blog_not_found.jpg';
								$imagename=$BlogData[0]['blog_image'.$i];
								$src='webroot/images/blogs/'.$imagename;
							?>
                               <img src="<?=BASE_URL.$src?>" class="img-responsive blog-img" <?php if($BlogData[0]['img'.$i.'_size']){ echo "style='width:".$BlogData[0]['img'.$i.'_size']."%'"; } ?> alt="image">
						</div>
						<?php }?>
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="media-body blog_main">
								<?php
									if($BlogData[0]['title'.$i]){
								?>
								<header class="post-heading">
									<!-- <div class="date-tag"><span><?=$day?></span><?=$month?></div> -->
									<h4 class="media-heading headingfont"><?=$BlogData[0]['title'.$i]?></h4>
								</header>
								<div class="addthis_inline_share_toolbox"></div>
								<div class="clearfix"></div>
								<?php } ?>
								<?php if($BlogData[0]['description'.$i]){ ?>
								<p>
								<?=stripslashes($BlogData[0]['description'.$i])?>
								</p>
								<?php } ?>
								<?php 
									if($BlogData[0]['youtube_video'.$i]){
										if(substr($BlogData[0]['youtube_video'.$i],0,17) == 'https://youtu.be/'){
											$right_url = substr($BlogData[0]['youtube_video'.$i],17);
											$new_url = 'https://www.youtube.com/embed/'.$right_url ;

											echo '<iframe width="560" height="400" src="'.$new_url.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
										}
										else if(substr($BlogData[0]['youtube_video'.$i],0,24) == 'https://www.youtube.com/'){
											$right_url = substr($BlogData[0]['youtube_video'.$i],32,11);
											$new_url = 'https://www.youtube.com/embed/'.$right_url ;
											echo '<iframe width="560" height="400" src="'.$new_url.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
										}
									}
								?>
							</div>
                		</div>
						<br><br>
						<?php
							}
						}
						?>
                </div>
            </div>
            </div>

			
			
			<div class="col-lg-3">
				
					
					<!-- <form action="<?=BASE_URL?>blogs/search" method="post"> -->
					<form action="#" method="post">
					 <input type="text" name="search_key" placeholder="Search" class="col-md-12 blog_search" value="<?=@$searckkey?>">
					
					<script>
					function changeUrl(searchval){
						window.location.href='<?=BASE_URL?>blogs/archive/'+searchval;
					}
					</script>
					 
					 
					 
					 <button  class="btn btn-danger btn-md pull-right col-md-12" name="submit">Search</button>
					 </form>
				
			
            
                <div class="widget widget_categories animated fadeInUp in" data-animation="fadeInUp" data-delay="0">

                    <header class="heading headingfont">

                        <h4 class="blog_head">Archives</h4>

                    </header>

                    <ul>
<?php 
	foreach($this->blog_model->getALLMonthBlogs() as $Allmonth) {


?>
                        <li class="new_list4"><a href="#"><?=$this->commonmod_model->getMonthName($Allmonth['month']);?> <?=$Allmonth['year']?></a></li>
<?php } ?>
                        
                   

                    </ul>

                </div>
				
				<div class="widget widget_categories animated fadeInUp in" data-animation="fadeInUp" data-delay="0">

                    <header class="heading headingfont">

                        <h4 class="blog_head">Categories</h4>

                    </header>

                    <ul>
                    <?php
							foreach($Category_list as $BlogCatData){ 
								// $cat_url_title = create_url($BlogCatData['category_name']);		
						?>
                        <li>
							<a href="#"><?=$BlogCatData['category_name']?></a>
							(<?=$this->commonmod_model->GetCountBlogBycategory($BlogCatData['id']);?>)
						</li>
						<?php } ?>
                        
                   

                    </ul>

                </div>
	<!--featured articles-->

                 
            </div>
 
        </div>
        </div>
        </section>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bf100525fc5cf"></script> 

<script>
	$(".blog_main a").attr("target", "_blank");
</script>
<?php $this->load->view("Element/admin/blog_footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>