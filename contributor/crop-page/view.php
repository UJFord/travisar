<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banay-Banay</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            min-height: 10rem !important;
        }

        .img-plant {
            min-width: 8rem;
            max-width: 10rem;
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
                            <a class="nav-link ms-3 text-dark" href="#morph-veg">General Information</a>
                            <a class="nav-link ms-3 text-dark" href="#morph-rep">Images</a>
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
                        <a class="nav-link text-dark fw-semibold" href="#importance">References</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#pest-resist">Links </a>
                        </nav>
                    </nav>
                </nav>
            </div>

            <div class="col pt-5">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">

                    <!-- general -->
                    <div id="general">
                        <!-- general information -->
                        <div id="gen-info">
                            <h5>General Information</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- category -->
                                        <tr>
                                            <th scope="row" class="w-25">Category</th>
                                            <td>Rice</td>
                                        </tr>
                                        <!-- variety -->
                                        <tr>
                                            <th scope="row">Variety</th>
                                            <td>Upland</td>
                                        </tr>
                                        <!-- Local/Variety Name -->
                                        <tr>
                                            <th scope="row">Local/Variety Name</th>
                                            <td>Banay-Banay</td>
                                        </tr>
                                        <!-- Meaning of Name -->
                                        <tr>
                                            <th scope="row">Meaning of Name</th>
                                            <td>Family</td>
                                        </tr>
                                        <!-- Terrain -->
                                        <tr>
                                            <th scope="row">Terrain</th>
                                            <td>Nestled amidst the verdant farmlands of Banaybanay municipality in Davao Oriental, Philippines, thrives a regional treasure: Banaybanay rice. This medium-grain variety boasts a reputation for excellence, contributing significantly to the region's self-sufficiency in food production. While specifics remain elusive, online vendors paint a delightful picture, describing Banaybanay rice as bursting with flavor and possessing an enticing aroma that lingers after cooking. Intriguingly, the term "Banaybanay rice" might signify a unique variety cultivated for generations or simply a general term for rice grown in the region. Regardless, it serves as a testament to the unwavering dedication of Filipino farmers and the rich agricultural heritage of Banaybanay. Perhaps future discoveries will unveil the secret behind Banaybanay rice's distinction, but for now, it stands as a symbol of the region's agricultural bounty.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- images for stages -->
                        <div id="image">
                            <h5>Images</h5>
                            <div class="border border-bottom-0 rounded mt-3 overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- seed -->
                                        <tr>
                                            <th scope="row" class="w-25">Seed</th>
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
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1713215008252-1316344fb5e3?q=80&w=1990&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://plus.unsplash.com/premium_photo-1670963025175-85af13624678?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
                                                <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                    <img src="https://images.unsplash.com/photo-1712403235961-3d0a14d8e33b?q=80&w=2065&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="" class="img-thumbnail img-plant">
                                                </div>
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

                            <!-- location -->
                            <div id="loc-info"></div>
                        </div>

                        <!-- morphology -->
                        <div id="morph">
                            <!-- vegetative -->
                            <div id="morph-veg"></div>
                            <!-- reproductive -->
                            <div id="morph-rep"></div>
                        </div>

                        <!-- sensory -->
                        <div id="sensory">
                            <!-- sensory traits -->
                            <div id="sensory-traits"></div>
                        </div>

                        <!-- agronomy -->
                        <div id="agro">
                            <!-- pest -->
                            <div id="pest-resist"></div>
                            <!-- disease -->
                            <div id="disease-resist"></div>
                            <!-- stress -->
                            <div id="stress-resist"></div>
                        </div>

                        <!-- importance -->
                        <div id="importance">
                            <!-- util and cultural -->
                            <div id="util-n-culture"></div>
                        </div>

                        <!-- references -->
                        <div id="reference">
                            <div id="links"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- bootstrap script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>