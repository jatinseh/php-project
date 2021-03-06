<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'includes/head.html'; ?>
  <link href="css/signin.css" rel="stylesheet">
</head>

<body>
  <form method="POST" class="form-signin">
    <div class="text-center mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Log in </h1>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
      <label for="inputUsername">Username</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
      <label for="inputPassword">Password</label>
    </div>
    <div class="row">
      <button class="col-6 btn btn-lg btn-primary btn-block border" type="submit" name="sub">Log In</button>
      <a class="col-6 btn btn-lg btn-primary border" href="index.php">Cancel</a>
    </div>
    <p class="mt-5 mb-3 text-muted text-center">&copy;<?php echo date('Y') ?></p>
    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      require_once 'config.php';
      $link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
      if (mysqli_connect_error())
        die(mysqli_connect_error());
      $u = mysqli_real_escape_string($link, $_POST['inputUsername']);
      $p = mysqli_real_escape_string($link, $_POST['inputPassword']);
      $sql = "SELECT * FROM accounts WHERE username='$u' AND password='$p'";
      if ($r = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($r) == 1) {
          $_SESSION['login_user'] = $u;
          header("location: welcome.php");
        }
      } else {
        $error = "Invalid Credentials";
      }
      mysqli_close($link);
    }
    ?>
</body>

</html>