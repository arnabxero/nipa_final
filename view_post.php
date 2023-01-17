<?php
session_start();
error_reporting(0);
include 'include/config.php';
$uid = $_SESSION['uid'];
$id = $_GET['id'];
$con = mysqli_connect("localhost", "root", "", "sports");

$sql = "SELECT * FROM tblblog WHERE id = '$id'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$time = $row['time'];
$title = $row['title'];
$content = $row['content'];
$userid = $row['userid'];
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>NEUB Sports Club Management System</title>
    <meta charset="UTF-8">
    <meta name="description">
    <meta name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/nice-select.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/slicknav.min.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style.css" />

    <style>
        /* Add CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .post {
            margin-bottom: 2rem;
        }

        .post img {
            width: 100%;
            margin-bottom: 1rem;
        }

        .post h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .post .meta {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .post .content {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #333;
        }

        /* Add CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .post-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .post-list .post {
            width: 31%;
            margin-bottom: 1rem;
        }

        .post-list .post img {
            width: 100%;
        }

        .post-list .post h2 {
            font-size: 1.25rem;
            margin-top: 0.5rem;
        }

        .post-list .post p {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #555;
            margin-bottom: 0.5rem;
        }
    </style>
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
                    <h2>Blog</h2>
                    <?php
                    if (isset($_SESSION['uid'])) {
                        echo "<a href='write_blog.php' class='site-btn sb-line-gradient'>Write Blog</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>



    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="post">
                <h1><?php echo $title; ?></h1>
                <div class="meta">
                    Published on <?php echo $time; ?>
                </div>
                <div class="content">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section end -->

    <div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

    <!-- Search model end -->

    <!--====== Javascripts & Jquery ======-->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        CKEDITOR.replace('editor');
    </script>

</body>

</html>