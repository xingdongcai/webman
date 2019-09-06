<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php
$servername = "130.194.7.82";
$username = "s29211530";
$password = "monash00";
$dbname = "s29211530";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT id, description FROM category";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "</table> <tr><th>ID</th><th>DESCRIPTION</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["description"]." </td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

<script type="text/javascript" src="RowColours.js"></script>
