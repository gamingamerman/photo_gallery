<?php
include './includes/link.php';
session_start();

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header('Location: login.php');
}
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
  <h2>Photo Gallery</h2>
  <table border="1">
    <thead>
      <th>Photo</th>
      <th>Author</th>
      <th>Description</th>
      <th>Options</th>
    </thead>
    <tbody>
    <?php
    $sql = 'SELECT * FROM images';
    $result = $link->query($sql);
    
    while ($row = $result->fetch_array()):
    ?>
      <tr>
        <td><img src="/img/<?=$row['name']?>" alt=""></td>

        <?php
        $sql2 = 'SELECT id, name FROM authors';
        $result2 = $link->query($sql2);

        while ($row2 = $result2->fetch_array()):
          if ($row2['id'] == $row['author_id']):
        ?>

        <td><?=$row2['name']?></td>
        <td><?=$row['text']?></td>

        <?php
        endif;
        endwhile;
        ?>
        <td><button>Edit</button></td>
      </tr>
        <?php
        endwhile;
        ?>
    </tbody>
  </table>
  <p>
    <a href="upload-photo.php"><button>Upload Image</button></a>
    <form action="" method="post">
      <button name="logout">Log Out</button>
    </form>
  </p>
</body>
</html>