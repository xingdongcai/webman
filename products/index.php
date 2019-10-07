<?php
include("../loginCheck.php");

include("../connection.php");
$dsn = "mysql:host=$Host;dbname=$DB;";
$dbh = new PDO($dsn, $UName, $PWord);
$stmt = $dbh->prepare("select * from product");
$stmt->execute();

include("../templateTop.html")
?>


        <div id="content-wrapper">
            <form method="post" action="index.php">
                <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="btn-block btn btn-primary"     href="../products/add.php">Add Product</a>
                        </li>
                    </ol>






                    <!-- DataTables -->

                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            Product Table
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Product name</th>
                                        <th>Purchase price($)</th>
                                        <th>Sale price($)</th>
                                        <th>Country</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Product name</th>
                                        <th>Purchase price($)</th>
                                        <th>Sale price($)</th>
                                        <th>Country</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php while($row = $stmt->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $row[1];  ?></td>
                                            <td><?php echo "$".$row[2];  ?></td>
                                            <td><?php echo "$".$row[3];  ?></td>
                                            <td><?php echo $row[4];  ?></td>
                                            <td>
                                                <a href="../products/ProductModify.php?productId=<?php echo $row[0];?>&Action=Delete">Delete</a>
                                            </td>
                                            <td>
                                                <a href="../products/ProductModify.php?productId=<?php echo $row[0];?>&Action=Update">Edit</a>
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
        <!-- /.content-wrapper -->

<?php include("../templateBottom.html") ?>

    <script>
        $('#dataTable').dataTable( {
            searching:false,
            "columns": [
                null,
                null,
                null,
                null,
                { "orderable": false },
                { "orderable": false }
            ]
        } );
    </script>
