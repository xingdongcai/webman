<?php
include("../loginCheck.php");
include("../templateTop.html");

if (empty($_POST["ppp"]))
{
?>
<div class="container">
    <form method="POST"
          action="add.php" enctype="multipart/form-data" name="addProductForm" onsubmit="return validateForm()">
        <center><h3>Product details amendment</h3></center>
        <table class="table table-bordered" align="center" cellpadding="3">
            <tr>
                <td><b>Product name</b></td>
                <td><input class="border" type="text" name="pname" size="25" required>
                </td>
            </tr>
            <tr>
                <td><b>Purchase price</b></td>
                <td>$<input class="border" type="number" name="ppp" size="10" required>
                </td>
            </tr>
            <tr>
                <td><b>Sale price</b></td>
                <td>$<input class="border" type="number" name="psp" size="10" required></td>
            </tr>
            <tr>
                <td><b>Country of origin</b></td>
                <td><input class="border" type="text" name="pco" size="15" required></td>
            </tr>
            <tr>
                <td><b>Product image</b></td>
                <td><input class="border" type="file" size="50" name="image"></td>
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
    <?php include("../displayPHP.php")   ?>
</div>


<?php include("../templateBottom.html") ?>

<?php
}else{
    include("../connection.php");
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh = new PDO($dsn,$UName,$PWord);
    $query = "INSERT INTO product (product_name, product_purchase_price, product_sale_price, product_country_of_origin)
                VALUES ('$_POST[pname]','$_POST[ppp]', '$_POST[psp]', '$_POST[pco]')";
    $stmt = $dbh->prepare($query);

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    }else{
        $imageName = $_FILES["image"]["name"];
        $imageDir = "../product_images/".$_FILES["image"]["name"];
        $allowTypes = array('jpg','png','jpeg','gif');
        $fileType = pathinfo($imageDir,PATHINFO_EXTENSION);
        if(!in_array($fileType,$allowTypes))
        {
            echo "ERROR: You may only upload .jpg or .gif or .png files";
        }else{
            if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imageDir))
            {

                echo "ERROR: Could Not Move File into Directory";
            }else{
                $queryImage = "INSERT INTO product_image (product_id, image_name)
                VALUES (last_insert_id(),'$imageName')";
                $stmt = $dbh->prepare($queryImage);
                if(!$stmt->execute()){
                    $err = $stmt->errorInfo();
                    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                }else{
                    ?>
                    <script language="JavaScript">
                        alert("Product record successfully added");
                    </script>
                    <?php
                    header("Location: index.php");
                }

            }
        }

    }
}
?>

<script>
    //JavaScript Validation
    function validateForm() {
        //It returns -1 if the argument passed a negative number.
        var purchasePrice = document.forms["addProductForm"]["ppp"].value;
        if ( Number(purchasePrice)<0) {
            alert("Please Check Your Product Purchase Price.");
            return false;
        }

        var salePrice = document.forms["addProductForm"]["psp"].value;
        if (Number(salePrice) < 0 ) {
            alert("Please Check Your Product Sale Price.");
            return false;
        }
    }
</script>
