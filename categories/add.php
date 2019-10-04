<?php
include("../loginCheck.php");
include("../templateTop.html");
if (empty($_POST["cn"]))
{
?>
<div class="container">
    <form method="POST"
          action="add.php">
        <h3 align="center">Category details amendment</h3>
        <table class="" align="center" cellpadding="3">

            <tr>
                <td><b>category_name</b></td>
                <td><input class="border" type="text" name="cn" size="25" required>
                </td>
            </tr>


        </table>
        <br><br/>
        <table align="center">
            <tr>
                <td><input class="btn btn-primary" type="submit"  value="Submit"></td>
                <td><input class="btn btn-secondary" type="button"  value="Return to List"  OnClick="window.location='index.php'"></td>
            </tr>
        </table>
    </form>
</div>

    <?php include("../displayPHP.php")   ?>
<?php
    include("../templateBottom.html");
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