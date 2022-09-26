<div class="border sidebar">
    <?php
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) { ?>
        <!-- user logged in sidebar -->
        <a href="profile.php" style="text-decoration: none; color:#000">
            <div class="d-flex align-items-center p-3">
                <img src="images/<?php if ($_SESSION['image'] == null) echo "noimage.png";
                                    else echo $_SESSION['image'] ?>" width="70px" height="70px" style="object-fit:cover;" class="rounded-circle align-self-" alt="">
                <h3 class="ms-3 mt-2 "><?php echo $_SESSION['user_name']; ?></h3>
            </div>
        </a>
        <hr>
        <div class="p-2 sidebar-menu">
            <a style="<?php if($uri == '/local_tourism/index.php'){ echo 'color:#fff; background-color: rgba(0, 0, 0, 0.2)';}?>"  href="index.php">Home</a>
            <a style="<?php if($uri == '/local_tourism/profile.php'){ echo 'color:#fff; background-color: rgba(0, 0, 0, 0.2)';}?>" href="profile.php">Profile</a>
            <a style="<?php if($uri == '/local_tourism/gallery.php'){ echo 'color:#fff; background-color: rgba(0, 0, 0, 0.2)';}?>" href="gallery.php">Gallery</a>
            <a style="<?php if($uri == '/local_tourism/packages.php'){ echo 'color:#fff; background-color: rgba(0, 0, 0, 0.2)';}?>" href="packages.php">Packages</a>
            <a style="<?php if($uri == '/local_tourism/booking.php'){ echo 'color:#fff; background-color: rgba(0, 0, 0, 0.2)';}?>" href="booking.php">Booking</a>
            <a style="<?php if($uri == '/local_tourism/settings.php'){ echo 'color:#fff; background-color: rgba(0, 0, 0, 0.2)';}?>" href="settings.php">Settings</a>
        </div>
    <?php
    } else { ?>
        <!-- Guest sidebar -->
        <div class="p-2 pt-4">
            <h3>Local Tourism</h3>
            <hr>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint neque praesentium nemo distinctio illo consectetur consequuntur maxime quaerat dicta! Minima?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint neque praesentium nemo distinctio illo consectetur consequuntur maxime quaerat dicta! Minima?</p>
        </div>


    <?php } ?>
</div>