<?php
include("../loginCheck.php");
include("../templateTop.html")
?>
<script language="javascript">
    function confirm_delete()
    {
        window.location='ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmDelete';
    }

</script>
<center><h3>Product Modification</h3></center>
<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM product  WHERE product_id =".$_GET["productId"];
$sql="SELECT * FROM category";
$stmt = $dbh->prepare($query);

$stmt->execute();

$row=$stmt->fetchObject();



$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <form method="post" action="ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmUpdate">
        <center>Product details amendment<br /></center><p />
        <table align="center" cellpadding="3">
            <tr />
            <td><b>Product. No.</b></td>
            <td><?php echo $row->product_id; ?></td>
            </tr>
            <tr>
                <td><b>Product. Name</b></td>
                <td><input type="text" name="pname" size="30" value="<?php echo $row->product_name; ?>"></td>
            </tr>
            <tr>
                <td><b>Product. Purchse Price</b></td>
                <td><input type="text" name="ppp" size="30" value="<?php echo $row->product_purchase_price; ?>"></td>
            </tr>
            <tr>
                <td><b>Product. Sale Price</b></td>
                <td><input type="text" name="psp" size="40" value="<?php echo $row->product_sale_price; ?>"></td>
            </tr>
            <tr>
                <td><b>Product. Country of origin</b></td>
                <td><input type="text" name="pco" size="10" value="<?php echo $row->product_country_of_origin; ?>"></td>
            </tr>

        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update Product"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='index.php'"></td>
            </tr>
        </table>

        <?php
        $query="SELECT * FROM category ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        /* $row=$stmt->fetchObject();*/

        /*$strAction = $_GET["Action"];*/

        ?>

        <form method="post" action="ProductModify.php">
            <table border="1" cellpadding="5">
                <tr>
                    <th>CATEGORY</th>
                    <th></th>

                </tr>
                <?php
                while ($Titles= $stmt->fetchObject())
                {
                    ?>
                    <tr>
                        <td><?php echo $Titles->category_name;?></td>
                        <td align="center"><input type="checkbox" name="check[]" value="<?php echo $Titles->category_id; ?>"></td>

                    </tr>
                    <?php
                }
                ?>
            </table><p />
        </form>

    </form>
    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE product set product_name='$_POST[pname]',
	            product_purchase_price='$_POST[ppp]', product_sale_price='$_POST[psp]',
	            product_country_of_origin='$_POST[pco]'
                WHERE product.product_id =".$_GET["productId"];
    $stmt = $dbh->prepare($query);
    $cId=$_GET["productId"];


    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    }
    else{

        foreach($_POST["check"] as $change)
        {

            $stmt = $dbh->prepare( "INSERT INTO product_category( category_id,product_id) values ('$change','$cId')");
            $stmt->execute();
        }

    }

    header("Location: index.php");

    break;

case "Delete":
    ?>
    <center>Confirm deletion of the following product record<br /></center><p />
    <table align="center" cellpadding="3">
        <tr />
        <td><b>Product. No.</b></td>
        <td><?php echo $row->product_id; ?></td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td><?php echo "$row->product_name"; ?></td>
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
$query="DELETE FROM product WHERE product_id =".$_GET["productId"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>

    The following customer record has been successfully deleted<p/>
    <?php
    echo "Product No. $row->product_id $row->product_name";
    echo "</center><p />";
    }
    else
    {
        echo "<center>Error deleting customer record<p /></center>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"index.php\"'></center>";
    break;
    }
    $stmt->closeCursor();
    ?>
</body>
</html>
