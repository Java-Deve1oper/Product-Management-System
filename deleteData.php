<?php
require("connection.php");
session_start();



if($_SESSION['login_user']==$_REQUEST['uname']){

    if ($_REQUEST['deleteData'] == "delete") {

        $product_id = $_REQUEST["id"];
        $user_id = $_SESSION["user_id"];

        // echo "Product ID => ".$product_id." User ID => ".$user_id;
        $sql = "DELETE FROM products WHERE pid=$product_id AND userid=$user_id";
    
        // echo $sql;
        $result = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($result);

        // echo "count is : ".$count;
        $uname = $_REQUEST['uname'];
        header("location:panel.php?uname=$uname");
        // header("Refresh: 0");
    
        
     }


}

 

?>


