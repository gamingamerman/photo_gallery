<?php

use LDAP\Result;

 include './includes/link.php';
session_start();

echo $_SESSION["userID"];

if (isset($_POST["send"])) {
    $name = $_FILES["file"]["name"];
    $text = $_REQUEST["text_photo"];
    $enabled = 0;
    $image_name = $_FILES["file"]["name"];

    if (isset($_REQUEST["enabled"])) {
        $enabled = 1;
      } else {
        $enabled = 0;
      }

    $sql = "UPDATE images SET name='$name', text='$text', file='$image_name', enabled=$enabled WHERE id=" . $_SESSION['userID'];

    $link->query($sql);
    echo mysqli_errno($link);
    echo "<br>";
    echo $sql;
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
    <fieldset>
        <legend>Modify Photo</legend>
        <form action="" method="post" enctype="multipart/form-data">
            <p>
            <p>Text:</p>
            <input type="text" name="text_photo">
            </p>
            <p>
                Enabled: <input type="checkbox" name="enabled">
            </p>
            <p>
            <h3>Photo:</h3>
            <br>
            <input type="file" name="file">
            </p>
            <input type="submit" name="send" value="Modify">
        </form>
    </fieldset>
</body>

</html>