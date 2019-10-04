<?php
include("../loginCheck.php");
require "../vendor/autoload.php";
include("../connection.php");
include("CreatePDF.php");
include("../templateTop.html")
?>

<div class="container-fluid">
    <h1>Create PDF</h1>
    <?php
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh = new PDO($dsn,$UName,$PWord);

    $stmt = $dbh->prepare("SELECT * FROM client ORDER BY client_id");
    $stmt->execute();
    $allRows=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //Column titles
    $header = array('Cust. No', 'Name', 'Address', 'Contact');
    //Column Widths
    $headerWidth=array(100,250,300,200);

    //create new instance of my CreatePDF class
    $PDF = new CreatePDF();

    //pass it headers, headerWidth and data
    $table = $PDF->CustomerPDF($header, $headerWidth, $allRows);

    echo $table;
    ?>
    <br/>
    <center><button class="btn-primary btn" OnClick="window.location='PDFs/Customers.pdf'">Click here to see PDF</button></center>
    <br/>
    <?php include("../displayPHP.php")   ?>
</div>


<?php
include("../templateBottom.html")
?>

