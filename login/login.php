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

<body class="">

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <!-- form -->
            <div class="col-4">
                <form action="" class="border rounded-4 bg-light py-5 px-5">

                    <!-- logo -->
                    <div class="row d-flex justify-content-center align-items-center">
                        <img class="col-6" src="../img/travis.svg" alt="" srcset="">
                    </div>

                    <!-- heading -->
                    <div class="row d-flex justify-content-center align-items-center py-4">
                        <h3 class="text-center">Login</h3>
                    </div>

                    <!-- message -->
                    <div class="alert alert-danger rounded-4" role="alert">
                        Email non existent!
                    </div>


                    <!-- email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="fs-6 form-control rounded-4" id="login-email" placeholder="name@example.com">
                        <label for="login-email" class="fs-6">Email</label>
                    </div>

                    <!-- password -->
                    <div class="form-floating">
                        <input type="password" class="fs-6 form-control rounded-4" id="login-password" placeholder="Password">
                        <label for="login-password" class="fs-6">Password</label>
                    </div>

                    <!-- login btn -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <button class="btn btn-success rounded-4 fw-bold w-100 py-3" type="submit">Login</button>
                    </div>

                    <!-- sign up -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        Be a Contributor.<a href="" class="ms-1"> Sign Up!</a>
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