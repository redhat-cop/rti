<?php
session_start();
if(!isset($_SESSION['usr_name'])) {
header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="https://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/jquery.qtip.css" />
<link rel="stylesheet" href="css/bootstrap-slider.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>

<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>


<nav id="top" class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/innovate.png">  Ready to Innovate?</a>
			<div class="smallVersion">v2.0</div>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><a href="myrti.php">My RTI</a></li>
				<li><a href="assess.php">Run Assessment</a></li>
				<li><a href="#">Signed in as <?php echo $_SESSION['usr_name']; ?></a></li>
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
				<?php } ?>

			</ul>
		</div>
	</div>
</nav>

    <div class="container">
 
    <div class="container">


<form action="updateDetails.php">
<?php
include 'dbconnect.php';
connectDB();
$qq = "SELECT * from data where hash = '" . $_REQUEST['hash'] . "';";
$res = mysqli_query($db, $qq);
$row = $res->fetch_assoc();

?>
    <p>Client Name: <input id="inputWidth" name="client" value="<?php print $row['client']; ?>" ></p>
    <p>Project/Team: <input  id="inputWidth" name="project" value="<?php print $row['project']; ?>"  ></p>
    <p>Email: <input  id="inputWidth" name="rhEmail" value="<?php print $row['rhEmail']; ?>"  ></p>
    <input  name = "hash" type="hidden" value="<?php print $_REQUEST['hash']; ?>">
  <button type="submit" value="Submit">Update</button>
</form>





    
</body>
</html>
