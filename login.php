<?php
session_start();
session_unset();

?>


<!DOCTYPE html>
<html>

<head>
    <title>
        Login Page
    </title>
    <style>
        .form1 {
            padding-left: 500px;
            padding-top: 220px;
        }

        .heading {
            padding-left: 70px;
            text-transform: uppercase;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="heading">

    </div>
    <div class="form1">
        <form action="loginCheck.php" method="POST">
            <div>
                <div class="heading">
                    <label for="login-heading">
                        User Login
                    </label>
                </div>
                <br>
                <label for="username">
                    Username :
                </label>
                <input type="text" name="username" placeholder="Enter your username">
                <br>
                <br>
                <label for="password">
                    Password :
                </label>
                <input type="password" name="password" placeholder="Enter your password">
                <br>
                <br>
                <button type="submit" name="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>