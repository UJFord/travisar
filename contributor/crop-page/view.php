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
                        <div id="gen-info"></div>
                        <!-- images for stages -->
                        <div id="image"></div>
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