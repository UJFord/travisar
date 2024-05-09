<?php
session_start();
require "../../functions/connections.php";
require "../../functions/functions.php";
?>
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
    <script src="../../js/access-control.js"></script>
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
                <h1 class="about-head text-center">SARANGANI PROVINCE</h1>
            </div>
        </div>
    </div>

    <!-- about sarangani -->
    <div class="container mb-5">
        <div class="container">
            <div class="row mx-5">
                <div class="col">
                    <figure class="float-start w-25 m-4 mt-0 mb-2 ms-0">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Provincial_Capitol%2C_Sarangani_Province%2C_Philippines.JPG/1280px-Provincial_Capitol%2C_Sarangani_Province%2C_Philippines.JPG" alt="Sarangani Capitol Image" class="rounded about-img img-fluid">
                        <figcaption class="figure-caption text-end mt-2 small-font">Sarangani Capitol &copy; Wikipedia</figcaption>
                    </figure>
                    <h4 class="about-head">Sarangani</h4>
                    <p>Nestled along the southwestern shores of the Philippines lies Sarangani Province, a captivating destination renowned for its harmonious blend of natural wonders, cultural heritage, and warm hospitality. Stretching along the Celebes Sea, the province's coastline is adorned with pristine beaches, inviting travelers to bask in the sun-drenched sands and dive into the crystal-clear waters teeming with marine life. From vibrant coral reefs to hidden coves, Sarangani Bay offers a playground for water sports enthusiasts seeking to explore the wonders of the underwater world.
                    </p>
                    <p>Inland, Sarangani unfolds its lush tapestry of tropical rainforests, where towering canopies shelter a dazzling array of flora and fauna. Its verdant slopes beckon hikers to embark on a journey through dense forests, cascading waterfalls, and panoramic vistas that stretch as far as the eye can see. For those seeking solace in nature's embrace, Sarangani's hinterlands offer a sanctuary where the rhythm of life beats in harmony with the earth.</p>
                    <p>Amidst the natural splendor lies the vibrant tapestry of Sarangani's cultural heritage, woven together by indigenous tribes such as the Blaan and Tagakaolo. Proud guardians of age-old traditions, these communities celebrate their heritage through colorful festivals, intricate crafts, and mesmerizing dances that reflect their deep connection to the land and sea. Visitors are welcomed with open arms, invited to partake in rituals, sample traditional cuisine, and learn the art of weaving from master craftsmen, fostering meaningful connections that transcend language and culture.
                        As day fades into night, Sarangani's charm comes alive in its bustling markets, where the aroma of fresh seafood and exotic spices fills the air. Here, travelers can savor the flavors of local delicacies, from grilled tuna belly to seafood curry, served with a side of warm hospitality and genuine smiles. For those seeking relaxation, luxury resorts offer a sanctuary where modern comforts blend seamlessly with the natural surroundings, providing an idyllic retreat for weary souls in need of rejuvenation.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- about tribal communities -->
    <div class="container mb-5">
        <div class="container">
            <div class="row mx-5">
                <h4 class="about-head">Tribal Communities</h4>
                <div class="col">
                    <p>
                        Sarangani Province in the Philippines boasts a tapestry of tribal communities, each contributing a unique thread to the region's rich cultural fabric. Among these indigenous groups, the Blaan, Tboli, and Tagakaolo tribes stand out, embodying centuries-old traditions and a deep reverence for their ancestral lands. The Blaan people, renowned for their masterful beadwork and intricate weaving techniques, infuse their crafts with stories of their heritage, while their traditional music resonates with the rhythms of their ancestors. Meanwhile, the Tboli tribe is celebrated for its iconic T'nalak cloth, meticulously handwoven from abaca fibers and adorned with intricate designs that hold spiritual significance. Their craftsmanship extends to brass ornaments and jewelry, each piece reflecting their connection to nature and their cosmology.</p>
                    <figure class="float-end w-25 m-4 mt-0 mb-2 me-0">
                        <img src="https://images.unsplash.com/photo-1563280583-7c6d205d1188?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded about-img img-fluid">
                        <figcaption class="figure-caption text-end mt-2 small-font">&copy; Stephanie Ecate, Unsplash</figcaption>
                    </figure>
                    <p>Despite the encroachment of modernity, these tribal communities fiercely protect their cultural identity, passing down age-old practices from generation to generation. The Tagakaolo tribe, deeply rooted in agriculture and fishing, maintains a harmonious relationship with the land and sea, drawing sustenance from their surroundings while safeguarding them for future descendants. However, their way of life faces challenges such as land disputes and cultural assimilation, prompting efforts from both government and non-governmental organizations to support their rights and preserve their heritage. In recent years, initiatives aimed at empowering indigenous communities have gained momentum in Sarangani Province. Collaborative efforts between local authorities, NGOs, and tribal leaders seek to promote sustainable development that respects the traditions and aspirations of these marginalized groups. By providing access to education, healthcare, and economic opportunities while safeguarding their ancestral domains, these initiatives aim to foster self-reliance and cultural resilience among the indigenous peoples. Through partnerships that prioritize inclusivity and cultural sensitivity, strides are being made to bridge the gap between modernity and tradition, ensuring that Sarangani's tribal communities continue to thrive in a rapidly changing world.</p>

                    <p>As guardians of invaluable cultural heritage and stewards of the environment, the indigenous tribes of Sarangani Province play a vital role in shaping the region's identity and future. Their resilience in the face of adversity serves as a testament to the enduring strength of indigenous cultures worldwide. As Sarangani embraces progress, it does so with a commitment to honoring and preserving the legacy of its tribal communities, recognizing that their wisdom and traditions are indispensable treasures to be cherished and protected for generations to come.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- about traditional varieties -->
    <div class="container mb-5">
        <div class="container">
            <div class="row mx-5">
                <div class="col">
                    <figure class="float-start w-25 m-4 mt-0 mb-2 ms-0">
                        <img src="https://images.unsplash.com/photo-1577110058859-74547db40bc0?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded about-img img-fluid">
                        <figcaption class="figure-caption text-end mt-2 small-font">&copy; Faris Mohammed, Unsplash</figcaption>
                    </figure>
                    <h4 class="about-head">Traditional Varieties</h4>
                    <p>Sarangani Province in the Philippines is blessed with a rich agricultural heritage, characterized by a diverse array of traditional crop varieties cultivated by local farmers. These crops, carefully selected and cultivated over generations, not only provide sustenance but also embody the cultural and ecological resilience of the region. Among the traditional crop varieties are rice, corn, and root crops such as cassava, sweet potato, and taro, which form the staple diet of many communities. Rice, in particular, holds a central place in Filipino cuisine and culture, with various heirloom varieties adapted to different agro-ecological conditions. Corn, another staple crop, is cultivated for both human consumption and livestock feed, with indigenous varieties prized for their resilience and nutritional value.</p>
                    <p>In addition to staples, Sarangani's traditional crop varieties include a wide range of fruits and vegetables, reflecting the region's biodiversity and climatic diversity. Tropical fruits such as bananas, mangoes, papayas, and coconuts thrive in the province's warm and humid climate, providing a vital source of vitamins and minerals. Indigenous vegetables like ampalaya (bitter gourd), malunggay (moringa), and kangkong (water spinach) are valued not only for their nutritional benefits but also for their medicinal properties, deeply ingrained in local folk medicine practices. Furthermore, Sarangani's traditional crop varieties encompass a variety of herbs, spices, and condiments used to enhance flavor and aroma in traditional dishes, adding depth and complexity to the culinary landscape.</p>
                    <!-- paragraph -->
                    <p>Beyond their nutritional and culinary significance, traditional crop varieties play a crucial role in preserving agro-biodiversity and promoting food security in Sarangani Province. Local farmers, often practicing sustainable and organic farming methods, prioritize the preservation and propagation of heirloom seeds and plant varieties adapted to local conditions. This not only enhances the resilience of agricultural ecosystems but also reduces reliance on external inputs such as chemical fertilizers and pesticides, contributing to environmental sustainability. Moreover, the cultivation of traditional crop varieties strengthens community ties and cultural identity, as knowledge and practices are passed down through oral traditions and hands-on experience, fostering a sense of pride and belonging among farmers and their families.</p>
                    <!-- paragraph -->
                    <p>In the face of modern agricultural practices and the challenges of climate change, efforts to conserve and promote Sarangani's traditional crop varieties are increasingly recognized as essential for ensuring food sovereignty and resilience. Government agencies, NGOs, and local initiatives are working together to support smallholder farmers, preserve indigenous knowledge, and promote sustainable farming practices that prioritize biodiversity conservation and community well-being. By celebrating and safeguarding the diversity of traditional crop varieties, Sarangani Province honors its agricultural heritage and secures a vibrant and resilient future for generations to come.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER -->
    <?php require "../../nav/foot.php" ?>


    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <script src="../js/nav.js"></script>
    <script src="../../js/access.js"></script>
</body>

</html>