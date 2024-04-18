<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banay-Banay</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        .nav-link.active {
            color: #f5f5f5 !important;
            background: #016A70 !important;
            /* Change 'green' to your desired success color */
        }

        .nav-link:hover {
            background: #709091;
            color: #f5f5f5 !important;
        }

        .small-font {
            font-size: 0.8rem;
        }

        /* smaller size scrollbar */
        .custom-scrollbar {
            scrollbar-width: thin;
        }

        /* limit image sizes */

        .image-container-size {
            min-height: 5rem !important;
        }

        .img-plant {
            min-width: 5rem;
            max-width: 8rem;
        }

        /* map styling */
        .map-style {
            height: 20rem;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <nav id="navbar" class="h-100 flex-column align-items-stretch pe-4 border-end">
                    <nav class="nav nav-pills flex-column sticky-top pt-5">
                        <!-- general -->
                        <a class="nav-link text-dark fw-semibold" href="#general">General</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#gen-info">General Information</a>
                            <a class="nav-link ms-3 text-dark" href="#image">Images</a>
                            <a class="nav-link ms-3 text-dark" href="#loc-info">Location</a>
                        </nav>
                        <!-- morphology -->
                        <a class="nav-link text-dark fw-semibold" href="#morph">Morphology</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#morph-veg">Vegetative State</a>
                            <a class="nav-link ms-3 text-dark" href="#morph-rep">Reproductive State</a>
                        </nav>
                        <!-- sensory -->
                        <a class="nav-link text-dark fw-semibold" href="#sensory">Sensory</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#sensory-traits">Traits</a>
                        </nav>
                        <!-- agronomy -->
                        <a class="nav-link text-dark fw-semibold" href="#agro">Agronomy</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#pest-resist">Pest Resistance</a>
                            <a class="nav-link ms-3 text-dark" href="#disease-resist">Disease Resistance</a>
                            <a class="nav-link ms-3 text-dark" href="#stress-resist">Resistance to Abiotic Stress</a>
                        </nav>
                        <!-- importance -->
                        <a class="nav-link text-dark fw-semibold" href="#importance">Importance</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#pest-resist">Utilization and Cultural Importance</a>
                        </nav>
                        <!-- reference -->
                        <a class="nav-link text-dark fw-semibold" href="#reference">References</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#links">Links </a>
                        </nav>
                    </nav>
                </nav>
            </div>

            <div class="col pt-5">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">

                    <!-- general -->
                    <div id="general" class="mb-5">
                        <!-- general information -->
                        <div id="gen-info">
                            <h5>General Information</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- category -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Category</th>
                                            <td>Rice</td>
                                        </tr>
                                        <!-- variety -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Variety</th>
                                            <td>Upland</td>
                                        </tr>
                                        <!-- Local/Variety Name -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Local/Variety Name</th>
                                            <td>Banay-Banay</td>
                                        </tr>
                                        <!-- Meaning of Name -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Meaning of Name</th>
                                            <td>Family</td>
                                        </tr>
                                        <!-- Terrain -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Terrain</th>
                                            <td>Nestled amidst the verdant farmlands of Banaybanay municipality in Davao Oriental, Philippines, thrives a regional treasure: Banaybanay rice. This medium-grain variety boasts a reputation for excellence, contributing significantly to the region's self-sufficiency in food production. While specifics remain elusive, online vendors paint a delightful picture, describing Banaybanay rice as bursting with flavor and possessing an enticing aroma that lingers after cooking. Intriguingly, the term "Banaybanay rice" might signify a unique variety cultivated for generations or simply a general term for rice grown in the region. Regardless, it serves as a testament to the unwavering dedication of Filipino farmers and the rich agricultural heritage of Banaybanay. Perhaps future discoveries will unveil the secret behind Banaybanay rice's distinction, but for now, it stands as a symbol of the region's agricultural bounty.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- images for stages -->
                        <div id="image">
                            <h5>Images</h5>
                            <div class="border border-bottom-0 rounded my-3 overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- seed -->
                                        <tr>
                                            <th scope="row" class="w-25  fw-normal">Seed</th>
                                            <td class="d-flex align-items-center flex-wrap ">
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1713215008252-1316344fb5e3?q=80&w=1990&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://plus.unsplash.com/premium_photo-1670963025175-85af13624678?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1712403235961-3d0a14d8e33b?q=80&w=2065&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- vegetative -->
                                        <tr>
                                            <th scope="row" class="w-25  fw-normal">Vegetative</th>
                                            <td class="d-flex align-items-center flex-wrap ">
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1713215008252-1316344fb5e3?q=80&w=1990&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://plus.unsplash.com/premium_photo-1670963025175-85af13624678?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1712403235961-3d0a14d8e33b?q=80&w=2065&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- reproductive -->
                                        <tr>
                                            <th scope="row" class="w-25  fw-normal">Reproductive</th>
                                            <td class="d-flex align-items-center flex-wrap ">
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1713215008252-1316344fb5e3?q=80&w=1990&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://plus.unsplash.com/premium_photo-1670963025175-85af13624678?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1712403235961-3d0a14d8e33b?q=80&w=2065&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- location -->
                        <div id="loc-info">
                            <h5>Location</h5>
                            <div class="border border-bottom-0 rounded my-3 overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- province -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Province</th>
                                            <td>Sarangani</td>
                                        </tr>
                                        <!-- municipality -->
                                        <tr>
                                            <th scope="row" class="fw-normal">Municipality</th>
                                            <td>Upland</td>
                                        </tr>
                                        <!-- Sitio -->
                                        <tr>
                                            <th scope="row" class="fw-normal">Sitio</th>
                                            <td>Banay-Banay</td>
                                        </tr>
                                        <!-- Coordinates -->
                                        <tr>
                                            <th scope="row" class="fw-normal">Coordinates</th>
                                            <td>213.12386712, 322.129863916</td>
                                        </tr>
                                        <!-- Map -->
                                        <tr>
                                            <th scope="row" class="fw-normal">Map</th>
                                            <td>
                                                <div id="map-view" class="map-style rounded"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- morphology -->
                    <div id="morph" class="mb-5">
                        <!-- vegetative -->
                        <div id="morph-veg">
                            <h5>Vegetative State</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- plant height -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Plant Height</th>
                                            <td>Typical</td>
                                        </tr>
                                        <!-- leaf width -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Leaf Length</th>
                                            <td>Average</td>
                                        </tr>
                                        <!-- leaf length -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Leaf Width</th>
                                            <td>Long</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- reproductive -->
                        <div id="morph-rep">
                            <h5>Reproductve State</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- yield capacity -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Yield Capacity</th>
                                            <td>Typical</td>
                                        </tr>
                                        <!-- lenght -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Length</th>
                                            <td>10 inch</td>
                                        </tr>
                                        <!-- width -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Width</th>
                                            <td>5 cm</td>
                                        </tr>
                                        <!-- shape -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Shape</th>
                                            <td>Elongated</td>
                                        </tr>
                                        <!-- color -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Color</th>
                                            <td>Fuichsa</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- sensory -->
                    <div id="sensory">
                        <!-- sensory traits -->
                        <div id="sensory-traits">
                            <h5>Sensory Traits</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- Aroma -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Aroma</th>
                                            <td>Smelly</td>
                                        </tr>
                                        <!-- Quality of Cooked Rice -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Quality of Cooked Rice</th>
                                            <td>Soft</td>
                                        </tr>
                                        <!-- Quality of Leftover Rice -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Quality of Leftover Rice</th>
                                            <td>Mushy</td>
                                        </tr>
                                        <!-- Volume Expansion -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Volume Expansion</th>
                                            <td>It rises</td>
                                        </tr>
                                        <!-- Glutinousity -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Glutinousity</th>
                                            <td>yes</td>
                                        </tr>
                                        <!-- Hardness -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Hardness</th>
                                            <td>Soft</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- agronomy -->
                    <div id="agro" class="my-5">
                        <!-- pest -->
                        <div id="pest-resist">
                            <h5>Pest Resistance</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- resistance -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">List</th>
                                            <td>Borers, Grasshoppers, Ants, Birds</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- disease -->
                        <div id="disease-resist">
                            <h5>Disease Resistance</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- resistance -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">List</th>
                                            <td>Bacterial, Viral</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- stress -->
                        <div id="stress-resist">
                            <h5>Resistance to Abiotic Stress</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- list -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">List</th>
                                            <td>Drought, Salinity</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- importance -->
                    <div id="importance" class="my-5">
                        <!-- util and cultural -->
                        <div id="util-n-culture">
                            <h5>Utilization and Cultural Importance</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- Significance -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Significance</th>
                                            <td>The Deep Roots of Banaybanay: A Celebration of Filipino Culture
                                                The Philippines holds rice in the highest regard, and Banaybanay rice, from the verdant fields of Davao Oriental, exemplifies this reverence. This medium-grain variety transcends its culinary significance, weaving itself into the cultural fabric of the Philippines.

                                                Rice is ever-present in Filipino celebrations. From birthdays to religious festivals, fragrant rice dishes grace the table. Banaybanay rice, with its potential unique flavor and aroma, elevates these occasions. Partaking in a meal featuring Banaybanay rice becomes a celebration of community, heritage, and the land's bounty.

                                                In conclusion, Banaybanay rice is more than a grain; it's a cultural cornerstone. It represents tradition, self-reliance, and the joy of sharing a meal with loved ones. Every plate heaped with Banaybanay rice is a testament to the enduring spirit of the Filipino people. </td>
                                        </tr>
                                        <!-- Use -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Use</th>
                                            <td>Banaybanay Rice: A Grain Steeped in Filipino Culture
                                                The Philippines cultivates a deep respect for rice, and Banaybanay rice, hailing from Davao Oriental's verdant fields, exemplifies this reverence. This medium-grain variety transcends its role as a food source, becoming intricately woven into the cultural tapestry of the Philippines.

                                                A Tradition Passed Through Generations

                                                Banaybanay rice embodies the unwavering dedication and skill of Filipino farmers. Cultivation techniques, potentially passed down through generations, might involve traditional methods. The very word "banaybanay" translates to "family, family," reflecting the deep-rooted communal spirit that defines Filipino culture. Families work together, ensuring a successful harvest, mirroring the way families come together to share meals – with rice as the centerpiece.
                                            </td>
                                        </tr>
                                        <!-- Indegenous Utilization -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Indegenous Utilization</th>
                                            <td>Banaybanay rice, from Davao Oriental, isn't just sustenance; it's a cultural touchstone in the Philippines. Grown potentially using traditional methods passed down through families ("banaybanay" means "family, family"), it reflects the communal spirit. This medium-grain rice contributes to regional food security, echoing the Bayanihan value of shared success. Every plate of Banaybanay rice becomes a celebration of heritage, community, and the land's bounty.</td>
                                        </tr>
                                        <!-- Remarkable Features -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Remarkable Features</th>
                                            <td>The Philippines treasures Banaybanay rice, a medium-grain variety from Davao Oriental. While specifics are limited, its potential uniqueness lies in its cultural significance. "Banaybanay" translates to "family, family," hinting at traditional, possibly multi-generational farming methods. This rice contributes to regional food security, a source of national pride. Perhaps its most remarkable feature is its role in Filipino celebrations. Every fragrant plate of Banaybanay rice becomes a symbol of community, heritage, and the land's bounty. </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- references -->
                    <div id="reference" class="my-5" style="margin-bottom: 500px !important;">
                        <div id="links">
                            <h5>References</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- Links -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Links</th>
                                            <td>
                                                <ul class="list-unstyled">
                                                    <li><a href="https://www.google.com/">https://www.google.com/</a></li>
                                                    <li><a href="https://www.youtube.com/">https://www.youtube.com/</a></li>
                                                    <li><a href="https://www.twitch.tv/">https://www.twitch.tv/</a></li>
                                                    <li><a href="https://leafletjs.com/">https://leafletjs.com/</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- script -->
    <script>
        // map initialization
        // initializnig map
        const map = L.map('map-view').setView([5.867019, 124.943390], 9); //starting position


        // Declare marker globally
        let marker = null;

        L.tileLayer(`https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`, { //style URL
            // tilesize
            tileSize: 512,
            // maxzoom
            maxZoom: 18,
            // i dont what this does but some says before different tile providers handle zoom differently
            zoomOffset: -1,
            // minzoom
            minZoom: 9,
            // copyright claim, because openstreetmaps require them
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            // i dont know what this does
            crossOrigin: true
        }).addTo(map);

        const myIcon = L.icon({
            iconUrl: '../img/location-pin-svgrepo-com.svg', // Replace with the path to your marker image
            iconSize: [32, 48], // Size of the icon
            iconAnchor: [16, 32], // Point of the icon that corresponds to its location on the map
            popupAnchor: [-0, -40] // Point from which the popup appears relative to the icon
        });

        // Create a marker
        marker = L.marker([5.867019, 124.943390], {
            icon: myIcon
        }).addTo(map);
    </script>
</body>

</html>