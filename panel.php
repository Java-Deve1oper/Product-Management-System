<?php
session_start();
require("connection.php");


if ($_SESSION["login_user"] == $_REQUEST["uname"]) {

    if ($_SESSION['logging'] == 1) {
?>

        <html>

        <head>
            <title>
                Welcome <?php echo $_SESSION["login_user"]; ?>
            </title>
            <style>
                .header {
                    overflow: hidden;
                    background-color: #f1f1f1;
                    padding: 20px 10px;
                }

                .header a {
                    float: left;
                    color: black;
                    text-align: center;
                    padding: 12px;
                    text-decoration: none;
                    font-size: 18px;
                    line-height: 25px;
                    border-radius: 4px;
                }

                .header a.logo {
                    font-size: 25px;
                    font-weight: bold;
                }

                .header a:hover {
                    background-color: #ddd;
                    color: black;
                }

                .header a.active {
                    background-color: dodgerblue;
                    color: white;
                }

                .header-right {
                    float: right;
                }

                @media screen and (max-width: 500px) {
                    .header a {
                        float: none;
                        display: block;
                        text-align: left;
                    }

                    .header-right {
                        float: none;
                    }
                }


                /*  --------------------------------------- Pop up insert form CSS ------------------------------- */
                .open-button {
                    background-color: #555;
                    color: white;
                    padding: 16px 20px;
                    border: none;
                    cursor: pointer;
                    opacity: 0.8;
                    position: fixed;
                    bottom: 23px;
                    right: 28px;
                    width: 280px;
                }

                /* The popup form - hidden by default */
                .form-popup {
                    display: none;
                    position: fixed;
                    bottom: 0;
                    right: 15px;
                    border: 3px solid #f1f1f1;
                    z-index: 9;
                }

                /* Add styles to the form container */
                .form-container {
                    max-width: 300px;
                    padding: 10px;
                    background-color: white;
                }

                /* Full-width input fields */
                .form-container input[type=text],
                .form-container input[type=password] {
                    width: 100%;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    border: none;
                    background: #f1f1f1;
                }

                /* When the inputs get focus, do something */
                .form-container input[type=text]:focus,
                .form-container input[type=password]:focus {
                    background-color: #ddd;
                    outline: none;
                }

                /* Set a style for the submit/login button */
                .form-container .btn {
                    background-color: #4CAF50;
                    color: white;
                    padding: 16px 20px;
                    border: none;
                    cursor: pointer;
                    width: 100%;
                    margin-bottom: 10px;
                    opacity: 0.8;
                }

                /* Add a red background color to the cancel button */
                .form-container .cancel {
                    background-color: red;
                }

                /* Add some hover effects to buttons */
                .form-container .btn:hover,
                .open-button:hover {
                    opacity: 1;
                }

                /* --------------------------------------Data Table CSS------------------------------------ */

                #customers {
                    font-family: Arial, Helvetica, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                }

                #customers td,
                #customers th {
                    border: 1px solid #ddd;
                    padding: 8px;
                }

                #customers tr:nth-child(even) {
                    background-color: #f2f2f2;
                }

                #customers tr:hover {
                    background-color: #ddd;
                }

                #customers th {
                    padding-top: 12px;
                    padding-bottom: 12px;
                    text-align: left;
                    background-color: #4CAF50;
                    color: white;
                }

                #table {
                    display: block;
                    width: auto;
                    height: auto;
                    overflow: visible;
                }

                td {
                    text-align: center;
                }
            </style>
        </head>

        <body>
            <!-- //---------------------------------------- Header ----------------------------------------------- -->
            <div class="header">
                <a href="#default" class="logo"><?php echo $_SESSION["login_user"]; ?></a>
                <div class="header-right">
                    <a class="active" href="#home">Home</a>
                    <a href="#contact">Contact</a>
                    <a href="logout.php?uname=<?php $_SESSION['login_user'] ?>">logout</a>
                </div>
            </div>
            <!-- //---------------------------------Data Visulatization In Table form ----------------------------- -->
            <div id="table">
                <table id="customers">
                    <tr>
                        <th>S.No</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Model</th>
                        <th>Product Price</th>
                        <th>Product Status</th>
                        <th>Product Modification</th>
                    </tr>
                    <?php

                    $query = "SELECT * FROM products Where userid = ".$_SESSION['user_id'];
                    $result = mysqli_query($conn, $query);

                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        foreach ($result as $row) {
                            echo '
                         <tr>
                            <td>' . $row["pid"] . '</td>
                            <td>' . '<img src="uploads/' . $row['pimage'] . '" height="100" width="100"/>' . '</td>
                            <td>' . $row["pname"] . '</td>
                            <td>' . $row["pmodel"] . '</td>
                            <td>' . $row["prate"] . '</td>
                            <td>' . $row["pstatus"] . '</td>
                            <td>' . '<a href="deleteData.php?uname='.$_SESSION["login_user"].'&deleteData=delete&id='.$row["pid"].'">Delete</a>'.'</td>
                          </tr>';
                        }
                    }
                  //|| ' . '<a href="editData(' . $row["pid"] . ')">Edit</a>' 
                    ?>
                </table>
            </div>
            <!-- //--------------------------------- POP UP Insert Button ------------------------------------------ -->

            <button class="open-button" onclick="openForm()">Insert Data</button>

            <div class="form-popup" id="myForm">
                <form action="insertData.php" class="form-container" method="post" enctype='multipart/form-data'>
                    <h1>Insert Product Data</h1>

                    <label for="psw"><b>Upload Product Image</b></label>
                    <br>
                    <input type="file" name="file" />
                    <br>
                    <br>

                    <label for="product-name"><b>Product Name</b></label>
                    <input type="text" placeholder="Enter Product Name" name="product_name" required>

                    <label for="product-model"><b>Product Model</b></label>
                    <input type="text" placeholder="Enter Product Model" name="product_model" required>

                    <label for="product-price"><b>Product Price</b></label>
                    <input type="text" placeholder="Enter Product Price" name="product_price" required>

                    <label for="product-status"><b>Product Status</b></label>
                    <input type="text" placeholder="Enter Product Status" name="product_status" required>

                    <button type="submit" class="btn" name="submit" value="Upload">Insert Data</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>

            <script>
                function openForm() {
                    document.getElementById("myForm").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                }
            </script>
        </body>

        </html>


<?php


       
    }
    // else {

    //     header("location:login.php");
    // }
} else {

    header("location:login.php");
}




?>