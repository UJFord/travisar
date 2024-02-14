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
                        <h4 class="fw-bold">All Crops</h4>
                        <!-- add button -->
                        <div class="dropdown">
                            <!-- dropdown -->
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <!-- list -->
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Crop</a></li>
                            </ul>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">
                                        All
                                    </label>
                                </th>
                                <th scope=" col">Name</th>
                                <th scope="col">Contributor</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
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