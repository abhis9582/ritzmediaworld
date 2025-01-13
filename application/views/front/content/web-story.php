<html>

<head>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script custom-element="amp-story" async src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <script custom-element="amp-video" async src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <link rel="canonical" href="https://ritzmediaworld.com/web-story-test" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden;
            }

            to {
                visibility: visible;
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden;
            }

            to {
                visibility: visible;
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden;
            }

            to {
                visibility: visible;
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden;
            }

            to {
                visibility: visible;
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden;
            }

            to {
                visibility: visible;
            }
        }

        /* Styling for close button */
        .close-btn {
            position: absolute;
            /* top: 4px; */
            right: 35px;
            font-size: 40px;
            color: white;
            /* background-color: rgba(0, 0, 0, 0.5); */
            /* border-radius: 50%; */
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }
    </style>
    <noscript>
        <style amp-boilerplate>
            body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none;
            }
        </style>
    </noscript>
</head>

<body>
    <amp-story standalone publisher="Ritz Media World" title="Test Story"
        publisher-logo-src="https://ritzmediaworld.com/webroot/front/images/nn_logo.jpg"
        poster-portrait-src="https://ritzmediaworld.com/webroot/images/khm/60c14ca9-9a2b-bcb3-ef3d-8a95b5accf1d_1080_1080.png">
        <!-- Close Button -->
        <div class="close-btn" onclick="window.history.back();">&times;</div> <!-- This button uses the "×" symbol -->
        <?php if (count($webStory) > 0) {
            foreach ($webStory as $web) { ?>
                <amp-story-page id="story-<?= $web['id']; ?>">
                    <amp-story-grid-layer template="fill">
                        <amp-img src="<?php echo BASE_URL; ?>webroot/images/webstory/<?php echo
                               $web['file_url'] ?>" width="450" height="700" alt="First-story">
                        </amp-img>
                    </amp-story-grid-layer>
                    <amp-story-grid-layer template="vertical">
                        <h1><?= $web['heading'] ?></h1>
                        <p><?= $web['description'] ?></p>
                    </amp-story-grid-layer>
                </amp-story-page>
            <?php } ?>
        <?php } ?>
    </amp-story>
</body>

</html>