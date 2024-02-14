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
            <?php require "crop-page/filter.php"; ?>

            <!-- LIST -->
            <div class="col border">
                <div class="continer">
                    <!-- heading -->
                    <div class="d-flex justify-content-between">
                        <!-- title -->
                        <h4 class="fw-semibold" style="font-size: 1.5rem;">All Crops</h4>
                        <!-- add button -->
                        <div class="z-1 dropdown">
                            <!-- dropdown -->
                            <button id="add-crop-btn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                New
                            </button>
                            <!-- list -->
                            <ul class="dropdown-menu dropdown-menu-end p-0">
                                <li class="p-0">
                                    <a class="dropdown-item p-2" href="#"><i class="fa-solid fa-file-circle-plus me-2"></i>Crop</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- table -->
                    <table class="table table-hover table-striped-columns">
                        <!-- table head -->
                        <thead>
                            <tr>
                                <th class="col-1 thead-item" scope="col">
                                    <input class="form-check-input" type="checkbox" style="font-size: 0.8;">
                                    <label class="form-check-label text-dark-emphasis">
                                        All
                                    </label>
                                </th>
                                <th class="col text-dark-emphasis" scope="col">Name</th>
                                <th class="col-4 text-dark-emphasis" scope="col">Contributor</th>
                                <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>

                            </tr>
                        </thead>
                        <!-- table body -->
                        <tbody class="table-group-divider">
                            <tr>
                                <th scope="row"><input class="form-check-input" type="checkbox"></th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td class="d-flex justify-content-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                            </tr>
                            <tr>
                                <th scope="row"><input class="form-check-input" type="checkbox"></th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td class="d-flex justify-content-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                            </tr>
                            <tr>
                                <th scope="row"><input class="form-check-input" type="checkbox"></th>
                                <td colspan="2">Larry the Bird</td>
                                <td class="d-flex justify-content-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
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