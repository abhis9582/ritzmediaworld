<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>
<!-- <div class="container-fluid top_header">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center justify-content-between top-menu">
            <div class="phone-number">
                <a href="tel:<?php echo $Systemdata[0]['phone_number'] ?>">
                    <i class="fa fa-phone m-2"></i><?php echo $Systemdata[0]['phone_number'] ?>
                </a>
            </div>
            <ul class="top_header_ul d-flex justify-content-center align-items-center m-0 p-0">
                <?php if (!empty($Systemdata[0]['facebook_url'])) { ?>
                    <li><a href="<?= $Systemdata[0]['facebook_url'] ?>" target='_blank'
                    aria-label="facebook"><i
                                class="fa-brands fa-facebook"></i></a>
                    </li>
                <?php }
                if (!empty($Systemdata[0]['youtube_url'])) { ?>
                    <li><a href="<?= $Systemdata[0]['youtube_url'] ?>" target='_blank'
                    aria-label="youtube"><i
                                class="fa-brands fa-youtube"></i></a>
                    </li>
                <?php }
                if (!empty($Systemdata[0]['twitter_url'])) { ?>
                    <li><a href="<?= $Systemdata[0]['twitter_url'] ?>" target='_blank'
                    aria-label="twitter"><i
                                class="fa-brands fa-twitter"></i></a>
                    </li>
                <?php }
                if (!empty($Systemdata[0]['linkedin_url'])) { ?>
                    <li><a href="<?= $Systemdata[0]['linkedin_url'] ?>" target='_blank'
                    aria-label="linkedin"><i
                                class="fa-brands fa-linkedin"></i></a>
                    </li>
                <?php }
                if (!empty($Systemdata[0]['vimeo_url'])) { ?>
                    <li><a href="<?= $Systemdata[0]['vimeo_url'] ?>" target='_blank'
                    aria-label="instagram"><i
                                class="fa-brands fa-instagram"></i></a>
                    </li>
                <?php } ?>
                <li><a class="web-story-button" href="<?= BASE_URL ?>web-story">story</a></li>
                <li><img class="image_google_partner" height="50px"
                            src="<?= FRONT_DIR ?>images/googlepartner.webp" alt="google partner"></li>
                <li><img height="50px" class="image_google_partner"
                            src="<?= FRONT_DIR ?>images/meta-partner-logo.png" alt="meta partner"></li>
            </ul>
        </div>
    </div>
</div> -->
<div class="request-callback">
    <button class="top_header_button" id="openFormBtn">GROW YOUR BUSINESS</button>
</div>
<!-- popup form -->
<div id="contactForm" class="popup-form">
    <div class="form-container">
        <span id="closeFormBtn" class="close-btn">&times;</span>
        <h2 class="my-3">We’ll Connect with You Shortly!</h2>
        <form id="popup-form" action="<?= BASE_URL . 'popupsubmit' ?>" method="post" onsubmit="submitForm(event)">
            <div class="form-group">
                <input type="text" id="name" name="name" required placeholder="Your Name" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="tel" id="mobile" name="mobile" required placeholder="Your Mobile" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" required placeholder="Your Email" autocomplete="off">
            </div>
            <select class="pop-form-select" name="services" id="services" required aria-label="Select a Service">
                <option selected>Select Service</option>
                <option value="digital_marketing">Digital Marketing</option>
                <option value="print_advertising">Print Advertising</option>
                <option value="radio_advertising">Radio Advertising</option>
                <option value="creative_services">Creative Services</option>
                <option value="content_marketing">Content Marketing</option>
                <option value="web_designing_development">Web Designing & Development</option>
                <option value="celebrity_endorsements">Celebrity Endorsements</option>
            </select>
            <select class="pop-form-select" name="budget" id="budget" required aria-label="Select your budget">
                <option selected>Select budget</option>
                <option value="50K to 1 Lakh">50K to 1 Lakh</option>
                <option value="1 Lakh to 5 Lakh">1 Lakh to 5 Lakh</option>
                <option value="Above 5 Lakh">Above 5 Lakh</option>
            </select>
            <div class="form-group">
                <textarea id="message" name="message" placeholder="If any specific requirement"
                    autocomplete="off"></textarea>
            </div>
            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>

    </div>
</div>

<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
$current_url = str_replace("index.php/", "", current_url());
if ($current_url != BASE_URL && $method != 'hotel_detail') {
    ?>

    <section class="main-header">


        <!--nav-->

        <?php echo header_menu(); ?>

        <!--end of nav-->
    </section>
    <?php
    $this->db->select('*');
    $this->db->from('bh_menu_category');
    $this->db->where('status', '1');
    $cat = $this->db->get()->result_array();

    $this->db->select('*');
    $this->db->from('bh_menu_list');
    $this->db->where('status', '1');
    $menu_list = $this->db->get()->result_array();
    ?>
    <div class="new_menu">
        <div class="container">
            <div class="row">
                <ul>
                    <li>
                        <a class="hide_logo" href="<?= BASE_URL ?>">
                            <img src="<?= FRONT_DIR ?>images/nn_logo.jpg" class="img-fluid" alt="Ritz Media World Logo">
                        </a>
                    </li>
                    <?php
                    foreach ($cat as $catgory) {
                        ?>
                        <li>
                            <span><img
                                    src="<?php echo BASE_URL; ?>webroot/images/menu/<?php echo $catgory['category_image']; ?>"
                                    alt="Ritz media World - Services" /></span>
                            <a
                                href="<?php echo BASE_URL . $catgory['category_url'] . '.html'; ?>"><?php echo $catgory['category_name']; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

<?php } ?>

<script>
    $(window).scroll(function () {
        var new_menu = $('.new_menu'),
            scroll = $(window).scrollTop();

        if (scroll >= 100) new_menu.addClass('fixed');
        else new_menu.removeClass('fixed');
    });
</script>
<script>
    var button = document.getElementById("openFormBtn");
    var closeBtn = document.getElementById("closeFormBtn");
    button.addEventListener("click", function () {
        contactForm.classList.toggle("active");
    });
    closeBtn.addEventListener("click", function () {
        contactForm.classList.remove("active");
    });

    // Close the popup form when clicking outside the form container
    window.addEventListener("click", function (event) {
        if (event.target === contactForm) {
            contactForm.classList.remove("active");
        }
    });
</script>
<script>
    function submitForm(event) {
        event.preventDefault();
        const form = document.getElementById('popup-form');
        const formData = new FormData(form);
        const mobile = document.getElementById('mobile').value;
        const mobileRegex = /^[6-9]\d{9}$/;
        if (!mobileRegex.test(mobile)) {
            alert("Please enter a valid mobile number.");
            return;
        }

        const email = document.getElementById('email').value;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ //;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return;
        }
        const now = new Date();
        const currentDate = now.toLocaleDateString();  // e.g., "12/9/2024"
        const currentTime = now.toLocaleTimeString();  // e.g., "10:25:30 AM"

        // Append the date and time separately to the form data
        formData.append('date', currentDate);
        formData.append('time', currentTime);
        form.action = "https://script.google.com/macros/s/AKfycbxNUxQqJc1vXdGM7_ztmftsiC4Kk30zYEOq4rnxWj29PKRaYk-utTTilO37mYTzpiI0/exec";
        fetch(form.action, {
            method: form.method,
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById('contactForm').style.display = "none";
                alert('Form submitted successfully!');
                form.reset();
            })
            .catch(error => {
                console.error('Error submitting the form:', error);
            });
    }
    $(document).ready(function () {
        $('#popup-form').submit(function (e) {
            e.preventDefault();  // Prevent the form from submitting the default way
            // Serialize the form data
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(function (span) {
                span.textContent = '';
            });
            // Name Validation
            const name = document.getElementById('name').value;
            if (name.trim() === '') {
                isValid = false;
                document.getElementById('name-error').textContent = 'Name is required.';
            }

            // Mobile Validation (simple check for digits and length)
            const mobile = document.getElementById('mobile').value;
            const mobilePattern = /^[0-9]{10}$/; // Example for 10 digit phone numbers
            if (!mobilePattern.test(mobile)) {
                isValid = false;
                document.getElementById('mobile-error').textContent = 'Please enter a valid mobile number.';
            }

            // Email Validation
            const email = document.getElementById('email').value;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                isValid = false;
                document.getElementById('email-error').textContent = 'Please enter a valid email address.';
            }
            // Services Validation
            const services = document.getElementById('services').value;
            if (services === 'Select Service') {
                isValid = false;
                document.getElementById('services-error').textContent = 'Please select a service.';
            }

            // Message Validation
            const message = document.getElementById('message').value;
            if (message.trim() === '') {
                isValid = false;
                document.getElementById('message-error').textContent = 'Message is required.';
            }

            // If form is valid, submit it
            if (isValid) {
                var formData = $(this).serialize();

                // Perform the AJAX request
                $.ajax({
                    url: '<?= BASE_URL . "popupsubmit" ?>',  // Your URL for form submission
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#form-response').html('<p>' + response.message + '</p>');
                        if (response.status === 'success') {
                            // Optionally, clear the form fields
                            $('#popup-form')[0].reset();
                            Swal.fire({
                                title: "Thank you!",
                                text: "Your information saved successfully...",
                                icon: "success"
                            });
                            contactForm.classList.remove("active");
                        }
                    },
                    error: function () {
                        contactForm.classList.remove("active");
                        // Show error if AJAX request fails
                        $('#form-response').html('<p>Something went wrong. Please try again.</p>');
                    }
                });
            }
        });
    });
</script>