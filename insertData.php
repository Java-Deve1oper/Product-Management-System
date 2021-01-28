<?php
session_start();


include 'connection.php';
$statusMsg = '';

$productname = $_POST["product_name"];
$productmodel = $_POST["product_model"];
$productprice = $_POST["product_price"];
$productstatus = $_POST["product_status"];
$uid = $_SESSION["user_id"] ;
$maxsize    = 2097152;




// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
            $statusMsg = 'File too large. File must be less than 2 megabytes.';
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

                // Insert image file name into database
                $query = "INSERT INTO products(userid,pimage,pname,pmodel,prate,pstatus) VALUES('" . $uid . "','" . $fileName . "','" . $productname . "','" . $productmodel . "','" . $productprice . "','" . $productstatus . "')";

                $result =  mysqli_query($conn, $query);

                $user = $_SESSION["login_user"];

                header("location:panel.php?uname=$user");
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;



?>
