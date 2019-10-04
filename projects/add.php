<?php
include("../templateTop.html");

if (empty($_POST["pc"]))
{
?>
<div class="container">
    <form method="POST"
          action="add.php">
        <center><h3>Project details amendment</h3></center>
        <table align="center" cellpadding="3">

            <tr>
                <td><b>Project description</b></td>
                <td><input class="border" type="text" name="pd" size="25" required>
                </td>
            </tr>
            <tr>
                <td><b>Project country</b></td>
                <td><input class="border" type="text" name="pc" size="25" required>
                </td>
            </tr>
            <tr>
                <td><b>Project city</b></td>
                <td><input class="border" type="text" name="pct" size="40"></td>
            </tr>

        </table>
        <br><br/>
        <table align="center">
            <tr>
                <td><input class="btn-primary btn" type="submit"  value="Submit"></td>
                <td><input class="btn btn-secondary" type="button"  value="Return to List"  OnClick="window.location='index.php'"></td>
            </tr>
        </table>
    </form>
    <?php include("../displayPHP.php")   ?>
</div>


<?php
    include("../templateBottom.html");
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