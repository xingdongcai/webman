<html>
<head>
    <title>PHP File System - Delete</title>
</head>
<body>
<h1>Delete File</h1>
<?php

$currdir = dirname($_SERVER["SCRIPT_FILENAME"]);
echo $currdir;
echo "<br> ~~~~~~~~~~~~~~~~<br>";
$dir = opendir($currdir);
echo $dir;
echo "<br><br><br><br><br><br><br> ~~~~~~~~~~~~~~~~";

if(empty($_POST["delete"]))
{
?>
<form method="post" action="testImage.php">
    <table>
        <?php
        while ($file = readdir($dir))
        {
            if (fnmatch("*.jpg", $file)||fnmatch("*.png", $file))
            {
                echo "<tr>";
                echo "<td>" . $file . "</td>";
                echo "<td><input type='checkbox' name='delete[]' value='$file' /></td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "<input  type='submit' value='Delete Selected Files'>";
        }
        else
        {
            foreach($_POST["delete"] as $filename )
            {
                if(unlink($filename))
                {
                    echo "file ".$filename." has been deleted";
                }
            }
        }
        closedir($dir);
        ?>
</body>
</html>