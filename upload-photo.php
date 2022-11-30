<?php include './includes/link.php' ?>
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
        if(isset($_POST["send"])) {
            $name = $_REQUEST["name"];
            $text_photo = "No text contained";
            $enabled = 0;
            $photo_name = $_FILES["file"]["name"];
            $photo_size = $_FILES["file"]["size"];
            $photo_loc = $_FILES["file"]["name"];
            $exampleid = 1;

            if (isset($_REQUEST["text_photo"])) {
                $text_photo = $_REQUEST["text_photo"];
            }

            if (isset($_REQUEST["enabled"])) {
                $enabled = 1;
            } else {
                $enabled = 0;
            }

            $stmt = $link->stmt_init();

            $stmt->prepare('INSERT INTO images (id, author_id, name, file, size, text, enabled, created) VALUES (NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
            $stmt->bind_param('issisi', $exampleid, $photo_name, $photo_loc, $photo_size, $text_photo, $enabled);

            $stmt->execute();
            $stmt->close();
        };
    ?>
    <h2>Upload a Photo to the Gallery</h2>
    <fieldset>
        <legend>Upload</legend>
        <form action="" method="post" enctype="multipart/form-data">
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
            <input type="submit" name="send" value="Upload">
        </form>
    </fieldset>
</body>
</html>