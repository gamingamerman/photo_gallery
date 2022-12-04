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
    <title>PhotoMenu</title>
</head>
<body>
    <a href="photo-page.php">back</a>
    <h2>Your images</h2>
    <table border="1">
    <thead>
      <th>Photo</th>
      <th>Description</th>
      <th>Enable</th>
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
        </td>
    <?php
        $row = $result->fetch_assoc();
        }
    ?>
    </tbody>
  </table>
</body>
</html>