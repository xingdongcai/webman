<?php
include("../loginCheck.php");
include('../templateTop.html');
?>

<script language="javascript">
    function confirm_delete()
    {
        window.location='CustModify.php?clientid=<?php echo $_GET["clientid"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php
include("../connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);
$query="SELECT * FROM client WHERE client_id =".$_GET["clientid"];
$stmt = $dbh->prepare($query);
if(!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    $stmt->execute();
}
$row=$stmt->fetchObject();

$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <form method="post" action="CustModify.php?clientid=<?php echo $_GET["clientid"]; ?>&Action=ConfirmUpdate">
                <center><h3>Customer details amendment</h3><br /></center><p />
                <table class="table table-bordered" align="center" cellpadding="3">
                    <tr />
                    <td><b>Client. No.</b></td>
                    <td><?php echo $row->client_id; ?></td>
                    </tr>
                    <tr>
                        <td><b>Client. Firstname</b></td>
                        <td><input class="border" type="text" name="fname" size="30" value="<?php echo $row->client_gname; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Client. Surname</b></td>
                        <td><input class="border" type="text" name="sname" size="30" value="<?php echo $row->client_fname; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td><input class="border" type="text" name="street" size="40" value="<?php echo $row->client_street; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Suburb</b></td>
                        <td><input class="border" type="text" name="suburb" size="10" value="<?php echo $row->client_suburb; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>State</b></td>
                        <td><input class="border" type="text" name="state" size="10" value="<?php echo $row->client_state; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Postcode</b></td>
                        <td><input class="border" type="text" name="postcode" size="10" value="<?php echo $row->client_pc; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td><input class="border" type="text" name="email" size="30" value="<?php echo $row->client_email; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Mobile</b></td>
                        <td><input class="border" type="text" name="mobile" size="15"
                                   value="<?php echo $row->client_mobile; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Mailing List</b></td>

                        <td>
                            <div>
                                <select name="mailinglist">
                                    <?php if($row->client_mailinglist ==0){
                                        echo "<option value=1>Yes</option>
                                          <option value=0 selected>No</option>";
                                    }else{
                                        echo "<option value=1 selected>Yes</option>
                                          <option value=0>No</option> ";
                                    }  ?>

                                </select>
                            </div>
                        </td>
                    </tr>

                </table>
                <br/>
                <table align="center">
                    <tr>
                        <td><input class="btn btn-primary" type="submit" value="Update"></td>
                        <td><input class="btn btn-secondary" type="button" value="Return to List" OnClick="window.location='index.php'"></td>
                    </tr>
                </table>
            </form>
        </div>
        <?php include("../displayPHP.php")   ?>
    </div>

    <?php
    break;

case "ConfirmUpdate":
    $query="UPDATE client set client_gname='$_POST[fname]',
	            client_fname='$_POST[sname]', client_street='$_POST[street]',
	            client_suburb='$_POST[suburb]',client_state='$_POST[state]',client_pc='$_POST[postcode]',
                client_email='$_POST[email]',client_mobile='$_POST[mobile]', client_mailinglist='$_POST[mailinglist]'
                WHERE client_id =".$_GET["clientid"];

    $stmt = $dbh->prepare($query);
    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        $stmt->execute();
    }

    header("Location: index.php");

    break;

case "Delete":
    ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <center><h3>Confirm deletion of the following customer record</h3></center>
            <br>
            <table class="table-bordered " align="center">
                <tr>
                    <td><b>Client. No.</b></td>
                    <td><?php echo $row->client_id; ?></td>
                </tr>
                <tr>
                    <td><b>Name</b></td>
                    <td><?php echo "$row->client_gname $row->client_fname"; ?></td>
                </tr>
            </table>
            <br>

            <table align="center">
                <tr>
                    <td><input class="btn btn-primary" type="button" value="Confirm" OnClick="confirm_delete();">
                    <td><input class="btn btn-secondary" type="button" value="Cancel" OnClick="window.location='index.php'"></td>
                </tr>
            </table>
        </div>
        <?php include("../displayPHP.php")   ?>
    </div>


    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM client WHERE client_id =".$_GET["clientid"];
$stmt = $dbh->prepare($query);
if($stmt->execute())
{
?>
    <div class="container-fluid">
        <h3 align="center">The following customer record has been successfully deleted</h3><p />
        <?php
        echo "<h5 align='center'>Customer No. $row->client_id $row->client_gname $row->client_fname</h5>";
        echo "</center><p />";
        }
        else
        {
            echo "<center>Error deleting customer record<p /></center>";
        }
        echo "<center><input class='btn btn-secondary' type='button' value='Return to List' OnClick='window.location=\"index.php\"'></center>";
        break;
        }
        $stmt->closeCursor();
        ?>
    </div>


<?php include('../templateBottom.html'); ?>
