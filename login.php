<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhotoMenu</title>
    <style>
        body {
            text-align: center;
        }
        
        fieldset {
            font-size:x-large;
            display: inline-block;
            border-collapse: collapse;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -150px 0 0 -150px;
        }
    </style>
</head>
<body>
    <fieldset>
        <legend>Login Page</legend>
        <form action="" method="post">
            <p>
                <label for="user">Username: 
                    <input type="text" name="user" id="user">
                </label>
            </p>
            <p>
                <label for="pass">Password: 
                    <input type="text" name="pass" id="pass">
                </label>
            </p>
            <p><input type="submit" value="Log In"></p>
        </form>
    </fieldset>
</body>
</html>