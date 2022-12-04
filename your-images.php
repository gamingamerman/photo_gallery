<?php
    include './includes/link.php';
    session_start();

    if (!isset($_SESSION["userID"])) {
        header('Location: login.php');
    }

    $sql = "SELECT * FROM images WHERE author_id=" . $_SESSION["userID"];

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
    .back {
      margin-top: 20px;
      text-align: center;
      font-size: 25px
    }

    .home {
      color: white;
      text-decoration: none;
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
      <h1 class="title"><a class="home" href="photo-page.php">PHOTOMENU</a></h1>
      <a href="upload-photo.php"><button class="btn-border">Upload Image</button></a>
      <a href="authors.php" ><button class="btn-border">Authors</button></a>
      <a href="your-images.php" ><button class="btn-border">Your Images</button></a>
      <form action="" method="post" class="logout">
        <button name="logout" class="btn-border">Log Out</button>
      </form>
    </nav>
  </header>
    <h2>Your images</h2>
    <?php
    $sql3 = 'SELECT * FROM authors WHERE id = ' . $_SESSION['userID'];
    $result3 = $link->query($sql3);
    $row3 = $result3->fetch_array();
    ?>
    <p>Hi, <?= $row3['name'] ?></p>
    <table border="1" class="table table-bordered">
    <thead class="head-table">
      <th>Photo</th>
      <th>Description</th>
      <th>Enabled</th>
      <th>Edit</th>
    </thead>
    <tbody>
    <?php
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        while($row != null) {
    ?>
    <tr>
      <td><img src="./img/<?= $row['name'] ?>" alt=""></td>
      <td><?= $row['text'] ?></td>
      <td><input type="checkbox"
      <?php
      if ($row['enabled'] == 1) {
        echo 'checked';
      } else {
        echo 'null';
      }
      ?>
      ></td>
      <td><a href="modify-photo.php?id=<?= $row['id'] ?>"><button class="btn-centered btn-edit">Edit</button></a></td>
    </td>
    <?php
        $row = $result->fetch_assoc();
        }
    ?>
    </tbody>
  </table>
  <br>
  <p class="back">
    <a href="photo-page.php">Back</a>
  </p>
</body>
</html>