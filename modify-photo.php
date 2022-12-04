<?php
use LDAP\Result;

include './includes/link.php';
session_start();

if (!isset($_SESSION["userID"])) {
  header('Location: login.php');
}

$sql = 'SELECT * FROM images WHERE id = ' . $_GET['id'];
$results = $link->query($sql);
$row = $results->fetch_assoc();

if (isset($_POST["modify"])):
  $text = $_POST["text_photo"];
  $enabled;

  if (isset($_POST["enabled"])):
    $enabled = 1;
  else:
    $enabled = 0;
  endif;

  if (!($_FILES["file"]['name'] == '')):
    $name = $_FILES["file"]["name"];
    $image_name = $_FILES["file"]["name"];
    $sql = "UPDATE images SET name='$name', text='$text', file='$image_name', enabled=$enabled WHERE id=" . $_GET['id'];
    $link->query($sql);

  else:
    $sql = "UPDATE images SET text='$text', enabled=$enabled WHERE id=" . $_GET['id'];
    $link->query($sql);
  endif;

  header('Location: photo-page.php');
  die();
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhotoMenu</title>
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

    .back {
      margin-top: 20px
      text-align: center;
      font-size: 25px
    }

    .home {
      color: white;
      text-decoration: none;
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
      margin-left: 20px;
      margin-right: auto;
    }

    .center {
      margin-left: auto;
      margin-right: auto;
    }

    .float {
      text-align: left;
    }

    .btn-border {
      border: transparent;
      color: black;
      background-color: white;
      border-radius: 10px;
      margin-left: 100px
    }

    .logout {
    margin-left:auto;
    margin-right:10px
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <h1 class="title"><a class="home" href="photo-page.php">PHOTOMENU</a></h1>
      <a href="upload-photo.php"><button class="btn-border">Upload Image</button></a>
      <a href="authors.php" ><button class="btn-border">Authors</button></a>
      <a href="your-images.php" ><button class="btn-border">Your Images</button></a>
      <form action="" method="post" class="logout">
        <button name="logout" class="btn-border">Log Out</button>
      </form>
    </nav>
  </header>
  <?php
  $sql3 = 'SELECT * FROM authors WHERE id = ' . $_SESSION['userID'];
  $result3 = $link->query($sql3);
  $row3 = $result3->fetch_array();
  ?>
  <p class="user">Hi, <?= $row3['name'] ?></p>
    <fieldset>
      <legend>Modify Photo</legend>
      <form action="" method="post" enctype="multipart/form-data">
        <p>
          <label for="text_photo" class="float">Description:
          <input type="text" name="text_photo" value="<?= $row['text'] ?>">
          </label>
        </p>
        <p class="float">
          <label for="enabled" class="float">Enabled:
            <input type="checkbox" name="enabled">
          </label>
        </p>
        <p>
          <label for="file" class="float">Photo:
            <input type="file" name="file" required>
          </label>
        </p>
        <br>
        <p>
          <input type="submit" name="modify" value="Modify">
        </p>
      </form>
    </fieldset>
    <br>
    <br>
    <p class="back">
      <a href="photo-page.php">Back</a>
    </p>
  </body>
</html>