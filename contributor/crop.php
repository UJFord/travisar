<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title -->
    <title>Travisar</title>

    <!-- STYLESHEETS -->

    <!-- leaflet -->

    <!-- bootstrap -->
    <!-- stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- custom -->
    <!-- global declarations -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="css/crop-list.css">
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
            <?php require "crop-page/list.php"; ?>

            <!-- MODAL -->
            <!-- add -->
            <?php require "crop-page/modals/add.php"; ?>
            <!-- edit -->
            <?php require "crop-page/modals/edit.php"; ?>



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