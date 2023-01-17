<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sports";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$avgRatings = 0;
$avgUserRatings = 0;
$totalReviews = 0;
$totalRatings5 = 0;
$totalRatings4 = 0;
$totalRatings3 = 0;
$totalRatings2 = 0;
$totalRatings1 = 0;
$ratingsList = array();
$totalRatings_avg = 0;

$s_id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM review_table ORDER BY review_id DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $ratingsList[] = array(
        'review_id' => $row['review_id'],
        'name' => $row['name'],
        'rating' => $row['rating'],
        'message' => $row['message']

    );
    if($row['id'] == $s_id)
    {
        if ($row['rating'] == '5') {
        $totalRatings5++;
    }
    if ($row['rating'] == '4') {
        $totalRatings4++;
    }
    if ($row['rating'] == '3') {
        $totalRatings3++;
    }
    if ($row['rating'] == '2') {
        $totalRatings2++;
    }
    if ($row['rating'] == '1') {
        $totalRatings1++;
    }
    $totalReviews++;
    $totalRatings_avg = $totalRatings_avg + intval($row['rating']);
    }
    
}
$avgUserRatings = $totalRatings_avg / $totalReviews;
$avgUserRatings = round($avgUserRatings, 1);


$light = "text-warning";



$sql1 = mysqli_query($conn, "SELECT * FROM sman_list WHERE id = {$s_id}");
$row1 = mysqli_fetch_assoc($sql1);
$img = $row1['img'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>rating system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="jumbotron text-center">
        <!-- <h1>User Review Rating tutorial with source code</h1>
       <div class='holder'>UIMonk Work</div> -->
        <img src="/nipa_final_project/rating_system/img/<?php echo $img;?>" alt="" height='200' width='200'>
    </div>

    <div class="container">
        <div class="row">
            
            <div class="col-sm-8 progressSection mx-auto" style="pading-left:50px;">
                <div class='holder'>
                    <div>
                        <div class="progress-label-left">
                            <b>Skills</b> <i class="fa fa-star mr-1 text-warning"></i>
                        </div>
                        <div class="progress-label-right">
                            <span id="total_five_star_review"> <?php echo $totalRatings5; ?></span> Reviews
                        </div>

                    </div>

                    <div class="progress">
                        <div class="progress-bar bg-warning" id='five_star_progress' style="width: <?php echo $totalRatings5; ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">

                        </div>
                    </div>
                </div>
                <div class='holder'>
                    <div>
                        <div class="progress-label-left">
                            <b>Agility</b> <i class="fa fa-star mr-1 text-warning"></i>
                        </div>
                        <div class="progress-label-right">
                            <span id="total_four_star_review"> <?php echo $totalRatings4; ?> </span> Reviews
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" id='four_star_progress' style="width: <?php echo $totalRatings4; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">

                        </div>
                    </div>
                </div>
                <div class='holder'>
                    <div>
                        <div class="progress-label-left">
                            <b>Strength</b> <i class="fa fa-star mr-1 text-warning"></i>
                        </div>
                        <div class="progress-label-right">
                            <span id="total_three_star_review"> <?php echo $totalRatings3; ?> </span> Reviews
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" id='three_star_progress' style="width: <?php echo $totalRatings3; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                        </div>
                    </div>
                </div>
                <div class='holder'>
                    <div>
                        <div class="progress-label-left">
                            <b>Leadership</b> <i class="fa fa-star mr-1 text-warning"></i>
                        </div>
                        <div class="progress-label-right">
                            <span id="total_two_star_review"> <?php echo $totalRatings2; ?> </span> Reviews
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" id='two_star_progress' style="width: <?php echo $totalRatings2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">

                        </div>
                    </div>
                </div>
                <div class='holder'>
                    <div>
                        <div class="progress-label-left">
                            <b>Behaviour</b> <i class="fa fa-star mr-1 text-warning"></i>
                        </div>
                        <div class="progress-label-right">
                            <span id="total_one_star_review"> <?php echo $totalRatings1; ?> </span> Reviews
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" id='one_star_progress' style="width: <?php echo $totalRatings1; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center m-auto" style="padding-right:20px;">
                <button class="btn-primary" id='add_review'> Add Review </button>
                <a id="exit" href="review.php?id=<?php echo $s_id;?>">All Review</a>

            </div>
        </div>

        <div id="display_review">

        </div>
    </div>




    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Write your Review</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <h4>
                        <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_1' data-rating='1'></i>
                        <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_2' data-rating='2'></i>
                        <i class="fa fa-star star-light submit_star   mr-1 " id='submit_star_3' data-rating='3'></i>
                        <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_4' data-rating='4'></i>
                        <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_5' data-rating='5'></i>
                    </h4>
                    <div class="form-group">
                        <input type="text" class="form-control" id='userName' name='userName' placeholder="Enter Name">
                        <input type="hidden" id="id" name="id" value="<?php echo $s_id;?>">
                    </div>
                    <div class="form-group">
                        <textarea name="userMessage" id="userMessage" class="form-control" placeholder="Enter message"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn-primary" id='sendReview'>Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>