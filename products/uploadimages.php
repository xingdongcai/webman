<?php if (!isset($_FILES["userfile"]["tmp_name"]))
{
    ?>
    <form method="post" enctype="multipart/form-data" action="uploadimages.php">
        <table border="0">
            <tr>
                <td><b>Select a file to upload:</b><br>
                    <input type="file" size="50" name="userfile">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Upload File"> </td>
            </tr>
        </table>
    </form>
    <?php
}else{
    // specify a directory name for permanent storage
// we're going to leave the filename as it was on client machine

    $upfile = "../product_images/".$_FILES["userfile"]["name"];
// the next line does the actual work
//moved the uploaded file from temporary location to permanent storage location
//if this doesn't work an error message is displayed
    if(!move_uploaded_file($_FILES["userfile"] ["tmp_name"],$upfile))
    {
        echo "ERROR: Could Not Move File into Directory";
    }
//if the upload works, some information about the file is displayed to the user
    else
    {
        echo "Temporary File Name: " .$_FILES["userfile"] ["tmp_name"]."<br />";
        echo "File Name: " .$_FILES["userfile"]["name"]. "<br />";
        echo "File Size: " .$_FILES["userfile"]["size"]. "<br />";
        echo "File Type: " .$_FILES["userfile"]["type"]. "<br />";
    }
}
