<?php
ob_start();
?>
<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<script language="javascript">
    function confirm_delete()
    {
        window.location='ProjectModify.php?projectId=<?php echo $_GET["projectId"]; ?>&Action=ConfirmDelete';
    }
</script>
<center><h3>Project Modification</h3></center>
<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM project WHERE project_id =".$_GET["projectId"];
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <form method="post" action="ProjectModify.php?projectId=<?php echo $_GET["projectId"]; ?>&Action=ConfirmUpdate">
        <center>Project details amendment<br /></center><p />
        <table align="center" cellpadding="3">
            <tr />
            <td><b>Project. No.</b></td>
            <td><?php echo $row->project_id; ?></td>
            </tr>
            <tr>
                <td><b>Project. Description</b></td>
                <td><input type="text" name="pd" size="30" value="<?php echo $row->project_desc; ?>"></td>
            </tr>
            <tr>
                <td><b>Project. country</b></td>
                <td><input type="text" name="pc" size="30" value="<?php echo $row->project_country; ?>"></td>
            </tr>
            <tr>
                <td><b>Project. city</b></td>
                <td><input type="text" name="pct" size="40" value="<?php echo $row->project_city; ?>"></td>
            </tr>

        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update Project"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='index.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE project set project_desc='$_POST[pd]',
	            project_country='$_POST[pc]', project_city='$_POST[pct]'
                WHERE project.project_id =".$_GET["projectId"];

    $stmt = $dbh->prepare($query);
    $stmt->execute();

    header("Location: index.php");

    break;

case "Delete":
    ?>
    <center>Confirm deletion of the following project record<br /></center><p />
    <table align="center" cellpadding="3">
        <tr/>
        <td><b>Project. No.</b></td>
        <td><?php echo $row->project_id; ?></td>
        </tr>
        <tr>
            <td><b>Description</b></td>
            <td><?php echo "$row->project_desc"; ?></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();">
            <td><input type="button" value="Cancel" OnClick="window.location='index.php'"></td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM project WHERE project_id =".$_GET["projectId"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>
<center>
    The following project record has been successfully deleted<p/>
    <?php
    echo "Project No. $row->project_id ";
    echo "</center><p />";
    }
    else
    {
        echo "<center>Error deleting project record<p /></center>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"index.php\"'></center>";
    break;
    }
    $stmt->closeCursor();
    ?>
</body>
</html>
