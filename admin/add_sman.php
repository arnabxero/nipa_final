<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit'])){
$AddName = $_POST['addName'];
$Info = $_POST['addInfo'];
$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "../rating_system/img/" . $filename;
$db = mysqli_connect("localhost", "root", "", "sports");
$sql="INSERT INTO sman_list (name,info,img) Values('$AddName','$Info','$filename')";
$result = mysqli_query($db, $sql);
move_uploaded_file($tempname, $folder);
if($result>0)
{
$msg= "Package Add Successfully";
echo "<script>window.location.href='add-package.php'</script>";
 }
else {

$errormsg= "Data not insert successfully";
 }
}

//Delete Record Data

if(isset($_REQUEST['del']))
{
$uid=intval($_GET['del']);
$sql = "delete from sman_list WHERE  id=:id";
$query = $dbh->prepare($sql);
$query-> bindParam(':id',$uid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Record Delete successfully');</script>";
echo "<script>window.location.href='add-package.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Admin | Add Sports Man</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
   <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
     <h3>Add Sportsman</h3>
     <hr />
      <div class="row">
        
        <div class="col-md-6">
          <div class="tile">
          <!---Success Message--->  
          <?php if($msg){ ?>
          <div class="alert alert-success" role="alert">
          <strong>Well done!</strong> <?php echo htmlentities($msg);?>
          </div>
          <?php } ?>

          <!---Error Message--->
          <?php if($errormsg){ ?>
          <div class="alert alert-danger" role="alert">
          <strong>Oh snap!</strong> <?php echo htmlentities($errormsg);?></div>
          <?php } ?>

              <form class="row" method="post" enctype="multipart/form-data">
                <!--
                 <div class="form-group col-md-12">
                  <label class="control-label">Add Category</label>
                  <select class="form-control" name="category" id="category">
                  <option value="NA">--select--</option>

                  </select>
                </div>
                -->

               

                <div class="form-group col-md-12">
                  <label class="control-label">Add Name</label>
                  <input class="form-control" name="addName" id="addName" type="text" placeholder="Enter Add Name">
                  <label class="control-label">Add Information</label>
                  <input class="form-control" name="addInfo" id="addInfo" type="text" placeholder="Enter Add Information under 50 words ">
                  <label class="control-label">Add Image</label>
                  <input class="form-control" type="file" name="uploadfile" value=""/>
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <input type="submit" name="submit" id="submit" class="btn btn-primary" value=" Submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                     <th>Name </th>
                    <th>Information</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
               <?php
                  $sql="SELECT * FROM sman_list ORDER BY id";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>

                <tbody>
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td><?php echo htmlentities($result->name);?></td>
                    <td><?php echo htmlentities($result->info);?></td>
                    <td>
<!--                       <a href="add-package.php?cid=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary" type="button">Edit</button></a> 
 -->                      <a href="add_sman.php?del=<?php echo htmlentities($result->id);?>"><button class="btn btn-danger" type="button">Delete</button></a></td>
                  </tr>
                    <?php  $cnt=$cnt+1; } } ?>
              
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  
  </body>
</html>
<?php } ?>