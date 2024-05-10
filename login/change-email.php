<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>

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
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <!-- script for the window alert -->
    <script src="../js/window.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body class="">

    <div class="container-fluid p-0 min-vh-100 d-flex flex-column">

        <!-- NAVBAR -->
        <?php require "../nav/nav.php" ?>
        <?php
        include "../functions/message.php";
        ?>

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
                        <form action="process_form.php" method="POST" data-bs-spy="scroll" data-bs-target="#profile-sidenav" data-bs-smooth-scroll="true" class="" tabindex="0">
                            <?php
                            if (isset($_SESSION['USER']['user_id'])) {
                                $user_id = $_SESSION['USER']['user_id'];
                                $query = "SELECT * FROM users WHERE user_id = $user_id";
                                $query_run = pg_query($conn, $query);
                                if (pg_num_rows($query_run) > 0) {
                                    $row = pg_fetch_assoc($query_run);
                            ?>
                                    <div id="profile" class="row d-flex mb-5">
                                        <h6 class="text-secondary w-auto mt-4">Changing email of</h6>
                                        <div class="w-auto">
                                            <h1 class="fw-bold"><?= $row['first_name'] . ' ' .  $row['last_name'] ?> </h1>
                                        </div>
                                    </div>
                                    <!-- hidden user id for verification -->
                                    <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                    <input type="hidden" name="first_name" value="<?= $row['first_name'] ?>">
                                    <input type="hidden" name="last_name" value="<?= $row['last_name'] ?>">
                                    <input type="hidden" name="gender" value="<?= $row['gender'] ?>">
                                    <input type="hidden" name="affiliation" value="<?= $row['affiliation'] ?>">
                                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                                    <input type="hidden" name="username" value="<?= $row['username'] ?>">

                                    <!-- mail -->
                                    <div class="row">
                                        <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="mail" placeholder="" name="old_email" value="<?= $row['email'] ?>" disabled>
                                                <label for="mail">Old Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- new mail -->
                                    <div class="row">
                                        <div class="col-12 col-xl-10 col-xxl-8 mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="mail" placeholder="" name="new_email">
                                                <label for="mail">New Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="profile.php">Go back</a>

                                    <!-- action -->
                                    <div class="row d-none" id="action-container">
                                        <div class="col-12 col-xl-10 col-xxl-8 mb-3 d-flex justify-content-end">
                                            <button id="discard-btn" type="button" class="btn btn-link link-dark me-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#confirm">Discard <i class="fa-solid fa-eraser"></i></button>
                                            <button id="apply-btn" type="button" class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#confirm">Apply Changes <i class="fa-solid fa-check"></i></button>
                                        </div>
                                    </div>
                            <?php
                                }
                            }

                            ?>
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
                                            <button id="modal-discard-btn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard <i class="fa-solid fa-eraser"></i></button>
                                            <button id="modal-confirm-btn" type="submit" name="edit_mail" class="btn btn-success">Apply Changes <i class="fa-solid fa-check"></i></button>
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
    <script>
        // Add event listener to the "Discard" button inside the modal
        document.getElementById("modal-discard-btn").addEventListener("click", function() {
            // Reload the page
            window.location.href = "profile.php";
        });
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <!-- nav -->
    <script src="../js/profile.js"></script>
    <!-- CUSTOM -->
    <script src="../visitor/js/nav.js"></script>
</body>

</html>