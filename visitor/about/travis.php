<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | About</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/travis-light.svg">
    <!-- CSS -->
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

    <!-- CUSTOM CSS -->
    <!-- global -->
    <link rel="stylesheet" href="../../css/global-declarations.css">
    <!-- landing.css -->
    <link rel="stylesheet" href="../css/about.css?v=1.0">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body class="" style="background-color: #f5f5f5;">
    <!-- NAVBAR -->
    <?php require "../../nav/nav.php" ?>

    <!-- TRAVIS -->
    <!-- title -->
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="row py-5 mb-4">
                <h1 class="about-head text-center d-flex justify-content-center align-items-center"><span><img class="ms-3 travis-sec-logo" src="../img/travis.svg" alt="" srcset=""></span></h1>
            </div>
        </div>
    </div>

    <!-- about travis -->
    <div class="container mb-5">
        <div class="container">
            <div class="row mx-5">
                <div class="col">
                    <figure class="float-start w-25 m-5 mt-5 mb-5">
                        <img src="../img/travis.svg" class="img-fluid">
                    </figure>
                    <h4 class="about-head">TRAVIS</h4>
                    <p>Once upon a time in the vast digital landscape of the internet, there emerged a website named Travis. Born from the visionary dreams of its founder, Travis began its journey as a humble platform, aiming to revolutionize the way people plan and experience their travels. With a mission to provide comprehensive travel solutions and inspire wanderlust, Travis embarked on a remarkable quest to carve its niche in the competitive realm of online travel services.</p>
                    <p>From its inception, Travis was driven by a relentless commitment to excellence and innovation. Its creators poured their passion and expertise into crafting a user-centric experience, meticulously designing features and functionalities that catered to the diverse needs of modern travelers. With intuitive navigation, personalized recommendations, and seamless booking capabilities, Travis quickly captured the hearts and minds of wanderers worldwide, earning a reputation as the go-to destination for all things travel-related.</p>
                    <p>As Travis flourished, so did its ambitions. Fuelled by a fervent desire to redefine the travel industry, Travis expanded its offerings beyond mere itinerary planning, venturing into the realms of community engagement and experiential storytelling. Through captivating blog posts, immersive travel guides, and vibrant social media channels, Travis fostered a vibrant community of globetrotters, united by their shared passion for exploration and discovery. Whether seeking insider tips from seasoned travelers or sharing their own adventures with like-minded enthusiasts, users found solace and inspiration in the virtual realm of Travis.</p>
                    <p>But Travis's journey was not without its challenges. In a landscape marked by rapid technological advancements and shifting consumer preferences, Travis faced the daunting task of staying ahead of the curve. Undeterred, its team of dedicated innovators embraced change as an opportunity for growth, constantly iterating and evolving to meet the evolving needs of its audience. Through strategic partnerships, cutting-edge developments in artificial intelligence, and a relentless focus on user feedback, Travis remained at the forefront of the digital travel revolution, adapting and thriving in an ever-changing landscape.</p>
                    <p>As the years passed, Travis's influence continued to expand, leaving an indelible mark on the world of travel. From solo adventurers embarking on epic backpacking journeys to families seeking unforgettable vacation experiences, travelers of all stripes found refuge and inspiration in the welcoming embrace of Travis. With each click, each booking, and each shared moment of wanderlust, Travis reaffirmed its commitment to making the world a more connected, accessible, and awe-inspiring place. And as the sun set on another day in the digital realm, Travis stood tall, a beacon of innovation and imagination in a world brimming with possibility.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- about developers -->
    <div class="container mb-5">
        <div class="container">

            <h4 class="mx-5 about-head">The Developers</h4>
            <div class="row mx-5 d-flex justify-content-center align-items-center py-5">

                <!-- Bangoy -->
                <div class="col-3 mx-3">
                    <figure class="d-flex justify-content-center align-items-center">
                        <img class="dev-img img-fluid rounded-circle" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/386449090_1008619143698809_2700737984541098624_n.jpg?stp=dst-jpg_p403x403&_nc_cat=106&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeG_K7aBV7F9M1noIeOjJJVeDh9Xmz1QnK8OH1ebPVCcr-nhVDk0W2K5gstgo0vnH1YD9rjMbv88rpHxzndoW8Bz&_nc_ohc=ueLg9Hiaw3oQ7kNvgG6rjv-&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QGFJMfV2ZOdw3RligdX-H06xaV8XEJ1gUkOvA4X0syVpQ&oe=66616166" alt="" srcset="">
                    </figure>
                    <h6 class="fw-bold text-center">Bangoy, Richard Joshua C.,</h6>
                    <h6 class="fst-italic text-center text-secondary small-font">Business Analyst / Project Manager</h6>
                </div>

                <!-- Salazat -->
                <div class="col-3 mx-3">
                    <figure class="d-flex justify-content-center align-items-center">
                        <img class="dev-img img-fluid rounded-circle" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/440765106_453522637344094_7823705390113477331_n.png?stp=dst-png_p180x540&_nc_cat=101&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFOBGxSB66qhh3awA6Kxp6scwVUpjWAqjtzBVSmNYCqO9M48pXX8XOgyrzsKTSoPEII4Z8PHs1L7j3-iI3nLl63&_nc_ohc=LRgPJblywycQ7kNvgGbrHiL&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QGib-10UYPzqxHjYBXQe7qZaqv7nLZwRMEP8GU8vjTohQ&oe=66616A40" alt="" srcset="">
                    </figure>
                    <h6 class="fw-bold text-center">Salazar, Emmanuelle R.</h6>
                    <h6 class="fst-italic text-center text-secondary small-font">Full Stack Developer</h6>
                </div>

                <!-- ulbata -->
                <div class="col-3 mx-3">
                    <figure class="d-flex justify-content-center align-items-center">
                        <img class="dev-img img-fluid rounded-circle" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/438332817_1462275011092817_7890967766843709455_n.jpg?stp=dst-jpg_s403x403&_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeHHgYXN4UHFf53ytoDQZf4mnKowynss0vycqjDKeyzS_EYALTAyhwq-1zrsF7ammQJPiGg9E71kTWrlZgA89kWi&_nc_ohc=FisN8MNduh0Q7kNvgEtxsTo&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_Q7cD1QG5VCuHbLey1LtfM9rjVCWGkoFpKGimtNjaBVVwy4G9kA&oe=6661437C" alt="" srcset="">
                    </figure>
                    <h6 class="fw-bold text-center">Ulbata, John Ford R.</h6>
                    <h6 class="fst-italic text-center text-secondary small-font">Full Stack Developer</h6>
                </div>
            </div>

            <div class="row mx-5">
                <div class="col">
                    <p>Once upon a time in the vast digital landscape of the internet, there emerged a website named Travis. Born from the visionary dreams of its founder, Travis began its journey as a humble platform, aiming to revolutionize the way people plan and experience their travels. With a mission to provide comprehensive travel solutions and inspire wanderlust, Travis embarked on a remarkable quest to carve its niche in the competitive realm of online travel services.</p>
                    <figure class="float-end w-25 m-4 mt-0 mb-2 me-0">
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1949&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sarangani Capitol Image" class="rounded about-img img-fluid">
                    </figure>
                    <p>From its inception, Travis was driven by a relentless commitment to excellence and innovation. Its creators poured their passion and expertise into crafting a user-centric experience, meticulously designing features and functionalities that catered to the diverse needs of modern travelers. With intuitive navigation, personalized recommendations, and seamless booking capabilities, Travis quickly captured the hearts and minds of wanderers worldwide, earning a reputation as the go-to destination for all things travel-related.</p>
                    <p>As Travis flourished, so did its ambitions. Fuelled by a fervent desire to redefine the travel industry, Travis expanded its offerings beyond mere itinerary planning, venturing into the realms of community engagement and experiential storytelling. Through captivating blog posts, immersive travel guides, and vibrant social media channels, Travis fostered a vibrant community of globetrotters, united by their shared passion for exploration and discovery. Whether seeking insider tips from seasoned travelers or sharing their own adventures with like-minded enthusiasts, users found solace and inspiration in the virtual realm of Travis.</p>
                    <p>But Travis's journey was not without its challenges. In a landscape marked by rapid technological advancements and shifting consumer preferences, Travis faced the daunting task of staying ahead of the curve. Undeterred, its team of dedicated innovators embraced change as an opportunity for growth, constantly iterating and evolving to meet the evolving needs of its audience. Through strategic partnerships, cutting-edge developments in artificial intelligence, and a relentless focus on user feedback, Travis remained at the forefront of the digital travel revolution, adapting and thriving in an ever-changing landscape.</p>
                    <p>As the years passed, Travis's influence continued to expand, leaving an indelible mark on the world of travel. From solo adventurers embarking on epic backpacking journeys to families seeking unforgettable vacation experiences, travelers of all stripes found refuge and inspiration in the welcoming embrace of Travis. With each click, each booking, and each shared moment of wanderlust, Travis reaffirmed its commitment to making the world a more connected, accessible, and awe-inspiring place. And as the sun set on another day in the digital realm, Travis stood tall, a beacon of innovation and imagination in a world brimming with possibility.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <script src="js/nav.js"></script>
</body>

</html>