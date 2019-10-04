<?php
include("../loginCheck.php");
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

<?php include("../templateTop.html")    ?>
    <div id="content-wrapper">
        <div class="container">
            <h3 align="center"><b>Product Details</b></h3>
            <form method="post" action="multipleEdit.php">
                <table class="table-bordered" border="1" cellpadding="5" align="center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Sale Price</th>
                    </tr>
                    <?php
                    while ($Titles= $stmt->fetchObject())
                    {
                        ?>
                        <tr>
                            <td><?php echo $Titles->product_id; ?></td>
                            <td><?php echo $Titles->product_name; ?></td>
                            <td align="center"><input type="checkbox" name="check[]" value="<?php echo $Titles->product_id; ?>"></td>
                            <td align="center">$<input class="border" type="text" size="8" name="<?php echo $Titles->product_id; ?>" value="<?php echo $Titles->product_sale_price; ?>"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <hr>
                <div align="center">
                    <input  class="btn btn-primary" type="submit" value="Update Selected Titles">
                </div>

            </form>
        </div>
    </div>
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
            header("Location: index.php");
        }
        $stmt->closeCursor();

        ?>
<?php include("../displayPHP.php")   ?>
<?php include("../templateBottom.html");    ?>