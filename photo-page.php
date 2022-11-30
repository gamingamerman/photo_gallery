<?php
session_start();
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
        </thead>
        <tbody>
            <tr>
                <td>Image1</td>
                <td>Description1</td>
                <td><button>Edit</button></td>
            </tr>
            <tr>
                <td>Image2</td>
                <td>Description2</td>
                <td><button>Edit</button></td>
            </tr>
            <tr>
                <td>Image3</td>
                <td>Description3</td>
                <td><button>Edit</button></td>
            </tr>
            <tr>
                <td>Image4</td>
                <td>Description4</td>
                <td><button>Edit</button></td>
            </tr>
        </tbody>
    </table>
</body>
</html>