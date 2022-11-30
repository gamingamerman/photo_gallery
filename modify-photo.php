<?php include './includes/link.php';
    session_start();

    if (isset($_POST["send"])) {
        $name = $_REQUEST["name"];
        $text = $_REQUEST["text_photo"];
        $enabled = $_REQUEST["enabled"];
        $image_name = $_FILES["file"]["name"];
        $image_size = $_FILES["file"]["size"];

        $stmt->prepare("UPDATE images SET name='?', text='?', file='?', enabled=? WHERE id=" . $_GET['userID']);
        $stmt->bind_param('sssi', $name, $text, $image_name, $enabled);

        $stmt->execute();
        $stmt->close();
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
        <form action="" method="post">
        <p>
                * Name: <input type="text" name="name" placeholder="Name..." required>
            </p>
            <p>
                <p>Text</p>
                <input type="text" name="text_photo">
            </p>
            <p>
                Enabled? <input type="checkbox" name="enabled">
            </p>
            <p>
                <h3>Photo:</h3> 
                <br>
                <input type="file" name="file" required>
            </p>
            <input type="submit" name="send" value="Modify">
        </form>
    </fieldset>
</body>
</html>