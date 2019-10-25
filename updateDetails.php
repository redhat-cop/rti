<html>
<head>
<meta http-equiv = "refresh" content = "0; url = myrti.php" /> 
</head>
<body>

<?php
include 'dbconnect.php';
connectDB();
$qq = "UPDATE data SET client = '" . $_REQUEST['client'] . "', project = '" . $_REQUEST['project'] . "', rhEmail = '" . $_REQUEST['rhEmail'] . "', comments = '" . $_REQUEST['comments'] . "' where hash = '" . $_REQUEST['hash'] . "';";
$res = mysqli_query($db, $qq);
?>

</body>
</html>