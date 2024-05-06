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
                <p>Nestled along the southwestern shores of the Philippines lies Sarangani Province, a captivating destination renowned for its harmonious blend of natural wonders, cultural heritage, and warm hospitality. Stretching along the Celebes Sea, the province's coastline is adorned with pristine beaches, inviting travelers to bask in the sun-drenched sands and dive into the crystal-clear waters teeming with marine life. From vibrant coral reefs to hidden coves, Sarangani Bay offers a playground for water sports enthusiasts seeking to explore the wonders of the underwater world.
                </p>
                <p>Inland, Sarangani unfolds its lush tapestry of tropical rainforests, where towering canopies shelter a dazzling array of flora and fauna. Its verdant slopes beckon hikers to embark on a journey through dense forests, cascading waterfalls, and panoramic vistas that stretch as far as the eye can see. For those seeking solace in nature's embrace, Sarangani's hinterlands offer a sanctuary where the rhythm of life beats in harmony with the earth.</p>
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Amidst the natural splendor lies the vibrant tapestry of Sarangani's cultural heritage, woven together by indigenous tribes such as the Blaan and Tagakaolo. Proud guardians of age-old traditions, these communities celebrate their heritage through colorful festivals, intricate crafts, and mesmerizing dances that reflect their deep connection to the land and sea. Visitors are welcomed with open arms, invited to partake in rituals, sample traditional cuisine, and learn the art of weaving from master craftsmen, fostering meaningful connections that transcend language and culture.
                As day fades into night, Sarangani's charm comes alive in its bustling markets, where the aroma of fresh seafood and exotic spices fills the air. Here, travelers can savor the flavors of local delicacies, from grilled tuna belly to seafood curry, served with a side of warm hospitality and genuine smiles. For those seeking relaxation, luxury resorts offer a sanctuary where modern comforts blend seamlessly with the natural surroundings, providing an idyllic retreat for weary souls in need of rejuvenation.</p>
        </div>
    </div>

    <!-- about msu gensan -->
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

    <!-- traditional varieties -->
    <div class="container mb-4">
        <div class="row mx-5">
            <!-- title -->
            <div class="col-4 px-4 pb-4">
                <img class="about-img w-100 rounded-1 d-flex justify-content-center align-items-center" src="https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="">
            </div>
            <!-- paragraph -->
            <div class="col">
                <h4 class="about-head">Traditional Varieties</h4>
                <p>Sarangani Province in the Philippines is blessed with a rich agricultural heritage, characterized by a diverse array of traditional crop varieties cultivated by local farmers. These crops, carefully selected and cultivated over generations, not only provide sustenance but also embody the cultural and ecological resilience of the region. Among the traditional crop varieties are rice, corn, and root crops such as cassava, sweet potato, and taro, which form the staple diet of many communities. Rice, in particular, holds a central place in Filipino cuisine and culture, with various heirloom varieties adapted to different agro-ecological conditions. Corn, another staple crop, is cultivated for both human consumption and livestock feed, with indigenous varieties prized for their resilience and nutritional value.</p>

            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>In addition to staples, Sarangani's traditional crop varieties include a wide range of fruits and vegetables, reflecting the region's biodiversity and climatic diversity. Tropical fruits such as bananas, mangoes, papayas, and coconuts thrive in the province's warm and humid climate, providing a vital source of vitamins and minerals. Indigenous vegetables like ampalaya (bitter gourd), malunggay (moringa), and kangkong (water spinach) are valued not only for their nutritional benefits but also for their medicinal properties, deeply ingrained in local folk medicine practices. Furthermore, Sarangani's traditional crop varieties encompass a variety of herbs, spices, and condiments used to enhance flavor and aroma in traditional dishes, adding depth and complexity to the culinary landscape.</p>
            <!-- paragraph -->
            <p>Beyond their nutritional and culinary significance, traditional crop varieties play a crucial role in preserving agro-biodiversity and promoting food security in Sarangani Province. Local farmers, often practicing sustainable and organic farming methods, prioritize the preservation and propagation of heirloom seeds and plant varieties adapted to local conditions. This not only enhances the resilience of agricultural ecosystems but also reduces reliance on external inputs such as chemical fertilizers and pesticides, contributing to environmental sustainability. Moreover, the cultivation of traditional crop varieties strengthens community ties and cultural identity, as knowledge and practices are passed down through oral traditions and hands-on experience, fostering a sense of pride and belonging among farmers and their families.</p>
            <!-- paragraph -->
            <p>In the face of modern agricultural practices and the challenges of climate change, efforts to conserve and promote Sarangani's traditional crop varieties are increasingly recognized as essential for ensuring food sovereignty and resilience. Government agencies, NGOs, and local initiatives are working together to support smallholder farmers, preserve indigenous knowledge, and promote sustainable farming practices that prioritize biodiversity conservation and community well-being. By celebrating and safeguarding the diversity of traditional crop varieties, Sarangani Province honors its agricultural heritage and secures a vibrant and resilient future for generations to come.</p>
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

    <!-- about msu -->
    <div class="container mb-5">
        <div class="row mx-5">
            <!-- paragraph -->
            <div class="col p-container">
                <h4 class="about-head">Mindanao State University - General Santos City</h4>
                <p>Nestled in the heart of General Santos City, Mindanao State University - General Santos (MSU-Gensan) stood as a beacon of knowledge and progress in the southern Philippines. From its humble beginnings as a satellite campus of the prestigious Mindanao State University system, MSU-Gensan had grown into a thriving hub of academic excellence, innovation, and community engagement. Its sprawling campus, framed by lush greenery and modern facilities, served as a testament to the institution's commitment to holistic education and sustainable development.</p>
                <p>At MSU-Gensan, students from diverse backgrounds came together to pursue their dreams and aspirations. Guided by a dedicated faculty of scholars and mentors, they embarked on transformative journeys of discovery, unlocking their potential and shaping the future of their communities. From the bustling halls of the College of Education to the cutting-edge laboratories of the College of Information Technology, the campus buzzed with the energy of intellectual curiosity and creative exploration.</p>
            </div>
            <!-- title -->
            <div class="col-3 px-4 pb-4">
                <img class="w-100 rounded-1" src="img/msu-gensan-logo-85758e.png" alt="" srcset="">
            </div>
        </div>
        <div class="row mx-5">
            <!-- paragraph -->
            <p>Beyond the classroom, MSU-Gensan was a vibrant melting pot of cultures, traditions, and ideas. Through a myriad of extracurricular activities, student organizations, and cultural events, students forged lifelong friendships and nurtured a spirit of camaraderie and collaboration. Whether participating in sports tournaments, volunteer initiatives, or artistic showcases, the MSU-Gensan community embraced diversity as a source of strength, celebrating their differences and finding common ground in their shared pursuit of excellence.</p>
            <p>As MSU-Gensan continued to evolve and grow, it remained steadfast in its commitment to serving as a catalyst for positive change in the region and beyond. Through pioneering research, community outreach programs, and partnerships with local stakeholders, the university empowered its graduates to become catalysts for social progress and agents of transformation in their respective fields. With each passing year, MSU-Gensan reaffirmed its status as a beacon of hope and opportunity, inspiring generations of learners to reach for the stars and make their mark on the world.</p>
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