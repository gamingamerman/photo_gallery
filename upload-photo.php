<?php
include './includes/link.php';
session_start();

if (!isset($_SESSION["userID"])) {
  header('Location: login.php');
}

if(isset($_POST["send"])) {
  $id_author = $_SESSION['userID'];
  $name = $_POST["name"];
  $text_photo = "No text contained";
  $enabled = 0;
  $photo_name = $_FILES["file"]["name"];
  $photo_size = $_FILES["file"]["size"];
  $photo_loc = $_FILES["file"]["name"];

  if (isset($_POST["text_photo"])) {
    $text_photo = $_POST["text_photo"];
  }

  if (isset($_POST["enabled"])) {
    $enabled = 1;
  } else {
    $enabled = 0;
  }

  $stmt = $link->stmt_init();

  $stmt->prepare('INSERT INTO images (id, author_id, name, file, size, text, enabled, created) VALUES (NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
  $stmt->bind_param('issisi', $id_author, $photo_name, $photo_loc, $photo_size, $text_photo, $enabled);

  $stmt->execute();
  $stmt->close();

  header('Location: photo-page.php');
  die();
};
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhotoMenu - Upload</title>
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
        <h1 class="title">PHOTOMENU</h1>
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
      <legend>Upload Photo</legend>
      <form action="" method="post" enctype="multipart/form-data">
        <p>
          <label for="name" class="float">*Name:
            <input type="text" name="name" placeholder="Name..." required>
          </label>
        </p>
        <p>
          <label for="text_photo" class="float">Text:
            <input type="text" name="text_photo">
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
          <input type="submit" name="send" value="Upload">
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