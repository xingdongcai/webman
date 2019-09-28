<html>
<head>
    <title>Simple Example - Sending Data Back to User</title>
</head>
<body>
<?php
echo $fname = $_POST["fname"];
echo $sname = $_POST["sname"];
?>

<table border="0">
    <tr>
        <td>Hi <?php echo $_POST["fname"]; ?> welcome to PHP coding </td>
    </tr>
    <tr>
        <td><?php echo "By the way - your surname is $_POST[sname]";?>
    </tr>
    <tr>
        <td>
            <?php echo "Lets just check that - your full name is $fname $sname"; ?>
        </td>
    </tr>
</table>
</body>
</html>
