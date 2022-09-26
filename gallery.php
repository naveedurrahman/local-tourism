<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");

include('processor/get_processor.php');
$userPost = $obj->getUserPost();
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<html style="scroll-behavior: smooth;">

<head>
    <title>LT | Gallery</title>
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
            <!-- content -->
            <div class="col-md-9">
                <div class="container mt-4">
                    <h1 class="pb-3" style="border-bottom: 1px solid rgba(0,0,0,0.1);">Gallery</h1>
                    <div class=" mt-5">
                        <div class="row">
                            <?php foreach ($userPost as $key => $value) { ?>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="ratio ratio-4x3">
                                            <?php if($value->p_image != null) { ?>
                                                <img class="card-img-top" src="images/<?php echo $value->p_image; ?>" alt="Card image cap" style="width:100%; background-size:contain; object-fit:cover; background-position:center">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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