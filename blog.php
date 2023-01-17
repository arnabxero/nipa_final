<?php
session_start();
error_reporting(0);
include 'include/config.php';
$uid = $_SESSION['uid'];

$con = mysqli_connect("localhost", "root", "", "sports");

if (isset($_POST['submit'])) {
    $pid = $_POST['pid'];


    $sql = "INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Package has been booked.');</script>";
    echo "<script>window.location.href='booking-history.php'</script>";
}

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
            <div class="post-list">
                <?php

                $sql = "SELECT * from tblblog";
                $res = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($res)) {
                    $contnt = $row['content'];
                    $ttle = $row['title'];

                    echo '<div class="post">';

                    echo '<a href="view_post.php?id=' . $row['id'] . '"><h2>' . substr($ttle, 0, 20) . '</h2>';
                    echo '<p>' . substr($contnt, 0, 100) . '</p></a>';
                    echo '</div>';
                }
                ?>

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

</body>

</html>