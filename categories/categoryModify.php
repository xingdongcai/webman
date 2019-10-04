<?php
ob_start();
include("../templateTop.html");
?>


<script language="javascript">
    function confirm_delete()
    {
        window.location='categoryModify.php?categoryId=<?php echo $_GET["categoryId"]; ?>&Action=ConfirmDelete';
    }
</script>

<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM category WHERE category_id =".$_GET["categoryId"];
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <div class="container">
        <form method="post" action="categoryModify.php?categoryId=<?php echo $_GET["categoryId"]; ?>&Action=ConfirmUpdate">
            <center><h3>Category details amendment</h3><br /></center><p />
            <table align="center" cellpadding="3">
                <tr />
                <td><b>Category. No.</b></td>
                <td><?php echo $row->category_id; ?></td>
                </tr>
                <tr>
                    <td><b>Category. Name</b></td>
                    <td><input class="border" type="text" name="cn" size="30" value="<?php echo $row->category_name; ?>"></td>
                </tr>

            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input class="btn btn-primary" type="submit" value="Update Category"></td>
                    <td><input class="btn btn-secondary" type="button" value="Return to List" OnClick="window.location='index.php'"></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE category set category_name='$_POST[cn]'
                WHERE category.category_id =".$_GET["categoryId"];

    $stmt = $dbh->prepare($query);
    $stmt->execute();

    header("Location: index.php");

    break;

case "Delete":
    ?>
    <div class="container">
        <center><h3>Confirm deletion of the following category record</h3><br/></center><p />
        <table align="center" cellpadding="3">
            <tr />
            <td><b>Category. No.</b></td>
            <td><?php echo $row->category_id; ?></td>
            </tr>
            <tr>
                <td><b>Name</b></td>
                <td><?php echo "$row->category_name"; ?></td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input class="btn btn-primary" type="button" value="Confirm" OnClick="confirm_delete();">
                <td><input class="btn btn-secondary" type="button" value="Cancel" OnClick="window.location='index.php'"></td>
            </tr>
        </table>
    </div>

    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM category WHERE category_id =".$_GET["categoryId"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>
<div class="container">
    <center>
        <h3>The following customer record has been successfully deleted</h3><p/>
        <?php
        echo "Category No. $row->category_id";
        echo "</center><p />";
        }
        else
        {
            echo "<center>Error deleting customer record<p /></center>";
        }
        echo "<center><input class='btn btn-secondary' type='button' value='Return to List' OnClick='window.location=\"index.php\"'></center>";
        break;
        }
        $stmt->closeCursor();
        ?>
</div>



<?php include("../displayPHP.php")   ?>
<?php include("../templateBottom.html");?>
