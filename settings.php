<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");

include('processor/get_processor.php');
$resp = "";
if (isset($_POST['change-user-name'])) {
    $resp = $obj->updateProfileName();
}
if(isset($_POST['change-password'])){
    $resp = $obj->change_password();
}
$user = $obj->getUser();
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<html style="scroll-behavior: smooth;">

<head>
    <title>LT | Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <!-- Custom Theme files -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/068fbca468.js" crossorigin="anonymous"></script>
    <!--//end-animate-->
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/custom.css">
</head>

<body style="background-color:rgba(0, 0, 0, 0.05)">
    <?php include('includes/header.php'); ?>
    <main class="container-fluid">
        <div id="posts" class="row" style="margin-top: 5rem;">
            <div id="column" class="col-md-3 d-none"></div>
            <!--  side bar -->
            <div id="profile_side" class="col-md-3">
                <?php include('sidebar.php'); ?>
            </div>
            <!-- Content -->
            <div id="column" class="my-5 px-lg-5 col-md-9">
                <div class="row px-lg-5">
                    <!-- Change User Name -->
                    <div class="col-md-12 px-lg-5 mb-4">
                        <div class="border bg-light rounded">
                            <h3 class="m-3">Change Username</h3>
                            <hr>
                            <div class="p-3">
                                <form action="settings.php" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $user[0]->FullName ?> " id="" placeholder="Haseena...!">
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-outline-primary " name="change-user-name" value="Update">
                                    </div>
                                </form>
                                <form action="myprofile.php" method="POST" class="d-none" enctype="multipart/form-data">
                                    <input type="file" name="image" class="form-control" id="change_profile_image">
                                    <input type="submit" id="change_profile_form" class="btn btn-outline-primary" name="Update-profile-image">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- change password form -->
                    <div class="col-md-12 px-lg-5">
                        <div class="border bg-light rounded">
                            <h3 class="m-3">Change Password</h3>
                            <hr>
                            <div class="p-3">
                                <form action="settings.php" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Current Password</label>
                                        <input type="password" name="password" class="form-control" value="" id="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">New Password</label>
                                        <input type="password" name="new-password" class="form-control" value="" id="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password</label>
                                        <input type="password" name="confirm-password" class="form-control" value="" id="" placeholder="">
                                    </div>
                                    <p style="color:red"><?php echo $resp ?></p>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-outline-primary " name="change-password" value="Change">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            // for fixed column of row
            $(window).scroll(function() {
                var height = $(window).scrollTop();
                if (height > 10) {
                    $('#profile_side').addClass('prfile-fixed')
                    $('#column').removeClass('d-none')
                } else {
                    $('#profile_side').removeClass('prfile-fixed')
                    $('#column').addClass('d-none')
                }
            });
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>