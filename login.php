<?php 
include './includes/link.php';

if (isset($_POST['login'])) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $sql = 'SELECT name, password FROM authors';
  $result = $link->query($sql);
  $row = $result->fetch_array();

  while ($row){
    if ($user == $row['name'] && $pass == $row['password']) {
      header('Location: photo-page.php');
      die();
    }

    $row = $result->fetch_array();

    if ($row == null) {
      echo '<h1>El usuario no existe.</h1>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery - Log In</title>
  <script src=".js/login.js"></script>
  <style>
    body {
      text-align: center;
    }

    fieldset {
      border-radius: 10px;
      font-size: x-large;
      display: inline-block;
      border-collapse: collapse;
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -150px 0 0 -165px;
    }

    input {
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <fieldset>
    <legend>Login Page</legend>
    <form action="" method="post">
      <p>
        <label for="user">Username:
          <input type="text" name="user" id="user" required>
        </label>
      </p>
      <p>
        <label for="pass">Password:
          <input type="text" name="pass" id="pass" required>
        </label>
      </p>
      <p>
        <input type="submit" name="login" value="Log In">
        <a href="register.php"><input type="button" value="Register"></a>
      </p>
    </form>
  </fieldset>
</body>
</html>