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
</head>
<body>
<?php
$sql3 = 'SELECT * FROM authors WHERE id = ' . $_SESSION['userID'];
$result3 = $link->query($sql3);
$row3 = $result3->fetch_array();
?>
<p>Hi, <?= $row3['name'] ?></p>
<a href="photo-page.php">Back</a>
  <fieldset>
    <legend>Modify Photo</legend>
    <form action="" method="post" enctype="multipart/form-data">
      <p>
        <p>Description:</p>
        <input type="text" name="text_photo" value="<?= $row['text'] ?>">
      </p>
      <p>
        Enabled: <input type="checkbox" name="enabled" <?php if ($row['enabled'] == 1):?> checked <?php endif;?>>
      </p>
      <p>
        <h3>Photo:</h3>
        <br>
        <input type="file" name="file">
      </p>
      <input type="submit" name="modify" value="Modify">
    </form>
  </fieldset>
</body>
</html>