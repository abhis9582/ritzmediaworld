<!--div class="counter_text">
	Visitors:<br /><?= $this->commonmod_model->GetVistor(); ?>
	</div-->

<?php if ($RelatedBlogs || $RecentBlogs) { ?>
	<section class="blogs-section">
		<div class="container">
			<div class="row">
				<?php if ($RelatedBlogs) { ?>
					<div class="col-lg-8 col-md-3 col-sm-12 thumb_post">
						<h4>Related Post</h4>
						<ul>
							<?php foreach ($RelatedBlogs as $rb) {
								//$url_title = create_url($rb['slug_url']);
								?>
								<li title="<?php echo ucwords($rb['title']); ?>"><strong
										style="white-space: nowrap;width: 100%;height:100%;overflow: hidden;text-overflow: ellipsis;padding: 10px 0;"><?php echo ucwords($rb['title']) ?></strong><img
										src="<?php echo BASE_URL; ?>webroot/images/blogs/<?php echo $rb['blog_image1']; ?>"
										style="height:175px;" />
									<!-- <a href="<?php echo BASE_URL . 'blog/' . $url_title; ?>">Read More</a> -->
									<a href="#">Read More</a>
								</li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
				<?php if ($RecentBlogs[0]) {
					$i = 1;
					?>
					<div class="col-lg-4 col-md-3 col-sm-12 thumb_post_list">
						<h4>Recent Post</h4>
						<ul>
							<?php foreach ($RecentBlogs as $rb) {
								if ($i < 6) {
									?>
									<?php //$url_title = create_url($rb['slug_url']); ?>
									<li>
										<!-- <a href="<?php echo BASE_URL; ?>blog/<?php echo $url_title; ?>"><?php echo ucwords($rb['title']); ?></a> -->
										<a href="#"><?php echo ucwords($rb['title']); ?></a>
									</li>
									<?php $i++;
								} ?>
							<?php } ?>
						</ul>
						<!-- <h4>Popular Post</h4>
				<ul>
					<li><a href="#">How to Patent a Name Step by step  Guide</a></li>
					<li><a href="#">How to Patent a Name Step by step  Guide</a></li> 
					<li><a href="#">How to Patent a Name Step by step  Guide</a></li> 
				</ul> -->
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>

<section class="customer_p">
	<div class="container">
		<div class="row row1">
			<h1>Customer Pricing Available</h1>
		</div>
		<div class="row row2">
			<p>Contact Us to for free 30 min Consultation.</p>
		</div>
		<div class="row row2">
			<a class="call_btn" href="#">Call +91-7290002168</a>
			<span>or</span>
			<a class="get_btn" href="#">Get Free Proposal</a>
		</div>
	</div>
</section>
<section class="newsletter-section">
	<div class="container">
		<div class="row row1">
			<h1>SUBCRIBE TO OUR NEWSLETTER</h1>
		</div>

		<div class="row row2">
			<p>Leave your e-mail in the form below to sign up to our newsletter and receive regular news, updates, and
				special offers.</p>
		</div>

		<div class="row row3">
			<form action="#">
				<span id="footer_email_msg"></span>
				<div class="form-group">
					<input type="email" id="footer_email" placeholder="Enter Your E-mail" required="">
					<input type="button" class="btn form-inline" name="submit" value="SUBSCRIBE">
				</div>
			</form>


		</div>
	</div>
</section>



<!--end of newsletter section-->
<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>
<!--================ Start Footer Area =================-->


<footer class="footer-area section-gap">
	<div class="container">
		<div class="row footer-inner">
			<div class="col-lg-12">
				<div class="social-links2">
					<ul>
						<?php if (!empty($Systemdata[0]['facebook_url'])) { ?>
							<li><a href="<?= $Systemdata[0]['facebook_url'] ?>"><i class="fa fa-facebook"></i></a></li>
						<?php }
						if (!empty($Systemdata[0]['youtube_url'])) { ?>
							<li><a href="<?= $Systemdata[0]['youtube_url'] ?>"><i class="fa fa-youtube"></i></a></li>
						<?php }
						if (!empty($Systemdata[0]['twitter_url'])) { ?>
							<li><a href="<?= $Systemdata[0]['twitter_url'] ?>"><img
										src="<?php echo BASE_URL; ?>webroot/front/images/X.png" /></a></li>
						<?php }
						if (!empty($Systemdata[0]['linkedin_url'])) { ?>
							<li><a href="<?= $Systemdata[0]['linkedin_url'] ?>"><i class="fa fa-linkedin"></i></a></li>
						<?php }
						if (!empty($Systemdata[0]['vimeo_url'])) { ?>
							<li><a href="<?= $Systemdata[0]['vimeo_url'] ?>"><i class="fa fa-instagram"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
<footer class="footer-area section-gap">
	<div class="container">
		<div class="row footer-inner">
			<div class="col-lg-6 col-md-3 col-sm-12">
				<p>We’ve been in the business for the better part of the last 15 years. So it’s safe to say that we’re
					the most experienced advertising agency in the northern belt of this great nation of India. This
					means that we have been in the trenches with the biggest brands from all business disciplines.</p>
			</div>
			<div class="col-lg-6 col-md-3 col-sm-12">
				<aside class="f-widget social-widget">
					<div class="f-title">
						<h3>Get In Touch</h3>
					</div>
					<ul class="list">
						<!--li><?= $Systemdata[0]['website_name'] ?></li-->
						<li>
							<address><i class="fa fa-home"></i>&nbsp;<?= $Systemdata[0]['website_address'] ?></address>
						</li>
						<li>
							<address><i class="fa fa-phone"></i>&nbsp;<a
									href="tel:<?= $Systemdata[0]['phone_number'] ?>"><?= $Systemdata[0]['phone_number'] ?></a>
								, <a
									href="tel:<?= $Systemdata[0]['mobile_number'] ?>"><?= $Systemdata[0]['mobile_number'] ?></a>
							</address>
						</li>
						<li>
							<address><i class="fa fa-envelope"></i>&nbsp;<a
									href="mailto:<?= $Systemdata[0]['website_email_id'] ?>"><?= $Systemdata[0]['website_email_id'] ?></a>
							</address>
						</li>

					</ul>
				</aside>
			</div>
		</div>
	</div>
</footer>
<footer class="footer-area section-gap">
	<div class="container">
		<div class="row footer-inner">

			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="social-links">
					<h3>Digital Marketing</h3>
					<ul>
						<li><a href="https://ritzmediaworld.com/digital-marketing-services.html">Digital Marketing
								Services</a></li>
						<li><a href="https://ritzmediaworld.com/search-engine-optimization---seo.html">Search Engine
								Optimization - SEO</a></li>
						<li><a href="https://ritzmediaworld.com/ppc-google-ads-agency.html">PPC (Google Ads) Agency</a>
						</li>
						<li><a href="https://ritzmediaworld.com/social-media-management.html">Social Media
								Management</a></li>
						<li><a href="https://ritzmediaworld.com/orm-in-digital-marketing.html">ORM in Digital
								Marketing</a></li>
						<li><a href="https://ritzmediaworld.com/lead-generation.html">Lead Generation</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="social-links">
					<h3>Content Marketing</h3>
					<ul>
						<li><a href="https://ritzmediaworld.com/content-marketing.html">SEO Content Writing Services</a>
						</li>
						<li><a href="https://ritzmediaworld.com/blog-content.html">Blog Content</a></li>
						<li><a href="https://ritzmediaworld.com/article-contents.html">Acticle Content</a></li>
						<li><a href="https://ritzmediaworld.com/pr-content.html">PR Content</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="social-links">
					<h3>Web Development</h3>
					<ul>
						<li><a href="https://ritzmediaworld.com/branding-and-identity-development.html">Branding</a>
						</li>
						<li><a href="https://ritzmediaworld.com/web-designing-development.html">Website Designing</a>
						</li>
						<li><a href="https://ritzmediaworld.com/e-commerce-web-designing.html">Ecommerce Website
								Design</a></li>
						<li><a href="https://ritzmediaworld.com/custom-design-development.html">Custom Website
								Development</a></li>
						<li><a href="https://ritzmediaworld.com/wordpress-web-designing.html">Wordpress Website
								Design</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="social-links">
					<h3>Who We Are</h3>
					<ul>
						<li><a href="#">Press & Media</a></li>
						<li><a href="#">Newsroom</a></li>
						<li><a href="#">Memberships & Affiliations</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>



<section class="footer-bottom-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="fb-left"><a href="#">Privacy Policy<a> | <a href="#">Legal<a> | <a
										href="https://ritzmediaworld.com/sitemap.xml">Sitemap<a> | <a
												href="https://ritzmediaworld.com/blogs">Blogs</a> | <a
												href="#">Cancellation & Refund Policy<a> | <a href="#">Ritz Media World
														Reviews<a></div>
			</div>
			<div class="col-lg-12">
				<div class="fb-left">Ritz Media World - Best Advertising and Marketing Agency - India. Copyright
					2002-2024. All rights & trademark reserved. <a href="#">RSS Feeds</a></div>
			</div>
		</div>
	</div>
</section>




<!--================ End Footer bottom Area =================-->

<script>
	function addnewsletter() {

		email = $("#footer_email").val();
		$.ajax({
			url: "<?php echo base_url('user/addnewsletter'); ?>",
			type: "POST",
			data: { 'email': email },
			dataType: 'html',
			success: function (data) {

				$("#footer_email_msg").html(data);
			},
			error: function () {
				// alert("there is error");
			}
		});

	}
</script>
<!--<script src="<?= FRONT_DIR ?>js/jquery-3.3.1.slim.min.js"></script>-->

<script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>
<script src="<?= FRONT_DIR ?>js/popper.min.js"></script>
<script src="<?= FRONT_DIR ?>js/owl.carousel.min.js"></script>
<!-- <script>
	$(document).ready(function () {
		$('#customers-testimonials').owlCarousel({
			loop: true,
			center: true,
			items: 1,
			margin: 0,
			autoplay: true,
			dots: true,
			autoplayTimeout: 4000,
			smartSpeed: 450,
		});
	});
</script> -->
<script src="<?= FRONT_DIR ?>js/customjquery.js"></script>
<script src="<?= FRONT_DIR ?>js/bootnavbar.js"></script>

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
	// $(function () {
	// 	$(".datepicker").datepicker();

	// });


	// var dateToday = new Date();
	// $(function () {
	// 	$(".fromdatepicker").datepicker({
	// 		minDate: dateToday,
	// 		dateFormat: 'yy-mm-dd'
	// 	});
	// });

	// $(function () {
	// 	$(".todatepicker").datepicker({
	// 		minDate: dateToday,
	// 		dateFormat: 'yy-mm-dd'
	// 	});
	// });

	// var dateToday = new Date();
	// $(function () {
	// 	$(".fromdatepicker2").datepicker({
	// 		minDate: dateToday,
	// 		dateFormat: 'yy-mm-dd'
	// 	});
	// });

	// $(function () {
	// 	$(".todatepicker2").datepicker({
	// 		minDate: dateToday,
	// 		dateFormat: 'yy-mm-dd'
	// 	});
	// });
</script>


<script>
	$(function () {
		// $('#main_navbar').bootnavbar();
	})
</script>


<!--<script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>