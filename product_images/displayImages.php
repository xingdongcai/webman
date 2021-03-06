<?php
include("../loginCheck.php");
include("../templateTop.html");


include("../connection.php");
$dsn = "mysql:host=$Host;dbname=$DB;";
$dbh = new PDO($dsn, $UName, $PWord);
$stmt = $dbh->prepare("select * from product_image");
$stmt->execute();

$currdir = dirname($_SERVER["SCRIPT_FILENAME"]);
$dir = opendir($currdir);

if(empty($_POST["delete"]))
{
?>
    <div id="content-wrapper">
        <div class="container-fluid">

            <form method="post" action="displayImages.php">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <input  class='btn btn-primary' type='submit' value='Delete Selected Files'>
                    </li>
                </ol>
                <div class="row">
                    <?php
                    while($file = readdir($dir))
                    {
                        if(fnmatch("*.jpg",$file)|| fnmatch("*.png",$file)){
                            ?>
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <!--                            --><?php //echo $file ?>
                                    <?php echo '<img src="'.$file.'" style="width: 80%"/><br/>' ;?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="delete[]" value="<?= $file ?>">
                                            <?php
                                            $sql = "select product_id from product_image where image_name='" . $file . "'";
                                            $stmtProduct = $dbh->prepare("select * from product where product_id="."(".$sql.")");
                                            $stmtProduct->execute();
                                            $productRow=$stmtProduct->fetch();
                                            echo "Product Name: $productRow[1]";
                                            echo "<br>Purchase Price: $$productRow[2]";
                                            echo "<br>Sale Price: $$productRow[3]";
                                            echo "<br>Country: $productRow[4]";
                                            ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    ?>
                </div>
            </form>
        </div>
    </div>

        <?php
        }
        else
        {?>
            <div class="container-fluid">
            <?php
            foreach($_POST["delete"] as $filename )
            {

                if(unlink($filename))
                {
                    $query = "DELETE FROM product_image WHERE image_name ='" . $filename . "'";
                    $stmt = $dbh->prepare($query);
                    if(!$stmt->execute()) {
                        $err = $stmt->errorInfo();
                        echo "<h4 align='center'>Error deleting record to database ??? contact System Administrator Error is:</h4> <b><h5 align='center'>" . $err[2] . "</h5></b>";
                    }
                    else {
                        echo "<center>Image File ".$filename." has been deleted<br></center>";
                    }


                }else{
                    echo "ERROR: Can't Delete Image File.$filename";
                }

            }
            echo "<center><input class='btn btn-secondary' type='button' value='Return to List' OnClick='window.location=\"displayImages.php\"'></center>";
        }
        closedir($dir);
        ?>
            </div>

    </form>

    </div>

<?php include("../displayPHP.php")   ?>
<?php include("../templateBottom.html") ?>