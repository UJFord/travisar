<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Homepage</title>
    <!-- CSS -->
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <!-- global -->
    <link rel="stylesheet" href="../css/global-declarations.css?v=1.0">
    <!-- landing.css -->
    <link rel="stylesheet" href="css/landing.css?v=1.0">
</head>

<body class="bg-light">
    <!-- NAVBAR -->
    <?php require "nav/nav.php" ?>

    <!-- FILTER -->
    <div class="container-fluid border-bottom d-flex justify-content-center p-3">
        <!-- search -->
        <div class="input-group w-25 me-4">
            <input type="text" class="form-control bg-light">
            <button id="search-btn" class="input-group-text btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <!-- filter -->
        <!-- filter trigger -->
        <button id="filter-trigger" type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#filter-modal">
            <i class="fa-solid fa-sliders small-font me-2"></i>Filter
        </button>

        <!-- filter modal -->
        <div id="filter-modal" class="modal fade" tabindex="-1" aria-labelledby="filter-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center position-relative">
                        <h1 class="modal-title small-font" id="exampleModalLabel">FILTERS</h1>
                        <button id="close-filter-btn" type="button" class="btn-close position-absolute small-font" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>