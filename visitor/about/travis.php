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
        <div class="row mx-5">
            <!-- title -->
            <div class="col-4 px-4 pb-4 d-flex justify-content-center align-items-center">
                <img class=" w-100 rounded-1" src="../img/travis.svg" alt="" srcset="">
            </div>
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">TRAVIS</h4>
                <p>Once upon a time in the vast digital landscape of the internet, there emerged a website named Travis. Born from the visionary dreams of its founder, Travis began its journey as a humble platform, aiming to revolutionize the way people plan and experience their travels. With a mission to provide comprehensive travel solutions and inspire wanderlust, Travis embarked on a remarkable quest to carve its niche in the competitive realm of online travel services.</p>

            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>From its inception, Travis was driven by a relentless commitment to excellence and innovation. Its creators poured their passion and expertise into crafting a user-centric experience, meticulously designing features and functionalities that catered to the diverse needs of modern travelers. With intuitive navigation, personalized recommendations, and seamless booking capabilities, Travis quickly captured the hearts and minds of wanderers worldwide, earning a reputation as the go-to destination for all things travel-related.</p>
            <p>As Travis flourished, so did its ambitions. Fuelled by a fervent desire to redefine the travel industry, Travis expanded its offerings beyond mere itinerary planning, venturing into the realms of community engagement and experiential storytelling. Through captivating blog posts, immersive travel guides, and vibrant social media channels, Travis fostered a vibrant community of globetrotters, united by their shared passion for exploration and discovery. Whether seeking insider tips from seasoned travelers or sharing their own adventures with like-minded enthusiasts, users found solace and inspiration in the virtual realm of Travis.</p>
            <p>But Travis's journey was not without its challenges. In a landscape marked by rapid technological advancements and shifting consumer preferences, Travis faced the daunting task of staying ahead of the curve. Undeterred, its team of dedicated innovators embraced change as an opportunity for growth, constantly iterating and evolving to meet the evolving needs of its audience. Through strategic partnerships, cutting-edge developments in artificial intelligence, and a relentless focus on user feedback, Travis remained at the forefront of the digital travel revolution, adapting and thriving in an ever-changing landscape.</p>
            <p>As the years passed, Travis's influence continued to expand, leaving an indelible mark on the world of travel. From solo adventurers embarking on epic backpacking journeys to families seeking unforgettable vacation experiences, travelers of all stripes found refuge and inspiration in the welcoming embrace of Travis. With each click, each booking, and each shared moment of wanderlust, Travis reaffirmed its commitment to making the world a more connected, accessible, and awe-inspiring place. And as the sun set on another day in the digital realm, Travis stood tall, a beacon of innovation and imagination in a world brimming with possibility.</p>
        </div>
    </div>
    
    <!-- about developers -->
    <div class="container mb-4">
        <div class="row mx-5">
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Developers</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim!</p>
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