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
      action="add.php">
    <center>Product details amendment</center>
    <table align="center" cellpadding="3">

        <tr>
            <td><b>Product name</b></td>
            <td><input type="text" name="pname" size="25" required>
            </td>
        </tr>
        <tr>
            <td><b>Product purchase price</b></td>
            <td><input type="text" name="ppp" size="25" required>
            </td>
        </tr>
        <tr>
            <td><b>Product sale price</b></td>
            <td><input type="text" name="psp" size="40"></td>
        </tr>
        <tr>
            <td><b>Product country of origin</b></td>
            <td><input type="text" name="pco" size="10" ></td>
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
    $stmt = $dbh->prepare($query);

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        $stmt->execute();
    }else{
        ?>
        <script language="JavaScript">
            alert("Customer record successfully added");
        </script>
        <?php
        header("Location: index.php");
    }

}

?>