<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tavisar | Login</title>

    <!-- ROBOTO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="py-5">

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <!-- form -->
            <div class="col-6">
                <form action="" class="border rounded-4 bg-light py-5 px-5">

                    <!-- logo -->
                    <div class="row d-flex justify-content-center align-items-center">
                        <img class="col-6" src="../img/travis.svg" alt="" srcset="">
                    </div>

                    <!-- heading -->
                    <div class="row d-flex justify-content-center align-items-center py-4">
                        <h3 class="text-center">Register</h3>
                    </div>

                    <!-- message -->
                    <div class="alert alert-danger rounded-4" role="alert">
                        Email non existent!
                    </div>


                    <!-- firstname -->
                    <div class="row d-flex justify-content-between mb-3">
                        <div class="col-6 form-floating">
                            <input type="text" class="fs-6 form-control rounded-4" id="f-name" placeholder="name@example.com">
                            <label for="f-name" class="fs-6 ms-3">Firstname</label>
                        </div>
                        <div class="col-6 form-floating ">
                            <input type="text" class="fs-6 form-control rounded-4" id="lname" placeholder="name@example.com">
                            <label for="lname" class="fs-6 ms-3">Lastname</label>
                        </div>
                    </div>

                    <!-- gender -->
                    <div class="form-floating mb-3">
                        <input type="text" class="fs-6 form-control rounded-4" id="reg-gender" placeholder="Gender">
                        <label for="reg-gender" class="fs-6">Gender</label>
                    </div>

                    <!-- username -->
                    <div class="form-floating mb-3">
                        <input type="text" class="fs-6 form-control rounded-4" id="reg-uname" placeholder="Password">
                        <label for="reg-uname" class="fs-6">Username</label>
                    </div>

                    <!-- password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="fs-6 form-control rounded-4" id="reg-pass" placeholder="Password">
                        <label for="reg-pass" class="fs-6">Password</label>
                    </div>

                    <!-- Confirm -->
                    <div class="form-floating mb-3">
                        <input type="password" class="fs-6 form-control rounded-4" id="reg-confirm" placeholder="Password">
                        <label for="reg-confirm" class="fs-6">Confirm Password</label>
                    </div>

                    <!-- affiliation -->
                    <div class="form-floating mb-3">
                        <input type="text" class="fs-6 form-control rounded-4" id="reg-affiliation" placeholder="Password">
                        <label for="reg-affiliation" class="fs-6">Affiliation</label>
                    </div>

                    <!-- login btn -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <button class="btn btn-success rounded-4 fw-bold w-100 py-3" type="submit">Sign Up!</button>
                    </div>

                    <!-- sign up -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        Already a Contributor?<a href="" class="ms-1"> Login!</a>
                    </div>

                    <!-- visitor page -->
                    <div class="d-flex justify-content-center align-items-center">
                        Back to<a href="" class="ms-1"> Visitor's Page</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>