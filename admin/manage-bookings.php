<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['booking_id'])) {
		$id = intval($_GET['booking_id']);
		$status = 1;
		$query = "UPDATE booking SET status=?  WHERE id=?";
		$stmt = $dbh->prepare($query);
		$stmt->execute(array($status, $id));
		$msg = "Booking Confirm successfully";
	}
?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>LT | Manage Bookings</title>
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
		<!-- custom css -->
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
					<li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Bookings</li>
				</ol>
				<div class="agile-grids">
					<!-- tables -->
					<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
					<div class="agile-tables">
						<div class="w3l-table-info">
							<h2>Manage Bookings</h2>
							<table id="table">
								<thead>
									<tr>
										<th>Booking id</th>
										<th>Name</th>
										<th>Mobile No.</th>
										<th>Email</th>
										<th>Comment </th>
										<th>Status </th>
										<th>Action </th>
									</tr>
								</thead>
								<tbody>
									<?php
									try {
										$sql = "SELECT u.FullName, u.MobileNumber, u.EmailId, b.status, b.comment, b.id, p.PackageName
											 from users u join booking b on b.user_id = u.id
									  		join packages p on p.PackageId=b.package_id";

										$query = $dbh->prepare($sql);
										$query->execute();
										$results = $query->fetchAll(PDO::FETCH_OBJ);
									} catch (\Throwable $th) {
										echo $th->getMessage();
									}
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td>#BK-<?php echo htmlentities($result->id); ?></td>
												<td><?php echo htmlentities($result->FullName); ?></td>
												<td><?php echo htmlentities($result->MobileNumber); ?></td>
												<td><?php echo htmlentities($result->EmailId); ?></td>
												<td><?php echo htmlentities($result->comment); ?></td>
												<td><?php if ($result->status == 1)
														echo "Confirmed";
													else if ($result->status == 2)
														echo "Cancelled";
													else
														echo "pending";
													?>
												</td>
												<td>
													<?php if ($result->status == 1)
														echo "Already Confirmed";
													else if ($result->status == 2)
														echo "Already Cancelled";
													else { ?>
														<a href="<?php if ($result->status != null) echo '#';
																	else echo 'manage-bookings.php?booking_id=' . $result->id  ?>">Confirm</a>
													<?php } ?>
												</td>
											</tr>
									<?php
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
			<!--/sidebar-menu-->
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
		<script src="js/bootstrap.min.js"></script>
	</body>
	</html>
<?php } ?>