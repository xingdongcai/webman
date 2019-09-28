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
        window.location='CustModify.php?clientid=<?php echo $_GET["clientid"]; ?>&Action=ConfirmDelete';
    }
</script>
<center><h3>Customer Modification</h3></center>
<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM client WHERE client_id =".$_GET["clientid"];
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <form method="post" action="CustModify.php?clientid=<?php echo $_GET["clientid"]; ?>&Action=ConfirmUpdate">
        <center>Customer details amendment<br /></center><p />
        <table align="center" cellpadding="3">
            <tr />
            <td><b>Cust. No.</b></td>
            <td><?php echo $row->client_id; ?></td>
            </tr>
            <tr>
                <td><b>Cust. Firstname</b></td>
                <td><input type="text" name="fname" size="30" value="<?php echo $row->client_gname; ?>"></td>
            </tr>
            <tr>
                <td><b>Cust. Surname</b></td>
                <td><input type="text" name="sname" size="30" value="<?php echo $row->client_fname; ?>"></td>
            </tr>
            <tr>
                <td><b>Cust. Address</b></td>
                <td><input type="text" name="street" size="40" value="<?php echo $row->client_street; ?>"></td>
            </tr>
            <tr>
                <td><b>Cust. suburb</b></td>
                <td><input type="text" name="suburb" size="10" value="<?php echo $row->client_suburb; ?>"></td>
            </tr>
            <tr>
                <td><b>State</b></td>
                <td><input type="text" name="state" size="10" value="<?php echo $row->client_state; ?>">
                </td>
            </tr>
            <tr>
                <td><b>Postcode</b></td>
                <td><input type="text" name="postcode" size="10" value="<?php echo $row->client_pc; ?>">
                </td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td><input type="text" name="email" size="30" value="<?php echo $row->client_email; ?>">
                </td>
            </tr>
            <tr>
                <td><b>Mobile</b></td>
                <td><input type="text" name="mobile" size="15"
                           value="<?php echo $row->client_mobile; ?>"></td>
            </tr>
            <tr>
                <td><b>Mailing List</b></td>
                <td><input type="number" name="mailinglist" size="5"
                           value="<?php echo $row->client_mailinglist; ?>"></td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update Customer"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='index.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE client set client_gname='$_POST[fname]',
	            client_fname='$_POST[sname]', client_street='$_POST[street]',
	            client_suburb='$_POST[suburb]',client_state='$_POST[state]',client_pc='$_POST[postcode]',
                client_email='$_POST[email]',client_mobile='$_POST[mobile]', client_mailinglist='$_POST[mailinglist]'
                WHERE client_id =".$_GET["clientid"];

    $stmt = $dbh->prepare($query);
    $stmt->execute();

    header("Location: index.php");

    break;

case "Delete":
    ?>
    <center>Confirm deletion of the following customer record<br /></center><p />
    <table align="center" cellpadding="3">
        <tr />
        <td><b>Cust. No.</b></td>
        <td><?php echo $row->client_id; ?></td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td><?php echo "$row->client_gname $row->client_fname"; ?></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();">
            <td><input type="button" value="Cancel" OnClick="window.location='index.php'"></td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM client WHERE client_id =".$_GET["clientid"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>
<center>
    The following customer record has been successfully deleted<p />
    <?php
    echo "Customer No. $row->client_id $row->client_gname $row->client_fname";
    echo "</center><p />";
    }
    else
    {
        echo "<center>Error deleting customer record<p /></center>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"index.php\"'></center>";
    break;
    }
    $stmt->closeCursor();
    ?>
</body>
</html>
