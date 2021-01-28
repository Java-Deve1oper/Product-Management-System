<?php


include("connection.php");
session_start();


$uName = $_REQUEST['username'];
$uPass = $_REQUEST['password'];



$sql = "SELECT id FROM task3 WHERE username = '$uName' and passcode = '$uPass'";



$result = mysqli_query($conn, $sql);



$count = mysqli_num_rows($result);






if ($count == 1) {


    foreach($result as $row){
        $_SESSION["user_id"] =$row["id"];
    }
    $_SESSION["login_user"] = "$uName";

    $_SESSION["logging"] = 1 ;



    header("location:panel.php?uname=$uName");
} else {
    $error = "Your Login Name or Password is invalid";


?>

    <html>

    <head>
        <style>
            .showError {
                padding-left: 320px;
                padding-top: 20px;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 40px;
            }
        </style>



    </head>

    <body>
        <div class="showError">
            <h5 id="error">

            </h5>

            <script>
                document.getElementById("error").innerHTML = "Your Login Name or Password is invalid";

                setTimeout(function() {
                    window.location.replace("login.php");
                }, 1000);
            </script>


        </div>

    </body>

    </html>

<?php

}


?>