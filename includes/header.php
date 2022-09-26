<?php

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) { ?>

    <nav class="bg-light navbar navbar-expand-lg  w-100 position-fixed px-lg-5 px-3 py-3" style="box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.5); z-index:222;
            background: rgb(67, 133, 175);
			background: linear-gradient(150deg, rgba(67, 133, 175, 0) 21%, rgba(67, 133, 175, 0.3) 100%);">
        <div class="container-fluid">
            <div class="w-50">
                <a href="index.php" class="brand">Local Tou<span>rism</span></a>
            </div>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100 p-0 mt-2" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="navbar-menu ">
                        <a class="nav-lin  for-mobile text-dark bt tn-outline-secondary px-3" href="index.php">Home</a>
                        <a class="nav-lin for-mobile  text-dark bt tn-outline-secondary px-3" href="profile.php">Profile</a>
                        <a class="nav-lin  for-mobile text-dark bt tn-outline-secondary px-3" href="gallery.php">Gallery</a>
                        <a class="nav-lin  for-mobile text-dark bt tn-outline-secondary px-3" href="packages.php">Packages</a>
                        <a class="nav-lin  for-mobile text-dark bt tn-outline-secondary px-3" href="booking.php">Booking</a>
                        <a class="nav-lin  for-mobile text-dark bt tn-outline-secondary px-3" href="settings.php">Settings</a>
                        <a class="nav-lin  text-dark logout-btn px-3 py-2" href="logout.php" tabindex="-1" aria-disabled="true">Logout <span class="fa-solid fa-arrow-right-from-bracket"></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php

} else { ?>

    <nav class="bg-light navbar navbar-expand-lg  w-100 position-fixed px-lg-5 px-3 py-3" style="box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.5); z-index:222;
            background: rgb(67, 133, 175);
			background: linear-gradient(150deg, rgba(67, 133, 175, 0) 21%, rgba(67, 133, 175, 0.3) 100%);">
        <div class="w-100">
        <div class="d-flex justify-content-between">
            <div class="">
                <a href="index.php" class="brand">Local Tou<span>rism</span></a>
            </div>
            <div class="dropdown show">
                <a class="btn dropdown-toggle" style="font-size: 18px" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="admin/index.php">Admin Login</a>
                    <a class="dropdown-item" href="includes/signup.php">Sign Up</a>
                    <a class="dropdown-item" href="includes/signin.php">Sign In</a>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <!-- 
    <header class="bg-light w-100 position-fixed px-lg-5 py-2 mb-5" style="box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.5); z-index:222">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo wow fadeInDown animated" data-wow-delay=".5s">
                <a href="index.php">Tours & Tra<span>vels News</span></a>
            </div>
            <div class="dropdown show">
                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="admin/index.php">Admin Login</a>
                    <a class="dropdown-item" href="includes/signup.php">Sign Up</a>
                    <a class="dropdown-item" href="includes/signin.php">Sign In</a>
                </div>
            </div>
        </div>
    </header> -->
<?php } ?>