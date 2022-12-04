<?php
include './includes/link.php';
session_start();

if (!isset($_SESSION["userID"])) {
  header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>PhotoMenu - Authors</title>
</head>
<body>
  <h2>Authors</h2>
  <?php
  $sql3 = 'SELECT * FROM authors WHERE id = ' . $_SESSION['userID'];
  $result3 = $link->query($sql3);
  $row3 = $result3->fetch_array();
  ?>
  <p>Hi, <?= $row3['name'] ?></p>
  <a href="photo-page.php">Back</a>
  <table border="1">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>eMail</th>
      <th>Created</th>
      <th>Enabled</th>
    </thead>
    <tbody>
      <?php
      $sql = 'SELECT * FROM authors';
      $result = $link->query($sql);

      while ($row = $result->fetch_array()) :
      ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['created'] ?></td>
        <td>
          <?php
          if ($row['enabled'] == 1) {
            echo '<img src="./img/active.png" alt="enabled">';
          } else {
            echo '<img src="./img/inactive.png" alt="disabled">';
          }
          ?>
        </td>
      </tr>
      <?php
      endwhile;
      ?>
    </tbody>
  </table>
</body>
</html>