<?php
include("../loginCheck.php");
include("../templateTop.html")
?>
<script language="javascript">
    function confirm_delete()
    {
        window.location='ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmDelete';
    }
    function check(id,check) {
        if (check) {
            $('.' +id).find('input[type="checkbox"]').prop('checked', true);
        }
        else { $('.' +id).find('input[type="checkbox"]').removeAttr('checked'); }
    }

</script>
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
    <div id="content-wrapper">
        <div class="container-fluid">
            <form method="post" action="ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmUpdate">
                <center><h4>Product details amendment</h4><br /></center><p />
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
                        <td><input type="number" name="ppp" size="30" value="<?php echo $row->product_purchase_price; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Product. Sale Price</b></td>
                        <td><input type="number" name="psp" size="40" value="<?php echo $row->product_sale_price; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Product. Country of origin</b></td>
                        <td><input type="text" name="pco" size="10" value="<?php echo $row->product_country_of_origin; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Image</b></td>
                        <?php
                            $query="SELECT * FROM product_image WHERE product_id=".$row->product_id;
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            while($rowImage = $stmt->fetch()){
                                ?>
                                <td><img src="/product_images/<?= $rowImage[2] ?>" style="width: 20%"/></td>
                                <?php
//                                echo "<td>$rowImage[2]</td>";
//                                echo "";
                            }
                        ?>

                    </tr>

                </table>
                <br/>
                <table align="center">
                    <tr>
                        <td><input class="btn btn-primary" type="submit" value="Update Product"></td>
                        <td><input class="btn btn-secondary" type="button" value="Return to List" OnClick="window.location='index.php?key='"></td>
                    </tr>
                </table>

                <?php
                $query="SELECT * FROM category ";
                $stmt = $dbh->prepare($query);
                $stmt->execute();


                $stmtI = $dbh->prepare("SELECT * FROM product_category where product_id=".$_GET["productId"]);
                $stmtI->execute();
                $aList=[];
                while( $sql=$stmtI->fetchObject() ) {?>
                    <td><?php //echo $sql->category_id; ?></td><?php
                    array_push($aList,$sql->category_id);
                }
                function pChecked($v1,$list){
                    $pChecked="";
                    for($i=0;$i<sizeof($list);$i++)
                    {
                        if($v1==$list[$i])
                        {
                            $pChecked="checked";
                        }
                    }
                    return $pChecked;
                }
                ?>
                <hr>
                <form method="post" name="editForm" action="ProductModify.php">
                    <table  align="center" border="1" cellpadding="5">
                        <tr>
                            <th>CATEGORY</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($Titles = $stmt->fetchObject()) {
                            ?>
                            <tr>
                                <td><?php echo $Titles->category_name; ?></td>
                                <td align="center"><input type="checkbox" name="check[]"
                                                          value="<?php echo $Titles->category_id; ?>"
                                        <?php echo pChecked($Titles->category_id, $aList) ?>>
                                </td>
                            </tr>
                            <?php

                        }
                        ?>
                    </table><p />
                </form>

            </form>
        </div>

    </div>
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
        $stmt = $dbh->prepare( "DELETE FROM product_category where product_id=$cId");
        $stmt->execute();

        foreach($_POST["check"] as $change)
        {

            $stmt = $dbh->prepare( "INSERT INTO product_category( category_id,product_id) values ('$change','$cId')");
            $stmt->execute();
        }

    }

    header("Location: index.php?key=");

    break;

case "Delete":
    ?>
    <div class="container-fluid">
        <center><h4>Confirm deletion of the following product record</h4><br /></center><p />
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
                <td><input type="button" class="btn btn-primary" value="Confirm" OnClick="confirm_delete();">
                <td><input type="button" class="btn btn-secondary" value="Cancel" OnClick="window.location='index.php?key='"></td>
            </tr>
        </table>
    </div>

    <?php
    break;

case "ConfirmDelete":
    ?>
    <div class="container-fluid">
<?php
$BaseDir = '../product_images/';
$images_path = realpath($BaseDir);
$old = getcwd(); // Save the current directory
chdir($images_path);

$queryImageFile="SELECT * FROM product_image WHERE product_id=".$_GET["productId"];
$stmtImageFile = $dbh->prepare($queryImageFile);
if($stmtImageFile->execute()){
    while ($image_row = $stmtImageFile->fetch()){
        unlink($image_row[2]);
    }
}
chdir($old); // Restore the old working directory

$queryImage="DELETE FROM product_image WHERE product_id =".$_GET["productId"];
$stmtImage = $dbh->prepare($queryImage);
if($stmtImage->execute()){


    echo "<br><h5 align='center'>Successfully delete related images.</h5>";
}
$query="DELETE FROM product WHERE product_id =".$_GET["productId"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>

        <h4 align="center">The following product record has been successfully deleted</h4><p/><br>
        <?php
        echo "<div align='center'>Product No. $row->product_id <br>$row->product_name<br></div>";
        echo "</center><p/>";
        } else {
            echo "<center>Error deleting product record<p /></center>";
        }
        echo "<center><input type='button' value='Return to List' OnClick='window.location=\"index.php?key=\"'></center>";
        break;
        }
        ?>
    </div>

<?php include("../displayPHP.php")   ?>
<?php include('../templateBottom.html'); ?>

