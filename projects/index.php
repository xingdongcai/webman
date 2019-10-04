<?php
session_start();
ob_start();

if($_SESSION["access_status"] != true){
    header("Location: ../login.php");
    exit;
}

include("../connection.php");
$dsn = "mysql:host=$Host;dbname=$DB;";
$dbh = new PDO($dsn, $UName, $PWord);
$stmt = $dbh->prepare("select * from project");
$stmt->execute();

include("../templateTop.html")
?>










    <div id="content-wrapper">
            <form method="post" action="index.php">
                <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="btn-block btn btn-primary"     href="../projects/add.php">Add Project</a>
                        </li>
                    </ol>
                    <!-- DataTables -->

                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            Project Table
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Project description</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Project description</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php while($row = $stmt->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $row[1];  ?></td>
                                            <td><?php echo $row[2];  ?></td>
                                            <td><?php echo $row[3];  ?></td>
                                            <td>
                                                <a href="../projects/ProjectModify.php?projectId=<?php echo $row[0];?>&Action=Delete">Delete</a>
                                            </td>
                                            <td>
                                                <a href="../projects/ProjectModify.php?projectId=<?php echo $row[0];?>&Action=Update">Edit</a>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    //$stmt->closeCursor();
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Famox</div>
                    </div>


                </div>

            </form>
            <!-- /.container-fluid -->

        <?php include("../displayPHP.php")   ?>

        </div>





<?php include("../templateBottom.html") ?>

    <script>
        $('#dataTable').dataTable( {
            "columns": [
                null,
                null,
                null,
                { "orderable": false,"bSearchable": false },
                { "orderable": false,"bSearchable": false}
            ]
        } );
    </script>



<?php
function logout() {
    unset($_SESSION["access_status"]);
    header("Location: ../login.php");
}
if (isset($_GET['logout'])) {
    logout();
}
?>