<?php
include("../loginCheck.php");
include("../templateTop.html")
?>

<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM product  WHERE product_id =".$_GET["productId"];
$sql="SELECT * FROM category";
$stmt = $dbh->prepare($query);

if(!$stmt->execute()){
    $err = $stmt->errorInfo();
    echo "Error select record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
}

$row=$stmt->fetchObject();



$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <form method="post" enctype="multipart/form-data" name="editProductForm" onsubmit="return validateForm()"  action="ProductModify.php?productId=<?php echo $_GET["productId"]; ?>&Action=ConfirmUpdate">
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
                        <td><input type="text" pattern="[a-zA-Z]*" name="pco" size="10" value="<?php echo $row->product_country_of_origin; ?>"></td>
                    </tr>
                    <tr>

                        <?php
                            $query="SELECT * FROM product_image WHERE product_id=".$row->product_id;
                            $stmt = $dbh->prepare($query);
                        if(!$stmt->execute()){
                            $err = $stmt->errorInfo();
                            echo "Error select record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                        }
                            while($rowImage = $stmt->fetch()){
                                ?>
                                <td><b>Image</b></td>
                                <td><img src="../product_images/<?= $rowImage[2] ?>" style="width: 20%"/></td>
                                <?php
//                                echo "<td>$rowImage[2]</td>";
//                                echo "";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td><b>Update image</b></td>
                        <td><input class="border" type="file" size="50" name="images[]" multiple></td>
                    </tr>

                </table>
                <br/>
                <table align="center">
                    <tr>
                        <td><input class="btn btn-primary" type="submit" value="Update Product" ></td>
                        <td><input class="btn btn-secondary" type="button" value="Return to List" OnClick="window.location='index.php?key='"></td>
                    </tr>
                </table>

                <?php
                $query="SELECT * FROM category ";
                $stmt = $dbh->prepare($query);
                if(!$stmt->execute()){
                    $err = $stmt->errorInfo();
                    echo "Error select record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                }


                $stmtI = $dbh->prepare("SELECT * FROM product_category where product_id=".$_GET["productId"]);
                if(!$stmtI->execute()){
                    $err = $stmtI->errorInfo();
                    echo "Error select record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                }
                $aList=[];
                while( $sql=$stmtI->fetchObject() ) {?><?php
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
        echo "Error update record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    }
    else{
        $stmt = $dbh->prepare( "DELETE FROM product_category where product_id=$cId");
        if(!$stmt->execute()){
            $err = $stmt->errorInfo();
            echo "Error delete record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        }
        if(!empty($_POST['check'])){
            foreach($_POST["check"] as $change)
            {
                $stmt = $dbh->prepare( "INSERT INTO product_category( category_id,product_id) values ('$change','$cId')");
                if(!$stmt->execute()){
                    $err = $stmt->errorInfo();
                    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                }
            }
        }


    }

    if(!isset($_POST['images']['name'])){
        //delete related images
        $sql="SELECT * FROM product_image WHERE product_id=".$cId;
        $stmt = $dbh->prepare($sql);
        if(!$stmt->execute()){
            $err = $stmt->errorInfo();
            echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        }

        $targetDir = "../product_images/";
        while($rowDeleteImg = $stmt->fetch()){
            echo "<h1>$rowDeleteImg[2]</h1>";
            $targetFilePath = $targetDir.$rowDeleteImg[2];
            if(unlink($targetFilePath))
            {
                $sql="DELETE FROM product_image WHERE product_id=".$_GET["productId"];
                $stmt = $dbh->prepare($sql);
                if(!$stmt->execute()) {
                    $err = $stmt->errorInfo();
                    echo "<h4 align='center'>Error deleting record to database – contact System Administrator Error is:</h4> <b><h5 align='center'>" . $err[2] . "</h5></b>";
                }
                else {
                    echo "<center>Image File has been deleted<br></center>";
                }
            }else{
                echo "ERROR: Can't Delete Image File.$rowDeleteImg";
            }
        }

        //insert new images
        $allowTypes = array('jpg','png','jpeg','gif');

        foreach ($_FILES['images']['name'] as $key=>$val){
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                if(!move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                    echo "ERROR: Could Not Move File: $fileName into Directory";
                }else{

                    $queryImage = "INSERT INTO product_image (product_id, image_name) 
                                        VALUES ('$cId','$fileName')";
                    $stmt = $dbh->prepare($queryImage);
                    if(!$stmt->execute()){
                        $err = $stmt->errorInfo();
                        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                    }else{
                        header("Location: index.php?key=");
                    }
                }
            }
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

$queryImage="DELETE FROM product_image WHERE product_id =".$_GET["productId"];
$stmtImage = $dbh->prepare($queryImage);
if(!$stmtImage->execute()){
    $err = $stmtImage->errorInfo();
    echo "Error delete record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
}
else{
    echo "<br><h5 align='center'>Successfully delete related images.</h5>";
}


chdir($old); // Restore the old working directory

$query="DELETE FROM product_category WHERE product_id =".$_GET["productId"];
$stmt = $dbh->prepare($query);
if(!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    $stmt->execute();
}
$query="DELETE FROM product WHERE product_id =".$_GET["productId"];
$stmt = $dbh->prepare($query);
if(!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    $stmt->execute();
}
else if($stmt->execute())
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
<script>
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


    function validateForm() {
        let productName = document.forms["editProductForm"]["pname"].value;
        if(!/^[a-zA-Z0-9]+$/.test(productName)){
            alert("Please Check Your Product Name. Do not include special characters");
            return false;
        }

        let country = document.forms["editProductForm"]["pco"].value;
        if(!/^[a-zA-Z]+$/.test(country)){
            alert("Please Check Product Country Name. Do not include special characters")
        }

        //It returns -1 if the argument passed a negative number.
        let purchasePrice = document.forms["editProductForm"]["ppp"].value;
        if ( Number(purchasePrice)<0 || purchasePrice.length>10 || isNaN(purchasePrice)) {
            alert("Please Check Your Product Purchase Price.");
            return false;
        }

        let salePrice = document.forms["editProductForm"]["psp"].value;
        if (Number(salePrice) < 0 || salePrice.length>10 || isNaN(salePrice)) {
            alert("Please Check Your Product Sale Price.");
            return false;
        }
    }
</script>
