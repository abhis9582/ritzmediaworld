<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>
<!--================ Start Footer Area =================-->
<footer>
	<div class="row p-5 d-flex justify-content-center footer-new">
		<div class="col-md-3">
			<img src="<?php echo BASE_URL ?>webroot/front/images/nn_logo.jpg" alt="footer logo">
			<p class="footer-desc">
			Accelerate your journey to success with result-oriented solutions for Digital Advertising, Social Media Management, SEO, and Compelling Content backed by more than 17 years of advertising wisdom with a wide array of clients across all industries across the Indian subcontinent.</p>
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
			<h3 class="mt-5 mb-4">What we do</h3>
			<p><a class="text-light" href="<?= BASE_URL ?>digital-marketing.html">Digital Marketing</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>print-advertising.html">Print Advertising</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>radio-advertising.html">Radio Advertising</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>creative-services.html">Creative Services</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>contents-marketing.html">Content Marketing</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>web-designing-and-development.html">Web Designing &
					Development</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>celebrity-endorsements.html">Celebrity Endorsements</a>
			</p>
		</div>
		<div class="col-md-3">
			<h3 class="mt-5 mb-4">Quick Links</h3>
			<p><a class="text-light" href="<?= BASE_URL ?>about.html">About Us</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>contact.html">Contact Us</a></p>
			<p><a class="text-light" href="<?= BASE_URL ?>blogs">Blogs</a></p>
			<!-- <p><a class="text-light" href="#">Home</a></p> -->
			<p><a class="text-light" href="<?= BASE_URL ?>work.html">Work</a></p>
			<!-- <p><a class="text-light" href="<?= BASE_URL ?>resource.html">Resource</a></p> -->
		</div>
		<div class="col-md-3">
			<h3 class="mt-5 mb-4">Our Offices</h3>
			<span>Address: 402 – 404 , 4th floor Corporate Park, <br>Tower A1 Sector 142 , Greater Noida</span><br>
			<span><i class="fa fa-phone mr-2 mt-2"></i><a href="tel:09220516777" class="text-light">09220516777</a>,
				<a class="text-light" href="tel:07290002168">07290002168</a></span><br>
			<span class="d-flex">Email: &nbsp; <span id="email_id"></span></span>
			<div class="row mt-3 d-flex justify-content-center">
				<div class="div mx-2">
					<img src="<?= FRONT_DIR ?>images/googlepartner.webp" alt="google partner" height="55px"
						loading="lazy">
				</div>
				<div class="div mx-2">
					<img width="100px" src="<?= FRONT_DIR ?>images/meta-partner-logo.png" alt="meta partner"
						loading="lazy">
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
					<a href="<?php echo BASE_URL ?>privacy-policy.html">Privacy Policy</a> |
					<a href="<?php echo BASE_URL ?>career.html">Career</a> |
					<a href="<?php echo BASE_URL ?>sitemap.xml">Sitemap</a> |
					<a href="<?php echo BASE_URL ?>blogs">Blogs</a> |
					<a href="<?php echo BASE_URL ?>refund-policy.html">Cancellation & Refund Policy</a> |
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

<div id="cookie-banner">
	<p>
		We use cookies to improve your experience. By using our site, you agree to our use of cookies.
		<a href="#" id="cookie-policy-link">Learn more</a>.
	</p>
	<button id="accept-cookies">Accept</button>
	<button id="reject-cookies">Reject</button>
</div>

<!-- Popup Modal -->
<div id="cookie-policy-popup">
	<h3>Cookie Policy</h3>
	<p>
		We use cookies to ensure that we give you the best experience on our website. This includes cookies from
		third party social media websites and advertising cookies that may analyze your use of this site. Click "I
		Agree" to agree or "Deny" to opt out. This Cookie Notice describes how and why Ritz Media World use cookies
		and other similar technologies in the
		course of our business through websites, products and services collectively, our “Websites”. It also
		explains your rights to control our use of these tracking technologies. For additional information
		about our privacy practices, please review our Privacy Notice.
		<a class="cookie-text-footer" href="<?php echo BASE_URL ?>privacy-policy.html" target="_blank">Read Full
			Policy</a>.
	</p>
	<div class="cookie-div-footer">
		<button id="popup-accept">I
			Agree</button>
		<button id="popup-decline">Decline</button>
	</div>
</div>
<script type="text/javascript">
	// Email parts
	var user = 'info';
	var domain = 'ritzmediaworld';
	var tld = 'com';

	// Combine them into a full email address
	var email = user + '@' + domain + '.' + tld;

	// Inject the email into the webpage
	document.getElementById('email_id').innerHTML = " " + email;
</script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const banner = document.getElementById('cookie-banner');
		const acceptButton = document.getElementById('accept-cookies');
		const rejectButton = document.getElementById('reject-cookies');
		const policyLink = document.getElementById('cookie-policy-link');
		const policyPopup = document.getElementById('cookie-policy-popup');
		const popupAcceptButton = document.getElementById('popup-accept');
		const popupDeclineButton = document.getElementById('popup-decline');

		// Check if the user has already made a choice
		if (!localStorage.getItem('cookiesAccepted')) {
			banner.style.display = 'block';
			document.body.style.overflow = 'hidden'; // Disable scrolling
		}

		// Handle the accept button click
		acceptButton.addEventListener('click', handleAccept);

		// Handle the reject button click
		rejectButton.addEventListener('click', handleReject);

		// Show the cookie policy popup
		policyLink.addEventListener('click', (event) => {
			event.preventDefault(); // Prevent navigation
			policyPopup.style.display = 'block';
		});

		// Handle the popup accept button click
		popupAcceptButton.addEventListener('click', () => {
			policyPopup.style.display = 'none';
			handleAccept();
		});

		// Handle the popup decline button click
		popupDeclineButton.addEventListener('click', () => {
			policyPopup.style.display = 'none';
			handleReject();
		});

		// Function to handle cookie acceptance
		async function handleAccept() {
			localStorage.setItem('cookiesAccepted', 'true');
			banner.style.display = 'none';
			document.body.style.overflowY = 'scroll'; // Enable scrolling

			const now = new Date();
			const currentDate = now.toLocaleDateString();
			const currentTime = now.toLocaleTimeString();

			// Fetch user geolocation data
			const geoData = await fetch('https://ipinfo.io/json?token=c43c1f6522c8b6')
				.then(response => response.json())
				.catch(error => console.error('Geolocation Error:', error));

			// Extract relevant data
			const dataPost = {
				ip: geoData.ip || '',
				city: geoData.city || '',
				state: geoData.region || '',
				country: geoData.country || '',
				pincode: geoData.postal || '',
				date: currentDate,
				time: currentTime
			};

			// Send data to your server
			$.ajax({
				url: "<?php echo base_url('cookie-data'); ?>",
				type: "POST",
				data: dataPost,
				success: function () {
					console.log('Data stored in DB');
				},
				error: function () {
					console.error("Error saving to DB");
				}
			});

			const formData = new FormData();
			formData.append('ip', dataPost.ip);
			formData.append('city', dataPost.city);
			formData.append('state', dataPost.state);
			formData.append('country', dataPost.country);
			formData.append('pincode', dataPost.pincode);
			formData.append('date', dataPost.date);
			formData.append('time', dataPost.time);

			const action = "https://script.google.com/macros/s/AKfycbwEYsbuACfapdaVbfTW47fLSb52qZUmt1CWgFwPqPJ_4IiGdOhJM3Qmi70UenjIvPAm/exec";
			fetch(action, {
				method: 'POST',
				body: formData
			})
				.then(response => response.json())
				.then(() => {
					console.log('Data sent to Google Sheet');
				})
				.catch(error => {
					console.error('Error submitting the form:', error);
				});
		}

		// Function to handle cookie rejection
		function handleReject() {
			localStorage.setItem('cookiesAccepted', 'false');
			banner.style.display = 'none';
			document.body.style.overflowY = 'scroll'; // Enable scrolling
			console.log('User rejected cookies');
			// No data is sent to the server or Google Sheet
		}
	});
</script>


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
<script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>
<script src="<?= FRONT_DIR ?>js/popper.min.js"></script>
<script src="<?= FRONT_DIR ?>js/owl.carousel.min.js"></script>
<script>
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
			onInitialized: function (event) {
				// Adding aria-labels to each owl-dot button
				$('.owl-dot').each(function (index) {
					$(this).attr('aria-label', 'Slide ' + (index + 1));
				});
			}
		});
	});
</script>
<script src="<?= FRONT_DIR ?>js/customjquery.js"></script>
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