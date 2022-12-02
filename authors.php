<?php
include './includes/link.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhotoMenu - Authors</title>
</head>
<body>
  <h2>Authors</h2>
  <a href="photo-page.php">Back</a>
  <table border="1">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>eMail</th>
      <th>Created</th>
      <th>Enable</th>
      <th>Delete</th>
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
          if ($row['enabled'] == 1):
            echo '<img src="./img/active.png" alt="enabled">';
          else:
            echo '<img src="./img/inactive.png" alt="disabled">';
          endif;
          ?>
        </td>
        <td>
          <button>X</button>
        </td>
      </tr>
      <?php
      endwhile;
      ?>
    </tbody>
  </table>
</body>
</html>