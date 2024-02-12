<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title -->
    <title>Travisar</title>

    <!-- STYLESHEETS -->
    <!-- bootstrap -->
    <!-- stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- custom -->
    <!-- global declarations -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="../css/staff/crop-list.css">
</head>

<body>

    <!-- NAV -->
    <?php require "nav.php"; ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">


            <!-- FILTERS -->
            <div class="col col-3">
                <div class="d-flex flex-column align-items-start rounded border overflow-hidden">

                    <!-- title -->
                    <div class="border-bottom d-flex align-items-center w-100 py-1 px-3 bg-light">
                        <h6 class="fw-semibold fs-6 m-0 me-auto">FILTERS</h6>
                        <!-- help -->
                        <a href="#" class="">
                            <i class="bi bi-question-circle"></i>
                        </a>
                    </div>

                    <!-- filter actions -->
                    <div class="d-flex py-3 px-3">
                        <!-- search -->
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search Crops" aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <!-- all crops -->
                    <div class="mt-1 mx-3 w-100">
                        <a class="text-decoration-none w-100" data-bs-toggle="collapse" href="#crop-filters" role="button" aria-expanded="true" aria-controls="crop-filter">
                            <div class="row d-flex align-items-center">
                                <i id="chevron-dropdown-btn" class="fas fa-chevron-down text-dark col-1"></i> <span class="fw-bold text-success col">All Crops</span>
                            </div>
                        </a>

                        <!-- crops filters -->
                        <div id="crop-filters" class="collapse show w-100 mb-2">
                            <!-- rice -->
                            <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                                <i class="fa-solid fa-bowl-rice col-1"></i><span class="fw-normal col ms-2">Rice</span>
                            </a>
                            <!-- root -->
                            <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                                <i class="fa-solid fa-carrot col-1"></i><span class="fw-normal col ms-2">Root</span>
                            </a>
                            <!-- other -->
                            <a class="row d-flex align-items-center text-decoration-none text-dark" href="#">
                                <i class="fa-brands fa-pagelines col-1"></i><span class="fw-normal col ms-2">Other</span>
                            </a>
                        </div>
                    </div>


                </div>
            </div>


            <!-- list -->
            <div class="col border"></div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="../js/staff/crop-list.js"></script>
</body>

</html>