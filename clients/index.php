<?php
include("../loginCheck.php");
include("../connection.php");
$dsn = "mysql:host=$Host;dbname=$DB;";
$dbh = new PDO($dsn, $UName, $PWord);
$stmt = $dbh->prepare("select * from client");
$stmt->execute();
?>

<?php include("../templateTop.html") ?>

    <div id="content-wrapper">
        <form method="post" action="index.php">
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a class="btn-block btn btn-primary"     href="../clients/add.php">Add Client</a>
          </li>
        </ol>

        <!-- DataTables -->

          <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Client Table
          </div>

          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Street</th>
                    <th>Surburb</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>List</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Street</th>
                    <th>Surburb</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>List</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                </tfoot>
                <tbody>

                <?php while($row = $stmt->fetch()){
                ?>
                    <tr>
                        <td><?php echo $row[1]." ".$row[2];  ?></td>
                        <td><?php echo $row[3];  ?></td>
                        <td><?php echo $row[4];  ?></td>
                        <td><?php echo $row[5];  ?></td>
                        <td><?php echo $row[6];  ?></td>
                        <td><?php echo $row[7];  ?></td>
                        <td><?php echo $row[8];  ?></td>
                        <td><?php
                            if ($row[9]==0){
                                echo "No";
                            }else{
                                echo "Yes";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="../clients/CustModify.php?clientid=<?php echo $row[0];?>&Action=Delete">Delete</a>
                        </td>
                        <td>
                            <a href="../clients/CustModify.php?clientid=<?php echo $row[0];?>&Action=Update">Edit</a>
                        </td>

                    </tr>
                <?php
                }
                ?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Famox</div>
        </div>

          <!--PDF Creation-->
          <ol class="breadcrumb">
              <li class="breadcrumb-item ">
                  <a class="btn-block btn btn-primary" target="_blank"  href="list.php">Generate PDF</a>
              </li>
          </ol>

      </div>

        </form>
        <?php include("../displayPHP.php")   ?>

    </div>

<?php include("../templateBottom.html") ?>

<script>
    $('#dataTable').dataTable( {
        "columns": [
            null,
            { "orderable": false },
            null,
            null,
            null,
            null,
            null,
            null,
            { "orderable": false },
            { "orderable": false }
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