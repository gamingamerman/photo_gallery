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
    echo 'Las contraseñas son distintas';
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
  <script src=".js/login.js"></script>
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

    .content {
      text-align: left;
    }

    input {
      border-radius: 5px;
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
  <fieldset>
    <legend>Register Page</legend>
    <form action="" method="post" name="registerForm">
      <p class="content">
        <label for="user">Username: </label>
        <input type="text" name="user" id="user" required>
      </p>
      <p class="content">
        <label for="email">eMail: </label>
        <input type="email" name="email" id="email" required>
      </p>
      <p class="content">
        <label for="pass">Password: </label>
        <input type="text" name="pass" id="pass" required>
      </p>
      <p class="content">
        <label for="passC">Confirm password: </label>
        <input type="text" name="passC" id="passC" required>
      </p>
      <p><input type="submit" name="register" value="Register"></p>
    </form>
  </fieldset>
</body>
</html>