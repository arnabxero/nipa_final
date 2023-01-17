<?php
session_start();
error_reporting(0);
include 'include/config.php';
$uid = $_SESSION['uid'];

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

</head>

<body>
    <!-- Page Preloder -->


    <!-- Header Section -->
    <!-- Header Section end -->
    <!-- Page top Section -->

    <?php
    $search_box_value = "";

    if (isset($_GET['search_q'])) {
        $search_box_value = $_GET['search_q'];
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto text-white">
                <form action="search.php" method="GET">
                    <input style="margin: 10px; padding: 5px; width: 500px;" type="text" name="search_q" placeholder="Type Search Query Here....." value="<?php echo $search_box_value; ?>">
                    <button style="margin: 10px; padding: 5px;" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <img src="img/icons/logo-icon.png" alt="">
                <h2>Search Results</h2>
            </div>
            <div class="row">
                <?php

                $sql = "SELECT * from tbladdpackage WHERE titlename LIKE '%$search_box_value%'";

                //$sql = "SELECT id, category, titlename, PackageType, PackageDuratiobn, Price, uploadphoto, Description, create_date from tbladdpackage";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="pricing-item begginer">
                                <div class="pi-top">
                                    <h4><?php echo $result->titlename; ?></h4>
                                </div>
                                <div class="pi-price">
                                    <h3><?php echo htmlentities($result->Price); ?></h3>
                                    <p> <?php echo $result->PackageDuratiobn; ?></p>
                                </div>
                                <ul>
                                    <?php echo $result->Description; ?>

                                </ul>
                                <?php if (strlen($_SESSION['uid']) == 0) : ?>
                                    <a href="login.php" class="site-btn sb-line-gradient">Booking Now</a>
                                <?php else : ?>
                                    <!-- <a href="#" class="site-btn sb-line-gradient">Booking Now</a> -->
                                    <form method='post'>
                                        <input type='hidden' name='pid' value='<?php echo htmlentities($result->id); ?>'>


                                        <input class='site-btn sb-line-gradient' type='submit' name='submit' value='Booking Now' onclick="return confirm('Do you really want to book this package.');">
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php $cnt = $cnt + 1;
                    }
                } ?>
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