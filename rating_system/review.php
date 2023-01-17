<html>

<head>


    <style>
        .main_box {
            text-align: left;
            margin: 0 auto;
            margin-bottom: 25px;
            padding: 10px;
            background: #fff;
            height: 500px;
            width: 730px;
            border: 1px solid #a7a7a7;
            overflow: auto;
            border-radius: 4px;
            border-bottom: 4px solid #a7a7a7;
        }

        .main_box.dropdown {
            position: relative;
            display: inline-block;
        }

        .main_box.dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .rate {
            background-color: blanchedalmond;
            padding: 12px 16px;
            width: 20px;
        }

        .main_box.dropdown:hover .dropdown-content {
            display: block;
        }

        .main_box.comment_div {
            width: 500px;
            background-color: white;
            margin-top: 10px;
            text-align: left;
        }

        .comment_div .name {
            height: 30px;
            line-height: 30px;
            padding: 10px;
            background-color: grey;
            color: white;
            text-align: left;
        }

        .comment_div .comment {
            padding: 10px;
        }

        .comment_div .time {
            font-style: italic;
            padding: 10px;
            background-color: grey;
            color: white;
            text-align: left;
        }
    </style>
</head>

<body style="background-color: aqua;">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sports";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    ?>
    <div class="main_box">
        <div class="dropdown">
            <div class="dropdown-content">
            <a class="rate" href="review.php"> All</a>
        
                    <a class="rate" href="index.php">Back</a>

                <?php
                    $t_id = mysqli_real_escape_string($conn, $_GET['id']);
                    $sql = "SELECT * FROM review_table ORDER BY review_id DESC";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $comment = $row['message'];
                    $rate = $row['rating'];
                    $id = $row['id'];
                    if($id = $t_id){
    ?>



                    <div class="comment_div">
                        <p class="name"> Review Posted By <?php echo $name;  ?></p>
                        <p class="comment"> <?php echo $comment;  ?> </p>
                        <p class="time"> Review Based of 
                        <?php if($rate==1){
                            echo "Behaviour";
                        }
                        else if($rate==2){
                            echo "Leadership";
                        }
                        else if($rate==3){
                            echo "Strength";
                        }
                        else if($rate==4){
                            echo "Agility";
                        }
                        else if($rate==5){
                            echo "Skills";
                        }

                        
                        
                        ?></p>

                    </div>
                    <?php
        }
    }
exit;


?>
            </div>


        </div>



    </div>

</body>

</html>