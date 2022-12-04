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
    <title>PhotoMenu</title>
  </head>
  <body>
    <h2>Upload a Photo to the Gallery</h2>
    <?php
    $sql3 = 'SELECT * FROM authors WHERE id = ' . $_SESSION['userID'];
    $result3 = $link->query($sql3);
    $row3 = $result3->fetch_array();
    ?>
    <p>Hi, <?= $row3['name'] ?></p>
    <a href="photo-page.php">Back</a>
    <fieldset>
      <legend>Upload</legend>
      <form action="" method="post" enctype="multipart/form-data">
        <p>
          * Name: <input type="text" name="name" placeholder="Name..." required>
        </p>
        <p>
          <label for="text_photo">Text:</label>
          <input type="text" name="text_photo">
        </p>
        <p>
          Enabled: <input type="checkbox" name="enabled">
        </p>
        <p>
          <h3>Photo:</h3>
          <br>
          <input type="file" name="file" required>
        </p>
        <input type="submit" name="send" value="Upload">
      </form>
    </fieldset>
  </body>
</html>