<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");
include("processor/get_processor.php");
$packages  = $package_obj->get_packages();
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>LT | Package</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <!-- Custom Theme files -->
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
       
    </style>
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
                <div class="container p-3 ">
                    <!-- foreach -->
                    <?php foreach ($packages as $key => $package) { ?>
                    <div class="row bg-light p-3 mb-4" style="box-shadow: inset 0px 0px 8px 1px rgba(67, 133, 175, 0.5);">
                        <div class="col-md-7  px-lg-5  package-wrapper">
                            <div class="package">
                                <h3>Package Name : </h3>
                                <span> <?php echo $package->PackageName ?></span>
                            </div>
                            <div class="package">
                                <h3>Location : </h3>
                                <span><?php echo $package->PackageLocation ?></span>
                            </div>
                            <div class="package">
                            <?php
                            $closingdate = $package->closing_date;
                            $closingdate -= (5 * 3600);
                            $time_left = $closingdate - time();
                            $days = floor($time_left / (60 * 60 * 24));
                            $time_left %= (60 * 60 * 24);
                            $hours = floor($time_left / (60 * 60));
                            $time_left %= (60 * 60);
                            $mintus = floor($time_left / 60);
                            ?>
                                <h3>Remaining Time : </h3>
                                <span><?Php echo $days . ' days and '. $hours .' hours '. $mintus.' mintus';?></span>
                            </div>
                            <div class="package">
                                <h3>Total : </h3>
                                <span><?php echo $package->PackagePrice ?></span>
                            </div>
                            <a href="package-details.php?id=<?php echo $package->PackageId; ?>" class="btn btn-success btn-sm">Details</a>
                        </div>
                        <div class="col-md-5 package-image text-end">
                            <img src="admin/pacakgeimages/<?php echo $package->PackageImage ?>" alt="" width="60%">
                        </div>
                    </div>
                    <?php } ?>
                    <!-- foreach end -->
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // for fixed column of row
            $(window).scroll(function() {
                var height = $(window).scrollTop();
                if (height > 10) {
                    $('#news_side').addClass('news-fixed')
                    $('#profile_side').addClass('prfile-fixed')
                    $('#column').removeClass('d-none')
                } else {
                    $('#news_side').removeClass('news-fixed')
                    $('#profile_side').removeClass('prfile-fixed')
                    $('#column').addClass('d-none')
                }
            });
        })
    </script>

</body>

</html>