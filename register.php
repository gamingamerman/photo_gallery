<?php 
include './includes/link.php';

if(isset($_POST['register'])) {
  $null = NULL;
  $user = $_POST['user'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $passC = $_POST['passC'];
  $enabled = 1;

  if ($pass == $passC) {
    $stmt = $link->stmt_init();
    
    $stmt->prepare('INSERT INTO authors (id, name, email, password, enabled, created) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
    $stmt->bind_param('sssi',$user, $email, $pass, $enabled);

    $stmt->execute();
    $stmt->close();

    header('Location: login.php');
    die();

  } else {
    echo '<div style="background-color: #cc3b3b;">Las contraseñas son distintas</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery - Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      text-align: center;
    }

    fieldset {
      border-radius: 10px;
      font-size: x-large;
      width: 400px;
      display: inline-block;
      border-collapse: collapse;
      margin: auto;
    }

    .title {
      color: white;
      margin-left: auto;
      margin-right: auto;
    }

    .content {
      text-align: left;
    }

    input {
      border-radius: 5px;
    }

    .hide {
      border: transparent;
      margin: 10px;
      color: white;
    }
  </style>
</head>
<body>
  <?php
  if(isset($_POST['register'])) {
    $null = NULL;
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $passC = $_POST['passC'];
    $enabled = 1;

    if ($pass == $passC) {
      $stmt = $link->stmt_init();
      
      $stmt->prepare('INSERT INTO authors (id, name, email, password, enabled, created) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
      $stmt->bind_param('sssi',$user, $email, $pass, $enabled);

      $stmt->execute();
      $stmt->close();
    }
  }
  ?>
  <header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h1 class="title">PHOTOMENU</h1>
  </nav>
  </header>
  <fieldset>
    <a href="login.php">Back</a>
    <legend><h2>Register Page</h2></legend>
    <form action="" method="post" name="registerForm">
      <p class="content">
        <label for="user">Username: </label>
        <input type="text" name="user" id="user" class="form-control" required>
      </p>
      <p class="content">
        <label for="email">eMail: </label>
        <input type="email" name="email" id="email" class="form-control" required>
      </p>
      <p class="content">
        <label for="pass">Password: </label>
        <input type="password" name="pass" id="pass" class="form-control" required>
      </p>
      <p class="content">
        <label for="passC">Confirm password: </label>
        <input type="password" name="passC" id="passC" class="form-control" required>
      </p>
      <p>
        <label for="enable">Enable: </label>
        <input type="checkbox" name="enable" id="enable">
      </p>
      <p><input type="submit" name="register" value="Register" class="hide bg-dark"></p>
    </form>
  </fieldset>
</body>
</html>