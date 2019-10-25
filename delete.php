<html>
<head>
<meta http-equiv = "refresh" content = "0; url = myrti.php" />
</head>
<body>

<?php
include 'dbconnect.php';
connectDB();
$qq = "delete from data where hash = '" . $_REQUEST['hash'] . "';";
$res = mysqli_query($db, $qq);
?>

</body>
</html>