<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>LT | Admin Dashboard</title>
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
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/morris.css" type="text/css" />
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<!-- //jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- //lined-icons -->
	<!-- custom css -->
	<link rel="stylesheet" href="css/custom.css" type='text/css' />
</head>

<body>
	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="mother-grid-inner">
				<?php include('includes/header.php'); ?>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i></li>
				</ol>
				<!--four-grids here-->
				<div class="four-grids" style="padding-inline: 4rem">
					<div class="col-md-4 four-grid">
						<div class="four-agileits">
							<div class="icon">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>User</h3>
								<?php $sql = "SELECT id from users";
								$query = $dbh->prepare($sql);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);
								$cnt = $query->rowCount();
								?>
								<h4> <?php echo htmlentities($cnt); ?> </h4>
							</div>
						</div>
					</div>
					<div class="col-md-4 four-grid">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Bookings</h3>
								<?php $sql1 = "SELECT id from booking";
								$query1 = $dbh->prepare($sql1);
								$query1->execute();
								$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
								$cnt1 = $query1->rowCount();
								?>
								<h4><?php echo htmlentities($cnt1); ?></h4>
							</div>
						</div>
					</div>

					<div class="col-md-4 four-grid">
						<div class="four-wthree">
							<div class="icon">
								<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Total packages</h3>
								<?php $sql3 = "SELECT PackageId from packages";
								$query3 = $dbh->prepare($sql3);
								$query3->execute();
								$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
								$cnt3 = $query3->rowCount();
								?>
								<h4><?php echo htmlentities($cnt3); ?></h4>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<!--//four-grids here-->
		</div>
	</div>
	<!--/sidebar-menu-->
	<?php include('includes/sidebarmenu.php'); ?>
	<div class="clearfix"></div>
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
	<script src="js/bootstrap.min.js"></script>
	<script src="js/raphael-min.js"></script>
	<script src="js/morris.js"></script>
</body>

</html>
<?php  ?>