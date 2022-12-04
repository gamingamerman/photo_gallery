<?php
include './includes/link.php';
session_start();

if (!isset($_SESSION["userID"])) {
  header('Location: login.php');
}

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>PhotoMenu</title>
  <style>
    .title {
      color: white;
      margin-left: 10px
    }

    .home {
      color: white;
      text-decoration: none;
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
  <p>Hi, <?= $row3['name'] ?></p>
  <table border="1" class="table table-bordered">
    <thead class="head-table">
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
        if ($row['enabled'] == 1):
      ?>
      <tr>
        <td><img src="./img/<?= $row['name'] ?>" alt=""></td>

        <?php
        $sql2 = 'SELECT id, name FROM authors';
        $result2 = $link->query($sql2);

        while ($row2 = $result2->fetch_array()) :
          if ($row2['id'] == $row['author_id']) :
        ?>

        <td><?= $row2['name'] ?></td>
        <td><?= $row['text'] ?></td>

        <td class="centered">
          <?php
          if ($row['author_id'] == $_SESSION['userID']):
          ?>
          <!-- <button class="btn-centered btn-edit"><a href="modify-photo.php?id=<?= $row['id'] ?>">Edit</a></button> -->
          <a href="modify-photo.php?id=<?= $row['id'] ?>"><button class="btn-centered btn-edit">Edit</button></a>
          <?php else: ?>
          <p>You can't edit this image.</p>
          <?php endif; ?>
        </td>
        
        <?php
        endif;
        endwhile;
        ?>
        <?php
        ?>
      </tr>
      <?php
      endif;
      endwhile;
      ?>
    </tbody>
  </table>
  <p>
    
  
  </p>
</body>
</html>