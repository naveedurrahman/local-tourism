<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");
include("processor/get_processor.php");
if (isset($_REQUEST['booking_id'])) {
    $id = intval($_GET['booking_id']);
    $package_obj->cancel_booking($id);
}
$mybooking  = $package_obj->get_single_user_booking($_SESSION['id']);
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>LT | Booking</title>
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
                <div class="container mt-5">
                    <div class="row w-lg-75 w-100 mx-auto bg-light p-lg-3 p-1" style="box-shadow: inset 0px 0px 8px 1px rgba(67, 133, 175, 0.5); overflow-y:scroll">
                        <table class="table table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Package Name</th>
                                    <th scope="col">Package Type</th>
                                    <th scope="col">Package Location</th>
                                    <th scope="col">Package Price</th>
                                    <th scope="col">Booking Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mybooking as $key => $booking) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $key + 1 ?></th>
                                        <td><?php echo $booking->PackageName ?></td>
                                        <td><?php echo $booking->PackageType ?></td>
                                        <td><?php echo $booking->PackageLocation ?></td>
                                        <td><?php echo $booking->PackagePrice ?>/-</td>
                                        <td>
                                            <?php if ($booking->status == 1) 
                                                    echo "Accepted";
                                                else if($booking->status == 2)
                                                    echo 'Cancelled';  
                                                else
                                                    echo "Requested"; 
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($booking->status == 2) 
                                                    echo "Already Cancelled";
                                                else { ?>
                                                   <a href="booking.php?booking_id=<?php echo $booking->id?>" style="text-decoration:none">Cancel Booking</a>
                                                <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>