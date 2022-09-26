<?php
session_name("travel");
session_start();

if ( isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ){
    header("location: ../index.php");
}

$resp = "";

include("../processor/get_processor.php");
if (isset($_POST['signin'])) {
    $resp = $obj->userLogin();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Final Year Project -- Login in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/logo.jpg" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.623)), url(../images/main.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        .back-btn-wrap {
            position: absolute;
            top: 0;
            left: 10px;
            display: inline-block;
            text-align: center;
            padding-top: .5rem;
        }

        .back-btn-wrap i {
            padding: 0 5px;
            color: var(--lightblue-color);
        }

        .back-btn {
            text-decoration: none;
            color: var(--lightblue-color);
            border-radius: 5px;
            font-size: 1rem;
        }

        #login {
            background-color: #1A5C80;
            color: #fff;
            width: 100%;
            padding: 10px 3rem;
            margin-bottom: 2rem;
            margin-top: 1rem;

        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 rounded p-0 bg-light">
                <h2 class="p-3 text-center m-0">Login</h2>
                <hr class="m-0 mb-3">
                <div class="px-5">
                    <form action="signin.php" method="post" class="px-5">
                        <div class="mb-3">
                            <label for="" class="form-label ">Email</label>
                            <input type="email" name="email" autocomplete="off" class="form-control p-3" required placeholder="Enter your Email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label ">Password</label>
                            <input type="password" name="password" autocomplete="off" class="form-control p-3" placeholder="Enter your Password">
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-2">
                             <p class="m-0 text-danger"><?php echo $resp ?></p>
                            <p class="m-0 text-muted">Don't have an account <a style="text-decoration: none" href="signup.php">sign up</a></p>
                        </div>
                        <div class="mb-3 text-center">
                            <input type="submit" name="signin" class="btn" id="login" value="Log In">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="back-btn-wrap">
        <a class="back-btn" href="../index.php" style="color: #fff;"><i class="fa fa-arrow-left"></i>Back to HomePage</a>
    </div>
</body>

</html>
