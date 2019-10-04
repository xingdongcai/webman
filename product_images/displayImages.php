<?php   include("../templateTop.html") ?>
<?php

$currdir = dirname($_SERVER["SCRIPT_FILENAME"]);
$dir = opendir($currdir);

if(empty($_POST["delete"]))
{
?>

    <div class="container-fluid">

        <form method="post" action="displayImages.php">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <input  class='btn btn-primary' type='submit' value='Delete Selected Files'>
        </li>
    </ol>
        <div class="row">
            <?php
            while ($file = readdir($dir))
            {
                if (fnmatch("*.jpg", $file)||fnmatch("*.png", $file))
                {?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <?php echo '<img src="'.$file.'" style="width: 100%"/><br/>';?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="delete[]" value="<?php echo $file?>"><?php echo $file?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
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
                    echo "<center>Image File ".$filename." has been deleted<br></center>";
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