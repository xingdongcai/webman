<html>
<head>
    <title>Add category</title>
</head>
<body>
<?php
if (empty($_POST["cn"]))
{
?>

<form method="POST"
      action="add.php">
    <center>category details amendment</center>
    <table align="center" cellpadding="3">

        <tr>
            <td><b>category_name</b></td>
            <td><input type="text" name="cn" size="25" required>
            </td>
        </tr>


    </table>
    <br><br/>
    <table align="center">
        <tr>
            <td><input type="submit"  value="Submit"></td>
            <td><input type="button"  value="Return to List"  OnClick="window.location='index.php'"></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
}else{
    include("../connection.php");
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh = new PDO($dsn,$UName,$PWord);
    $query = "INSERT INTO category (category_name)
                VALUES ('$_POST[cn]')";
    $stmt = $dbh->prepare($query);

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        $stmt->execute();
    }else{
        ?>
        <script language="JavaScript">
            alert("category record successfully added");
        </script>
        <?php
        header("Location: index.php");
    }

}

?>