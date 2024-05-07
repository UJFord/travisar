<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | TRAVIS</title>

    <!-- BOOTSTRAP -->
    <!-- cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

    <!-- CUSTOM -->
    <!-- global -->
    <link rel="stylesheet" href="../css/global-declarations.css">


</head>

<body class="">

    <div class="container-fluid p-0 min-vh-100 d-flex flex-column">

        <!-- NAVBAR -->
        <?php require "../nav/nav.php" ?>

        <div class="container d-flex" style="flex-grow: 1;">
            <div class="row w-100 ">

                <!-- side nav -->
                <div class="col-4 col-lg-2 border-end">
                    <nav id="profile-sidenav" class="mt-5 d-flex flex-column align-items-strech">
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link fw-bold" href="#profile">Profile</a>
                        </nav>
                    </nav>
                </div>

                <!-- main -->
                <div class="col">
                    <div class="m-5">
                        <form action="" data-bs-spy="scroll" data-bs-target="#profile-sidenav" data-bs-smooth-scroll="true" class="" tabindex="0">
                            <div id="profile" class="row d-flex mb-5">
                                <h6 class="text-secondary w-auto mt-4">Currently logged in as</h6>
                                <div class="w-auto">
                                    <h1 class="fw-bold">John Doe</h1>
                                    <h4 class="fw-bold fst-italic text-secondary">@Boy Bawang_Cornick</h4>
                                    <h6 class="fw-bold text-secondary">Bethesda Studios</h6>
                                </div>
                            </div>

                            <!-- name -->
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 col-xl-5 col-xxl-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fname" placeholder="" value="John">
                                        <label for="fname">Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 col-xl-5 col-xxl-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lname" placeholder="" value="Doe">
                                        <label for="lname">Lastname</label>
                                    </div>
                                </div>
                            </div>

                            <!-- gender -->
                            <div class="row">
                                <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                    <select class="form-select">
                                        <option selected hidden>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Neither">Rather not say</option>
                                    </select>
                                </div>
                            </div>

                            <!-- affilitation -->
                            <div class="row">
                                <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="aff" placeholder="" value="Bethesda Studios">
                                        <label for="aff">Affiliation</label>
                                    </div>
                                </div>
                            </div>

                            <!-- username -->
                            <div class="row">
                                <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="uname" placeholder="" value="Boy Bawang_Cornick">
                                        <label for="uname">Username</label>
                                    </div>
                                </div>
                            </div>

                            <!-- mail -->
                            <div class="row">
                                <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="mail" placeholder="" value="cornick@bawang.com" disabled>
                                        <label for="mail">Email</label>
                                    </div>
                                </div>
                            </div>

                            <!-- password -->
                            <div class="row">
                                <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="pass" placeholder="" value="Boy Bawang_Cornick" disabled>
                                        <label for="pass">Password</label>
                                    </div>
                                </div>
                            </div>

                            <!-- action -->
                            <div class="row d-none" id="action-container">
                                <div class="col-12 col-xl-10 col-xxl-8 mb-3 d-flex justify-content-end">
                                    <button id="discard-btn" type="button" class="btn btn-link link-dark me-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#confirm">Discard <i class="fa-solid fa-eraser"></i></button>
                                    <button id="apply-btn" type="button" class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#confirm">Apply Changes <i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>

                            <!-- confirmation modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirm" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-6 w-100 text-center fw-bold" id="confirm">Are you sure?</h1>
                                        </div>
                                        <div class="modal-body text-center">
                                            Confirm applying changes from your profile?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link link-dark" data-bs-dismiss="modal">Go Back</button>
                                            <button id="modal-discard-btn" type="submit" class="btn btn-secondary">Discard <i class="fa-solid fa-eraser"></i></button>
                                            <button id="modal-confirm-btn" type="submit" class="btn btn-success">Apply Changes <i class="fa-solid fa-check"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- JS -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <!-- nav -->
    <script src="../js/profile.js"></script>

</body>

</html>