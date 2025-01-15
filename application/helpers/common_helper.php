<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
if (!function_exists('test_method')) {
	function test_method($var = '')
	{
		return $var;
	}
}

function get_tax($price)
{
	$gst = ($price * 12) / 100;
	return $gst;
}

function apply_coupon_code($discount_res)
{
	$CI = &get_instance();
	if (is_array($discount_res) && !empty($discount_res)) {
		$cart_total = $CI->session->userdata('grand_total');
		$discount_type = $discount_res['coupon_type'];
		if ($discount_res['minimum_order_amount'] != '' && $discount_res['minimum_order_amount'] != '0.0000') {
			if ($discount_type == 'p') {
				$discount_amount = ($cart_total * $discount_res['coupon_discount'] / 100);
				if (($cart_total >= $discount_amount) && ($cart_total >= $discount_res['minimum_order_amount'])) {
					$CI->session->set_userdata(array('coupon_code' => $discount_res['coupon_code'], 'coupon_id' => $discount_res['coupon_id'], 'discount_amount' => (int) $discount_amount));
				}
			} else {
				$discount_amount = $discount_res['coupon_discount'];
				if (($cart_total >= $discount_amount) && ($cart_total >= $discount_res['minimum_order_amount'])) {
					$CI->session->set_userdata(array('coupon_code' => $discount_res['coupon_code'], 'coupon_id' => $discount_res['coupon_id'], 'discount_amount' => (int) $discount_amount));
				}
			}
		} else {
			if ($discount_type == 'p') {
				$discount_amount = ($cart_total * $discount_res['coupon_discount'] / 100);
				if ($cart_total >= $discount_amount) {
					$CI->session->set_userdata(array('coupon_code' => $discount_res['coupon_code'], 'coupon_id' => $discount_res['coupon_id'], 'discount_amount' => (int) $discount_amount));
				}
			} else {
				$discount_amount = $discount_res['coupon_discount'];
				if ($cart_total >= $discount_amount) {
					$CI->session->set_userdata(array('coupon_code' => $discount_res['coupon_code'], 'coupon_id' => $discount_res['coupon_id'], 'discount_amount' => (int) $discount_amount));
				}
			}
		}
	}
}

function get_discount($code)
{
	if ($code != "") {
		$CI = &get_instance();
		$res = $CI->db->query("SELECT * FROM  wp_coupons  where status ='1' AND coupon_code = '" . $code . "' AND 
		(start_date  >= '" . $CI->session->userdata("start_date") . "' OR 
		end_date  >= '" . $CI->session->userdata("start_date") . "' ) ")->row_array();
		return $res;
	}
}

function getMonthName($i)
{
	$array = array(
		"1" => "January",
		"2" => "February",
		"3" => "March",
		"4" => "April",
		"5" => "May",
		"6" => "June",
		"7" => "July",
		"8" => "August"
		,
		"9" => "September",
		"10" => "Octobar",
		"11" => "November",
		"12" => "Decemember"
	);
	return $array[$i];
}

function get_hotel_url($id)
{
	$CI = &get_instance();
	$res = $CI->db->query("SELECT * FROM  bh_support_listings  where id = " . $id . "")->row_array();
	$url = BASE_URL . 'hotel/' . create_url($res['listing_title']) . '/' . $id;
	return $url;
}

function get_hotel_name($id)
{
	$CI = &get_instance();
	$res = $CI->db->query("SELECT * FROM  bh_support_listings  where id = " . $id . "")->row_array();
	return $res['listing_title'];
}

function get_hotel_room_category($room_type)
{
	$CI = &get_instance();
	$res = $CI->db->query("SELECT * FROM bh_hotel_rooms  where id = " . $room_type . "")->row_array();
	return $res['image_title'];
}

function get_city_name($city)
{
	$CI = &get_instance();
	$res = $CI->db->query("SELECT * FROM cities  where id = " . $city . "")->row_array();
	return $res['name'];
}
function getRoomType($room_type)
{
	$room = array("1" => "Room Only", "2" => "Room With Breakfast", "3" => "CP Single");
	if ($room_type > 0)
		return $room[$room_type];
}

function home_header_menu($class = "")
{
	$ci = &get_instance();
	$controller = $ci->router->fetch_class();
	$class = $ci->router->fetch_class();
	$method = $ci->router->fetch_method();
	?>
	<script>
		function getHotelByCity2(cityid) {
			$.ajax({
				url: "<?php echo base_url('content/show_hotel_ajax'); ?>",
				type: "POST",
				data: { 'city': cityid },
				dataType: 'json',
				success: function (data) {
					$("#listing_id2").html(data);
					$("#listing_id").html(data);
				},
				error: function () {
					//alert("there is error");
				}
			});
		}
	</script>
	<!--start book form-->
	<?php
}

function header_menu()
{
	$ci = &get_instance();
	$class = $ci->router->fetch_class();
	$method = $ci->router->fetch_method();
	$current_url = str_replace("index.php/", "", current_url());
	if ($current_url != BASE_URL || $method != 'hotel_detail') {
		$class = 'about-main-header';
	} else {
		$class = '';
	}
	if ($current_url != BASE_URL || $method != 'hotel_detail') {
		?>
		<script>

			function getHotelByCity3(cityid, hotel_id) {
				if (hotel_id == '') hotel_id = '';
				$.ajax({
					url: "<?php echo base_url('content/show_hotel_ajax'); ?>",
					type: "POST",
					data: { 'city': cityid, 'hotel_id': hotel_id },
					dataType: 'json',
					success: function (data) {
						$("#listing_id3").html(data);
					},
					error: function () {
						//    alert("there is error");
					}
				});
			}

			function getHotelByCity2(cityid) {
				$.ajax({
					url: "<?php echo base_url('content/show_hotel_ajax'); ?>",
					type: "POST",
					data: { 'city': cityid },
					dataType: 'json',
					success: function (data) {
						$("#listing_id").html(data);
						$("#listing_id2").html(data);
					},
					error: function () {
						//alert("there is error");
					}
				});
			}
		</script>
		<!--start book form-->

		<div class="modal login-modal fade" id="booking_stay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="book-form-vertical">
							<div class="container">
								<div class="row">
									<div class="book-form">
										<form method="post" id="searchF2" autocomplete="off"
											action="<?= BASE_URL ?>search-hotel">
											<div class="form-row">
												<div class="form-group">
													<select name="city" required id="city2" class="form-control"
														onchange="return getHotelByCity2(this.value)">
														<option value="">Select Location</option>
														<?php
														$AllCity = $ci->listing_model->GetALLEnableCity();
														foreach ($AllCity as $CityData) {
															$all_hotel = $ci->commonmod_model->getHotelByCity($CityData['id']);
															if (count($all_hotel) > 0) { ?>
																<option value="<?= $CityData['id'] ?>"><?= $CityData['name'] ?></option>
																<?php
															}
														}
														?>
													</select>
												</div>

												<div class="form-group">
													<select required class="form-control" autocomplete="off" name="listing_id"
														id="listing_id2">
														<option value="">Select Hotel</option>
													</select>
												</div>

												<div class="form-group">
													<div class="form-wrap">
														<input type="text" required class="form-control fromdatepicker"
															autocomplete="off" name="start_date" placeholder="Arrival Date">
														<span class="data-time-picker-arrow"></span>
													</div>
												</div>

												<div class="form-group">
													<div class="form-wrap">
														<input type="text" required class="form-control todatepicker"
															autocomplete="off" name="end_date" placeholder="Departure Date">
														<span class="data-time-picker-arrow"></span>
													</div>
												</div>
												<div class="form-group">
													<div class="form-wrap">
														<input type="submit" class="submit-btn" name="submit" value="Book Now">
														<span class="data-time-picker-arrow1"></span>
													</div>
												</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		<?php
		$controller = $ci->router->fetch_class();
		$method = $ci->router->fetch_method();
		?>
		<?php
		$ci->db->select('*');
		$ci->db->from('bh_menu_category');
		$ci->db->where('status', '1');
		$cat = $ci->db->get()->result_array();

		$ci->db->select('*');
		$ci->db->from('bh_menu_list');
		$ci->db->where('status', '1');
		$menu_list = $ci->db->get()->result_array();
		?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light <?= $class ?>" id="main_navbar">
			<div class="container">
				<a class="navbar-brand" href="<?= BASE_URL ?>"><img src="<?= FRONT_DIR ?>images/nn_logo.jpg" class="img-fluid"
						alt="Ritz Media World"></a>
				<button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span style="background-color: white!important; " class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
					<ul class="navbar-nav">
						<li class="nav-item <?= ($method == 'index' && $controller == 'content') ? 'active' : ''; ?>">
							<a class="nav-link" href="<?= BASE_URL ?>">Home <span class="sr-only">(current)</span></a>
						</li>
						<li id="services_dropdown"
							class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/branding-and-identity-development.html' || $_SERVER['REQUEST_URI'] == '/graphic-designing.html') ? 'active' : ''; ?> dropdown">
							<a class="nav-link dropdown-toggle industry-link" href="#" id="navbarDropdown3" title="Industry"
								role="button" aria-label="Submit" data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">Services</a>
							<ul class="dropdown-menu industry-dropdown" style="background-color: #001240 !important;"
								aria-labelledby="navbarDropdown3">
								<li class="nav-item dropdown">
									<a class="dropdown-item nav-link dropdown-toggle" href="#"
										id="featuresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
										title="Creative Services">
										Creative Services
									</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item"
												href="<?= BASE_URL ?>branding-and-identity-development.html">Branding and
												Identity Development</a></li>
										<li class="dropdown">
											<a class="dropdown-item" href="<?= BASE_URL ?>graphic-designing.html">
												Graphic Designing
											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>logo-design.html">Logo Design</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>print-advertisement-design.html">Print
												Advertisement Design
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>ui-ux-design.html">UI/UX Design
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>packaging-design.html">Packaging
												Design
											</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown6"
										title="Print Advertising" role="button" aria-label="Submit">Print Advertising</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item"
												href="<?= BASE_URL ?>advertisement-designing.html">Advertisement Design
											</a></li>
										<li>
											<a class="dropdown-item" href="<?= BASE_URL ?>ad-placements.html">
												Ad Placements

											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>copywriting.html">Copywriting</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>negotiating-rates.html">Negotiating
												Rates
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>ad-size-optimization.html">Ad Size
												Optimization
											</a></li>
										<li><a class="dropdown-item"
												href="<?= BASE_URL ?>advertisement-scheduling.html">Advertisement Scheduling
											</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown7"
										title="Radio Advertising" role="button" aria-label="Submit">Radio
										Advertising</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item"
												href="<?= BASE_URL ?>advertisement-concept-development.html">Advertisement Concept Development
											</a></li>
										<li class="dropdown">
											<a class="dropdown-item" href="<?= BASE_URL ?>scriptwriting.html">
												Scriptwriting

											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>voiceover-casting.html">Voiceover Casting
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>recording-and-production.html">Recording and
												Production

											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>media-planning-and-buying.html">Media Planning and
												Buying

											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>negotiating-ad-rates.html">Negotiating Ad Rates

											</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown8"
										title="Celebrity Endorsements" role="button" aria-label="Submit">Celebrity
										Endorsements</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item" href="<?= BASE_URL ?>celebrity-selection.html">Celebrity Selection
											</a></li>
										<li class="dropdown">
											<a class="dropdown-item" href="<?= BASE_URL ?>negotiating-contracts.html">
												Negotiating Contracts

											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>creative-collaboration.html">Creative
												Collaboration</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>campaign-integration.html">Campaign Integration
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>public-relations.html">Public Relations
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>legal-compliance.html">Legal Compliance
											</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown9"
										title="Digital	Marketing" role="button" aria-label="Submit">Digital
										Marketing</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item" href="<?= BASE_URL ?>digital-marketing-services.html">Digital Marketing
												Services
											</a></li>
										<li class="dropdown">
											<a class="dropdown-item" href="<?= BASE_URL ?>search-engine-optimization---seo.html">
												Search Engine Optimization - SEO

											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>ppc-google-ads-agency.html">PPC (Google Ads)</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>social-media-management.html">Social Media
												Management
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>orm-in-digital-marketing.html">ORM in Digital
												Marketing
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>lead-generation.html">Lead Generation
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>brand-awareness.html">Brand Awareness
											</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown19"
										title="Content Marketing" role="button" aria-label="Submit">Content
										Marketing</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item" href="<?= BASE_URL ?>content-marketing.html">Content Marketing
											</a></li>

										<li class="dropdown">
											<a class="dropdown-item" href="<?= BASE_URL ?>blog-content.html">
												Blog Content
											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>article-contents.html">Article Content
											</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>pr-content.html">PR Content
											</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown20"
										title="Web Designing &	Development" role="button" aria-label="Submit">Web Designing &
										Development</a>
									<ul class="dropdown-menu" style="background-color: #001240 !important;"
										aria-labelledby="featuresDropdown">
										<li><a class="dropdown-item" href="<?= BASE_URL ?>web-designing-development.html">Web Designing &
												Development
											</a></li>
										<li class="dropdown">
											<a class="dropdown-item" href="<?= BASE_URL ?>custom-design-development.html">
												Custom Design & Development
											</a>
										</li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>wordpress-web-designing.html">WordPress Web
												Designing</a></li>
										<li><a class="dropdown-item" href="<?= BASE_URL ?>e-commerce-web-designing.html">E-Commerce Web
												Designing
											</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li
							class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/about.html' || $_SERVER['REQUEST_URI'] == '/management.html') ? 'active' : ''; ?> dropdown">
							<a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>about.html" id="navbarDropdown"
								title="About Us" role="button" aria-label="Submit" data-toggle="dropdown" area-haspopup="true"
								aria-expanded="false">About Us</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown10" style="background-color: #001240 !important;">
								<li class="nav-item dropdown">
									<a class="dropdown-item" href="<?= BASE_URL ?>about.html" id="navbarDropdown1">
										Our Profile
									</a>
								</li>
								<li class="nav-item dropdown">
									<a class="dropdown-item" href="<?= BASE_URL ?>management.html" id="navbarDropdown2"
										title="Management" role="button" aria-label="Submit">
										Management
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/#') ? 'active' : ''; ?>">
							<a class="nav-link" href="<?php echo BASE_URL; ?>work.html">Our Work</a>
						</li>
						<!--<li class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/#') ? 'active' : ''; ?>">-->
						<!--	<a class="nav-link" href="<?php echo BASE_URL; ?>resource.html">Resource</a>-->
						<!--</li>-->
						<!--<li-->
						<!--	class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/industry.html' || $_SERVER['REQUEST_URI'] == '/b2b.html' || $_SERVER['REQUEST_URI'] == '/healthcare.html' || $_SERVER['REQUEST_URI'] == '/realestate.html' || $_SERVER['REQUEST_URI'] == '/education.html') ? 'active' : ''; ?> dropdown">-->
						<!--	<a class="nav-link dropdown-toggle industry-link" href="<?= BASE_URL ?>industry.html"-->
						<!--		id="navbarDropdown3" title="Industry" role="button" aria-label="Submit" data-toggle="dropdown"-->
						<!--		aria-haspopup="true" aria-expanded="false">Industry</a>-->
						<!--	<ul class="dropdown-menu industry-dropdown" aria-labelledby="navbarDropdown3" style="background-color: #001240 !important;">-->
						<!--		<li class="nav-item dropdown">-->
						<!--			<a class="dropdown-item" href="<?= BASE_URL ?>industry.html" id="navbarDropdown4">BFSI</a>-->
						<!--		</li>-->
						<!--		<li class="nav-item dropdown">-->
						<!--			<a class="dropdown-item" href="<?= BASE_URL ?>b2b-industry.html" id="navbarDropdown6"-->
						<!--				title="B2B" role="button" aria-label="Submit">B2B</a>-->
						<!--		</li>-->
						<!--		<li class="nav-item dropdown">-->
						<!--			<a class="dropdown-item" href="<?= BASE_URL ?>healthcare-industry.html" id="navbarDropdown7"-->
						<!--				title="Healthcare" role="button" aria-label="Submit">HealthCare</a>-->
						<!--		</li>-->
						<!--		<li class="nav-item dropdown">-->
						<!--			<a class="dropdown-item" href="<?= BASE_URL ?>realestate-industry.html" id="navbarDropdown8"-->
						<!--				title="Real-estate" role="button" aria-label="Submit">Real-Estate</a>-->
						<!--		</li>-->
						<!--		<li class="nav-item dropdown">-->
						<!--			<a class="dropdown-item" href="<?= BASE_URL ?>education-industry.html" id="navbarDropdown9"-->
						<!--				title="Education" role="button" aria-label="Submit">Education</a>-->
						<!--		</li>-->
						<!--	</ul>-->

						<!--</li>-->
						<li class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/#') ? 'active' : ''; ?>">
							<a class="nav-link" href="<?php echo BASE_URL; ?>blogs">Blogs</a>
						</li>
						<li class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/contact.html') ? 'active' : ''; ?>">
							<a class="nav-link" href="<?= BASE_URL ?>contact.html">Contact Us</a>
						</li>
						<li class="nav-extra-items">
							<ul>
								<?php
								foreach ($cat as $catgory) {
									?>

									<li class="nav-item">
										<a class="nav-link"
											href="<?php echo BASE_URL . $catgory['category_url'] . '.html'; ?>"><?php echo $catgory['category_name']; ?></a>
									</li>

								<?php } ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}
}

function editionprice($price)
{
	$price = number_format((float) $price, 2, '.', '');
	return $price;
}

function FormatPrice($OrderCountry, $Price)
{
	////////////FOR US COUNTRY	
	$Price = number_format((float) $Price, 2, '.', '');
	if ($OrderCountry == 1)
		return "$" . $Price;
	else
		return "£" . $Price;
}

function Currency($OrderCountry = "")
{
	//FOR US COUNTRY	
	if ($OrderCountry == 1)
		return "$";
	else
		return "£";
}

function CurrentUrl()
{
	$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $current_url;
}

function findDiscountPrice($Price, $discountpercentage = 0)
{
	$discountPrice = ($Price - ($Price * $discountpercentage / 100));
	return $discountPrice;
}

function priceFormat($price)
{
	$price = number_format((float) $price, 2, '.', '');
	return $price;
}

function getchargeType()
{
	$chargetype = array("1" => "ROOM ONLY", "2" => "ROOM WITH BREAKFAST", "3" => "CP SINGLE");
	return $chargetype;
}

function setchargeType($type)
{
	$chargetype = array("1" => "ROOM ONLY", "2" => "ROOM WITH BREAKFAST", "3" => "CP SINGLE");
	return $chargetype[$type];
}

function create_url($string)
{
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
{
	$dates = array();
	$current = strtotime($first);
	$last = strtotime($last);
	while ($current <= $last) {
		$dates[] = date($output_format, $current);
		$current = strtotime($step, $current);
	}
	return $dates;
}







