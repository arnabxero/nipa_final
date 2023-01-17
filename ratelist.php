<?php session_start();
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "sports");

require_once('include/config.php');
if (strlen($_SESSION["uid"]) == 0) {
	header('location:login.php');
} else {
	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM sman_list ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>User | Sportsman</title>
	<meta charset="UTF-8">
	<meta name="description" content="Ahana Yoga HTML Template">
	<meta name="keywords" content="yoga, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/nice-select.css" />
	<link rel="stylesheet" href="css/slicknav.min.css" />

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css" />

</head>

<body>
	<!-- Page Preloder -->


	<!-- Header Section -->
	<?php include 'include/header.php'; ?>
	<!-- Header Section end -->

	<!-- Page top Section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto text-white">
					<h2>List Of Sportsman</h2>

				</div>
			</div>
		</div>
	</section>
	<!-- Page top Section end -->
	<section class="contact-page-section spad overflow-hidden">
		<div class="container-sm">
			<div class="row">
				<?php
	while ($row = mysqli_fetch_assoc($result)) {
                    ?>
				<!-- Contact Section -->
				<div class="col-sm-3">
					<div class="card" style="width: 12rem;">
					<a href="/nipa_final_project/rating_system/index.php?id=<?php echo $row['id']; ?>"><img class="card-img-top" src="rating_system/img/<?php echo $row['img']; ?>" alt="review.php"></a>
						
						<div class="card-body">
							<h5 style="align-items:center;">
								<?php echo $row['name']; ?>
							</h5>
							<p class="card-text">
								<?php echo $row['info']; ?>
							</p>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<!-- Trainers Section end -->



	<!-- Footer Section -->
	<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->

	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<style>
	.errorWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #dd3d36;
		color: #fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
	}

	.succWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #5cb85c;
		color: #fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
	}
</style>
<?php } ?>