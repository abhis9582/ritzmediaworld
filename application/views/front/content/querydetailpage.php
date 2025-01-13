<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ritz Media World | RMW</title>
    <link rel="icon" type="image/x-icon" href="/images/nn_logo.jpg">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>webroot/front/css/querypage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="continer">
        <div class="d-flex justify-content-center mt-2 logo">
            <img class="main-logo" src="https://ritzmediaworld.com/webroot/front/images/nn_logo.jpg" alt="logo">
        </div>
        <h4 class="text-center mt-2">Ritz Media World</h4>
        <div class="d-flex justify-content-center mt-4">
            <a href="https://www.facebook.com/ritzmediaworld/" class="icon mx-3">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://www.instagram.com/ritzmediaworld/" class="icon mx-3">
                <i class="fa fa-instagram"></i>
            </a>
            <a href="https://twitter.com/ritzmediaworld" class="icon mx-3">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="https://www.youtube.com/c/RitzMediaWorldCreativeThinksMedia" class="icon mx-3">
                <i class="fa fa-youtube"></i>
            </a>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a class="visit-button" href="https://ritzmediaworld.com/">Visit Ritz Media World!</a>
        </div>
        <div class="breadcrum mt-4">
            <div class="col">
                <p class="text-center"><a href="#" class="breadcrumb-link">Avail Services</a></p>
            </div>
            <div class="col">
                <p class="text-center"><a href="#" class="breadcrumb-link">Articles</a></p>
            </div>
            <div class="col">
                <p class="text-center"><a href="#" class="breadcrumb-link">Jobs</a></p>
            </div>
        </div>

        <div class="container mt-5" id="container1">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLScjq2oURGYyZKeJfR49FYZEJTbkgdGZ9rzPUZ8BsUnuUQ2n1g/viewform" target="_blank"
                class="first-button">
                Submit your requirements
            </a>
        </div>
        <div class="container mt-4" id="container2">
            <div class="row">
                <div class="col-lg-3 mt-3">
                    <a href="https://ritzmediaworld.com/blog/creative-graphic-design-agency-near-me-noida/"
                        class="post-images">
                        <img src="https://ritzmediaworld.com/webroot/images/blogs/eed7e9c3-45f3-3a43-0fef-14a47794003f_800_400.jpg"
                            alt="post image">
                    </a>
                </div>
                <div class="col-lg-3 mt-3">
                    <a href="https://ritzmediaworld.com/blog/best-seo-company-in-noida-seo-services-agency-noida/"
                        class="post-images">
                        <img src="https://ritzmediaworld.com/webroot/images/blogs/587db435-0b37-d494-627e-7f9d7b6c8a20_800_400.jpg"
                            alt="post image">
                    </a>
                </div>
                <div class="col-lg-3 mt-3">
                    <a href="https://ritzmediaworld.com/blog/best-digital-marketing-agencies-in-noida/"
                        class="post-images">
                        <img src="https://ritzmediaworld.com/webroot/images/blogs/9c2ad543-edc1-cbb7-bdd2-0dcda2a5d1bb_800_400.jpg"
                            alt="post image">
                    </a>
                </div>
                <div class="col-lg-3 mt-3">
                    <a href="https://ritzmediaworld.com/blog/best-advertising-and-printing-services-near-me/"
                        class="post-images">
                        <img src="https://ritzmediaworld.com/webroot/images/blogs/45961431-276e-8fa1-fd14-a3d0a944a23b_1400_700.png"
                            alt="post image">
                    </a>
                </div>

            </div>
        </div>
        <div class="container mt-5" id="container3">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSe0aBqYfGXLbORqspvbNTZTEmcZKd8RAAb1gHhisbMppYoIGg/viewform" target="_blank"
                class="first-button">
                Apply for a position
            </a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const breadcrumbLinks = document.querySelectorAll('.breadcrumb-link');
            const containers = document.querySelectorAll('[id^="container"]');
            breadcrumbLinks.forEach((link, index) => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    containers.forEach(container => {
                        container.style.display = 'none';
                    });
                    containers[index].style.display = 'block';
                    breadcrumbLinks.forEach(link => {
                        link.parentElement.classList.remove('active');
                    });
                    link.parentElement.classList.add('active');
                });
            });
            containers.forEach((container, i) => {
                if (i !== 0) container.style.display = 'none';
            });
            breadcrumbLinks[0].parentElement.classList.add('active');
        });


    </script>

</body>

</html>