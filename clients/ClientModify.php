<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Famox - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Famox</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Categories</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Clients</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Projects</span></a>
        </li>

    </ul>

    <div id="content-wrapper">
        <center><h3>Customer Modification</h3></center>
        <div class="container-fluid"
        <?php
        include("../connection.php");
        $dsn= "mysql:host=$Host;dbname=$DB";
        $dbh = new PDO($dsn,$UName,$PWord);
        $query="SELECT * FROM client WHERE client_id =".$_GET["clientid"];
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $row=$stmt->fetchObject();

        $strAction = $_GET["Action"];

        switch($strAction) {
            case "Update":
                ?>
                <form method="post"
                      action="../clients/ClientModify.php?clientid=<?php echo $_GET["clientid"]; ?>&Action=ConfirmUpdate">
                    <center>Customer details amendment<br/></center>
                    <p/>
                    <table align="center" cellpadding="3">
                        <tr/>
                        <td><b>Client. No.</b></td>
                        <td><?php echo $row->client_id; ?></td>
                        </tr>
                        <tr>
                            <td><b>Firstname</b></td>
                            <td><input type="text"  class="form-label-group"    name="fname" size="25" value="<?php echo $row->client_gname; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Surname</b></td>
                            <td><input type="text" name="sname" size="25" value="<?php echo $row->client_fname; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Street</b></td>
                            <td><input type="text" name="street" size="40"
                                       value="<?php echo $row->client_street; ?>"></td>
                        </tr>
                        <tr>
                            <td><b>Suburb</b></td>
                            <td><input type="text" name="suburb" size="10"
                                       value="<?php echo $row->client_suburb; ?>"></td>
                        </tr>
                        <tr>
                            <td><b>State</b></td>
                            <td><input type="text" name="state" size="10" value="<?php echo $row->client_state; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Postcode</b></td>
                            <td><input type="text" name="posscode" size="10" value="<?php echo $row->client_pc; ?>">
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
                    </table>
                    <br/>
                    <table align="center">
                        <tr>
                            <td><input type="submit"   class="btn btn-primary btn-block"     value="Update Customer"></td>
                            <td><input type="button"  class="btn btn-primary btn-block"      value="Return to List" OnClick="window.location='index.php'"></td>
                        </tr>
                    </table>
                </form>
                <?php
                break;
            case "ConfirmUpdate":
                $query="UPDATE client set client_gname='$_POST[fname]',
	            client_fname='$_POST[sname]', client_street='$_POST[street]',
	            client_suburb='$_POST[suburb]',client_state='$_POST[state]',client_pc='$_POST[postcode]',
                client_email='$_POST[email]',client_mobile='$_POST[mobile]' 
                WHERE client_id =".$_GET["clientid"];
                $stmt = $dbh->prepare($query);
                $stmt->execute();

                header("Location:index.php");

                break;
        }
        ?>
        </div>


        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Famox 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="../vendor/datatables/jquery.dataTables.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="../js/sb-admin.min.js"></script>
<!-- Demo scripts for this page-->
<script src="../js/demo/datatables-demo.js"></script>
</body>
</html>

