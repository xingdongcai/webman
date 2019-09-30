<html>
<head>
    <title></title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<center>
    <font face="Arial" size="3">
        <b>Product Details</b>
        <p>
            <?php
            include("../connection.php");
            $dsn= "mysql:host=$Host;dbname=$DB";
            $dbh = new PDO($dsn,$UName,$PWord);
           if(empty($_POST["check"]))
            {
            $query="SELECT * FROM product ";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
           /* $row=$stmt->fetchObject();*/

            /*$strAction = $_GET["Action"];*/

            ?>

            <form method="post" action="multipleEdit.php">
                <table border="1" cellpadding="5">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Cost Price</th>
                    </tr>
                    <?php
                    while ($Titles= $stmt->fetchObject())
                    {
                        ?>
                        <tr>
                            <td><?php echo $Titles->product_id; ?></td>
                            <td><?php echo $Titles->product_name; ?></td>
                            <td align="center"><input type="checkbox" name="check[]" value="<?php echo $Titles->product_id; ?>"></td>
                            <td align="center"><input type="text" size="5" name="<?php echo $Titles->product_id; ?>" value="<?php echo $Titles->product_sale_price; ?>"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table><p />
        <center><input type="submit" value="Update Selected Titles"></center>
        </form>
        <?php

        }
        else
        {

            foreach($_POST["check"] as $change)
            {
                //echo "ISBN is $isbn<br />";
                //echo "Cost Price is $_POST[$isbn]<br /><br />";


                $stmt = $dbh->prepare("UPDATE product set product_sale_price = $_POST[$change] where product_id='$change'");
                $stmt->execute();
            }
            header("Location: multipleEdit.php");
        }
        $stmt->closeCursor();
        ?>
    </font>
</body>
</html>