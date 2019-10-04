<?php
include("../loginCheck.php");
include("../templateTop.html"); ?>


<script language="javascript">
    function confirm_delete()
    {
        window.location='ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM product  WHERE product_id =".$_GET["productId"];
$sql="SELECT * FROM category";
$stmt = $dbh->prepare($query);
$stmtc = $dbh->prepare($sql);
$stmt->execute();
$stmtc->execute();
$row=$stmt->fetchObject();
$pId= $_GET["productId"];


$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <div class="container">
        <form method="post" action="ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmUpdate">
            <h3 align="center">Product details amendment</h3>
            <table class="table table-bordered" align="center" cellpadding="3">
                <tr />
                <td><b>Product. No.</b></td>
                <td><?php echo $row->product_id; ?></td>
                </tr>
                <tr>
                    <td><b>Product. Name</b></td>
                    <td><input class="border" type="text" name="pname" size="30" value="<?php echo $row->product_name; ?>"></td>
                </tr>
                <tr>
                    <td><b>Product. Purchse Price</b></td>
                    <td><input class="border" type="text" name="ppp" size="30" value="<?php echo $row->product_purchase_price; ?>"></td>
                </tr>
                <tr>
                    <td><b>Product. Sale Price</b></td>
                    <td><input class="border" type="text" name="psp" size="40" value="<?php echo $row->product_sale_price; ?>"></td>
                </tr>
                <tr>
                    <td><b>Product. Country of origin</b></td>
                    <td><input class="border" type="text" name="pco" size="10" value="<?php echo $row->product_country_of_origin; ?>"></td>
                </tr>

            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input class="btn btn-primary" type="submit" value="Update Product"></td>
                    <td><input class="btn btn-secondary" type="button" value="Return to List" OnClick="window.location='index.php'"></td>
                </tr>
            </table><!--

/*
        $query="SELECT * FROM category ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        /* $row=$stmt->fetchObject();*/

        /*$strAction = $_GET["Action"];*/

        */?>

        <form method="post" action="ProductModify.php">
            <table border="1" cellpadding="5">
                <tr>
                    <th>CATEGORY</th>
                    <th></th>

                </tr>
                <?php
            /*                while ($Titles= $stmt->fetchObject())
                            {
                                */?>
                    <tr>
                        <td><?php /*echo $Titles->category_name; */?></td>
                        <td align="center"><input type="checkbox" name="check[]" value="<?php /*echo $Titles->category_id; */?>"></td>

                    </tr>
                    <?php
            /*                }
                            */?>
            </table><p />
            <center><input type="submit" value="Update Selected Titles"></center>
        </form>-->

        </form>
    </div>
    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE product set product_name='$_POST[pname]',
	            product_purchase_price='$_POST[ppp]', product_sale_price='$_POST[psp]',
	            product_country_of_origin='$_POST[pco]'
                WHERE product.product_id =".$_GET["productId"];
    $stmt = $dbh->prepare($query);


   /*
    foreach($_POST["check"] as $change)
    {

        $stmtc = $dbh->prepare( "INSERT INTO product_category( category_id,product_id) values (1,1)");
        $stmtc->execute();
    }*/

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    }
    else{

        $stmt = $dbh->prepare( "INSERT INTO product_category( product_id,category_id) values (1,4)");
        $stmt->execute();

    }

    header("Location: index.php");

    break;

case "Delete":
    ?>
    <div class="container">
        <center><h3>Confirm deletion of the following product record</h3></center>
        <br>
        <table class="table-bordered" align="center" cellpadding="3">
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
                <td><input class="btn btn-primary" type="button" value="Confirm" OnClick="confirm_delete();">
                <td><input class="btn btn-secondary" type="button" value="Cancel" OnClick="window.location='index.php'"></td>
            </tr>
        </table>
    </div>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM product WHERE product_id =".$_GET["productId"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>
    <div class="container">
        <center>
            <h3>The following customer record has been successfully deleted</h3><p/>
            <?php
            echo "Product No. $row->product_id <br>Product Name. $row->product_name";
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

