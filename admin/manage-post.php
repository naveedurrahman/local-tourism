<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_REQUEST['post_id_ignore'])) {
        $post_id = intval($_GET['post_id_ignore']);
        $status = 1;
        $query = "DELETE FROM reports WHERE post_id=?";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($post_id));
        $msg = "Post report ignore";
    }
    if (isset($_REQUEST['post_id_delete'])) {
        $post_id = intval($_GET['post_id_delete']);
        $status = 1;
        $query = "DELETE FROM posts WHERE id=?";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($post_id));
        $msg = "Post deleted";
    }
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>LT | Manage Post</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="application/x-javascript">
            addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);
            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="css/morris.css" type="text/css" />
        <link href="css/font-awesome.css" rel="stylesheet">
        <script src="js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/table-style.css" />
        <link rel="stylesheet" type="text/css" href="css/basictable.css" />
        <script type="text/javascript" src="js/jquery.basictable.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#table').basictable();
                $('#table-breakpoint').basictable({
                    breakpoint: 768
                });
                $('#table-swap-axis').basictable({
                    swapAxis: true
                });
                $('#table-force-off').basictable({
                    forceResponsive: false
                });
                $('#table-no-resize').basictable({
                    noResize: true
                });
                $('#table-two-axis').basictable();
                $('#table-max-height').basictable({
                    tableWrapper: true
                });
            });
        </script>
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
        <link rel="stylesheet" href="css/custom.css" type='text/css' />
        <style>
            #table thead tr th {
                background-color: #4485AF !important;
            }
        </style>
    </head>

    <body>
        <div class="page-container">
            <!--/content-inner-->
            <div class="left-content">
                <div class="mother-grid-inner">
                    <?php include('includes/header.php'); ?>
                    <div class="clearfix"> </div>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Reported Post</li>
                </ol>
                <div class="agile-grids">
                    <!-- tables -->
                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                    <div class="agile-tables">
                        <div class="w3l-table-info">
                            <h2>Manage Reported Posts</h2>
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>S_NO</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        <th>Image </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $sql = "SELECT p.* From posts p join reports r where p.id = r.post_id";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    } catch (\Throwable $th) {
                                        echo $th->getMessage();
                                    }
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->description); ?></td>
                                                <td>
                                                    <a href="manage-post.php?post_id_ignore=<?php echo $result->id; ?>">Ignore </a>/
                                                    <a href="manage-post.php?post_id_delete=<?php echo $result->id; ?>">Delete</a>
                                                </td>
                                                <td style="width: 200px;"><img src="../images/<?php echo $result->p_image;  ?>" alt="no get" width="100%"></td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- script-for sticky-nav -->
                    <script>
                        $(document).ready(function() {
                            var navoffeset = $(".header-main").offset().top;
                            $(window).scroll(function() {
                                var scrollpos = $(window).scrollTop();
                                if (scrollpos >= navoffeset) {
                                    $(".header-main").addClass("fixed");
                                } else {
                                    $(".header-main").removeClass("fixed");
                                }
                            });
                        });
                    </script>
                </div>
            </div>
            <?php include('includes/sidebarmenu.php'); ?>
            <div class="clearfix"></div>
        </div>
        <script>
            var toggle = true;
            $(".sidebar-icon").click(function() {
                if (toggle) {
                    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                    $("#menu span").css({
                        "position": "absolute"
                    });
                } else {
                    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                    setTimeout(function() {
                        $("#menu span").css({
                            "position": "relative"
                        });
                    }, 400);
                }
                toggle = !toggle;
            });
        </script>
        <!--js -->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- /Bootstrap Core JavaScript -->
    </body>

    </html>
<?php } ?>