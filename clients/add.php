<!--<html>-->
<!--<head>-->
<!--    <title>Add Client Account</title>-->
<!--</head>-->
<!--<body>-->
<!--<form method="post" Action="../clients/displaypost.php">-->
<!--    <p />Please type your name in the space below <p />-->
<!--    First Name <input type="text" name="fname"> <p />-->
<!--    Surname <input type="text" name="sname"> <p />-->
<!--    <input type="Submit" Value="Submit">-->
<!--    <input type="Reset" Value="Clear Form Fields">-->
<!--</form>-->
<!--</body>-->
<!--</html>-->

<?php
include("../connection.php");
$dsn = "mysql:host=$Host;dbname=$DB;";
$dbh = new PDO($dsn, $UName, $PWord);
$stmt = $dbh->prepare("select * from client");
$stmt->execute();
?>