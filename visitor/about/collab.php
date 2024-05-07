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

    <!-- SARANGANI -->
    <!-- title -->
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="row py-5 mb-4">
                <h1 class="about-head text-center">COLLABORATORS</h1>
            </div>
        </div>
    </div>

    <!-- collaborators -->
    <div class="container mb-5">
        <div class="row mx-5">
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Tribal Communities</h4>
                <p>
                    Sarangani Province in the Philippines boasts a tapestry of tribal communities, each contributing a unique thread to the region's rich cultural fabric. Among these indigenous groups, the Blaan, Tboli, and Tagakaolo tribes stand out, embodying centuries-old traditions and a deep reverence for their ancestral lands. The Blaan people, renowned for their masterful beadwork and intricate weaving techniques, infuse their crafts with stories of their heritage, while their traditional music resonates with the rhythms of their ancestors. Meanwhile, the Tboli tribe is celebrated for its iconic T'nalak cloth, meticulously handwoven from abaca fibers and adorned with intricate designs that hold spiritual significance. Their craftsmanship extends to brass ornaments and jewelry, each piece reflecting their connection to nature and their cosmology.</p>
            </div>
            <!-- title -->
            <div class="col-4 px-4 pb-4">
                <img class="about-img w-100 rounded-1 d-flex justify-content-center align-items-center" src="https://images.unsplash.com/photo-1563280583-7c6d205d1188?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="">
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Despite the encroachment of modernity, these tribal communities fiercely protect their cultural identity, passing down age-old practices from generation to generation. The Tagakaolo tribe, deeply rooted in agriculture and fishing, maintains a harmonious relationship with the land and sea, drawing sustenance from their surroundings while safeguarding them for future descendants. However, their way of life faces challenges such as land disputes and cultural assimilation, prompting efforts from both government and non-governmental organizations to support their rights and preserve their heritage. In recent years, initiatives aimed at empowering indigenous communities have gained momentum in Sarangani Province. Collaborative efforts between local authorities, NGOs, and tribal leaders seek to promote sustainable development that respects the traditions and aspirations of these marginalized groups. By providing access to education, healthcare, and economic opportunities while safeguarding their ancestral domains, these initiatives aim to foster self-reliance and cultural resilience among the indigenous peoples. Through partnerships that prioritize inclusivity and cultural sensitivity, strides are being made to bridge the gap between modernity and tradition, ensuring that Sarangani's tribal communities continue to thrive in a rapidly changing world.</p>

            <p>As guardians of invaluable cultural heritage and stewards of the environment, the indigenous tribes of Sarangani Province play a vital role in shaping the region's identity and future. Their resilience in the face of adversity serves as a testament to the enduring strength of indigenous cultures worldwide. As Sarangani embraces progress, it does so with a commitment to honoring and preserving the legacy of its tribal communities, recognizing that their wisdom and traditions are indispensable treasures to be cherished and protected for generations to come.</p>
        </div>
    </div>


    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <script src="js/nav.js"></script>
</body>

</html>