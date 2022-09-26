 <?php
    session_name("travel");
    session_start();

    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
        header("location: ../index.php");
    }

    include("../processor/get_processor.php");
    $resp = "";
    if (isset($_POST['sign-up'])) {
        $resp = $obj->userRegister();
    }
    ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">

 <head>
     <meta charset="UTF-8">
     <title>Final Year Project -- Register</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
     <link rel="shortcut icon" href="./images/logo.jpg" type="image/x-icon">
     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <!--Javascript for check email availabilty-->
     <script>
         function checkAvailability() {
             $("#loaderIcon").show();
             jQuery.ajax({
                 url: "../check_availability.php",
                 data: 'emailid=' + $("#email").val(),
                 type: "POST",
                 success: function(data) {
                     $("#user-availability-status").html(data);
                     $("#loaderIcon").hide();
                 },
                 error: function() {}
             });
         }
     </script>
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

         #sign-up {
             background-color: #1A5C80;
             color: #fff;
             padding: 10px 3rem;
             width: 100%;
             margin-bottom: 1rem;
             margin-top: 1rem;

         }
     </style>
 </head>

 <body>
     <div class="container">
         <div class="row">
             <div class="col-md-3"></div>
             <div class="col-md-6 rounded p-0 bg-light">
                 <h3 class="p-3 text-center m-0">Registration</h3>
                 <hr class="m-0 mb-3">
                 <form action="signup.php" method="post" class="px-5" enctype="multipart/form-data">
                     <div class="mb-3">
                         <label for="" class="form-label mb-0">Name</label>
                         <input type="text" name="name" required class="form-control" id="" placeholder="Enter your Name">
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label mb-0">Phone Number</label>
                         <input type="text" name="number" required maxlength="11" class="form-control" id="" placeholder="Enter your Name">
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label mb-0">Email</label>
                         <input type="email" name="email" autocomplete="off" class="form-control" onblur="checkAvailability()" id="email" required placeholder="Enter your Email">
                         <span id="user-availability-status" style="font-size:12px;"></span>
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label mb-0">Password</label>
                         <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Enter your Password">
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label mb-0">Confirm Password</label>
                         <input type="password" name="c_password" autocomplete="off" class="form-control" placeholder="Enter your Password">
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label mb-0">Choose Image</label>
                         <input class="form-control" onchange="validateSize(this)" name="image" type="file" id="">

                         <div class="d-flex justify-content-between align-items-center my-2">
                             <p class="m-0 text-danger"><?php echo $resp ?></p>
                             <p class="m-0 text-muted">Already have an account <a style="text-decoration: none" href="signin.php">Login</a></p>
                         </div>
                     </div>
                     <div class="mb-3 text-center">
                         <input type="submit" name="sign-up" class="btn " id="sign-up" value="Sign Up">
                     </div>
                 </form>
             </div>
             <div class="col-md-3"></div>
         </div>
     </div>
     <!-- back button -->
     <div class="back-btn-wrap">
         <a class="back-btn" href="../index.php" style="color: #fff;"><i class="fa fa-arrow-left"></i>Back to HomePage</a>
     </div>

     <script>
         function validateSize(input) {
             const fileSize = input.files[0].size // in MiB
             if (fileSize > 7097152) {
                 alert('File size exceeds 7 MiB');
                 // $(file).val(''); //for clearing with Jquery
             } else {
                 // Proceed further
             }
         }
     </script>

 </body>

 </html>