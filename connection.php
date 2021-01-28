<?php

$username = "root";
$password = "webkul";
$dbname = "tasks";

$conn = new mysqli("localhost", $username, $password, $dbname);

// Check connection
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
} else {
  // echo "Successfully Created !!!";
}
