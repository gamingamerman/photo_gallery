<?php
include './includes/link.php';
session_start();

if (!isset($_SESSION["userID"])) {
  header('Location: login.php');
}

if(isset($_POST["send"])) {
  $id_author = $_SESSION['userID'];
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

  //meter imagen en img desde cualquier dir
  // move_uploaded_file($_FILES["file"]["tmp_name"], "/img");

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

      .title {
      color: white;
      margin-left: 10px
    }

    .head-table{
      background-color: #454545;
      color: white;
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

    .centered {
      text-align:center;
    }

    .btn-centered {
      margin-top: 50%;
      
    }

    .btn-edit {
      border: transparent;
      color: white;
      background-color: black;
      border-radius: 5px;
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
          <label for="text_photo" class="float">Description:
            <input type="text" name="text_photo" placeholder="Add some description...">
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