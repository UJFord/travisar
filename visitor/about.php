<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Home</title>
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
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- landing.css -->
    <link rel="stylesheet" href="css/about.css?v=1.0">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body class="" style="background-color: #f5f5f5;">
    <!-- NAVBAR -->
    <?php require "../nav/nav.php" ?>

    <!-- SARANGANI -->
    <!-- title -->
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="row py-5 mb-4">
                <h1 class="about-head text-center">ABOUT SARANGANI PROVINCE</h1>
            </div>
        </div>
    </div>

    <!-- about sarangani -->
    <div class="container mb-5">
        <div class="row mx-5">
            <!-- title -->
            <div class="col-4 px-4 pb-4">
                <img class="about-img w-100 rounded-1 d-flex justify-content-center align-items-center" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Provincial_Capitol%2C_Sarangani_Province%2C_Philippines.JPG/1280px-Provincial_Capitol%2C_Sarangani_Province%2C_Philippines.JPG" alt="" srcset="">
            </div>
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Sarangani</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim!</p>
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, doloribus, atque, eveniet dolor repellat sequi dolore sapiente iste omnis veritatis eum earum quae consectetur incidunt quisquam. Facere libero odio quisquam vel vitae nulla dolorum voluptas?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quo quas mollitia quis ad voluptate ut neque eum, natus dolor ratione molestias? Molestias impedit quam optio, laborum pariatur nihil vel facere nulla velit animi error praesentium sapiente, ratione amet! Veniam maiores sed rem voluptatum dolor porro, aperiam iure laudantium asperiores provident, mollitia nam minus, maxime nobis at perspiciatis qui incidunt molestias quasi? Id beatae consequatur rem voluptates, facere natus qui quae cum voluptatum atque mollitia rerum, temporibus asperiores nisi at, in vitae! Ullam rerum fugiat autem aliquam esse, asperiores tenetur consequuntur, odio magni dignissimos at officiis velit aperiam doloribus, ab accusantium! Maiores magni id, voluptatem nulla ipsam facere doloremque natus dolor, asperiores dicta, distinctio ab delectus quas! Nulla debitis consequatur impedit a delectus.</p>
        </div>
    </div>

    <!-- about msu gensan -->
    <div class="container mb-5">
        <div class="row mx-5">
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Tribal Communities</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim!</p>
            </div>
            <!-- title -->
            <div class="col-4 px-4 pb-4">
                <img class="about-img w-100 rounded-1 d-flex justify-content-center align-items-center" src="https://images.unsplash.com/photo-1563280583-7c6d205d1188?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="">
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, doloribus, atque, eveniet dolor repellat sequi dolore sapiente iste omnis veritatis eum earum quae consectetur incidunt quisquam. Facere libero odio quisquam vel vitae nulla dolorum voluptas?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quo quas mollitia quis ad voluptate ut neque eum, natus dolor ratione molestias? Molestias impedit quam optio, laborum pariatur nihil vel facere nulla velit animi error praesentium sapiente, ratione amet! Veniam maiores sed rem voluptatum dolor porro, aperiam iure laudantium asperiores provident, mollitia nam minus, maxime nobis at perspiciatis qui incidunt molestias quasi? Id beatae consequatur rem voluptates, facere natus qui quae cum voluptatum atque mollitia rerum, temporibus asperiores nisi at, in vitae! Ullam rerum fugiat autem aliquam esse, asperiores tenetur consequuntur, odio magni dignissimos at officiis velit aperiam doloribus, ab accusantium! Maiores magni id, voluptatem nulla ipsam facere doloremque natus dolor, asperiores dicta, distinctio ab delectus quas! Nulla debitis consequatur impedit a delectus.</p>
        </div>
    </div>

    <!-- traditional varieties -->
    <div class="container mb-4">
        <div class="row mx-5">
            <!-- title -->
            <div class="col-4 px-4 pb-4">
                <img class="about-img w-100 rounded-1 d-flex justify-content-center align-items-center" src="https://images.unsplash.com/photo-1577110058859-74547db40bc0?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="">
            </div>
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Traditional Varieties</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim!</p>
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, doloribus, atque, eveniet dolor repellat sequi dolore sapiente iste omnis veritatis eum earum quae consectetur incidunt quisquam. Facere libero odio quisquam vel vitae nulla dolorum voluptas?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quo quas mollitia quis ad voluptate ut neque eum, natus dolor ratione molestias? Molestias impedit quam optio, laborum pariatur nihil vel facere nulla velit animi error praesentium sapiente, ratione amet! Veniam maiores sed rem voluptatum dolor porro, aperiam iure laudantium asperiores provident, mollitia nam minus, maxime nobis at perspiciatis qui incidunt molestias quasi? Id beatae consequatur rem voluptates, facere natus qui quae cum voluptatum atque mollitia rerum, temporibus asperiores nisi at, in vitae! Ullam rerum fugiat autem aliquam esse, asperiores tenetur consequuntur, odio magni dignissimos at officiis velit aperiam doloribus, ab accusantium! Maiores magni id, voluptatem nulla ipsam facere doloremque natus dolor, asperiores dicta, distinctio ab delectus quas! Nulla debitis consequatur impedit a delectus.</p>
        </div>
    </div>

    <!-- TRAVIS -->
    <!-- title -->
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="row py-5 mb-4">
                <h1 class="about-head text-center d-flex justify-content-center align-items-center">ABOUT <span><img class="ms-3 travis-sec-logo" src="img/travis.svg" alt="" srcset=""></span></h1>
            </div>
        </div>
    </div>

    <!-- about travis -->
    <div class="container mb-5">
        <div class="row mx-5">
            <!-- title -->
            <div class="col-4 px-4 pb-4 d-flex justify-content-center align-items-center">
                <img class=" w-100 rounded-1" src="img/travis.svg" alt="" srcset="">
            </div>
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">TRAVIS</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim!</p>
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, doloribus, atque, eveniet dolor repellat sequi dolore sapiente iste omnis veritatis eum earum quae consectetur incidunt quisquam. Facere libero odio quisquam vel vitae nulla dolorum voluptas?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quo quas mollitia quis ad voluptate ut neque eum, natus dolor ratione molestias? Molestias impedit quam optio, laborum pariatur nihil vel facere nulla velit animi error praesentium sapiente, ratione amet! Veniam maiores sed rem voluptatum dolor porro, aperiam iure laudantium asperiores provident, mollitia nam minus, maxime nobis at perspiciatis qui incidunt molestias quasi? Id beatae consequatur rem voluptates, facere natus qui quae cum voluptatum atque mollitia rerum, temporibus asperiores nisi at, in vitae! Ullam rerum fugiat autem aliquam esse, asperiores tenetur consequuntur, odio magni dignissimos at officiis velit aperiam doloribus, ab accusantium! Maiores magni id, voluptatem nulla ipsam facere doloremque natus dolor, asperiores dicta, distinctio ab delectus quas! Nulla debitis consequatur impedit a delectus.</p>
        </div>
    </div>

    <!-- about msu -->
    <div class="container mb-5">
        <div class="row mx-5">
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Mindanao State University - General Santos City</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea atque, asperiores quisquam, magni nisi dolores nobis saepe accusantium quas, possimus ratione! Omnis qui molestiae quaerat, maiores incidunt minus adipisci ad perspiciatis magni natus tempora earum alias dolor illo quibusdam voluptates enim ut blanditiis suscipit hic laborum at officia quas. Fugit dolores voluptate et reprehenderit corrupti maiores eligendi soluta saepe id sint nulla, numquam sit expedita, cupiditate eius, dicta quis laboriosam inventore. Nisi, accusantium! Quasi pariatur perspiciatis vitae ab commodi nesciunt debitis molestiae fuga eligendi consequuntur doloremque, ducimus officia deserunt harum qui alias dolor mollitia autem vero expedita labore! Necessitatibus dolore vero beatae amet nostrum ducimus neque, eius nihil delectus repellat id, molestiae dolorem veritatis ipsum corrupti saepe magnam reprehenderit aliquam libero enim! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa neque debitis minus iste voluptatibus incidunt, at saepe minima accusamus perferendis.</p>
            </div>
            <!-- title -->
            <div class="col-4 px-4 pb-4">
                <img class="w-100 rounded-1" src="img/msu-gensan-logo-85758e.png" alt="" srcset="">
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, doloribus, atque, eveniet dolor repellat sequi dolore sapiente iste omnis veritatis eum earum quae consectetur incidunt quisquam. Facere libero odio quisquam vel vitae nulla dolorum voluptas?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quo quas mollitia quis ad voluptate ut neque eum, natus dolor ratione molestias? Molestias impedit quam optio, laborum pariatur nihil vel facere nulla velit animi error praesentium sapiente, ratione amet! Veniam maiores sed rem voluptatum dolor porro, aperiam iure laudantium asperiores provident, mollitia nam minus, maxime nobis at perspiciatis qui incidunt molestias quasi? Id beatae consequatur rem voluptates, facere natus qui quae cum voluptatum atque mollitia rerum, temporibus asperiores nisi at, in vitae! Ullam rerum fugiat autem aliquam esse, asperiores tenetur consequuntur, odio magni dignissimos at officiis velit aperiam doloribus, ab accusantium! Maiores magni id, voluptatem nulla ipsam facere doloremque natus dolor, asperiores dicta, distinctio ab delectus quas! Nulla debitis consequatur impedit a delectus.</p>
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


        <!-- SCRIPT -->
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- CUSTOM -->
        <script src="js/nav.js"></script>
</body>

</html>