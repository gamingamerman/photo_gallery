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
  <style>
    .back {
      margin-top: 20px
      text-align: center;
      font-size: 25px
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
  <h2>Authors</h2>
  <?php
  $sql3 = 'SELECT * FROM authors WHERE id = ' . $_SESSION['userID'];
  $result3 = $link->query($sql3);
  $row3 = $result3->fetch_array();
  ?>
  <p>Hi, <?= $row3['name'] ?></p>
  <table border="1" class="table table-bordered">
    <thead class="head-table">
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
  <br>
  <p class="back">
    <a href="photo-page.php">Back</a>
  </p>
</body>
</html>