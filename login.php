<?php
include './includes/link.php';
session_start();
if (isset($_POST['login'])) {

  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $sql = 'SELECT id, name, password FROM authors';
  $result = $link->query($sql);

  while ($row = $result->fetch_array()) {
    if ($user == $row['name'] && $pass == $row['password']) {
      $_SESSION['userID'] = $row['id'];
      header('Location: photo-page.php');
      die();
    }
  }
  if ($row == null) {
    echo '<div style="background-color: #cc3b3b;">The user doesn\'t exist.</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photomenu - Log In</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      text-align: center;
    }

    .home {
      color: white;
      text-decoration: none;
    }

    fieldset {
      border-radius: 10px;
      font-size: x-large;
      width: 400px;
      display: inline-block;
      border-collapse: collapse;
      margin: auto;
    }

    .hide {
      border: transparent;
      margin: 10px;
      color: white;
    }

    input {
      border-radius: 5px;
    }

    .title {
      color: white;
      margin-left: auto;
      margin-right: auto;
    }

    .center {
      margin-left: auto;
      margin-right: auto;
    }

    .float {
      text-align: left;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <h1 class="title"><a class="home" href="login.php">PHOTOMENU</a></h1>
    </nav>
  </header>
  <fieldset>
    <legend>Login Page</legend>
    <form action="" method="post">
      <p>
        <label for="user" class="float">Username:
          <input type="text" name="user" id="user" class="form-control" required>
        </label>
      </p>
      <p class="">
        <label for="pass" class="float">Password:
          <input type="password" name="pass" id="pass" class="form-control" required>
        </label>
      </p>
      <p>
        <input type="submit" name="login" value="Log In" class="bg-primary hide bg-dark">
        <a href="register.php"><input type="button" value="Register" class="bg-primary hide bg-dark"></a>
      </p>
    </form>
  </fieldset>
</body>
</html>