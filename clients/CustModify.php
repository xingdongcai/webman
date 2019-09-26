<?php
ob_start();
?>
<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<script language="javascript">
    function confirm_delete()
    {
        window.location='CustModify.php?custno=<?php echo $_GET["custno"]; ?>&Action=ConfirmDelete';
    }
</script>
<center><h3>Customer Modification</h3></center>
<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM Customer WHERE cust_no =".$_GET["custno"];
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <form method="post" action="CustModify.php?custno=<?php echo $_GET["custno"]; ?>&Action=ConfirmUpdate">
        <center>Customer details amendment<br /></center><p />
        <table align="center" cellpadding="3">
            <tr />
            <td><b>Cust. No.</b></td>
            <td><?php echo $row->cust_no; ?></td>
            </tr>
            <tr>
                <td><b>Cust. Firstname</b></td>
                <td><input type="text" name="fname" size="30" value="<?php echo $row->firstname; ?>"></td>
            </tr>
            <tr>
                <td><b>Cust. Surname</b></td>
                <td><input type="text" name="sname" size="30" value="<?php echo $row->surname; ?>"></td>
            </tr>
            <tr>
                <td><b>Cust. Address</b></td>
                <td><input type="text" name="address" size="40" value="<?php echo $row->address; ?>"></td>
            </tr>
            <tr>
                <td><b>Cust. Contact</b></td>
                <td><input type="text" name="contact" size="10" value="<?php echo $row->contact; ?>"></td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update Customer"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='example0603.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE Customer set firstname='$_POST[fname]',
	            surname='$_POST[sname]', address='$_POST[address]',
	            contact='$_POST[contact]' WHERE cust_no =".$_GET["custno"];
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    header("Location: example0603.php");

    break;

case "Delete":
    ?>
    <center>Confirm deletion of the following customer record<br /></center><p />
    <table align="center" cellpadding="3">
        <tr />
        <td><b>Cust. No.</b></td>
        <td><?php echo $row->cust_no; ?></td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td><?php echo "$row->firstname $row->surname"; ?></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();">
            <td><input type="button" value="Cancel" OnClick="window.location='example0603.php'"></td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM Customer WHERE cust_no =".$_GET["custno"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>
<center>
    The following customer record has been successfully deleted<p />
    <?php
    echo "Customer No. $row->cust_no $row->firstname $row->surname";
    echo "</center><p />";
    }
    else
    {
        echo "<center>Error deleting customer record<p /></center>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"example0603.php\"'></center>";
    break;
    }
    $stmt->closeCursor();
    ?>
</body>
</html>
