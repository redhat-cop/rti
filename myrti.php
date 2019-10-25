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
<script type="text/javascript" >
$(function() {
    $('.confirm').click(function(e) {
        e.preventDefault();
        if (window.confirm("Are you sure you want to delete this item ?")) {
            location.href = this.href;
        }
    });
});
</script>
</head>


<body>

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
 
<?php
if(isset($_SESSION['usr_id'])) {
include 'dbconnect.php';
$userId = $_SESSION['usr_id'];
$userName = $_SESSION['usr_name'];

?>
    <div class="container">
<h3>Completed Assessments for <?php print $userName; ?> </h3>
<table  class="bordered" id="assessmentTable">
    <thead>
    <tr>
        <th>Client Name</th>  
        <th>Email Address</th>      
        <th>Country</th>
        <th>Line of Business</th>
        <th>Timestamp</th>
        <th>Customer Data</th>
        <th>Link to Output</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
<?php
connectDB();
$qq = "SELECT * FROM data WHERE user='".$userName."'";
$res = mysqli_query($db, $qq);
while ($row = $res->fetch_assoc()) {
	if ($row['demo'] == "on") {
	$demoData = "<img src=images/cross.png>";
	} else {
	$demoData = "<img src=images/tick.png>";
	}
	
print "<tr><td>" . $row['client'] . "</td><td>" . $row['rhEmail'] . "</td><td>" . $row['country'] . "</td><td>" . $row['lob'] . "</td><td>" . $row['date'] . "</td><td>" . $demoData . "</td><td><a href=results.php?hash=" . $row['hash'] . ">Link</a></td><td><a class=\"confirm\"  href=delete.php?hash=" . $row['hash'] . " ><img src=images/delete.png></a></td></tr>";
}

#$q1 = "select lob, count(*) as total from data where demo <> 'on' group by lob order by total desc ;";
#$sth = mysqli_query($db, $q1);

?>
<tbody>
</table>


<script type="text/javascript" >
// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
</script>

 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([
 
 ['class Name','Students'],
 <?php 
			#$query = "SELECT * from class";
 			$query = "select lob, count(*) as total from data where user=\"$userName\" and demo <> 'on' group by lob order by total desc ;";
			 $exec = mysqli_query($db,$query);
			 while($row = mysqli_fetch_array($exec)){
 
			 echo "['".$row['lob']."',".$row['total']."],";
			 }
			 ?> 
 
 ]);
 
 var options = {
 title: 'Breakdown by Line of Business',
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'XXXX'
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
	
    </script>
    
<!--     <h2 id="graphs" style="padding-top: 500px;">Graphs</h2> -->
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
<a href="#top">Scroll to Top</a>    
      </div>
    </div> <!-- /container -->
<?php    }
####  End of Logged on bit ######
?>

<script>
$(document).ready( function () {
    $('#assessmentTable').DataTable();
} );
</script> 

</body>
</html>
