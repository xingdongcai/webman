<html>
<head>
    <title>Add Product</title>
</head>
<body>
<?php
if (empty($_POST["ppp"]))
{
?>

<form method="POST"
      action="add.php" enctype="multipart/form-data">
    <center>Product details amendment</center>
    <table align="center" cellpadding="3">

        <tr>
            <td><b>Product name</b></td>
            <td><input type="text" name="pname" size="25" required>
            </td>
        </tr>
        <tr>
            <td><b>Purchase price</b></td>
            <td><input type="text" name="ppp" size="25" required>
            </td>
        </tr>
        <tr>
            <td><b>Sale price</b></td>
            <td><input type="text" name="psp" size="40"></td>
        </tr>
        <tr>
            <td><b>Country of origin</b></td>
            <td><input type="text" name="pco" size="10" ></td>
        </tr>
        <tr>
            <td><b>Product image</b></td>
            <td><input type="file" size="50" name="image"></td>
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
    $query = "INSERT INTO product (product_name, product_purchase_price, product_sale_price, product_country_of_origin)
                VALUES ('$_POST[pname]','$_POST[ppp]', '$_POST[psp]', '$_POST[pco]')";

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    }else{
        $imageName = $_FILES["image"]["name"];
        $imageDir = "../product_images/".$_FILES["image"]["name"];
        if(1===2)
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