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
        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container form {
            display: flex;
            flex: 1;
        }

        .search-container input[type=text] {
            padding: 6px;
            margin-right: 10px;
            font-size: 17px;
            border: none;
        }

        .search-container button[type=submit] {
            padding: 6px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }

        .search-container .filter-dropdown {
            margin-left: 10px;
            font-size: 17px;
            border: none;
            background-color: #f1f1f1;
        }
    </style>
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


    <form action="search.php" method="GET">

        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="input-group mb-3">
                        <input name="search_q" list="suggestions" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon2">
                        <datalist id="suggestions">
                            <?php

                            $sql = "SELECT * from tbladdpackage";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                                    echo '<option value="' . $result->titlename . '">';
                                }
                            }



                            ?>

                            <?php

                            $sql = "SELECT * from tblblog";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                                    echo '<option value="' . $result->title . '">';
                                }
                            }



                            ?>
                        </datalist>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                        </div>
                        <div class="input-group-append">
                            <select class="custom-select" id="inputGroupSelect02" name="type">
                                <option value="All">All</option>
                                <option value="Package">Package</option>
                                <option value="Blog">Blog</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <img src="img/icons/logo-icon.png" alt="">
                <h2>Search Results</h2>
            </div>
            <div class="row">
                <?php

                $type = "All";
                if (isset($_GET['type'])) {
                    $type = $_GET['type'];
                }

                if ($type == "All") {
                    $sql = "SELECT * from tbladdpackage WHERE titlename LIKE '%$search_box_value%'";
                    $sql1 = "SELECT * from tblblog WHERE title LIKE '%$search_box_value%'";
                } else if ($type == "Package") {
                    $sql1 = "";
                    $sql = "SELECT * from tbladdpackage WHERE titlename LIKE '%$search_box_value%'";
                } else if ($type == "Blog") {
                    $sql = "";
                    $sql1 = "SELECT * from tblblog WHERE title LIKE '%$search_box_value%'";
                }

                //$sql = "SELECT * from tbladdpackage WHERE titlename LIKE '%$search_box_value%'";

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


    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <img src="img/icons/logo-icon.png" alt="">
                <h2>Search Results</h2>
            </div>
            <div class="row">

                <div class="post-list">
                    <?php

                    $type2 = $_GET['type'];

                    if ($type2 != "Package") {
                        $res22 = mysqli_query($con, $sql1);

                        while ($row22 = mysqli_fetch_assoc($res22)) {
                            $contnt = $row22['content'];
                            $ttle = $row22['title'];

                            echo '<div class="post">';

                            echo '<a href="view_post.php?id=' . $row22['id'] . '"><h2>' . substr($ttle, 0, 20) . '</h2>';
                            echo '<p>' . substr($contnt, 0, 100) . '</p></a>';
                            echo '</div>';
                        }
                    }

                    ?>

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

</body>

</html>