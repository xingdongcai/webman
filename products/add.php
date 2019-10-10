<?php
include("../loginCheck.php");
include("../templateTop.html");

if (empty($_POST["ppp"]))
{
?>
    <div id="content-wrapper">
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
                        <td>$<input class="border" type="text" name="ppp" size="10" required>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Sale price</b></td>
                        <td>$<input class="border" type="text" name="psp" size="10" required></td>
                    </tr>
                    <tr>
                        <td><b>Country of origin</b></td>
                        <td><input class="border" type="text" name="pco" size="15" required></td>
                    </tr>
                    <tr>
                        <td><b>Product image</b></td>
                        <td><input class="border" type="file" size="50" name="images[]" multiple></td>
                    </tr>

                </table>
                <br><br/>
                <table align="center">
                    <tr>
                        <td><input class="btn btn-primary" type="submit"  value="Submit"  ></td>
                        <td><input class="btn btn-secondary" type="button"  value="Return to List"  OnClick="window.location='index.php?key='"></td>
                    </tr>
                </table>
                <?php
                include("../connection.php");
                $dsn= "mysql:host=$Host;dbname=$DB";
                $dbh = new PDO($dsn,$UName,$PWord);

                $query="SELECT * FROM category ";
                $stmt = $dbh->prepare($query);
                if(!$stmt->execute()){
                    $err = $stmt->errorInfo();
                    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
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
                                        >
                                </td>
                            </tr>
                            <?php

                        }
                        ?>
                    </table><p />
                </form>
            </form>
            <?php include("../displayPHP.php")   ?>
        </div>

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
        if(!empty($_POST['check'])){
            foreach($_POST["check"] as $change)
            {
                $stmt = $dbh->prepare( "INSERT INTO product_category( category_id,product_id) values ('$change',last_insert_id())");
                if(!$stmt->execute()){
                    $err = $stmt->errorInfo();
                    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                }
            }
        }
        $stmt = $dbh->prepare("SELECT LAST_INSERT_ID() INTO @lastID");
        $stmt->execute();
        $allowTypes = array('jpg','png','jpeg','gif');
        $targetDir = "../product_images/";
        if(!empty(array_filter($_FILES['images']['name']))){
            foreach ($_FILES['images']['name'] as $key=>$val){
                $fileName = basename($_FILES['images']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    if(!move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                        echo "ERROR: Could Not Move File: $fileName into Directory";
                    }else{

                        $queryImage = "INSERT INTO product_image (product_id, image_name) 
                                        VALUES (@lastID,'$fileName')";
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


    }
}
?>

<script>
    //JavaScript Validation
    function validateForm() {
        let productName = document.forms["addProductForm"]["pname"].value;
        if(!/^[a-zA-Z0-9]+$/.test(productName)){
            alert("Please Check Your Product Name. Do not include special characters");
            return false;
        }

        let country = document.forms["addProductForm"]["pco"].value;
        if(!/^[a-zA-Z]+$/.test(country)){
            alert("Please Check Product Country Name. Do not include special characters")
        }

        //It returns -1 if the argument passed a negative number.
        let purchasePrice = document.forms["addProductForm"]["ppp"].value;
        if ( Number(purchasePrice)<0 || purchasePrice.length>10 || isNaN(purchasePrice)) {
            alert("Please Check Your Product Purchase Price.");
            return false;
        }

        let salePrice = document.forms["addProductForm"]["psp"].value;
        if (Number(salePrice) < 0 || salePrice.length>10 || isNaN(salePrice)) {
            alert("Please Check Your Product Sale Price.");
            return false;
        }
    }
</script>
