<?php
include("../loginCheck.php");
include("../connection.php");
$dsn = "mysql:host=$Host;dbname=$DB;";
$dbh = new PDO($dsn, $UName, $PWord);
$stmt = $dbh->prepare("select * from client where client_mailinglist!= 0");
if(!$stmt->execute()) {
    $err = $stmt->errorInfo();
    echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
    $stmt->execute();
}

include("../templateTop.html");
?>
    <div id="content-wrapper">

        <div class="container-fluid">
            <!-- Page Content -->

        </div>
        <form method="post" action="email.php">
        <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i>
                            Mailing List</div>
                        <div class="card-body">
                            <table class="table-bordered">
                                <tr>
                                    <th>Client Name</th>
                                    <th style="text-align:center">Email</th>
                                    <th>Send</th>
                                </tr>

                                <?php while($row = $stmt->fetch()){
                                    ?>
                                    <tr>
                                        <td><?php echo $row[1]," ",$row[2];  ?></td>
                                        <td style="text-align:center"><?php echo $row[7];  ?></td>
                                        <td style="text-align:center" ><input type="checkbox" name="check[]" value="<?php echo $row[0]; ?>"></td>
                                    </tr>
                                    <?php
                                }
                                $stmt->closeCursor();
                                ?>
                            </table><p/>
                        </div>
                    </div>
                </div>

            <?php
            if (!isset($_POST["check"]))
            {?>
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i>
                            Send Email</div>
                        <div class="card-body">
                            Subject:<br>
                            <input class="border" type="text" name="subject" size="50"  required><br>
                            Message:<br>
                            <td>
                                <textarea class="border" cols="68" name="message" rows="8" required></textarea>
                            </td>
                            <br><br>
                            <input type="submit" value="Send" class="btn btn-primary">
                            <input type="reset" value="Reset" class="btn btn-secondary">
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <?php
            }else{
                foreach($_POST["check"] as $id)
                {
                    $query="Select client_email FROM client WHERE client_id ='$id'";
                    $stmt = $dbh->prepare($query);
                    if(!$stmt->execute()) {
                        $err = $stmt->errorInfo();
                        echo "Error adding record to database – contact System Administrator Error is: <b>" . $err[2] . "</b>";
                        $stmt->execute();
                    }
                    else if($stmt->execute())
                    {
                        $row = $stmt->fetch();
                        $from = "From: Harry Helper<xcai0009@student.monash.edu>";
                        $to = $row[0];
                        $msg = $_POST["message"];
                        $subject = $_POST["subject"];
                        if(mail($to, $subject, $msg, $from))
                        {
                            echo "Mail Sent:  $row[0]<br/>";
                        }
                        else {
                            echo "Error Sending Mail:$row[0]";
                        }
                    }
                }



            }
            ?>
        </div>
        <?php include("../displayPHP.php")   ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->



<?php include("../templateBottom.html");?>
