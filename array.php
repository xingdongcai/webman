<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admin";
$result = $conn->query($sql);


while ($row = $result->fetch_object()) {
    ?>

    <tr>
        <td><?php echo $row->uname; ?></td>
        <td><?php echo $row->pword; ?></td>
    </tr>


    <?php
}

mysqli_free_result($result);
mysqli_close($conn);
?>

<script type="text/javascript" src="RowColours.js"></script>
