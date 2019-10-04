<?php
include("../loginCheck.php");
include("../templateTop.html"); ?>
<?php
if (empty($_POST["fname"]))
{
?>
    <div class="container">
        <form method="POST"
              action="add.php">
            <center><h3>Customer details amendment</h3></center>
            <table class="table table-bordered" align="center" cellpadding="3">
                <tr>
                    <td><b>Firstname</b></td>
                    <td><input class="border" type="text" name="fname" size="20" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Surname</b></td>
                    <td><input class="border" type="text" name="sname" size="20" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Street</b></td>
                    <td><input class="border" type="text" name="street" size="45"></td>
                </tr>
                <tr>
                    <td><b>Suburb</b></td>
                    <td><input class="border" type="text" name="suburb" size="20" ></td>
                </tr>
                <tr>
                    <td><b>State</b></td>
                    <td><input class="border" type="text" name="state" size="15">
                    </td>
                </tr>
                <tr>
                    <td><b>Postcode</b></td>
                    <td><input class="border" type="text" name="postcode" size="10">
                    </td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td><input class="border" type="email" name="email" size="30" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Mobile</b></td>
                    <td><input class="border" type="number" name="mobile" size="15"></td>
                </tr>
                <tr>
                    <td><b>Mailing List</b></td>
                    <td>
                        <div>
                            <select name="mailinglist">
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </td>

<!--                    <td><input class="border" type="number" name="mailinglist" size="5"></td>-->
                </tr>
            </table>
            <br><br/>
            <table align="center">
                <tr>
                    <td><input class="btn btn-primary" type="submit"  value="Submit"></td>
                    <td><input class="btn btn-secondary" type="button"  value="Return to List"  OnClick="window.location='index.php'"></td>
                </tr>
            </table>
        </form>
        <?php include("../displayPHP.php")   ?>
    </div>


<?php
}else{
    include("../connection.php");
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh = new PDO($dsn,$UName,$PWord);
    $query = "INSERT INTO client (client_gname, client_fname, client_street, client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) 
                VALUES ('$_POST[fname]','$_POST[sname]', '$_POST[street]', '$_POST[suburb]', '$_POST[state]', '$_POST[postcode]', '$_POST[email]', '$_POST[mobile]', '$_POST[mailinglist]')";
    $stmt = $dbh->prepare($query);

    if(!$stmt->execute()) {
        $err = $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
        $stmt->execute();
    }else{
        ?>
        <script language="JavaScript">
            alert("Customer record successfully added");
        </script>
    <?php
        header("Location: index.php");
    }
}
?>

<?php include("../templateBottom.html"); ?>

