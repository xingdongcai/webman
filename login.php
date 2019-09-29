<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Famox - Login</title>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
<?php
if(empty($_POST["uname"]))
    {   ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post" action="login.php">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" name="uname" class="form-control" placeholder="User name" required="required" autofocus="autofocus">
              <label for="inputEmail">User name</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="pword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <hr>
          </div>
            <input class="btn btn-primary btn-block" type="submit" value="Login" >
        </form>

      </div>
    </div>
  </div>
<?php }else{
    include("connection.php");

    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh = new PDO($dsn,$UName,$PWord);
    $stmt = $dbh->prepare("SELECT uname FROM admin WHERE uname = ? AND pword = ?");
    $pword = hash('sha256', $_POST["pword"]);

    $stmt->execute([$_POST["uname"], $pword]);

    $result = $stmt->fetchObject();
    if(!empty($result))
    {
        echo "Welcome to our site $result->uname";
        $_SESSION["access_status"] = true;
        header("Location:clients/index.php");
    }
    else
    {
        echo "Sorry, login details incorrect";
    }
} ?>

</body>
</html>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>