<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM client";
$result = $conn->query($sql);


while ($row = $result->fetch_object()) {
    ?>

    <tr>
        <td><?php echo $row->client_gname; ?></td>
        <td><?php echo $row->client_fname; ?></td>
        <td><?php echo $row->client_street; ?></td>
    </tr>
    <br>


    <?php
}

mysqli_free_result($result);
mysqli_close($conn);
?>

<script type="text/javascript" src="RowColours.js"></script>