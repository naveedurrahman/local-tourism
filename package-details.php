<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");

$pid = intval($_GET['id']);
include("processor/get_processor.php");
$package  = $package_obj->get_package($pid);
$resp = "";
if (isset($_POST['submit'])) {
    $resp = $package_obj->booking_request();
}
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>LT | Package Details</title>
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
        .edit-image-icon {
            position: absolute;
            bottom: -30%;
            left: 16%;
            color: red;
            cursor: pointer;

        }

        .package-details h3 {
            font-size: 20px;
        }

        .package-details h3 span {
            opacity: 0.7;
        }
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
                <div class="container mb-5  px-3 ">
                    <div class="row bg-light pt-4 px-4" style="box-shadow: inset 0px 0px 8px 1px rgba(67, 133, 175, 0.5);">
                        <div class="col-md-7  px-lg-5  package-details">
                            <h2><?php echo $package[0]->PackageName ?></h2>
                            <hr>
                            <h3>Package Type : <span><?php echo $package[0]->PackageType ?></span></h3>
                            <h3>Package Location : <span><?php echo $package[0]->PackageLocation ?></span></h3>
                            <?php
                            $closingdate = $package[0]->closing_date;
                            $closingdate -= (5 * 3600);
                            $time_left = $closingdate - time();
                            $days = floor($time_left / (60 * 60 * 24));
                            $time_left %= (60 * 60 * 24);
                            $hours = floor($time_left / (60 * 60));
                            $time_left %= (60 * 60);
                            $mintus = floor($time_left / 60);
                            ?>
                            <h3>Remaining Time : <span><?Php echo $days . ' days and '. $hours .' hours '. $mintus.' mintus';?></span></h3>
                            <h3>Features : <span><?php echo $package[0]->PackageFetures ?></span></h3>
                            <h3>Total : <span><?php echo $package[0]->PackagePrice ?></span></h3>

                            <h3>Package Details</h3>
                            <P style="opacity: 0.7;"><?php echo $package[0]->PackageDetails ?></P>
                            <form action="package-details.php?id=<?php echo $pid ?>" method="POST" class="w-100 my-4">
                                <input type="hidden" name="package_id" value="<?php echo $package[0]->PackageId ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
                                <div class="form-group ">
                                    <label for="">Message</label>
                                    <textarea name="comment" id="" class="form-control" rows="3"></textarea>
                                </div>
                                <p style="color:red"><?php echo $resp ?></p>
                                <input type="submit" name="submit" class="btn btn-success btn-sm" value="Book Now">
                            </form>
                        </div>
                        <div class="col-md-5 package-image mb-4  text-end">
                            <img src="admin/pacakgeimages/<?php echo $package[0]->PackageImage ?>" alt="" width="80%">
                        </div>
                    </div>
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