<?php if ($RelatedBlogs || $RecentBlogs) { ?>
	<section class="blogs-section">
		<div class="container">
			<h4 class="mb-4 h3">Recent Post</h4>
			<div class="row">
				<?php if ($RelatedBlogs) { ?>
					<?php foreach ($RecentBlogs as $rb) {
						$url_title = create_url($rb['slug_url']);
						?>
						<div class="col-md-4" title="<?php echo ucwords($rb['title']); ?>">
							<strong class="h6"><?php echo ucwords($rb['title']) ?>
							</strong>
							<img class="mt-3 recent-post-img"
								src="<?php echo BASE_URL; ?>webroot/images/blogs/<?php echo $rb['blog_image1']; ?>"
								alt="Ritz media World - Blog" />
							<a class="btn btn-primary mt-3" href="<?php echo BASE_URL . 'blog/' . $url_title; ?>">
								Read More
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>
<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>

<!--================ Start Footer Area =================-->
<footer>
	<div class="row p-5 d-flex justify-content-center footer-new">
		<div class="col-md-3">
			<img src="<?php echo BASE_URL ?>webroot/front/images/nn_logo.jpg" alt="footer logo">
			<p class="footer-desc">We’ve been in the business for the better part of the last 16 years. So it’s safe
				to
				say that we’re the most experienced advertising agency in the northern belt of this great nation of
				India. This means that we have been in the trenches with the biggest brands from all business
				disciplines.</p>
			<div class="row mx-2">
				<ul class="d-flex justify-content-center">
					<?php if (!empty($Systemdata[0]['facebook_url'])) { ?>
						<li>
							<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['facebook_url'] ?>"
									aria-label="facebook"><i class="fa-brands fa-facebook"></i></a></div>
						</li>
					<?php }
					if (!empty($Systemdata[0]['youtube_url'])) { ?>
						<li>
							<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['youtube_url'] ?>"
									aria-label="youtube"><i class="fa-brands fa-youtube"></i></a></div>
						</li>
					<?php }
					if (!empty($Systemdata[0]['twitter_url'])) { ?>
						<li>
							<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['twitter_url'] ?>"
									aria-label="twitter"><i class="fa-brands fa-twitter"></i></a></div>
						</li>
					<?php }
					if (!empty($Systemdata[0]['linkedin_url'])) { ?>
						<li>
							<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['linkedin_url'] ?>"
									aria-label="linkedin"><i class="fa-brands fa-linkedin"></i></a></div>
						</li>
					<?php }
					if (!empty($Systemdata[0]['vimeo_url'])) { ?>
						<li>
							<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['vimeo_url'] ?>"
									aria-label="instagram"><i class="fa-brands fa-instagram"></i></a></div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col-md-3">
			<h3 class="my-5">What we do</h3>
			<p><a class="text-light" href="<?= BASE_URL ?>print-advertising.html">Print Advertising</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>creative-services.html">Creative Services</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>radio-advertising.html">Radio Advertising</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>celebrity-endorsements.html">Celebrity Endorsements</a>
			</p>
			<p><a class="text-light" href="<?= BASE_URL ?>digital-marketing.html">Digital Marketing</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>contents-marketing.html">Content Marketing</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>web-designing-and-development.html">Web Designing &
					Development</a></p>
		</div>
		<div class="col-md-3">
			<h3 class="my-5">Quick Links</h3>
			<p><a class="text-light" href="<?= BASE_URL ?>about.html">About Us</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>contact.html">Contact Us</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>blogs">Blogs</a></p>
			<!-- <p><a class="text-light" href="#">Home</a></p> -->
			<p><a class="text-light" href="<?= BASE_URL ?>work.html">Work</a></p>
			<!-- <p><a class="text-light" href="<?= BASE_URL ?>resource.html">Resource</a></p> -->
		</div>
		<div class="col-md-3">
			<h3 class="my-5">Our Offices</h3>
			<span>Address: 402 – 404 , 4th floor Corporate Park, <br>Tower A1 Sector 142 , Greater Noida</span><br>
			<span><i class="fa fa-phone mr-2 mt-2"></i><a href="tel:09220516777" class="text-light">09220516777</a>,
				<a class="text-light" href="tel:07290002168">07290002168</a></span><br>
			<span class="d-flex">Email:&nbsp; <span id="email-fo"></span></span>
			<div class="row mt-3 d-flex justify-content-center">
				<div class="div mx-2">
					<img src="<?= FRONT_DIR ?>images/googlepartner.webp" alt="google partner" height="55px">
				</div>
				<div class="div mx-2">
					<img width="100px" src="<?= FRONT_DIR ?>images/meta-partner-logo.png" alt="meta partner">
				</div>
			</div>
		</div>
	</div>
</footer>
<section class="footer-bottom-section row">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="fb-left">
					<a href="https://ritzmediaworld.com/privacy-policy.html">Privacy Policy</a> |
					<a href="https://ritzmediaworld.com/career.html">Career</a> |
					<a href="https://ritzmediaworld.com/sitemap.xml">Sitemap</a> |
					<a href="https://ritzmediaworld.com/blogs">Blogs</a> |
					<a href="https://ritzmediaworld.com/refund-policy.html">Cancellation & Refund Policy</a> |
					<a href="https://g.co/kgs/gjzcQBq">Ritz Media World Reviews</a>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="fb-left">Ritz Media World - Best Advertising and Marketing Agency - India. Copyright
					2002-2025. All rights & trademark reserved.</div>
			</div>
		</div>
	</div>
</section>

<!--================ End Footer bottom Area =================-->
<script type="text/javascript">
	// Email parts
	var user = 'info';
	var domain = 'ritzmediaworld';
	var tld = 'com';
	// Combine them into a full email address
	var email = user + '@' + domain + '.' + tld;
	// Inject the email into the webpage
	document.getElementById('email-fo').innerHTML = " " + email;
</script>
<script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>
<script src="<?= FRONT_DIR ?>js/owl.carousel.min.js"></script>
<script src="<?= FRONT_DIR ?>js/bootnavbar.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div id="whatsapp-icon" style="display: none;">
	<a href="https://wa.me/7290002168" target="_blank" title="Chat on WhatsApp">
		<i class="fab fa-whatsapp"></i>
	</a>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const whatsappIcon = document.getElementById('whatsapp-icon');
		whatsappIcon.style.display = 'flex';
	});
</script>