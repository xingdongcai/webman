<html>
<head>
    <title>Add Project</title>
</head>
<body>
<?php
if (empty($_POST["pc"]))
{
?>

<form method="POST"
      action="add.php">
    <center>Project details amendment</center>
    <table align="center" cellpadding="3">

        <tr>
            <td><b>Project description</b></td>
            <td><input type="text" name="pd" size="25" required>
            </td>
        </tr>
        <tr>
            <td><b>Project country</b></td>
            <td><input type="text" name="pc" size="25" required>
            </td>
        </tr>
        <tr>
            <td><b>Project city</b></td>
            <td><input type="text" name="pct" size="40"></td>
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
    $query = "INSERT INTO project (project_desc, project_country, project_city)
                VALUES ('$_POST[pd]','$_POST[pc]', '$_POST[pct]')";
    $stmt = $dbh->prepare($query);

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        $stmt->execute();
    }else{
        ?>
        <script language="JavaScript">
            alert("Project record successfully added");
        </script>
        <?php
        header("Location: index.php");
    }

}

?>