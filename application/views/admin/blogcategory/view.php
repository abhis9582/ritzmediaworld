<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Blog</title>
<?php //$this->load->view("Element/front/header_common.php");?>
<link href="<?php echo BASE_URL;?>webroot/front/images/fav-icon.png" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/bootnavbar.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/owl.carousel.min.css">
<link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/style.css">
<!--link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/new_style.css"-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo BASE_URL;?>webroot/front/js/jquery.validate.min.js" type="text/javascript"></script>
</head>

<body>
<?php //$this->load->view("Element/front/header.php");?>


<?php //$src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],""); ?>
<section class="aboutus-section1" style="background: url(<?=$src?>);">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1><?php if(isset($month)){?>
                    Archive- <?=$this->commonmod_model->getMonthName($month)?> <?=@$year?>
					<?php } else if(isset($searckkey)){ ?>
					 Search - <?=@$searckkey?>
					<?php }else{  ?>
					 Category - <?=@$CategoryData['category_name'];?>
					<?php } ?></h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
                    		<li class="breadcrumb-item">
                                <a href="#">Home</a>
                    		</li>
                    		<li class="breadcrumb-item">
                                <a href="#"></a>
                            </li>
                    		<?php if(isset($month)){?>
								<li class="active">Archive- <?=$this->commonmod_model->getMonthName($month)?> <?=@$year?> </li>
								<?php } else if(isset($searckkey)){ ?>
								<li class="active">Search - <?=@$searckkey?></li>
								<?php }else{  ?>
								<li class="active">Category - <?=@$CategoryData['category_name'];?></li>
							<?php } ?>
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
				<div class="row">
				<?php // print_r($Blogs);
					if(!$Blogs){
				?>
					<div class="col-6 col-md-6 col-lg-6">
						<div class="left-col">
							<h5> No Record Found....</h5>
						</div>
					</div>
				<?php
					}


					foreach($Blogs as $BlogData) { 
					// $url_title = create_url($BlogData['slug_url']);
					$day = date("d",strtotime($BlogData['add_date']));
					$month = date("M",strtotime($BlogData['add_date']));
				?>
					<div class="col-6 col-md-6 col-lg-6">
						<div class="left-col">
							<div class="projects events-list">
								<ul class="media-list">
									<li class="media animated out" data-animation="fadeInLeft" data-delay="0">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<?php $src='webroot/images/blog_not_found.jpg';
												$imagename=$BlogData['blog_image1'];
												$imgpath=$this->image->GetImageDirectory('blogs',$imagename);
												if($imagename!="" && file_exists($imgpath."/".$imagename)==true){
													$src=($imagename)?$imgpath.'/'.$imagename:"webroot/images/rap_temp.jpg";   
												}
											?>
											<a href="#"> <img src="<?= BASE_URL.$src?>" class="media-object" alt="image" style="max-width:100%;max-height:100%;"></a>
										
											<div class="media-body">
												<header class="post-heading">
													<div class="date-tag"><span><?=$day?></span><?=$month?></div>
													<h4 class="media-heading headingfont"><a href="#"><?=$BlogData['title']?></a></h4>
												</header>
												<div class="clearfix"></div>
												<p>
													<?=substr($BlogData['description'],0,200)?>
													<a href="#">[Read More]</a>
												</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>
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
							foreach($this->blog_model->getALLMonthBlogs() as $Allmonth){
						?>
                        <li class="new_list4">
                            <a href="#"><?=$this->commonmod_model->getMonthName($Allmonth['month']);?> <?=$Allmonth['year']?></a>
                            <!-- <a href="#"><?=$this->commonmod_model->getMonthName($Allmonth['month']);?> <?=$Allmonth['year']?></a> -->
                        </li>
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
            </div>
        </div>
    </div>
</section>

<?php $this->load->view("Element/admin/blog_footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>